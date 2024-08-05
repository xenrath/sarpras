@extends('layouts.app')

@section('title', 'Peminjaman Kendaraan')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('sarana/peminjaman-kendaraan') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Peminjaman Kendaraan</h1>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail Peminjaman</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Nama Peminjam</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ url('sarana/hubungi/' . $peminjaman->telp) }}" target="_blank">
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
                                                class="btn btn-secondary btn-xs btn-flat" target="_blank">
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
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"
                                    data-toggle="modal" data-target="#modal-batal">Batalkan Peminjaman</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Konfirmasi Peminjaman</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ url('sarana/peminjaman-kendaraan/konfirmasi/' . $peminjaman->id) }}"
                                method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <label for="kategori">Waktu Peminjaman</label>
                                        <br>
                                        {{ Carbon\Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('l, d F') }}
                                        <strong>|</strong>
                                        {{ $peminjaman->jam_awal }}-{{ $peminjaman->jam_akhir }}
                                        <button type="button" class="btn btn-warning btn-sm btn-flat" data-toggle="modal"
                                            data-target="#modal-waktu">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="kendaraan_id">
                                            Kendaraan
                                            <small class="text-muted">(kapasitas)</small>
                                        </label>
                                        <select class="custom-select rounded-0 @error('kendaraan_id') is-invalid @enderror"
                                            id="kendaraan_id" name="kendaraan_id">
                                            <option value="">- Pilih -</option>
                                            @foreach ($kendaraans as $kendaraan)
                                                <option value="{{ $kendaraan->id }}"
                                                    {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>
                                                    {{ $kendaraan->nama }}
                                                    ({{ $kendaraan->kapasitas }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kendaraan_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    @if ($peminjaman->is_sopir)
                                        <div class="form-group mb-2">
                                            <label for="sopir_id">Sopir</label>
                                            <select class="custom-select rounded-0 @error('sopir_id') is-invalid @enderror"
                                                id="sopir_id" name="sopir_id">
                                                <option value="">- Pilih -</option>
                                                @foreach ($sopirs as $sopir)
                                                    <option value="{{ $sopir->id }}"
                                                        {{ old('sopir_id') == $sopir->id ? 'selected' : '' }}>
                                                        {{ $sopir->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('sopir_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    @endif
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade show" id="modal-batal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Batalkan Peminjaman</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('sarana/peminjaman-kendaraan/' . $peminjaman->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        Yakin batalkan Peminjaman Kendaraan dari <strong>{{ $peminjaman->nama }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger btn-sm btn-flat">Batalkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade show" id="modal-waktu">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Peminjaman</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('sarana/peminjaman-kendaraan/' . $peminjaman->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="tanggal_awal">Tanggal Pinjam</label>
                            <input type="date" class="form-control rounded-0" id="tanggal_awal" name="tanggal_awal"
                                min="{{ date('Y-m-d') }}" value="{{ $peminjaman->tanggal_awal }}" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="jam_awal">Jam Mulai</label>
                            <input type="time" class="form-control rounded-0" id="jam_awal" name="jam_awal"
                                value="{{ $peminjaman->jam_awal }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="jam_akhir">Jam Akhir</label>
                            <input type="time" class="form-control rounded-0" id="jam_akhir" name="jam_akhir"
                                value="{{ $peminjaman->jam_akhir }}">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
