<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'permintaanBarang' => \App\Http\Middleware\PermintaanBarang::class,
            'timePlannerHO' => \App\Http\Middleware\TimePlannerHO::class,
            'purchasing' => \App\Http\Middleware\Purchasing::class,
            'gudangPusat' => \App\Http\Middleware\GudangPusat::class,
            'gudangCentral' => \App\Http\Middleware\GudangCentral::class,
            'gudangSite' => \App\Http\Middleware\GudangSite::class,
            'user' => \App\Http\Middleware\User::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
