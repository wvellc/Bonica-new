<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="dob">Birthday @if($dobRequired)<span class="error">*</span>@endif</label>
        {{ Form::text('dob',(old('dob'))?old('dob'):USDateFormate($formObj->dob), ['class' => 'form-control', 'placeholder' => 'Birthday', 'id' => 'dob']) }}
        <!-- Error -->
        @if ($errors->has('dob'))
        <div class="error">
            {{ $errors->first('dob') }}
        </div>
        @endif
    </div>
</div>
