<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat;

class PerawatProfilController extends Controller
{
    public function create()
    {
        // kalau profil sudah ada, langsung ke dashboard
        if (Perawat::where('id_user', auth()->user()->iduser)->exists()) {
            return redirect()->route('perawat.dashboard');
        }

        return view('perawat.profil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat'        => 'required|min:10',
            'no_hp'         => 'required|numeric|digits_between:10,15',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan'    => 'required|min:2',
        ]);

        Perawat::create([
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan'    => $request->pendidikan,
            'id_user'       => auth()->user()->iduser,
        ]);

        return redirect()->route('perawat.dashboard')
            ->with('success', 'Profil perawat berhasil dilengkapi');
    }

    public function index()
    {
        $perawat = Perawat::where('id_user', auth()->user()->iduser)->firstOrFail();

        return view('perawat.profil.index', compact('perawat'));
    }
}
