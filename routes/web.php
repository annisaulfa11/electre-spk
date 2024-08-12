<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Route;

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


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/tes', [DashboardController::class, 'tes']);

Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/', [LoginController::class, 'authenticate']);
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/pengguna', [UserController::class, 'get'])->name('user')->middleware('admin');
Route::post('/pengguna/tambah', [UserController::class, 'insert'])->middleware('admin');
Route::get('/pengguna/tambah', function () {
    return view('user/insert');
})->middleware('admin');
Route::get('/pengguna/{id}', [UserController::class,'delete'])->middleware('admin');

Route::get('/pembina-wilayah', [UserController::class, 'getData'])->middleware('admin');
Route::get('/pembina-wilayah/{id}/posyandu', [PembinaController::class,'getPembina'])->middleware('auth');
Route::get('/pembina-wilayah/{id}/posyandu/{idPos}', [PembinaController::class,'delete'])->middleware('auth');
Route::post('/pembina-wilayah/{id}/posyandu/tambah', [PembinaController::class,'insert'])->middleware('auth');


Route::get('/posyandu', [PosyanduController::class, 'get'])->middleware('admin');
Route::post('/posyandu/tambah', [PosyanduController::class, 'insert'])->middleware('admin');
Route::get('/posyandu/tambah', function () {
    return view('posyandu/insert');
})->middleware('admin');
Route::get('/posyandu/{id}', [PosyanduController::class,'delete'])->middleware('admin');
Route::get('/posyandu/{id}/update', [PosyanduController::class,'getData'])->middleware('admin');
Route::put('/posyandu/{id}', [PosyanduController::class, 'update'])->middleware('admin');

Route::get('/alternatif', [AnakController::class, 'get'])->middleware('auth');
Route::post('/alternatif/tambah', [AnakController::class, 'insert'])->middleware('auth');
Route::get('/alternatif/tambah', [AnakController::class, 'getPosyandu'])->middleware('auth');
Route::get('/alternatif/{id}', [AnakController::class,'delete'])->middleware('auth');
Route::get('/alternatif/{id}/update', [AnakController::class,'getData'])->middleware('auth');
Route::put('/alternatif/{id}', [AnakController::class, 'update']);

Route::get('/kriteria', [KriteriaController::class, 'get'])->name('user')->middleware('auth');
Route::get('/kriteria/tambah', [KriteriaController::class, 'index'])->middleware('auth');
Route::post('/kriteria/tambah', [KriteriaController::class, 'insert'])->middleware('auth');
Route::get('/kriteria/{id}/update', [KriteriaController::class,'getData'])->middleware('admin');
Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->middleware('admin');
Route::get('/kriteria/{id}', [KriteriaController::class, 'delete'])->middleware('admin');
Route::get('/kriteria/{id}/subkriteria', [KriteriaController::class, 'getSubkriteria'])->middleware('auth');
Route::get('/kriteria/subkriteria', [KriteriaController::class, 'index2'])->middleware('auth');

Route::get('/penilaian', [PenilaianController::class, 'get'])->middleware('auth');
Route::post('/penilaian/tambah', [PenilaianController::class, 'insert'])->middleware('auth');
Route::get('/penilaian/tambah', [PenilaianController::class, 'getData'])->middleware('auth');
Route::get('/penilaian/{id}', [PenilaianController::class,'delete'])->middleware('auth');
Route::get('/penilaian/{id}/update', [PenilaianController::class,'getPenilaian'])->middleware('auth');
Route::put('/penilaian/{id}', [PenilaianController::class, 'update']);
Route::get('/penilaian/{id}/tambah', [PenilaianController::class, 'getPenilaian2']);

Route::get('/hasil/proses', [HasilController::class,'hitung'])->middleware('admin');
Route::get('/hasil', [HasilController::class,'getHasil'])->middleware('auth');
Route::put('/hasil', [HasilController::class,'update'])->middleware('auth');
Route::post('/hasil/simpan', [HasilController::class,'store'])->middleware('admin');

Route::get('/rekap', [RekapController::class,'get'])->middleware('auth');
Route::get('/rekap/{id}', [RekapController::class,'getRekap'])->middleware('auth');
Route::get('/rekap/{id}/hapus', [RekapController::class,'delete'])->middleware('admin');

Route::get('/profil', [UserController::class,'getUser'])->middleware('auth');
Route::put('/profil/{id}', [UserController::class,'update'])->middleware('auth');

Route::get('/data', [PenilaianController::class, 'getAnak'])->middleware('auth');
