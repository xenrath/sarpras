@extends('layouts.app')

@section('title', 'Data User')

@section('loader')
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('storage/uploads/asset/logo.png') }}" alt="Unit Sarpras" height="80"
            width="80" style="border-radius: 50%">
    </div>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data User</h1>
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
                        <h3 class="card-title">Data User</h3>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                data-target="#modal-tambah">
                                <i class="fas fa-plus"></i>
                                Tambah
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped mb-4">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px">No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th class="text-center" style="width: 100px">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>
                                            @if ($user->role == 'sarpras')
                                                Kabag Sarpras
                                            @elseif ($user->role == 'bauk')
                                                Ka BAUK
                                            @elseif ($user->role == 'sarana')
                                                Staf Sarana
                                            @elseif ($user->role == 'prasarana')
                                                Staf Prasarana
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm btn-flat"
                                                data-toggle="modal" data-target="#modal-edit-{{ $user->id }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm btn-flat"
                                                data-toggle="modal" data-target="#modal-hapus-{{ $user->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-edit-{{ $user->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit User</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ url('dev/user/' . $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group mb-2">
                                                            <label for="nama">Nama User</label>
                                                            <input type="text" class="form-control rounded-0"
                                                                id="nama" name="nama" value="{{ $user->nama }}">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="telp">
                                                                Nomor Telepon
                                                                <small class="text-muted">(08xxxxxxxxxx)</small>
                                                            </label>
                                                            <input type="tel" class="form-control rounded-0"
                                                                id="telp" name="telp" value="{{ $user->telp }}">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="role">Role</label>
                                                            <select class="custom-select rounded-0" id="role"
                                                                name="role">
                                                                <option value="">- Pilih -</option>
                                                                <option value="bauk"
                                                                    {{ $user->role == 'bauk' ? 'selected' : '' }}>Ka BAUK
                                                                </option>
                                                                <option value="sarpras"
                                                                    {{ $user->role == 'sarpras' ? 'selected' : '' }}>Kabag
                                                                    Sarpras
                                                                </option>
                                                                <option value="sarana"
                                                                    {{ $user->role == 'sarana' ? 'selected' : '' }}>Staf
                                                                    Sarana
                                                                </option>
                                                                <option value="prasarana"
                                                                    {{ $user->role == 'prasarana' ? 'selected' : '' }}>Staf
                                                                    Prasarana
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default btn-sm btn-flat"
                                                            data-dismiss="modal">Batal</button>
                                                        <div>
                                                            <button type="button" class="btn btn-warning btn-sm btn-flat"
                                                                data-dismiss="modal" data-toggle="modal"
                                                                data-target="#modal-reset-{{ $user->id }}">Reset
                                                                Password</button>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm btn-flat">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-hapus-{{ $user->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus user</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Yakin hapus user <strong>{{ $user->nama }}</strong>?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default btn-sm btn-flat"
                                                        data-dismiss="modal">Batal</button>
                                                    <form action="{{ url('dev/user/' . $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm btn-flat">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-reset-{{ $user->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Reset Password</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Yakin reset password <strong>{{ $user->nama }}</strong>?</p>
                                                    <small class="text-muted">Password akan diubah menjadi
                                                        <strong>bhamada</strong>.</small>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default btn-sm btn-flat"
                                                        data-dismiss="modal">Batal</button>
                                                    <form action="{{ url('dev/user/reset/' . $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-warning btn-sm btn-flat">Reset</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination pagination-sm float-right">
                            {{ $users->appends(Request::all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dev/user') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="nama">Nama User</label>
                            <input type="text" class="form-control rounded-0" id="nama" name="nama"
                                value="{{ old('nama') }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="telp">
                                Nomor Telepon
                                <small class="text-muted">(08xxxxxxxxxx)</small>
                            </label>
                            <input type="tel" class="form-control rounded-0" id="telp" name="telp"
                                value="{{ old('telp') }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Password</label>
                            <br>
                            <small class="text-muted">
                                Default password user baru :
                                <strong>bhamada</strong>
                            </small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="role">Role</label>
                            <select class="custom-select rounded-0" id="role" name="role">
                                <option value="">- Pilih -</option>
                                <option value="bauk" {{ old('role') == 'bauk' ? 'selected' : '' }}>Ka BAUK
                                </option>
                                <option value="sarpras" {{ old('role') == 'sarpras' ? 'selected' : '' }}>Kabag Sarpras
                                </option>
                                <option value="sarana" {{ old('role') == 'sarana' ? 'selected' : '' }}>Staf Sarana
                                </option>
                                <option value="prasarana" {{ old('role') == 'prasarana' ? 'selected' : '' }}>Staf
                                    Prasarana
                                </option>
                            </select>
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
