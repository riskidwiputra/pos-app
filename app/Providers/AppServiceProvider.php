<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('permission', function ($permission) {
            // Cek apakah user sudah login DAN punya permission
            return auth()->check() && auth()->user()->hasPermission($permission);
        });
        Blade::if('role', function ($role) {
            return auth()->check() && auth()->user()->hasRole($role);
        });

    }
}
