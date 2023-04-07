<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="password">Password @if($method !== "PUT" && $passwordRequired)<span class="error">*</span>@endif</label>
        <input type="password" id="password" name="password" placeholder="Password" value="{{ (old('password'))?old('password'):"" }}" class="form-control">
        <!-- Error -->
        @if ($errors->has('password'))
        <div class="error">
            {{ $errors->first('password') }}
        </div>
        @endif
    </div>
</div>
