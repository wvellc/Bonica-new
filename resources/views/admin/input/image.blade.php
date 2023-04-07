<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="imageFile">Image @if($method !== "PUT" && $imageRequired) <span class="error">*</span> @endif</label>
        <input type="file" name="imageFile" class="form-control" id="images">
        <!-- Error -->
        @if ($errors->first('imageFile'))
        <div class="error">
            {{ $errors->first('imageFile') }}
        </div>
        @endif
        <div class="imgPreview"> </div>
    </div>
</div>
