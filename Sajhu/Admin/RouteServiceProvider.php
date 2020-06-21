<?php

namespace Module\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Module\Admin\Controller';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

//        parent::boot();
        $this->maps();
    }

    public function register()
    {
        //
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function maps()
    {
//        $this->mapApiRoutes();

        $this->mapWebRoutes();

//        $this->mapAuthRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->prefix('admin')
            ->as('admin.')
             ->namespace($this->namespace)
             ->group(__dir__.'/route/public.php');
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAuthRoutes()
    {
        Route::middleware('web')
            ->prefix('admin')
            ->as('admin.')
             ->namespace($this->namespace)
             ->group(__dir__.'../routes/auth.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api/admin')
             ->middleware('api')
             ->namespace($this->namespace)
            ->group(__dir__.'../routes/api.php');
    }
}
