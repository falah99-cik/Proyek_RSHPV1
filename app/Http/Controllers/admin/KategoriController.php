<?php

namespace App\Http\Controllers\admin;

use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class KategoriController extends Controller
{
    public function index()
{
    $kategori = Kategori::all();
    return view('admin.kategori.index', compact('kategori'));
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
