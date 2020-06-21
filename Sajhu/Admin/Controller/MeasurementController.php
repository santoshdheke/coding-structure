<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Admin\Models\Measurement;
use AppHelper;
use Module\Admin\Requests\MeasurementRequest;
use Module\Admin\Services\MeasurementServices;

class MeasurementController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::measurement';
    private $title = 'Measurement Tool';
    private $baseRoute = 'admin.measurement';
    private $measurementServices;

    public function __construct(MeasurementServices $measurementServices)
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

    public function store(MeasurementRequest $request)
    {
        $result = $this->measurementServices->create($request);

        return AppHelper::returnPath($result);
    }

    public function show(Measurement $measurement)
    {
        $measurements = $measurement->childs;
        return view(AppHelper::getViewPath('index'), compact('measurements'));
    }

    public function edit(Measurement $measurement)
    {
        $measurements = $this->measurementServices->getDataByParent();
        return view(AppHelper::getViewPath('edit'), compact('measurement', 'measurements'));
    }

    public function update(MeasurementRequest $request, $id)
    {
        $this->measurementServices->id = $id;
        $result = $this->measurementServices->update($request);
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
            Measurement::find($id)->update(['rank' => $key + 1]);
        }

        return redirect()->back();
    }

}
