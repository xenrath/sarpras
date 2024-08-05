<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN SARPRAS</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('storage/uploads/asset/logo-rounded.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body class="hold-transition">

    @include('sweetalert::alert')

    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/') }}"><b>LOGIN</b>SARPRAS</a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Masukan username dan password</p>
                    <form action="{{ url('login') }}" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="tel" id="telp" name="telp" class="form-control rounded-0"
                                    placeholder="Nomor Telepon" value="{{ old('telp') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text rounded-0">
                                        <span class="fas fa-phone"></span>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">(08xxxxxxxxxx)</small>
                        </div>
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control rounded-0"
                                    placeholder="Password" value="{{ old('password') }}">
                                <div class="input-group-append" style="cursor: pointer;" onclick="showPassword()">
                                    <div class="input-group-text rounded-0">
                                        <span class="fas fa-eye-slash" id="icon-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    <script>
        function showPassword() {
            var password = document.getElementById('password');
            var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            var icon_eye = document.getElementById('icon-eye');
            var icon_change = icon_eye.className === 'fas fa-eye-slash' ? 'fas fa-eye' : 'fas fa-eye-slash';
            icon_eye.className = icon_change;
        }
    </script>
</body>

</html>
