<?php

namespace App\Http\Controllers\admin;

use App\Models\JenisHewan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.jenis_hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('admin.jenis_hewan.create');
    }

    public function store(Request $request)
    {
        $this->validateJenisHewan($request);

        $data = $this->createJenisHewan($request);

        JenisHewan::create($data);

        return redirect()->route('admin.jenis_hewan.index')->with('success', 'Data berhasil ditambahkan');
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
