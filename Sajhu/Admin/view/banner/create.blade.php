@extends(AppHelper::getModule('common.layout'))

@section('content')
    <style>
        .errors {
            color: red;
        }
    </style>
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
                    <form action="#" class="form-horizontal form-label-left" novalidate method="post"
                          enctype="multipart/form-data" id="bannerform">
                        @csrf

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="banner_name"> Banner Name
                                <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="banner_name" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="banner_name" value="{{ old('banner_name') }}"
                                       placeholder="Enter Banner Name" type="text">
                                @if($errors->has('banner_name'))
                                    <p class="text text-danger">{{ $errors->first('banner_name') }}</p>
                                @endif
                            </div>
                        </div>

                        @include('Admin::banner.common.image')

                        <div class="ln_solid"></div>
                        {{--<div class="form-group">--}}
                        {{--<div class="col-md-6 col-md-offset-3">--}}
                        {{--<button id="send" type="submit" class="btn btn-dark"> <i class="fa fa-plus"></i> Add </button>--}}
                        {{--<buttonreview type="reset" id="reset" class="btn btn-dark">Reset</button>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
    <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $uploadCrop = $('#upload-demo').croppie({

                enableExif: true,
                viewport: {
                    width: 870,
                    height: 462
                },

                boundary: {
                    width: 875,
                    height: 467
                }
            });

            $('#bannerform').validate({
                errorClass: 'errors',
                rules: {
                    banner_name: {
                        required: true
                    },
                    image: {
                        required: true,
                        extension: "png|jpeg|jpg|svg"
                    }

                },
                messages: {
                    banner_name: {
                        required: "Please Enter Banner Name"
                    },
                    image: {
                        required: "Please Choose Image"
                    }
                },
                submitHandler: function (form) {
                    $uploadCrop.croppie('result', {

                        type: 'canvas',

                        size: 'viewport'

                    }).then(function (resp) {
                        var banner_name = $('#banner_name').val();
                        var banner_id = '{{$banner->id??''}}';
//            console.log(banner_id);
                        $.ajax({

                            url: "{{ route(AppHelper::getBaseRoute('picture.update')) }}",

                            type: "POST",

                            data: {
                                "image": resp,
                                "id": banner_id,
                                "banner_name": banner_name,
                                "_token": "{{ csrf_token() }}"
                            },

                            success: function (data) {
                                if(data.success) {
                                    alertify.notify('Successfully Added', 'success', 5, function () {
                                        console.log('dismissed');
                                    });
                                    $('#bannerform')[0].reset();
                                }else{
                                    alertify.notify('Error', 'error', 5, function () {
                                        console.log('dismissed');
                                    });
                                }
                            },

                            error: function (error) {
                                console.log('error ====', error);
                            }
                        });
                    });
                }
            });
        });

        $('#upload').on('change', function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('.upload-result').on('submit', function (ev) {
            ev.prventDefault();
        });
        /* image upload image crop plugin end */
    </script>

    @endpush

@endsection
