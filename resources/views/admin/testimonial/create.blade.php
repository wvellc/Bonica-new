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
                {{ Breadcrumbs::render("testimonial".$page_title) }}
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
                            @php
                            $nameRequired=$statusRequired= 1;
                            @endphp

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="added_by">Added By</label>
                                    {{ Form::text('added_by',(old('added_by'))?old('added_by'):$formObj->added_by, ['class' => 'form-control', 'placeholder' => 'Added By', 'id' => 'added_by']) }}
                                    <!-- Error -->
                                    @if ($errors->first('added_by'))
                                    <div class="error">
                                        {{ $errors->first('added_by') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    <!-- Error -->
                                    @if ($errors->first('image'))
                                    <div class="error">
                                        {{ $errors->first('image') }}
                                    </div>
                                    @endif

                                    @if($formObj->image)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/testimonial/'.$formObj->image) }}" width="300px" class="img-thumbnail" alt="Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @include('admin.input.status')
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="content">Content <span class="error">*</span></label>
                                    {!! Form::textarea('content',(old('content'))?old('content'):$formObj->content,['class'=>'form-control','id'=>'content', 'rows' => 2, 'cols' => 40]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('content'))
                                    <div class="error">
                                        {{ $errors->first('content') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
						<a href="{{ route('admin.testimonial.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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
    $('#content').summernote({
        height: 300,
        placeholder: 'content',

    });

</script>
@endpush

