<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatController extends Controller
{
    public function index()
    {
        $perawat = DB::table('perawat')
            ->join('user', 'perawat.id_user', '=', 'user.iduser')
            ->select('perawat.*', 'user.nama AS nama_user')
            ->get();

        return view('admin.perawat.index', compact('perawat'));
    }

    public function create()
{
    $user = DB::table('user')
        ->join('role_user', 'role_user.iduser', '=', 'user.iduser')
        ->where('role_user.idrole', 3)
        ->select('user.*')
        ->get();

    return view('admin.perawat.create', compact('user'));
}

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'no_hp' => 'required|max:45',
            'jenis_kelamin' => 'required|max:1',
            'pendidikan' => 'required|max:100',
            'id_user' => 'required|exists:user,iduser',
        ]);

        DB::table('perawat')->insert([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan' => $request->pendidikan,
            'id_user' => $request->id_user,
        ]);

        return redirect()->route('admin.perawat.index')->with('success', 'Data perawat berhasil ditambahkan.');
    }

    public function edit($id)
{
    $perawat = DB::table('perawat')->where('id_perawat', $id)->first();

    $user = DB::table('user')
        ->join('role_user', 'role_user.iduser', '=', 'user.iduser')
        ->where('role_user.idrole', 3)
        ->select('user.*')
        ->get();

    return view('admin.perawat.edit', compact('perawat', 'user'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required',
            'no_hp' => 'required|max:45',
            'jenis_kelamin' => 'required|max:1',
            'pendidikan' => 'required|max:100',
            'id_user' => 'required|exists:user,iduser',
        ]);

        DB::table('perawat')->where('id_perawat', $id)->update([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan' => $request->pendidikan,
            'id_user' => $request->id_user,
        ]);

        return redirect()->route('admin.perawat.index')->with('success', 'Data perawat berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('perawat')->where('id_perawat', $id)->delete();
        return redirect()->route('admin.perawat.index')->with('success', 'Data perawat berhasil dihapus.');
    }
}
