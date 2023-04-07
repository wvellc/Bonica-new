<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="mobile">Mobile @if($mobileRequired)<span class="error">*</span>@endif</label>
        {{ Form::text('mobile',(old('mobile'))?old('mobile'):$formObj->mobile, ['class' => 'form-control', 'placeholder' => 'Mobile', 'id' => 'mobile']) }}
        <!-- Error -->
        @if ($errors->has('mobile'))
        <div class="error">
            {{ $errors->first('mobile') }}
        </div>
        @endif
    </div>
</div>
