<?php

namespace App\Http\Controllers\admin;

use App\Models\KategoriKlinis;
use App\Http\Controllers\Controller;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kategori_klinis.index', compact('kategoriKlinis'));
    }
}
