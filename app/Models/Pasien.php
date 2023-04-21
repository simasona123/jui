<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
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
    

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
