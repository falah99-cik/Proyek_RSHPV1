<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\Pet;

class PemilikProfilController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')
            ->where('iduser', Auth::id())
            ->first();

        $pet = Pet::with(['rasHewan.jenisHewan'])
            ->where('idpemilik', $pemilik->idpemilik)
            ->get();

        return view('pemilik.profil.index', compact('pemilik', 'pet'));
    }
}
