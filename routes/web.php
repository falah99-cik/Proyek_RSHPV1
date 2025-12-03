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
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PemilikController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\dokter\DokterRekamMedisController;
use App\Http\Controllers\dokter\DokterDashboardController;
use App\Http\Controllers\pemilik\PemilikDashboardController;
use App\Http\Controllers\perawat\PerawatDashboardController;
use App\Http\Controllers\resepsionis\ResepsionisDashboardController;

use App\Http\Controllers\site\SiteController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [SiteController::class, 'home'])->name('site.home');
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

Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis_hewan.index');
    Route::get('/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('jenis_hewan.create');
    Route::post('/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('jenis_hewan.store');
    Route::get('/jenis-hewan/{id}/edit', [JenisHewanController::class, 'edit'])->name('jenis_hewan.edit');
    Route::put('/jenis-hewan/{id}/update', [JenisHewanController::class, 'update'])->name('jenis_hewan.update');
    Route::delete('/jenis-hewan/{id}/delete', [JenisHewanController::class, 'destroy'])->name('jenis_hewan.destroy');
    Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
    Route::get('/pemilik/create', [PemilikController::class, 'create'])->name('pemilik.create');
    Route::post('/pemilik/store', [PemilikController::class, 'store'])->name('pemilik.store');
    Route::get('/pemilik/{id}/edit', [PemilikController::class, 'edit'])->name('pemilik.edit');
    Route::put('/pemilik/{id}/update', [PemilikController::class, 'update'])->name('pemilik.update');
    Route::delete('/pemilik/{id}', [PemilikController::class, 'destroy'])->name('pemilik.destroy');
    Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras_hewan.index');
    Route::get('/ras-hewan/create', [RasHewanController::class, 'create'])->name('ras_hewan.create');
    Route::post('/ras-hewan/store', [RasHewanController::class, 'store'])->name('ras_hewan.store');
    Route::get('/ras-hewan/{id}/edit', [RasHewanController::class, 'edit'])->name('ras_hewan.edit');
    Route::put('/ras-hewan/{id}/update', [RasHewanController::class, 'update'])->name('ras_hewan.update');
    Route::delete('/ras-hewan/{id}/delete', [RasHewanController::class, 'destroy'])->name('ras_hewan.destroy');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}/destroy', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori_klinis.index');
    Route::get('/kategori-klinis/create', [KategoriKlinisController::class, 'create'])->name('kategori_klinis.create');
    Route::post('/kategori-klinis/store', [KategoriKlinisController::class, 'store'])->name('kategori_klinis.store');
    Route::get('/kategori-klinis/{id}/edit', [KategoriKlinisController::class, 'edit'])->name('kategori_klinis.edit');
    Route::put('/kategori-klinis/{id}', [KategoriKlinisController::class, 'update'])->name('kategori_klinis.update');
    Route::delete('/kategori-klinis/{id}', [KategoriKlinisController::class, 'destroy'])->name('kategori_klinis.destroy');
    Route::get('/tindakan', [KodeTindakanTerapiController::class, 'index'])->name('tindakan.index');
    Route::get('/tindakan/create', [KodeTindakanTerapiController::class, 'create'])->name('tindakan.create');
    Route::post('/tindakan/store', [KodeTindakanTerapiController::class, 'store'])->name('tindakan.store');
    Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
    Route::get('/ras-by-jenis/{idjenis}', [PetController::class, 'rasByJenis'])->name('ras.by.jenis');
    Route::get('/statistik/pet-per-jenis', [PetController::class, 'statistikPetPerJenis'])->name('statistik.pet.per.jenis');
    Route::get('/pet/create', [PetController::class, 'create'])->name('pet.create');
    Route::post('/pet/store', [PetController::class, 'store'])->name('pet.store');
    Route::get('/pet/{id}/edit', [PetController::class, 'edit'])->name('pet.edit');
    Route::put('/pet/{id}/update', [PetController::class, 'update'])->name('pet.update');
    Route::delete('/pet/{id}', [PetController::class, 'destroy'])->name('pet.destroy');
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/{id}/update', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}/destroy', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::get('/user-role', [UserRoleController::class, 'index'])->name('user_role.index');
    Route::get('/user-role/create', [UserRoleController::class, 'create'])->name('user_role.create');
    Route::post('/user-role/store', [UserRoleController::class, 'store'])->name('user_role.store');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
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

Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        return view('auth.lockscreen');
    })->name('lockscreen');

    Route::post('/unlock', function () {

        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->withErrors(['login' => 'Session expired, silakan login kembali.']);
        }

        if (!\Hash::check(request('password'), $user->password)) {
            return back()->withErrors(['password' => 'Password salah!']);
        }

        $role = $user->roleAktif()->first()?->nama_role;

        switch ($role) {
            case 'Administrator':
                return redirect('/admin/dashboard');

            case 'Dokter':
                return redirect('/dokter/dashboard');

            case 'Perawat':
                return redirect('/perawat/dashboard');

            case 'Resepsionis':
                return redirect('/resepsionis/dashboard');

            case 'Pemilik':
                return redirect('/pemilik/dashboard');
        }

        return redirect('/'); // fallback
    })->name('unlock');

});
