<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Support\Facades\DB;

class DokterRekamMedisController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'idreservasi' => 'required|integer',
            'idpet' => 'required|integer',
            'dokter_pemeriksa' => 'required|integer',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            // 1. Simpan rekam medis
            RekamMedis::create([
                'anamnesa' => $request->anamnesa,
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => $request->diagnosa,
                'idpet' => $request->idpet,
                'dokter_pemeriksa' => $request->dokter_pemeriksa,
                'idreservasi_dokter' => $request->idreservasi,
                'created_at' => now()
            ]);

            // 2. Update status temu dokter
            TemuDokter::where('idreservasi_dokter', $request->idreservasi)
                ->update(['status' => 1]);

            DB::commit();

            return redirect()
                ->route('dokter.dashboard')
                ->with('success', 'Pemeriksaan dan rekam medis berhasil disimpan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->route('dokter.dashboard')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
