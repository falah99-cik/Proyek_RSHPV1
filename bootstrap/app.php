<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/login');

        $middleware->redirectUsersTo(function () {

            $user = Auth::user();

            if (!$user) {
                return '/login'; // fallback aman
            }

            $role = $user->roleAktif()->first()?->nama_role;

            return match ($role) {
                'Administrator' => '/admin/dashboard',
                'Dokter'        => '/dokter/dashboard',
                'Perawat'       => '/perawat/dashboard',
                'Resepsionis'   => '/resepsionis/dashboard',
                'Pemilik'       => '/pemilik/dashboard',
                default         => '/lockscreen',
            };
        });

        $middleware->web(append: [
            //
        ]);

        $middleware->api(append: [
            //
        ]);

        $middleware->alias([
            'isAdmin'       => \App\Http\Middleware\IsAdministrator::class,
            'isDokter'      => \App\Http\Middleware\IsDokter::class,
            'isPerawat'     => \App\Http\Middleware\IsPerawat::class,
            'isResepsionis' => \App\Http\Middleware\IsResepsionis::class,
            'isPemilik'     => \App\Http\Middleware\IsPemilik::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
