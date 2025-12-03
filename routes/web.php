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
use App\Http\Controllers\admin\DokterController;
use App\Http\Controllers\admin\PerawatController;
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
    Route::get('/tindakan/{id}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('tindakan.edit');
    Route::put('/tindakan/{id}/update', [KodeTindakanTerapiController::class, 'update'])->name('tindakan.update');
    Route::delete('/tindakan/{id}/destroy', [KodeTindakanTerapiController::class, 'destroy'])->name('tindakan.destroy');

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
    Route::get('/user-role/{id}/edit', [UserRoleController::class, 'edit'])->name('user_role.edit');
    Route::put('/user-role/{id}/update', [UserRoleController::class, 'update'])->name('user_role.update');
    Route::delete('/user-role/{id}', [UserRoleController::class, 'destroy'])->name('user_role.destroy');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::post('/dokter/store', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/edit/{id}', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::post('/dokter/update/{id}', [DokterController::class, 'update'])->name('dokter.update');
    Route::get('/dokter/delete/{id}', [DokterController::class, 'delete'])->name('dokter.delete');

    Route::get('/perawat', [PerawatController::class, 'index'])->name('perawat.index');
    Route::get('/perawat/create', [PerawatController::class, 'create'])->name('perawat.create');
    Route::post('/perawat/store', [PerawatController::class, 'store'])->name('perawat.store');
    Route::get('/perawat/edit/{id}', [PerawatController::class, 'edit'])->name('perawat.edit');
    Route::post('/perawat/update/{id}', [PerawatController::class, 'update'])->name('perawat.update');
    Route::get('/perawat/delete/{id}', [PerawatController::class, 'delete'])->name('perawat.delete');

    Route::get('/temu-dokter', [\App\Http\Controllers\admin\TemuDokterController::class, 'index'])->name('temu_dokter.index');
    Route::get('/temu-dokter/create', [\App\Http\Controllers\admin\TemuDokterController::class, 'create'])->name('temu_dokter.create');
    Route::post('/temu-dokter/store', [\App\Http\Controllers\admin\TemuDokterController::class, 'store'])->name('temu_dokter.store');
    Route::get('/temu-dokter/{id}/edit', [\App\Http\Controllers\admin\TemuDokterController::class, 'edit'])->name('temu_dokter.edit');
    Route::put('/temu-dokter/{id}/update', [\App\Http\Controllers\admin\TemuDokterController::class, 'update'])->name('temu_dokter.update');
    Route::delete('/temu-dokter/{id}/delete', [\App\Http\Controllers\admin\TemuDokterController::class, 'destroy'])->name('temu_dokter.destroy');

    Route::get('/rekam-medis', [\App\Http\Controllers\admin\RekamMedisController::class, 'index'])->name('rekam_medis.index');
    Route::get('/rekam-medis/create', [\App\Http\Controllers\admin\RekamMedisController::class, 'create'])->name('rekam_medis.create');
    Route::post('/rekam-medis/store', [\App\Http\Controllers\admin\RekamMedisController::class, 'store'])->name('rekam_medis.store');
    Route::get('/rekam-medis/{id}/edit', [\App\Http\Controllers\admin\RekamMedisController::class, 'edit'])->name('rekam_medis.edit');
    Route::put('/rekam-medis/{id}/update', [\App\Http\Controllers\admin\RekamMedisController::class, 'update'])->name('rekam_medis.update');
    Route::delete('/rekam-medis/{id}/delete', [\App\Http\Controllers\admin\RekamMedisController::class, 'destroy'])->name('rekam_medis.destroy');

    Route::get('/detail-rm/{idrekam}', [\App\Http\Controllers\admin\DetailRMController::class, 'index'])->name('detail_rm.index');
    Route::get('/detail-rm/{idrekam}/create', [\App\Http\Controllers\admin\DetailRMController::class, 'create'])->name('detail_rm.create');
    Route::post('/detail-rm/store', [\App\Http\Controllers\admin\DetailRMController::class, 'store'])->name('detail_rm.store');
    Route::get('/detail-rm/edit/{id}', [\App\Http\Controllers\admin\DetailRMController::class, 'edit'])->name('detail_rm.edit');
    Route::put('/detail-rm/update/{id}', [\App\Http\Controllers\admin\DetailRMController::class, 'update'])->name('detail_rm.update');
    Route::delete('/detail-rm/delete/{id}', [\App\Http\Controllers\admin\DetailRMController::class, 'destroy'])->name('detail_rm.destroy');
});

Route::middleware(['auth', 'isDokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterDashboardController::class, 'index'])->name('dokter.dashboard');
    Route::post('/dokter/rekam-medis/store', [DokterRekamMedisController::class, 'store'])->name('dokter.rekam_medis.store');
    Route::get('/dokter/rekam-medis', [DokterRekamMedisController::class, 'index'])->name('dokter.rekam_medis.index');
    Route::get('/dokter/rekam-medis/{id}', [DokterRekamMedisController::class, 'show'])->name('dokter.rekam_medis.show');

    Route::get('/dokter/detail-rm/{idrekam}/create', [DokterRekamMedisController::class, 'createDetail'])->name('dokter.detail_rm.create');
    Route::post('/dokter/detail-rm/store', [DokterRekamMedisController::class, 'storeDetail'])->name('dokter.detail_rm.store');
    Route::get('/dokter/detail-rm/{id}/edit', [DokterRekamMedisController::class, 'editDetail'])->name('dokter.detail_rm.edit');
    Route::put('/dokter/detail-rm/{id}/update', [DokterRekamMedisController::class, 'updateDetail'])->name('dokter.detail_rm.update');
    Route::delete('/dokter/detail-rm/{id}/delete', [DokterRekamMedisController::class, 'deleteDetail'])->name('dokter.detail_rm.delete');

    Route::get('/dokter/profil', [DokterDashboardController::class, 'profil'])->name('dokter.profil');
});

Route::middleware(['auth', 'isPemilik'])->group(function () {
    Route::get('/pemilik/dashboard', [PemilikDashboardController::class, 'index'])->name('pemilik.dashboard');
    Route::get('/pemilik/jadwal', [\App\Http\Controllers\pemilik\PemilikTemuDokterController::class, 'index'])->name('pemilik.jadwal');
    Route::get('/pemilik/rekam-medis', [\App\Http\Controllers\pemilik\PemilikRekamMedisController::class, 'index'])->name('pemilik.rekam_medis');
    Route::get('/pemilik/profil', [PemilikDashboardController::class, 'profil'])->name('pemilik.profil');
    Route::get('/pemilik/pet', [\App\Http\Controllers\pemilik\PemilikPetController::class, 'index'])->name('pemilik.pet');
});

Route::middleware(['auth', 'isPerawat'])->group(function () {
    Route::get('/perawat/dashboard', [PerawatDashboardController::class, 'index'])->name('perawat.dashboard');
    Route::get('/perawat/rekam-medis', [\App\Http\Controllers\perawat\PerawatRekamMedisController::class, 'index'])->name('perawat.rekam_medis.index');
    Route::get('/perawat/rekam-medis/create', [\App\Http\Controllers\perawat\PerawatRekamMedisController::class, 'create'])->name('perawat.rekam_medis.create');
    Route::post('/perawat/rekam-medis/store', [\App\Http\Controllers\perawat\PerawatRekamMedisController::class, 'store'])->name('perawat.rekam_medis.store');
    Route::get('/perawat/rekam-medis/{id}/show', [\App\Http\Controllers\perawat\PerawatRekamMedisController::class, 'show'])->name('perawat.rekam_medis.show');

    Route::get('/perawat/detail-rm/{idrekam}', [\App\Http\Controllers\perawat\PerawatRekamMedisController::class, 'detail'])->name('perawat.detail_rm.index');

    Route::get('/perawat/profil', [PerawatDashboardController::class, 'profil'])->name('perawat.profil');
});

Route::middleware(['auth', 'isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [ResepsionisDashboardController::class, 'index'])->name('resepsionis.dashboard');
    Route::resource('/resepsionis/pemilik', \App\Http\Controllers\resepsionis\ResepsionisPemilikController::class);

    Route::resource('/resepsionis/pet', \App\Http\Controllers\resepsionis\ResepsionisPetController::class);

    Route::resource('/resepsionis/temu-dokter', \App\Http\Controllers\resepsionis\ResepsionisTemuDokterController::class);
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
