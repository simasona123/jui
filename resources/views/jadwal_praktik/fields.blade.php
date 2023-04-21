<!-- Dokter Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dokter_id', 'Dokter Id:') !!}
    {!! Form::text('dokter_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Tanggal Masuk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_masuk', 'Tanggal Masuk:') !!}
    {!! Form::text('tanggal_masuk', null, ['class' => 'form-control','id'=>'tanggal_masuk']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tanggal_masuk').datepicker()
    </script>
@endpush

<!-- Tanggal Selesai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_selesai', 'Tanggal Selesai:') !!}
    {!! Form::text('tanggal_selesai', null, ['class' => 'form-control','id'=>'tanggal_selesai']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tanggal_selesai').datepicker()
    </script>
@endpush

<!-- Ketersediaan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ketersediaan', 'Ketersediaan:') !!}
    {!! Form::number('ketersediaan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control', 'required']) !!}
</div>