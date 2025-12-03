<?php

namespace App\Http\Controllers\admin;

use App\Models\KategoriKlinis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriKlinisController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $query = DB::table('kategori_klinis');

        if ($q) {
            $query->where('nama_kategori_klinis', 'like', "%{$q}%");
        }

        $kategoriKlinis = $query->orderBy('idkategori_klinis', 'asc')->paginate(15);

        return view('admin.kategori_klinis.index', compact('kategoriKlinis', 'q'));
    }

public function create()
{
    return view('admin.kategori_klinis.create');
}

public function store(Request $request)
{
    $this->validateKategoriKlinis($request);

    $data = $this->createKategoriKlinis($request);

    KategoriKlinis::create($data);

    return redirect()->route('admin.kategori_klinis.index')
        ->with('success', 'Kategori klinis berhasil ditambahkan');
}

    public function edit($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);

        return view('admin.kategori_klinis.edit', compact('kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $this->validateKategoriKlinisUpdate($request, $id);

        $kategoriKlinis = KategoriKlinis::findOrFail($id);

        $kategoriKlinis->update([
            'nama_kategori_klinis' => $this->formatKategoriKlinis($request->nama_kategori_klinis)
        ]);

        return redirect()
            ->route('admin.kategori_klinis.index')
            ->with('success', 'Kategori klinis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        KategoriKlinis::findOrFail($id)->delete();

        return redirect()
            ->route('admin.kategori_klinis.index')
            ->with('success', 'Kategori klinis berhasil dihapus.');
    }

private function validateKategoriKlinis($request)
{
    $request->validate([
        'nama_kategori_klinis' => 'required|min:3|unique:kategori_klinis,nama_kategori_klinis'
    ], [
        'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi',
        'nama_kategori_klinis.min' => 'Minimal 3 karakter',
        'nama_kategori_klinis.unique' => 'Kategori klinis sudah ada',
    ]);
}

private function createKategoriKlinis($request)
{
    return [
        'nama_kategori_klinis' => $this->formatKategoriKlinis($request->nama_kategori_klinis)
    ];
}

private function formatKategoriKlinis($text)
{
    return ucwords(strtolower($text));
}

}
