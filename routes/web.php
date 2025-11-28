<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\JenisHewanController;
use App\Http\Controllers\admin\RasHewanController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\KategoriKlinisController;
use App\Http\Controllers\admin\KodeTindakanTerapiController;
use App\Http\Controllers\admin\PetController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserRoleController;
use App\Http\Controllers\admin\PemilikController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\dokter\DokterRekamMedisController;
use App\Http\Controllers\dokter\DokterDashboardController;
use App\Http\Controllers\pemilik\PemilikDashboardController;
use App\Http\Controllers\perawat\PerawatDashboardController;
use App\Http\Controllers\resepsionis\ResepsionisDashboardController;

use App\Http\Controllers\site\SiteController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/visi', [SiteController::class, 'visi'])->name('visi');
Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login')->with('success', 'Logout berhasil!');
})->name('logout.get');


Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['auth','isAdmin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis_hewan.index');
    Route::get('/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('jenis_hewan.create');
    Route::post('/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('jenis_hewan.store');
    Route::get('/pemilik', [PemilikController::class, 'index']);
    Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras_hewan.index');
    Route::get('/ras-hewan/create', [RasHewanController::class, 'create'])->name('ras_hewan.create');
    Route::post('/ras-hewan/store', [RasHewanController::class, 'store'])->name('ras_hewan.store');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori_klinis.index');
    Route::get('/kategori-klinis/create', [KategoriKlinisController::class, 'create'])->name('kategori_klinis.create');
    Route::post('/kategori-klinis/store', [KategoriKlinisController::class, 'store'])->name('kategori_klinis.store');
    Route::get('/tindakan', [KodeTindakanTerapiController::class, 'index']);
    Route::get('/pet', [PetController::class, 'index']);
    Route::get('/role', [RoleController::class, 'index']);
    Route::get('/user_role', [UserRoleController::class, 'index']);

});

Route::middleware(['auth', 'isDokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterDashboardController::class, 'index'])->name('dokter.dashboard');
    Route::post('/dokter/rekam-medis/store', 
        [DokterRekamMedisController::class, 'store']
    )->name('dokter.rekam_medis.store');
});

Route::middleware(['auth', 'isPemilik'])->group(function () {
    Route::get('/pemilik/dashboard', [PemilikDashboardController::class, 'index'])
        ->name('pemilik.dashboard');
});

Route::middleware(['auth', 'isPerawat'])->group(function () {
    Route::get('/perawat/dashboard', [PerawatDashboardController::class, 'index'])
        ->name('perawat.dashboard');
});

Route::middleware(['auth', 'isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [ResepsionisDashboardController::class, 'index'])
        ->name('resepsionis.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
