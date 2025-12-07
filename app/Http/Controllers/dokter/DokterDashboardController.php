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
        // Ambil role_user aktif sebagai dokter
        $roleUser = Auth::user()->roleUser()
            ->where('idrole', 2) // Dokter
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            abort(403, 'Role dokter tidak ditemukan.');
        }

        $idRoleUser = $roleUser->idrole_user;

        $jumlah_pasien = DB::table('rekam_medis')
            ->where('dokter_pemeriksa', $idRoleUser)
            ->distinct('idpet')
            ->count('idpet');

        $jumlah_rm = DB::table('rekam_medis')
            ->where('dokter_pemeriksa', $idRoleUser)
            ->count();

        $jumlah_tindakan = DB::table('detail_rekam_medis')
            ->join('rekam_medis', 'detail_rekam_medis.idrekam_medis', '=', 'rekam_medis.idrekam_medis')
            ->where('rekam_medis.dokter_pemeriksa', $idRoleUser)
            ->count();

        $jumlah_antrian = DB::table('temu_dokter')
            ->where('idrole_user', $idRoleUser)
            ->where('status', 2) // perbaikan
            ->count();

        $jadwal_hari_ini = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_pet'
            )
            ->where('temu_dokter.idrole_user', $idRoleUser)
            ->whereDate('temu_dokter.waktu_daftar', Carbon::today())
            ->orderBy('temu_dokter.no_urut')
            ->get();

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
            ->orderBy('temu_dokter.no_urut')
            ->get();

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
            'jadwal_hari_ini',
            'pasien_belum',
            'rekam_terbaru'
        ));
    }
}
