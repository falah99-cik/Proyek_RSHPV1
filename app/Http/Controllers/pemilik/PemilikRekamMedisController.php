<?php
namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\RekamMedis;

class PemilikRekamMedisController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::where('iduser', Auth::id())->first();

        $rekam = RekamMedis::with(['pet', 'dokter', 'detail.kodeTindakan'])
            ->whereHas('pet', function ($q) use ($pemilik) {
                $q->where('idpemilik', $pemilik->idpemilik);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pemilik.rekam.index', compact('rekam'));
    }

    public function show($id)
    {
        $rekam = RekamMedis::with(['pet', 'dokter', 'detail.kodeTindakan'])
            ->where('idrekam_medis', $id)
            ->firstOrFail();

        return view('pemilik.rekam.show', compact('rekam'));
    }
}

