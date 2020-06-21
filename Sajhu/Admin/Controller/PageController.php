<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Module\Admin\Models\Page;
use AppHelper;
use Module\Admin\Requests\PageRequest;
use Module\Admin\Services\PageServices;

class PageController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::page';
    private $baseRoute = 'admin.page';
    private $folderPath = 'flag';
    private $pageServices;

    /**
     * PageController constructor.
     * @param PageServices $pageServices
     */
    public function __construct(PageServices $pageServices)
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setBaseRoute($this->baseRoute);
        AppHelper::setFolderPath(config('image.upload_folder').'/'.$this->folderPath);
        $this->pageServices = $pageServices;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($slug)
    {
        AppHelper::setTitle(ucwords(str_replace('_',' ',$slug)));
        $page = $this->pageServices->getData($slug);
        return view(AppHelper::getViewPath('index'), compact('page','slug'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view(AppHelper::getViewPath('create'));
    }

    /**
     * @param PageRequest $request
     * @return mixed
     */
    public function store(PageRequest $request)
    {
        $result = $this->pageServices->create($request);
        return AppHelper::returnBack($result);
    }

    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        return view(AppHelper::getViewPath('edit'),compact('page'));
    }

    /**
     * @param PageRequest $request
     * @param $id
     * @return mixed
     */
    public function update(PageRequest $request,$id)
    {
        $this->pageServices->id = $id;
        $result = $this->pageServices->update($request);
        return AppHelper::returnBack($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->pageServices->id = $id;
        $result = $this->pageServices->delete();
        return AppHelper::returnBack($result);
    }

}
