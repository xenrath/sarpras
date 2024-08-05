@extends('layouts.app')

@section('title', 'Lihat Peminjaman')

@section('css')
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Lihat Peminjaman</h1>
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
                        <h3 class="card-title">Form Peminjaman</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ url('dev/peminjaman/' . $peminjaman->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
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
                                    {{ $peminjaman->jumlah }} orang
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Nomor Telepon</strong>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ url('dev/hubungi/' . $peminjaman->telp) }}" target="_blank">
                                        {{ $peminjaman->telp }}
                                    </a>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="layout-lampiran" style="display: none">
                                <div class="form-group mb-2">
                                    <label for="lampiran">Lampirkan Surat Tugas</label>
                                    <input type="file" class="form-control rounded-0" id="lampiran" name="lampiran"
                                        accept=".doc, .docx, .pdf" value="{{ old('lampiran', $peminjaman->lampiran) }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="tanggal_awal">Tanggal Pinjam</label>
                                        <input type="date" class="form-control rounded-0" id="tanggal_awal"
                                            name="tanggal_awal" min="{{ date('Y-m-d') }}"
                                            value="{{ old('tanggal_awal', $peminjaman->tanggal_awal) }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="jam_awal">Jam Mulai</label>
                                        <input type="time" class="form-control rounded-0" id="jam_awal" name="jam_awal"
                                            value="{{ old('jam_awal', $peminjaman->jam_awal) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="jam_akhir">Jam Akhir</label>
                                        <input type="time" class="form-control rounded-0" id="jam_akhir" name="jam_akhir"
                                            value="{{ old('jam_akhir', $peminjaman->jam_akhir) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="is_sopir">Perlu Sopir?</label>
                                <select class="custom-select rounded-0" id="is_sopir" name="is_sopir"
                                    onchange="setSopir()">
                                    <option value="">- Pilih -</option>
                                    <option value="1"
                                        {{ old('is_sopir', $peminjaman->is_sopir) == '1' ? 'selected' : '' }}>
                                        Ya Perlu
                                    </option>
                                    <option value="0"
                                        {{ old('is_sopir', $peminjaman->is_sopir) == '0' ? 'selected' : '' }}>
                                        Bawa Sendiri
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="kendaraan_id">
                                    Kendaraan
                                    <small class="text-muted">(kapasitas)</small>
                                </label>
                                <select class="custom-select rounded-0" id="kendaraan_id" name="kendaraan_id">
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
                            <div class="form-group mb-2">
                                <label for="sopir_id">Sopir</label>
                                <select class="custom-select rounded-0" id="sopir_id" name="sopir_id">
                                    <option value="">- Pilih -</option>
                                    @foreach ($sopirs as $sopir)
                                        <option value="{{ $sopir->id }}"
                                            {{ $peminjaman->sopir_id == $sopir->id ? 'selected' : '' }}>
                                            {{ $sopir->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="status">Status</label>
                                <select class="custom-select rounded-0" id="status" name="status" onchange="setStatus()">
                                    <option value="">- Pilih -</option>
                                    <option value="menunggu"
                                        {{ old('status', $peminjaman->status) == 'menunggu' ? 'selected' : '' }}>Menunggu
                                    </option>
                                    <option value="proses"
                                        {{ old('status', $peminjaman->status) == 'proses' ? 'selected' : '' }}>Proses
                                    </option>
                                    <option value="konfirmasi"
                                        {{ old('status', $peminjaman->status) == 'konfirmasi' ? 'selected' : '' }}>
                                        Konfirmasi
                                    </option>
                                    <option value="setuju"
                                        {{ old('status', $peminjaman->status) == 'setuju' ? 'selected' : '' }}>Setuju
                                    </option>
                                    <option value="selesai"
                                        {{ old('status', $peminjaman->status) == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-info btn-sm btn-flat" id="btn-cek"
                                data-toggle="modal" data-target="#modal-cek" hidden>Cek
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Buat Peminjaman</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
@endsection

@section('script')
    <script>
        setSopir();

        function setSopir() {
            if ($('#is_sopir').val() === '1') {
                $('#sopir_id').removeAttr('disabled');
            } else {
                $('#sopir_id').attr('disabled', 'disabled');
            }
        }

        setStatus();

        function setStatus() {
            if ($('#status').val() === 'menunggu') {
                $('#sopir_id').attr('disabled', 'disabled');
                $('#kendaraan_id').attr('disabled', 'disabled');
            } else {
                $('#sopir_id').removeAttr('disabled');
                $('#kendaraan_id').removeAttr('disabled');
            }
        }
    </script>
@endsection
