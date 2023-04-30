<?php

namespace App\Repositories;

use App\Models\Dokter;
use App\Models\JadwalPraktik;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktikRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'dokter_id',
        'tanggal_masuk',
        'tanggal_selesai',
        'ketersediaan',
        'keterangan'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return JadwalPraktik::class;
    }

    public function create(array $input): Model
    {
        $input['dokter_id'] = Dokter::where('user_id', $input['user_id'])->first()->id;

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }
}
