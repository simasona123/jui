<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $patient->user_id }}</p>
</div>

<!-- Nama Hewan Field -->
<div class="col-sm-12">
    {!! Form::label('nama_hewan', 'Nama Hewan:') !!}
    <p>{{ $patient->nama_hewan }}</p>
</div>

<!-- Jenis Hewan Field -->
<div class="col-sm-12">
    {!! Form::label('jenis_hewan', 'Jenis Hewan:') !!}
    <p>{{ $patient->jenis_hewan }}</p>
</div>

<!-- Jenis Kelamin Field -->
<div class="col-sm-12">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    <p>{{ $patient->jenis_kelamin }}</p>
</div>

<!-- Ras Field -->
<div class="col-sm-12">
    {!! Form::label('ras', 'Ras:') !!}
    <p>{{ $patient->ras }}</p>
</div>

<!-- Tanggal Lahir Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    <p>{{ $patient->tanggal_lahir }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $patient->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $patient->updated_at }}</p>
</div>

