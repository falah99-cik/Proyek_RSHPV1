<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('resepsionis.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('resepsionis.pemilik.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatePemilik($request);

        $this->createPemilik($data);

        return redirect()->route('resepsionis.pemilik.index')
            ->with('success', 'Data pemilik berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('resepsionis.pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);

        $data = $this->validatePemilikUpdate($request);

        $this->updatePemilik($pemilik, $data);

        return redirect()->route('resepsionis.pemilik.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Pemilik::destroy($id);
        return redirect()->route('resepsionis.pemilik.index')
            ->with('success', 'Data berhasil dihapus');
    }

    private function validatePemilik(Request $request)
    {
        return $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email|unique:user,email',
            'no_wa'  => 'required',
            'alamat' => 'required',
        ]);
    }

    private function validatePemilikUpdate(Request $request)
    {
        return $request->validate([
            'no_wa'  => 'required',
            'alamat' => 'required',
        ]);
    }

    private function createPemilik($data)
    {
        $user = User::create([
            'nama'     => $this->formatNama($data['nama']),
            'email'    => strtolower($data['email']),
            'password' => Hash::make('12345678'),
        ]);

        RoleUser::create([
            'iduser' => $user->iduser,
            'idrole' => 5,
        ]);

        Pemilik::create([
            'iduser' => $user->iduser,
            'no_wa'  => $data['no_wa'],
            'alamat' => $data['alamat'],
        ]);
    }

    private function updatePemilik($pemilik, $data)
    {
        $pemilik->update([
            'no_wa'  => $data['no_wa'],
            'alamat' => $data['alamat'],
        ]);
    }

    private function formatNama($nama)
    {
        return ucwords(strtolower($nama));
    }
}
