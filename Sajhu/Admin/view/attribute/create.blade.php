@extends(AppHelper::getModule('common.layout'))

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>{{ AppHelper::getTitle() }} Page</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ AppHelper::getTitle() }}
                        <small>Add</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown">
                            <a href="{{ route(AppHelper::getBaseRoute('index')) }}" class="btn btn-dark btn-sm"> <i
                                        class="fa fa-list"></i> {{ AppHelper::getTitle() }} List </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="{{ route(AppHelper::getBaseRoute('store')) }}" class="form-horizontal form-label-left"
                          novalidate method="post">
                        @csrf

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_title"> Attribute
                                Title <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="attribute_title" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="attribute_title"
                                       value="{{ old('attribute_title') }}"
                                       placeholder="Enter Attribute Title"
                                       required="required" type="text">
                                @if($errors->has('attribute_title'))
                                    <p class="text text-danger">{{ $errors->first('attribute_title') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attributeable_type"> Choose
                                Measurement Type</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="attributeable_type" class="form-control" id="attributeable_type">
                                    <option value="" selected disabled>Choose
                                        Measurement Type
                                    </option>
                                    <option {{ old('attributeable_type') == "Module\Admin\Models\Measurement" ? "selected":"" }} value="Module\Admin\Models\Measurement">Measurement</option>
                                    <option {{ old('attributeable_type') == "Module\Admin\Models\NonMeasurement" ? "selected":"" }} value="Module\Admin\Models\NonMeasurement">Non Measurement</option>
                                </select>
                                @if($errors->has('attributeable_type'))
                                    <p class="text text-danger">{{ $errors->first('attributeable_type') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group" style="{{ old('attributeable_type') == 'Module\Admin\Models\Measurement'?'':'display: none' }}" id="measurement_div">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="measurement_id"> Choose
                                Measurement <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="measurement_id" class="form-control" id="measurement_id">
                                    <option value="" selected disabled>Choose
                                        Measurement
                                    </option>
                                    @if(isset($measurements) && count($measurements)>0)
                                        @foreach($measurements as $measurement)
                                            <option {{ (old('measurement_id') == $measurement->id)?'selected':'' }} value="{{ $measurement->id }}">
                                                {{ $measurement->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('measurement_id'))
                                    <p class="text text-danger">{{ $errors->first('measurement_id') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group" style="{{ old('attributeable_type') == 'Module\Admin\Models\NonMeasurement'?'':'display: none' }}" id="non_measurement_div">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="non_measurement_id"> Choose
                                Non Measurement</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="non_measurement_id" class="form-control" id="non_measurement_id">
                                    <option value="" selected disabled>Choose
                                        Non Measurement
                                    </option>
                                    @if(isset($nonMeasurements) && count($nonMeasurements)>0)
                                        @foreach($nonMeasurements as $nonMeasurement)
                                            <option {{ (old('non_measurement_id') == $nonMeasurement->id)?'selected':'' }} value="{{ $nonMeasurement->id }}">
                                                {{ $nonMeasurement->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('non_measurement_id'))
                                    <p class="text text-danger">{{ $errors->first('non_measurement_id') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="input_type"> Choose Input Type <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="input_type" class="form-control" id="input_type">
                                    <option value="" selected disabled>Choose Input Type</option>
                                    <option {{ old('input_type') == 'number' ? 'selected':'' }} value="number">Number</option>
                                    <option {{ old('input_type') == 'radio' ? 'selected':'' }} value="radio">Radio</option>
                                    <option {{ old('input_type') == 'checkbox' ? 'selected':'' }} value="checkbox">Check Box</option>
                                    <option {{ old('input_type') == 'select' ? 'selected':'' }} value="select">Select Option</option>
                                    <option {{ old('input_type') == 'text' ? 'selected':'' }} value="text">Text</option>
                                </select>
                                @if($errors->has('input_type'))
                                    <p class="text text-danger">{{ $errors->first('input_type') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <img id="upload_profile_picture" src="" alt="">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-dark"><i class="fa fa-plus"></i> Add
                                </button>
                                <button type="reset" id="reset" class="btn btn-dark">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $('#attributeable_type').change(function () {
            var attributeType =$(this).val();
            var nonMeasurementDiv = $('#non_measurement_div');
            var measurementDiv = $('#measurement_div');

            nonMeasurementDiv.hide();
            measurementDiv.hide();

            if(attributeType == "Module\\Admin\\Models\\Measurement"){
                measurementDiv.show();
            }
            if(attributeType == "Module\\Admin\\Models\\NonMeasurement"){
                nonMeasurementDiv.show();
            }
        });
    </script>
    @endpush
