@extends('peminjaman.app')

@section('title', 'Peminjaman SARPRAS')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <h1>Peminjaman SARPRAS</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail Peminjaman</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Nama Peminjam</strong>
                                    </div>
                                    <div class="col-md-6">{{ $peminjaman->nama }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Kategori</strong>
                                    </div>
                                    <div class="col-md-6">Peminjaman {{ ucfirst($peminjaman->kategori) }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Keperluan</strong>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($peminjaman->keperluan == 'pribadi')
                                            Pribadi
                                        @elseif ($peminjaman->keperluan == 'tugas')
                                            Tugas Kantor
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Lampiran</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="" class="btn btn-secondary btn-xs btn-flat">
                                            <i class="fas fa-download"></i>
                                            Unduh
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Uraian Kegiatan</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $peminjaman->kegiatan }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Waktu</strong>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($peminjaman->tanggal_awal == $peminjaman->tanggal_akhir)
                                            {{ Carbon\Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('d F') }},
                                        @else
                                            {{ Carbon\Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('d F') }}-{{ Carbon\Carbon::parse($peminjaman->tanggal_akhir)->translatedFormat('d F') }},
                                        @endif
                                        {{ $peminjaman->jam_awal }}-{{ $peminjaman->jam_akhir }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Tempat / Tujuan</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $peminjaman->keterangan }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Jumlah Penumpang</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $peminjaman->jumlah }} Orang
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Perlu Sopir?</strong>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($peminjaman->is_sopir)
                                            Ya Perlu
                                        @else
                                            Bawa Sendiri
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-2">
                                @if ($peminjaman->status != 'menunggu')
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <strong>Kendaraan</strong>
                                        </div>
                                        <div class="col-md-6">
                                            {{ $peminjaman->kendaraan->nama }}
                                        </div>
                                    </div>
                                    @if ($peminjaman->is_sopir)
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <strong>Sopir</strong>
                                            </div>
                                            <div class="col-md-6">
                                                {{ $peminjaman->sopir->nama }}
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if ($peminjaman->status == 'menunggu')
                                    <div class="alert alert-info alert-dismissible mb-2">
                                        <h5>
                                            <i class="icon fas fa-clock"></i>
                                            Tahap 1
                                        </h5>
                                        Menunggu konfirmasi dari
                                        <br class="d-block d-md-none">
                                        <strong>Staf Sarana</strong>
                                    </div>
                                @endif
                                @if ($peminjaman->status == 'proses')
                                    <div class="alert alert-info alert-dismissible mb-2">
                                        <h5>
                                            <i class="icon fas fa-clock"></i>
                                            Tahap 2
                                        </h5>
                                        Menunggu konfirmasi dari
                                        <br class="d-block d-md-none">
                                        <strong>Pjs. Sarpras</strong>
                                    </div>
                                @endif
                                @if ($peminjaman->status == 'konfirmasi')
                                    <div class="alert alert-info alert-dismissible mb-2">
                                        <h5>
                                            <i class="icon fas fa-clock"></i>
                                            Tahap 3
                                        </h5>
                                        Menunggu konfirmasi dari
                                        <br class="d-block d-md-none">
                                        <strong>Ka. Administrasi Umum</strong>
                                    </div>
                                @endif
                                @if ($peminjaman->status == 'selesai')
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <strong>Bukti Peminjaman</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary btn-sm btn-flat">
                                                <i class="fas fa-download"></i>
                                                Unduh
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
