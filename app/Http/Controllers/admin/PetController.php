<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\RasHewan;
use App\Models\Pemilik;
use Illuminate\Support\Facades\DB;

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

    public function edit($id)
{
    $pet = Pet::findOrFail($id);
    $ras = RasHewan::with('jenisHewan')->get();
    $pemilik = Pemilik::with('user')->get();

    return view('admin.pet.edit', compact('pet', 'ras', 'pemilik'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|min:3',
        'tanggal_lahir' => 'required|date',
        'warna_tanda' => 'required|min:3',
        'jenis_kelamin' => 'required|in:J,B',
        'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        'idpemilik' => 'required|exists:pemilik,idpemilik',
    ]);

    $pet = Pet::findOrFail($id);

    $pet->update([
        'nama' => ucwords(strtolower($request->nama)),
        'tanggal_lahir' => $request->tanggal_lahir,
        'warna_tanda' => ucwords(strtolower($request->warna_tanda)),
        'jenis_kelamin' => $request->jenis_kelamin,
        'idras_hewan' => $request->idras_hewan,
        'idpemilik' => $request->idpemilik,
    ]);

    return redirect()->route('admin.pet.index')
                     ->with('success', 'Pet berhasil diperbarui.');
}

public function destroy($id)
{
    Pet::findOrFail($id)->delete();

    return redirect()->route('admin.pet.index')
                     ->with('success', 'Pet berhasil dihapus.');
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

    public function rasByJenis($idjenis)
    {
        $ras = DB::table('ras_hewan')
            ->where('idjenis_hewan', $idjenis)
            ->orderBy('nama_ras')
            ->get();

        return response()->json($ras);
    }

    public function daftarPet()
    {
        $pets = DB::table('pet as p')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->join('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->select('p.*','u.nama as nama_pemilik','r.nama_ras')
            ->paginate(15);

        return view('admin.pet.index', compact('pets'));
    }

    public function statistikPetPerJenis()
    {
        $stats = DB::table('pet as p')
            ->join('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->join('jenis_hewan as j', 'r.idjenis_hewan', '=', 'j.idjenis_hewan')
            ->select('j.nama_jenis_hewan', DB::raw('count(p.idpet) as total'))
            ->groupBy('j.idjenis_hewan', 'j.nama_jenis_hewan')
            ->get();

        return view('admin.statistik.pet_per_jenis', compact('stats'));
    }

}
