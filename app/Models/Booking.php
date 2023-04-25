<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $table = 'booking';

    public $fillable = [
        'jadwal_praktik_id',
        'pasien_id',
        'kode_booking',
        'pembayaran',
        'expired',
        'completed',
    ];

    protected $casts = [
        'jadwal_praktik_id' => 'integer',
        'pasien_id' => 'integer',
        'kode_booking' => 'string'
    ];

    public function pasien(){
        return $this->belongsTo(Pasien::class);
    }

    public function jadwal_praktik(){
        return $this->belongsTo(JadwalPraktik::class);
    }

    public function rekam_medis(){
        return $this->hasOne(RekamMedis::class);
    }

    public function status(){
        return $this->belongsTo(StatusBooking::class);
    }
}
