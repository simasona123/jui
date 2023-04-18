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

<div class="col-sm-12">
    <label for="roles">Roles</label>
    @foreach ($roles as $item)
        <div class="col-6">
            <input type="checkbox" name="roles[]" value={{$item->id}} disabled
                @if (in_array($item->id, $role))
                    {{ 'checked=checked' }}
                @endif

            >
                {{ucfirst($item->name)}}
            </input>
        </div>
    @endforeach
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $user->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $user->updated_at }}</p>
</div>

