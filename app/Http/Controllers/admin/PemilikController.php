<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function index()
    {
        $data = Pemilik::all();
        return view('admin.pemilik.index', compact('data'));
    }
}
