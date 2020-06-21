<?php

namespace Module\Admin\Services;


use Illuminate\Support\Str;
use Module\Admin\Repository\MiniSubCategoryRepository;
use AppHelper, ImageHelper;

class MiniSubCategoryServices
{

    private $minisubcategoryRepository;
    public $id;
    public $sub_category_id;
    private $idResult;

    public function __construct(MiniSubCategoryRepository $minisubcategoryRepository)
    {
        $this->minisubcategoryRepository = $minisubcategoryRepository;
    }

    public function getDatasBy()
    {
        return $this->minisubcategoryRepository->getBy('sub_category_id', $this->sub_category_id);
    }

    public function find()
    {
        return $this->minisubcategoryRepository->find($this->id);
    }

    public function getDatas()
    {
        return $this->minisubcategoryRepository->all();
    }

    public function create($request)
    {
        try {
            $minisubcategory = $this->minisubcategoryRepository->store($this->fillable($request));
            $minisubcategory->attributes()->attach($request->attribute_ids);
            return AppHelper::createMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function update($request)
    {
        try {

            $this->checkData();
            if ($this->idResult) {
                return notFoundErrorMessage();
            }

            $this->minisubcategoryRepository->update($this->id, $this->fillable($request));
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

            $this->minisubcategoryRepository->delete($this->id);
            return AppHelper::deleteMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function fillable($request)
    {
        $all = $request->only(['mini_sub_category_title']);
        $all['mini_sub_category_slug'] = Str::slug($all['mini_sub_category_title'], '_');
        $all['sub_category_id'] = $this->sub_category_id;
        return $all;
    }

    public function checkData()
    {
        if (!$subcategory = $this->minisubcategoryRepository->find($this->id)) {
            $this->idResult = true;
        } else {
            $this->idResult = false;
        }
    }

}
