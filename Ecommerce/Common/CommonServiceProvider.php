<?php

namespace SD\Ecommerce\Common;

use Illuminate\Support\ServiceProvider;
use SD\Ecommerce\Common\Middleware\AuthMiddleware;

class CommonServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'SD\Ecommerce\Common\Http\Controllers';

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
        $this->app['router']->aliasMiddleware('ecommerce-admin-auth', AuthMiddleware::class);
        $this->loadMigrationsFrom(__DIR__.'/database');
    }
}
