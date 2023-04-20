<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>


@role('administrator|manajer')
<li class="nav-item">
    <a href="{{ route('pasien.index') }}" class="nav-link {{ Request::is('pasiens*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Pasien</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('dokter.index') }}" class="nav-link {{ Request::is('dokters*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dokters</p>
    </a>
</li>
@endrole


