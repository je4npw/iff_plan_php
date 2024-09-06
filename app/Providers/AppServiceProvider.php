<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::before(function (User $user) {
            if ($user->role === 'admin') {
                return true; // Admin tem acesso total
            }
        });

        Gate::define('edit', function (User $user) {
            return $user->role === 'edit';
        });

        Gate::define('view', function (User $user) {
            return $user->role === 'view';
        });

        Gate::define('blocked', function (User $user) {
            return $user->role === 'none';
        });

    }
}
