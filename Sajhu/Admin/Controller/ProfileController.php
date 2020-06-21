<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use AppHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Module\Admin\Requests\AdminPasswordUpdate;
use Module\Admin\Requests\AdminProfileProfileUpdate;
use Module\Admin\Requests\AdminProfileUpdate;

class ProfileController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::profile';
    private $baseRoute = 'admin.profile';
    private $folderPath = 'upload/profile_picture/';
    private $title = 'Profile';

    public function __construct()
    {
        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setbaseRoute($this->baseRoute);
        AppHelper::setFolderPath($this->folderPath);
        AppHelper::setTitle($this->title);
    }

    public function index()
    {
        return view(AppHelper::getViewPath('index'));
    }

    public function edit()
    {
        $profile = auth('admin')->user();
        return view(AppHelper::getViewPath('edit'), compact('profile'));
    }

    public function generalUpdate(AdminProfileUpdate $request)
    {
        $userDetail = $request->only('email', 'name');
        auth()->user()->update($userDetail);
        return redirect()->back()->with('general_success', 'General Profile Update Success.');
    }

    public function pictureUpdate(AdminProfileProfileUpdate $request)
    {


        die;
        $image = AppHelper::fileUpload($request->image);
        auth()->user()->update(['image' => $image]);
        return redirect()->back()->with('general_success', 'General Profile Update Success.');
    }

    public function securityUpdate(AdminPasswordUpdate $request)
    {
        if ($this->authCheck($request->old_password) && !$this->authCheck($request->password)) {
            auth()->user()->update(['password' => bcrypt($request->password)]);
            return redirect()->back()->with('security_success', 'Password Update Success.');
        }

        return redirect()->back()->with('security_error', 'Old Password doesn\'t Match.');
    }

    public function authCheck($password)
    {
        if (Hash::check($password, auth('admin')->user()->password))
            return true;

        else
            return false;
    }

}
