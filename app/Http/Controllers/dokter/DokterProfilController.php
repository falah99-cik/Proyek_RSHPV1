<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;

class DokterProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $role_data = $user->roleAktif()->first();

        $dokter = Dokter::where('id_user', $user->iduser)->first();

        return view('dokter.profil.index', compact('user', 'role_data', 'dokter'));
    }
}
