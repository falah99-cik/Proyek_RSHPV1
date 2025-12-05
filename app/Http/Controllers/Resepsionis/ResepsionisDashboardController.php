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
        $today = Carbon::today();

        $count = [
            'pemilik'           => Pemilik::count(),
            'pet'               => Pet::count(),
            'antrian_hari_ini'  => TemuDokter::whereDate('waktu_daftar', $today)->count(),
            'selesai_hari_ini'  => TemuDokter::whereDate('waktu_daftar', $today)->where('status', 0)->count(),
        ];

        $antrian = TemuDokter::with(['pet.pemilik.user', 'roleUser.user'])
            ->whereDate('waktu_daftar', $today)
            ->orderBy('no_urut', 'asc')
            ->get();

        /** @var \Illuminate\Support\Collection|\App\Models\TemuDokter[] $antrian */

        return view('resepsionis.dashboard', compact('count', 'antrian'));
    }
}
