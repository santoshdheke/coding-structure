<?php

namespace SD\Ecommerce;

use SD\Ecommerce\Admin\AdminServiceProvider;
use SD\Ecommerce\Common\CommonServiceProvider;
use SD\Ecommerce\Frontend\FrontendServiceProvider;

class EcommerceServiceProvider
{
    public static function provides()
    {
        return [
            AdminServiceProvider::class,
            CommonServiceProvider::class,
            FrontendServiceProvider::class
        ];
    }
}
