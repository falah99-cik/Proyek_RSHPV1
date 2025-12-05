<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        $role = $user->roleAktif()->first()?->nama_role;

        switch ($role) {
            case 'Administrator':
                return redirect('/admin/dashboard');

            case 'Dokter':
                return redirect('/dokter/dashboard');

            case 'Perawat':
                return redirect('/perawat/dashboard');

            case 'Resepsionis':
                return redirect('/resepsionis/dashboard');

            case 'Pemilik':
                return redirect('/pemilik/dashboard');

            default:
                return redirect('/lockscreen');
        }
    }

    /**
     * Constructor middleware
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
