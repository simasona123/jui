<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name=description content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {margin: 20px}
        </style>
    </head>
    <body>
        <div class="" style="margin-top: 20px;">
            <div class="col-sm-6" style="height: 200px; margin: 0 auto;">
                <img src="{{env('APP_URL')}}/assets/img/logo-jui.png"
                class="brand-image elevation-3" style="width: 100%; object-fit:contain; height: 100%;">
            </div>
            <hr style="border: 2px solid black;">
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
                <td>{{$pembayaran->booking->rekam_medis->tindakan}}</td>
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
        </div>
    </body>
</html>

<style>
    .row{
        display: flex;
    }
</style>