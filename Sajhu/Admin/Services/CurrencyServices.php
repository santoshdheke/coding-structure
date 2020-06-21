<?php

namespace Module\Admin\Services;


use Module\Admin\Repository\CurrencyRepository;
use AppHelper;

class CurrencyServices
{

    /**
     * @var CurrencyRepository
     */
    private $currencyRepository;

    /**
     * @var int
     */
    public $id;

    /**
     * @var boolean
     */
    private $idResult;

    /**
     * CurrencyServices constructor.
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDatas()
    {
        return $this->currencyRepository->all();
    }

    /**
     * @value boolean
     */
    public function checkData()
    {
        if (!$this->currencyRepository->find($this->id))
            $this->idResult = true;

        else
            $this->idResult = false;
    }

    /**
     * @param $request
     * @return array
     */
    public function create($request):array
    {
        try {
            $this->currencyRepository->store($this->fillable($request));
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

            $this->currencyRepository->update($this->id, $this->fillable($request));
            return AppHelper::updateMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function fillable($request):array
    {
        $all = $request->only(['currency_name', 'compare_with_dolor']);
        $all['front_symbol'] = $this->checkSymbol($request, 'front');
        $all['back_symbol'] = $this->checkSymbol($request, 'back');
        return $all;
    }

    /**
     * @param $request
     * @param $symbol
     * @return null @or symbol
     */
    public function checkSymbol($request, $symbol)
    {
        if ($request->symbol_area == $symbol)
            return $request->symbol;

        return null;
    }

    /**
     * @return array
     */
    public function delete():array
    {
        try {

            $this->checkData();
            if ($this->idResult) {
                return notFoundErrorMessage();
            }

            $this->currencyRepository->delete($this->id);
            return AppHelper::deleteMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

}
