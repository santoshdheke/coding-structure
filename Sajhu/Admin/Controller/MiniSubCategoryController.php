<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Module\Admin\Models\Category;
use Module\Admin\Models\SubCategory;
use Module\Admin\Models\MiniSubCategory;
use AppHelper;
use Module\Admin\Requests\MiniSubCategoryRequest;
use Module\Admin\Services\AttributeServices;
use Module\Admin\Services\CategoryServices;
use Module\Admin\Services\MiniSubCategoryServices;

class MiniSubCategoryController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::minisubcategory';
    private $title = 'Mini Sub Category';
    private $baseRoute = 'admin.minisubcategory';
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

    public function index(Category $subcategory)
    {
        $this->categoryServices->sub_category_id = $subcategory->id;
        $minisubcategories = $this->categoryServices->getDatas();
        return view(AppHelper::getViewPath('index'), compact('minisubcategories', 'subcategory'));
    }

    public function create(Category $subcategory)
    {
        $attributes = $this->attributeServices->getDatas();
        return view(AppHelper::getViewPath('create'), compact('subcategory','attributes'));
    }

    public function store(MiniSubCategoryRequest $request,Category $subcategory)
    {
        $this->categoryServices->sub_category_id = $subcategory->id;
        $result = $this->categoryServices->create($request);
        return AppHelper::returnBack($result);
    }

    public function edit(Category $subcategory,Category $minisubcategory)
    {
        $attributes = $this->attributeServices->getDatas();
        return view(AppHelper::getViewPath('edit'), compact('minisubcategory','subcategory','attributes'));
    }

    public function update(MiniSubCategoryRequest $request,Category $subcategory, $id)
    {
        $this->categoryServices->id = $id;
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
