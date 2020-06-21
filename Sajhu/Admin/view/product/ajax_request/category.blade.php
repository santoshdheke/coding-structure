<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id"> Category <span
            class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <select name="category_id" class="form-control" id="category_id{{ $uid }}">
            @if(isset($categories) && count($categories)>0)
                <option value="" selected disabled>Select Category</option>
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}">{{ $category->category_title }}</option>
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

<div id="attribute{{ $uid }}"></div>

{{--@push('js')--}}
    <script>
        $(document).ready(function () {
            $(document).on('change', '#category_id{{ $uid }}', function () {
                var c_id = $(this).val();
                var url = "{{ url('admin/attribute/for_product') }}/" + c_id;
                console.log(url);
                $.get(url, function (response) {
                    $('#attribute{{ $uid }}').html(response);
                }).fail(function (error) {
                    alert('error!');
                    console.log(error);
                });
            })
        });
    </script>
{{--@endpush--}}
