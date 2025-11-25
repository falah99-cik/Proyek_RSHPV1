<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah data master
        $jumlahJenisHewan = JenisHewan::count();
        $jumlahRasHewan = RasHewan::count();
        $jumlahKategori = Kategori::count();
        $jumlahKategoriKlinis = KategoriKlinis::count();
        $jumlahTindakan = KodeTindakanTerapi::count();
        $jumlahPet = Pet::count();
        $jumlahPemilik = Pemilik::count();
        $jumlahUser = User::count();
        $jumlahRole = Role::count();

        return view('admin.dashboard', compact(
            'jumlahJenisHewan',
            'jumlahRasHewan',
            'jumlahKategori',
            'jumlahKategoriKlinis',
            'jumlahTindakan',
            'jumlahPet',
            'jumlahPemilik',
            'jumlahUser',
            'jumlahRole'
        ));
    }
}
