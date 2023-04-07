<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="gender">Gender @if($genderRequired)<span class="error">*</span>@endif</label>
        {!! Form::select('gender', $genderData, $selectedGenderID, ['class' => 'form-control', 'id' => 'gender']) !!}
        <!-- Error -->
        @if ($errors->has('gender'))
        <div class="error">
            {{ $errors->first('gender') }}
        </div>
        @endif
    </div>
</div>
