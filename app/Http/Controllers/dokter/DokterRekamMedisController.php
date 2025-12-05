<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DokterRekamMedisController extends Controller
{
    public function index()
    {
        // Ambil role_user ID untuk role dokter (idrole = 2)
        $roleUser = Auth::user()->roleUser()
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            abort(403, 'Role dokter tidak ditemukan.');
        }

        $idRoleUser = $roleUser->idrole_user;

        // Ambil rekam medis yang diperiksa oleh dokter ini
        $rekam = DB::table('rekam_medis')
            ->join('pet', 'rekam_medis.idpet', '=', 'pet.idpet')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->where('rekam_medis.dokter_pemeriksa', $idRoleUser)
            ->select(
                'rekam_medis.*',
                'pet.nama as nama_pet',
                'temu_dokter.no_urut'
            )
            ->orderBy('rekam_medis.idrekam_medis', 'DESC')
            ->get();

        return view('dokter.rekam_medis.index', compact('rekam'));
    }

    /**
     * Menyimpan rekam medis baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'idreservasi'     => 'required|integer',
            'idpet'           => 'required|integer',
            'anamnesa'        => 'required|string',
            'temuan_klinis'   => 'required|string',
            'diagnosa'        => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // Ambil role dokter yang sedang login
            $roleUser = Auth::user()->roleUser()
                ->where('idrole', 2)
                ->where('status', 1)
                ->first();

            if (!$roleUser) {
                abort(403, 'Role dokter tidak ditemukan.');
            }

            $idRoleUser = $roleUser->idrole_user;

            // Simpan rekam medis
            RekamMedis::create([
                'anamnesa'            => $request->anamnesa,
                'temuan_klinis'       => $request->temuan_klinis,
                'diagnosa'            => $request->diagnosa,
                'idpet'               => $request->idpet,
                'dokter_pemeriksa'    => $idRoleUser,                 // sesuai DB
                'idreservasi_dokter'  => $request->idreservasi,
                'created_at'          => now(),
            ]);

            // Update status temu dokter menjadi "1" (selesai/ditangani)
            TemuDokter::where('idreservasi_dokter', $request->idreservasi)
                ->update(['status' => 1]);

            DB::commit();

            return redirect()
                ->route('dokter.rekam_medis.index')
                ->with('success', 'Rekam medis berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('dokter.rekam_medis.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
