<?php

namespace Module\Admin\Services;


use Illuminate\Support\Str;
use Module\Admin\Repository\MeasurementRepository;
use AppHelper, ImageHelper;

class MeasurementServices
{

    private $measurementRepository;
    public $id;
    private $idResult;

    public function __construct(MeasurementRepository $measurementRepository)
    {
        $this->measurementRepository = $measurementRepository;
    }

    public function getDatas()
    {
        return $this->measurementRepository->all();
    }

    public function getDataByParent()
    {
        return $this->measurementRepository->getBySortable('parent_id', 0);
    }

    public function create($request)
    {
        try {
            return $this->measurementRepository->store($this->fillable($request));
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

            $this->measurementRepository->update($this->id, $this->fillable($request));
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
            $this->deleteChild();

            $this->measurementRepository->delete($this->id);
            return AppHelper::deleteMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function fillable($request)
    {
        $arr = $this->data();

        $all = $request->only($arr);

        if (isset($all['parent_id']) && $all['parent_id'] <= 0) {
            $all['compare_parent_value'] = 1;
        }
        return $all;
    }

    public function data()
    {
        return [
            'title',
            'parent_id',
            'compare_parent_value'
        ];
    }

    public function checkData()
    {
        if (!$this->measurementRepository->find($this->id)) {
            $this->idResult = true;
        } else {
            $this->idResult = false;
        }
    }

    public function deleteChild()
    {
        $childs = $this->measurementRepository->find($this->id)->childs;
        if (count($childs) > 0) {
            foreach ($childs as $child) {
                $child->delete();
            }
        }
    }

}
