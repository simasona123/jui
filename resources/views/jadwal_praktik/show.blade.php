@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
Detail Jadwal Praktik
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('jadwal-praktik.index') }}">
                                                   Kembali
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="row">
            @include('jadwal_praktik.show_fields')
        </div>
    </div>
@endsection
