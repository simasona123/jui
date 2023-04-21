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

    public function create_with_image(Request $input): Model {

        $model = $this->model->newInstance($input->all());

        $image_name = $model->name.".".$input['image']->extension();

        $input['image']->move(storage_path('app/dokter'), $image_name);

        $model->addMedia(storage_path('app/dokter/') . $image_name)->toMediaCollection();

        $model->save();

        return $model;
    }
}
