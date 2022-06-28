<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('auth')
                ->group(base_path('routes/auth.php'));
            Route::middleware(['api','auth:api'])
                ->prefix('users')
                ->group(base_path('routes/users.php'));
            Route::middleware(['api','auth:api'])
                ->prefix('posts')
                ->group(base_path('routes/posts.php'));
        });
    }
}
