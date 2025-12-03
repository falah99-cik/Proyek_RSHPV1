<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function index()
    {
        $data = DB::table('rekam_medis')
            ->join('pet', 'rekam_medis.idpet', '=', 'pet.idpet')
            ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->select(
                'rekam_medis.*',
                'pet.nama as nama_pet',
                'user.nama as nama_dokter',
                'temu_dokter.no_urut'
            )
            ->orderBy('idrekam_medis', 'DESC')
            ->get();

        return view('admin.rekam_medis.index', compact('data'));
    }

    public function create()
    {
        $pet = DB::table('pet')->get();

        $dokter = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('role_user.idrole', 2)
            ->get();

        $temu = DB::table('temu_dokter')->get();

        return view('admin.rekam_medis.create', compact('pet', 'dokter', 'temu'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRekamMedis($request);

        DB::table('rekam_medis')->insert([
            'created_at' => now(),
            'anamnesa' => $this->formatText($request->anamnesa),
            'temuan_klinis' => $this->formatText($request->temuan_klinis),
            'diagnosa' => $this->formatText($request->diagnosa),
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'dokter_pemeriksa' => $request->dokter_pemeriksa,
            'idpet' => $request->idpet,
        ]);

        return redirect()->route('admin.rekam_medis.index')
            ->with('success', 'Rekam Medis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();

        $pet = DB::table('pet')->get();

        $dokter = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('role_user.idrole', 2)
            ->get();

        $temu = DB::table('temu_dokter')->get();

        return view('admin.rekam_medis.edit', compact('data', 'pet', 'dokter', 'temu'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRekamMedis($request);

        DB::table('rekam_medis')->where('idrekam_medis', $id)->update([
            'anamnesa' => $this->formatText($request->anamnesa),
            'temuan_klinis' => $this->formatText($request->temuan_klinis),
            'diagnosa' => $this->formatText($request->diagnosa),
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'dokter_pemeriksa' => $request->dokter_pemeriksa,
            'idpet' => $request->idpet,
        ]);

        return redirect()->route('admin.rekam_medis.index')
            ->with('success', 'Rekam Medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('rekam_medis')->where('idrekam_medis', $id)->delete();

        return redirect()->route('admin.rekam_medis.index')
            ->with('success', 'Rekam Medis berhasil dihapus.');
    }

    private function validateRekamMedis(Request $request)
    {
        return $request->validate([
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
            'idreservasi_dokter' => 'required|integer',
            'dokter_pemeriksa' => 'required|integer',
            'idpet' => 'required|integer',
        ]);
    }

    private function formatText($text)
    {
        return ucfirst(trim($text));
    }
}
