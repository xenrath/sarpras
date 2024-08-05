<li class="nav-item">
    <a href="{{ url('sarana') }}" class="nav-link {{ request()->is('sarana') ? 'active' : 'bg-secondary' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
@php
    $kendaraan = \App\Models\Peminjaman::where('kategori', 'kendaraan')->where('status', 'menunggu')->count();
@endphp
<li class="nav-header">Data Peminjaman</li>
<li class="nav-item">
    <a href="{{ url('sarana/peminjaman-kendaraan') }}"
        class="nav-link {{ request()->is('sarana/peminjaman-kendaraan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Kendaraan
            @if ($kendaraan)
                <span class="right badge badge-info">{{ $kendaraan }}</span>
            @endif
        </p>
    </a>
</li>
<li class="nav-header">Laporan</li>
<li class="nav-item">
    <a href="{{ url('sarana/laporan') }}" class="nav-link {{ request()->is('sarana/laporan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Laporan Peminjaman</p>
    </a>
</li>
<li class="nav-header">Lainnya</li>
<li class="nav-item">
    <a href="{{ url('sarana/sopir') }}" class="nav-link {{ request()->is('sarana/sopir*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Sopir</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('sarana/kendaraan') }}" class="nav-link {{ request()->is('sarana/kendaraan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Kendaraan</p>
    </a>
</li>
