<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'Klien:') !!}
    <p>{{$klien->full_name}} ({{ $pasien->user_id }})</p>
</div>

<!-- Nama Hewan Field -->
<div class="col-sm-12">
    {!! Form::label('nama_hewan', 'Nama Hewan:') !!}
    <p>{{ $pasien->nama_hewan }}</p>
</div>

<!-- Jenis Hewan Field -->
<div class="col-sm-12">
    {!! Form::label('jenis_hewan', 'Jenis Hewan:') !!}
    <p>{{ $pasien->jenis_hewan }}</p>
</div>

<!-- Jenis Kelamin Field -->
<div class="col-sm-12">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    <p>{{ ucwords($pasien->jenis_kelamin) }}</p>
</div>

<!-- Ras Field -->
<div class="col-sm-12">
    {!! Form::label('ras', 'Ras:') !!}
    <p>{{ $pasien->ras }}</p>
</div>

<!-- Umur Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    <p>{{date_format(date_create($pasien->tanggal_lahir), "d-m-Y") }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $pasien->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $pasien->updated_at }}</p>
</div>

