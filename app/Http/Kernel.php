<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ... (bagian lain)

    /**
     * The application's route middleware aliases.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
    // ... middleware lainnya yang sudah ada

    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

    // PASTIKAN BARIS INI ADA DAN BENAR!
    'auth.admin' => \App\Http\Middleware\AdminMiddleware::class, 
];

    // ... (bagian lain)
}