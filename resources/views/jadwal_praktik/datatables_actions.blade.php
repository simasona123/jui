<div class='btn-group'>
    <a href="{{ route('jadwal-praktik.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    @role('administrator|manajer')
        {!! Form::open(['route' => ['jadwal-praktik.destroy', $id], 'method' => 'delete']) !!}

        <a href="{{ route('jadwal-praktik.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

        ]) !!}
        {!! Form::close() !!}
    @endrole
   
</div>
