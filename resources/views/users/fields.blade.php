<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('full_name', 'Full Name:') !!} <span class="required">*</span>
    {!! Form::text('full_name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6"> 
    {!! Form::label('email', 'Email:') !!} <span class="required">*</span>
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!} <span class="required">*</span>
    <input name="password" type="password" id="password" class="form-control required">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Password Confirmation:') !!} <span class="required">*</span>
    <input name="password_confirmation" type="password" id="password_cofirmation" class="form-control required">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!} <span class="required">*</span>
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!} <span class="required">*</span>
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    <label for="role">Role</label> <span class="required">*</span>
    <select class="custom-select" id="inputGroupSelect02" name="role" @if(isset($role)) disabled @endif>
        @if (isset($role))
            @foreach ($roles as $item)
                <option 
                    @if (count($role) > 0)
                        @if ($role[0] == $item->name)
                            selected
                        @endif
                    @endif value="{{$item->id}}"> {{ucwords($item->name)}}
                </option>
            @endforeach
        @else
            <option selected style="color: gray;">Pilih</option>
            @foreach ($roles as $item)
                <option value="{{$item->id}}"> {{ucwords($item->name)}} </option>
            @endforeach
        @endif
    </select>
</div>

<div class="form-group col-sm-4">
    <label for="verification">Verifikasi</label> <span class="required">*</span>
    <select class="custom-select" id="inputGroupSelect02" name="verification">
        @if (isset($user))
            <option @if ($user->verification == 1)
                selected
            @endif value="1">Terverifikasi</option>
            <option @if ($user->verification == 0)
                selected
            @endif value="0">Belum diverifikasi</option>
        @else
            <option style="color: gray;">Pilih</option>
            <option selected  value="1">Benar</option>
            <option value="0">Salah</option>
        @endif
    </select>
</div>

<div class="form-group col-sm-4">
    <label for="blocked">Status</label> <span class="required">*</span>
    <select class="custom-select" id="inputGroupSelect02" name="blocked">
        @if (isset($user))
            <option @if ($user->blocked == 1)
                selected
            @endif value="1">Terblokir</option>
            <option @if ($user->blocked == 0)
                selected
            @endif value="0">Aktif</option>
        @else
            <option selected style="color: gray;">Pilih</option>
            <option value="1">Blokir</option>
            <option selected value="0">Aktif</option>
        @endif
    </select>
</div>

