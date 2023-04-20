<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Nama Hewan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_hewan', 'Nama Hewan:') !!}
    {!! Form::text('nama_hewan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Jenis Hewan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_hewan', 'Jenis Hewan:') !!}
    {!! Form::text('jenis_hewan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Jenis Kelamin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    {!! Form::select('jenis_kelamin', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Ras Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ras', 'Ras:') !!}
    {!! Form::text('ras', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Tanggal Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::text('tanggal_lahir', null, ['class' => 'form-control','id'=>'tanggal_lahir']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tanggal_lahir').datepicker()
    </script>
@endpush