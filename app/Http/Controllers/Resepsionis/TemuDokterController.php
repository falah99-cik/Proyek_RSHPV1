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

        // Dokter = idrole = 2
        $dokter = RoleUser::with('user')
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();

        return view('resepsionis.temu_dokter.create', compact('pet', 'dokter'));
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

        // Dokter = idrole = 2
        $dokter = RoleUser::with('user')
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();

        return view('resepsionis.temu_dokter.edit', compact('data', 'pet', 'dokter'));
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
            'idpet'       => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
        ]);
    }

    private function validateTemuDokterUpdate(Request $request)
    {
        return $request->validate([
            'idpet'       => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'status'      => 'required',
        ]);
    }


    private function createTemuDokter($data)
    {
        TemuDokter::create([
            'no_urut'     => $this->generateNoUrut(),
            'idpet'       => $data['idpet'],
            'idrole_user' => $data['idrole_user'],
            'status'      => 1,
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

    private function generateNoUrut()
    {
        $today = now()->format('Ymd');

        $last = TemuDokter::whereDate('waktu_daftar', now()->toDateString())
                ->orderBy('no_urut', 'DESC')
                ->first();

        $next = $last ? ((int)explode('-', $last->no_urut)[1] + 1) : 1;

        return $today . '-' . str_pad($next, 3, '0', STR_PAD_LEFT);
    }
}
