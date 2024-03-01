<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

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
        Blade::if('adminRole', function () {
            return Auth::user()->roles()->where('role_id', 1)->exists();
        });
        Blade::if('userRole', function () {
            return Auth::user()->roles()->where('role_id', 2)->exists();
        });
        Blade::if('parcelRole', function () {
            return Auth::user()->roles()->where('role_id', 3)->exists();
        });
    }
}
