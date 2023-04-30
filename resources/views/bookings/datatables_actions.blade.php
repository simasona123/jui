{!! Form::open(['route' => ['bookings.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group' style="">
    <a href="{{ route('bookings.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i><br>Lihat
    </a>
    <a href="{{ route('bookings.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i><br>Ubah
    </a>
    @role('dokter-hewan|manajer')
    <a href="{{ 'rekam-medis/jadwal' . '/?kode_booking=' . $kode_booking }}" class='btn btn-default btn-xs'>
        <i class="fa fa-exclamation"></i><br>Medis
    </a>
    @endrole
</div>
{!! Form::close() !!}
