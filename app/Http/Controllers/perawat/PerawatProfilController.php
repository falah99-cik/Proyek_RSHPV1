<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use Illuminate\Support\Facades\Auth;

class PerawatProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $perawat = Perawat::where('id_user', $user->iduser)->first();

        return view('perawat.profil.index', compact('user', 'perawat'));
    }
}
