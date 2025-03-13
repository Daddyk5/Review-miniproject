<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // Apply 'web' and 'verified' middleware to web routes
            Route::middleware(['web', 'verified'])
                ->group(base_path('routes/web.php'));

            // API Routes (no verified middleware here)
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
