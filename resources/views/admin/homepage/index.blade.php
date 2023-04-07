@extends('admin.layouts.layout')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $module }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                {{ Breadcrumbs::render("homepage".$page_title) }}
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
                    <div class="card-body">

                        {{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method,
                        'enctype' => 'multipart/form-data',
                        'class' => 'form-vertical', 'id' => 'frm-homepage')) }}
                        @if ($method === "POST")
                        <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                        @endif
                        <section class="content">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Banner</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="banner_type">Banner Type </label>
                                                {!! Form::select('banner_type', $sliderTypeData, $selectedSliderTypeID,
                                                ['class' => 'form-control', 'id' =>
                                                'banner_type']) !!}
                                                <!-- Error -->
                                                @if ($errors->has('banner_type'))
                                                <div class="error">
                                                    {{ $errors->first('banner_type') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @php $nameRequired=$statusRequired= 1; @endphp
                                        @include('admin.input.status')

                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="video">Banner Video</label>
                                                <input type="file" name="video" class="form-control" id="video">
                                                <!-- Error -->
                                                @if ($errors->first('video'))
                                                <div class="error">
                                                    {{ $errors->first('video') }}
                                                </div>
                                                @endif
                                                @if (Storage::disk('s3')->exists($formObj->video))
                                                <video width="100%" height="400" controls>
                                                    <source src="{{ $formObj->video_path }}">
                                                </video>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="video_title">Video Title</label>
                                                {!!
                                                Form::textarea('video_title',(old('video_title'))?old('video_title'):$formObj->video_title,['class'=>'form-control','placeholder'
                                                => '','id'=>'video_title', 'rows' => 2, 'cols' =>
                                                2]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('video_title'))
                                                <div class="error">
                                                    {{ $errors->first('video_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="video_content">Video Content</label>
                                                {!!
                                                Form::textarea('video_content',(old('video_content'))?old('video_content'):$formObj->video_content,['class'=>'form-control','id'=>'video_content',
                                                'rows' => 2, 'cols' => 40]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('video_content'))
                                                <div class="error">
                                                    {{ $errors->first('video_content') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="video_link">Video Button Link</label>
                                            {{
                                            Form::text('video_link',(old('video_link'))?old('video_link'):$formObj->video_link,
                                            ['class' => 'form-control', 'placeholder' => '',
                                            'id' => 'video_link']) }}
                                            <!-- Error -->
                                            @if ($errors->first('video_link'))
                                            <div class="error">
                                                {{ $errors->first('video_link') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <label for="banner_type">Banner Images </label>
                                    <div id="alert_msg"></div>
                                    @php $lastcount = 1; @endphp
                                    <div class="col-md-6 col-lg-12 mt-3" id="div_images">
                                        @if (count($banner_images) > 0)
                                        @foreach ($banner_images as $banner_image)
                                        @php
                                        $lastcount = $banner_image['id'];
                                        @endphp
                                        <div class="row mb-2 align-items-center" id="row-{{ $banner_image['id'] }}">
                                            <input type="hidden" name="action[{{ $banner_image['id'] }}]"
                                                value="update">
                                            <div class="col-sm-2">
                                                <div id="gallery-{{ $banner_image['id'] }}"
                                                    class="galler-img-box-wrap form-group col-sm-4">
                                                    <div class="g-img-thumbnail">
                                                        @if ($banner_image['image'])
                                                        <img src="{{ asset('uploads/homepage/'.$banner_image['image']) }}"
                                                            class="img-thumbnail" alt="">
                                                        @else
                                                        <img src="{{ asset('images/no_image.png') }}"
                                                            class="img-thumbnail" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" name="banner_images[{{$banner_image['id']}}]"
                                                    class="form-control" id="banner_images">
                                            </div>

                                            <div class="col-sm-1">
                                                <button type="button" onclick="deleteImage('{{ $banner_image['id'] }}')"
                                                    class="btn btn btn-danger remove-action btn-action"><i
                                                        class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="row mb-2 align-items-center" id="row-{{ $lastcount }}">
                                            <input type="hidden" name="action[{{ $lastcount }}]" value="add">
                                            <div class="col-sm-11">
                                                <input type="file" name="banner_images[{{ $lastcount }}]"
                                                    class="form-control" id="image">
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-primary addBanner"><span
                                                class="plus-icon"></span> Add Banner</a>
                                    </div>
                                    <input type="hidden" name="lastcount" id="lastcount" value="{{ $lastcount }}">



                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>

                        <!--Start Top Section -->
                        <section class="content">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Top Section</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="top_section_image1">Image 1</label>
                                                <input type="file" name="top_section_image1" class="form-control"
                                                    id="top_section_image1">
                                                <!-- Error -->
                                                @if ($errors->first('top_section_image1'))
                                                <div class="error">
                                                    {{ $errors->first('top_section_image1') }}
                                                </div>
                                                @endif
                                                @if($formObj->top_section_image1)
                                                <div class="imgPreview">
                                                    <img src="{{ URL::asset('uploads/homepage/'.$formObj->top_section_image1) }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="top_section_image2">Image 2</label>
                                                <input type="file" name="top_section_image2" class="form-control"
                                                    id="top_section_image2">
                                                <!-- Error -->
                                                @if ($errors->first('top_section_image2'))
                                                <div class="error">
                                                    {{ $errors->first('top_section_image2') }}
                                                </div>
                                                @endif
                                                @if($formObj->top_section_image2)
                                                <div class="imgPreview">
                                                    <img src="{{ URL::asset('uploads/homepage/'.$formObj->top_section_image2) }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="top_section_title">Title</label>
                                                {!!
                                                Form::textarea('top_section_title',(old('top_section_title'))?old('top_section_title'):$formObj->top_section_title,['class'=>'form-control','placeholder'
                                                => '','id'=>'top_section_title', 'rows' => 2, 'cols' =>
                                                2]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('top_section_title'))
                                                <div class="error">
                                                    {{ $errors->first('top_section_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="top_section_content">Content</label>
                                                {!!
                                                Form::textarea('top_section_content',(old('top_section_content'))?old('top_section_content'):$formObj->top_section_content,['class'=>'form-control','id'=>'top_section_content',
                                                'rows' => 2, 'cols' => 40]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('top_section_content'))
                                                <div class="error">
                                                    {{ $errors->first('top_section_content') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="top_section_link">Know More Link</label>
                                                {{
                                                Form::text('top_section_link',(old('top_section_link'))?old('top_section_link'):$formObj->top_section_link,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'top_section_link']) }}
                                                <!-- Error -->
                                                @if ($errors->first('top_section_link'))
                                                <div class="error">
                                                    {{ $errors->first('top_section_link') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <!--END Top Section -->
                        <!--Shringaar Section -->
                        <section class="content">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Shringaar Section</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">


                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="shringaar_title">Title</label>
                                                {!!
                                                Form::textarea('shringaar_title',(old('shringaar_title'))?old('shringaar_title'):$formObj->shringaar_title,['class'=>'form-control','placeholder'
                                                => '','id'=>'shringaar_title', 'rows' => 2, 'cols' =>
                                                2]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_title'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="shringaar_sub_title">Sub Title</label>
                                                {{
                                                Form::text('shringaar_sub_title',(old('shringaar_sub_title'))?old('shringaar_sub_title'):$formObj->shringaar_sub_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_sub_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_sub_title'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_sub_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image1">Image 1</label>
                                                <input type="file" name="shringaar_image1" class="form-control"
                                                    id="shringaar_image1">
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image1'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image1') }}
                                                </div>
                                                @endif
                                                @if($formObj->shringaar_image1)
                                                <div class="imgPreview">
                                                    <img src="{{ env('CLOUDFRONTURL').'homepage/'.$formObj->shringaar_image1 }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image1_title">Image1 Title</label>
                                                {{
                                                Form::text('shringaar_image1_title',(old('shringaar_image1_title'))?old('shringaar_image1_title'):$formObj->shringaar_image1_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image1_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image1_title'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image1_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image1_link">Link 1</label>
                                                {{
                                                Form::text('shringaar_image1_link',(old('shringaar_image1_link'))?old('shringaar_image1_link'):$formObj->shringaar_image1_link,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image1_link']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image1_link'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image1_link') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image2">Image 2</label>
                                                <input type="file" name="shringaar_image2" class="form-control"
                                                    id="shringaar_image2">
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image2'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image2') }}
                                                </div>
                                                @endif
                                                @if($formObj->shringaar_image2)
                                                <div class="imgPreview">
                                                    <img src="{{ env('CLOUDFRONTURL').'homepage/'.$formObj->shringaar_image2 }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image2_title">Image2 Title</label>
                                                {{
                                                Form::text('shringaar_image2_title',(old('shringaar_image2_title'))?old('shringaar_image2_title'):$formObj->shringaar_image2_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image2_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image2_title'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image2_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image2_link">Link 2</label>
                                                {{
                                                Form::text('shringaar_image2_link',(old('shringaar_image2_link'))?old('shringaar_image2_link'):$formObj->shringaar_image2_link,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image2_link']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image2_link'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image2_link') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image3">Image 3</label>
                                                <input type="file" name="shringaar_image3" class="form-control"
                                                    id="shringaar_image3">
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image3'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image3') }}
                                                </div>
                                                @endif
                                                @if($formObj->shringaar_image3)
                                                <div class="imgPreview">
                                                    <img src="{{ env('CLOUDFRONTURL').'homepage/'.$formObj->shringaar_image3 }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image3_title">Image3 Title</label>
                                                {{
                                                Form::text('shringaar_image3_title',(old('shringaar_image3_title'))?old('shringaar_image3_title'):$formObj->shringaar_image3_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image3_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image3_title'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image3_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image3_link">Link 3</label>
                                                {{
                                                Form::text('shringaar_image3_link',(old('shringaar_image3_link'))?old('shringaar_image3_link'):$formObj->shringaar_image3_link,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image3_link']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image3_link'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image3_link') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image4">Image 4</label>
                                                <input type="file" name="shringaar_image4" class="form-control"
                                                    id="shringaar_image4">
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image4'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image4') }}
                                                </div>
                                                @endif
                                                @if($formObj->shringaar_image4)
                                                <div class="imgPreview">
                                                    <img src="{{ env('CLOUDFRONTURL').'homepage/'.$formObj->shringaar_image4 }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image4_title">Image4 Title</label>
                                                {{
                                                Form::text('shringaar_image4_title',(old('shringaar_image4_title'))?old('shringaar_image4_title'):$formObj->shringaar_image4_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image4_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image4_title'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image4_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image4_link">Link 4</label>
                                                {{
                                                Form::text('shringaar_image4_link',(old('shringaar_image4_link'))?old('shringaar_image4_link'):$formObj->shringaar_image4_link,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image4_link']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image4_link'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image4_link') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image5">Image 5</label>
                                                <input type="file" name="shringaar_image5" class="form-control"
                                                    id="shringaar_image5">
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image5'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image5') }}
                                                </div>
                                                @endif
                                                @if($formObj->shringaar_image5)
                                                <div class="imgPreview">
                                                    <img src="{{ env('CLOUDFRONTURL').'homepage/'.$formObj->shringaar_image5 }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image5_title">Image5 Title</label>
                                                {{
                                                Form::text('shringaar_image5_title',(old('shringaar_image5_title'))?old('shringaar_image5_title'):$formObj->shringaar_image5_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image5_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image5_title'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image5_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image5_link">Link 5</label>
                                                {{
                                                Form::text('shringaar_image5_link',(old('shringaar_image5_link'))?old('shringaar_image5_link'):$formObj->shringaar_image5_link,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image5_link']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image5_link'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image5_link') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image6">Image 6</label>
                                                <input type="file" name="shringaar_image6" class="form-control"
                                                    id="shringaar_image6">
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image6'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image6') }}
                                                </div>
                                                @endif
                                                @if($formObj->shringaar_image6)
                                                <div class="imgPreview">
                                                    <img src="{{ env('CLOUDFRONTURL').'homepage/'.$formObj->shringaar_image6 }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image6_title">Image6 Title</label>
                                                {{
                                                Form::text('shringaar_image6_title',(old('shringaar_image6_title'))?old('shringaar_image6_title'):$formObj->shringaar_image6_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image6_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image6_title'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image6_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="shringaar_image6_link">Link 6</label>
                                                {{
                                                Form::text('shringaar_image6_link',(old('shringaar_image6_link'))?old('shringaar_image6_link'):$formObj->shringaar_image6_link,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'shringaar_image6_link']) }}
                                                <!-- Error -->
                                                @if ($errors->first('shringaar_image6_link'))
                                                <div class="error">
                                                    {{ $errors->first('shringaar_image6_link') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <!--END Shringaar Section -->

                        <!--Jewelry Catalog Section -->
                        <section class="content">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Jewelry Catalog Section</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="catalog_title">Title</label>
                                                {!!
                                                Form::textarea('catalog_title',(old('catalog_title'))?old('catalog_title'):$formObj->catalog_title,['class'=>'form-control','placeholder'
                                                => '','id'=>'catalog_title', 'rows' => 2, 'cols'
                                                =>
                                                2]) !!}


                                                <!-- Error -->
                                                @if ($errors->first('catalog_title'))
                                                <div class="error">
                                                    {{ $errors->first('catalog_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="catalog_sub_title">Sub Title</label>
                                                {{
                                                Form::text('catalog_sub_title',(old('catalog_sub_title'))?old('catalog_sub_title'):$formObj->catalog_sub_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'catalog_sub_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('catalog_sub_title'))
                                                <div class="error">
                                                    {{ $errors->first('catalog_sub_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="catalog_category_ids">category_ids</label>
                                                {{
                                                Form::text('catalog_category_ids',(old('catalog_category_ids'))?old('catalog_category_ids'):$formObj->catalog_category_ids,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'catalog_category_ids']) }}

                                                @if ($errors->first('catalog_category_ids'))
                                                <div class="error">
                                                    {{ $errors->first('catalog_category_ids') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div> -->

                                        <div class="col-12 col-sm-12 col-lg-6 select-inner-design-wrapper">
                                            <div class="form-group">
                                                <label for="catalog_category_ids">Parent Category <span class="error">*</span></label>

                                                {!! Form::select('catalog_category_ids[]',$categories,$selectedcategoryIDS, ['class' => 'form-control','id' => 'catalog_category_ids',
                                                'multiple' => 'multiple']) !!}
                                                <!-- Error -->
                                                @if ($errors->has('catalog_category_ids'))
                                                <div class="error">
                                                    {{ $errors->first('catalog_category_ids') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>


                                        <!-- <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="catalog_category_ids">Parent Category<span
                                                        class="error">*</span></label>

                                                {!! Form::select('catalog_category_ids[]',$categories,$selectedcategoryIDS, ['class' => 'form-control','id' => 'catalog_category_ids', 'multiple' =>
                                                'multiple']) !!}



                                                @if ($errors->has('catalog_category_ids'))
                                                <div class="error">
                                                    {{ $errors->first('catalog_category_ids') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div> -->

                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <!--END Jewelry Catalog Section -->

                        <!--BONICA JEWELS Section -->
                        <section class="content">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Bonica Jewels Section</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="bonica_jewels_title">Title</label>
                                                {!!
                                                Form::textarea('bonica_jewels_title',(old('bonica_jewels_title'))?old('bonica_jewels_title'):$formObj->bonica_jewels_title,['class'=>'form-control','placeholder'
                                                => '','id'=>'bonica_jewels_title', 'rows' => 2, 'cols'
                                                =>
                                                2]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_title'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="bonica_jewels_sub_title">Sub Title</label>
                                                {{
                                                Form::text('bonica_jewels_sub_title',(old('bonica_jewels_sub_title'))?old('bonica_jewels_sub_title'):$formObj->bonica_jewels_sub_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'bonica_jewels_sub_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_sub_title'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_sub_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon1">Icon 1</label>
                                                <input type="file" name="bonica_jewels_icon1" class="form-control"
                                                    id="bonica_jewels_icon1">
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon1'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon1') }}
                                                </div>
                                                @endif
                                                @if($formObj->bonica_jewels_icon1)
                                                <div class="imgPreview">
                                                    <img src="{{ URL::asset('uploads/homepage/'.$formObj->bonica_jewels_icon1) }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon1_title">Title</label>
                                                {{
                                                Form::text('bonica_jewels_icon1_title',(old('bonica_jewels_icon1_title'))?old('bonica_jewels_icon1_title'):$formObj->bonica_jewels_icon1_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'bonica_jewels_icon1_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon1_title'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon1_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-5">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon1_content">Content</label>
                                                {!!
                                                Form::textarea('bonica_jewels_icon1_content',(old('bonica_jewels_icon1_content'))?old('bonica_jewels_icon1_content'):$formObj->bonica_jewels_icon1_content,['class'=>'form-control','placeholder'
                                                => '','id'=>'bonica_jewels_icon1_content', 'rows'
                                                => 2, 'cols' => 40]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon1_content'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon1_content') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon2">Icon 2</label>
                                                <input type="file" name="bonica_jewels_icon2" class="form-control"
                                                    id="bonica_jewels_icon2">
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon2'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon2') }}
                                                </div>
                                                @endif
                                                @if($formObj->bonica_jewels_icon2)
                                                <div class="imgPreview">
                                                    <img src="{{ URL::asset('uploads/homepage/'.$formObj->bonica_jewels_icon2) }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon2_title">Title</label>
                                                {{
                                                Form::text('bonica_jewels_icon2_title',(old('bonica_jewels_icon2_title'))?old('bonica_jewels_icon2_title'):$formObj->bonica_jewels_icon2_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'bonica_jewels_icon2_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon2_title'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon2_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-5">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon2_content">Content</label>
                                                {!!
                                                Form::textarea('bonica_jewels_icon2_content',(old('bonica_jewels_icon2_content'))?old('bonica_jewels_icon2_content'):$formObj->bonica_jewels_icon2_content,['class'=>'form-control','placeholder'
                                                => '','id'=>'bonica_jewels_icon2_content', 'rows'
                                                => 2, 'cols' => 40]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon2_content'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon2_content') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon3">Icon 3</label>
                                                <input type="file" name="bonica_jewels_icon3" class="form-control"
                                                    id="bonica_jewels_icon3">
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon3'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon3') }}
                                                </div>
                                                @endif
                                                @if($formObj->bonica_jewels_icon3)
                                                <div class="imgPreview">
                                                    <img src="{{ URL::asset('uploads/homepage/'.$formObj->bonica_jewels_icon3) }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon3_title">Title</label>
                                                {{
                                                Form::text('bonica_jewels_icon3_title',(old('bonica_jewels_icon3_title'))?old('bonica_jewels_icon3_title'):$formObj->bonica_jewels_icon3_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'bonica_jewels_icon3_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon3_title'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon3_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-5">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon3_content">Content</label>
                                                {!!
                                                Form::textarea('bonica_jewels_icon3_content',(old('bonica_jewels_icon3_content'))?old('bonica_jewels_icon3_content'):$formObj->bonica_jewels_icon3_content,['class'=>'form-control','placeholder'
                                                => '','id'=>'bonica_jewels_icon3_content', 'rows'
                                                => 2, 'cols' => 40]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon3_content'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon3_content') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon4">Icon 4</label>
                                                <input type="file" name="bonica_jewels_icon4" class="form-control"
                                                    id="bonica_jewels_icon4">
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon4'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon4') }}
                                                </div>
                                                @endif
                                                @if($formObj->bonica_jewels_icon4)
                                                <div class="imgPreview">
                                                    <img src="{{ URL::asset('uploads/homepage/'.$formObj->bonica_jewels_icon4) }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon4_title">Title</label>
                                                {{
                                                Form::text('bonica_jewels_icon4_title',(old('bonica_jewels_icon4_title'))?old('bonica_jewels_icon4_title'):$formObj->bonica_jewels_icon4_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'bonica_jewels_icon4_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon4_title'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon4_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-5">
                                            <div class="form-group">
                                                <label for="bonica_jewels_icon4_content">Content</label>
                                                {!!
                                                Form::textarea('bonica_jewels_icon4_content',(old('bonica_jewels_icon4_content'))?old('bonica_jewels_icon4_content'):$formObj->bonica_jewels_icon4_content,['class'=>'form-control','placeholder'
                                                => '','id'=>'bonica_jewels_icon4_content', 'rows'
                                                => 2, 'cols' => 40]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('bonica_jewels_icon4_content'))
                                                <div class="error">
                                                    {{ $errors->first('bonica_jewels_icon4_content') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <!--END BONICA JEWELS Section -->

                        <!--ABOUT Section -->
                        <section class="content">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">ABOUT Section</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="recommended_title">Recommended Title</label>
                                                {!!
                                                Form::textarea('recommended_title',(old('recommended_title'))?old('recommended_title'):$formObj->recommended_title,['class'=>'form-control','placeholder'
                                                => '','id'=>'recommended_title', 'rows' => 2, 'cols'
                                                =>
                                                2]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('recommended_title'))
                                                <div class="error">
                                                    {{ $errors->first('recommended_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="recommended_sub_title">Recommended Sub Title</label>
                                                {{
                                                Form::text('recommended_sub_title',(old('recommended_sub_title'))?old('recommended_sub_title'):$formObj->recommended_sub_title,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'recommended_sub_title']) }}
                                                <!-- Error -->
                                                @if ($errors->first('recommended_sub_title'))
                                                <div class="error">
                                                    {{ $errors->first('recommended_sub_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="about_bonica_title">About Us Title</label>
                                                {!!
                                                Form::textarea('about_bonica_title',(old('about_bonica_title'))?old('about_bonica_title'):$formObj->about_bonica_title,['class'=>'form-control','placeholder'
                                                => '','id'=>'about_bonica_title', 'rows' => 2, 'cols' =>
                                                2]) !!}

                                                <!-- Error -->
                                                @if ($errors->first('about_bonica_title'))
                                                <div class="error">
                                                    {{ $errors->first('about_bonica_title') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="about_bonica_link">Button Link</label>
                                                {{
                                                Form::text('about_bonica_link',(old('about_bonica_link'))?old('about_bonica_link'):$formObj->about_bonica_link,
                                                ['class' => 'form-control', 'placeholder' => '',
                                                'id' => 'about_bonica_link']) }}
                                                <!-- Error -->
                                                @if ($errors->first('about_bonica_link'))
                                                <div class="error">
                                                    {{ $errors->first('about_bonica_link') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="about_bonica_content">About Us Content</label>
                                                {!!
                                                Form::textarea('about_bonica_content',(old('about_bonica_content'))?old('about_bonica_content'):$formObj->about_bonica_content,['class'=>'form-control','placeholder'
                                                => '','id'=>'about_bonica_content', 'rows'
                                                => 2, 'cols' => 40]) !!}
                                                <!-- Error -->
                                                @if ($errors->first('about_bonica_content'))
                                                <div class="error">
                                                    {{ $errors->first('about_bonica_content') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="about_bonica_bg_image">BG Image</label>
                                                <input type="file" name="about_bonica_bg_image" class="form-control"
                                                    id="about_bonica_bg_image">
                                                <!-- Error -->
                                                @if ($errors->first('about_bonica_bg_image'))
                                                <div class="error">
                                                    {{ $errors->first('about_bonica_bg_image') }}
                                                </div>
                                                @endif
                                                @if($formObj->about_bonica_bg_image)
                                                <div class="imgPreview">
                                                    <img src="{{ URL::asset('uploads/homepage/'.$formObj->about_bonica_bg_image) }}"
                                                        width="300px" class="img-thumbnail" alt="Image">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <!--END ABOUT Section -->

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                {{ Form::text('meta_title',(old('meta_title'))?old('meta_title'):$formObj->meta_title,
                                ['class' =>
                                'form-control', 'placeholder' => 'Meta Title', 'id' => 'meta_title']) }}
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
                                {{
                                Form::text('meta_keywords',(old('meta_keywords'))?old('meta_keywords'):$formObj->meta_keywords,
                                ['class' =>
                                'form-control', 'placeholder' => 'Meta Keywords', 'id' => 'meta_keywords']) }}
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
                                {!!
                                Form::textarea('meta_description',(old('meta_description'))?old('meta_description'):$formObj->meta_description,['class'=>'form-control','id'=>'meta_description',
                                'rows' => 2, 'cols' => 40]) !!}

                                <!-- Error -->
                                @if ($errors->first('meta_description'))
                                <div class="error">
                                    {{ $errors->first('meta_description') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" onClick='frmSubmit()' class="btn btn-info">{{
                            __('messages.save_button') }}</button>
                        <a href="{{ route('admin.dashboard.index') }}" class="btn btn-danger icon-btn">Cancel</a>
                    </div>
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
<script src="https:/cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function ()
    {
        $('#catalog_category_ids').select2({
            closeOnSelect: false,
            placeholder: "Select Category",
            allowHtml: true,
            allowClear: true,
            tags: true
        });
        $(".addBanner").click(function ()
        {
            var last_count = $('#lastcount').val();
            var riw_id = parseInt(last_count) + 1;
            var image_html = `<div class="row mb-2  align-items-center" id="row-${riw_id}">
                        <input type="hidden" name="action[${riw_id}]" value="add">
                        <div class="col-sm-11">
                            <input type="file" name="banner_images[${riw_id}]" class="form-control" id="banner_images">
                        </div>

                        <div class="col-sm-1">
                            <button id="${riw_id}" class="btn btn-danger btn-sm remove-action  btn-action btndelete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>`;
            $('#div_images').append(image_html);
            $('#lastcount').val(riw_id);
        });
        $(document).on('click', '.btndelete', function ()
        {
            var button_id = $(this).attr("id");
            $('#row-' + button_id + '').remove();
        });

    });

    $('#catalog_title').summernote({});
    $('#top_section_title').summernote({});
    $('#video_title').summernote({});

    $('#about_bonica_title').summernote({});



    $('#shringaar_title').summernote({});
    $('#bonica_jewels_title').summernote({});
    $('#recommended_title').summernote({});

    $('#top_section_content').summernote({
        height: 300,
        placeholder: 'content',
    });
    $('#video_content').summernote({
        height: 200,
        placeholder: 'content',
    });

    $('#about_bonica_content').summernote({
        height: 300,
        placeholder: 'content',
    });


    function deleteImage(id)
    {

        swal({
            title: "Are you sure you want delete?",
            text: "",
            type: "error",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Delete!',
        }, function ()
        {
            var msg_HTML = "";
            $.ajax({
                type: "POST",
                url: "{!! route('admin.deletebannerimage') !!}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                beforeSend: function ()
                {
                    $('#row-' + id).html('<img src="{{asset('images / spinner1.gif')}}" alt="spinner"/>');
                },
                dataType: 'JSON',
                success: function (data)
                {
                    if (data.msg == 'delete')
                    {
                        $('#row-' + id).hide();
                        msg_HTML = `<div class="col-xs-12 flashmessages">
                                        <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>${data.message}</strong>
                                            </div>
                                        </div>`;
                        $('#alert_msg').html(msg_HTML);
                    }
                }
            });
        });
    }




    function frmSubmit()
    {
        $("#frm-homepage").submit();
    }


    /* $('#catalog_category_ids').select2({

        placeholder: "Search Category",
        minimumInputLength: 1,
        maximumSelectionLength: 4,
        multiple: true,
        ajax: {
            url: '{{ route("admin.search-category") }}',
            dataType: 'json',
            data: function (params)
            {
                return {
                    searchTerm: $.trim(params.term),
                };
            },
            processResults: function (data)
            {
                return {
                    results: data
                };
            },
            cache: true
        }
    }); */



    Dropzone.options.dropzone =
    {
        maxFilesize: 12,
        /* renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time+file.name;
        }, */
        /* renameFile: function (file) {
            let newName = new Date().getTime() + '_' + file.name;
            return newName;
        }, */
        /* renameFile: function (file) {
            return file.renameFile ="YourNewfileName." + file.split('.').pop();
        } */
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        removedfile: function (file)
        {
            var name = file.name;
            //console.log(name);
            $.ajax({

                type: 'POST',
                url: '{!! route("admin.homepageslider.dropzone.delete") !!}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "filename": name
                },
                success: function (data)
                {
                    console.log("File has been successfully removed!!");
                },
                error: function (e)
                {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function (file, response)
        {
            //file.name = response.success;
            //console.log(file.name);
            console.log(response);
        },
        error: function (file, response)
        {
            return false;
        }
    };
    function deleteGallery(id, image)
    {
        swal({
            title: "Are you sure you want delete?",
            text: "",
            type: "error",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Delete!',
        }, function ()
        {
            var msg_HTML = "";
            $.ajax({
                type: "POST",
                url: '{!! route("admin.homepageslider.dropzone.delete") !!}',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    filename: image,
                },
                dataType: 'JSON',
                success: function (data)
                {
                    if (data.msg == 'delete')
                    {
                        $('#gallery-' + id).hide();
                    }
                }
            });
        });
    }

</script>

@endpush
