<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailRMController extends Controller
{
    public function index($idrekam)
    {
         $rekam = DB::table('rekam_medis')
    ->join('pet', 'rekam_medis.idpet', '=', 'pet.idpet')
    ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
    ->join('user', 'role_user.iduser', '=', 'user.iduser')
    ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
    ->where('rekam_medis.idrekam_medis', $idrekam)
    ->select(
        'rekam_medis.*',
        'pet.nama as nama_pet',
        'user.nama as nama_dokter',
        'temu_dokter.no_urut'
    )
    ->first();


        $detail = DB::table('detail_rekam_medis')
            ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
            ->where('detail_rekam_medis.idrekam_medis', $idrekam)
            ->select(
                'detail_rekam_medis.*',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi'
            )
            ->get();

        return view('admin.detail_rm.index', compact('rekam', 'detail'));
    }

    public function create($idrekam)
    {
        $rekam = DB::table('rekam_medis')->where('idrekam_medis', $idrekam)->first();
        $tindakan = DB::table('kode_tindakan_terapi')->orderBy('deskripsi_tindakan_terapi')->get();

        return view('admin.detail_rm.create', compact('rekam', 'tindakan'));
    }

    public function store(Request $request)
    {
        $this->validateDetailRM($request);

        DB::table('detail_rekam_medis')->insert([
            'idrekam_medis' => $request->idrekam_medis,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $this->formatDetail($request->detail),
        ]);

        return redirect()->route('admin.detail_rm.index', $request->idrekam_medis)
            ->with('success', 'Detail Rekam Medis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->first();

        $tindakan = DB::table('kode_tindakan_terapi')->orderBy('deskripsi_tindakan_terapi')->get();

        return view('admin.detail_rm.edit', compact('data', 'tindakan'));
    }

    public function update(Request $request, $id)
    {
        $this->validateDetailRM($request);

        DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->update([
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $this->formatDetail($request->detail),
        ]);

        return redirect()->route('admin.detail_rm.index', $request->idrekam_medis)
            ->with('success', 'Detail Rekam Medis berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->delete();

        return redirect()->route('admin.detail_rm.index', $request->idrekam_medis)
            ->with('success', 'Detail Rekam Medis berhasil dihapus.');
    }

    private function validateDetailRM(Request $request)
    {
        return $request->validate([
            'idrekam_medis' => 'required|integer',
            'idkode_tindakan_terapi' => 'required|integer',
            'detail' => 'nullable|string|max:1000',
        ]);
    }

    private function formatDetail($text)
    {
        return ucfirst(trim($text));
    }
}
