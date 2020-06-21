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
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
                                Measurement
                                Title <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="title"
                                       value="{{ old('title') }}"
                                       placeholder="Enter Measurement Title"
                                       required="required" type="text">
                                @if($errors->has('title'))
                                    <p class="text text-danger">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id"> Choose Parent
                                Measurement <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="parent_id" class="form-control" id="parent_id">
                                    <option {{ (old('parent_id') == '0')?'selected':'' }} value="0">Choose Parent
                                    </option>
                                    @if(isset($measurements) && count($measurements)>0)
                                        @foreach($measurements as $measurement)
                                            <option {{ (old('parent_id') == $measurement->id)?'selected':'' }} value="{{ $measurement->id }}">
                                                {{ $measurement->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('parent_id'))
                                    <p class="text text-danger">{{ $errors->first('parent_id') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group" id="compare_parent_value" style="{{ $errors->has('compare_parent_value')?'':'display: none;' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="compare_parent_value"> Value
                                 </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <small>(Division by parent)</small>
                                <input id="compare_parent_value" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="compare_parent_value"
                                       value="{{ old('compare_parent_value') }}"
                                       placeholder="Enter Value"
                                       required="required" type="text">
                                @if($errors->has('compare_parent_value'))
                                    <p class="text text-danger">{{ $errors->first('compare_parent_value') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                @include(AppHelper::getModule('common.create_buttom'))
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{ asset('asset/vendors/validator/validator.js') }}"></script>
<script>
    $('#parent_id').change(function () {
        var parent_id = $(this).val();
        if (parent_id > 0) {
            $('#compare_parent_value').show();
        }else{
            $('#compare_parent_value').hide();
        }
    });
</script>
@endpush
