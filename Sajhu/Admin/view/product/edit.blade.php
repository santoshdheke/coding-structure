@extends(AppHelper::getModule('common.layout'))

@section('content')
    <link href="{{ asset('admin/uploader/jquery.plupload.queue.css') }}" type="text/css" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <form action="{{ route(AppHelper::getBaseRoute('update'),$product) }}" class="form-horizontal form-label-left"
                          novalidate enctype="multipart/form-data" method="post">
                        @csrf @method('put')

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(count($errors)>0)
                            <div class="alert alert-danger">Validation Error</div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_name"> Product
                                Name <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="product_name" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="product_name"
                                       value="{{ $product->product_name?$product->product_name:old('product_name') }}"
                                       placeholder="Enter Product Name"
                                       required="required" type="text">
                                @if($errors->has('product_name'))
                                    <p class="text text-danger">{{ $errors->first('product_name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="short_description"> Short
                                Description <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="short_description" placeholder="Short Description"
                                          id="short_description" cols="30" rows="4"
                                          class="form-control">{{ $product->short_description?$product->short_description:old('short_description') }}</textarea>
                                @if($errors->has('short_description'))
                                    <p class="text text-danger">{{ $errors->first('short_description') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="long_description"> Long
                                Description <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="long_description" placeholder="Short Description" id="long_description"
                                          cols="30" rows="8"
                                          class="form-control">{{ $product->long_description?$product->long_description:old('long_description') }}</textarea>
                                @if($errors->has('long_description'))
                                    <p class="text text-danger">{{ $errors->first('long_description') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id"> Category <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="category_id" class="form-control" id="category_id">
                                    @if(isset($categories) && count($categories)>0)
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{ $category->id }}" {{($category->id==$product->category_id)? 'selected': ''}}>{{ $category->category_title }}</option>
                                        @endforeach
                                    @else
                                        <option value="" selected disabled>No Category</option>
                                    @endif
                                </select>
                                @if($errors->has('category_id'))
                                    <p class="text text-danger">{{ $errors->first('category_id') }}</p>
                                @endif
                            </div>
                        </div>

                        <div id="attribute"></div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Choose Multiple Images:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="uploader" style="margin-top: 20px;"></div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="common-gallery-image" style="margin-top: 20px;" class="row">
                                    @foreach($product_images as $key => $img)
{{--                                        @if($img->is_main==1)--}}
{{--                                            @php $main_image =$img->image @endphp--}}
{{--                                        @endif--}}
                                        <div id="uploade-content-{{ $key }}" class="image-item col-md-4"
                                             style="text-align: center;margin: auto;border: 1px solid #ccc">
                                            <input type="hidden" name="images[]" value="{{ $img->image }}">
                                            <div class="image-container"
                                                 style="position: relative; width: 150px; height: 150px; text-align: center; margin: 20px auto; ">
                                                <img src="{{ asset("storage/images/products/".$img->image)}}"
                                                     style="height:100%;width: 100%;position: absolute;object-fit: contain;object-position: center; left: 50%; top:0; transform: translateX(-50%); ">
                                            </div>
                                            <div class="text-container">
                                                <ul style="list-style: none; display: flex;">
                                                    <li style="padding-right:8px">
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="makeMainImage('{{ $img->image }}')">Main Image
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="btn btn-danger"
                                                                onclick="removeImage('{{ $img->image }}','{{$img->id}}',0,0)">
                                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="main_product_image" id="main_product_image">
                        <input type="hidden" name="deleted_image[]" id="deleted_image">

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-dark"><i class="fa fa-refresh"></i>
                                    Update
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
        $(function () {
            CKEDITOR.replace('short_description');
            CKEDITOR.replace('long_description');
        });
        $(document).ready(function () {

            $('#send').on('click',function(){
                if($('#main_product_image').val()==''){
                    alert('Choose Cover Image')
                    return false;
                }
            })
            $(document).on('change', '#category_id', function () {
                var c_id = $(this).val();
                var url = "{{ url('admin/attribute/for_product') }}/" + c_id;
                console.log(url);
                $.get(url, function (response) {
                    $('#attribute').html(response);
                }).fail(function (error) {
                    alert('error!');
                    console.log(error);
                });
            })
        });
        var image_count = 0;
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //plupload start
            $("#uploader").pluploadQueue({
                // General settings
                runtimes: 'html5,html4',
                url: '{{ route("admin.product.storeImage") }}?_token=' + $("meta[name='csrf-token']").attr("content"),
                max_file_size: '300mb',
                unique_names: true,
                filters: [
                    {title: "Image Files", extensions: "jpg,jpeg,png,gif"},
                    // {title : "Video Files", extensions : "mp4,ogv,avi,mov,flv,3gp"}
                ]
            });
            var uploader = $('#uploader').pluploadQueue();
            uploader.bind('FileUploaded', function (up, file, response) {
                var obj = jQuery.parseJSON(response.response);
                var rep = "";
                rep += '<div id="uploade-content-' + image_count + '" class="image-item col-md-4" style="border: 1px solid #ccc">';
                // rep += '<div id="uploade-content-'+obj.filename+'" class="image-item">';
                rep += '<input type="hidden" name="images[]" value="' + obj.filename + '">';
                rep += '<div class="image-container" style="position: relative; width: 150px; height: 150px; text-align: center; margin: 20px auto; ">';
                rep += '<img src="{{ asset("storage/images/products") }}/' + obj.filename + '" width="200px" style="height:100%;width: 100%;position: absolute;object-fit: contain;object-position: center; left: 50%; top:0; transform: translateX(-50%); ">';
                rep += '</div>';
                rep += '<div class="text-container">';
                rep += '<ul style="list-style: none; display: flex;">';
                rep += '<li style="padding-right:8px"><button type="button" class="btn btn-primary" onclick="makeMainImage(\'' + obj.filename + '\')">Main Image</button></li>';
                rep += '<li><button type="button" class="btn btn-danger" onClick="removeImage(\'' + obj.filename + '\',0,0,' + image_count + ')"><span class="glyphicon glyphicon-trash"></span> Delete</button></li>';
                rep += '</ul>';
                rep += '</div>';
                rep += '</div>';
                image_count++;
                // var html='<div id="upload-content-'+obj.filename+'" align="center"><input type="hidden" name="images[]" value="'+obj.filename+'">';
                // html +='<div><img style="width:147px ;height: auto; max-width: 100%"src="{{ asset("uploads/process") }}/'+obj.filename+'"></div><div style="margin-top: 10px"><ul><li style="display: inline-block"><button type="button" class="btn btn-primary" onclick="makeMainImage(\''+obj.filename+'\')">Main Image</button></li>' +
                //     '<li style="display: inline-block;margin-left: 10px"><button type="button" class="btn btn-danger" onClick="removeImage(\''+obj.filename+'\',0,0)"><span class="glyphicon glyphicon-trash" style="padding-right: 5px"></span> </button></li></ul></div></div>';
                var image_html = $(rep);
                $('#common-gallery-image').append(image_html);
            });
            uploader.bind('UploadComplete', function (up, files) {
                $("#uploader").pluploadQueue().splice();
                $('.plupload_buttons').attr('style', 'display: inline;');
                $('.plupload_upload_status').attr('style', 'display: inline;');
            });
        });

        function makeMainImage(image_name) {
            $('#main_product_image').val(image_name);
            alert('Cover Image Changed!');
        }

        // console.log($(this));
        function removeImage(image, id, status, instance) {
            // $(this).parent().parent().parent().parent().find('.image-item').remove()
            var r = confirm('Are you sure to delete?');
            if (r) {
                $('#deleted_image').val(image);
                $.post('{{ route("admin.product.deleteImage") }}', {
                    image: image,
                    id: id,
                    status: status,
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    // console.log(data.success);
                    if (data.success) {
                        $('#uploade-content-' + instance).remove();
                        alert('Image Deleted Successfully.');
                    } else {
                        alert('Unable to delete image!');
                        return false;
                    }
                }, 'json');
            }
        }
    </script>
    <script type="text/javascript" src="{{ asset('admin/uploader/plupload.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/uploader/plupload.html5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/uploader/plupload.html4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/uploader/jquery.plupload.queue.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
@endpush
