<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\RasHewan;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with(['pemilik.user', 'ras'])->get();
        return view('resepsionis.pet.index', compact('pet'));
    }

    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $ras = RasHewan::all();
        return view('resepsionis.pet.create', compact('pemilik', 'ras'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePet($request);

        $this->createPet($data);

        return redirect()->route('resepsionis.pet.index')
            ->with('success', 'Data pet berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $pemilik = Pemilik::with('user')->get();
        $ras = RasHewan::all();

        return view('resepsionis.pet.edit', compact('pet', 'pemilik', 'ras'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validatePet($request);

        $pet = Pet::findOrFail($id);

        $this->updatePet($pet, $data);

        return redirect()->route('resepsionis.pet.index')
            ->with('success', 'Data pet berhasil diperbarui');
    }

    public function destroy($id)
    {
        Pet::destroy($id);

        return redirect()->route('resepsionis.pet.index')
            ->with('success', 'Data pet berhasil dihapus');
    }

    private function validatePet(Request $request)
    {
        return $request->validate([
            'nama'          => 'required',
            'tanggal_lahir' => 'required|date',
            'warna_tanda'   => 'required',
            'jenis_kelamin' => 'required',
            'idpemilik'     => 'required',
            'idras_hewan'   => 'required',
        ]);
    }

    private function createPet($data)
    {
        Pet::create([
            'nama'          => $this->formatNama($data['nama']),
            'tanggal_lahir' => $data['tanggal_lahir'],
            'warna_tanda'   => $data['warna_tanda'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'idpemilik'     => $data['idpemilik'],
            'idras_hewan'   => $data['idras_hewan'],
        ]);
    }

    private function updatePet($pet, $data)
    {
        $pet->update([
            'nama'          => $this->formatNama($data['nama']),
            'tanggal_lahir' => $data['tanggal_lahir'],
            'warna_tanda'   => $data['warna_tanda'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'idpemilik'     => $data['idpemilik'],
            'idras_hewan'   => $data['idras_hewan'],
        ]);
    }

    private function formatNama($nama)
    {
        return ucwords(strtolower($nama));
    }
}
