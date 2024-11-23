<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TanggapanController;
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

Route::get('/', function () {
    return view('welcome');
});

//login
Route::get('/login', function () {
    return view('login.login');
})->name('login');
Route::get('/register', function () {
    return view('login.register');
})->name('register');
Route::post('/register/post', [AuthController::class, 'register'])->name('register.post');
Route::post('/login/post', [AuthController::class, 'login'])->name('login.post');





//admin
Route::get('/admin', [PetugasController::class, 'buatdashboardadmin'])->name('adminIndex');

//Route crud masyarakat
Route::get('/admin/MasterMasyarakat', [MasyarakatController::class, 'index'])->name('MasterMasyarakat');
Route::get('/admin/create/masyarakat', [MasyarakatController::class, 'create'])->name('masyarakat.create');
Route::post('/admin/store/masyarakat', [MasyarakatController::class, 'store'])->name('masyarakat.store');
Route::get('/admin/edit/masyarakat/{nik}', [MasyarakatController::class, 'edit'])->name('masyarakat.edit');
Route::put('/admin/update/masyarakat/{nik}', [MasyarakatController::class, 'update'])->name('masyarakat.update');
Route::delete('/admin/update/masyarakat/{nik}', [MasyarakatController::class, 'destroy'])->name('masyarakat.destroy');

Route::get('/admin/MasterPetugas', [PetugasController::class, 'index'])->name('MasterPetugas');
Route::get('/admin/create/petugas', [PetugasController::class, 'create'])->name('petugas.create');
Route::post('/admin/store/petugas', [PetugasController::class, 'store'])->name('petugas.store');
Route::get('/admin/edit/petugas/{putra_idPetugas}', [PetugasController::class, 'edit'])->name('petugas.edit');
Route::put('/admin/update/petugas/{putra_idPetugas}', [PetugasController::class, 'update'])->name('petugas.update');
Route::delete('/admin/delete/petugas/{putra_idPetugas}', [PetugasController::class, 'destroy'])->name('petugas.destroy');
//buat status
Route::get('/laporan{status}', [PetugasController::class, 'AmbilLaporan'])->name('laporan.index');
Route::get('/laporan/konfirmasi/{id_pengaduan}', [PetugasController::class, 'konfirmasiLaporan'])->name('laporan.konfirmasi');
Route::get('/laporanSelesai/{id_laporan}', [PetugasController::class, 'LaporanSelesaiAdmin'])->name('laporanSelesai.index');
Route::get('/laporan/{id}/tanggapan', [TanggapanController::class, 'create'])->name('laporan.tanggapan.create');
Route::post('/tanggapan/{id_pengaduan}', [TanggapanController::class, 'store'])->name('tanggapan.store');

Route::get('/tanggapan/{id_pengaduan}/get', [TanggapanController::class, 'ambiltanggapan'])->name('tanggapan.get');

Route::get('/report', [PetugasController::class, 'Laporan'])->name('report.index');
Route::get('/report/print/{id}', [PetugasController::class, 'print'])->name('laporan.print');
Route::get('/report/print-all', [PetugasController::class, 'printAll'])->name('laporan.printAll');

Route::get('/cari', [PetugasController::class, 'cari'])->name('cari.index');
Route::get('/cariMas', [MasyarakatController::class, 'cariMas'])->name('cariMas.index');

//masyarakat
Route::get('/masyarakat', function () {
    return view('Masyarakat.lapor');
})->name('masyarakatIndex');
Route::get('/masyarakat/detailLaporan', [PengaduanController::class, 'index'])->name('putra_detailPengaduan');
Route::get('/masyarakat/create', [PengaduanController::class, 'create'])->name('laporan.create');
Route::post('/masyarakat/store', [PengaduanController::class, 'store'])->name('laporan.store');
// Route::get('/masyarakat/edit/{putra_idLaporan}', [PengaduanController::class, 'edit'])->name('laporan.edit');
// Route::put('/masyarakat/update/{putra_idLaporan}', [PengaduanController::class, 'update'])->name('laporan.update');
Route::delete('/masyarakat/delete/{putra_idLaporan}', [PengaduanController::class, 'destroy'])->name('laporan.destroy');

Route::get('/panduan', function () {return view('Masyarakat.Panduan');})->name('panduan');
Route::get('/admin/delete/laporan/{putra_idLaporan}', [PetugasController::class, 'HapusLaporanMasyarakat'])->name('laporanMasyarakat.hapus');

Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');



//petugas
Route::get('/petugas', [PetugasController::class, 'buatdashboardpetugas'])->name('petugasIndex');

Route::get('/petugas/laporan{status}', [PetugasController::class, 'PetugasAmbilLaporan'])->name('Petugaslaporan.index');
Route::get('petugas/laporan/konfirmasi/{putra_idLaporan}', [PetugasController::class, 'konfirmasiLaporanPet'])->name('laporan.konfirmasPet');
Route::get('/petugas/laporanSelesai/Petugas/{id_laporan}', [PetugasController::class, 'LaporanSelesaiPet'])->name('laporanSelesai.Petugas');
Route::get('/petugas/laporan/tanggapan/{id}', [TanggapanController::class, 'Petugascreate'])->name('Petugaslaporan.tanggapan.create');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logoutmasyarakat');
