@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Ubah Booking
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($booking, ['route' => ['bookings.update', $booking->id], 'method' => 'patch', 'id' => 'upload']) !!}

            <div class="card-body">
                <div class="row">
                    @include('bookings.fields')
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('bookings.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
