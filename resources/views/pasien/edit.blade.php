@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit Pasien
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($pasien, ['route' => ['pasien.update', $pasien->id], 'method' => 'patch', 'enctype'=>"multipart/form-data"]) !!}

            <div class="card-body">
                <div class="row">
                    @include('pasien.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('pasien.index') }}" class="btn btn-default"> Batal </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
