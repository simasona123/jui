{!! Form::open(['route' => ['dokter.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('dokter.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i><br>Lihat
    </a>
    <a href="{{ route('dokter.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i><br>Ubah
    </a>
    {!! Form::button('<i class="fa fa-trash"></i><br>Hapus', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'
    ]) !!}
</div>
{!! Form::close() !!}
