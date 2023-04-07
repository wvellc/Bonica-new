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
<div class="main-prodcut-box-wrapper" id="prodcut-box"></div>
<section class="content">
    <div class="container-fluid">
        @include('admin.layouts.alert_message')
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-info">
                    {{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method, 'enctype' =>
                    'multipart/form-data', 'class' => 'form-vertical', 'id' => 'frmourstory')) }}
                    @if ($method === "PUT")
                    <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                    @endif
                    <input type="hidden" id="page" name="page" value="our-story">
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
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->banner_image) }}"
                                            width="300px" class="img-thumbnail" alt="Banner Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="content">Content <span class="error">*</span></label>
                                    {!!
                                    Form::textarea('content',(old('content'))?old('content'):$formObj->content,['class'=>'form-control','id'=>'content',
                                    'rows' => 2, 'cols' => 40]) !!}
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
                                        <h3 class="card-title">OUR STORY</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="our_vision_image">Our Vision Image</label>
                                                    <input type="file" name="our_vision_image" class="form-control"
                                                        id="our_vision_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('our_vision_image'))
                                                    <div class="error">
                                                        {{ $errors->first('our_vision_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->our_vision_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->our_vision_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="our_vision_content">Our Vision Content</label>
                                                    {!!
                                                    Form::textarea('our_vision_content',(old('our_vision_content'))?old('our_vision_content'):$formObj->our_vision_content,['class'=>'form-control','id'=>'our_vision_content',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('our_vision_content'))
                                                    <div class="error">
                                                        {{ $errors->first('our_vision_content') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="our_mission_image">Our Mission Image</label>
                                                    <input type="file" name="our_mission_image" class="form-control"
                                                        id="our_mission_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('our_mission_image'))
                                                    <div class="error">
                                                        {{ $errors->first('our_mission_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->our_mission_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->our_mission_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="our_mission_content">Our Mission Content</label>
                                                    {!!
                                                    Form::textarea('our_mission_content',(old('our_mission_content'))?old('our_mission_content'):$formObj->our_mission_content,['class'=>'form-control','id'=>'our_mission_content',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('our_mission_content'))
                                                    <div class="error">
                                                        {{ $errors->first('our_mission_content') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="big_diamond_image">Upload Diamond Video</label>
                                                    <input type="file" name="big_diamond_image" class="form-control"
                                                        id="big_diamond_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('big_diamond_image'))
                                                    <div class="error">
                                                        {{ $errors->first('big_diamond_image') }}
                                                    </div>
                                                    @endif

                                                    @if($formObj->big_diamond_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ $formObj->big_diamond_image }}"
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
                            </div>
                            <!-- /.OUR STORY -->

                            <!-- WHY BONICA JEWELS -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">WHY BONICA JEWELS</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_title">Title</label>
                                                    {!!
                                                    Form::textarea('why_bonica_title',(old('why_bonica_title'))?old('why_bonica_title'):$formObj->why_bonica_title,['class'=>'form-control','placeholder'
                                                    => 'Authentic Content','id'=>'why_bonica_title', 'rows' => 2, 'cols'
                                                    => 2]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_title'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_sub_title">Sub Title</label>
                                                    {!!
                                                    Form::textarea('why_bonica_sub_title',(old('why_bonica_sub_title'))?old('why_bonica_sub_title'):$formObj->why_bonica_sub_title,['class'=>'form-control','placeholder'
                                                    => 'Authentic Content','id'=>'why_bonica_sub_title', 'rows' => 2,
                                                    'cols' => 2]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_sub_title'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_sub_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="why_bonica_image">Why Bonica Image</label>
                                                    <input type="file" name="why_bonica_image" class="form-control"
                                                        id="why_bonica_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_image'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->why_bonica_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->why_bonica_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_authentic_title">Authentic Title</label>
                                                    {{
                                                    Form::text('why_bonica_authentic_title',(old('why_bonica_authentic_title'))?old('why_bonica_authentic_title'):$formObj->why_bonica_authentic_title,
                                                    ['class' => 'form-control', 'placeholder' => 'AUTHENTIC,
                                                    GUARANTEED', 'id' => 'why_bonica_authentic_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_authentic_title'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_authentic_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_authentic_description">Authentic
                                                        Content</label>
                                                    {!!
                                                    Form::textarea('why_bonica_authentic_description',(old('why_bonica_authentic_description'))?old('why_bonica_authentic_description'):$formObj->why_bonica_authentic_description,['class'=>'form-control','placeholder'
                                                    => 'Authentic Content','id'=>'why_bonica_authentic_description',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_authentic_description'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_authentic_description') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_economical_title">Economical Title</label>
                                                    {{
                                                    Form::text('why_bonica_economical_title',(old('why_bonica_economical_title'))?old('why_bonica_economical_title'):$formObj->why_bonica_economical_title,
                                                    ['class' => 'form-control', 'placeholder' => 'ECONOMICAL,EH?', 'id'
                                                    => 'why_bonica_economical_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_economical_title'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_economical_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_economical_description">Economical
                                                        Content</label>
                                                    {!!
                                                    Form::textarea('why_bonica_economical_description',(old('why_bonica_economical_description'))?old('why_bonica_economical_description'):$formObj->why_bonica_economical_description,['class'=>'form-control','placeholder'
                                                    => 'Economical Content','id'=>'why_bonica_economical_description',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_economical_description'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_economical_description') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_protector_title">Protector Title</label>
                                                    {{
                                                    Form::text('why_bonica_protector_title',(old('why_bonica_protector_title'))?old('why_bonica_protector_title'):$formObj->why_bonica_protector_title,
                                                    ['class' => 'form-control', 'placeholder' => 'THE PROTECTORS', 'id'
                                                    => 'why_bonica_protector_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_protector_title'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_protector_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_protector_description">Protector
                                                        Content</label>
                                                    {!!
                                                    Form::textarea('why_bonica_protector_description',(old('why_bonica_protector_description'))?old('why_bonica_protector_description'):$formObj->why_bonica_protector_description,['class'=>'form-control','placeholder'
                                                    => 'Protector Content','id'=>'why_bonica_protector_description',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_protector_description'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_protector_description') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_maestros_title">Maestros Title</label>
                                                    {{
                                                    Form::text('why_bonica_maestros_title',(old('why_bonica_maestros_title'))?old('why_bonica_maestros_title'):$formObj->why_bonica_maestros_title,
                                                    ['class' => 'form-control', 'placeholder' => 'THE MAESTROS', 'id' =>
                                                    'why_bonica_maestros_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_maestros_title'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_maestros_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="why_bonica_maestros_description">Maestros
                                                        Content</label>
                                                    {!!
                                                    Form::textarea('why_bonica_maestros_description',(old('why_bonica_maestros_description'))?old('why_bonica_maestros_description'):$formObj->why_bonica_maestros_description,['class'=>'form-control','placeholder'
                                                    => 'Maestros Content','id'=>'why_bonica_maestros_description',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('why_bonica_maestros_description'))
                                                    <div class="error">
                                                        {{ $errors->first('why_bonica_maestros_description') }}
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
                                        <h3 class="card-title">OUR COMMITMENT</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="our_commitment_title">Title</label>
                                                    {!!
                                                    Form::textarea('our_commitment_title',(old('our_commitment_title'))?old('our_commitment_title'):$formObj->our_commitment_title,['class'=>'form-control','placeholder'
                                                    => 'OUR COMMITMENT','id'=>'our_commitment_title', 'rows' => 2,
                                                    'cols' => 2]) !!}
                                                    {{-- {{
                                                    Form::text('our_commitment_title',(old('our_commitment_title'))?old('our_commitment_title'):$formObj->our_commitment_title,
                                                    ['class' => 'form-control', 'placeholder' => 'OUR COMMITMENT', 'id'
                                                    => 'our_commitment_title']) }} --}}
                                                    <!-- Error -->
                                                    @if ($errors->first('our_commitment_title'))
                                                    <div class="error">
                                                        {{ $errors->first('our_commitment_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="our_commitment_first_icon">First Icon</label>
                                                    <input type="file" name="our_commitment_first_icon"
                                                        class="form-control" id="our_commitment_first_icon">
                                                    <!-- Error -->
                                                    @if ($errors->first('our_commitment_first_icon'))
                                                    <div class="error">
                                                        {{ $errors->first('our_commitment_first_icon') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->our_commitment_first_icon)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->our_commitment_first_icon) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="our_commitment_first_icon">First Content</label>
                                                <div class="form-group">
                                                    {!!
                                                    Form::textarea('our_commitment_first_description',(old('our_commitment_first_description'))?old('our_commitment_first_description'):$formObj->our_commitment_first_description,['class'=>'form-control','placeholder'
                                                    => '','id'=>'our_commitment_first_description', 'rows' => 2, 'cols'
                                                    => 2]) !!}
                                                    {{-- {{
                                                    Form::text('our_commitment_first_description',(old('our_commitment_first_description'))?old('our_commitment_first_description'):$formObj->our_commitment_first_description,
                                                    ['class' => 'form-control', 'placeholder' => 'Content', 'id' =>
                                                    'our_commitment_first_description']) }} --}}
                                                    <!-- Error -->
                                                    @if ($errors->first('our_commitment_first_description'))
                                                    <div class="error">
                                                        {{ $errors->first('our_commitment_first_description') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="our_commitment_second_icon">Second Icon</label>
                                                    <input type="file" name="our_commitment_second_icon"
                                                        class="form-control" id="our_commitment_second_icon">
                                                    <!-- Error -->
                                                    @if ($errors->first('our_commitment_second_icon'))
                                                    <div class="error">
                                                        {{ $errors->first('our_commitment_second_icon') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->our_commitment_second_icon)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->our_commitment_second_icon) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="our_commitment_second_description">Second Content</label>
                                                <div class="form-group">
                                                    {!!
                                                    Form::textarea('our_commitment_second_description',(old('our_commitment_second_description'))?old('our_commitment_second_description'):$formObj->our_commitment_second_description,['class'=>'form-control','placeholder'
                                                    => '','id'=>'our_commitment_second_description', 'rows' => 2, 'cols'
                                                    => 2]) !!}
                                                    {{-- {{
                                                    Form::text('our_commitment_second_description',(old('our_commitment_second_description'))?old('our_commitment_second_description'):$formObj->our_commitment_second_description,
                                                    ['class' => 'form-control', 'placeholder' => 'Content', 'id' =>
                                                    'our_commitment_second_description']) }} --}}
                                                    <!-- Error -->
                                                    @if ($errors->first('our_commitment_second_description'))
                                                    <div class="error">
                                                        {{ $errors->first('our_commitment_second_description') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="our_commitment_third_icon">Third Icon</label>
                                                    <input type="file" name="our_commitment_third_icon"
                                                        class="form-control" id="our_commitment_third_icon">
                                                    <!-- Error -->
                                                    @if ($errors->first('our_commitment_third_icon'))
                                                    <div class="error">
                                                        {{ $errors->first('our_commitment_third_icon') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->our_commitment_third_icon)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->our_commitment_third_icon) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="our_commitment_third_description">Third Content</label>
                                                <div class="form-group">
                                                    {!!
                                                    Form::textarea('our_commitment_third_description',(old('our_commitment_third_description'))?old('our_commitment_third_description'):$formObj->our_commitment_third_description,['class'=>'form-control','placeholder'
                                                    => '','id'=>'our_commitment_third_description', 'rows' => 2, 'cols'
                                                    => 2]) !!}
                                                    {{-- {{
                                                    Form::text('our_commitment_third_description',(old('our_commitment_third_description'))?old('our_commitment_third_description'):$formObj->our_commitment_third_description,
                                                    ['class' => 'form-control', 'placeholder' => 'Content', 'id' =>
                                                    'our_commitment_third_description']) }} --}}
                                                    <!-- Error -->
                                                    @if ($errors->first('our_commitment_third_description'))
                                                    <div class="error">
                                                        {{ $errors->first('our_commitment_third_description') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-12">
                                                <label for="making_bonica_title">The Making Of Bonica Title</label>
                                                <div class="form-group">
                                                    {!!
                                                    Form::textarea('making_bonica_title',(old('making_bonica_title'))?old('making_bonica_title'):$formObj->making_bonica_title,['class'=>'form-control','placeholder'
                                                    => '','id'=>'making_bonica_title', 'rows' => 2, 'cols' => 2]) !!}
                                                    {{-- {{
                                                    Form::text('making_bonica_title',(old('making_bonica_title'))?old('making_bonica_title'):$formObj->making_bonica_title,
                                                    ['class' => 'form-control', 'placeholder' => 'THE MAKING OF BONICA
                                                    DIAMONDS', 'id' => 'making_bonica_title']) }} --}}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_title'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <label for="making_bonica_sub_title">The Making Of Bonica Sub
                                                    Title</label>
                                                <div class="form-group">
                                                    {{
                                                    Form::text('making_bonica_sub_title',(old('making_bonica_sub_title'))?old('making_bonica_sub_title'):$formObj->making_bonica_sub_title,
                                                    ['class' => 'form-control', 'placeholder' => 'Giving Rise and Shine
                                                    a New Meaning', 'id' => 'making_bonica_sub_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_sub_title'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_sub_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="making_bonica_diamond_seed_icon">The Diamond Seed
                                                        Icon</label>
                                                    <input type="file" name="making_bonica_diamond_seed_icon"
                                                        class="form-control" id="making_bonica_diamond_seed_icon">
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_diamond_seed_icon'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_diamond_seed_icon') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->making_bonica_diamond_seed_icon)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->making_bonica_diamond_seed_icon) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="making_bonica_diamond_seed_title">The Diamond Seed</label>
                                                <div class="form-group">
                                                    {{
                                                    Form::text('making_bonica_diamond_seed_title',(old('making_bonica_diamond_seed_title'))?old('making_bonica_diamond_seed_title'):$formObj->making_bonica_diamond_seed_title,
                                                    ['class' => 'form-control', 'placeholder' => 'The Diamond Seed',
                                                    'id' => 'making_bonica_diamond_seed_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_diamond_seed_title'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_diamond_seed_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group">
                                                    <label for="making_bonica_diamond_seed_description">The Diamond Seed
                                                        Content</label>
                                                    {!! Form::textarea('making_bonica_diamond_seed_description',
                                                    old('making_bonica_diamond_seed_description') ?
                                                    old('making_bonica_diamond_seed_description') :
                                                    $formObj->making_bonica_diamond_seed_description, [
                                                    'class' => 'form-control',
                                                    'id' => 'making_bonica_diamond_seed_description',
                                                    'rows' => 2,
                                                    'cols' => 40,
                                                    ]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_diamond_seed_description'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_diamond_seed_description') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="making_bonica_heating_icon">Heating and Ionization
                                                        Icon</label>
                                                    <input type="file" name="making_bonica_heating_icon"
                                                        class="form-control" id="making_bonica_heating_icon">
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_heating_icon'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_heating_icon') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->making_bonica_heating_icon)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->making_bonica_heating_icon) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="making_bonica_heating_title">Heating and Ionization</label>
                                                <div class="form-group">
                                                    {{
                                                    Form::text('making_bonica_heating_title',(old('making_bonica_heating_title'))?old('making_bonica_heating_title'):$formObj->making_bonica_heating_title,
                                                    ['class' => 'form-control', 'placeholder' => 'Heating and
                                                    Ionization', 'id' => 'making_bonica_heating_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_heating_title'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_heating_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group">
                                                    <label for="making_bonica_heating_description">Heating and
                                                        Ionization Content</label>
                                                    {!! Form::textarea('making_bonica_heating_description',
                                                    old('making_bonica_heating_description') ?
                                                    old('making_bonica_heating_description') :
                                                    $formObj->making_bonica_heating_description, [
                                                    'class' => 'form-control',
                                                    'id' => 'making_bonica_heating_description',
                                                    'rows' => 2,
                                                    'cols' => 40,
                                                    ]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_heating_description'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_heating_description') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="making_bonica_plasma_icon">The Plasma and Carbon
                                                        Icon</label>
                                                    <input type="file" name="making_bonica_plasma_icon"
                                                        class="form-control" id="making_bonica_plasma_icon">
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_plasma_icon'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_plasma_icon') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->making_bonica_plasma_icon)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->making_bonica_plasma_icon) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="making_bonica_plasma_title">The Plasma and Carbon</label>
                                                <div class="form-group">
                                                    {{
                                                    Form::text('making_bonica_plasma_title',(old('making_bonica_plasma_title'))?old('making_bonica_plasma_title'):$formObj->making_bonica_plasma_title,
                                                    ['class' => 'form-control', 'placeholder' => 'The Plasma and
                                                    Carbon', 'id' => 'making_bonica_plasma_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_plasma_title'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_plasma_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group">
                                                    <label for="making_bonica_plasma_description">The Plasma and Carbon
                                                        Content</label>
                                                    {!! Form::textarea('making_bonica_plasma_description',
                                                    old('making_bonica_plasma_description') ?
                                                    old('making_bonica_plasma_description') :
                                                    $formObj->making_bonica_plasma_description, [
                                                    'class' => 'form-control',
                                                    'id' => 'making_bonica_plasma_description',
                                                    'rows' => 2,
                                                    'cols' => 40,
                                                    ]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_plasma_description'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_plasma_description') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="making_bonica_all_diamonds_icon">Type IIA Diamonds
                                                        Icon</label>
                                                    <input type="file" name="making_bonica_all_diamonds_icon"
                                                        class="form-control" id="making_bonica_all_diamonds_icon">
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_all_diamonds_icon'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_all_diamonds_icon') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->making_bonica_all_diamonds_icon)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->making_bonica_all_diamonds_icon) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="making_bonica_all_diamonds_title">Type IIA Diamonds</label>
                                                <div class="form-group">
                                                    {{
                                                    Form::text('making_bonica_all_diamonds_title',(old('making_bonica_all_diamonds_title'))?old('making_bonica_all_diamonds_title'):$formObj->making_bonica_all_diamonds_title,
                                                    ['class' => 'form-control', 'placeholder' => 'Type IIA Diamonds',
                                                    'id' => 'making_bonica_all_diamonds_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_all_diamonds_title'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_all_diamonds_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group">
                                                    <label for="making_bonica_all_diamonds_description">Type IIA
                                                        Diamonds Content</label>
                                                    {!! Form::textarea('making_bonica_all_diamonds_description',
                                                    old('making_bonica_all_diamonds_description') ?
                                                    old('making_bonica_all_diamonds_description') :
                                                    $formObj->making_bonica_all_diamonds_description, [
                                                    'class' => 'form-control',
                                                    'id' => 'making_bonica_all_diamonds_description',
                                                    'rows' => 2,
                                                    'cols' => 40,
                                                    ]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('making_bonica_all_diamonds_description'))
                                                    <div class="error">
                                                        {{ $errors->first('making_bonica_all_diamonds_description') }}
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
                                    {{
                                    Form::text('meta_title',(old('meta_title'))?old('meta_title'):$formObj->meta_title,
                                    ['class' => 'form-control', 'placeholder' => 'Meta Title', 'id' => 'meta_title']) }}
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
                                    ['class' => 'form-control', 'placeholder' => 'Meta Keywords', 'id' =>
                                    'meta_keywords']) }}
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
    $("#frmourstory").on("submit", function ()
    {
        $("#prodcut-box").html('<div class="product-loader-admin"><img src="{{asset('images/spinner2.gif')}}" alt="spinner"/></div>');
    });
    $('#why_bonica_title').summernote({});

    $('#making_bonica_title').summernote({});
    $('#our_commitment_first_description').summernote({});
    $('#our_commitment_second_description').summernote({});
    $('#our_commitment_third_description').summernote({});


    $('#our_commitment_title').summernote({});
    $('#why_bonica_sub_title').summernote({});

    $('#our_vision_content').summernote({
        height: 300,
        placeholder: 'content',
    });
    $('#our_mission_content').summernote({
        height: 300,
        placeholder: 'content',
    });

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
