<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();

        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        $users = User::all();

        return view('admin.pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validatePemilik($request);

        $data = $this->createPemilik($request);

        Pemilik::create($data);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil ditambahkan');
    }

    private function validatePemilik($request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser|unique:pemilik,iduser',
            'no_wa' => 'required|min:10',
            'alamat' => 'required|min:5',
        ], [
            'iduser.unique' => 'User ini sudah menjadi pemilik',
        ]);
    }

    private function createPemilik($request)
    {
        return [
            'iduser' => $request->iduser,
            'no_wa' => $request->no_wa,
            'alamat' => $this->formatText($request->alamat),
        ];
    }

    private function formatText($t)
    {
        return ucwords(strtolower($t));
    }
}

