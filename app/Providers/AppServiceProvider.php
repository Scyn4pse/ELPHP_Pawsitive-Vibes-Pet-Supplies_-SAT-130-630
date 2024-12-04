<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    public function boot()
{
    DB::listen(function ($query) {
        Log::info('SQL Query', [
            'sql' => $query->sql,
            'bindings' => $query->bindings,
            'time' => $query->time,
        ]);
    });
}

    protected $namespace = 'App\Http\Controllers';

    protected function apiRoutes(){
        Route::middleware('api')
            ->prefix($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
