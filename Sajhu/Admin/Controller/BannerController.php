<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Module\Admin\Models\Banner;
use Module\Admin\Models\Language;
use AppHelper;
use Module\Admin\Requests\BannerRequest;
use Module\Admin\Requests\LanguageRequest;
use Module\Admin\Services\BannerServices;
use Module\Admin\Services\LanguageServices;
use DB;

class BannerController extends Controller
{
    /**
     * @var string
     */
    private $module = 'Admin::';

    /**
     * @var string
     */
    private $viewPath = 'Admin::banner';

    /**
     * @var use Illuminate\Contracts\Validation\Validator;string
     */
    private $title = 'Banner';

    /**
     * @var string
     */
    private $baseRoute = 'admin.banner';

    /**
     * @var string
     */
    private $folderPath = 'banner';

    /**
     * @var LanguageServices
     */
    private $languageServices;

    /**
     * LanguageController constructor.
     * @param LanguageServices $languageServices
     */
    public function __construct(LanguageServices $languageServices,BannerServices $bannerServices)
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        AppHelper::setFolderPath(config('image.upload_folder').'/'.$this->folderPath);
        $this->languageServices = $languageServices;
        $this->bannerServices = $bannerServices;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $languages = $this->languageServices->getDatas();
        $banners = $this->bannerServices->getDatas();
//        $banners = Banner::All();
        return view(AppHelper::getViewPath('index'), compact('languages','banners'));
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
    public function edit(Language $language, $id)
    {
        $banner = Banner::find($id);
//        dd($banner);
        return view(AppHelper::getViewPath('edit'),compact('language','banner'));
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
        $banner = new Banner();
        $result = $banner->where('id',$id)->delete();
        return AppHelper::returnBack($result);
    }

    public function picture(Request $request)
    {
        $banner_name = $request->banner_name;
        $image = $request->image;
        $id = $request->id;
        $bannerable_id = auth()->user()->id;
        $bannerable_type = 'Module/Admin/Models/Banner';
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);

        $image = base64_decode($image);
        $image_name= uniqid(time()).'.png';
        \Storage::disk('local')->put('public/images/banner/'.$image_name, $image);

        $banner = new Banner();
        $imagePath = 'public/images/banner/'.$image_name;
        if($id ==''||$id==NULL){
            $banner->insert(['image' => $imagePath,'banner_name' =>$banner_name, 'bannerable_id' =>$bannerable_id ,'bannerable_type' =>$bannerable_type]);
        }
        else{
            if ($request->file!=null){
                $banner->where('id',$id)->update(['banner_name' =>$banner_name,'image'=>$imagePath ]);
            }else{
                $banner->where('id',$id)->update(['banner_name' =>$banner_name]);
            }
        }

        return response()->json(['success'=>true]);
    }

    public function checkIfImageExists($value)
    {
            $explode = explode(',', $value);
            $allow = ['png', 'jpg', 'svg'];
            $format = str_replace(
                [
                    'data:image/',
                    ';',
                    'base64',
                ],
                [
                    '', '', '',
                ],
                $explode[0]
            );
            // check file format
            if (!in_array($format, $allow)) {

                return false;
            }
            // check base64 format
            if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {

                return false;
            }
            return true;

    }

}
