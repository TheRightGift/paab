<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\URL;

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
        if (env('APP_ENV') === 'production') {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Super Admin
        Gate::define('run_superAdmin_ops', function(User $user) {
            return $user->role == "SuperAdmin";
        });
        // Admin
        Gate::define('run_admin_ops', function(User $user) {
            return $user->role == "Admin";
        });
        // Customer
        Gate::define('run_client_ops', function(User $user) {
            return $user->role == "Client";
        });

        // Admin or Super Admin
        Gate::define('run_admin_or_superAdmin_ops', function(User $user) {
            return $user->role == "SuperAdmin" || $user->role == "Admin";
        });
    }
}
