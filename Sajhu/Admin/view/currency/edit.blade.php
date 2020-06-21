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
                        <small>ADd</small>
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
                    <form action="{{ route(AppHelper::getBaseRoute('update'),$currency->id) }}"
                          class="form-horizontal form-label-left"
                          novalidate method="post">
                        @csrf @method('put')

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency_name"> Currency
                                Name <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="currency_name" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="currency_name"
                                       value="{{ $currency->currency_name?$currency->currency_name:old('currency_name') }}"
                                       placeholder="Enter Currency Name"
                                       required="required" type="text">
                                @if($errors->has('currency_name'))
                                    <p class="text text-danger">{{ $errors->first('currency_name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="symbol"> Back or Front <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="symbol_area" class="form-control" id="">
                                    <option value="" disabled selected>Choose Symbol Area</option>
                                    <option {{ ((old('symbol_area') == 'front') || $currency->front_symbol)?'selected':'' }} value="front">
                                        Front Symbol
                                    </option>
                                    <option {{ ((old('symbol_area') == 'back') || $currency->back_symbol)?'selected':'' }} value="back">
                                        Back Symbol
                                    </option>
                                </select>
                                @if($errors->has('symbol_area'))
                                    <p class="text text-danger">{{ $errors->first('symbol_area') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="symbol"> Symbol <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="symbol" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="symbol"
                                       value="{{ $currency->front_symbol?$currency->front_symbol:$currency->back_symbol }}"
                                       placeholder="Enter Symbol"
                                       required="required" type="text">
                                @if($errors->has('symbol'))
                                    <p class="text text-danger">{{ $errors->first('symbol') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="compare_with_dolor"> Equal To
                                Dollor <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="compare_with_dolor" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="compare_with_dolor"
                                       value="{{ $currency->compare_with_dolor?$currency->compare_with_dolor:old('compare_with_dolor') }}"
                                       placeholder="Enter Value Equal To Dollor"
                                       required="required" type="text">
                                @if($errors->has('compare_with_dolor'))
                                    <p class="text text-danger">{{ $errors->first('compare_with_dolor') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-dark"> <i class="fa fa-refresh"></i> Update </button>
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
<script src="{{ asset('asset/vendors/validator/validator.js') }}"></script>
@endpush
