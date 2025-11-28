<?php

namespace App\Http\Controllers\admin;

use App\Models\KodeTindakanTerapi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanTerapiController extends Controller
{
    public function index()
{
    $tindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();

    return view('admin.tindakan.index', compact('tindakan'));
}

public function create()
{
    $kategori = Kategori::all();
    $kategoriKlinis = KategoriKlinis::all();

    return view('admin.tindakan.create', compact('kategori', 'kategoriKlinis'));
}

public function store(Request $request)
{
    $this->validateTindakan($request);

    $data = $this->createTindakan($request);

    KodeTindakanTerapi::create($data);

    return redirect()->route('admin.tindakan.index')
        ->with('success', 'Tindakan terapi berhasil ditambahkan');
}

private function validateTindakan($request)
{
    $request->validate([
        'kode' => 'required|min:2|unique:kode_tindakan_terapi,kode',
        'deskripsi_tindakan_terapi' => 'required|min:3',
        'idkategori' => 'required|exists:kategori,idkategori',
        'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
    ], [
        'kode.required' => 'Kode wajib diisi',
        'kode.unique' => 'Kode sudah digunakan',

        'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi',

        'idkategori.required' => 'Kategori wajib dipilih',
        'idkategori_klinis.required' => 'Kategori klinis wajib dipilih',
    ]);
}

private function createTindakan($request)
{
    return [
        'kode' => strtoupper($request->kode),
        'deskripsi_tindakan_terapi' => $this->formatText($request->deskripsi_tindakan_terapi),
        'idkategori' => $request->idkategori,
        'idkategori_klinis' => $request->idkategori_klinis,
    ];
}

private function formatText($text)
{
    return ucfirst(strtolower($text));
}

}
