<?php

namespace App\Repositories;

use App\Models\Pembayaran;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PembayaranRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'booking_id',
        'tanggal_bayar',
        'jumlah_transaksi'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Pembayaran::class;
    }

    public function create_with_image($input): Model {
        
        $input['user_id'] = Auth::user()->id;

        $model = $this->model->newInstance($input->all());

        if(isset($input->image)){
            $image_name = $model->name.".".$input['image']->extension();

            $input['image']->move(storage_path('app/pembayaran'), $image_name);
    
            $model->addMedia(storage_path('app/pembayaran/') . $image_name)
                ->usingName($image_name)
                ->toMediaCollection();
        }

        $model->save();

        return $model;
    }

    public function update_custom($input, $id){
        //Status 1 Terverifikasi (Sudah dibayar dan dikonfirmasi oleh admin)
        //Status 2 USer upload pembayaran
        //status 0 Belum terverifikasi dan user belum upload 

        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);

        $role = Auth::user()->getRoleNames()[0];
        $name = Auth::user()->full_name;

        if($role == 'klien' ){
            $media = $model->getMedia();

            foreach ($media as $item) {
                $item->delete();
            }

            $whitelist = array('image', 'tanggal_bayar');
            $input = array_intersect_key($input, array_flip($whitelist));
            
            if(isset($input['image'])){ 
                $image_name = $model->booking->kode_booking."-". $name .".".$input['image']->extension();
    
                $input['image']->move(storage_path('app/pembayaran'), $image_name);
        
                $model->addMedia(storage_path('app/pembayaran/') . $image_name)
                    ->usingName($image_name)
                    ->toMediaCollection();
            } //Upload image

            $input['verifikasi'] = 2; //Sudah diubah oleh klien menunggu konfirmasi admin
        }

        else{
            if($input['verifikasi'] == 1 ){
                $booking = $model->booking;
                $booking->status_id = 2; // 2 == sudahdibayar dan terverifikasi
                $booking->save();
            }
        }

        $model->fill($input);

        $model->save();

        return $model;
    }
}
