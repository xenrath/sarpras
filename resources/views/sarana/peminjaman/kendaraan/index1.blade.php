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
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>Gagal!</h5>
                        <ul class="pl-4 pr-2 mb-0">
                            @foreach (session('error') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                                        <th>Kegiatan</th>
                                        {{-- <th>Kendaraan</th> --}}
                                        <th class="text-center" style="width: 40px">Opsi</th>
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
                                                {{ Carbon\Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('d F') }}
                                                <br>
                                                {{ $peminjaman->jam_awal }}-{{ $peminjaman->jam_akhir }}
                                            </td>
                                            <td>
                                                {{ $peminjaman->kegiatan }}
                                                <br>
                                                <span class="text-muted">({{ $peminjaman->keterangan }})</span>
                                                @if ($peminjaman->keperluan == 'tugas')
                                                    <hr class="my-2">
                                                    <a href="{{ asset('storage/uploads/' . $peminjaman->lampiran) }}"
                                                        class="btn btn-secondary btn-flat btn-xs" target="_blank">
                                                        <span class="d-none d-md-inline">Lampiran</span>
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <span>Penumpang : {{ $peminjaman->jumlah }} Orang</span>
                                                <br>
                                                @if ($peminjaman->tanggal_awal >= $tanggal)
                                                    @if ($peminjaman->kendaraan_id)
                                                        <button class="btn btn-warning btn-flat btn-sm" data-toggle="modal"
                                                            data-target="#modal-kendaraan-{{ $peminjaman->id }}">Ubah</button>
                                                    @else
                                                        <button class="btn btn-primary btn-flat btn-sm" data-toggle="modal"
                                                            data-target="#modal-kendaraan-{{ $peminjaman->id }}">Pilih</button>
                                                    @endif
                                                @endif
                                                <hr class="my-2">
                                                @if ($peminjaman->kendaraan_id)
                                                    <span>{{ $peminjaman->kendaraan->nama }}</span>
                                                    <br>
                                                @else
                                                    @if ($peminjaman->is_sopir)
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                @endif
                                                @if ($peminjaman->is_sopir)
                                                    @if ($peminjaman->sopir_id)
                                                        <a href="{{ url('sarana/hubungi/' . $peminjaman->sopir->telp) }}"
                                                            target="_blank">
                                                            ({{ $peminjaman->sopir->nama }})
                                                        </a>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($peminjaman->status == 'menunggu')
                                                    @if ($peminjaman->tanggal_awal >= $tanggal)
                                                        @if ($peminjaman->kendaraan_id)
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm btn-flat btn-block"
                                                                data-toggle="modal"
                                                                data-target="#modal-proses-{{ $peminjaman->id }}">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        @endif
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm btn-flat btn-block"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit-{{ $peminjaman->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    @endif
                                                    <button type="button" class="btn btn-danger btn-sm btn-flat btn-block"
                                                        data-toggle="modal"
                                                        data-target="#modal-hapus-{{ $peminjaman->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($peminjaman->tanggal_awal >= $tanggal)
                                            <div class="modal fade show" id="modal-kendaraan-{{ $peminjaman->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Pilih Kendaraan</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ url('sarana/peminjaman-kendaraan/kendaraan/' . $peminjaman->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group mb-2">
                                                                    <label for="kendaraan_id">
                                                                        Kendaraan
                                                                        <small class="text-muted">(kapasitas)</small>
                                                                    </label>
                                                                    <select class="custom-select rounded-0"
                                                                        id="kendaraan_id" name="kendaraan_id">
                                                                        <option value="">- Pilih -</option>
                                                                        @foreach ($kendaraans as $kendaraan)
                                                                            <option value="{{ $kendaraan->id }}"
                                                                                {{ $peminjaman->kendaraan_id == $kendaraan->id ? 'selected' : '' }}>
                                                                                {{ $kendaraan->nama }}
                                                                                ({{ $kendaraan->kapasitas }})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if ($peminjaman->is_sopir)
                                                                    <div class="form-group mb-2">
                                                                        <label for="sopir_id">Sopir</label>
                                                                        <select class="custom-select rounded-0"
                                                                            id="sopir_id" name="sopir_id">
                                                                            <option value="">- Pilih -</option>
                                                                            @foreach ($sopirs as $sopir)
                                                                                <option value="{{ $sopir->id }}"
                                                                                    {{ $peminjaman->sopir_id == $sopir->id ? 'selected' : '' }}>
                                                                                    {{ $sopir->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button"
                                                                    class="btn btn-default btn-sm btn-flat"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm btn-flat">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade show" id="modal-edit-{{ $peminjaman->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Peminjaman</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ url('sarana/peminjaman-kendaraan/' . $peminjaman->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <strong>Nama Peminjam</strong>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        {{ $peminjaman->nama }}
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
                                                                <div class="form-group mb-2">
                                                                    <label for="tanggal_awal">Tanggal Pinjam</label>
                                                                    <input type="date" class="form-control rounded-0"
                                                                        id="tanggal_awal" name="tanggal_awal"
                                                                        min="{{ date('Y-m-d') }}"
                                                                        value="{{ $peminjaman->tanggal_awal }}" />
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="jam_awal">Jam Mulai</label>
                                                                    <input type="time" class="form-control rounded-0"
                                                                        id="jam_awal" name="jam_awal"
                                                                        value="{{ $peminjaman->jam_awal }}">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="jam_akhir">Jam Akhir</label>
                                                                    <input type="time" class="form-control rounded-0"
                                                                        id="jam_akhir" name="jam_akhir"
                                                                        value="{{ $peminjaman->jam_akhir }}">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="is_sopir">Perlu Sopir?</label>
                                                                    <select class="custom-select rounded-0" id="is_sopir"
                                                                        name="is_sopir">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="1"
                                                                            {{ $peminjaman->is_sopir == '1' ? 'selected' : '' }}>
                                                                            Ya Perlu
                                                                        </option>
                                                                        <option value="0"
                                                                            {{ $peminjaman->is_sopir == '0' ? 'selected' : '' }}>
                                                                            Bawa Sendiri
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <span class="text-muted">* Note : mengedit peminjaman akan
                                                                    mereset kendaraan / sopir yang sudah dipilih</span>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button"
                                                                    class="btn btn-default btn-sm btn-flat"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm btn-flat">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade show" id="modal-hapus-{{ $peminjaman->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Peminjaman</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin hapus peminjaman kendaraan dari
                                                            <strong>{{ $peminjaman->nama }}</strong>?
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                                                data-dismiss="modal">Batal</button>
                                                            <form
                                                                action="{{ url('sarana/peminjaman-kendaraan/' . $peminjaman->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm btn-flat">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($peminjaman->kendaraan_id)
                                                <div class="modal fade show" id="modal-proses-{{ $peminjaman->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Proses Peminjaman</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <span>Yakin proses peminjaman kendaraan
                                                                    dari <strong>{{ $peminjaman->nama }}</strong>?</span>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button"
                                                                    class="btn btn-default btn-sm btn-flat"
                                                                    data-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ url('sarana/peminjaman-kendaraan/proses/' . $peminjaman->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-sm btn-flat">Proses
                                                                        Peminjaman</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
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
