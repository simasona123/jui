@extends('layouts.app')
@section('content')
    <div class="row" style="padding-top: 20px; margin-left: 10px; margin-right: 10px;">
        <div class="col-sm-12">
            @include('flash::message')
        </div>
        <div class="col-sm-12">
            <div class="card" style="padding: 20px;">
                <div class="pemberitahuan d-flex flex-row align-items-center card-title justify-content-between" style="margin-bottom: 20px;">
                    <div class="d-flex flex-row align-items-center"><i class="fas fa-bell" style="margin-right: 10px;"></i>
                        <h5 style="margin-bottom:0px;">Temu Janji Dokter</h5>
                    </div>
                    <a href="/pemberitahuan">
                        <button id="tandai-semua" type="button" class="btn btn-primary" style="margin-right: .75rem;">Tandai Semua</button>
                    </a>
                </div>
                <table class="table table-hover">
                    <thead>
                        @isset($pasien)
                            <tr>
                                <th>Nama Hewan</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>Jadwal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pasiens as $pasien)
                                @if(isset($pasien->bookings))
                                    @foreach($pasien->bookings as $booking)
                                    <tr>
                                        <td>
                                            {{$pasien->nama_hewan}}
                                        </td>
                                        <td>
                                            {{$booking->jadwal_praktik->dokter->user->full_name}}
                                        </td>
                                        <td>
                                            @if ($booking->completed == 0)
                                            <span class="badge badge-warning">Belum Selesai</span>
                                        @else
                                            <span class="badge badge-success">Selesai</span>
                                        @endif
                                        </td>
                                        <td style="">
                                            {{ date("Y-m-d H:i:s", strtotime($booking->jadwal_praktik->tanggal_masuk."+7 hours"))}} WIB
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @endisset
                        @isset($jadwal_praktiks)
                                <tr>
                                    <th>User</th>
                                    <th>Dokter</th>
                                    <th>Kode Booking</th>
                                    <th>Status</th>
                                    <th>Jadwal</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($jadwal_praktiks as $jadwal_praktik)
                                @foreach ($jadwal_praktik->bookings as $booking)
                                <tr>
                                    <td>{{$booking->pasien->user->full_name}}</td>
                                    <td>{{$jadwal_praktik->dokter->user->full_name}} ({{$jadwal_praktik->dokter->user->email}})</td>
                                    <td>{{$booking->kode_booking}}</td>
                                    <td> 
                                        @if ($booking->completed == 0)
                                            <span class="badge badge-warning">Belum Selesai</span>
                                        @else
                                            <span class="badge badge-success">Selesai</span>
                                        @endif
                                        @isset($booking->pembayaran)
                                            @if ($booking->pembayaran->verifikasi == 0)
                                                <span class="badge badge-warning">User Belum Membayar</span>
                                            @elseif ($booking->pembayaran->verifikasi == 1)
                                                <span class="badge badge-success">Terverifikasi Admin</span>
                                            @else
                                                <span class="badge badge-info">Menunggu konfirmasi Admin</span>
                                            @endif
                                        @else
                                            <span class="badge badge-secondary">Belum ada pembayaran</span>
                                        @endisset
                                        
                                    </td>
                                    <td>{{$jadwal_praktik->tanggal_masuk->addHours(7)}} WIB</td>
                                </tr>
                                @endforeach
                            @endforeach
                        @endisset
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="card" style="padding: 20px;">
                <div class="pemberitahuan d-flex flex-row align-items-center card-title justify-content-between" style="margin-bottom: 20px;">
                    <div class="d-flex flex-row align-items-center"><i class="fas fa-bell" style="margin-right: 10px;"></i>
                        <h5 style="margin-bottom:0px;">Pemberitahuan</h5>
                    </div>
                    <a href="/pemberitahuan">
                        <button id="tandai-semua" type="button" class="btn btn-primary" style="margin-right: .75rem;">Tandai Semua</button>
                    </a>
                </div>
                <table class="table table-hover">
                    <tbody>
                        @foreach ($user->notifications as $item)
                            <tr>
                                <td>
                                    {{$item->data['keterangan']}}
                                    <br>
                                    @if (!$item->read_at)
                                        <span class="badge badge-warning">Pemberitahuan</span>
                                    @else
                                        <span class="badge badge-success">Telah Diketahui</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    {{ date("Y-m-d H:i:s", strtotime($item->created_at."+7 hours"))}} WIB
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
       
    </script>
    
@endsection
