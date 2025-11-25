<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsPemilik
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $roleAktif = $user->roleAktif()->first();
        $role = $roleAktif->nama_role ?? null;

        if ($role !== 'Pemilik') {
            return redirect('/')
                ->with('error', 'Akses ditolak, Anda bukan Pemilik.');
        }

        return $next($request);
    }
}
