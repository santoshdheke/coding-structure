<?php

namespace SD\Ecommerce\Common\Middleware;

use Closure;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {

        if (1==1){
            dd('middleaware');
        }
        return $next($request);
    }
}
