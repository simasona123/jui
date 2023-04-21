<?php

namespace App\Repositories;

use App\Models\JadwalPraktik;
use App\Repositories\BaseRepository;

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
}
