<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Pet;

class PerawatPasienController extends Controller
{
    public function index()
    {
        $pasien = Pet::with(['pemilik.user', 'ras.jenisHewan'])->get();
        return view('perawat.pasien.index', compact('pasien'));
    }
}
