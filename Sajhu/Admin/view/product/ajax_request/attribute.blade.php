<hr>
<div class="col-md-3"></div>
<div class="col-md-9">
    <h3>Attributes</h3>
</div>

@if($errors->has('attribute_ids'))
    <p class="text text-danger">{{ $errors->first('attribute_ids') }}</p>
@endif

@if(isset($attributes) && count($attributes)>0)
    @foreach($attributes as $attribute)
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                   for="attribute_ids[{{ $attribute->id }}]"> {{ $attribute->attribute_title }} <span
                    class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12" style="display: flex">

                @if($attribute->input_type == 'select')
                    @if(isset($attribute->attributeable->childs) && count($attribute->attributeable->childs)>0)
                        <select class="form-control" name="" id="">
                            @foreach($attribute->attributeable->childs as $measurement)
                                <option value="{{ $measurement->title }}">{{ $measurement->title }}</option>
                            @endforeach
                        </select>
                    @else

                    @endif
                @elseif($attribute->input_type == 'radio')
                    @if(isset($attribute->attributeable->childs) && count($attribute->attributeable->childs)>0)
                        @foreach($attribute->attributeable->childs as $measurement)
                            <input id="attribute_ids[{{ $measurement->id }}]"
                                   name="attribute_ids[{{ $measurement->id }}]"
                                   value="{{ old('attribute_ids[`{{ $measurement->id`]') }}"
                                   required="required" type="checkbox"> {{ $measurement->title }}
                        @endforeach
                    @else
                        <input id="attribute_ids[{{ $attribute->id }}]" name="attribute_ids[{{ $attribute->id }}]"
                               value="{{ old('attribute_ids[`{{ $attribute->id`]') }}"
                               required="required" type="checkbox"> {{ $attribute->attribute_title }}
                    @endif
                @else
                    <input id="attribute_ids[{{ $attribute->id }}]" class="form-control col-md-7 col-xs-12"
                           data-validate-length-range="6"
                           data-validate-words="2" name="attribute_ids[{{ $attribute->id }}]"
                           value="{{ old('attribute_ids[`{{ $attribute->id`]') }}"
                           placeholder="Enter {{ $attribute->attribute_title }}"
                           required="required" type="text">
                    <select name="" class="measuremtnt_id" class="form-control" id="">
                        <option
                            value="{{ $attribute->attributeable->measurement_id }}">{{ $attribute->attributeable->title }}</option>
                        @if(isset($attribute->attributeable->childs) && count($attribute->attributeable->childs)>0)
                            @foreach($attribute->attributeable->childs as $measurement)
                                <option value="{{ $measurement->id }}">{{ $measurement->title }}</option>
                            @endforeach
                        @endif
                    </select>
                @endif

            </div>
        </div>
    @endforeach
@endif
<hr>

<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Unit </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" disabled value="{{ $unit }}" class="form-control">
    </div>
</div>

