<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    public $table = 'rekam_medis';

    public $fillable = [
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

    protected $casts = [
        'nomor_rekam_medis' => 'string',
        'keluhan' => 'string',
        'diagnosis' => 'string',
        'prognosa' => 'string',
        'tindakan' => 'string',
        'suhu' => 'decimal:2',
        'berat' => 'decimal:2',
        'tgl_pemeriksaan' => 'datetime',
        'keterangan' => 'string'
    ];

    public function dokter(){
        return $this->belongsTo(Dokter::class);
    }

    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}
