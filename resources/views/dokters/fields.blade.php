<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Spesialis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('spesialis', 'Spesialis:') !!}
    {!! Form::text('spesialis', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Kelamin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    {!! Form::select('jenis_kelamin', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Nip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nip', 'Nip:') !!}
    {!! Form::text('nip', null, ['class' => 'form-control']) !!}
</div>