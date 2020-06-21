<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Admin\Models\Measurement;
use AppHelper;
use Module\Admin\Models\NonMeasurement;
use Module\Admin\Requests\NonMeasurementAddRequest;
use Module\Admin\Requests\NonMeasurementUpdateRequest;
use Module\Admin\Services\NonMeasurementServices;

class NonMeasurementController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::non_measurement';
    private $title = 'Non Measurement';
    private $baseRoute = 'admin.non_measurement';
    private $measurementServices;

    public function __construct(NonMeasurementServices $measurementServices)
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        $this->measurementServices = $measurementServices;

    }

    public function index()
    {
        $measurements = $this->measurementServices->getDataByParent();
        return view(AppHelper::getViewPath('index'), compact('measurements'));
    }

    public function create()
    {
        $measurements = $this->measurementServices->getDataByParent();
        return view(AppHelper::getViewPath('create'), compact('measurements'));
    }

    public function store(NonMeasurementAddRequest $request)
    {
        $result = $this->measurementServices->create($request);
        return AppHelper::returnPath($result);
    }

    public function show(NonMeasurement $nonMeasurement)
    {
        $measurements = $nonMeasurement->childs;
        return view(AppHelper::getViewPath('index'), compact('measurements'));
    }

    public function edit(NonMeasurement $non_measurement)
    {
        $measurement = $non_measurement;
        $measurements = $this->measurementServices->getDataByParent();
        return view(AppHelper::getViewPath('edit'), compact('measurement','measurements'));
    }

    public function update(NonMeasurementUpdateRequest $request, $id)
    {
        $this->measurementServices->id = $id;
        $data = $request->only(['title']);
        $data['key'] = \Str::slug($data['title']);
        $result = $this->measurementServices->update($data);
        return AppHelper::returnPath($result);
    }

    public function destroy($id)
    {
        $this->measurementServices->id = $id;
        $result = $this->measurementServices->delete();
        return AppHelper::returnBack($result);
    }

    public function sortable(Request $request)
    {
        foreach ($request->ids as $key => $id) {
            NonMeasurement::find($id)->update(['rank' => $key+1]);
        }

        return redirect()->back();
    }

}
