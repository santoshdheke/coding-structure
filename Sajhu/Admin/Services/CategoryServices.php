<?php

namespace Module\Admin\Services;


use Illuminate\Support\Str;
use Module\Admin\Repository\CategoryRepository;
use AppHelper, ImageHelper;

class CategoryServices
{

    private $categoryRepository;
    public $id;
    public $category_id = null;
    public $sub_category_id = null;
    private $idResult;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function find()
    {
        return $this->categoryRepository->find($this->id);
    }

    public function getDatas()
    {
        if ($this->category_id) {
            return $this->categoryRepository->getBy('parent_id', $this->category_id);
        }

        if ($this->sub_category_id) {
            return $this->categoryRepository->getBy('parent_id', $this->sub_category_id);
        }

        return $this->categoryRepository->getBy('parent_id',null);
    }

    public function getAllChildCategory()
    {
        return $this->categoryRepository->getBy('have_child',0);
    }

    public function create($request)
    {
        try {

            if ($this->category_id) {
                return $this->createSubCategory($request);
            } elseif ($this->sub_category_id) {
                return $this->createMiniSubCategory($request);
            } else {
                return $this->createCategory($request);
            }

            return AppHelper::createMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function createCategory($request)
    {
        $category = $this->categoryRepository->store($this->fillable($request));

        if (!$request->have_child && $request->attribute_ids)
            $category->attributes()->sync($request->attribute_ids);

        return $category;
    }

    public function createSubCategory($request)
    {
        $fillable = $this->subCategoryFillable($request);
        $category = $this->categoryRepository->store($fillable);

        if (!$request->have_child && $request->attribute_ids)
            $category->attributes()->sync($request->attribute_ids);

        return $category;
    }

    public function createMiniSubCategory($request)
    {
        $fillable = $this->miniSubCategoryFillable($request);
        $category = $this->categoryRepository->store($fillable);

        if ($request->attribute_ids)
            $category->attributes()->sync($request->attribute_ids);

        return $category;
    }

    public function update($request)
    {
        try {

            $this->checkData();
            if ($this->idResult) {
                return notFoundErrorMessage();
            }

            $fillable = $this->fillable($request);
            unset($fillable['have_child']);
            unset($fillable['category_slug']);

            $data = $this->categoryRepository->find($this->id);
            $data->update($fillable);

            $data->attributes()->sync($request->attribute_ids);

            return AppHelper::updateMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function delete()
    {
        try {

            $this->checkData();
            if ($this->idResult) {
                return notFoundErrorMessage();
            }

            $data = $this->categoryRepository->find($this->id);
            $data->delete();

            $data->attributes()->sync([]);
            return AppHelper::deleteMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function fillable($request)
    {
        $all = $request->only(['category_title', 'have_child','unit']);
        $all['category_slug'] = Str::slug($all['category_title'], '_');
        return $all;
    }

    public function subCategoryFillable($request)
    {
        $all = $request->only(['category_title','have_child','unit']);
        $all['category_slug'] = Str::slug($all['category_title'], '_');
        $all['parent_id'] = $this->category_id;
        return $all;
    }

    public function miniSubCategoryFillable($request)
    {
        $all = $request->only(['category_title','unit']);
        $all['category_slug'] = Str::slug($all['category_title'], '_');
        $all['parent_id'] = $this->sub_category_id;
        return $all;
    }

    public function checkData()
    {
        if (!$category = $this->categoryRepository->find($this->id)) {
            $this->idResult = true;
        } else {
            $this->idResult = false;
        }
    }

}
