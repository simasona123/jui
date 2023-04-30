@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @role('klien')
                        <h1>Daftar Hewan</h1>
                    @else
                        <h1>Daftar Pasien</h1>
                    @endrole

                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('pasien.create') }}">
                        Tambah
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @include('pasien.table')
            </div>
        </div>
    </div>

@endsection
