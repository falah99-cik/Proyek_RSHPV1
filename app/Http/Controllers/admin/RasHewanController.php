<?php

namespace App\Http\Controllers\admin;

use App\Models\RasHewan;
use App\Http\Controllers\Controller;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenis')->get();
        return view('admin.ras_hewan.index', compact('rasHewan'));
    }
}
