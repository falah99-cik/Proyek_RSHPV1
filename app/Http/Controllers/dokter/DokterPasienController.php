<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DokterPasienController extends Controller
{
public function index()
{
    $pasien = \DB::table('pet')
        ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
        ->join('user', 'pemilik.iduser', '=', 'user.iduser')
        ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
        ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
        ->select(
            'pet.*',
            'user.nama as nama_pemilik',
            'pemilik.no_wa',
            'jenis_hewan.nama_jenis_hewan as jenis_hewan',
            'ras_hewan.nama_ras as ras_hewan'
        )
        ->orderBy('pet.nama', 'asc')
        ->get();

    return view('dokter.pasien.index', compact('pasien'));
}
}
