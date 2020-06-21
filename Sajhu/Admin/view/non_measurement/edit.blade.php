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
                        <small>Edit</small>
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
                    <form action="{{ route(AppHelper::getBaseRoute('update'),$measurement->id) }}"
                          class="form-horizontal form-label-left"
                          novalidate method="post">
                        @csrf @method('put')

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
                                Measurement
                                Title <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12"
                                       data-validate-length-range="6"
                                       data-validate-words="2" name="title"
                                       value="{{ $measurement->title?$measurement->title:old('title') }}"
                                       placeholder="Enter Currency Name"
                                       required="required" type="text">
                                @if($errors->has('title'))
                                    <p class="text text-danger">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                        </div>

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
    $('#parent_id').change(function () {
        var parent_id = $(this).val();
        if (parent_id > 0) {
            $('#measurement_value').show();
        } else {
            $('#measurement_value').hide();
        }
    });
</script>
@endpush
