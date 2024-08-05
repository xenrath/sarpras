@extends('layouts.app')

@section('title', 'Peminjaman Kendaraan')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Peminjaman Kendaraan</h1>
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
                                                <a href="{{ url('sarpras/hubungi/' . $peminjaman->telp) }}" target="_blank">
                                                    {{ $peminjaman->nama }}
                                                </a>
                                                <hr class="my-2">
                                                {{ Carbon\Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('l, d F') }}
                                                <br>
                                                {{ $peminjaman->jam_awal }}-{{ $peminjaman->jam_akhir }}
                                                <hr class="my-2">
                                                @if ($peminjaman->is_sopir)
                                                    <a href="{{ url('sarpras/hubungi/' . $peminjaman->sopir->telp) }}"
                                                        target="_blank">
                                                        {{ $peminjaman->sopir->nama }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">- bawa sendiri -</span>
                                                @endif
                                                <br>
                                                <span>{{ $peminjaman->kendaraan->nama }}</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button"
                                                    class="btn btn-secondary btn-sm btn-flat btn-block  mb-2"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $peminjaman->id }}">
                                                    Lihat
                                                </button>
                                                @if ($peminjaman->status == 'proses')
                                                    <button type="button" class="btn btn-primary btn-sm btn-flat btn-block"
                                                        data-toggle="modal"
                                                        data-target="#modal-konfirmasi-{{ $peminjaman->id }}">
                                                        Konfirmasi
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
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
    @foreach ($peminjamans as $peminjaman)
        <div class="modal fade show" id="modal-lihat-{{ $peminjaman->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Kembalikan Peminjaman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nama Peminjam</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('sarpras/hubungi/' . $peminjaman->telp) }}" target="_blank">
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
                                {{ $peminjaman->jumlah }}
                                Orang
                            </div>
                        </div>
                        <hr class="my-2">
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
                                    <a href="{{ url('sarpras/hubungi/' . $peminjaman->sopir->telp) }}" target="_blank">
                                        {{ $peminjaman->sopir->nama }}
                                    </a>
                                @else
                                    <span class="text-muted">- bawa sendiri -</span>
                                @endif
                            </div>
                        </div>
                        @if ($peminjaman->status == 'konfirmasi')
                            <div class="alert alert-info rounded-0 mb-2">
                                Menunggu Konfirmasi dari <strong>Ka. Administrasi Umum</strong>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                        @if ($peminjaman->status == 'proses')
                            <button type="submit" class="btn btn-secondary btn-sm btn-flat" data-dismiss="modal"
                                data-toggle="modal"
                                data-target="#modal-kembalikan-{{ $peminjaman->id }}">Kembalikan</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($peminjaman->status == 'proses')
            <div class="modal fade show" id="modal-konfirmasi-{{ $peminjaman->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Konfirmasi Peminjaman</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Konfirmasi Peminjaman dari <strong>{{ $peminjaman->nama }}</strong>?
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                data-dismiss="modal">Batal</button>
                            <form action="{{ url('sarpras/peminjaman-kendaraan/konfirmasi/' . $peminjaman->id) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm btn-flat">Konfirmasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade show" id="modal-kembalikan-{{ $peminjaman->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Kembalikan Peminjaman</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Yakin kembalikan Peminjaman dari <strong>{{ $peminjaman->nama }}</strong>?
                            <br><br>
                            <small class="text-muted">* Peminjaman akan dikembalikan ke <strong>Staf
                                    Sarana</strong></small>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                data-dismiss="modal">Batal</button>
                            <form action="{{ url('sarpras/peminjaman-kendaraan/kembalikan/' . $peminjaman->id) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm btn-flat">Kembalikan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
