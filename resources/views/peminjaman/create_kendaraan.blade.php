@extends('peminjaman.app')

@section('title', 'Peminjaman Kendaraan')

@section('css')
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <a href="{{ url('peminjaman') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Peminjaman Kendaraan</h1>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('peminjaman/list') }}" style="text-decoration: underline;" target="_blank">List
                                    Peminjaman</a>
                            </li>
                        </ol>
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
                                <h3 class="card-title">Form Peminjaman</h3>
                            </div>
                            <form action="{{ url('peminjaman/kendaraan') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label for="nama">Nama Peminjam</label>
                                                <input type="text"
                                                    class="form-control rounded-0 @error('nama') is-invalid @enderror"
                                                    id="nama" name="nama" value="{{ old('nama') }}">
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label for="keperluan">Keperluan</label>
                                                <select
                                                    class="custom-select rounded-0 @error('keperluan') is-invalid @enderror"
                                                    id="keperluan" name="keperluan" onchange="showLampiran()">
                                                    <option value="">- Pilih -</option>
                                                    <option value="pribadi"
                                                        {{ old('keperluan') == 'pribadi' ? 'selected' : '' }}>Pribadi
                                                    </option>
                                                    <option value="tugas"
                                                        {{ old('keperluan') == 'tugas' ? 'selected' : '' }}>Tugas Kantor
                                                    </option>
                                                </select>
                                                @error('keperluan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layout-lampiran" style="display: none">
                                        <div class="form-group mb-2">
                                            <label for="lampiran">Lampirkan Surat Tugas</label>
                                            <input type="file"
                                                class="form-control rounded-0 @error('lampiran') is-invalid @enderror"
                                                id="lampiran" name="lampiran" accept=".doc, .docx, .pdf"
                                                value="{{ old('lampiran') }}">
                                            @error('lampiran')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label for="tanggal_awal">Tanggal Pinjam</label>
                                                <input type="date"
                                                    class="form-control rounded-0 @error('tanggal_awal') is-invalid @enderror"
                                                    id="tanggal_awal" name="tanggal_awal" min="{{ date('Y-m-d') }}"
                                                    value="{{ old('tanggal_awal') }}" />
                                                @error('tanggal_awal')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label for="jam_awal">Jam Mulai</label>
                                                <input type="time"
                                                    class="form-control rounded-0 @error('jam_awal') is-invalid @enderror"
                                                    id="jam_awal" name="jam_awal" value="{{ old('jam_awal') }}">
                                                @error('jam_awal')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label for="jam_akhir">Jam Akhir</label>
                                                <input type="time"
                                                    class="form-control rounded-0 @error('jam_akhir') is-invalid @enderror"
                                                    id="jam_akhir" name="jam_akhir" value="{{ old('jam_akhir') }}">
                                                @error('jam_akhir')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="kegiatan">Uraian Kegiatan</label>
                                        <textarea class="form-control rounded-0 @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan"
                                            rows="3" placeholder="alasan meminjam kendaraan">{{ old('kegiatan') }}</textarea>
                                        @error('kegiatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="keterangan">Tempat / Tujuan</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('keterangan') is-invalid @enderror"
                                            id="keterangan" name="keterangan" placeholder="masukan tempat tujuan"
                                            value="{{ old('keterangan') }}">
                                        @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label for="jumlah">
                                                    Jumlah Penumpang
                                                    <small class="text-muted">(tanpa sopir)</small>
                                                </label>
                                                <input type="number"
                                                    class="form-control rounded-0 @error('jumlah') is-invalid @enderror"
                                                    id="jumlah" name="jumlah" placeholder="masukan jumlah penumpang"
                                                    value="{{ old('jumlah') }}">
                                                @error('jumlah')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label for="is_sopir">Perlu Sopir?</label>
                                                <select
                                                    class="custom-select rounded-0 @error('is_sopir') is-invalid @enderror"
                                                    id="is_sopir" name="is_sopir">
                                                    <option value="">- Pilih -</option>
                                                    <option value="1" {{ old('is_sopir') == '1' ? 'selected' : '' }}>
                                                        Ya Perlu
                                                    </option>
                                                    <option value="0" {{ old('is_sopir') == '0' ? 'selected' : '' }}>
                                                        Bawa Sendiri
                                                    </option>
                                                </select>
                                                @error('is_sopir')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="telp">
                                            Nomor Telepon
                                            <small class="text-muted">(08xxxxxxxxxx)</small>
                                        </label>
                                        <input type="tel"
                                            class="form-control rounded-0 @error('telp') is-invalid @enderror"
                                            id="telp" name="telp" placeholder="nomor whatsapp peminjam"
                                            value="{{ old('telp') }}">
                                        @error('telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-info btn-flat" id="btn-cek"
                                        data-toggle="modal" data-target="#modal-cek" hidden>Cek
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-flat">Buat Peminjaman</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('cek'))
        <div class="modal fade show" id="modal-cek">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Peminjaman CBT</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-danger">
                            <strong>GAGAL!</strong>
                        </h4>
                        <p>
                            Ruang CBT tanggal
                            <strong>
                                @if (old('lama') > 1)
                                    {{ Carbon\Carbon::parse(old('tanggal_awal'))->translatedFormat('d F') }}-{{ Carbon\Carbon::parse(old('tanggal_awal'))->addDays(old('lama'))->translatedFormat('d F') }}
                                @else
                                    {{ Carbon\Carbon::parse(old('tanggal_awal'))->translatedFormat('d F') }}
                                @endif
                            </strong>
                            jam
                            <strong>
                                {{ old('jam_awal') }}-{{ old('jam_akhir') }}
                            </strong>
                            tidak dapat dipinjam.
                        </p>
                        @foreach (session('cek') as $cek)
                            <div class="border rounded mb-2 p-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Nama Peminjam</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $cek->nama }}
                                        @if ($cek->keperluan == 'pembelajaran')
                                            <small class="text-muted">({{ $cek->prodi->nama }})</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Waktu</strong>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($cek->tanggal_awal == $cek->tanggal_akhir)
                                            {{ Carbon\Carbon::parse($cek->tanggal_awal)->translatedFormat('d F') }},
                                        @else
                                            {{ Carbon\Carbon::parse($cek->tanggal_awal)->translatedFormat('d F') }}-{{ Carbon\Carbon::parse($cek->tanggal_akhir)->translatedFormat('d F') }},
                                        @endif
                                        {{ $cek->jam_awal }}-{{ $cek->jam_akhir }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Uraian Kegiatan</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $cek->keterangan }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Penanggung Jawab</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $cek->pj }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <span class="text-muted">Lakukan pergantian jadwal atau konfirmasi pada pihak terkait.</span>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script>
        showLampiran();

        function showLampiran() {
            if ($('#keperluan').val() === 'tugas') {
                $('.layout-lampiran').show();
            } else {
                $('.layout-lampiran').hide();
                $('#lampiran').val(null);
            }
        }

        var cek = @json(session('cek'));

        if (cek != null) {
            $('#btn-cek').click();
        }
    </script>
@endsection
