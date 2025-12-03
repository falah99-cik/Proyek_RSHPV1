<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemuDokterController extends Controller
{
    public function index()
    {
        $data = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_pet',
                'user.nama as nama_dokter'
            )
            ->orderBy('temu_dokter.waktu_daftar', 'DESC')
            ->get();

        return view('admin.temu_dokter.index', compact('data'));
    }

    public function create()
    {
        $pet = DB::table('pet')->get();

        // Daftar dokter (role = 2)
        $dokter = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('role_user.idrole', 2)
            ->get();

        return view('admin.temu_dokter.create', compact('pet', 'dokter'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateTemuDokter($request);

        DB::table('temu_dokter')->insert([
            'no_urut' => $this->generateNomorUrut(),
            'waktu_daftar' => now(),
            'status' => $this->formatStatus($request->status),
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
        ]);

        return redirect()->route('admin.temu_dokter.index')
            ->with('success', 'Temu Dokter berhasil ditambahkan.');
    }

    public function edit($id)
{
    $data = DB::table('temu_dokter')
        ->where('idreservasi_dokter', $id)
        ->first();

    $pet = DB::table('pet')->get();

    $dokter = DB::table('role_user')
        ->join('user', 'role_user.iduser', '=', 'user.iduser')
        ->where('role_user.idrole', 2)
        ->get();

    return view('admin.temu_dokter.edit', compact('data', 'pet', 'dokter'));
}


    public function update(Request $request, $id)
    {
        $validated = $this->validateTemuDokter($request);

        DB::table('temu_dokter')->where('idreservasi_dokter', $id)->update([
            'status' => $this->formatStatus($request->status),
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
        ]);

        return redirect()->route('admin.temu_dokter.index')
            ->with('success', 'Temu Dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('temu_dokter')->where('idreservasi_dokter', $id)->delete();

        return redirect()->route('admin.temu_dokter.index')
            ->with('success', 'Temu Dokter berhasil dihapus.');
    }

    private function validateTemuDokter(Request $request)
    {
        return $request->validate([
            'idpet' => 'required|integer',
            'idrole_user' => 'required|integer',
            'status' => 'required|in:0,1',
        ], [
            'idpet.required' => 'Pet wajib dipilih.',
            'idrole_user.required' => 'Dokter wajib dipilih.',
            'status.required' => 'Status wajib dipilih.',
        ]);
    }

    private function generateNomorUrut()
{
    $tanggalKode = date('Ymd');

    $last = DB::table('temu_dokter')
        ->whereDate('waktu_daftar', date('Y-m-d'))
        ->selectRaw("MAX(CAST(SUBSTRING_INDEX(no_urut, '-', -1) AS UNSIGNED)) as last_urut")
        ->value('last_urut');

    $nextUrut = $last ? intval($last) + 1 : 1;

    $urutFormatted = str_pad($nextUrut, 3, '0', STR_PAD_LEFT);

    return $tanggalKode . '-' . $urutFormatted;
}
    private function formatStatus($status)
    {
        // status = 1: aktif, 0: selesai
        return $status == 1 ? '1' : '0';
    }
}
