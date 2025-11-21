<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home');
    }
    public function layanan()
    {
        return view('site.layanan');
    }

    public function struktur()
    {
        return view('site.struktur');
    }

    public function visi()
    {
        return view('site.visi');
    }

    public function login()
    {
        return view('site.login');
    }
}
