<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use AppHelper;
use Illuminate\Http\Request;
use Module\Admin\Requests\VendorRequest;
use Module\Admin\Services\VendorServices;

class VendorController extends Controller
{
    /**
     * @var string
     */
    private $module = 'Admin::';

    /**
     * @var string
     */
    private $viewPath = 'Admin::vendor';

    /**
     * @var string
     */
    private $title = 'Vendor';

    /**
     * @var string
     */
    private $baseRoute = 'admin.vendor';

    /**
     * @var VendorServices
     */
    private $vendorServices;

    /**
     * VendorController constructor.
     * @param VendorServices $vendorServices
     */
    public function __construct(VendorServices $vendorServices)
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        $this->vendorServices = $vendorServices;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $vendors = $this->vendorServices->getDatas();
        return view(AppHelper::getViewPath('index'),compact('vendors'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view(AppHelper::getViewPath('create'));
    }

    /**
     * @param VendorRequest $request
     * @return mixed
     */
    public function store(VendorRequest $request)
    {
        $result = $this->vendorServices->create($request);
        return AppHelper::returnBack($result);
    }

    /**
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($username)
    {
        $vendor = $this->vendorServices->getData($username);
        return view(AppHelper::getViewPath('profile'),compact('vendor'));
    }

}
