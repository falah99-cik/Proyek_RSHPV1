<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DokterProfilController extends Controller
{
        public function create()
    {
        $dokter = Dokter::where('id_user', auth()->user()->iduser)->first();

        if ($dokter) {
            return redirect()->route('dokter.dashboard');
        }

        return view('dokter.profil.create');
    }
    public function index()
    {
        $user = Auth::user();

        $role_data = $user->roleAktif()->first();

        $dokter = Dokter::where('id_user', $user->iduser)->first();

        return view('dokter.profil.index', compact('user', 'role_data', 'dokter'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'alamat'        => 'required|min:10',
        'no_hp'         => 'required|numeric|digits_between:10,15',
        'bidang_dokter' => 'required|min:3',
        'jenis_kelamin' => 'required|in:L,P'
    ], [
        'alamat.required'        => 'Alamat wajib diisi',
        'no_hp.required'         => 'No HP wajib diisi',
        'no_hp.numeric'          => 'No HP harus berupa angka',
        'bidang_dokter.required' => 'Bidang dokter wajib diisi',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
    ]);

    Dokter::create([
        'alamat'        => $validated['alamat'],
        'no_hp'         => $validated['no_hp'],
        'bidang_dokter' => $validated['bidang_dokter'],
        'jenis_kelamin' => $validated['jenis_kelamin'],
        'id_user'       => auth()->user()->iduser
    ]);

    return redirect()->route('dokter.dashboard')
        ->with('success', 'Profil dokter berhasil dilengkapi');
}
}
