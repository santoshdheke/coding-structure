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
                    <form action="{{ route(AppHelper::getBaseRoute('update'),$brand->id) }}"
                          class="form-horizontal form-label-left"
                          novalidate method="post">
                        @csrf @method('put')

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name"> Brand Name <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="brand_name" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="brand_name" value="{{ old('brand_name')?old('brand_name'):$brand->brand_name }}"
                                       placeholder="Enter Brand Name"
                                       required="required" type="text">
                                @if($errors->has('brand_name'))
                                    <p class="text text-danger">{{ $errors->first('brand_name') }}</p>
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
