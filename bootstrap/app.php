<?php

use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\FrontendAuth;
use App\Http\Middleware\TrackReferral;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->encryptCookies(except: [
            'referred_by',
        ]);
        $middleware->web(append: [
            TrackReferral::class,
        ]);
        $middleware->redirectTo(fn () => route('landing.index'));
        $middleware->alias([
            'permission' => CheckPermission::class,
            'frontend.auth' => FrontendAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
