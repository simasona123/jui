@php
    $media = $pembayaran->getMedia();
    $image_url = count($media) == 0 ? "http://bmkg.go.id/asset/img/logo/logo-bmkg.png" : $media[0]->getUrl('preview');
@endphp
<!-- Booking Id Fie
    ld -->
<div class="col-sm-12">
    {!! Form::label('booking_id', 'Booking Id:') !!}
    <p>{{ $pembayaran->booking_id }}</p>
    <img width="100px" src="{{$image_url}}" alt="" srcset="">
</div>

<!-- Tanggal Bayar Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal_bayar', 'Tanggal Bayar:') !!}
    <p>{{ $pembayaran->tanggal_bayar }}</p>
</div>

<!-- Jumlah Transaksi Field -->
<div class="col-sm-12">
    {!! Form::label('jumlah_transaksi', 'Jumlah Transaksi:') !!}
    <p>{{ $pembayaran->jumlah_transaksi }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('verifikasi', 'Verifikasi Pembayaran') !!}
    <p>{{ $pembayaran->verifikasi }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $pembayaran->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $pembayaran->updated_at }}</p>
</div>

@isset($pembayaran->booking->rekam_medis)
    <a href="{{route('print.invoice', $pembayaran->id)}}">Print Invoice</a>
@endisset

