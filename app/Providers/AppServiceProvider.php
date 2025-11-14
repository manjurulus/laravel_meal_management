<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // ✅ REQUIRED
use App\Models\User;

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
        View::composer('layouts.sidebar', function ($view) {
            if (auth()->check() && auth()->user()->role === 'accountant') {
                $members = User::where('role', 'member')->orderBy('name')->get();
                $view->with('members', $members);
            }
        });
    }
}
