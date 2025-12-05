<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pet;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;

class PerawatRekamMedisController extends Controller
{
    public function index()
    {
        $rekam = RekamMedis::with(['pet', 'detail', 'dokterPemeriksa'])->get();
        return view('perawat.rekam.index', compact('rekam'));
    }

    public function create()
    {
        $pasien = Pet::all();
        $tindakan = KodeTindakanTerapi::all();
        return view('perawat.rekam.create', compact('pasien','tindakan'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'anamnesa' => 'required',
            'temuan_klinis' => 'required',
            'diagnosa' => 'required',
            'idpet' => 'required',
        ]);

        $rekam = RekamMedis::create([
            'anamnesa' => $req->anamnesa,
            'temuan_klinis' => $req->temuan_klinis,
            'diagnosa' => $req->diagnosa,
            'idpet' => $req->idpet,
            'idreservasi_dokter' => 0,  // perawat tidak membuat reservasi
            'dokter_pemeriksa' => 0,    // perawat bukan dokter
        ]);

        // detail tindakan
        if ($req->idkode_tindakan_terapi) {
            DetailRekamMedis::create([
                'idrekam_medis' => $rekam->idrekam_medis,
                'idkode_tindakan_terapi' => $req->idkode_tindakan_terapi,
                'detail' => $req->detail
            ]);
        }

        return redirect()->route('perawat.rekam.index')->with('success', 'Rekam medis berhasil ditambahkan');
    }

    public function show($id)
    {
        $rekam = RekamMedis::with(['pet', 'detail.kode'])->findOrFail($id);
        return view('perawat.rekam.show', compact('rekam'));
    }
}
