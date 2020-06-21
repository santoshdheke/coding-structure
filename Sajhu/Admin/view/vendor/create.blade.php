@extends(AppHelper::getModule('common.layout'))

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>{{ AppHelper::getTitle() }} Page</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
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
                          novalidate method="post" enctype="multipart/form-data" id="vendor-form">
                        @csrf

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name"> First Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="first_name" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="first_name" value="{{ old('first_name') }}"
                                       placeholder="Enter First Name"
                                       required="required" type="text">
                                @if($errors->has('first_name'))
                                    <p class="text text-danger">{{ $errors->first('first_name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="middle_name"> Middle
                                Name </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle_name" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="middle_name" value="{{ old('middle_name') }}"
                                       placeholder="Enter Middle Name"
                                       type="text">
                                @if($errors->has('middle_name'))
                                    <p class="text text-danger">{{ $errors->first('middle_name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name"> Last Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="last_name" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="last_name" value="{{ old('last_name') }}"
                                       placeholder="Enter Last Name"
                                       required="required" type="text">
                                @if($errors->has('last_name'))
                                    <p class="text text-danger">{{ $errors->first('last_name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"> Email <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="email" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                                       data-validate-words="2" name="email" value="{{ old('email') }}"
                                       placeholder="Enter Email"
                                       required="required" type="email">
                                @if($errors->has('email'))
                                    <p class="text text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_phone_no"> Company
                                Phone Number <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="company_phone_no" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="company_phone_no"
                                       value="{{ old('company_phone_no') }}" placeholder="Enter Company Phone Number"
                                       required="required" type="number">
                                @if($errors->has('company_phone_no'))
                                    <p class="text text-danger">{{ $errors->first('company_phone_no') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username"> Username
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="username" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="username"
                                       value="{{ old('username') }}" placeholder="Enter Username"
                                       type="text">
                                @if($errors->has('username'))
                                    <p class="text text-danger">{{ $errors->first('username') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_name"> Company Name<span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="company_name" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="company_name"
                                       value="{{ old('company_name') }}" placeholder="Enter Company Name"
                                       required="required" type="text">
                                @if($errors->has('company_name'))
                                    <p class="text text-danger">{{ $errors->first('company_name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo"> Logo
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="logo"  col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="logo"
                                       value="{{ old('logo') }}"
                                       type="file">
                                @if($errors->has('logo'))
                                    <p class="text text-danger">{{ $errors->first('logo') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> Address <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="address" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="address"
                                       value="{{ old('address') }}" placeholder="Enter Company Address"
                                       required="required" type="text">
                                @if($errors->has('address'))
                                    <p class="text text-danger">{{ $errors->first('address') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile_no"> Mobile Number <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="mobile_no" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="mobile_no"
                                       value="{{ old('mobile_no') }}" placeholder="Enter Company Mobile Number"
                                       required="required" type="text">
                                @if($errors->has('mobile_no'))
                                    <p class="text text-danger">{{ $errors->first('mobile_no') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_pan_no"> Company PAN Number <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="company_pan_no" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="company_pan_no"
                                       value="{{ old('company_pan_no') }}" placeholder="Enter Company PAN Number"
                                       required="required" type="text">
                                @if($errors->has('company_pan_no'))
                                    <p class="text text-danger">{{ $errors->first('company_pan_no') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status"> Status <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="status"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="status"
                                       value="1"
                                       type="checkbox">
                                @if($errors->has('status'))
                                    <p class="text text-danger">{{ $errors->first('status') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-dark">Submit</button>
                                <button type="submit" class="btn btn-default">Cancel</button>
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
        $('#vendor-form').validate({
            errorClass: 'errors',
            rules: {
                first_name: {
                    required: true
                },

            },
            messages: {
                first_name: {
                    required: "Please Enter First Name"
                },
            },
        });
    </script>

@endpush
