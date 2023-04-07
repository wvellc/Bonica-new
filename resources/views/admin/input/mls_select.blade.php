<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="mls">MLS @if($mlsRequired)<span class="error">*</span>@endif</label>
        {!! Form::select('mls', $mlsList, $selectedMLSID, ['class' => 'form-control', 'id' => 'mls']) !!}
        <!-- Error -->
        @if ($errors->has('mls'))
        <div class="error">
            {{ $errors->first('mls') }}
        </div>
        @endif
    </div>
</div>
