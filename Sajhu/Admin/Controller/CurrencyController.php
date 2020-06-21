<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Module\Admin\Models\Currency;
use AppHelper;
use Illuminate\Http\Request;
use Module\Admin\Requests\CurrencyRequest;
use Module\Admin\Services\CurrencyServices;

class CurrencyController extends Controller
{
    /**
     * @var string
     */
    private $module = 'Admin::';

    /**
     * @var string
     */
    private $viewPath = 'Admin::currency';

    /**
     * @var string
     */
    private $title = 'Currency';

    /**
     * @var string
     */
    private $baseRoute = 'admin.currency';

    /**
     * @var CurrencyServices
     */
    private $currencyServices;

    /**
     * CurrencyController constructor.
     * @param CurrencyServices $currencyServices
     */
    public function __construct(CurrencyServices $currencyServices)
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        $this->currencyServices = $currencyServices;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $currencies = $this->currencyServices->getDatas();
        return view(AppHelper::getViewPath('index'), compact('currencies'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view(AppHelper::getViewPath('create'));
    }

    /**
     * @param CurrencyRequest $request
     * @return mixed
     */
    public function store(CurrencyRequest $request)
    {
        $result = $this->currencyServices->create($request);
        return AppHelper::returnBack($result);
    }

    /**
     * @param Currency $currency
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Currency $currency)
    {
        return view(AppHelper::getViewPath('edit'), compact('currency'));
    }

    /**
     * @param CurrencyRequest $request
     * @param $id
     * @return mixed
     */
    public function update(CurrencyRequest $request, $id)
    {
        $this->currencyServices->id = $id;
        $result = $this->currencyServices->update($request);
        return AppHelper::returnBack($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->currencyServices->id = $id;
        $result = $this->currencyServices->delete();
        return AppHelper::returnBack($result);
    }

}
