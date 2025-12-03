<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = DB::table('dokter')
            ->join('user', 'dokter.id_user', '=', 'user.iduser')
            ->select('dokter.*', 'user.nama AS nama_user')
            ->get();

        return view('admin.dokter.index', compact('dokter'));
    }

    public function create()
{
    $user = DB::table('user')
        ->join('role_user', 'role_user.iduser', '=', 'user.iduser')
        ->where('role_user.idrole', 2)
        ->select('user.*')
        ->get();

    return view('admin.dokter.create', compact('user'));
}


    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'no_hp' => 'required|max:45',
            'bidang_dokter' => 'required|max:100',
            'jenis_kelamin' => 'required|max:1',
            'id_user' => 'required|exists:user,iduser',
        ]);

        DB::table('dokter')->insert([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'bidang_dokter' => $request->bidang_dokter,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => $request->id_user,
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit($id)
{
    $dokter = DB::table('dokter')->where('id_dokter', $id)->first();

    $user = DB::table('user')
        ->join('role_user', 'role_user.iduser', '=', 'user.iduser')
        ->where('role_user.idrole', 2)
        ->select('user.*')
        ->get();

    return view('admin.dokter.edit', compact('dokter', 'user'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required',
            'no_hp' => 'required|max:45',
            'bidang_dokter' => 'required|max:100',
            'jenis_kelamin' => 'required|max:1',
            'id_user' => 'required|exists:user,iduser',
        ]);

        DB::table('dokter')->where('id_dokter', $id)->update([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'bidang_dokter' => $request->bidang_dokter,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => $request->id_user,
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('dokter')->where('id_dokter', $id)->delete();
        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
