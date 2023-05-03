@php
    $media = $pembayaran->getMedia();
    $image_url = count($media) == 0 ? "http://bmkg.go.id/asset/img/logo/logo-bmkg.png" : $media[0]->getUrl('preview');
@endphp
@php
    $media = $pembayaran->getMedia();
    $image_url = count($media) == 0 ? "http://bmkg.go.id/asset/img/logo/logo-bmkg.png" : $media[0]->getUrl('preview');
@endphp
{{-- <img width="100px" src="{{$image_url}}" alt="" srcset=""> --}}
<div class="row d-flex justify-content-center" style="margin-top: 20px;">
    <div class="col-sm-6" style="height: 200px; margin: 0 auto;">
        <img src="{{env('APP_URL')}}/assets/img/logo-jui.png"
            class="brand-image elevation-3" style="width: 100%; object-fit:contain; height: 100%;">
    </div>
    <hr class="col-sm-12" style="border: 2px solid black;">
    <div class="col-sm-12">
        <ul class="list-unstyled">
            <li class="text-black">{{$pembayaran->user->full_name}} | {{$pembayaran->user->email}}</li>
            <li class="text-black">{{$pembayaran->user->phone}}</li>
            <li class="text-muted mt-1">#{{$pembayaran->booking->kode_booking}}</li>
            <li class="text-black mt-1">Tanggal Booking: {{$pembayaran->booking->created_at}}</li>
            @if ($pembayaran->verifikasi == 1)
                <li class="text-black mt-1">Tanggal Bayar: {{$pembayaran->tanggal_bayar}}</li>
            @endif
        </ul>
    </div>
</div>

<br>

<table style="width: 100%;">
    <tr>
        <td>
            {{$pembayaran->booking->jadwal_praktik->dokter->user->full_name}} <br>
            {{$pembayaran->booking->jadwal_praktik->dokter->nip}}
        </td>
        <td>
            Pasien: {{$pembayaran->booking->pasien->nama_hewan}} <br>
            {{$pembayaran->booking->pasien->jenis_hewan}}
            {{$pembayaran->booking->pasien->ras}}
        </td>
    </tr>
    <br><br>
    <tr>
        <td>
            @isset($pembayaran->booking->rekam_medis)
                {{$pembayaran->booking->rekam_medis->tindakan}}
            @endisset
        </td>
        <td></td>
    </tr>
</table>
<br><br>

<div class="row" style="margin-right: 10px;">
    <div class="col-sm-12 text-right">
        <p>Biaya Pemeriksaan: Rp. {{$pembayaran->jumlah_transaksi}}</p>
    </div>
</div>
<hr style="border: 2px solid black;">
<div class="row text-black" style="margin-right: 10px;">
    <div class="col-xl-12 text-right">
        <p class="float-end fw-bold">Total: Rp. {{$pembayaran->jumlah_transaksi}}</p>
        @if ($pembayaran->verifikasi == 1)
            <span class="badge badge-success">Lunas</span>
        @elseif ($pembayaran->verifikasi == 2)
            <span class="badge badge-info">Menunggu Konfirmasi Admin</span>
        @elseif ($pembayaran->verifikasi == 0)
            <span class="badge badge-warning">Menunggu Pembayaran</span>
        @endif
    </div>
</div>
<hr style="border: 2px solid black;">
<div class="text-center" style="margin-top: 90px;">
    <p class="text-center mb-5" style="font-size: 30px;">Terima Kasih Atas Kepercayaannya</p>
    @isset($pembayaran->booking->rekam_medis)
        <a style="" href="{{route('print.invoice', $pembayaran->id)}}">Print Kwitansi</a>
    @endisset
</div>


