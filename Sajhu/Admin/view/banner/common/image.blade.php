<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image"> Banner Image <span
            class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <label for="upload">
            <span> Choose Image</span>
        </label>
        <input type="file" name="image" style="display: none" id="upload">
        @if($errors->has('banner_image'))
            <p class="text text-danger">{{ $errors->first('banner_image') }}</p>
        @endif
    </div>
    <div class="col-md-12 text-center">

        <div id="upload-demo" style="width:350px"></div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <img id="upload_profile_picture" style="width: 200px;"
             src="{{ isset($banner->image)?asset(str_replace('public','storage',$banner->image)):'' }}" alt="">
    </div>
</div>
@if($errors->has('image'))
    <p class="text text-danger">{{ $errors->first('image') }}</p>
@endif
<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
        <button type="submit" class="btn btn-primary upload-result">Upload</button>
    </div>
</div>

