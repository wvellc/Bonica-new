<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="status">Status @if($statusRequired)<span class="error">*</span>@endif</label>
        <div class="select-box">
        {!! Form::select('status', $statusData, $selectedStatusID, ['class' => 'form-control', 'id' => 'status']) !!}
        </div>
        <!-- Error -->
        @if ($errors->has('status'))
        <div class="error">
            {{ $errors->first('status') }}
        </div>
        @endif
    </div>
</div>
