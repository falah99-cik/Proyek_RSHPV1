<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RekamMedis;
use App\Models\TemuDokter;

class PemilikDashboardController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::where('iduser', Auth::id())->first();

        // Jumlah Pet dimiliki
        $jumlahPet = Pet::where('idpemilik', $pemilik->idpemilik)->count();

        // Jadwal berlangsung (status 0 / 1 / 2)
        $jadwalAktif = TemuDokter::whereHas('pet', function ($q) use ($pemilik) {
                $q->where('idpemilik', $pemilik->idpemilik);
            })
            ->whereIn('status', [0,1,2])
            ->count();

        // Rekam Medis
        $rekamTotal = RekamMedis::whereHas('pet', function ($q) use ($pemilik) {
            $q->where('idpemilik', $pemilik->idpemilik);
        })->count();

        return view('pemilik.dashboard.index', compact(
            'pemilik',
            'jumlahPet',
            'jadwalAktif',
            'rekamTotal'
        ));
    }
}
