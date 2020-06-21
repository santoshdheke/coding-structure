<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Module\Admin\Models\Attribute;
use AppHelper;
use Module\Admin\Requests\AttributeAddRequest;
use Module\Admin\Requests\AttributeUpdateRequest;
use Module\Admin\Services\AttributeServices;
use Module\Admin\Services\MeasurementServices;
use Module\Admin\Services\NonMeasurementServices;

class AttributeController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::attribute';
    private $title = 'Attribute';
    private $baseRoute = 'admin.attribute';
    private $attributeServices;
    private $measurementServices;
    private $nonMeasurementServices;

    public function __construct(AttributeServices $attributeServices, MeasurementServices $measurementServices, NonMeasurementServices $nonMeasurementServices)
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        $this->attributeServices = $attributeServices;
        $this->measurementServices = $measurementServices;
        $this->nonMeasurementServices = $nonMeasurementServices;

    }

    public function index()
    {
        $attributes = $this->attributeServices->getDatas();
        return view(AppHelper::getViewPath('index'), compact('attributes'));
    }

    public function create()
    {
        $measurements = $this->measurementServices->getDataByParent();
        $nonMeasurements = $this->nonMeasurementServices->getDataByParent();
        return view(AppHelper::getViewPath('create'), compact('measurements','nonMeasurements'));
    }

    public function store(AttributeAddRequest $request)
    {
        $result = $this->attributeServices->create($request);
        return AppHelper::returnBack($result);
    }

    public function edit(Attribute $attribute)
    {
        $measurements = $this->measurementServices->getDataByParent();
        return view(AppHelper::getViewPath('edit'), compact('attribute', 'measurements'));
    }

    public function update(AttributeUpdateRequest $request, $id)
    {
        $this->attributeServices->id = $id;
        $result = $this->attributeServices->update($request->only(['attribute_title','input_type']));
        return AppHelper::returnBack($result);
    }

    public function destroy($id)
    {
        $this->attributeServices->id = $id;
        $result = $this->attributeServices->delete();
        return AppHelper::returnBack($result);
    }

}
