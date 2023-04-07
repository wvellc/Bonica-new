<div class="col-12 col-sm-12">
    <div class="form-group">
        <label for="short_description">Short Description <span class="error">*</span></label>
        {!! Form::textarea('short_description', (old('short_description'))?old('short_description'):$formObj->short_description, ['class' => 'form-control', 'id' => 'short_description', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) !!}
        <!-- Error -->
        @if ($errors->has('short_description'))
        <div class="error">
            {{ $errors->first('short_description') }}
        </div>
        @endif
    </div>
</div>
