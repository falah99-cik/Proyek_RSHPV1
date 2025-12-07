<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use Illuminate\Support\Carbon;

class ResepsionisDashboardController extends Controller
{
public function index()
{
    $totalPemilik = Pemilik::count();
    $totalPet = Pet::count();

    // TOTAL ANTRIAN HARI INI
    $totalAntrian = TemuDokter::whereDate('waktu_daftar', today())->count();

    // TOTAL YANG MASIH MENUNGGU
    $totalMenunggu = TemuDokter::whereDate('waktu_daftar', today())
                        ->where('status', 0)
                        ->count();

    // SEMUA ANTRIAN HARI INI
    $antrianHariIni = TemuDokter::with(['pet.pemilik', 'roleUser.user'])
                        ->whereDate('waktu_daftar', today())
                        ->orderBy('no_urut', 'asc')
                        ->get();

    // ANTRIAN AKTIF (yang masih status = 0)
    $antrianAktif = TemuDokter::with(['pet.pemilik'])
                        ->whereDate('waktu_daftar', today())
                        ->where('status', 0)
                        ->orderBy('no_urut', 'asc')
                        ->get();

    $todayRegistrations = TemuDokter::with(['pet.pemilik'])
                        ->whereDate('waktu_daftar', today())
                        ->orderBy('no_urut', 'asc')
                        ->get();

    $recentAntrian = TemuDokter::with(['pet.pemilik'])
                    ->orderBy('waktu_daftar', 'desc')
                    ->limit(5)
                    ->get();


    return view('resepsionis.dashboard', [
        'totalPemilik'   => $totalPemilik,
        'totalPet'       => $totalPet,
        'totalAntrian'   => $totalAntrian,
        'totalMenunggu'  => $totalMenunggu,
        'antrianHariIni' => $antrianHariIni,
        'antrianAktif'   => $antrianAktif,
        'todayRegistrations'  => $todayRegistrations,
        'recentAntrian'       => $recentAntrian,
    ]);
}

}
