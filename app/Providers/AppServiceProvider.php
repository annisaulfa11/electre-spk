<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
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
        Gate::define("admin", function (User $user)
        {
            return $user->role === "admin";
        });

        Gate::define("pb", function (User $user)
        {
            return $user->role === "pb";
        });
        
        Gate::define("ortu", function (User $user)
        {
            return $user->role === "ortu";
        });


    }
}
