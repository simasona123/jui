<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\JadwalPraktik;
use App\Repositories\BaseRepository;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Model;

class BookingRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'jadwal_praktik_id',
        'pasien_id',
        'kode_booking'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Booking::class;
    }

    public function update_booking($input, $id){

        $jadwal_praktik = $this->rebalance_jadwal_praktik($input);

        if(gettype($jadwal_praktik) != 'object'){
            return -1;
        }

        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $jadwal_praktik1 = JadwalPraktik::find($model->jadwal_praktik_id);
        $jadwal_praktik1->ketersediaan += 1;

        $model->fill($input);

        $model->save();
        $jadwal_praktik->save();
        $jadwal_praktik1->save();

        return $model;
    }

    public function create_booking(array $input)
    {
        $jadwal_praktik = $this->rebalance_jadwal_praktik($input);

        if(gettype($jadwal_praktik) != 'object'){
            return -1;
        }

        $input['kode_booking'] = $this->generate_kode(); 

        $model = $this->model->newInstance($input);

        $model->save();
        $jadwal_praktik->save();

        return $model;
    }

    private function rebalance_jadwal_praktik($input){
        $jadwal_praktik = JadwalPraktik::find($input['jadwal_praktik_id']);

        if( $jadwal_praktik->ketersediaan == 0){
            return -1;
        } else{
            $jadwal_praktik->ketersediaan -= 1;
        }
        return $jadwal_praktik;
    }

    private function generate_kode(){
        $tz = 'Asia/Jakarta';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        return $dt->format('Ymdhis') . str_pad((string)rand(0, 100), 3, '0', STR_PAD_LEFT);
    }
}
