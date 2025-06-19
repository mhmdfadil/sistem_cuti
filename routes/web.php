<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login', [LoginController::class, 'login']);

Route::get('admin/akun', [AdminController::class, 'admin_akun'])->name('admin.akun');
// Route untuk Delete User
Route::delete('/admin/user/delete/{id}', [AdminController::class, 'admin_akundestroy'])->name('delete-user');
Route::put('/admin/user/update/{id}', [AdminController::class, 'admin_akunupdate'])->name('update-user');
Route::post('/admin/user/store', [AdminController::class, 'admin_akunstore'])->name('store-user');

Route::get('admin/pegawai', [AdminController::class, 'admin_pegawai'])->name('admin.pegawai');
// Route untuk Delete User
Route::delete('/admin/pegawai/delete/{id}', [AdminController::class, 'admin_pegawaidestroy'])->name('delete-pegawai');
Route::put('/admin/pegawai/update/{id}', [AdminController::class, 'admin_pegawaiupdate'])->name('update-pegawai');
Route::post('/admin/pegawai/store', [AdminController::class, 'admin_pegawaistore'])->name('store-pegawai');


Route::get('admin/pengajuan', [AdminController::class, 'admin_pengajuan'])->name('admin.pengajuan');
// Route untuk Delete User
Route::delete('/admin/pengajuan/delete/{id}', [AdminController::class, 'admin_pengajuandestroy'])->name('delete-pengajuan');
Route::put('/admin/pengajuan/update/proses/{id}', [AdminController::class, 'admin_pengajuanproses'])->name('proses-pengajuan');
Route::put('/admin/pengajuan/update/terima/{id}', [AdminController::class, 'admin_pengajuanterima'])->name('terima-pengajuan');
Route::put('/admin/pengajuan/update/tolak/{id}', [AdminController::class, 'admin_pengajuantolak'])->name('tolak-pengajuan');

// Route untuk admin dashboard
Route::get('admin/dashboard', [LoginController::class, 'admin_dashboard'])->name('admin.dashboard');
// Route untuk pegawai dashboard
Route::get('pegawai/dashboard', [LoginController::class, 'pegawai_dashboard'])->name('pegawai.dashboard');

Route::get('admin/profil', [AdminController::class, 'admin_profil'])->name('admin.profil');
Route::put('/profile/update', [AdminController::class, 'admin_profilupdate'])->name('profile.update');

Route::get('pegawai/profil', [PegawaiController::class, 'pegawai_profil'])->name('pegawai.profil');
Route::put('/profile/updatep', [PegawaiController::class, 'pegawai_profilupdate'])->name('profile.updatep');

Route::get('pegawai/biodata', [PegawaiController::class, 'pegawai_biodata'])->name('pegawai.biodata');
Route::put('/biodata/update', [pegawaiController::class, 'pegawai_biodataupdate'])->name('biodata.updatep');

Route::get('pegawai/pengajuan', [PegawaiController::class, 'pegawai_pengajuan'])->name('pegawai.pengajuan');
Route::post('/pegawai/pengajuan/store', [PegawaiController::class, 'pegawai_pengajuanstore'])->name('store-pengajuanp');

Route::get('pegawai/riwayat', [PegawaiController::class, 'pegawai_riwayat'])->name('pegawai.riwayat');