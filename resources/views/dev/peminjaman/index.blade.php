@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Peminjaman</h1>
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
                        <div class="float-right">
                            <a href="{{ url('dev/peminjaman/sampah') }}" class="btn btn-danger btn-xs btn-flat">
                                <i class="fas fa-trash"></i>
                                Sampah
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Peminjam</th>
                                        <th>Waktu</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($peminjamans as $key => $peminjaman)
                                        <tr>
                                            <td class="text-center">{{ $peminjamans->firstItem() + $key }}</td>
                                            <td>
                                                <a href="{{ url('sarpras/hubungi/' . $peminjaman->telp) }}" target="_blank">
                                                    {{ $peminjaman->nama }}
                                                </a>
                                                <br>
                                                <span class="badge bg-secondary">{{ $peminjaman->kategori }}</span>
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('d F') }}
                                                <br>
                                                {{ $peminjaman->jam_awal }}-{{ $peminjaman->jam_akhir }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('dev/peminjaman/' . $peminjaman->id) }}"
                                                    class="btn btn-info btn-sm btn-flat btn-block">
                                                    <i class="fas fa-eye"></i>
                                                </a>
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
@endsection
