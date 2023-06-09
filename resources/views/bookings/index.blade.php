@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Booking</h1>
                </div>
                @role('dokter-hewan')
                @else
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('bookings.create') }}">
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
            @include('bookings.table')
        </div>
    </div>

@endsection
