<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        //
    }

    protected $namespace = 'App\Http\Controllers';

    protected function apiRoutes(){
        Route::middleware('api')
            ->prefix($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
