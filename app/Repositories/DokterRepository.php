<?php

namespace App\Repositories;

use App\Models\Dokter;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DokterRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'spesialis',
        'jenis_kelamin',
        'nip'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Dokter::class;
    }

    public function create_with_image(Request $input) {

        $model = $this->model->newInstance($input->all());

        if(count(Dokter::where('user_id', $model->user_id)->get()) > 0){
            return -1;
        }

        if(isset($input->image)){
            $this->add_image($model, $input);
        }

        $model->save();

        return $model;
    }

    public function update_with_image(Request $input, $id){
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);
        
        if(isset($input->image)){
            $this->add_image($model, $input);
        }
        
        $input = $input->all();

        $model->fill($input);

        $model->save();

        return $model;
    }

    private function add_image($model, $input){
        $media = $model->getMedia();
        foreach ($media as $item) {
            $item->delete();
        }
        $image_name = $model->name.".".$input['image']->extension();

        $input['image']->move(storage_path('app/dokter'), $image_name);

        $model->addMedia(storage_path('app/dokter/') . $image_name)->toMediaCollection();
    }
}
