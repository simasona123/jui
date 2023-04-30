    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card mb-5" style="border-radius: 15px;">
            <div class="card-body p-4">
              <h3 class="mb-3">{{ $booking->kode_booking }}</h3>
              <p class="small mb-0"><i class="far fa-star fa-lg"></i> <span class="mx-2">|</span> Created by
                <strong>MDBootstrap</strong> on 11 April , 2021</p>
              <hr class="my-4">
              <div class="d-flex justify-content-start align-items-center">
                <p class="mb-0 text-uppercase"><i class="fas fa-cog me-2"></i> <span
                    class="text-muted small">settings</span></p>
                <p class="mb-0 text-uppercase"><i class="fas fa-link ms-4 me-2"></i> <span
                    class="text-muted small">program link</span></p>
                <p class="mb-0 text-uppercase"><i class="fas fa-ellipsis-h ms-4 me-2"></i> <span
                    class="text-muted small">program link</span>
                  <span class="ms-3 me-4">|</span></p>
                <a href="#!">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-2.webp" alt="avatar"
                    class="img-fluid rounded-circle me-3" width="35">
                </a>
                <button type="button" class="btn btn-outline-dark btn-sm btn-floating">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Jadwal Id Field -->
<div class="col-sm-12">
    {!! Form::label('jadwal_id', 'Jadwal Id:') !!}
    <p>{{ $booking->jadwal_praktik }}</p>
</div>

<!-- Pasien Id Field -->
<div class="col-sm-12">
    {!! Form::label('pasien_id', 'Pasien Id:') !!}
    <p>{{ $booking->pasien_id }}</p>
</div>

<!-- Kode Booking Field -->
<div class="col-sm-12">
    {!! Form::label('kode_booking', 'Kode Booking:') !!}
    <p></p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $booking->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $booking->updated_at }}</p>
</div>
@if (isset($booking->rekam_medis))
    <a href="/rekam-medis/{{$booking->rekam_medis->id}}">Lihat Rekam Medis</a>
@endif

