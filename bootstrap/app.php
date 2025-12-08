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
        then: function ($router) {
            // require base_path('routes/admin.php');
            require base_path('routes/owner.php');
            // require base_path('routes/user.php');
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Global middleware
        // উদাহরণ: সব request-এ log করা
        $middleware->before(function ($request) {
            logger('Request URL: ' . $request->fullUrl());
        });

        // উদাহরণ: auth guard check
        $middleware->after(function ($request, $response) {
            if ($request->user('owner') && $request->user('owner')->status !== 'active') {
                Auth::guard('owner')->logout();
                return redirect()->route('owner.login')->withErrors([
                    'email' => 'Your account is ' . $request->user('owner')->status
                ]);
            }
        });
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
