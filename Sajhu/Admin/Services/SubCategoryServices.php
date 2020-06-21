<?php

namespace Module\Admin\Services;


use Illuminate\Support\Str;
use Module\Admin\Repository\SubCategoryRepository;
use AppHelper,ImageHelper;

class SubCategoryServices
{

    private $subcategoryRepository;
    public $id;
    public $category_id;
    private $idResult;

    public function __construct(SubCategoryRepository $subcategoryRepository)
    {
        $this->subcategoryRepository = $subcategoryRepository;
    }

    public function getDatas()
    {
        return $this->subcategoryRepository->getBy('category_id',$this->category_id);
    }

    public function create($request)
    {
        try {
            $this->subcategoryRepository->store($this->fillable($request));
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

            $this->subcategoryRepository->update($this->id, $this->fillable($request));
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

            $this->subcategoryRepository->delete($this->id);
            return AppHelper::deleteMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function fillable($request)
    {
        $all = $request->only(['sub_category_title']);
        $all['sub_category_slug'] = Str::slug($all['sub_category_title'],'_');
        $all['category_id'] = $this->category_id;
        return $all;
    }

    public function checkData()
    {
        if (!$subcategory = $this->subcategoryRepository->find($this->id)){
            $this->idResult = true;
        }else{
            $this->idResult = false;
        }
    }

}
