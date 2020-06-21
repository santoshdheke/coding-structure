<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Module\Admin\Models\Brand;
use AppHelper;
use Module\Admin\Requests\BrandRequest;
use Module\Admin\Services\BrandServices;

class BrandController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::brand';
    private $title = 'Brand';
    private $baseRoute = 'admin.brand';
    private $brandServices;

    public function __construct(BrandServices $brandServices)
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        $this->brandServices = $brandServices;

    }

    public function index()
    {
        $brands = $this->brandServices->getDatas();
        return view(AppHelper::getViewPath('index'), compact('brands'));
    }

    public function create()
    {
        return view(AppHelper::getViewPath('create'));
    }

    public function store(BrandRequest $request)
    {
        $result = $this->brandServices->create($request);
        return AppHelper::returnBack($result);
    }

    public function edit(Brand $brand)
    {
        return view(AppHelper::getViewPath('edit'),compact('brand'));
    }

    public function update(BrandRequest $request,$id)
    {
        $this->brandServices->id = $id;
        $result = $this->brandServices->update($request);
        return AppHelper::returnBack($result);
    }

    public function destroy($id)
    {
        $this->brandServices->id = $id;
        $result = $this->brandServices->delete();
        return AppHelper::returnBack($result);
    }

}
