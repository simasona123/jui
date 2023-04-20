<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    public $table = 'dokter';

    public $fillable = [
        'user_id',
        'spesialis',
        'jenis_kelamin',
        'nip'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'spesialis' => 'string',
        'jenis_kelamin' => 'string',
        'nip' => 'string'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'jenis_kelamin' => 'required'
    ];

    
}
