<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="last_offset">Last Offset @if($lastOffsetRequired)<span class="error">*</span>@endif</label>
        {{ Form::number('last_offset',(old('last_offset'))?old('last_offset'):$formObj->last_offset, ['class' => 'form-control', 'placeholder' => 'Last Offset', 'id' => 'last_offset']) }}
        <!-- Error -->
        @if ($errors->has('last_offset'))
        <div class="error">
            {{ $errors->first('last_offset') }}
        </div>
        @endif
    </div>
</div>
