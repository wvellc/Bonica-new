<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="limit">Limit @if($limitRequired)<span class="error">*</span>@endif</label>
        {{ Form::number('limit',(old('limit'))?old('limit'):$formObj->limit, ['class' => 'form-control', 'placeholder' => 'Limit', 'id' => 'limit']) }}
        <!-- Error -->
        @if ($errors->has('limit'))
        <div class="error">
            {{ $errors->first('limit') }}
        </div>
        @endif
    </div>
</div>
