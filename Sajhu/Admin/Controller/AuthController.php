<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use AppHelper;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        AppHelper::setBaseRoute(config('admin.base_route'));
        AppHelper::setViewPath(config('admin.view_path'));
    
    }

    public function showLoginForm()
    {
        return view(AppHelper::getViewPath('auth.login'));
    }

    public function login(Request $request)
    {
              
        $remember = isset($request->remember_me) ? true : false;
        if ($this->guard()->attempt($request->only('email','password'), $remember)) {

            return redirect('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Email or Password doesnot match');
        }
      

    }

    public function logout()
    {
        $this->guard()->logout();
        return redirect('admin/login');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

}
