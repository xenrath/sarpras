@extends('peminjaman.app')

@section('title', 'Peminjaman Sarpras')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <a href="{{ url('peminjaman') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Peminjaman Sarpras</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Peminjaman</h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-end">
                            <div class="col-md-4">
                                <form action="{{ url('peminjaman/list') }}" method="get">
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control rounded-0" name="tanggal"
                                            min="{{ date('Y-m-d') }}"
                                            value="{{ request()->get('tanggal') ?? date('Y-m-d') }}">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary btn-flat">Cari</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @php
                            if (
                                !session('kendaraan') &&
                                !session('ruang') &&
                                !session('gedung') &&
                                !session('barang')
                            ) {
                                $is_link = 'active';
                                $is_content = 'show active';
                            } else {
                                $is_link = '';
                                $is_content = '';
                            }
                        @endphp
                        <ul class="nav nav-fill nav-pills row mb-2" id="custom-content-above-tab" role="tablist">
                            <li class="nav-item col-6 col-md-3 mb-2">
                                <a class="nav-link border rounded-0 {{ session('kendaraan') ? 'active' : '' }} {{ $is_link }}"
                                    id="custom-content-kendaraan-tab" data-toggle="pill" href="#custom-content-kendaraan"
                                    role="tab" aria-controls="custom-content-kendaraan"
                                    aria-selected="true">Kendaraan</a>
                            </li>
                            <li class="nav-item col-6 col-md-3 mb-2">
                                <a class="nav-link border rounded-0 {{ session('ruang') ? 'active' : '' }}"
                                    id="custom-content-ruang-tab" data-toggle="pill" href="#custom-content-ruang"
                                    role="tab" aria-controls="custom-content-ruang" aria-selected="false">Ruang</a>
                            </li>
                            <li class="nav-item col-6 col-md-3 mb-2">
                                <a class="nav-link border rounded-0 {{ session('gedung') ? 'active' : '' }}"
                                    id="custom-content-gedung-tab" data-toggle="pill" href="#custom-content-gedung"
                                    role="tab" aria-controls="custom-content-gedung" aria-selected="false">Gedung</a>
                            </li>
                            <li class="nav-item col-6 col-md-3 mb-2">
                                <a class="nav-link border rounded-0 {{ session('barang') ? 'active' : '' }}"
                                    id="custom-content-barang-tab" data-toggle="pill" href="#custom-content-barang"
                                    role="tab" aria-controls="custom-content-barang" aria-selected="false">Barang</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="tab-pane fade {{ session('kendaraan') ? 'show active' : '' }} {{ $is_content }}"
                                id="custom-content-kendaraan" role="tabpanel"
                                aria-labelledby="custom-content-kendaraan-tab">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px">No</th>
                                            <th>Peminjam</th>
                                            <th class="text-center" style="width: 40px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kendaraans as $kendaraan)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($kendaraan->tanggal_awal)->translatedFormat('l, d F') }}
                                                    <br>
                                                    {{ $kendaraan->jam_awal }}-{{ $kendaraan->jam_akhir }} WIB
                                                    <hr class="my-2">
                                                    {{ $kendaraan->nama }}
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm btn-flat"
                                                        data-toggle="modal"
                                                        data-target="#modal-detail-{{ $kendaraan->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade show" id="modal-detail-{{ $kendaraan->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Detail Peminjaman</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Nama Peminjam</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $kendaraan->nama }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Hari, Tanggal</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ Carbon\Carbon::parse($kendaraan->tanggal_awal)->translatedFormat('l, d F') }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Jam</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $kendaraan->jam_awal }}-{{ $kendaraan->jam_akhir }}
                                                                    WIB
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Keperluan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($kendaraan->keperluan == 'pribadi')
                                                                        Pribadi
                                                                    @elseif ($kendaraan->keperluan == 'tugas')
                                                                        Tugas Kantor
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if ($kendaraan->keperluan == 'tugas')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Lampiran</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <a href="{{ asset('storage/uploads/' . $kendaraan->lampiran) }}"
                                                                            class="btn btn-secondary btn-xs btn-flat"
                                                                            target="_blank">
                                                                            <i class="fas fa-download"></i>
                                                                            Unduh
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Uraian Kegiatan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $kendaraan->kegiatan }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Tempat / Tujuan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $kendaraan->keterangan }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Jumlah Penumpang</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $kendaraan->jumlah }} Orang
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Perlu Sopir</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($kendaraan->is_sopir)
                                                                        Ya, Perlu
                                                                    @else
                                                                        Tidak, Bawa Sendiri
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if ($kendaraan->status != 'menunggu')
                                                                <hr class="my-2">
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Kendaraan</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        {{ $kendaraan->kendaraan->nama }}
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Sopir</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @if ($kendaraan->is_sopir)
                                                                            {{ $kendaraan->sopir->nama }}
                                                                        @else
                                                                            <small class="text-muted">Bawa Sendiri</small>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($kendaraan->status == 'menunggu')
                                                                <div class="alert alert-info rounded-0 mb-2">
                                                                    Menunggu konfirmasi dari
                                                                    <br class="d-block d-md-none">
                                                                    <strong>Staf Sarana</strong>
                                                                </div>
                                                            @endif
                                                            @if ($kendaraan->status == 'proses')
                                                                <div class="alert alert-info rounded-0 mb-2">
                                                                    Menunggu konfirmasi dari
                                                                    <br class="d-block d-md-none">
                                                                    <strong>Pjs. Sarpras</strong>
                                                                </div>
                                                            @endif
                                                            @if ($kendaraan->status == 'konfirmasi')
                                                                <div class="alert alert-info rounded-0 mb-2">
                                                                    Menunggu konfirmasi dari
                                                                    <br class="d-block d-md-none">
                                                                    <strong>Ka. Administrasi Umum</strong>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                                                data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <span class="text-muted">- Data peminjaman kosong -</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade {{ session('ruang') ? 'show active' : '' }}"
                                id="custom-content-ruang" role="tabpanel" aria-labelledby="custom-content-ruang-tab">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px">No</th>
                                            <th>Peminjam</th>
                                            <th class="text-center" style="width: 40px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($ruangs as $ruang)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($ruang->tanggal_awal)->translatedFormat('l, d F') }}
                                                    <br>
                                                    {{ $ruang->jam_awal }}-{{ $ruang->jam_akhir }}
                                                    <hr class="my-2">
                                                    {{ $ruang->nama }}
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm btn-flat"
                                                        data-toggle="modal"
                                                        data-target="#modal-detail-{{ $ruang->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade show" id="modal-detail-{{ $ruang->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Detail Peminjaman</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Nama Peminjam</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $ruang->nama }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Hari, Tanggal</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ Carbon\Carbon::parse($ruang->tanggal_awal)->translatedFormat('l, d F') }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Jam</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $ruang->jam_awal }}-{{ $ruang->jam_akhir }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Keperluan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($ruang->keperluan == 'pribadi')
                                                                        Pribadi
                                                                    @elseif ($ruang->keperluan == 'tugas')
                                                                        Tugas Kantor
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if ($ruang->keperluan == 'tugas')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Lampiran</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <a href="{{ asset('storage/uploads/' . $ruang->lampiran) }}"
                                                                            class="btn btn-secondary btn-xs btn-flat"
                                                                            target="_blank">
                                                                            <i class="fas fa-download"></i>
                                                                            Unduh
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Uraian Kegiatan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $ruang->kegiatan }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Tempat / Tujuan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $ruang->keterangan }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Jumlah Penumpang</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $ruang->jumlah }} Orang
                                                                </div>
                                                            </div>
                                                            @if ($ruang->status == 'menunggu')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Perlu Sopir</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @if ($ruang->is_sopir)
                                                                            Ya, Perlu
                                                                        @else
                                                                            Tidak, Bawa Sendiri
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($ruang->status != 'menunggu')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Sopir</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @if ($ruang->is_sopir)
                                                                            <a href="{{ url('sarana/hubungi/' . $ruang->sopir->telp) }}"
                                                                                target="_blank">
                                                                                {{ $ruang->sopir->nama }}
                                                                            </a>
                                                                        @else
                                                                            <small class="text-muted">Bawa Sendiri</small>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Kendaraan</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        {{ $ruang->ruang->nama }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Status</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($ruang->status == 'menunggu')
                                                                        <span class="text-muted">
                                                                            Menunggu Konfirmasi dari
                                                                            <br>
                                                                            <strong>Staf Sarana</strong>
                                                                        </span>
                                                                    @elseif ($ruang->status == 'proses')
                                                                        <span class="text-muted">
                                                                            Menunggu Konfirmasi dari
                                                                            <br>
                                                                            <strong>Pjs. Sarpras</strong>
                                                                        </span>
                                                                    @elseif ($ruang->status == 'konfirmasi')
                                                                        <span class="text-muted">
                                                                            Menunggu Konfirmasi dari
                                                                            <br>
                                                                            <strong>Ka. Administrasi Umum</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                                                data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <span class="text-muted">- Data peminjaman kosong -</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade {{ session('gedung') ? 'show active' : '' }}"
                                id="custom-content-gedung" role="tabpanel" aria-labelledby="custom-content-gedung-tab">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px">No</th>
                                            <th>Peminjam</th>
                                            <th class="text-center" style="width: 40px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($gedungs as $gedung)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($gedung->tanggal_awal)->translatedFormat('l, d F') }}
                                                    <br>
                                                    {{ $gedung->jam_awal }}-{{ $gedung->jam_akhir }}
                                                    <hr class="my-2">
                                                    {{ $gedung->nama }}
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm btn-flat"
                                                        data-toggle="modal"
                                                        data-target="#modal-detail-{{ $gedung->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade show" id="modal-detail-{{ $gedung->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Detail Peminjaman</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Nama Peminjam</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $gedung->nama }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Hari, Tanggal</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ Carbon\Carbon::parse($gedung->tanggal_awal)->translatedFormat('l, d F') }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Jam</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $gedung->jam_awal }}-{{ $gedung->jam_akhir }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Keperluan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($gedung->keperluan == 'pribadi')
                                                                        Pribadi
                                                                    @elseif ($gedung->keperluan == 'tugas')
                                                                        Tugas Kantor
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if ($gedung->keperluan == 'tugas')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Lampiran</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <a href="{{ asset('storage/uploads/' . $gedung->lampiran) }}"
                                                                            class="btn btn-secondary btn-xs btn-flat"
                                                                            target="_blank">
                                                                            <i class="fas fa-download"></i>
                                                                            Unduh
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Uraian Kegiatan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $gedung->kegiatan }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Tempat / Tujuan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $gedung->keterangan }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Jumlah Penumpang</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $gedung->jumlah }} Orang
                                                                </div>
                                                            </div>
                                                            @if ($gedung->status == 'menunggu')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Perlu Sopir</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @if ($gedung->is_sopir)
                                                                            Ya, Perlu
                                                                        @else
                                                                            Tidak, Bawa Sendiri
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($gedung->status != 'menunggu')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Sopir</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @if ($gedung->is_sopir)
                                                                            <a href="{{ url('sarana/hubungi/' . $gedung->sopir->telp) }}"
                                                                                target="_blank">
                                                                                {{ $gedung->sopir->nama }}
                                                                            </a>
                                                                        @else
                                                                            <small class="text-muted">Bawa Sendiri</small>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Kendaraan</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        {{ $gedung->gedung->nama }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Status</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($gedung->status == 'menunggu')
                                                                        <span class="text-muted">
                                                                            Menunggu Konfirmasi dari
                                                                            <br>
                                                                            <strong>Staf Sarana</strong>
                                                                        </span>
                                                                    @elseif ($gedung->status == 'proses')
                                                                        <span class="text-muted">
                                                                            Menunggu Konfirmasi dari
                                                                            <br>
                                                                            <strong>Pjs. Sarpras</strong>
                                                                        </span>
                                                                    @elseif ($gedung->status == 'konfirmasi')
                                                                        <span class="text-muted">
                                                                            Menunggu Konfirmasi dari
                                                                            <br>
                                                                            <strong>Ka. Administrasi Umum</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                                                data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <span class="text-muted">- Data peminjaman kosong -</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade {{ session('barang') ? 'show active' : '' }}"
                                id="custom-content-barang" role="tabpanel" aria-labelledby="custom-content-barang-tab">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px">No</th>
                                            <th>Peminjam</th>
                                            <th class="text-center" style="width: 40px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($barangs as $barang)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($barang->tanggal_awal)->translatedFormat('l, d F') }}
                                                    <br>
                                                    {{ $barang->jam_awal }}-{{ $barang->jam_akhir }}
                                                    <hr class="my-2">
                                                    {{ $barang->nama }}
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm btn-flat"
                                                        data-toggle="modal"
                                                        data-target="#modal-detail-{{ $barang->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade show" id="modal-detail-{{ $barang->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Detail Peminjaman</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Nama Peminjam</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $barang->nama }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Hari, Tanggal</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ Carbon\Carbon::parse($barang->tanggal_awal)->translatedFormat('l, d F') }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Jam</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $barang->jam_awal }}-{{ $barang->jam_akhir }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Keperluan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($barang->keperluan == 'pribadi')
                                                                        Pribadi
                                                                    @elseif ($barang->keperluan == 'tugas')
                                                                        Tugas Kantor
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if ($barang->keperluan == 'tugas')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Lampiran</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <a href="{{ asset('storage/uploads/' . $barang->lampiran) }}"
                                                                            class="btn btn-secondary btn-xs btn-flat"
                                                                            target="_blank">
                                                                            <i class="fas fa-download"></i>
                                                                            Unduh
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Uraian Kegiatan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $barang->kegiatan }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Tempat / Tujuan</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $barang->keterangan }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Jumlah Penumpang</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{ $barang->jumlah }} Orang
                                                                </div>
                                                            </div>
                                                            @if ($barang->status == 'menunggu')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Perlu Sopir</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @if ($barang->is_sopir)
                                                                            Ya, Perlu
                                                                        @else
                                                                            Tidak, Bawa Sendiri
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($barang->status != 'menunggu')
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Sopir</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @if ($barang->is_sopir)
                                                                            <a href="{{ url('sarana/hubungi/' . $barang->sopir->telp) }}"
                                                                                target="_blank">
                                                                                {{ $barang->sopir->nama }}
                                                                            </a>
                                                                        @else
                                                                            <small class="text-muted">Bawa Sendiri</small>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Kendaraan</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        {{ $barang->barang->nama }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Status</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($barang->status == 'menunggu')
                                                                        <span class="text-muted">
                                                                            Menunggu Konfirmasi dari
                                                                            <br>
                                                                            <strong>Staf Sarana</strong>
                                                                        </span>
                                                                    @elseif ($barang->status == 'proses')
                                                                        <span class="text-muted">
                                                                            Menunggu Konfirmasi dari
                                                                            <br>
                                                                            <strong>Pjs. Sarpras</strong>
                                                                        </span>
                                                                    @elseif ($barang->status == 'konfirmasi')
                                                                        <span class="text-muted">
                                                                            Menunggu Konfirmasi dari
                                                                            <br>
                                                                            <strong>Ka. Administrasi Umum</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                                                data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <span class="text-muted">- Data peminjaman kosong -</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
