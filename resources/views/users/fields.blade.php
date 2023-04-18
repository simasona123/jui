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

<div class="form-group col-12 row">
    <div class="col-12">
        <label for="roles">Roles</label>
    </div>
    @foreach ($roles as $item)
        <div class="col-6">
            <input type="checkbox" name="roles[]" value={{$item->id}}
                @if (in_array($item->id, $role))
                    {{ 'checked=checked' }}
                @endif
            >
                {{ucfirst($item->name)}}
            </input>
        </div>
    @endforeach
</div>

