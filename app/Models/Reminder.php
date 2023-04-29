<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    public $table = 'reminders';

    public $fillable = [
        'dokter_id',
        'pasien_id',
        'keterangan',
        'tanggal',
        'status'
    ];

    protected $casts = [
        'keterangan' => 'string',
        'tanggal' => 'date',
        'status' => 'integer'
    ];

    public function dokter(){
        return $this->belongsTo(Dokter::class);
    }

    public function pasien(){
        return $this->belongsTo(Pasien::class);
    }
}
