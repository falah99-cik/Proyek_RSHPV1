<?php
namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TemuDokter;
use App\Models\Pemilik;

class PemilikTemuDokterController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::where('iduser', Auth::id())->first();

        $jadwal = TemuDokter::with(['pet', 'roleUser.user'])
            ->whereHas('pet', function ($q) use ($pemilik) {
                $q->where('idpemilik', $pemilik->idpemilik);
            })
            ->orderBy('waktu_daftar', 'desc')
            ->get();

        return view('pemilik.jadwal.index', compact('jadwal'));
    }
}

