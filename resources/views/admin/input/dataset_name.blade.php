<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="dataset_name">Dataset Name @if($datasetNameRequired)<span class="error">*</span>@endif</label>
        {{ Form::text('dataset_name',(old('dataset_name'))?old('dataset_name'):$formObj->dataset_name, ['class' => 'form-control', 'placeholder' => 'Dataset Name', 'id' => 'dataset_name']) }}
        <!-- Error -->
        @if ($errors->has('dataset_name'))
        <div class="error">
            {{ $errors->first('dataset_name') }}
        </div>
        @endif
    </div>
</div>
