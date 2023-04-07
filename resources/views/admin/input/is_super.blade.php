<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="is_super">Is Super Admin @if($isSuperRequired)<span class="error">*</span>@endif</label>
        {!! Form::select('is_super', $isSuperData, $selectedIsSuperID, ['class' => 'form-control', 'id' => 'is_super']) !!}
        <!-- Error -->
        @if ($errors->has('is_super'))
        <div class="error">
            {{ $errors->first('is_super') }}
        </div>
        @endif
    </div>
</div>
