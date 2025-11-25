<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class PemilikDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cari data pemilik berdasarkan iduser
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        // Ambil semua pet miliknya
        $pets = Pet::with(['jenisHewan', 'rasHewan'])
            ->where('idpemilik', $pemilik->idpemilik ?? 0)
            ->get();

        // Hitung
        $jumlahPet = $pets->count();

        return view('pemilik.dashboard', compact(
            'jumlahPet',
            'pets',
            'pemilik'
        ));
    }
}
