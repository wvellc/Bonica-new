<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="password_text">Password @if($method !== "PUT" && $passwordRequired)<span class="error">*</span>@endif</label>
        <input type="text" id="password_text" name="password_text" placeholder="Password" value="{{ (old('password_text'))?old('password_text'):$formObj->password }}" class="form-control">
        <!-- Error -->
        @if ($errors->has('password_text'))
        <div class="error">
            {{ $errors->first('password_text') }}
        </div>
        @endif
    </div>
</div>
