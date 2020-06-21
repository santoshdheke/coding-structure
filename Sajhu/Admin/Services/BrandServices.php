<?php

namespace Module\Admin\Services;


use Illuminate\Support\Str;
use Module\Admin\Repository\BrandRepository;
use AppHelper,ImageHelper;

class BrandServices
{

    private $categoryRepository;
    public $id;
    private $idResult;

    public function __construct(BrandRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getDatas()
    {
        return $this->categoryRepository->all();
    }

    public function create($request)
    {
        try {
            $this->categoryRepository->store($this->fillable($request));
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

            $this->categoryRepository->update($this->id, $this->fillable($request));
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

            $this->categoryRepository->delete($this->id);
            return AppHelper::deleteMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function fillable($request)
    {
        $all = $request->only(['brand_name']);
        $all['brand_slug'] = Str::slug($all['brand_name'],'_');
        return $all;
    }

    public function checkData()
    {
        if (!$category = $this->categoryRepository->find($this->id)){
            $this->idResult = true;
        }else{
            $this->idResult = false;
        }
    }

}
