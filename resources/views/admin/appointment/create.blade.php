@extends('admin.layouts.layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">{{ $module }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
                {{ Breadcrumbs::render("homepagecontent".$page_title) }}
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
		@include('admin.layouts.alert_message')
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="card card-info">

					{{-- <div class="card-header">
						<h3 class="card-title">{{ $page_title }}</h3>
					</div> --}}
					<!-- /.card-header -->

					{{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method, 'enctype' => 'multipart/form-data', 'class' => 'form-vertical')) }}
                    @if ($method === "PUT")
                    <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                    @endif
					<!-- form start -->
					<div class="card-body">
						<div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="title">Title <span class="error">*</span></label>
                                    {{ Form::text('title',(old('title'))?old('title'):$formObj->title, ['class' => 'form-control', 'placeholder' => 'Title', 'id' => 'title']) }}
                                    <!-- Error -->
                                    @if ($errors->has('title'))
                                    <div class="error">
                                        {{ $errors->first('title') }}
                                    </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="icon">Icon</label>
                                    <input type="file" name="icon" class="form-control" id="icon">
                                    <!-- Error -->
                                    @if ($errors->first('icon'))
                                    <div class="error">
                                        {{ $errors->first('icon') }}
                                    </div>
                                    @endif
                                    @isset($formObj->icon)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/homepage/'.$formObj->icon) }}" width="100px" class="img-thumbnail" alt="Home Page Icon">
                                     </div>
                                     @endisset
                                </div>
                            </div>
                            @php $nameRequired=$statusRequired= 1; @endphp
                            @include('admin.input.status')
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="icon">Description</label>
                                    {!! Form::textarea('description',(old('description'))?old('description'):$formObj->description,['class'=>'form-control','id'=>'description', 'rows' => 2, 'cols' => 40]) !!}
                                    <h5 id="maxContentPost" style="text-align:right"></h5>
                                    <!-- Error -->
                                    @if ($errors->first('description'))
                                    <div class="error">
                                        {{ $errors->first('description') }}
                                    </div>
                                    @endif
                                    <div class="imgPreview"> </div>
                                </div>
                            </div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
						<a href="{{ route('admin.contact.index') }}" class="btn btn-danger icon-btn">Cancel</a>
					</div>
					{{ Form::close() }}
				</div>
				<!-- /.card -->
			</div>
			<!--/.col (left) -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
@stop
@push('js')
<script>
    $('#description').summernote({
        height: 400,
        placeholder: 'Leave a content ...',
        callbacks: {
                    onKeydown: function (e) {
                        var t = e.currentTarget.innerText;
                        if (t.trim().length >= 200) {
                            //delete keys, arrow keys, copy, cut, select all
                            if (e.keyCode != 8 && !(e.keyCode >=37 && e.keyCode <=40) && e.keyCode != 46 && !(e.keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey) && !(e.keyCode == 65 && e.ctrlKey))
                            e.preventDefault();
                        }
                    },
                    onKeyup: function (e) {
                        var t = e.currentTarget.innerText;
                        $('#maxContentPost').text(200 - t.trim().length);
                    },
                    onPaste: function (e) {
                        var t = e.currentTarget.innerText;
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        var maxPaste = bufferText.length;
                        if(t.length + bufferText.length > 200){
                            maxPaste = 200 - t.length;
                        }
                        if(maxPaste > 0){
                            document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
                        }
                        $('#maxContentPost').text(200 - t.length);
                    }
                }
    });
    $(function() {
        $('#dob').datepicker({
            format: 'mm/dd/yyyy'
        });
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {
                var filesAmount = input.files.length;
                $('.imgPreview').html('');
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
    });
</script>
@endpush
