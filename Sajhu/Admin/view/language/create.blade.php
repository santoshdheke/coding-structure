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
                    <form action="{{ route(AppHelper::getBaseRoute('store')) }}" class="form-horizontal form-label-left"
                          novalidate method="post" enctype="multipart/form-data">
                        @csrf

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country_name"> Country
                                Name <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="country_name" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="country_name" value="{{ old('country_name') }}"
                                       placeholder="Enter Currency Name"
                                       required="required" type="text">
                                @if($errors->has('country_name'))
                                    <p class="text text-danger">{{ $errors->first('country_name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country_code"> Country
                                Code <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="country_code" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="country_code" value="{{ old('country_code') }}"
                                       placeholder="Enter Currency Code"
                                       required="required" type="text">
                                @if($errors->has('country_code'))
                                    <p class="text text-danger">{{ $errors->first('country_code') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="flag"> Country
                                Flag <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input style="display: none" id="flag" class="col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="flag" value="{{ old('flag') }}"
                                       placeholder="Enter Currency Code"
                                       required="required" type="file">
                                <label for="flag">
                                    <img id="upload_profile_picture" src="{{ asset('admin/src/images/user.png') }}"
                                         width="50px" height="50px" alt="">
                                </label>
                                @if($errors->has('flag'))
                                    <p class="text text-danger">{{ $errors->first('flag') }}</p>
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
                                <button id="send" type="submit" class="btn btn-dark"> <i class="fa fa-plus"></i> Add </button>
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
<script>
    $('#country_name').keyup(function () {
        var country = $(this).val();
        var cc = country.charAt(0) + country.charAt(1);
        $('#country_code').val(cc.toLowerCase());
    })
</script>

<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#upload_profile_picture').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImageView() {
        var $image = $('#upload_profile_picture');
        $image.removeAttr('src').attr('src','{{ asset('admin/src/images/user.png') }}');
    }

    $("#flag").change(function () {
        $('#new_image_upload_div').show();
        var filesize = this.files[0].size;
        var filesizeinMb = Math.round(filesize / 1024);
        if (filesizeinMb > 2046) {
            alert('Please Upload image file less than 2 MB')
            removeImageView();
        }
        else {
            readURL(this);
        }

    });

</script>
<script>
    $('#reset').click(function () {
        removeImageView();
    });
</script>
@endpush
