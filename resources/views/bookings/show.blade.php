@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Detail Booking
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('bookings.index') }}">
                                                    Kembali
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="row">
            @include('bookings.show_fields')
        </div>
    </div>
@endsection
