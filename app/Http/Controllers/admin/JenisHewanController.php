<?php

namespace App\Http\Controllers\admin;

use App\Models\JenisHewan;
use App\Http\Controllers\Controller;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.jenis_hewan.index', compact('jenisHewan'));
    }
}
