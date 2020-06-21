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
                        <small>Manage</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="{{ route(AppHelper::getBaseRoute('update'),$slug) }}"
                          class="form-horizontal form-label-left"
                          novalidate method="post" enctype="multipart/form-data">
                        @csrf @method('put')

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> Title <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="title"
                                       value="{{ isset($slug->title)?$slug->title:old('title') }}"
                                       placeholder="Enter Country Name"
                                       required="required" type="text">
                                @if($errors->has('title'))
                                    <p class="text text-danger">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                Description <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" cols="30" class="form-control"
                                          placeholder="Description"
                                          rows="10">{{ isset($slug->description)?$slug->description:old('description') }}</textarea>
                                @if($errors->has('description'))
                                    <p class="text text-danger">{{ $errors->first('description') }}</p>
                                @endif
                            </div>
                        </div>

                        @if(in_array($slug,config('page.image')))
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image"> Country
                                    Flag <span
                                            class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="display: none" id="image" class="col-md-7 col-xs-12"
                                           data-validate-length-range="6"
                                           data-validate-words="2" name="image" value="{{ old('image') }}"
                                           placeholder="Enter Currency Code"
                                           required="required" type="file">
                                    <label for="image">
                                        @if(isset($slug->image))
                                            <img id="image_upload"
                                                 src="{{ asset(AppHelper::getFolderPath('thumbnails/35_35/'.$slug->image)) }}"
                                                 width="50px" height="50px" alt="">
                                        @else
                                            <img id="image_upload"
                                                 src="{{ asset(config('image.dome')) }}"
                                                 width="50px" height="50px" alt="">
                                        @endif
                                    </label>
                                    @if($errors->has('image'))
                                        <p class="text text-danger">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <img id="image_upload" src="" alt="">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-dark"><i class="fa fa-check"></i>
                                    submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_upload').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImageView() {
        var $image = $('#image_upload');
        $image.removeAttr('src').attr('src', '{{ asset('admin/src/images/user.png') }}');
    }

    $("#image").change(function () {
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
