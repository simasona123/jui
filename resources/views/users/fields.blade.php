<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
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
    <label for="role">Role</label>
    <select class="custom-select" id="inputGroupSelect02" name="role">
        <option 
            @if (count($role) == 0)
                selected
            @endif style="color: gray;">
            Pilih
        </option>
        @foreach ($roles as $item)
            <option 
            @if (count($role) > 0)
                @if ($role[0] == $item->name)
                    selected
                @endif
            @endif value="{{$item->id}}">{{ucwords($item->name)}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    <label for="verification">Verifikasi</label>
    <select class="custom-select" id="inputGroupSelect02" name="verification">
        @if (isset($user))
            <option @if ($user->verification == 1)
                selected
            @endif value="1">Terverifikasi</option>
            <option @if ($user->verification == 0)
                selected
            @endif value="0">Belum diverifikasi</option>
        @else
            <option selected style="color: gray;">Pilih</option>
            <option value="1">Benar</option>
            <option value="0">Salah</option>
        @endif
    </select>
</div>

