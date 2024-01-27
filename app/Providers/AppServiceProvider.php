<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
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
        Gate::define('KetuaOMK', function(User $user){
            return $user->peran ==='KetuaOMK';
        });
        Gate::define('KetuaStasi', function(User $user){
            return $user->peran ==='KetuaStasi';
        });
        Gate::define('Anggota', function(User $user){
            return $user->peran ==='Anggota';
        });
    }
}
