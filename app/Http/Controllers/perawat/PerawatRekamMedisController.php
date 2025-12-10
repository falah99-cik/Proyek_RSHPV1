<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use App\Models\User;
use Illuminate\Http\Request;

class PerawatRekamMedisController extends Controller
{
    public function index()
    {
        $rm = RekamMedis::with(['pet', 'temuDokter'])
                ->orderBy('idrekam_medis', 'DESC')
                ->get();

        return view('perawat.rekam.index', compact('rm'));
    }

    public function create(Request $request)
    {
        $temu = TemuDokter::with('pet')->findOrFail($request->idreservasi_dokter);

        $dokter = User::whereHas('roleAktif', function ($q) {
            $q->where('nama_role', 'Dokter');
        })->get();

        return view('perawat.rekam.create', compact('temu', 'dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anamnesa'            => 'required',
            'temuan_klinis'       => 'required',
            'diagnosa'            => 'nullable',
            'idreservasi_dokter'  => 'required|exists:temu_dokter,idreservasi_dokter',
            'idpet'               => 'required|exists:pet,idpet',
        ]);

        $reservasi = TemuDokter::findOrFail($request->idreservasi_dokter);

        // CREATE REKAM MEDIS
        RekamMedis::create([
            'created_at'          => now(),
            'anamnesa'            => $request->anamnesa,
            'temuan_klinis'       => $request->temuan_klinis,
            'diagnosa'            => $request->diagnosa,
            'idreservasi_dokter'  => $request->idreservasi_dokter,
            'idpet'               => $request->idpet,
            'dokter_pemeriksa'    => $reservasi->idrole_user,
        ]);

        // UPDATE STATUS TEMU DOKTER → 2 = SIAP DIPERIKSA DOKTER
        $reservasi->update([
            'status'     => 2,
            'updated_at' => now(),   // tetap boleh karena tabel temu_dokter punya updated_at
        ]);

        return redirect()->route('perawat.rekam.index')
            ->with('success', 'Rekam Medis berhasil dibuat dan dikirim ke Dokter.');
    }

    public function edit($id)
    {
        $rm = RekamMedis::findOrFail($id);
        return view('perawat.rekam.edit', compact('rm'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'anamnesa'            => 'required',
            'temuan_klinis'       => 'required',
            'diagnosa'            => 'nullable',
        ]);

        $rm = RekamMedis::findOrFail($id);
        $rm->update($data);  // created_at tidak berubah, timestamps OFF

        return redirect()->route('perawat.rekam.index')
            ->with('success', 'Rekam Medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        RekamMedis::destroy($id);

        return back()->with('success', 'Rekam Medis berhasil dihapus.');
    }
}
