<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\BaseRepository;

class PatientRepository extends BaseRepository
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
        return Patient::class;
    }
}
