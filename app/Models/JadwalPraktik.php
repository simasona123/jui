<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPraktik extends Model
{
    public $table = 'jadwal_praktik';

    public $fillable = [
        'dokter_id',
        'tanggal_masuk',
        'tanggal_selesai',
        'ketersediaan',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_masuk' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'keterangan' => 'string'
    ];

    public function dokter(){
        return $this->belongsTo(Dokter::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
