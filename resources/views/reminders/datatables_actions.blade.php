{!! Form::open(['route' => ['reminders.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    {{-- <a href="{{ route('reminders.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i><br>Lihat
    </a> --}}
    {{-- <a href="{{ route('reminders.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a> --}}
    {!! Form::button('<i class="fa fa-trash"></i><br>Hapus', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

    ]) !!}
</div>
{!! Form::close() !!}
