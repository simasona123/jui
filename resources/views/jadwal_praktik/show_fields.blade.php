<!-- Dokter Id Field -->
<div class="col-sm-12">
    {!! Form::label('dokter_id', 'Dokter Id:') !!}
    <p>{{ $jadwalPraktik->dokter_id }}</p>
</div>

<!-- Tanggal Masuk Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal_masuk', 'Tanggal Masuk:') !!}
    <p>{{ $jadwalPraktik->tanggal_masuk }}</p>
</div>

<!-- Tanggal Selesai Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal_selesai', 'Tanggal Selesai:') !!}
    <p>{{ $jadwalPraktik->tanggal_selesai }}</p>
</div>

<!-- Ketersediaan Field -->
<div class="col-sm-12">
    {!! Form::label('ketersediaan', 'Ketersediaan:') !!}
    <p>{{ $jadwalPraktik->ketersediaan }}</p>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{{ $jadwalPraktik->keterangan }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $jadwalPraktik->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $jadwalPraktik->updated_at }}</p>
</div>

