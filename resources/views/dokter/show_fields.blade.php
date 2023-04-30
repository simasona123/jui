<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $dokter->user_id }}</p>
</div>

<!-- Spesialis Field -->
<div class="col-sm-12">
    {!! Form::label('spesialis', 'Spesialis:') !!}
    <p>{{ $dokter->spesialis }}</p>
</div>

<!-- Jenis Kelamin Field -->
<div class="col-sm-12">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    <p>{{ $dokter->jenis_kelamin }}</p>
</div>

<!-- Nip Field -->
<div class="col-sm-12">
    {!! Form::label('nip', 'Nip:') !!}
    <p>{{ $dokter->nip }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $dokter->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $dokter->updated_at }}</p>
</div>

