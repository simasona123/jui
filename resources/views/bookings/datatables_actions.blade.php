{!! Form::open(['route' => ['bookings.destroy', $booking_id], 'method' => 'delete']) !!}
<div class='btn-group' style="">
    <a href="{{ route('bookings.show', $booking_id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i><br>Lihat
    </a>
    <a href="{{ 'rekam-medis/jadwal' . '/?kode_booking=' . $kode_booking }}" class='btn btn-default btn-xs'>
        <i class="fa fa-exclamation"></i><br>Medis
    </a>
    @role('manajer')
    <a href="{{ route('bookings.edit', $booking_id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i><br>Ubah
    </a>
    @endrole
</div>
{!! Form::close() !!}
