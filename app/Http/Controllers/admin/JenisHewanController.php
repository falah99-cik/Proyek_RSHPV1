<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $query = DB::table('jenis_hewan');

        if ($q) {
            $query->where('nama_jenis_hewan', 'like', "%{$q}%");
        }

        $jenis = $query->orderBy('idjenis_hewan')->paginate(15);

        return view('admin.jenis_hewan.index', compact('jenis', 'q'));
    }

    public function create()
    {
        return view('admin.jenis_hewan.create');
    }

    public function store(Request $request)
    {
        $this->validateJenis($request);

        $data = $this->buildJenisData($request);

        DB::table('jenis_hewan')->insert($data);

        return redirect()
            ->route('admin.jenis_hewan.index')
            ->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenis = JenisHewan::findOrFail($id);
        return view('admin.jenis_hewan.edit', compact('jenis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|min:3'
        ]);

        $jenis = JenisHewan::findOrFail($id);

        $jenis->update(
            $this->buildJenisData($request)
        );

        return redirect()
            ->route('admin.jenis_hewan.index')
            ->with('success', 'Jenis hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        JenisHewan::findOrFail($id)->delete();

        return redirect()
            ->route('admin.jenis_hewan.index')
            ->with('success', 'Jenis hewan berhasil dihapus.');
    }

    private function validateJenis($request)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|min:3|unique:jenis_hewan,nama_jenis_hewan'
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.min'      => 'Minimal 3 karakter.',
            'nama_jenis_hewan.unique'   => 'Jenis hewan sudah terdaftar.'
        ]);
    }

    private function buildJenisData($request)
    {
        return [
            'nama_jenis_hewan' => $this->formatJenisName($request->nama_jenis_hewan)
        ];
    }

    private function formatJenisName($value)
    {
        return ucwords(strtolower(trim($value)));
    }
}
