@extends('admin.layouts.layout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
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
                    {{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method, 'enctype' =>
                    'multipart/form-data', 'class' => 'form-vertical')) }}
                    @if ($method === "PUT")
                    <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                    @endif
                    <input type="hidden" id="page" name="page" value="size-guide">
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
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="page_title">Page Title</label>
                                    {!!
                                    Form::textarea('page_title',(old('page_title'))?old('page_title'):$formObj->page_title,['class'=>'form-control','placeholder'
                                    => '','id'=>'page_title', 'rows' => 1, 'cols' => 1]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('page_title'))
                                    <div class="error">
                                        {{ $errors->first('page_title') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Rings -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Rings</h3>
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

                                            <div class="col-md-6 col-lg-12">
                                                <div class="form-group">
                                                    <label for="rings_title">Title</label>
                                                    {{
                                                    Form::text('rings_title',(old('rings_title'))?old('rings_title'):$formObj->rings_title,
                                                    ['class' => 'form-control', 'placeholder' => '', 'id' =>
                                                    'rings_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('rings_title'))
                                                    <div class="error">
                                                        {{ $errors->first('rings_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-12">
                                                <div class="form-group">
                                                    <label for="rings_content1">Content1</label>
                                                    {!!
                                                    Form::textarea('rings_content1',(old('rings_content1'))?old('rings_content1'):$formObj->rings_content1,['class'=>'form-control','id'=>'rings_content1',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('rings_content1'))
                                                    <div class="error">
                                                        {{ $errors->first('rings_content1') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label for="measurement_image">Measurement Image</label>
                                                    <input type="file" name="measurement_image" class="form-control"
                                                        id="measurement_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('measurement_image'))
                                                    <div class="error">
                                                        {{ $errors->first('measurement_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->measurement_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->measurement_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label for="diamond_skeleton_image">Diamond Skeleton Image</label>
                                                    <input type="file" name="diamond_skeleton_image"
                                                        class="form-control" id="diamond_skeleton_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('diamond_skeleton_image'))
                                                    <div class="error">
                                                        {{ $errors->first('diamond_skeleton_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->diamond_skeleton_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->diamond_skeleton_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label for="step1_image">Step1 Image</label>
                                                    <input type="file" name="step1_image" class="form-control"
                                                        id="step1_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('step1_image'))
                                                    <div class="error">
                                                        {{ $errors->first('step1_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->step1_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->step1_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label for="step2_image">Step2 Image</label>
                                                    <input type="file" name="step2_image" class="form-control"
                                                        id="step2_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('step2_image'))
                                                    <div class="error">
                                                        {{ $errors->first('step2_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->step2_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->step2_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-12">
                                                <div class="form-group">
                                                    <label for="rings_content2">Content2</label>
                                                    {!!
                                                    Form::textarea('rings_content2',(old('rings_content2'))?old('rings_content2'):$formObj->rings_content2,['class'=>'form-control','id'=>'rings_content2',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('rings_content2'))
                                                    <div class="error">
                                                        {{ $errors->first('rings_content2') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div id="alert_msg_rings"></div>
                                            @php $ringlastcount = 1; @endphp
                                            <div class="col-md-6 col-lg-12 mt-3" id="div_ring_images">
                                                @if (count($rings) > 0)
                                                @foreach ($rings as $ring)
                                                @php
                                                $ringlastcount = $ring['id'];
                                                @endphp
                                                <div class="row mb-2 align-items-center" id="row-{{ $ring['id'] }}">
                                                    <input type="hidden" name="action[{{ $ring['id'] }}]"
                                                        value="update">
                                                    <div class="col-sm-2">

                                                        <div id="gallery-{{ $ring['id'] }}"
                                                            class="galler-img-box-wrap form-group col-sm-4">
                                                            <div class="g-img-thumbnail">
                                                                @if ($ring['image'])
                                                                <img src="{{ asset('uploads/cmspage/'.$ring['image']) }}"
                                                                    class="img-thumbnail" alt="">
                                                                @else
                                                                <img src="{{ asset('images/no_image.png') }}"
                                                                    class="img-thumbnail" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="file" name="rings[{{$ring['id']}}]"
                                                            class="form-control" id="image">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="select-box">
                                                            {!!
                                                            Form::text('product_url['.$ring['id'].']',$ring['product_url'],
                                                            [
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Product URL',
                                                            'id' => 'product_url'])
                                                            !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button"
                                                            onclick="deleteImage('{{ $ring['id'] }}','rings')"
                                                            class="btn btn btn-danger remove-action btn-action"><i
                                                                class="fas fa-trash"></i></button>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="row mb-2 align-items-center" id="row-{{ $ringlastcount }}">
                                                    <input type="hidden" name="action[{{ $ringlastcount }}]"
                                                        value="add">
                                                    <div class="col-sm-5">
                                                        <input type="file" name="rings[{{ $ringlastcount }}]"
                                                            class="form-control" id="image">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="select-box">
                                                            {!! Form::text('product_url['.$ringlastcount.']','', [
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Product URL',
                                                            'id' => 'product_url'])
                                                            !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="text-center">
                                                <a href="javascript:void(0)" class="btn btn-primary addRings"><span
                                                        class="plus-icon"></span> Add Image</a>
                                            </div>
                                            <input type="hidden" name="ringlastcount" id="ringlastcount"
                                                value="{{ $ringlastcount }}">

                                            {{--END Rings --}}
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
                                        <h3 class="card-title">Bracelets</h3>
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

                                            <div class="col-md-6 col-lg-12">
                                                <div class="form-group">
                                                    <label for="bracelets_title">Title</label>
                                                    {{
                                                    Form::text('bracelets_title',(old('bracelets_title'))?old('bracelets_title'):$formObj->bracelets_title,
                                                    ['class' => 'form-control', 'placeholder' => '', 'id' =>
                                                    'bracelets_title']) }}
                                                    <!-- Error -->
                                                    @if ($errors->first('bracelets_title'))
                                                    <div class="error">
                                                        {{ $errors->first('bracelets_title') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-12">
                                                <div class="form-group">
                                                    <label for="bracelets_content1">Content1</label>
                                                    {!!
                                                    Form::textarea('bracelets_content1',(old('bracelets_content1'))?old('bracelets_content1'):$formObj->bracelets_content1,['class'=>'form-control','id'=>'bracelets_content1',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('bracelets_content1'))
                                                    <div class="error">
                                                        {{ $errors->first('bracelets_content1') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="diameter_skeleton_image">Diameter Skeleton Image</label>
                                                    <input type="file" name="diameter_skeleton_image"
                                                        class="form-control" id="diameter_skeleton_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('diameter_skeleton_image'))
                                                    <div class="error">
                                                        {{ $errors->first('diameter_skeleton_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->diameter_skeleton_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->diameter_skeleton_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="bracelets_image">Bracelets Image</label>
                                                    <input type="file" name="bracelets_image" class="form-control"
                                                        id="bracelets_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('bracelets_image'))
                                                    <div class="error">
                                                        {{ $errors->first('bracelets_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->bracelets_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->bracelets_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-12">
                                                <div class="form-group">
                                                    <label for="bracelets_content2">Content2</label>
                                                    {!!
                                                    Form::textarea('bracelets_content2',(old('bracelets_content2'))?old('bracelets_content2'):$formObj->bracelets_content2,['class'=>'form-control','id'=>'bracelets_content2',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('bracelets_content2'))
                                                    <div class="error">
                                                        {{ $errors->first('bracelets_content2') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div id="alert_msg_bracelets"></div>
                                            @php $braceletlastcount = 1; @endphp
                                            <div class="col-md-6 col-lg-12 mt-3" id="div_bracelet_images">
                                                @if (count($bracelets) > 0)
                                                @foreach ($bracelets as $bracelet)
                                                @php
                                                $braceletlastcount = $bracelet['id'];
                                                @endphp
                                                <div class="row mb-2 align-items-center"
                                                    id="braceletrow-{{ $bracelet['id'] }}">
                                                    <input type="hidden" name="bracelet_action[{{ $bracelet['id'] }}]"
                                                        value="update">
                                                    <div class="col-sm-2">

                                                        <div id="gallery-{{ $bracelet['id'] }}"
                                                            class="galler-img-box-wrap form-group col-sm-4">
                                                            <div class="g-img-thumbnail">
                                                                @if ($bracelet['image'])
                                                                <img src="{{ asset('uploads/cmspage/'.$bracelet['image']) }}"
                                                                    class="img-thumbnail" alt="">
                                                                @else
                                                                <img src="{{ asset('images/no_image.png') }}"
                                                                    class="img-thumbnail" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="file" name="bracelets[{{$bracelet['id']}}]"
                                                            class="form-control" id="bracelets">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <button type="button"
                                                            onclick="deleteImage('{{ $bracelet['id'] }}','bracelets')"
                                                            class="btn btn btn-danger remove-action btn-action"><i
                                                                class="fas fa-trash"></i></button>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="row mb-2 align-items-center"
                                                    id="braceletrow-{{ $braceletlastcount }}">
                                                    <input type="hidden"
                                                        name="bracelet_action[{{ $braceletlastcount }}]" value="add">
                                                    <div class="col-sm-5">
                                                        <input type="file" name="bracelets[{{ $braceletlastcount }}]"
                                                            class="form-control" id="image">
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="text-center">
                                                <a href="javascript:void(0)" class="btn btn-primary addBracelets"><span
                                                        class="plus-icon"></span> Add Bracelet Image</a>
                                            </div>
                                            <input type="hidden" name="braceletlastcount" id="braceletlastcount"
                                                value="{{ $braceletlastcount }}">

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
                                        <h3 class="card-title">Necklaces</h3>
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
                                                    <label for="necklaces_image">Necklaces Image</label>
                                                    <input type="file" name="necklaces_image" class="form-control"
                                                        id="necklaces_image">
                                                    <!-- Error -->
                                                    @if ($errors->first('necklaces_image'))
                                                    <div class="error">
                                                        {{ $errors->first('necklaces_image') }}
                                                    </div>
                                                    @endif
                                                    @if($formObj->necklaces_image)
                                                    <div class="imgPreview">
                                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->necklaces_image) }}"
                                                            width="300px" class="img-thumbnail" alt="Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-12">
                                                <div class="form-group">
                                                    <label for="necklaces_content">Content</label>
                                                    {!!
                                                    Form::textarea('necklaces_content',(old('necklaces_content'))?old('necklaces_content'):$formObj->necklaces_content,['class'=>'form-control','id'=>'necklaces_content',
                                                    'rows' => 2, 'cols' => 40]) !!}
                                                    <!-- Error -->
                                                    @if ($errors->first('necklaces_content'))
                                                    <div class="error">
                                                        {{ $errors->first('necklaces_content') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div id="alert_msg_necklaces"></div>
                                            @php $necklacelastcount = 1; @endphp
                                            <div class="col-md-6 col-lg-12 mt-3" id="div_necklace_images">
                                                @if (count($necklaces) > 0)
                                                @foreach ($necklaces as $necklace)
                                                @php
                                                $necklacelastcount = $necklace['id'];
                                                @endphp
                                                <div class="row mb-2 align-items-center"
                                                    id="necklacerow-{{ $necklace['id'] }}">
                                                    <input type="hidden" name="necklace_action[{{ $necklace['id'] }}]"
                                                        value="update">
                                                    <div class="col-sm-2">

                                                        <div id="gallery-{{ $necklace['id'] }}"
                                                            class="galler-img-box-wrap form-group col-sm-4">
                                                            <div class="g-img-thumbnail">
                                                                @if ($necklace['image'])
                                                                <img src="{{ asset('uploads/cmspage/'.$necklace['image']) }}"
                                                                    class="img-thumbnail" alt="">
                                                                @else
                                                                <img src="{{ asset('images/no_image.png') }}"
                                                                    class="img-thumbnail" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="file" name="necklaces[{{$necklace['id']}}]"
                                                            class="form-control" id="necklaces">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <button type="button"
                                                            onclick="deleteImage('{{ $necklace['id'] }}','necklaces')"
                                                            class="btn btn btn-danger remove-action btn-action"><i
                                                                class="fas fa-trash"></i></button>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="row mb-2 align-items-center"
                                                    id="necklacerow-{{ $necklacelastcount }}">
                                                    <input type="hidden"
                                                        name="necklace_action[{{ $necklacelastcount }}]" value="add">
                                                    <div class="col-sm-5">
                                                        <input type="file" name="necklaces[{{ $necklacelastcount }}]"
                                                            class="form-control" id="necklaces">
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="text-center">
                                                <a href="javascript:void(0)" class="btn btn-primary addNecklaces"><span
                                                        class="plus-icon"></span> Add Necklace Image</a>
                                            </div>
                                            <input type="hidden" name="necklacelastcount" id="necklacelastcount"
                                                value="{{ $necklacelastcount }}">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>

    $('#page_title').summernote({});
    $('#rings_content1').summernote({
        height: 300,
        placeholder: 'content',
    });
    $('#rings_content2').summernote({
        height: 300,
        placeholder: 'content',

    });

    $('#bracelets_content1').summernote({
        height: 300,
        placeholder: 'content',
    });
    $('#bracelets_content2').summernote({
        height: 300,
        placeholder: 'content',
    });

    $('#necklaces_content').summernote({
        height: 300,
        placeholder: 'content',
    });


    $(function ()
    {
        $(".addRings").click(function ()
        {
            var last_count = $('#ringlastcount').val();
            var riw_id = parseInt(last_count) + 1;
            var image_html = `<div class="row mb-2  align-items-center" id="row-${riw_id}">
                    <input type="hidden" name="action[${riw_id}]" value="add">
                    <div class="col-sm-5">
                        <input type="file" name="rings[${riw_id}]" class="form-control" id="image">
                    </div>
                    <div class="col-sm-6">
                        <div class="select-box">
                        {!! Form::text('product_url[${riw_id}]','', [
                            'class' => 'form-control',
                            'placeholder' => 'Product URL',
                            'id' => 'product_url'
                        ]) !!}
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <button id="${riw_id}" class="btn btn-danger btn-sm remove-action  btn-action btndelete" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`;
            $('#div_ring_images').append(image_html);
            $('#ringlastcount').val(riw_id);
        });

        $(document).on('click', '.btndelete', function ()
        {
            var button_id = $(this).attr("id");
            $('#row-' + button_id + '').remove();
        });


        $(".addBracelets").click(function ()
        {
            var last_count = $('#braceletlastcount').val();
            var riw_id = parseInt(last_count) + 1;
            var image_html = `<div class="row mb-2  align-items-center" id="braceletrow-${riw_id}">
                    <input type="hidden" name="bracelet_action[${riw_id}]" value="add">
                    <div class="col-sm-5">
                        <input type="file" name="bracelets[${riw_id}]" class="form-control" id="bracelets">
                    </div>

                    <div class="col-sm-1">
                        <button id="${riw_id}" class="btn btn-danger btn-sm remove-action  btn-action braceletbtndelete" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`;
            $('#div_bracelet_images').append(image_html);
            $('#braceletlastcount').val(riw_id);
        });

        $(document).on('click', '.braceletbtndelete', function ()
        {
            var button_id = $(this).attr("id");
            $('#braceletrow-' + button_id + '').remove();
        });


        $(".addNecklaces").click(function ()
        {
            var last_count = $('#necklacelastcount').val();
            var riw_id = parseInt(last_count) + 1;
            var image_html = `<div class="row mb-2  align-items-center" id="necklacerow-${riw_id}">
                    <input type="hidden" name="necklace_action[${riw_id}]" value="add">
                    <div class="col-sm-5">
                        <input type="file" name="necklaces[${riw_id}]" class="form-control" id="necklaces">
                    </div>

                    <div class="col-sm-1">
                        <button id="${riw_id}" class="btn btn-danger btn-sm remove-action  btn-action necklacesbtndelete" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`;
            $('#div_necklace_images').append(image_html);
            $('#necklacelastcount').val(riw_id);
        });

        $(document).on('click', '.necklacesbtndelete', function ()
        {
            var button_id = $(this).attr("id");
            $('#necklacerow-' + button_id + '').remove();
        });


    });

    function deleteImage(id, cate_type)
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
                url: '{!! route('admin.cmspage.deletesizeguideimage') !!}',
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
                        if (cate_type == 'rings')
                        {
                            $('#row-' + id).hide();
                        }
                        else if (cate_type == 'bracelets')
                        {
                            $('#braceletrow-' + id).hide();
                        }
                        else if (cate_type == 'necklaces')
                        {
                            $('#necklacerow-' + id).hide();
                        }

                        msg_HTML = `<div class="col-xs-12 flashmessages">
                                        <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>${data.message}</strong>
                                            </div>
                                        </div>`;
                        $('#alert_msg_' + cate_type).html(msg_HTML);
                    }
                }
            });
        });
    }


</script>
@endpush
