@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Tagihan</h1>
                </div>
                @role('administrator|manajer|dokter-hewan')
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('pembayarans.create') }}">
                        Tambah
                    </a>
                </div>
                @endrole
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('pembayarans.table')
        </div>
    </div>

@endsection
