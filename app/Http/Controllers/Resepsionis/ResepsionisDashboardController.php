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

    $totalAntrian = TemuDokter::whereDate('waktu_daftar', today())->count();

    $totalMenunggu = TemuDokter::whereDate('waktu_daftar', today())
                        ->where('status', 0)
                        ->count();

    $antrianHariIni = TemuDokter::with(['pet.pemilik', 'roleUser.user'])
                        ->whereDate('waktu_daftar', today())
                        ->orderBy('no_urut')
                        ->get();

    $antrianAktif = TemuDokter::with(['pet.pemilik'])
                        ->whereDate('waktu_daftar', today())
                        ->where('status', 0)
                        ->orderBy('no_urut')
                        ->get();

$todayRegistrations = TemuDokter::with(['pet.pemilik'])
    ->whereDate('waktu_daftar', today())
    ->orderBy('waktu_daftar', 'desc')
    ->first();

    $recentAntrian = TemuDokter::with(['pet.pemilik', 'roleUser.user'])
                        ->whereDate('waktu_daftar', today())
                        ->orderBy('waktu_daftar', 'desc')
                        ->limit(5)
                        ->get();

    return view('resepsionis.dashboard', compact(
        'totalPemilik',
        'totalPet',
        'totalAntrian',
        'totalMenunggu',
        'antrianHariIni',
        'antrianAktif',
        'todayRegistrations',
        'recentAntrian'
    ));
}
}
