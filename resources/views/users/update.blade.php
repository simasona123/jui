@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit User
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
                        <label for="name">Name:</label>
                        <input class="form-control" required="" name="name" type="text" id="name" value="{{$user->name}}">
                    </div>
                    <!-- Email Field -->
                    <div class="form-group col-sm-6">
                        <label for="email">Email:</label>
                        <input class="form-control" required="" name="email" type="email" id="email" value="{{$user->email}}">
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
@endsection
