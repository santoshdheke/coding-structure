<?php

namespace SD\Ecommerce\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        return view('ecommerce.frontend::home.index');
    }

}
