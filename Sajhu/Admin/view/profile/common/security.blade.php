<div class="x_content">
    <br>
    <form action="{{ route(AppHelper::getBaseRoute('security.update')) }}" method="post"
          class="form-horizontal form-label-left input_mask">
        @csrf @method('put')

        @if(session('security_success'))
            <div class="alert alert-success">{{ session('security_success') }}</div>
        @endif

        @if(session('security_error'))
            <div class="alert alert-danger">{{ session('security_error') }}</div>
        @endif

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Old Password</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" placeholder="Old Password" name="old_password" value="{{ old('old_password') }}" type="password">
                @if($errors->has('old_password'))
                    <p class="text text-danger">{{ $errors->first('old_password') }}</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">New Password</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" placeholder="New Password" name="password" value="{{ old('password') }}" type="password">
                @if($errors->has('password'))
                    <p class="text text-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">New Confirm Password</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" placeholder="New Confirm Password" name="confirm_password" value="{{ old('confirm_password') }}" type="password">
                @if($errors->has('confirm_password'))
                    <p class="text text-danger">{{ $errors->first('confirm_password') }}</p>
                @endif
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Password Change</button>
            </div>
        </div>

    </form>
</div>