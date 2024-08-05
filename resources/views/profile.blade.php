@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profile Saya</h1>
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
                        <h3 class="card-title">Form Profile</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ url('profile-update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="nama">
                                    Nama Lengkap
                                    <small class="text-muted">(dengan gelar)</small>
                                </label>
                                <input type="text" class="form-control rounded-0" id="nama" name="nama"
                                    value="{{ old('nama', $user->nama) }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="telp">
                                    Nomor Telepon
                                    <small class="text-muted">(08xxxxxxxxxx)</small>
                                </label>
                                <input type="tel" class="form-control rounded-0" id="telp" name="telp"
                                    value="{{ old('telp', $user->telp) }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control rounded-0" id="password" name="password"
                                        value="{{ old('password', $user->password_text) }}">
                                    <div class="input-group-append" style="cursor: pointer;" onclick="showPassword()">
                                        <div class="input-group-text rounded-0">
                                            <span class="fas fa-eye-slash" id="icon-eye"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (auth()->user()->isSarpras() || auth()->user()->isBauk())
                                <div class="form-group mb-2">
                                    <label for="nipy">NIPY</label>
                                    <input type="text" class="form-control rounded-0" id="nipy" name="nipy"
                                        value="{{ old('nipy', $user->nipy) }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="ttd">
                                        Tanda Tangan
                                        @if ($user->ttd)
                                            <small class="text-muted">(kosongkan jika tidak ingin diubah)</small>
                                        @endif
                                    </label>
                                    <input type="file"
                                        class="form-control rounded-0 @error('ttd_test') is-invalid @enderror"
                                        id="ttd" name="ttd" accept="image/png" onchange="getTtd()"
                                        value="{{ old('ttd', $user->ttd) }}">
                                    @error('ttd_test')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="button" class="btn btn-info btn-sm btn-flat" onclick="showTtd()">Lihat
                                    Hasil</button>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Update Profile</button>
                        </div>
                    </form>
                </div>
                @if (auth()->user()->isSarpras() || auth()->user()->isBauk())
                    <form action="{{ url('ttd') }}" method="post" id="form-ttd" enctype="multipart/form-data"
                        target="_blank">
                        @csrf
                        <input type="text" class="form-control rounded-0" id="nipy-test" name="nipy_test" hidden>
                        <input type="file" class="form-control rounded-0" id="ttd-test" name="ttd_test" hidden>
                    </form>
                @endif
            </div>
        </section>
        <!-- /.card -->
    </div>
@endsection

@section('script')
    <script>
        function showPassword() {
            var password = document.getElementById('password');
            var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            var icon_eye = document.getElementById('icon-eye');
            var icon_change = icon_eye.className === 'fas fa-eye-slash' ? 'fas fa-eye' : 'fas fa-eye-slash';
            icon_eye.className = icon_change;
        }

        function getTtd() {
            var ttd = $('#ttd').prop('files');
            $('#ttd-test').prop('files', ttd);
        }

        function showTtd() {
            var nipy = $('#nipy').val();
            $('#nipy-test').val(nipy);
            $('#form-ttd').submit();
        }
    </script>
@endsection
