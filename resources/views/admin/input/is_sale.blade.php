<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="is_sale">Is Sale @if($isSaleRequired)<span class="error">*</span>@endif</label>
        {!! Form::select('is_sale', $isSaleData, $selectedIsSaleID, ['class' => 'form-control', 'id' => 'is_sale']) !!}
        <!-- Error -->
        @if ($errors->has('is_sale'))
        <div class="error">
            {{ $errors->first('is_sale') }}
        </div>
        @endif
    </div>
</div>
