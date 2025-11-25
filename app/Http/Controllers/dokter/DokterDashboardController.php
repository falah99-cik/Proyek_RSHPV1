<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use App\Models\Pet;
use App\Models\KodeTindakanTerapi;

class DokterDashboardController extends Controller
{
    public function index()
    {
        $jumlahReservasi = TemuDokter::count();
        $jumlahRekamMedis = RekamMedis::count();
        $jumlahPasien = Pet::count();
        $jumlahTindakan = KodeTindakanTerapi::count();

        $antrian = TemuDokter::with('pet')
            ->where('status', 0)
            ->orderBy('waktu_daftar', 'ASC')
            ->get();

        return view('dokter.dashboard', compact(
            'jumlahReservasi',
            'jumlahRekamMedis',
            'jumlahPasien',
            'jumlahTindakan',
            'antrian'
        ));
    }
}
