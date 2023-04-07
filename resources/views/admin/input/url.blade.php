<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="url">{{ __("URL") }} @if($urlRequired)<span class="error">*</span>@endif</label>
        {{ Form::text('url',(old('url'))?old('url'):$formObj->url, ['class' => 'form-control', 'placeholder' => 'URL', 'id' => 'url']) }}
        <!-- Error -->
        @if ($errors->has('url'))
        <div class="error">
            {{ $errors->first('url') }}
        </div>
        @endif
    </div>
</div>
