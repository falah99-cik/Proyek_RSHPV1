<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pet;
use App\Models\KodeTindakanTerapi;

class PerawatDashboardController extends Controller
{
    public function index()
    {
        // jumlah rekam medis
        $jumlahRekamMedis = RekamMedis::count();

        // jumlah pasien (pet)
        $jumlahPasien = Pet::count();

        // jumlah tindakan terapi
        $jumlahTindakan = KodeTindakanTerapi::count();

        // daftar rekam medis terbaru
        $rekamMedisBaru = RekamMedis::with('pet')
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get();

        return view('perawat.dashboard', compact(
            'jumlahRekamMedis',
            'jumlahPasien',
            'jumlahTindakan',
            'rekamMedisBaru'
        ));
    }
}
