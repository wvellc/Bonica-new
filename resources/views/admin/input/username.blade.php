<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="username">Username @if($usernameRequired)<span class="error">*</span>@endif</label>
        {{ Form::text('username',(old('username'))?old('username'):$formObj->username, ['class' => 'form-control', 'placeholder' => 'Username', 'id' => 'username']) }}
        <!-- Error -->
        @if ($errors->has('username'))
        <div class="error">
            {{ $errors->first('username') }}
        </div>
        @endif
    </div>
</div>
