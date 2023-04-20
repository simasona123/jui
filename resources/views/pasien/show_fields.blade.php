<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $pasien->user_id }}</p>
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
    <p>{{ $pasien->jenis_kelamin }}</p>
</div>

<!-- Ras Field -->
<div class="col-sm-12">
    {!! Form::label('ras', 'Ras:') !!}
    <p>{{ $pasien->ras }}</p>
</div>

<!-- Umur Field -->
<div class="col-sm-12">
    {!! Form::label('umur', 'Umur:') !!}
    <p>{{ $pasien->umur }}</p>
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

