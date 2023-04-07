<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="token">{{ __("Token") }} @if($tokenRequired)<span class="error">*</span>@endif</label>
        {{ Form::text('token',(old('token'))?old('token'):$formObj->token, ['class' => 'form-control', 'placeholder' => 'Token', 'id' => 'token']) }}
        <!-- Error -->
        @if ($errors->has('token'))
        <div class="error">
            {{ $errors->first('token') }}
        </div>
        @endif
    </div>
</div>
