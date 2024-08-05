<li class="nav-item">
    <a href="{{ url('dev') }}" class="nav-link {{ request()->is('dev') ? 'active' : 'bg-secondary' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
<li class="nav-header">Menu</li>
<li class="nav-item">
    <a href="{{ url('dev/peminjaman') }}" class="nav-link {{ request()->is('dev/peminjaman*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Peminjaman</p>
    </a>
</li>
<li class="nav-header">Lainnya</li>
<li class="nav-item">
    <a href="{{ url('dev/user') }}" class="nav-link {{ request()->is('dev/user*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data User</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/sopir') }}" class="nav-link {{ request()->is('dev/sopir*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Sopir</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/kendaraan') }}" class="nav-link {{ request()->is('dev/kendaraan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Kendaraan</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('profile') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
        <i class="nav-icon far fa-user"></i>
        <p>Profile Saya</p>
    </a>
</li>
