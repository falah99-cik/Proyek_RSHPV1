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
use App\Http\Controllers\site\SiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\PemilikController;

Route::get('/home', [SiteController::class, 'home'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/visi', [SiteController::class, 'visi'])->name('visi');
Route::get('/login', [SiteController::class, 'login'])->name('login');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/jenis-hewan', [JenisHewanController::class, 'index']);
    Route::get('/pemilik', [PemilikController::class, 'index']);
    Route::get('/ras-hewan', [RasHewanController::class, 'index']);
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index']);
    Route::get('/tindakan', [KodeTindakanTerapiController::class, 'index']);
    Route::get('/pet', [PetController::class, 'index']);
    Route::get('/role', [RoleController::class, 'index']);
    Route::get('/user_role', [UserRoleController::class, 'index']);
    // Dashboard home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
