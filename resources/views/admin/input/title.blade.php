<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="title">Title @if($titleRequired)<span class="error">*</span>@endif</label>
        {{ Form::text('title',(old('title'))?old('title'):$formObj->title, ['class' => 'form-control', 'placeholder' => 'Title', 'id' => 'title']) }}
        <!-- Error -->
        @if ($errors->has('title'))
        <div class="error">
            {{ $errors->first('title') }}
        </div>
        @endif
    </div>
</div>
