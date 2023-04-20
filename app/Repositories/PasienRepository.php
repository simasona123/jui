<?php

namespace App\Repositories;

use App\Models\Pasien;
use App\Repositories\BaseRepository;

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
}
