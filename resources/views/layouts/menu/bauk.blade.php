<li class="nav-item">
    <a href="{{ url('bauk') }}" class="nav-link {{ request()->is('bauk') ? 'active' : 'bg-secondary' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
@php
    $kendaraan = \App\Models\Peminjaman::where('kategori', 'kendaraan')->where('status', 'konfirmasi')->count();
    $ruang = \App\Models\Peminjaman::where('kategori', 'ruang')->where('status', 'konfirmasi')->count();
    $gedung = \App\Models\Peminjaman::where('kategori', 'gedung')->where('status', 'konfirmasi')->count();
    $barang = \App\Models\Peminjaman::where('kategori', 'barang')->where('status', 'konfirmasi')->count();
@endphp
<li class="nav-header">Data Peminjaman</li>
<li class="nav-item">
    <a href="{{ url('bauk/peminjaman-kendaraan') }}"
        class="nav-link {{ request()->is('bauk/peminjaman-kendaraan*') ? 'active' : '' }}">
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
    <a href="{{ url('bauk/ruang') }}" class="nav-link {{ request()->is('bauk/ruang*') ? 'active' : '' }}">
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
    <a href="{{ url('bauk/gedung') }}" class="nav-link {{ request()->is('bauk/gedung*') ? 'active' : '' }}">
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
    <a href="{{ url('bauk/barang') }}" class="nav-link {{ request()->is('bauk/barang*') ? 'active' : '' }}">
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
    <a href="{{ url('bauk/laporan') }}" class="nav-link {{ request()->is('bauk/laporan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Laporan Peminjaman</p>
    </a>
</li>