<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsDokter
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $roleAktif = $user->roleAktif()->first();
        $role = $roleAktif->nama_role ?? null;

        if ($role !== 'Dokter') {
            return redirect('/')
                ->with('error', 'Akses ditolak, Anda bukan Dokter.');
        }

        return $next($request);
    }
}
