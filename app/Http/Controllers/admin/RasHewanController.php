<?php

namespace App\Http\Controllers\admin;

use App\Models\RasHewan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use app\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenis')->get();
        return view('admin.ras_hewan.index', compact('rasHewan'));
    }

    public function create()
{
    $jenisHewan = JenisHewan::all();

    return view('admin.ras_hewan.create', compact('jenisHewan'));
}

public function store(Request $request)
{
    $this->validateRasHewan($request);

    $data = $this->createRasHewan($request);

    RasHewan::create($data);

    return redirect()->route('admin.ras_hewan.index')
        ->with('success', 'Ras hewan berhasil ditambahkan');
}

private function validateRasHewan($request)
{
    $request->validate([
        'nama_ras' => 'required|min:3',
        'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan'
    ], [
        'nama_ras.required' => 'Nama ras wajib diisi',
        'nama_ras.min' => 'Minimal 3 karakter',

        'idjenis_hewan.required' => 'Jenis hewan wajib dipilih',
        'idjenis_hewan.exists' => 'Jenis hewan tidak valid',
    ]);
}
private function createRasHewan($request)
{
    return [
        'nama_ras' => $this->formatRas($request->nama_ras),
        'idjenis_hewan' => $request->idjenis_hewan
    ];
}

private function formatRas($text)
{
    return ucwords(strtolower($text));
}

}
