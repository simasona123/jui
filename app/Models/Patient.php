<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $table = 'patients';

    public $fillable = [
        'user_id',
        'nama_hewan',
        'jenis_hewan',
        'jenis_kelamin',
        'ras',
        'tanggal_lahir'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'nama_hewan' => 'string',
        'jenis_hewan' => 'string',
        'jenis_kelamin' => 'string',
        'ras' => 'string',
        'tanggal_lahir' => 'date'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'nama_hewan' => 'required',
        'jenis_hewan' => 'required',
        'jenis_kelamin' => 'required',
        'ras' => 'required'
    ];

    
}
