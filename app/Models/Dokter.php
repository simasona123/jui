<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Dokter extends Model implements HasMedia
{

    use InteractsWithMedia;
    
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

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
    
}
