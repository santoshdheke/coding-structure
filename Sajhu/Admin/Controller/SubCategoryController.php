<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Module\Admin\Models\Category;
use Module\Admin\Models\SubCategory;
use AppHelper;
use Module\Admin\Requests\SubCategoryRequest;
use Module\Admin\Services\AttributeServices;
use Module\Admin\Services\CategoryServices;
use Module\Admin\Services\SubCategoryServices;

class SubCategoryController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::subcategory';
    private $title = 'Sub Category';
    private $baseRoute = 'admin.subcategory';
    private $categoryServices;
    private $attributeServices;

    public function __construct(CategoryServices $categoryServices,AttributeServices $attributeServices)
    {
        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        $this->categoryServices = $categoryServices;
        $this->attributeServices = $attributeServices;

    }

    public function index(Category $category)
    {

        $this->categoryServices->category_id = $category->id;
        $subcategories = $this->categoryServices->getDatas();
        return view(AppHelper::getViewPath('index'), compact('subcategories', 'category'));
    }

    public function create(Category $category)
    {
        $attributes = $this->attributeServices->getDatas();
        return view(AppHelper::getViewPath('create'), compact('attributes','category'));
    }

    public function store(SubCategoryRequest $request,Category $category)
    {

        $this->categoryServices->category_id = $category->id;
        $result = $this->categoryServices->create($request);

        if (request()->has('save-continue'))
            return redirect()->back();
        elseif (request()->has('save-edit') && $result->id)
            return redirect()->route($this->baseRoute.'.edit', ($result->id));
        else
            return redirect()->route($this->baseRoute.'.index',$category->category_slug);
    }

    public function edit(Category $category,$id)
    {
        $attributes = $this->attributeServices->getDatas();
        $subcategory = Category::where('category_slug',$id)->first();
        return view(AppHelper::getViewPath('edit'), compact('category','subcategory','attributes'));
    }

    public function update(SubCategoryRequest $request,Category $category, $slug)
    {
        $this->categoryServices->id = Category::where('category_slug',$slug)->pluck('id')->first();
        $result = $this->categoryServices->update($request);
        return AppHelper::returnBack($result);
    }

    public function destroy($category,$slug)
    {
        $this->categoryServices->id = Category::where('category_slug',$slug)->pluck('id')->first();
        $result = $this->categoryServices->delete();
        return AppHelper::returnBack($result);
    }

}
