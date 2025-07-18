<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\DataKelasController;
use Illuminate\Support\Facades\Route;
use App\Livewire\AbsenSiswa;
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

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth', 'isGuru'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/guru/dashboard', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/data/siswa', [GuruController::class, 'data_siswa'])->name('data_siswa');
    Route::post('/guru/create/data/siswa', [SiswaController::class, 'create_data_siswa'])->name('create_data_siswa');
    Route::get('/guru/update/data/siswa/{id}', [SiswaController::class, 'update_data_siswa'])->name('update_data_siswa');
    Route::patch('/guru/updated/data/siswa/{id}', [SiswaController::class, 'updated_data_siswa'])->name('updated_data_siswa');
    Route::get('/guru/deleted/data/siswa/{id}', [SiswaController::class, 'deleted_data_siswa'])->name('deleted_data_siswa');
    Route::get('/guru/cetak/kartu/absen/', [SiswaController::class, 'cetak_kartu_absen'])->name('cetak_kartu_absen');
    Route::get('/guru/scann/barcode/absen/', [SiswaController::class, 'scan_barcode'])->name('scan_barcode');
    Route::get('/guru/data/kelas', [DataKelasController::class, 'data_kelas'])->name('data_kelas');
    Route::post('/guru/create/data/kelas', [DataKelasController::class, 'create_data_kelas'])->name('create_data_kelas');
    Route::get('/guru/update/data/kelas/{id}', [DataKelasController::class, 'update_data_kelas'])->name('update_data_kelas');
    Route::patch('/guru/updated/data/kelas/{id}', [DataKelasController::class, 'updated_data_kelas'])->name('updated_data_kelas');
    Route::get('/guru/deleted/data/kelas/{id}', [DataKelasController::class, 'deleted_data_kelas'])->name('deleted_data_kelas');
    Route::get('/guru/scan/absen/post/{nis}', [DevController::class, 'scan_post'])->name('scan_post');
    Route::get('/guru/data/absen', [DevController::class, 'data_absen'])->name('data_absen');
    Route::post('/guru/create/data/absen', [DevController::class, 'create_data_absen'])->name('create_data_absen');
    Route::get('/guru/update/data/absen/{id}', [DevController::class, 'update_data_absen'])->name('update_data_absen');
    Route::patch('/guru/updated/data/absen/{id}', [DevController::class, 'updated_data_absen'])->name('updated_data_absen');
    Route::get('/guru/deleted/data/absen/{id}', [DevController::class, 'deleted_data_absen'])->name('deleted_data_absen');
    Route::get('/guru/data/pegawai', [DataPegawaiController::class, 'data_pegawai'])->name('data_pegawai');
    Route::post('/guru/create/data/pegawai', [DataPegawaiController::class, 'create_data_pegawai'])->name('create_data_pegawai');
    Route::get('/guru/update/data/pegawai/{id}', [DataPegawaiController::class, 'update_data_pegawai'])->name('update_data_pegawai');
    Route::patch('/guru/updated/data/pegawai/{id}', [DataPegawaiController::class, 'updated_data_pegawai'])->name('updated_data_pegawai');
    Route::get('/guru/deleted/data/pegawai/{id}', [DataPegawaiController::class, 'deleted_data_pegawai'])->name('deleted_data_pegawai');
    
    //livewire
    Route::get('/absen/siswa', AbsenSiswa::class)->name('absensi_siswa');

});

Route::middleware(['auth', 'isSiswa'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.index');
});

Route::middleware(['auth', 'isKepsek'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/kepsek/dashboard', [KepsekController::class, 'index'])->name('kepsek.index');
});

Route::middleware(['auth', 'isDev'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/dev/dashboard', [DevController::class, 'index'])->name('dev.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
