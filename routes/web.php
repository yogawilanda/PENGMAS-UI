<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PindahKeluarController;
use App\Http\Controllers\PindahMasukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UbahKerjaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UbahKerjaController as AdminKerjaController;
use App\Http\Controllers\Admin\PindahMasukController as AdminMasukController;
use App\Http\Controllers\Admin\PindahKeluarController as AdminKeluarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route penelitian
Route::prefix('/rt')->group(function () {
    Route::get('/ubah-pekerjaan-pengajuan/{id}', [AdminKerjaController::class, 'index']);
    Route::get('/pengajuan/getRT', [AdminKerjaController::class, 'getDataPengajuan'])->name('Pengajuan.getDataRT');
    Route::get('/ubah-kerja', [AdminKerjaController::class, 'indexRt']);
    Route::get('/pindah-masuk', [AdminMasukController::class, 'index']);
    Route::get('/pindah-keluar', [AdminKeluarController::class, 'index']);
});
Route::prefix('/rw')->group(function () {
    Route::get('/ubah-kerja', [AdminKerjaController::class, 'rw']);
    Route::get('/pindah-masuk', [AdminMasukController::class, 'rw']);
    Route::get('/pindah-keluar', [AdminKeluarController::class, 'rw']);
});
Route::prefix('/kelurahan')->group(function () {
    Route::get('/ubah-kerja', [AdminKerjaController::class, 'kelurahan']);
    Route::get('/pindah-masuk', [AdminMasukController::class, 'kelurahan']);
    Route::get('/kelurahan/pindahMasuk', [AdminMasukController::class, 'getDataKelurahan'])->name('kelurahan.pindahMasuk');
    Route::get('/pindah-keluar', [AdminKeluarController::class, 'kelurahan']);
});
Route::prefix('/kecamatan')->group(function () {
    Route::get('/ubah-kerja', [AdminKerjaController::class, 'kecamatan']);
    Route::get('/pindah-masuk', [AdminMasukController::class, 'kecamatan']);
    Route::get('/pindah-keluar', [AdminKeluarController::class, 'kecamatan']);
});

// Route Warga
Route::prefix('warga')->group(function () {
    Route::get('/dashboard/{id}', [DashboardController::class, 'index']);

    // Route Pindah Masuk
    Route::get('/datadiri/pindahMasuk', [PindahMasukController::class, 'getData'])->name('data-diri.pindahMasuk');
    Route::get('/pindah-masuk/{id}', [PindahMasukController::class, 'index']);
    Route::get('/form-tambah-data/{id}', [PindahMasukController::class, 'tambahData']);
    Route::get('/form-kk-baru/{id}', [PindahMasukController::class, 'kkBaru']);

    // Route Pindah Keluar
    Route::get('/datadiri/pindahKeluar', [PindahKeluarController::class, 'getData'])->name('data-diri.pindahKeluar');
    Route::get('/pindah-keluar/{id}', [PindahKeluarController::class, 'index']);
    Route::get('/form-pindah-keluar/{id}', [PindahKeluarController::class, 'show']);
    Route::put('/form-pindah-keluar/{id}', [PindahKeluarController::class, 'update'])->name('form-pindah-keluar');

    // Route Ubah Pekerjaan
    Route::get('/datadiri/getData', [UbahKerjaController::class, 'getData'])->name('data-diri.getData');
    Route::get('/ubah-pekerjaan/{id}', [UbahKerjaController::class, 'index']);
    Route::get('/form-pekerjaan/{id}', [UbahKerjaController::class, 'show']);
    Route::put('/form-pekerjaan/{id}', [UbahKerjaController::class, 'update'])->name('form-pekerjaan');

    // Route Detail Pengajuan
    Route::get('/detail-pindah-masuk', function () {
        return view('pages.detailPengajuanSurat.detailPengajuanPindahMasuk');
    });
    Route::get('/detail-pindah-keluar', function () {
        return view('pages.detailPengajuanSurat.detailPengajuanPindahKeluar');
    });
    Route::get('/detail-ubah-pekerjaan', function () {
        return view('pages.detailPengajuanSurat.detailPengajuanPekerjaan');
    });
});
