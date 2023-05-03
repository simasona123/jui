<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('pasien.index') }}" class="nav-link {{ Request::is('pasien*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-paw"></i>
        @role('klien')
            <p>Daftar Hewan</p>
        @else
            <p>Daftar Pasien</p>
        @endrole
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('bookings.index') }}" class="nav-link {{ Request::is('booking*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book-medical"></i>
        <p>Booking</p>
    </a>
</li>



@role('administrator|manajer')
<li class="nav-item">
    <a href="{{ route('dokter.index') }}" class="nav-link {{ Request::is('dokter*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-stethoscope"></i>
        <p>Dokter</p>
    </a>
</li>
@endrole


@role('administrator|manajer|dokter-hewan')
<li class="nav-item">
    <a href="{{ route('jadwal-praktik.index') }}" class="nav-link {{ Request::is('jadwal-praktik*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>Jadwal Praktik</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('rekamMedis.index') }}" class="nav-link {{ Request::is('rekam-medis*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-notes-medical"></i>
        <p>Rekam Medis</p>
    </a>
</li>
@endrole

@role('dokter-hewan')
@else
<li class="nav-item">
    <a href="{{ route('pembayarans.index') }}" class="nav-link {{ Request::is('pembayaran*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-money-check-alt"></i>
        <p>Pembayaran</p>
    </a>
</li>
@endrole

@role('administrator|manajer')
<li class="nav-item">
    <a href="{{ route('reminders.index') }}" class="nav-link {{ Request::is('reminders*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-exclamation"></i>
        <p>Pengingat</p>
    </a>
</li>
@endrole

<li class="nav-item">
    <a href="/konsultasi" class="nav-link {{ Request::is('pembayaran*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-comments"></i>
        <p>Konsultasi</p>
    </a>
</li>






