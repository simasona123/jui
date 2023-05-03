<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
        <div class="card mb-5" style="border-radius: 15px;">
            <div class="card-body p-4">
            <h5 class="mb-3">{{ $jadwalPraktik->tanggal_masuk->addHours(7) }} WIB sampai {{ $jadwalPraktik->tanggal_selesai->addHours(7) }} WIB</h5 >
            <p class="mb-0"><i class="fas fa-user-md"></i><span class="mx-2">|</span>
                Diperiksa oleh
                <strong>{{$jadwalPraktik->dokter->user->full_name}}</strong> {{$jadwalPraktik->dokter->nip}}</p>
            <hr class="my-4">
            <div class="d-flex justify-content-start align-items-center">
                <p class="mb-0 text-uppercase"><i class="fas fa-calendar-check"></i> 
                <span
                    class="text-muted small">{{ $jadwalPraktik->ketersediaan }} Ketersediaan
                </span>
                </p>
            </div>
            <div class="d-flex justify-content-start align-items-center">
                <p class="mb-0 text-uppercase"><i class="fas fa-file-signature"></i>
                    <span class="text-muted small">{{ count($jadwalPraktik->bookings) }} Booking
                    </span>
                </p>
            </div>
            @isset($jadwalPraktik->keterangan)
                <div class="d-flex justify-content-start align-items-center">
                    <p class="mb-0 text-uppercase"><i class="fas fa-file-medical-alt"><span
                        class="text-muted small">
                            <p>{{ $jadwalPraktik->keterangan }}</p>
                    </span>
                    </p>
                </div>
            @endisset
            </div>
        </div>
        </div>
    </div>
</div>
