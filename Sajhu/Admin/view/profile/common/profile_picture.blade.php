<div class="x_content">
    <br>
    <form action="{{ route(AppHelper::getBaseRoute('picture.update')) }}" method="post"
          class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
        @csrf @method('put')

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Profile Picture</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input name="image" type="file" id="profile_image">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <img id="upload_profile_picture" style="width: 200px;"
                     src="{{ isset($image->image)?asset('image/banner/'.$image->image):'' }}" alt="">
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>

    </form>
</div>


@push('js')

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
        $image.removeAttr('src').replaceWith($image.clone());
    }

    $("#profile_image").change(function () {
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
