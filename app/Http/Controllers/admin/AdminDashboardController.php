<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPet        = DB::table('pet')->count();
        $totalPemilik    = DB::table('pemilik')->count();
        $totalDokter     = DB::table('role_user')
                                ->where('idrole', 2)
                                ->where('status', 1)
                                ->count();
        $totalPerawat    = DB::table('perawat')->count();
        $totalRekamMedis = DB::table('rekam_medis')->count();

        $totalReservasiHariIni = DB::table('temu_dokter')
            ->whereDate('waktu_daftar', today())
            ->count();

$bulanNama = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
];

        // Grafik reservasi bulanan
        $reservasiBulanan = DB::table('temu_dokter')
            ->select(DB::raw("MONTH(waktu_daftar) as bulan"), DB::raw("COUNT(*) as total"))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

            $reservasiBulanan = $reservasiBulanan->map(function ($item) use ($bulanNama) {
    $item->nama_bulan = $bulanNama[$item->bulan] ?? $item->bulan;
    return $item;
});

        // Grafik rekam medis
        $rekamMedisBulanan = DB::table('rekam_medis')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

            $rekamMedisBulanan = $rekamMedisBulanan->map(function ($item) use ($bulanNama) {
    $item->nama_bulan = $bulanNama[$item->bulan] ?? $item->bulan;
    return $item;
});


        // Antrian hari ini
        $antrianHariIni = DB::table('temu_dokter as t')
            ->join('pet as p', 'p.idpet', '=', 't.idpet')
            ->join('pemilik as pm', 'pm.idpemilik', '=', 'p.idpemilik')
            ->select('t.no_urut', 't.status', 'p.nama as nama_pet', 'pm.no_wa')
            ->whereDate('t.waktu_daftar', today())
            ->orderBy('t.no_urut')
            ->get();


        // Pet terbaru
        $petBaru = DB::table('pet')
            ->join('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->select('pet.nama', 'pemilik.no_wa')
            ->orderBy('pet.idpet', 'desc')
            ->limit(5)
            ->get();

        // Pemilik terbaru
        $pemilikBaru = DB::table('pemilik')
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->select('user.nama', 'pemilik.no_wa')
            ->orderBy('pemilik.idpemilik', 'desc')
            ->limit(5)
            ->get();

        // Rekam medis terbaru
        $rekamMedisBaru = DB::table('rekam_medis')
            ->join('pet', 'pet.idpet', '=', 'rekam_medis.idpet')
            ->select(
                'rekam_medis.idrekam_medis',
                'pet.nama as nama_pet',
                'rekam_medis.diagnosa',
                'rekam_medis.created_at'
            )
            ->orderBy('rekam_medis.idrekam_medis', 'desc')
            ->limit(5)
            ->get();


        // Activity list
        $activities = collect([]);

        foreach ($rekamMedisBaru as $item) {
            $activities->push([
                'waktu' => Carbon::now()->subMinutes(rand(1, 30)),
                'icon'  => 'bi-journal-medical',
                'title' => 'Rekam medis baru',
                'desc'  => "{$item->nama_pet} - {$item->diagnosa}"
            ]);
        }

        foreach ($petBaru as $item) {
            $activities->push([
                'waktu' => Carbon::now()->subMinutes(rand(31, 60)),
                'icon'  => 'bi-github',
                'title' => 'Pet baru ditambahkan',
                'desc'  => "{$item->nama}"
            ]);
        }

        foreach ($pemilikBaru as $item) {
            $activities->push([
                'waktu' => Carbon::now()->subMinutes(rand(61, 120)),
                'icon'  => 'bi-person-plus-fill',
                'title' => 'Pemilik baru terdaftar',
                'desc'  => "{$item->nama} - {$item->no_wa}"
            ]);
        }

        $activities = $activities->sortByDesc('waktu')->take(8);

        $maxValue = max([
            $totalRekamMedis,
            $totalReservasiHariIni,
            $totalPet,
            $totalPemilik,
            1 
        ]);

        $persenPemeriksaan = ($totalRekamMedis / $maxValue) * 100;
        $persenAntrian     = ($totalReservasiHariIni / $maxValue) * 100;
        $persenHewan       = ($totalPet / $maxValue) * 100;
        $persenPemilik     = ($totalPemilik / $maxValue) * 100;


        return view('admin.dashboard', compact(
            'totalPet',
            'totalPemilik',
            'totalDokter',
            'totalPerawat',
            'totalRekamMedis',
            'totalReservasiHariIni',
            'reservasiBulanan',
            'rekamMedisBulanan',
            'antrianHariIni',
            'petBaru',
            'pemilikBaru',
            'rekamMedisBaru',
            'activities',

            // tambahan progress bar
            'persenPemeriksaan',
            'persenAntrian',
            'persenHewan',
            'persenPemilik'
        ));
    }
}
