<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigurasiController;
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

Route::get('/spmb/daftar', function () {
    return view('dev.spmb');
})->name('spmb_daftar');

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
   
});

Route::middleware(['auth', 'isGuru'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/data/murid/per/wali/kelas', [GuruController::class, 'data_murid'])->name('data_murid');

});

Route::middleware(['auth', 'isSiswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/profile/siswa', [SiswaController::class, 'profile_siswa'])->name('siswa.profile_siswa');
    Route::get('/kartu/absen/siswa', [SiswaController::class, 'kartu_barcode'])->name('siswa.kartu_barcode');
});

Route::middleware(['auth', 'isKepsek'])->prefix('kepsek')->group(function () {
    Route::get('/dashboard', [KepsekController::class, 'index'])->name('kepsek.index');
});

Route::middleware(['auth', 'isDev'])->prefix('dev')->group(function () {
    
    Route::get('/dashboard', [DevController::class, 'index'])->name('dev.index');
   
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
     Route::get('/data/siswa', [GuruController::class, 'data_siswa'])->name('data_siswa');
    Route::post('/create/data/siswa', [SiswaController::class, 'create_data_siswa'])->name('create_data_siswa');
    Route::get('/update/data/siswa/{id}', [SiswaController::class, 'update_data_siswa'])->name('update_data_siswa');
    Route::patch('/updated/data/siswa/{id}', [SiswaController::class, 'updated_data_siswa'])->name('updated_data_siswa');
    Route::get('/deleted/data/siswa/{id}', [SiswaController::class, 'deleted_data_siswa'])->name('deleted_data_siswa');
    Route::get('/cetak/kartu/absen/', [SiswaController::class, 'cetak_kartu_absen'])->name('cetak_kartu_absen');
    
    Route::get('/data/kelas', [DataKelasController::class, 'data_kelas'])->name('data_kelas');
    Route::get('/setting/kelas', [DataKelasController::class, 'set_kelas'])->name('set_kelas');
    Route::post('/create/data/kelas', [DataKelasController::class, 'create_data_kelas'])->name('create_data_kelas');
    Route::get('/update/data/kelas/{id}', [DataKelasController::class, 'update_data_kelas'])->name('update_data_kelas');
    Route::patch('/updated/data/kelas/{id}', [DataKelasController::class, 'updated_data_kelas'])->name('updated_data_kelas');
    Route::get('/deleted/data/kelas/{id}', [DataKelasController::class, 'deleted_data_kelas'])->name('deleted_data_kelas');

    //kelas untuk siswa
    Route::post('/create/data/kelas/siswa', [DataKelasController::class, 'create_data_kelas_siswa'])->name('create_data_kelas_siswa');
    Route::get('/update/data/kelas/siswa/{id}', [DataKelasController::class, 'update_data_kelas_siswa'])->name('update_data_kelas_siswa');
    Route::patch('/updated/data/kelas/siswa/{id}', [DataKelasController::class, 'updated_data_kelas_siswa'])->name('updated_data_kelas_siswa');
    Route::get('/deleted/data/kelas/siswa/{id}', [DataKelasController::class, 'deleted_data_kelas_siswa'])->name('deleted_data_kelas_siswa');

    //Data pegawai
    Route::get('/data/pegawai', [DataPegawaiController::class, 'data_pegawai'])->name('data_pegawai');
    Route::post('/create/data/pegawai', [DataPegawaiController::class, 'create_data_pegawai'])->name('create_data_pegawai');
    Route::get('/update/data/pegawai/{id}', [DataPegawaiController::class, 'update_data_pegawai'])->name('update_data_pegawai');
    Route::patch('/updated/data/pegawai/{id}', [DataPegawaiController::class, 'updated_data_pegawai'])->name('updated_data_pegawai');
    Route::get('/deleted/data/pegawai/{id}', [DataPegawaiController::class, 'deleted_data_pegawai'])->name('deleted_data_pegawai');

    //fitur absen
    Route::get('/scann/barcode/absen/', [SiswaController::class, 'scan_barcode'])->name('scan_barcode');
    Route::get('/scann/barcode/absen/post/{nis}', [DevController::class, 'scan_post'])->name('scan_post');
    Route::get('/data/absen', [DevController::class, 'data_absen'])->name('data_absen');
    Route::match(['get', 'post'], '/data/get/absen/', [DevController::class, 'get_absen'])->name('get_absen');
    Route::post('/create/data/absen', [DevController::class, 'create_data_absen'])->name('create_data_absen');
    Route::get('/update/data/absen/{id}', [DevController::class, 'update_data_absen'])->name('update_data_absen');
    Route::patch('/updated/data/absen/{id}', [DevController::class, 'updated_data_absen'])->name('updated_data_absen');
    Route::get('/deleted/data/absen/{id}', [DevController::class, 'deleted_data_absen'])->name('deleted_data_absen');  
    Route::get('/laporan/data/absen/siswa', [SiswaController::class, 'lap_absen_siswa'])->name('lap_absen_siswa');
    Route::post('/filter/absen/siswa', [SiswaController::class, 'filter_absen_siswa'])->name('filter_absen_siswa');
    Route::get('/update/data/absen/siswa/{id}', [SiswaController::class, 'update_data_absen_siswa'])->name('update_data_absen_siswa');
    Route::patch('/updated/data/absen/siswa/{id}', [SiswaController::class, 'updated_data_absen_siswa'])->name('updated_data_absen_siswa');
    Route::get('/deleted/data/absen/siswa/{id}', [SiswaController::class, 'deleted_data_absen_siswa'])->name('deleted_data_absen_siswa');
    Route::get('/laporan/data/absen/siswa/bulanan', [SiswaController::class, 'laporan_bulanan_siswa'])->name('laporan_bulanan_siswa');
    Route::post('/filter/laporan/absen/bulanan/siswa', [SiswaController::class, 'filter_lap_bulanan_siswa'])->name('filter_lap_bulanan_siswa');

    //congigurasi
    Route::get('/seting/configurasi/aplikasi', [ConfigurasiController::class, 'index_config'])->name('index_config');
    Route::post('/seting/configurasi/aplikasi', [ConfigurasiController::class, 'create_config'])->name('create_config');
    Route::get('/deleted/data/config/{id}', [ConfigurasiController::class, 'delete_config'])->name('delete_config');
    Route::get('/update/data/config/{id}', [ConfigurasiController::class, 'update_config'])->name('update_config');
    Route::patch('/updated/data/config/{id}', [ConfigurasiController::class, 'updated_config'])->name('updated_config');
    //livewire
    Route::get('/absen/siswa', AbsenSiswa::class)->name('absensi_siswa');

    //export 
    Route::get('/export/data/siswa', [SiswaController::class, 'exportDataSiswa'])->name('exportDataSiswa');
    Route::get('/export/data/pegawai', [DataPegawaiController::class, 'exportDataPegawai'])->name('exportDataPegawai');
    Route::get('/export/data/kelas', [DataKelasController::class, 'exportDataKelas'])->name('exportDataKelas');
    Route::post('/export/data/absensi', [DevController::class, 'export_absensi'])->name('export_absensi');

    //import
    Route::get('/halaman/import', [DevController::class, 'halaman_import'])->name('halaman_import');
    Route::post('/import/data/siswa', [DevController::class, 'import_siswa'])->name('import_siswa');
    Route::post('/import/data/pegawai', [DevController::class, 'import_pegawai'])->name('import_pegawai');
    Route::post('/import/data/kelas', [DevController::class, 'import_kelas'])->name('import_kelas');
});


require __DIR__.'/auth.php';
