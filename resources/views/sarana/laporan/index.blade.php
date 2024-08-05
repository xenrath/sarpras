@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Peminjaman</h1>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Peminjaman</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Peminjam</th>
                                        <th class="text-center" style="width: 100px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($peminjamans as $peminjaman)
                                        <tr>
                                            @php
                                                $tanggal = Carbon\Carbon::now()->format('Y-m-d');
                                                $jam = Carbon\Carbon::now()->format('H:i');
                                            @endphp
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ url('sarana/hubungi/' . $peminjaman->telp) }}" target="_blank">
                                                    {{ $peminjaman->nama }}
                                                </a>
                                                <hr class="my-2">
                                                {{ Carbon\Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('l, d F') }}
                                                <br>
                                                {{ $peminjaman->jam_awal }}-{{ $peminjaman->jam_akhir }}
                                                <hr class="my-2">
                                                @if ($peminjaman->is_sopir)
                                                    <a href="{{ url('sarana/hubungi/' . $peminjaman->sopir->telp) }}"
                                                        target="_blank">
                                                        {{ $peminjaman->sopir->nama }}
                                                    </a>
                                                @endif
                                                <br>
                                                <span>{{ $peminjaman->kendaraan->nama }}</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-detail-{{ $peminjaman->id }}">
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade show" id="modal-detail-{{ $peminjaman->id }}">
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
                                                                <a href="{{ url('sarana/hubungi/' . $peminjaman->telp) }}"
                                                                    target="_blank">
                                                                    {{ $peminjaman->nama }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-md-6">
                                                                <strong>Hari, Tanggal</strong>
                                                            </div>
                                                            <div class="col-md-6">
                                                                {{ Carbon\Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('l, d F') }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-md-6">
                                                                <strong>Jam</strong>
                                                            </div>
                                                            <div class="col-md-6">
                                                                {{ $peminjaman->jam_awal }}-{{ $peminjaman->jam_akhir }}
                                                            </div>
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
                                                        @if ($peminjaman->keperluan == 'tugas')
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Lampiran</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="{{ asset('storage/uploads/' . $peminjaman->lampiran) }}"
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
                                                                {{ $peminjaman->kegiatan }}
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
                                                        @if ($peminjaman->status == 'menunggu')
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Perlu Sopir</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($peminjaman->is_sopir)
                                                                        Ya, Perlu
                                                                    @else
                                                                        Tidak, Bawa Sendiri
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <hr class="mb-2">
                                                        <div class="row mb-2">
                                                            <div class="col-md-6">
                                                                <strong>Kendaraan</strong>
                                                            </div>
                                                            <div class="col-md-6">
                                                                {{ $peminjaman->kendaraan->nama }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-md-6">
                                                                <strong>Sopir</strong>
                                                            </div>
                                                            <div class="col-md-6">
                                                                @if ($peminjaman->is_sopir)
                                                                    <a href="{{ url('sarana/hubungi/' . $peminjaman->sopir->telp) }}"
                                                                        target="_blank">
                                                                        {{ $peminjaman->sopir->nama }}
                                                                    </a>
                                                                @else
                                                                    <small class="text-muted">Bawa Sendiri</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default btn-sm btn-flat"
                                                            data-dismiss="modal">Batal</button>
                                                        <a href="{{ url('sarana/laporan/bukti/' . $peminjaman->id) }}"
                                                            class="btn btn-primary btn-sm btn-flat">Bukti Peminjaman</a>
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
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
@endsection
