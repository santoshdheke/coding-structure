<div class="x_content">
    <br>
    <form action="{{ route(AppHelper::getBaseRoute('general.update')) }}" method="post"
          class="form-horizontal form-label-left input_mask">
        @csrf @method('put')

        @if(session('general_success'))
            <div class="alert alert-success">{{ session('general_success') }}</div>
        @endif

        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <input class="form-control has-feedback-left" name="name"
                       value="{{ ($profile->name)?$profile->name:old('name') }}"
                       placeholder="Name ({{ auth()->user()->name }})" type="text">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                @if($errors->has('name'))
                    <p class="text text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <input class="form-control has-feedback-left" name="email"
                       value="{{ ($profile->email)?$profile->email:old('email') }}"
                       placeholder="Email ({{ auth()->user()->email }}) " type="text">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                @if($errors->has('email'))
                    <p class="text text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
</div>