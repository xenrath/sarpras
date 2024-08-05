@extends('peminjaman.app')

@section('title', 'Buat Peminjaman CBT')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <a href="{{ url('/') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Peminjaman Sarpras</h1>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('peminjaman/list') }}" style="text-decoration: underline;"
                                    target="_blank">List
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
                            <form action="{{ url('peminjaman') }}" method="post" autocomplete="off">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <label for="kategori">Kategori Peminjaman</label>
                                        <select class="custom-select rounded-0" id="kategori" name="kategori">
                                            <option value="">- Pilih -</option>
                                            <option value="kendaraan"
                                                {{ old('kategori') == 'kendaraan' ? 'selected' : '' }}>
                                                Kendaraan</option>
                                            <option value="ruang" {{ old('kategori') == 'ruang' ? 'selected' : '' }}>
                                                Ruang</option>
                                            <option value="gedung" {{ old('kategori') == 'gedung' ? 'selected' : '' }}>
                                                Gedung</option>
                                            <option value="barang" {{ old('kategori') == 'barang' ? 'selected' : '' }}>
                                                Barang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-flat">Selanjutnya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
