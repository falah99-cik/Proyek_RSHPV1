<?php

namespace App\Http\Controllers\admin;

use App\Models\KategoriKlinis;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class KategoriKlinisController extends Controller
{
    public function index()
{
    $kategoriKlinis = KategoriKlinis::all();
    return view('admin.kategori_klinis.index', compact('kategoriKlinis'));
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
