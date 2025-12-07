<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DokterDashboardController extends Controller
{
    public function index()
    {
        // Ambil role aktif sebagai dokter
        $roleUser = Auth::user()->roleUser()
            ->where('idrole', 2) // role dokter
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            abort(403, 'Role dokter tidak ditemukan.');
        }

        $idRoleUser = $roleUser->idrole_user;

        // Total pasien unik
        $jumlah_pasien = DB::table('rekam_medis')
            ->where('dokter_pemeriksa', $idRoleUser)
            ->distinct('idpet')
            ->count('idpet');

        // Total rekam medis
        $jumlah_rm = DB::table('rekam_medis')
            ->where('dokter_pemeriksa', $idRoleUser)
            ->count();

        // Total tindakan
        $jumlah_tindakan = DB::table('detail_rekam_medis')
            ->join('rekam_medis', 'detail_rekam_medis.idrekam_medis', '=', 'rekam_medis.idrekam_medis')
            ->where('rekam_medis.dokter_pemeriksa', $idRoleUser)
            ->count();

        // Jumlah antrian dokter dengan status = 2
        $jumlah_antrian = DB::table('temu_dokter')
            ->where('idrole_user', $idRoleUser)
            ->where('status', 2)
            ->count();

        // Daftar pasien beserta status rekam medisnya
        $pasien_belum = DB::table('temu_dokter')
            ->leftJoin('rekam_medis', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->select(
                'temu_dokter.idreservasi_dokter',
                'temu_dokter.no_urut',
                'temu_dokter.waktu_daftar',
                'temu_dokter.status',
                'pet.nama as nama_pet',
                'rekam_medis.idrekam_medis as rekam_medis_id'
            )
            ->where('temu_dokter.idrole_user', $idRoleUser)
            ->where('temu_dokter.status', 2)
            ->orderBy('temu_dokter.no_urut')
            ->get();

        // Rekam medis terbaru dokter
        $rekam_terbaru = DB::table('rekam_medis')
            ->join('pet', 'rekam_medis.idpet', '=', 'pet.idpet')
            ->select('rekam_medis.*', 'pet.nama as nama_pet')
            ->where('rekam_medis.dokter_pemeriksa', $idRoleUser)
            ->orderBy('rekam_medis.created_at', 'DESC')
            ->limit(10)
            ->get();

        return view('dokter.dashboard.index', compact(
            'jumlah_pasien',
            'jumlah_rm',
            'jumlah_tindakan',
            'jumlah_antrian',
            'pasien_belum',
            'rekam_terbaru'
        ));
    }
}
