<?php

namespace SD\JobPortal\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'JobPortal\Http\Controllers';

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
        $this->mapRoute();
        $this->loadViewsFrom(__DIR__.'/view','jobportal');
    }

    public function mapRoute()
    {
        Route::domain('jobportal.local')
        ->middleware('web')
            ->namespace($this->namespace)
            ->group(__dir__.'/routes/web.php');
    }
}
