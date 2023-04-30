{!! Form::open(['route' => ['bookings.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('bookings.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('bookings.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @role('dokter-hewan|manajer')
    <a href="{{ 'rekam-medis/jadwal' . '/?kode_booking=' . $kode_booking }}" class='btn btn-default btn-xs'>
        <i class="fa fa-exclamation"></i>
    </a>
    @endrole
</div>
{!! Form::close() !!}
