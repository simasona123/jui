@php
    $status = [
        'Menunggu Pembayaran', 'Telah Terverifikasi', 'Menunggu Verifikasi',
];
    $media = $model->getMedia();
    $image_url = count($media) == 0 ? "http://bmkg.go.id/asset/img/logo/logo-bmkg.png" : $media[0]->getUrl('preview');
@endphp
<div class="form-group" style="margin-bottom: 0px;">
    <p style="margin-bottom: 0px;"
         @if ($verifikasi == 1)
            class="badge badge-info" 
        @else
            class="badge badge-warning"
        @endif
    >
        {{$status[$verifikasi]}}
    </p>
    @if (count($media) > 0)
        <br>
        <a href="{{$image_url}}">Lihat Gambar</a>
    @endif
</div>
