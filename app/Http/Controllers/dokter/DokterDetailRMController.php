<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DokterDetailRMController extends Controller
{
    private function getDokterRoleId()
    {
        $roleUser = Auth::user()->roleUser()
            ->where('idrole', 2) // role dokter
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            abort(403, 'Role dokter tidak ditemukan.');
        }

        return $roleUser->idrole_user;
    }

    /**
     * Detail rekam medis
     */
    public function index($idrekam)
    {
        $idroleuser = $this->getDokterRoleId();

        $rekam = DB::table('rekam_medis')
            ->join('pet', 'rekam_medis.idpet', '=', 'pet.idpet')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('rekam_medis.idrekam_medis', $idrekam)
            ->select(
                'rekam_medis.*',
                'pet.nama as nama_pet',
                'temu_dokter.no_urut',
                'user.nama as nama_dokter'
            )
            ->first();

        // Validasi kepemilikan
        if (!$rekam || $rekam->dokter_pemeriksa != $idroleuser) {
            abort(403, 'Anda tidak berhak mengakses rekam medis ini.');
        }

        // Ambil daftar tindakan
        $detail = DB::table('detail_rekam_medis')
            ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
            ->where('detail_rekam_medis.idrekam_medis', $idrekam)
            ->select(
                'detail_rekam_medis.*',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi'
            )
            ->get();

        return view('dokter.detail_rm.index', compact('rekam', 'detail'));
    }

    /**
     * Form tambah detail tindakan
     */
    public function create($idrekam)
    {
        $idroleuser = $this->getDokterRoleId();

        $rekam = DB::table('rekam_medis')
            ->where('idrekam_medis', $idrekam)
            ->where('dokter_pemeriksa', $idroleuser)
            ->first();

        if (!$rekam) {
            abort(403, 'Tidak berhak membuat detail untuk rekam medis ini.');
        }

        $tindakan = DB::table('kode_tindakan_terapi')
            ->orderBy('deskripsi_tindakan_terapi')
            ->get();

        return view('dokter.detail_rm.create', compact('rekam', 'tindakan'));
    }

    /**
     * Simpan detail tindakan
     */
    public function store(Request $request)
    {
        $request->validate([
            'idrekam_medis' => 'required|integer',
            'idkode_tindakan_terapi' => 'required|integer',
            'detail' => 'nullable|string|max:1000',
        ]);

        $idroleuser = $this->getDokterRoleId();

        $rekam = DB::table('rekam_medis')
            ->where('idrekam_medis', $request->idrekam_medis)
            ->where('dokter_pemeriksa', $idroleuser)
            ->first();

        if (!$rekam) {
            abort(403, 'Tidak berhak menambahkan detail pada rekam medis ini.');
        }

        DB::table('detail_rekam_medis')->insert([
            'idrekam_medis' => $request->idrekam_medis,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $this->formatText($request->detail),
        ]);

            DB::table('temu_dokter')
        ->where('idreservasi_dokter', $rekam->idreservasi_dokter)
        ->update(['status' => 3]);

        return redirect()
            ->route('dokter.detail_rm.index', $request->idrekam_medis)
            ->with('success', 'Detail tindakan berhasil ditambahkan.');
    }

    /**
     * Form edit detail tindakan
     */
    public function edit($id)
    {
        $idroleuser = $this->getDokterRoleId();

        $detail = DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $id)
            ->first();

        if (!$detail) {
            abort(404);
        }

        $rekam = DB::table('rekam_medis')
            ->where('idrekam_medis', $detail->idrekam_medis)
            ->where('dokter_pemeriksa', $idroleuser)
            ->first();

        if (!$rekam) {
            abort(403, 'Tidak berhak mengedit detail ini.');
        }

        $tindakan = DB::table('kode_tindakan_terapi')->get();

        return view('dokter.detail_rm.edit', compact('detail', 'tindakan'));
    }

    /**
     * Update detail tindakan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required|integer',
            'detail' => 'nullable|string|max:1000',
        ]);

        $idroleuser = $this->getDokterRoleId();

        $detail = DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $id)
            ->first();

        $rekam = DB::table('rekam_medis')
            ->where('idrekam_medis', $detail->idrekam_medis)
            ->where('dokter_pemeriksa', $idroleuser)
            ->first();

        if (!$rekam) {
            abort(403, 'Tidak berhak mengupdate detail ini.');
        }

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $id)
            ->update([
                'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
                'detail' => $this->formatText($request->detail),
            ]);

        return redirect()
            ->route('dokter.detail_rm.index', $detail->idrekam_medis)
            ->with('success', 'Detail tindakan berhasil diperbarui.');
    }

    /**
     * Hapus detail tindakan
     */
    public function destroy($id)
    {
        $idroleuser = $this->getDokterRoleId();

        $detail = DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->first();

        $rekam = DB::table('rekam_medis')
            ->where('idrekam_medis', $detail->idrekam_medis)
            ->where('dokter_pemeriksa', $idroleuser)
            ->first();

        if (!$rekam) {
            abort(403, 'Tidak berhak menghapus detail ini.');
        }

        DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->delete();

        return redirect()
            ->route('dokter.detail_rm.index', $detail->idrekam_medis)
            ->with('success', 'Detail tindakan berhasil dihapus.');
    }

    /**
     * Formatting text helper
     */
    private function formatText($text)
    {
        return ucfirst(trim($text));
    }
}
