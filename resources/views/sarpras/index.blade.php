@extends('layouts.app')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('loader')
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('storage/uploads/asset/logo.png') }}" alt="Admin SIT" height="80"
            width="80" style="border-radius: 50%">
    </div>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (!auth()->user()->ttd)
                    <div class="callout callout-info">
                        <h5>
                            <i class="fas fa-info"></i>
                            Perhatian
                        </h5>
                        <p>Untuk keperluan Anda, lengkapi data diri terlebih dahulu</p>
                        <a href="{{ url('profile') }}" class="btn btn-outline-info btn-flat" style="text-decoration: none;">
                            <i class="fas fa-user"></i>
                            Lengkapi Data
                        </a>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $kendaraan }}
                                    data
                                </h3>
                                <p>Peminjaman Kendaraan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-car"></i>
                            </div>
                            <a href="{{ url('sarpras/peminjaman-kendaraan') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $ruang }}
                                    data
                                </h3>
                                <p>Peminjaman Ruang</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-home"></i>
                            </div>
                            <a href="{{ url('sarpras/ruang') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $gedung }}
                                    data
                                </h3>
                                <p>Peminjaman Gedung</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-home"></i>
                            </div>
                            <a href="{{ url('sarpras/gedung') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $barang }}
                                    data
                                </h3>
                                <p>Peminjaman Barang</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-briefcase"></i>
                            </div>
                            <a href="{{ url('sarpras/barang') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
