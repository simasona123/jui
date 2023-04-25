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
    <p>{{ $booking->kode_booking }}</p>
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
    <a href="/admin/rekam-medis/{{$booking->rekam_medis->id}}">Lihat Rekam Medis</a>
@endif