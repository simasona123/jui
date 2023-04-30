<div class="container py-5 h-100">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col col-xl-10">
      <div class="card mb-5" style="border-radius: 15px;">
        <div class="card-body p-4">
          <h3 class="mb-3">{{ $booking->kode_booking }}</h3>
          <p class="small mb-0"><i class="fas fa-user-md"></i><span class="mx-2">|</span>
            <strong>{{$booking->pasien->nama_hewan}}</strong> Diperiksa oleh
            <strong>{{$booking->jadwal_praktik->dokter->user->full_name}}</strong> pada {{$booking->jadwal_praktik->tanggal_masuk->format('d-m-Y')}}</p>
          <hr class="my-4">
          <div class="d-flex justify-content-start align-items-center">
            <p class="mb-0 text-uppercase"><i class="fas fa-calendar-check"></i> 
              <span
                class="text-muted small"> {{ $booking->created_at }} WIB
              </span>
            </p>
            @if (isset($booking->rekam_medis))
              <p class="mb-0 text-uppercase" style="margin-left: 5px;"><i class="fas fa-file-medical-alt"></i></i> <span
                  class="text-muted small">
                  <a href="/rekam-medis/{{$booking->rekam_medis->id}}">Lihat Rekam Medis</a>
              </span>
              </p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>