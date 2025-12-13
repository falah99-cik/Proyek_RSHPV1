<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokter;

class CheckDokterProfile
{
    public function handle($request, Closure $next)
    {
        $userId = Auth::user()->iduser;

        $dokter = Dokter::where('id_user', $userId)->first();

        session([
            'dokter_profile_incomplete' => $dokter ? false : true
        ]);

        return $next($request);
    }
}
