@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit Profil 
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            
        <form action="" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <!-- Name Field -->
                    <div class="form-group col-sm-6">
                        <label for="full_name">Nama Lengkap:</label>
                        <input class="form-control" required="" name="full_name" type="text" id="full_name" value="{{$user->full_name}}">
                    </div>
                    <!-- Email Field -->
                    <div class="form-group col-sm-6">
                        <label for="email">Email:</label>
                        <input class="form-control" required="" name="email" type="email" id="email" value="{{$user->email}}">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="phone">Nomor HP:</label>
                        <input class="form-control" name="phone" type="phone" id="phone" value="{{$user->phone}}">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="address">Alamat Rumah:</label>
                        <input class="form-control" name="address" type="address" id="address" value="{{$user->address}}">
                        <div class="warning" style="">Ket: Alamat yang akan dituju saat pemeriksaan</div>
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('password', 'Password:') !!}
                        <input name="password" type="password" value="" id="password" class="form-control required">
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('password_confirmation', 'Password Confirmation:') !!}
                        <input name="password_confirmation" type="password" value="" id="password_cofirmation" class="form-control required">
                    </div> 

                    <div class="form-group col-sm-6">
                        <label for="image">Foto Profil</label> <br>
                        <input type="file" name="image">
                    </div> 

                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('users.index') }}" class="btn btn-default"> Cancel </a>
            </div>
        </form>

        </div>
    </div>
    <style>
        .warning{
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
            position: relative;
            padding: .2rem;
            border: 1px solid transparent;
            border-radius: .25rem;
            margin-top: 5px;
        }
    </style>
@endsection
