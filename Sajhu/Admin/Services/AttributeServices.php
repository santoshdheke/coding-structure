<?php

namespace Module\Admin\Services;

use Module\Admin\Repository\AttributeRepository;
use AppHelper,ImageHelper;

class AttributeServices
{

    private $categoryRepository;
    public $id;
    private $idResult;

    public function __construct(AttributeRepository $categoryRepository)
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

            $this->categoryRepository->update($this->id, $request);
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
        $all = $request->only(['attribute_title','attributeable_type','input_type']);
        if ($all['attributeable_type'] == 'Module\Admin\Models\Measurement'){
            $all['attributeable_id'] = $request->measurement_id;
        }else{
            $all['attributeable_id'] = $request->non_measurement_id;
        }
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
