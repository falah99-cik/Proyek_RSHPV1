<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class PerawatTemuDokterController extends Controller
{
    public function index()
    {
        $role = auth()->user()->roleUserActive;

if (!$role) {
    return back()->with('error', 'Role perawat tidak ditemukan atau tidak aktif.');
}

$idrole_user = $role->idrole_user;

        $antrian = TemuDokter::whereIn('status', [0, 1])
    ->with('pet.pemilik.user')
    ->orderBy('no_urut')
    ->get();

        return view('perawat.temu.index', compact('antrian'));
    }

    public function proses($id)
    {
        $temu = TemuDokter::findOrFail($id);

        $temu->update([
            'status' => 1
        ]);

        return back()->with('success', 'Pasien mulai diproses. Silakan buat Rekam Medis.');
    }
}
