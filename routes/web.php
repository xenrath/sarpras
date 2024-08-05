<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'login_proses']);
Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
Route::get('cek-login', [App\Http\Controllers\HomeController::class, 'cek_login']);
Route::get('hubungi/{telp}', [App\Http\Controllers\HomeController::class, 'hubungi']);

Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->middleware('auth');
Route::post('profile-update', [App\Http\Controllers\HomeController::class, 'profile_update'])->middleware('auth');
Route::post('ttd', [App\Http\Controllers\HomeController::class, 'ttd'])->middleware('auth');

Route::get('peminjaman/list', [App\Http\Controllers\PeminjamanController::class, 'list']);
Route::get('peminjaman/kendaraan', [App\Http\Controllers\PeminjamanController::class, 'kendaraan']);
Route::get('peminjaman/ruang', [App\Http\Controllers\PeminjamanController::class, 'ruang']);
Route::get('peminjaman/gedung', [App\Http\Controllers\PeminjamanController::class, 'gedung']);
Route::get('peminjaman/barang', [App\Http\Controllers\PeminjamanController::class, 'barang']);
Route::post('peminjaman/kendaraan', [App\Http\Controllers\PeminjamanController::class, 'store_kendaraan']);
Route::post('peminjaman/ruang', [App\Http\Controllers\PeminjamanController::class, 'store_ruang']);
Route::post('peminjaman/gedung', [App\Http\Controllers\PeminjamanController::class, 'store_gedung']);
Route::post('peminjaman/barang', [App\Http\Controllers\PeminjamanController::class, 'store_barang']);
Route::get('peminjaman/bukti/{kode}', [App\Http\Controllers\PeminjamanController::class, 'bukti']);
Route::resource('peminjaman', App\Http\Controllers\PeminjamanController::class);

Route::middleware('dev')->prefix('dev')->group(function () {
    Route::get('/', [App\Http\Controllers\Dev\HomeController::class, 'index']);
    Route::get('hubungi/{telp}', [App\Http\Controllers\Dev\HomeController::class, 'hubungi']);

    Route::post('user/reset/{id}', [App\Http\Controllers\Dev\UserController::class, 'reset']);
    Route::resource('user', App\Http\Controllers\Dev\UserController::class);

    Route::resource('sopir', App\Http\Controllers\Dev\SopirController::class);

    Route::resource('kendaraan', App\Http\Controllers\Dev\KendaraanController::class);

    Route::resource('peminjaman', App\Http\Controllers\Dev\PeminjamanController::class);
});

Route::middleware('sarpras')->prefix('sarpras')->group(function () {
    Route::get('/', [App\Http\Controllers\Sarpras\HomeController::class, 'index']);
    Route::get('hubungi/{telp}', [App\Http\Controllers\Sarpras\HomeController::class, 'hubungi']);

    Route::post('peminjaman-kendaraan/konfirmasi/{id}', [App\Http\Controllers\Sarpras\Peminjaman\KendaraanController::class, 'konfirmasi']);
    Route::post('peminjaman-kendaraan/kembalikan/{id}', [App\Http\Controllers\Sarpras\Peminjaman\KendaraanController::class, 'kembalikan']);
    Route::resource('peminjaman-kendaraan', App\Http\Controllers\Sarpras\Peminjaman\KendaraanController::class);

    Route::resource('sopir', App\Http\Controllers\Sarpras\SopirController::class);

    Route::resource('kendaraan', App\Http\Controllers\Sarpras\KendaraanController::class);

    Route::resource('ruang', App\Http\Controllers\Sarpras\RuangController::class);

    Route::resource('gedung', App\Http\Controllers\Sarpras\GedungController::class);

    Route::resource('barang', App\Http\Controllers\Sarpras\BarangController::class);

    Route::get('laporan/bukti/{id}', [App\Http\Controllers\Sarpras\LaporanController::class, 'bukti']);
    Route::resource('laporan', App\Http\Controllers\Sarpras\LaporanController::class);
});

Route::middleware('bauk')->prefix('bauk')->group(function () {
    Route::get('/', [App\Http\Controllers\Bauk\HomeController::class, 'index']);
    Route::get('hubungi/{telp}', [App\Http\Controllers\Bauk\HomeController::class, 'hubungi']);

    Route::post('peminjaman-kendaraan/setuju/{id}', [App\Http\Controllers\Bauk\Peminjaman\KendaraanController::class, 'setuju']);
    Route::resource('peminjaman-kendaraan', App\Http\Controllers\Bauk\Peminjaman\KendaraanController::class);

    Route::get('laporan/bukti/{id}', [App\Http\Controllers\Bauk\LaporanController::class, 'bukti']);
    Route::resource('laporan', App\Http\Controllers\Bauk\LaporanController::class);
});

Route::middleware('sarana')->prefix('sarana')->group(function () {
    Route::get('/', [App\Http\Controllers\Sarana\HomeController::class, 'index']);
    Route::get('hubungi/{telp}', [App\Http\Controllers\Sarpras\HomeController::class, 'hubungi']);

    Route::post('peminjaman-kendaraan/kendaraan/{id}', [App\Http\Controllers\Sarana\Peminjaman\KendaraanController::class, 'kendaraan']);
    Route::post('peminjaman-kendaraan/proses/{id}', [App\Http\Controllers\Sarana\Peminjaman\KendaraanController::class, 'proses']);
    Route::post('peminjaman-kendaraan/konfirmasi/{id}', [App\Http\Controllers\Sarana\Peminjaman\KendaraanController::class, 'konfirmasi']);
    Route::resource('peminjaman-kendaraan', App\Http\Controllers\Sarana\Peminjaman\KendaraanController::class);

    Route::get('laporan/bukti/{id}', [App\Http\Controllers\Sarana\LaporanController::class, 'bukti']);
    Route::resource('laporan', App\Http\Controllers\Sarana\LaporanController::class);

    Route::get('sopir', function () {
        return view('error.500');
    });

    Route::get('kendaraan', function () {
        return view('error.500');
    });
});

Route::middleware('prasarana')->prefix('prasarana')->group(function () {
    Route::get('/', [App\Http\Controllers\Prasarana\HomeController::class, 'index']);
});
