<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParrentController;
use App\Http\Controllers\PengadilanController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('login', [LoginController::class, 'index'])->name('login');

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
});

Route::middleware(['auth', 'cekUserLogin:1'])->group(function () {
    Route::controller(ParrentController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/parrent', 'index');
        Route::get('/parrent/profile', 'profile');
        Route::post('/parrent/update', 'update');
        Route::post('/parrent/photo', 'photo');
        Route::get('/berkas', 'berkas');
        Route::post('/berkas/proses', 'proses');
        Route::get('/berkas/selesai', 'selesai');
        Route::get('/berkas/tolak', 'tolak');
        Route::get('/parrent/users', 'users');
        Route::get('/users/reset', 'reset');
        Route::delete('/users/hapus/{id}', 'hapus');
    });
});

Route::middleware(['auth', 'cekUserLogin:2'])->group(function () {
    Route::controller(PengadilanController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/pengadilan', 'index');
        Route::get('/pengajuan', 'pengajuan');
        Route::get('/pengajuan/selesai', 'selesai');
        Route::get('/pengajuan/ditolak', 'ditolak');
        Route::post('/pengajuan/simpan', 'save');
        Route::get('/pengajuan/edit', 'edit');
        Route::delete('/pengajuan/hapus/{id}', 'delete');
        Route::get('/pengajuan/berkas', 'berkas');
        Route::get('/pengajuan/sudah', 'sudah');
        Route::get('/pengadilan/profile', 'profile');
        Route::post('/profile/update', 'update');
        Route::post('/profile/photo', 'photo');
    });
});

Route::middleware(['auth', 'cekUserLogin:3'])->group(function () {
    Route::get('/', [PetugasController::class, 'index']);
    Route::get('/petugas', [PetugasController::class, 'index']);
});
