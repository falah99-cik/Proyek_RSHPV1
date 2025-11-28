<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\RasHewan;
use App\Models\Pemilik;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with(['ras.jenisHewan', 'pemilik.user'])->get();
        return view('admin.pet.index', compact('pet'));
    }

    public function create()
    {
        $ras = RasHewan::with('jenisHewan')->get();
        $pemilik = Pemilik::with('user')->get();

        return view('admin.pet.create', compact('ras', 'pemilik'));
    }

    public function store(Request $request)
    {
        $this->validatePet($request);

        $data = $this->createPet($request);

        Pet::create($data);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil ditambahkan');
    }

    private function validatePet($request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'required|min:3',
            'jenis_kelamin' => 'required|in:J,B',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
        ]);
    }

    private function createPet($request)
    {
        return [
            'nama' => $this->formatText($request->nama),
            'tanggal_lahir' => $request->tanggal_lahir,
            'warna_tanda' => $this->formatText($request->warna_tanda),
            'jenis_kelamin' => $request->jenis_kelamin,
            'idras_hewan' => $request->idras_hewan,
            'idpemilik' => $request->idpemilik,
        ];
    }

    private function formatText($t)
    {
        return ucwords(strtolower($t));
    }
}
