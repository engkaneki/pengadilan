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
    Route::get('/', [ParrentController::class, 'index']);
    Route::get('/parrent', [ParrentController::class, 'index']);
});

Route::middleware(['auth', 'cekUserLogin:2'])->group(function () {
    Route::get('/', [PengadilanController::class, 'index']);
    Route::get('/pengadilan', [PengadilanController::class, 'index']);
    Route::get('/pengajuan', [PengadilanController::class, 'pengajuan']);
});

Route::middleware(['auth', 'cekUserLogin:3'])->group(function () {
    Route::get('/', [PetugasController::class, 'index']);
    Route::get('/petugas', [PetugasController::class, 'index']);
});
