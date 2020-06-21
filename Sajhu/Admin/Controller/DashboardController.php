<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use AppHelper;

class DashboardController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::dashboard';
    private $title = 'Dashboard';

    public function __construct()
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);

    }

    public function index()
    {
        return view(AppHelper::getViewPath('index'));
    }
}
