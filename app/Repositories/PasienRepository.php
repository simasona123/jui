<?php

namespace App\Repositories;

use App\Models\Pasien;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PasienRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'nama_hewan',
        'jenis_hewan',
        'jenis_kelamin',
        'ras',
        'tanggal_lahir'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Pasien::class;
    }

    public function create_with_image(Request $input): Model {
        $model = $this->model->newInstance($input->all());

        $image_name = $model->name.".".$input['image']->extension();

        $input['image']->move(storage_path('app/pasien'), $image_name);

        $model->addMedia(storage_path('app/pasien/') . $image_name)->toMediaCollection();

        $model->save();

        return $model;
    }
}
