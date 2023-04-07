<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="password_confirmation">Confirm Password @if($method !== "PUT" && $confirmPasswordRequired)<span class="error">*</span>@endif</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" value="{{ (old('password_confirmation'))? old('password_confirmation'): '' }}" class="form-control">
        <!-- Error -->
        @if ($errors->has('password_confirmation'))
        <div class="error">
            {{ $errors->first('password_confirmation') }}
        </div>
        @endif
    </div>
</div>
