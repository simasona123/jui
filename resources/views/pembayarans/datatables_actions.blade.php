<div class='btn-group'>
    <a href="{{ route('pembayarans.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i><br>Lihat
    </a>
    <a href="{{ route('pembayarans.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i><br>Edit
    </a>
    @role('administrator|manajer')
        {!! Form::open(['route' => ['pembayarans.destroy', $id], 'method' => 'delete']) !!}
            {!! Form::button('<i class="fa fa-trash"></i><br>Hapus', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-xs',
                'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

            ]) !!}
        {!! Form::close() !!}
    @endrole
</div>
