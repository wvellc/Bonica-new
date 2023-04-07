<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="email">Email @if($emailRequired)<span class="error">*</span>@endif</label>
        {{ Form::email('email',(old('email'))?old('email'):$formObj->email, ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'email']) }}
        <!-- Error -->
        @if ($errors->has('email'))
        <div class="error">
            {{ $errors->first('email') }}
        </div>
        @endif
    </div>
</div>
