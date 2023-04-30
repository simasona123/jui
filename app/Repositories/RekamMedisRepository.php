<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Dokter;
use App\Models\RekamMedis;
use App\Repositories\BaseRepository;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Model;

class RekamMedisRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'booking_id',
        'dokter_id',
        'nomor_rekam_medis',
        'keluhan',
        'diagnosis',
        'prognosa',
        'tindakan',
        'suhu',
        'berat',
        'tgl_pemeriksaan',
        'keterangan'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return RekamMedis::class;
    }

    public function update(array $input, int $id)
    {
        // dd($input)

        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        return $model;
    }

    public function create(array $input): Model
    {
        $input['nomor_rekam_medis'] = $this->generate_rekam_medis($input['booking_id']);

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    private function generate_rekam_medis($booking_id){
        // $tz = 'Asia/Jakarta';
        // $timestamp = time();
        // $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        // $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        // return $dt->format('Ymdhis');
        return Booking::find($booking_id)->kode_booking;
    }
}
