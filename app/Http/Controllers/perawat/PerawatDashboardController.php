<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use App\Models\Pet;

class PerawatDashboardController extends Controller
{
    public function index()
    {
        $totalRm = RekamMedis::count();

        $pasienRm = Pet::whereHas('rekamMedis')->count();

        $antrian = TemuDokter::where('status', 1)->count();

        $listAntrian = TemuDokter::with(['pet.pemilik.user'])
                ->where('status', 1)
                ->orderBy('waktu_daftar', 'ASC')
                ->take(5)
                ->get();

        $recentRm = RekamMedis::with(['pet', 'dokter.user'])
                ->orderBy('idrekam_medis', 'DESC')
                ->take(5)
                ->get();

        return view('perawat.dashboard.index', compact(
            'totalRm',
            'pasienRm',
            'antrian',
            'listAntrian',
            'recentRm'
        ));
    }
}
