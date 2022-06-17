<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::share('$user', function (Request $request) {
            return $request->user()->with('company')
                ? $request->user()->only('id', 'name', 'phone', 'type', 'gain', 'company', 'credit')
                : null;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        auth()->loginUsingId(1);
    }
}
