<!-- Patient Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'User ID') !!}
    <p>{{ $user->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<div class="form-group col-sm-6">
    <label for="role">Role</label>
    <p>{{ucwords($role[0])}}</p>
</div>

<div class="form-group col-sm-6">
    <label for="verification">Verifikasi</label>
    <p>{{$user->verification == 1 ? "Terverifikasi" : "Belum Terverifikasi atau Terblokir"}}</p>
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

