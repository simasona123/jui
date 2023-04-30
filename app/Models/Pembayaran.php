<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Pembayaran extends Model implements HasMedia
{

    use InteractsWithMedia;

    public $table = 'pembayaran';

    public $fillable = [
        'booking_id',
        'tanggal_bayar',
        'jumlah_transaksi',
        'verifikasi',
        'user_id'
    ];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
        'jumlah_transaksi' => 'string'
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }
  
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
