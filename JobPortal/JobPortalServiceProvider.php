<?php

namespace SD\JobPortal;


use SD\JobPortal\Admin\AdminServiceProvider;

class JobPortalServiceProvider
{
    public static function provides()
    {
        return [
            AdminServiceProvider::class
        ];
    }
}
