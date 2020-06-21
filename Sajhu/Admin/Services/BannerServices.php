<?php

namespace Module\Admin\Services;


use Illuminate\Support\Str;

use AppHelper,ImageHelper;
use Module\Admin\Repository\BannerRepository;

class BannerServices
{

    private $bannerRepository;
    public $id;
    private $idResult;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function getDatas()
    {
        return $this->bannerRepository->all();
    }

    public function create($request)
    {
        try {
            $this->bannerRepository->store($this->fillable($request));
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

            $this->bannerRepository->update($this->id, $this->fillable($request));
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

            $this->bannerRepository->delete($this->id);
            return AppHelper::deleteMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function fillable($request)
    {
        $all = $request->only(['banner_name,image,bannerable_id,bannerable_type']);
        return $all;
    }

    public function checkData()
    {
        if (!$category = $this->bannerRepository->find($this->id)){
            $this->idResult = true;
        }else{
            $this->idResult = false;
        }
    }

}
