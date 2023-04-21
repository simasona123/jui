<!-- Patient Id Field -->
<div class="col-sm-12 d-flex flex-row justify-content-between align-items-center">
    <div class="d-flex flex-row">
        {!! Form::label('id', 'User ID') !!}
        <p style="margin-left: 10px">{{ $user->id }}</p>
    </div>
    <div class="form-group d-flex flex-row align-items-center">
        <p @if ($user->verification == 1)
                class="badge badge-info" 
            @else
                class="badge badge-warning"
        @endif>{{$user->verification == 1 ? "Terverifikasi" : "Belum Terverifikasi"}}</p>
        <p style="margin-left: 5px;" 
        @if ($user->blocked == 0)
            class="badge badge-success" 
        @else
            class="badge badge-danger"
        @endif>{{$user->blocked == 1 ? "Terblokir" : "Aktif"}}</p>
    </div>
</div>

<!-- Name Field -->
<div class="col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $user->full_name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-4">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<div class="col-sm-4">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{{ $user->phone }}</p>
</div>

<div class="form-group col-sm-12">
    <label for="role">Role:</label>
    <p>{{ucwords($role[0])}}</p>
</div>

<div class="form-group col-sm-12">
    <label for="address">Alamat:</label>
    <p>{{$user->address}}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $user->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $user->updated_at }}</p>
</div>

<style>
    .badge{
        padding: .5em;
        margin-bottom: 0px;
    }
</style>

