<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Perawat;

class CheckPerawatProfile
{
    public function handle($request, Closure $next)
    {
        $perawat = Perawat::where('id_user', Auth::user()->iduser)->first();

        session([
            'perawat_profile_incomplete' => $perawat ? false : true
        ]);

        return $next($request);
    }
}
