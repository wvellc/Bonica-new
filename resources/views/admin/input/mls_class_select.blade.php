<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="mls_class">{{ __("MLS Class") }} @if($mlsClassRequired)<span class="error">*</span>@endif</label>
        {!! Form::select('mls_class', $mlsClassList, $selectedMLSClassID, ['class' => 'form-control', 'id' => 'mls_class']) !!}
        <!-- Error -->
        @if ($errors->has('mls_class'))
        <div class="error">
            {{ $errors->first('mls_class') }}
        </div>
        @endif
    </div>
</div>
