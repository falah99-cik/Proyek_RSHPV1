<?php

namespace App\Http\Controllers\admin;

use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
public function index(Request $request)
{
    $q = $request->input('q');

    $kategori = DB::table('kategori')
        ->when($q, function ($query) use ($q) {
            $query->where('nama_kategori', 'LIKE', "%{$q}%");
        })
        ->orderBy('idkategori', 'asc')
        ->paginate(15);

    return view('admin.kategori.index', compact('kategori', 'q'));
}


public function create()
{
    return view('admin.kategori.create');
}

public function store(Request $request)
{
    $this->validateKategori($request);

    $data = $this->createKategori($request);

    Kategori::create($data);

    return redirect()->route('admin.kategori.index')
        ->with('success', 'Kategori berhasil ditambahkan');
}

public function edit($id)
{
    $kategori = Kategori::findOrFail($id);
    return view('admin.kategori.edit', compact('kategori'));
}

public function update(Request $request, $id)
{
    $kategori = Kategori::findOrFail($id);

    $this->validateKategori($request);

    $data = $this->createKategori($request);

    $kategori->update($data);

    return redirect()->route('admin.kategori.index')
        ->with('success', 'Kategori berhasil diupdate');
}

public function destroy($id)
{
    $kategori = Kategori::findOrFail($id);
    $kategori->delete();

    return redirect()->route('admin.kategori.index')
        ->with('success', 'Kategori berhasil dihapus');
}



private function validateKategori($request)
{
    $request->validate([
        'nama_kategori' => 'required|min:3|unique:kategori,nama_kategori'
    ], [
        'nama_kategori.required' => 'Nama kategori wajib diisi',
        'nama_kategori.min' => 'Minimal 3 karakter',
        'nama_kategori.unique' => 'Kategori sudah ada',
    ]);
}
private function createKategori($request)
{
    return [
        'nama_kategori' => $this->formatKategori($request->nama_kategori)
    ];
}

private function formatKategori($text)
{
    return ucwords(strtolower($text));
}

}
