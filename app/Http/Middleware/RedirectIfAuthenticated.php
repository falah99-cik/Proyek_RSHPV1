<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $user = Auth::user();
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
                }

                return redirect('/lockscreen');
            }
        }

        return $next($request);
    }
}
