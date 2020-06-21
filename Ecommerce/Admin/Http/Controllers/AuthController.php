<?php

namespace SD\Ecommerce\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('ecommerce.admin::auth.login');
    }

}
