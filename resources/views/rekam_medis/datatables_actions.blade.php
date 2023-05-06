{!! Form::open(['route' => ['rekamMedis.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('rekamMedis.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i><br>Lihat
    </a>
    @role('manajer|dokter-hewan')
    <a href="{{ route('rekamMedis.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i><br>Edit
    </a>
    {!! Form::button('<i class="fa fa-trash"></i><br>Hapus', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

    ]) !!}
    @endrole
</div>
{!! Form::close() !!}
