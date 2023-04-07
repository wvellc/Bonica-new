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
                    <input type="hidden" id="page" name="page" value="sustainablity">
					<!-- form start -->
					<div class="card-body">
						<div class="row">
                            @php
                            $nameRequired=$statusRequired= 1;
                            @endphp
                            {{-- @include('admin.input.name') --}}
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
                            {{-- <div class="col-12 col-sm-12">
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
                            </div> --}}
                            <!-- OUR STORY -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">SUSTAINABILITY</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool"
                                                data-card-widget="collapse"><i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="sustainability_title">Sustainability Title</label>
                                                    {!! Form::textarea('sustainability_title',(old('sustainability_title'))?old('sustainability_title'):$formObj->sustainability_title,['class'=>'form-control','placeholder' => '','id'=>'sustainability_title', 'rows' => 2, 'cols' => 2]) !!}
                                                   {{--  {{ Form::text('sustainability_title',(old('sustainability_title'))?old('sustainability_title'):$formObj->sustainability_title, ['class' => 'form-control', 'placeholder' => 'SUSTAINABILITY - A PROMISE FOR LIFE', 'id' => 'sustainability_title']) }} --}}
                                                    <!-- Error -->
                                                    @if ($errors->first('sustainability_title'))
                                                    <div class="error">
                                                        {{ $errors->first('sustainability_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="sustainability_sub_title">Sustainability Sub Title</label>
                                                    {{ Form::text('sustainability_sub_title',(old('sustainability_sub_title'))?old('sustainability_sub_title'):$formObj->sustainability_sub_title, ['class' => 'form-control', 'placeholder' => 'Conflict-free, Eco-friendly, Ethically Sourced Diamonds', 'id' => 'sustainability_sub_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('sustainability_sub_title'))
                                                    <div class="error">
                                                        {{ $errors->first('sustainability_sub_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="sustainability_content">Sustainability Content</label>
                                                    {!! Form::textarea('sustainability_content',(old('sustainability_content'))?old('sustainability_content'):$formObj->sustainability_content,['class'=>'form-control','id'=>'sustainability_content', 'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('sustainability_content'))
                                                    <div class="error">
                                                        {{ $errors->first('sustainability_content') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="sustainability_image">Sustainability Image</label>
                                                    <input type="file" name="sustainability_image" class="form-control" id="sustainability_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('sustainability_image'))
                                                    <div class="error">
                                                        {{ $errors->first('sustainability_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->sustainability_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->sustainability_image) }}" width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                             <!-- /.OUR STORY -->

                             <!-- WHY BONICA JEWELS -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">MINING-FREE PROCESS</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool"
                                                data-card-widget="collapse"><i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="mining_free_process_title">Mining Free Process Title</label>
                                                    {!! Form::textarea('mining_free_process_title',(old('mining_free_process_title'))?old('mining_free_process_title'):$formObj->mining_free_process_title,['class'=>'form-control','placeholder' => '','id'=>'mining_free_process_title', 'rows' => 2, 'cols' => 2]) !!}
                                                    {{-- {{ Form::text('mining_free_process_title',(old('mining_free_process_title'))?old('mining_free_process_title'):$formObj->mining_free_process_title, ['class' => 'form-control', 'placeholder' => 'MINING-FREE PROCESS', 'id' => 'mining_free_process_title']) }} --}}
                                                    <!-- Error -->
                                                    @if ($errors->first('mining_free_process_title'))
                                                    <div class="error">
                                                        {{ $errors->first('mining_free_process_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="mining_free_process_image">Mining Free Process Image</label>
                                                    <input type="file" name="mining_free_process_image" class="form-control" id="mining_free_process_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('mining_free_process_image'))
                                                    <div class="error">
                                                        {{ $errors->first('mining_free_process_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->mining_free_process_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->mining_free_process_image) }}" width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="mining_free_process_content">Mining Free Process Content</label>
                                                    {!! Form::textarea('mining_free_process_content',(old('mining_free_process_content'))?old('mining_free_process_content'):$formObj->mining_free_process_content,['class'=>'form-control','id'=>'mining_free_process_content', 'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('mining_free_process_content'))
                                                    <div class="error">
                                                        {{ $errors->first('mining_free_process_content') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                             <!-- /.WHY BONICA JEWELS -->

                              <!-- Our Comment -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">MINING - FREE</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool"
                                                data-card-widget="collapse"><i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="mining_free_title">MINING - FREE Title</label>
                                                    {!! Form::textarea('mining_free_title',(old('mining_free_title'))?old('mining_free_title'):$formObj->mining_free_title,['class'=>'form-control','placeholder' => '','id'=>'mining_free_title', 'rows' => 2, 'cols' => 2]) !!}
                                                    {{-- {{ Form::text('mining_free_title',(old('mining_free_title'))?old('mining_free_title'):$formObj->mining_free_title, ['class' => 'form-control', 'placeholder' => 'MINING - FREE', 'id' => 'mining_free_title']) }} --}}
                                                    <!-- Error -->
                                                    @if ($errors->first('mining_free_title'))
                                                    <div class="error">
                                                        {{ $errors->first('mining_free_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="mining_free_sub_title">MINING - FREE Sub Title</label>
                                                    {{ Form::text('mining_free_sub_title',(old('mining_free_sub_title'))?old('mining_free_sub_title'):$formObj->mining_free_sub_title, ['class' => 'form-control', 'placeholder' => '1 Carat of Every Bonica Diamond Saves the World From', 'id' => 'mining_free_sub_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('mining_free_sub_title'))
                                                    <div class="error">
                                                        {{ $errors->first('mining_free_sub_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="mining_free_image_1">Image 1</label>
                                                    <input type="file" name="mining_free_image_1" class="form-control" id="mining_free_image_1">
                                                    <!-- Error -->
                                                    @if ($errors->first('mining_free_image_1'))
                                                    <div class="error">
                                                        {{ $errors->first('mining_free_image_1') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->mining_free_image_1)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->mining_free_image_1) }}" width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="mining_free_image_2">Image 2</label>
                                                    <input type="file" name="mining_free_image_2" class="form-control" id="mining_free_image_2">
                                                    <!-- Error -->
                                                    @if ($errors->first('mining_free_image_2'))
                                                    <div class="error">
                                                        {{ $errors->first('mining_free_image_2') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->mining_free_image_2)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->mining_free_image_2) }}" width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="mining_free_image_3">Image 3</label>
                                                    <input type="file" name="mining_free_image_3" class="form-control" id="mining_free_image_3">
                                                    <!-- Error -->
                                                    @if ($errors->first('mining_free_image_3'))
                                                    <div class="error">
                                                        {{ $errors->first('mining_free_image_3') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->mining_free_image_3)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->mining_free_image_3) }}" width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                             <!-- /.Our Comment -->
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

    $('#mining_free_title').summernote({});
    $('#sustainability_title').summernote({});
    $('#mining_free_process_title').summernote({});
    $('#mining_free_process_content').summernote({
        height: 300,
        placeholder: 'content',
    });
    $('#sustainability_content').summernote({
        height: 300,
        placeholder: 'Description',

    });

</script>
@endpush

