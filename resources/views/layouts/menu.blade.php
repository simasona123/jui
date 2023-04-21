<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>


@role('administrator|manajer|dokter-hewan')
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



<li class="nav-item">
    <a href="{{ route('jadwal-praktik.index') }}" class="nav-link {{ Request::is('jadwal-praktik*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Jadwal Praktik</p>
    </a>
</li>
