<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Module\Admin\Models\Category;
use AppHelper;
use Module\Admin\Requests\CategoryRequest;
use Module\Admin\Services\AttributeServices;
use Module\Admin\Services\CategoryServices;

class CategoryController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::category';
    private $title = 'Category';
    private $baseRoute = 'admin.category';
    private $categoryServices;
    private $attributeServices;

    public function __construct(
        AttributeServices $attributeServices,
        CategoryServices $categoryServices
    )
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        $this->categoryServices = $categoryServices;
        $this->attributeServices = $attributeServices;

    }

    public function index()
    {
        $categories = $this->categoryServices->getDatas();
        return view(AppHelper::getViewPath('index'), compact('categories'));
    }

    public function create()
    {
        $attributes = $this->attributeServices->getDatas();
        return view(AppHelper::getViewPath('create'),compact('attributes'));
    }

    public function store(CategoryRequest $request)
    {
        $result = $this->categoryServices->create($request);

        if (request()->has('save-continue'))
            return redirect()->back();
        elseif (request()->has('save-edit') && $result->id)
            return redirect()->route($this->baseRoute.'.edit', ($result->category_slug));
        else
            return redirect()->route($this->baseRoute.'.index');
    }

    public function edit(Category $category)
    {
        $attributes = $this->attributeServices->getDatas();
        return view(AppHelper::getViewPath('edit'),compact('category','attributes'));
    }

    public function update(CategoryRequest $request,$id)
    {
        $this->categoryServices->id = $id;
        $result = $this->categoryServices->update($request);
        return AppHelper::returnBack($result);
    }

    public function destroy($id)
    {
        $this->categoryServices->id = $id;
        $result = $this->categoryServices->delete();
        return AppHelper::returnBack($result);
    }

}
