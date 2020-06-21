<?php

namespace Module\Admin\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Module\Admin\Repository\LanguageRepository;
use AppHelper,ImageHelper;

class LanguageServices
{

    /**
     * @var LanguageRepository
     */
    private $languageRepository;

    /**
     * @var integer
     */
    public $id;

    /**
     * @var boolean
     */
    private $idResult;

    /**
     * LanguageServices constructor.
     * @param LanguageRepository $languageRepository
     */
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDatas()
    {
        return $this->languageRepository->all();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function create($request):array
    {
        try {
            $this->languageRepository->store($this->fillable($request));
            return AppHelper::createMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function update($request):array
    {
        try {

            $this->checkData();
            if ($this->idResult) {
                return notFoundErrorMessage();
            }

            $this->languageRepository->update($this->id, $this->fillable($request));
            return AppHelper::updateMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function delete():array
    {
        try {

            $this->checkData();
            if ($this->idResult) {
                return notFoundErrorMessage();
            }

            $this->languageRepository->delete($this->id);
            return AppHelper::deleteMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function fillable($request):array
    {
        $all = $request->only(['country_name', 'country_code']);
        $all['country_code'] = Str::slug($all['country_code'],'_');
        $all['flag'] = $this->imageUpload($request->flag);
        return $all;
    }

    public function imageUpload($image):string
    {
        ImageHelper::folder('flag',['35_35']);
        return ImageHelper::saveImage($image);
    }

    public function deleteImage($flag)
    {
        ImageHelper::folder('flag',['35_35']);
        ImageHelper::deleteImage($flag);
    }

    public function checkData()
    {
        if (!$language = $this->languageRepository->find($this->id)){
            $this->idResult = true;
        }else{
            $this->deleteImage($language->flag);
            $this->idResult = false;
        }
    }

}
