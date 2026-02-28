<?php

namespace App\Providers;

use App\Repositories\Contracts\PropertyRepository;
use App\Repositories\Eloquent\EloquentPropertyRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PropertyRepository::class, EloquentPropertyRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('admin', function() {
            return Auth::check() && Auth::user()->hasRole('Admin');
        });
    }
}
