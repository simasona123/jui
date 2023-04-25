<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>


@role('administrator|manajer|dokter-hewan|klien')
<li class="nav-item">
    <a href="{{ route('pasien.index') }}" class="nav-link {{ Request::is('pasien*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Pasien</p>
    </a>
</li>
@endrole

@role('administrator|manajer')
<li class="nav-item">
    <a href="{{ route('dokter.index') }}" class="nav-link {{ Request::is('dokter*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dokter</p>
    </a>
</li>
@endrole


@role('administrator|manajer')
<li class="nav-item">
    <a href="{{ route('jadwal-praktik.index') }}" class="nav-link {{ Request::is('jadwal-praktik*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Jadwal Praktik</p>
    </a>
</li>
@endrole

<li class="nav-item">
    <a href="{{ route('bookings.index') }}" class="nav-link {{ Request::is('bookings*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Booking</p>
    </a>
</li>

@role('administrator|manajer')
<li class="nav-item">
    <a href="{{ route('rekamMedis.index') }}" class="nav-link {{ Request::is('rekamMedis*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Rekam Medis</p>
    </a>
</li>
@endrole
