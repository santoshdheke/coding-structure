<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Module\Admin\Models\Language;
use AppHelper;
use Module\Admin\Requests\LanguageRequest;
use Module\Admin\Services\LanguageServices;

class LanguageController extends Controller
{
    /**
     * @var string
     */
    private $module = 'Admin::';

    /**
     * @var string
     */
    private $viewPath = 'Admin::language';

    /**
     * @var string
     */
    private $title = 'Language';

    /**
     * @var string
     */
    private $baseRoute = 'admin.language';

    /**
     * @var string
     */
    private $folderPath = 'flag';

    /**
     * @var LanguageServices
     */
    private $languageServices;

    /**
     * LanguageController constructor.
     * @param LanguageServices $languageServices
     */
    public function __construct(LanguageServices $languageServices)
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        AppHelper::setFolderPath(config('image.upload_folder').'/'.$this->folderPath);
        $this->languageServices = $languageServices;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $languages = $this->languageServices->getDatas();
        return view(AppHelper::getViewPath('index'), compact('languages'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view(AppHelper::getViewPath('create'));
    }

    /**
     * @param LanguageRequest $request
     * @return mixed
     */
    public function store(LanguageRequest $request)
    {
        $result = $this->languageServices->create($request);
        return AppHelper::returnBack($result);
    }

    /**
     * @param Language $language
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Language $language)
    {
        return view(AppHelper::getViewPath('edit'),compact('language'));
    }

    /**
     * @param LanguageRequest $request
     * @param $id
     * @return mixed
     */
    public function update(LanguageRequest $request,$id)
    {
        $this->languageServices->id = $id;
        $result = $this->languageServices->update($request);
        return AppHelper::returnBack($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->languageServices->id = $id;
        $result = $this->languageServices->delete();
        return AppHelper::returnBack($result);
    }

}
