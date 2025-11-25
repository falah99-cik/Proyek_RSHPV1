<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\User;

class ResepsionisDashboardController extends Controller
{
    public function index()
    {
        // Total antrean hari ini
        $tanggalHariIni = date('Y-m-d');
        $jumlahAntreanHariIni = TemuDokter::whereDate('waktu_daftar', $tanggalHariIni)->count();

        // Total pasien (pet)
        $jumlahPasien = Pet::count();

        // Total dokter (role id = 2)
        $jumlahDokter = User::whereHas('roleAktif', function ($q) {
            $q->where('role.idrole', 2)
              ->where('role_user.status', 1);
        })->count();

        // Daftar antrean hari ini
        $antrian = TemuDokter::with(['pet'])
            ->whereDate('waktu_daftar', $tanggalHariIni)
            ->orderBy('no_urut', 'ASC')
            ->get();

        return view('resepsionis.dashboard', compact(
            'jumlahAntreanHariIni',
            'jumlahPasien',
            'jumlahDokter',
            'antrian'
        ));
    }
}
