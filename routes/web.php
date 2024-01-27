<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AnggotaOMKController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\StasiController;
use App\Http\Controllers\UserController;
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

Route::middleware('guest')->group(function () { 
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/register', [AuthController::class, 'register']);
    Route::get('/registrasi-berhasil/{user:email}', [AuthController::class, 'registrasiBerhasil']);
    Route::post('/', [AuthController::class, 'cekLogin']);
    Route::post('/register', [AuthController::class, 'daftarAkun']);
});
Route::middleware('auth')->group(function () {    
    Route::get('/lengkapi-data', [UserController::class, 'lengkapiDatas'])->name('lengkapi-data');
    Route::post('/lengkapi-data', [UserController::class, 'kirimData']);
    Route::post('/logout',[AuthController::class,'logout']);
});
Route::middleware(['auth','cekData'])->group(function () { 
    Route::get('/dashboard',[DashboardController::class, 'index']);
    Route::get('/riwayat-kegiatan-selesai',[DashboardController::class, 'riwayatSelesai']);
    Route::get('/riwayat-kegiatan-dibatalkan',[DashboardController::class, 'riwayatDibatalkan']);
    Route::get('/user-teraktif',[DashboardController::class, 'userTeraktif']);
    Route::get('/pengaturan-profil',[UserController::class, 'profilUser']);
    Route::post('/update-profil',[UserController::class, 'updateUser']);
});
Route::middleware(['auth','cekData','KetuaOMK'])->group(function () { 
    Route::get('/semua-ketua-stasi',[AnggotaOMKController::class, 'semuaKetua']);
    Route::get('/kegiatan-omk-add',[KegiatanController::class, 'tambahKegiatanView']);
    Route::get('/kegiatan-omk-edit/{kegiatan:slug}',[KegiatanController::class, 'editKegiatanView']);
    Route::get('/stasi-view',[StasiController::class, 'index']);
    Route::post('/kegiatan-omk-add',[KegiatanController::class, 'tambahKegiatan']);
    Route::post('/batalkan-kegiatan/{kegiatan:slug}',[KegiatanController::class, 'batalKegiatan']);
    Route::post('/tambah-stasi',[StasiController::class, 'tambahStasi']);
    Route::post('/kegiatan-omk-edit/{kegiatan:slug}',[KegiatanController::class, 'editKegiatan']);
    Route::post('/edit-stasi/{stasi:slug}',[StasiController::class, 'editStasi']);
    Route::post('/update-peran',[AnggotaOMKController::class, 'updatePeran']);
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});
Route::middleware(['auth','cekData','Anggota'])->group(function () { 
    Route::get('/sedang-berlangsung',[RiwayatController::class, 'berlangsung']);
    Route::get('/pendaftaran-kegiatan',[RiwayatController::class, 'pendaftaran']);
    Route::post('/daftar-kegiatan',[UserController::class, 'daftarKegiatan']);
    Route::post('/batal-daftar',[UserController::class, 'batalDaftar']);
});

Route::middleware(['auth','cekData','ketua'])->group(function () { 
    Route::get('/request-anggota-baru',[AnggotaOMKController::class, 'index']);
    Route::get('/semua-anggota-omk',[AnggotaOMKController::class, 'semua']);
    Route::get('/kegiatan-omk',[KegiatanController::class, 'index']);
    Route::get('/absensi-kegiatan',[AbsensiController::class, 'index']);
    Route::get('/absensi-kegiatan/{kegiatan:slug}',[AbsensiController::class, 'detail']);
    Route::get('/riwayat-kegiatan/{kegiatan:slug}',[DashboardController::class, 'detail']);
    Route::put('/update-absensi',[AbsensiController::class, 'updateAbsensi']);
    Route::post('/aktif-akun',[AnggotaOMKController::class, 'akunAktif']);
    Route::post('/tolak-akun',[AnggotaOMKController::class, 'tolakAktif']);
    Route::post('/hapus-user',[AnggotaOMKController::class, 'hapusAkun']);
}); 