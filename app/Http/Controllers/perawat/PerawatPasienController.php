<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Pet;

class PerawatPasienController extends Controller
{
    public function index()
    {
        $pasien = Pet::with(['pemilik.user', 'ras.jenisHewan'])
                    ->whereHas('rekamMedis') 
                    ->get();

        return view('perawat.pasien.index', compact('pasien'));
    }

    public function show($idpet)
{
    $pasien = Pet::with([
        'pemilik.user',
        'ras.jenisHewan',
        'rekamMedis.tindakan.kode',
        'rekamMedis.dokter.user',
    ])->findOrFail($idpet);

    return view('perawat.pasien.show', compact('pasien'));
}

}
