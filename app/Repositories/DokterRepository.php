<?php

namespace App\Repositories;

use App\Models\Dokter;
use App\Repositories\BaseRepository;

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
}
