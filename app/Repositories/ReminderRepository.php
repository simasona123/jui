<?php

namespace App\Repositories;

use App\Models\Dokter;
use App\Models\Reminder;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ReminderRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'dokter_id',
        'pasien_id',
        'keterangan',
        'tanggal',
        'status'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Reminder::class;
    }

    public function create(array $input): Model
    {
        $input['dokter_id'] = Dokter::where('user_id', $input['dokter_id'])->first()->id;
        $model = $this->model->newInstance($input);
        $model->status = -1; //Belum Terikirim
        $model->save();

        return $model;
    }
}
