<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Pasien extends Model implements HasMedia
{

    use InteractsWithMedia;

    public $table = 'pasien';

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
        'ras' => 'required',
        'tanggal_lahir' => 'required',
        'image' => ['nullable', "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
