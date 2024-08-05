<li class="nav-item">
    <a href="{{ url('sarpras') }}" class="nav-link {{ request()->is('sarpras') ? 'active' : 'bg-secondary' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
@php
    $kendaraan = \App\Models\Peminjaman::where('kategori', 'kendaraan')->where('status', 'proses')->count();
    $ruang = \App\Models\Peminjaman::where('kategori', 'ruang')->where('status', 'proses')->count();
    $gedung = \App\Models\Peminjaman::where('kategori', 'gedung')->where('status', 'proses')->count();
    $barang = \App\Models\Peminjaman::where('kategori', 'barang')->where('status', 'proses')->count();
@endphp
<li class="nav-header">Data Peminjaman</li>
<li class="nav-item">
    <a href="{{ url('sarpras/peminjaman-kendaraan') }}"
        class="nav-link {{ request()->is('sarpras/peminjaman-kendaraan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Kendaraan
            @if ($kendaraan)
                <span class="right badge badge-info">{{ $kendaraan }}</span>
            @endif
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('sarpras/ruang') }}" class="nav-link {{ request()->is('sarpras/ruang*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Ruang
            @if ($ruang)
                <span class="right badge badge-info">{{ $ruang }}</span>
            @endif
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('sarpras/gedung') }}" class="nav-link {{ request()->is('sarpras/gedung*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Gedung
            @if ($gedung)
                <span class="right badge badge-info">{{ $gedung }}</span>
            @endif
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('sarpras/barang') }}" class="nav-link {{ request()->is('sarpras/barang*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Barang
            @if ($barang)
                <span class="right badge badge-info">{{ $barang }}</span>
            @endif
        </p>
    </a>
</li>
<li class="nav-header">Laporan</li>
<li class="nav-item">
    <a href="{{ url('sarpras/laporan') }}" class="nav-link {{ request()->is('sarpras/laporan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Laporan Peminjaman</p>
    </a>
</li>
<li class="nav-header">Lainnya</li>
<li class="nav-item">
    <a href="{{ url('sarpras/sopir') }}" class="nav-link {{ request()->is('sarpras/sopir*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Sopir</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('sarpras/kendaraan') }}"
        class="nav-link {{ request()->is('sarpras/kendaraan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Kendaraan</p>
    </a>
</li>
