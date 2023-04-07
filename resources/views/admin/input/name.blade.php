<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="name">Name @if($nameRequired)<span class="error">*</span>@endif</label>
        {{ Form::text('name',(old('name'))?old('name'):$formObj->name, ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name']) }}
        <!-- Error -->
        @if ($errors->has('name'))
        <div class="error">
            {{ $errors->first('name') }}
        </div>
        @endif
    </div>
</div>
