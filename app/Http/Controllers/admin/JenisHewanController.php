<?php

namespace App\Http\Controllers\admin;

use App\Models\JenisHewan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    public function index(Request $request)
{
    $q = $request->input('q');
    $query = DB::table('jenis_hewan');

    if ($q) {
        $query->where('nama_jenis_hewan', 'like', "%{$q}%");
    }
    $jenis = $query->orderBy('idjenis_hewan', 'asc')->paginate(15);
    return view('admin.jenis_hewan.index', compact('jenis', 'q'));
}


    public function create()
    {
        return view('admin.jenis_hewan.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_jenis_hewan' => 'required|string|max:255',
    ]);

    $nama = trim($request->nama_jenis_hewan);

    DB::table('jenis_hewan')->insert([
        'nama_jenis_hewan' => $nama
    ]);

    return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis hewan dibuat.');
}

public function edit($id)
{
    $item = DB::table('jenis_hewan')->where('idjenis_hewan', $id)->first();
    return view('admin.jenis_hewan.edit', compact('item'));
}

public function update(Request $request, $id)
{
    $request->validate(['nama_jenis_hewan' => 'required|string|max:255']);
    DB::table('jenis_hewan')->where('idjenis_hewan', $id)->update([
        'nama_jenis_hewan' => trim($request->nama_jenis_hewan)
    ]);
    return redirect()->route('admin.jenis-hewan.index')->with('success','Berhasil diupdate.');
}

public function destroy($id)
{
    DB::table('jenis_hewan')->where('idjenis_hewan', $id)->delete();
    return back()->with('success','Data dihapus.');
}


    private function validateJenisHewan($request)
    {
        $request->validate([
        'nama_jenis_hewan' => 'required|min:3|unique:jenis_hewan,nama_jenis_hewan'
    ], [
        'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi',
        'nama_jenis_hewan.min' => 'Minimal 3 karakter',
        'nama_jenis_hewan.unique' => 'Data sudah ada'
    ]);
    }

    private function createJenisHewan($request)
{
    return [
        'nama_jenis_hewan' => $this->formatNamaJenisHewan($request->nama_jenis_hewan)
    ];
}

private function formatNamaJenisHewan($nama)
{
    return ucwords(strtolower($nama));
}
}
