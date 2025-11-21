<?php

namespace App\Http\Controllers\admin;

use App\Models\Kategori;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }
}
