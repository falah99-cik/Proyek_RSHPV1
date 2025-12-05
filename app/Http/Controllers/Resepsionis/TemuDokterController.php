<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    public function index()
    {
        $data = TemuDokter::with(['pet', 'roleUser.user'])->get();
        return view('resepsionis.temu_dokter.index', compact('data'));
    }

    public function create()
    {
        $pet = Pet::all();
        $perawat = RoleUser::where('idrole', 3)->with('user')->get();

        return view('resepsionis.temu_dokter.create', compact('pet', 'perawat'));
    }

    public function store(Request $request)
    {
        $data = $this->validateTemuDokter($request);

        $this->createTemuDokter($data);

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Temu dokter berhasil dibuat');
    }

    public function edit($id)
    {
        $data = TemuDokter::findOrFail($id);
        $pet = Pet::all();
        $perawat = RoleUser::where('idrole', 3)->with('user')->get();

        return view('resepsionis.temu_dokter.edit', compact('data', 'pet', 'perawat'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateTemuDokterUpdate($request);

        $temu = TemuDokter::findOrFail($id);

        $this->updateTemuDokter($temu, $data);

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        TemuDokter::destroy($id);
        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Data berhasil dihapus');
    }

    private function validateTemuDokter(Request $request)
    {
        return $request->validate([
            'idpet' => 'required',
            'idrole_user' => 'required',
        ]);
    }

    private function validateTemuDokterUpdate(Request $request)
    {
        return $request->validate([
            'idpet'       => 'required',
            'idrole_user' => 'required',
            'status'      => 'required',
        ]);
    }

    private function createTemuDokter($data)
    {
        TemuDokter::create([
            'no_urut'     => $this->generateAntrian(),
            'status'      => 1,
            'idpet'       => $data['idpet'],
            'idrole_user' => $data['idrole_user'],
        ]);
    }

    private function updateTemuDokter($temu, $data)
    {
        $temu->update([
            'idpet'       => $data['idpet'],
            'idrole_user' => $data['idrole_user'],
            'status'      => $data['status'],
        ]);
    }

    private function generateAntrian()
    {
        return 'TD-' . date('Ymd-His');
    }
}
