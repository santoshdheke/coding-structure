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
                    <form action="{{ route(AppHelper::getBaseRoute('update'),['category' => $category,'subcategory' => $subcategory->category_slug]) }}"
                          class="form-horizontal form-label-left"
                          novalidate method="post">
                        @csrf @method('put')

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_title"> Sub
                                Category
                                Title <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="category_title" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="category_title"
                                       value="{{ old('category_title')?old('category_title'):$subcategory->category_title }}"
                                       placeholder="Enter Sub Category Title"
                                       required="required" type="text">
                                @if($errors->has('category_title'))
                                    <p class="text text-danger">{{ $errors->first('category_title') }}</p>
                                @endif
                            </div>
                        </div>

                        @if($subcategory->have_child == 0)
                            <div class="item form-group" id="attributes">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_title"> Choose
                                    Attribute </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox_group">
                                        @foreach($attributes as $attribute)
                                            <div class="row">
                                                <input name="attribute_ids[]" value="{{ $attribute->id }}"
                                                       type="checkbox"
                                                       {{ (in_array($attribute->id,$subcategory->attribute_ids))?'checked':'' }}
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
                        @endif

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
