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
                            <a href="{{ route(AppHelper::getBaseRoute('index'),$category) }}"
                               class="btn btn-dark btn-sm"> <i
                                        class="fa fa-list"></i> {{ AppHelper::getTitle() }} List </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="{{ route(AppHelper::getBaseRoute('store'),$category) }}"
                          class="form-horizontal form-label-left"
                          novalidate method="post">
                        @csrf

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_title"> Category
                                Title <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="category_title" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="category_title" value="{{ old('category_title') }}"
                                       placeholder="Enter Category Title"
                                       required="required" type="text">
                                @if($errors->has('category_title'))
                                    <p class="text text-danger">{{ $errors->first('category_title') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="have_child"> Have
                                Child? </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="have_childs" checked name="have_child" value="1" type="checkbox">
                                @if($errors->has('have_child'))
                                    <p class="text text-danger">{{ $errors->first('have_child') }}</p>
                                @endif
                            </div>
                        </div>

                        <div style="display: none" id="attributes">

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit"> Unit<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="unit" class="form-control col-md-7 col-xs-12"
                                           data-validate-length-range="6"
                                           data-validate-words="2" name="unit" value="{{ old('unit') }}"
                                           placeholder="Enter Unit"
                                           required="required" type="text">
                                    @if($errors->has('unit'))
                                        <p class="text text-danger">{{ $errors->first('unit') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_ids"> Choose
                                    Attribute </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox_group">
                                        @foreach($attributes as $attribute)
                                            <div class="row">
                                                <input name="attribute_ids[]" value="{{ $attribute->id }}" type="checkbox"
                                                       id="attribute{{ $attribute->id }}">
                                                <label
                                                    for="attribute{{ $attribute->id }}">{{ $attribute->attribute_title }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($errors->has('attribute_ids'))
                                        <p class="text text-danger">{{ $errors->first('attribute_ids') }}</p>
                                    @endif
                                </div>
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
    <script>
        $('#have_childs').change(function () {
            var attributeDiv = $('#attributes');
            attributeDiv.show();
            if ($(this).is(':checked')) {
                attributeDiv.hide();
            }
        });
    </script>
@endpush
