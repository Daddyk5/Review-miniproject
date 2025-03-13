<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Review;
use App\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix for older MySQL versions where string length issues arise
        Schema::defaultStringLength(191);

        // Use Bootstrap for pagination views (optional, if using pagination)
        Paginator::useBootstrap();

        // Register Review Policy (Optional if not registered in AuthServiceProvider)
        Gate::policy(Review::class, ReviewPolicy::class);
    }
}
