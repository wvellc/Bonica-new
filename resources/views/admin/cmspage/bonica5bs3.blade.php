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
                {{ Breadcrumbs::render("cmspage".$page_title) }}
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
					{{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method, 'enctype' => 'multipart/form-data', 'class' => 'form-vertical')) }}
                    @if ($method === "PUT")
                    <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                    @endif
                    <input type="hidden" id="page" name="page" value="bonica5bs3">
					<!-- form start -->
					<div class="card-body">
						<div class="row">
                            @php
                            $nameRequired=$statusRequired= 1;
                            @endphp
                           {{--  @include('admin.input.name') --}}
                            @include('admin.input.status')
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="banner_image">Banner Image (690 * 560 pixels)</label>
                                    <input type="file" name="banner_image" class="form-control" id="banner_image">
                                    <!-- Error -->
                                    @if ($errors->first('banner_image'))
                                    <div class="error">
                                        {{ $errors->first('banner_image') }}
                                    </div>
                                    @endif

                                    @if($formObj->banner_image)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->banner_image) }}" width="300px" class="img-thumbnail" alt="Banner Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    {!! Form::textarea('title',(old('title'))?old('title'):$formObj->title,['class'=>'form-control','placeholder' => '','id'=>'title', 'rows' => 2, 'cols' => 2]) !!}
                                    {{-- {{ Form::text('title',(old('title'))?old('title'):$formObj->title, ['class' => 'form-control', 'placeholder' => 'BONICA’S 5BS', 'id' => 'title']) }} --}}
                                    <!-- Error -->
                                    @if ($errors->first('title'))
                                    <div class="error">
                                        {{ $errors->first('title') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="big_image">Big Image</label>
                                    <input type="file" name="big_image" class="form-control" id="big_image">
                                    <!-- Error -->
                                    @if ($errors->first('big_image'))
                                    <div class="error">
                                        {{ $errors->first('big_image') }}
                                    </div>
                                    @endif

                                    @if($formObj->big_image)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->big_image) }}" width="300px" class="img-thumbnail" alt="Banner Image">
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="image_1">Icon 1</label>
                                    <input type="file" name="image_1" class="form-control" id="image_1">
                                    <!-- Error -->
                                    @if ($errors->first('image_1'))
                                    <div class="error">
                                        {{ $errors->first('image_1') }}
                                    </div>
                                    @endif

                                    @if($formObj->image_1)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->image_1) }}" width="300px" class="img-thumbnail" alt="Banner Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="title_1">Title 1</label>
                                    {{ Form::text('title_1',(old('title_1'))?old('title_1'):$formObj->title_1, ['class' => 'form-control', 'placeholder' => '', 'id' => 'title_1']) }}
                                    <!-- Error -->
                                    @if ($errors->first('title_1'))
                                    <div class="error">
                                        {{ $errors->first('title_1') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="content_1">Content 1</label>
                                    {!! Form::textarea('content_1',(old('content_1'))?old('content_1'):$formObj->content_1,['class'=>'form-control','id'=>'content_1', 'rows' => 2, 'cols' => 40]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('content_1'))
                                    <div class="error">
                                        {{ $errors->first('content_1') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="image_2">Icon 2</label>
                                    <input type="file" name="image_2" class="form-control" id="image_2">
                                    <!-- Error -->
                                    @if ($errors->first('image_2'))
                                    <div class="error">
                                        {{ $errors->first('image_2') }}
                                    </div>
                                    @endif

                                    @if($formObj->image_2)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->image_2) }}" width="300px" class="img-thumbnail" alt="Banner Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="title_2">Title 2</label>
                                    {{ Form::text('title_2',(old('title_2'))?old('title_2'):$formObj->title_2, ['class' => 'form-control', 'placeholder' => '', 'id' => 'title_2']) }}
                                    <!-- Error -->
                                    @if ($errors->first('title_2'))
                                    <div class="error">
                                        {{ $errors->first('title_2') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="content_2">Content 1</label>
                                    {!! Form::textarea('content_2',(old('content_2'))?old('content_2'):$formObj->content_2,['class'=>'form-control','id'=>'content_2', 'rows' => 2, 'cols' => 40]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('content_2'))
                                    <div class="error">
                                        {{ $errors->first('content_2') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="image_3">Icon 3</label>
                                    <input type="file" name="image_3" class="form-control" id="image_3">
                                    <!-- Error -->
                                    @if ($errors->first('image_3'))
                                    <div class="error">
                                        {{ $errors->first('image_3') }}
                                    </div>
                                    @endif

                                    @if($formObj->image_3)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->image_3) }}" width="300px" class="img-thumbnail" alt="Banner Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="title_3">Title 3</label>
                                    {{ Form::text('title_3',(old('title_3'))?old('title_3'):$formObj->title_3, ['class' => 'form-control', 'placeholder' => '', 'id' => 'title_3']) }}
                                    <!-- Error -->
                                    @if ($errors->first('title_3'))
                                    <div class="error">
                                        {{ $errors->first('title_3') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="content_3">Content 1</label>
                                    {!! Form::textarea('content_3',(old('content_3'))?old('content_3'):$formObj->content_3,['class'=>'form-control','id'=>'content_3', 'rows' => 2, 'cols' => 40]) !!}

                                    <!-- Error -->
                                    @if ($errors->first('content_3'))
                                    <div class="error">
                                        {{ $errors->first('content_3') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="image_4">Icon 4</label>
                                    <input type="file" name="image_4" class="form-control" id="image_4">
                                    <!-- Error -->
                                    @if ($errors->first('image_4'))
                                    <div class="error">
                                        {{ $errors->first('image_4') }}
                                    </div>
                                    @endif

                                    @if($formObj->image_4)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->image_4) }}" width="300px" class="img-thumbnail" alt="Banner Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="title_4">Title 4</label>
                                    {{ Form::text('title_4',(old('title_4'))?old('title_4'):$formObj->title_4, ['class' => 'form-control', 'placeholder' => '', 'id' => 'title_4']) }}
                                    <!-- Error -->
                                    @if ($errors->first('title_4'))
                                    <div class="error">
                                        {{ $errors->first('title_4') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="content_4">Content 1</label>
                                    {!! Form::textarea('content_4',(old('content_4'))?old('content_4'):$formObj->content_4,['class'=>'form-control','id'=>'content_4', 'rows' => 2, 'cols' => 40]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('content_4'))
                                    <div class="error">
                                        {{ $errors->first('content_4') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="image_5">Icon 5</label>
                                    <input type="file" name="image_5" class="form-control" id="image_5">
                                    <!-- Error -->
                                    @if ($errors->first('image_5'))
                                    <div class="error">
                                        {{ $errors->first('image_5') }}
                                    </div>
                                    @endif

                                    @if($formObj->image_5)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->image_5) }}" width="300px" class="img-thumbnail" alt="Banner Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="title_5">Title 5</label>
                                    {{ Form::text('title_5',(old('title_5'))?old('title_5'):$formObj->title_5, ['class' => 'form-control', 'placeholder' => '', 'id' => 'title_5']) }}
                                    <!-- Error -->
                                    @if ($errors->first('title_5'))
                                    <div class="error">
                                        {{ $errors->first('title_5') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="content_5">Content 1</label>
                                    {!! Form::textarea('content_5',(old('content_5'))?old('content_5'):$formObj->content_5,['class'=>'form-control','id'=>'content_5', 'rows' => 2, 'cols' => 40]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('content_5'))
                                    <div class="error">
                                        {{ $errors->first('content_5') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    {{ Form::text('meta_title',(old('meta_title'))?old('meta_title'):$formObj->meta_title, ['class' => 'form-control', 'placeholder' => 'Meta Title', 'id' => 'meta_title']) }}
                                    <!-- Error -->
                                    @if ($errors->first('meta_title'))
                                    <div class="error">
                                        {{ $errors->first('meta_title') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords (keywords seperated by comma)</label>
                                    {{ Form::text('meta_keywords',(old('meta_keywords'))?old('meta_keywords'):$formObj->meta_keywords, ['class' => 'form-control', 'placeholder' => 'Meta Keywords', 'id' => 'meta_keywords']) }}
                                    <!-- Error -->
                                    @if ($errors->first('meta_keywords'))
                                    <div class="error">
                                        {{ $errors->first('meta_keywords') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    {!! Form::textarea('meta_description',(old('meta_description'))?old('meta_description'):$formObj->meta_description,['class'=>'form-control','id'=>'meta_description', 'rows' => 2, 'cols' => 40]) !!}

                                    <!-- Error -->
                                    @if ($errors->first('meta_description'))
                                    <div class="error">
                                        {{ $errors->first('meta_description') }}
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
						<a href="{{ route('admin.dashboard.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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

    $('#title').summernote({});
    $('#making_bonica_diamond_seed_description').summernote({
        height: 300,
        placeholder: 'content',
    });
    $('#making_bonica_heating_description').summernote({
        height: 300,
        placeholder: 'Description',

    });

    $('#making_bonica_plasma_description').summernote({
        height: 300,
        placeholder: 'Description',

    });

    $('#making_bonica_all_diamonds_description').summernote({
        height: 300,
        placeholder: 'Description',

    });


</script>
@endpush

