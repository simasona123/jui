<!-- Dokter Id Field -->
<div class="col-sm-12">
    {!! Form::label('dokter_id', 'Dokter Id:') !!}
    <p>{{ $reminder->dokter_id }}</p>
</div>

<!-- Klien Id Field -->
<div class="col-sm-12">
    {!! Form::label('klien_id', 'Klien Id:') !!}
    <p>{{ $reminder->klien_id }}</p>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{{ $reminder->keterangan }}</p>
</div>

<!-- Tanggal Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal', 'Tanggal:') !!}
    <p>{{ $reminder->tanggal }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $reminder->status }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $reminder->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $reminder->updated_at }}</p>
</div>

