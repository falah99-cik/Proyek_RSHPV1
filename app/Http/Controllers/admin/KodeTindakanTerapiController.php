<?php

namespace App\Http\Controllers\admin;

use App\Models\KodeTindakanTerapi;
use App\Http\Controllers\Controller;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $tindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.tindakan.index', compact('tindakan'));
    }
}
