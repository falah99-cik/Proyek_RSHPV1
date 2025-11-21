<?php

namespace App\Http\Controllers\admin;

use App\Models\Pet;
use App\Http\Controllers\Controller;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with(['pemilik.user', 'ras.jenis'])->get();
        return view('admin.pet.index', compact('pet'));
    }
}
