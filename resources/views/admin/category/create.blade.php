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
                {{ Breadcrumbs::render("category".$page_title) }}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content category-content">
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
                                <label for="name">Category <span class="error">*</span></label>
                                {{ Form::text('name',(old('name'))?old('name'):$formObj->name, ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name']) }}
                                <!-- Error -->
                                @if ($errors->has('name'))
                                <div class="error">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>

                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="mls">Parent</label>
                                <div class="select-box">
                                {!! Form::select('parent_id', [0 => 'Select Parent'] + $parent_category,$selectedParentID, ['class' => 'form-control','id' => 'parent_id']) !!}
                                </div>
                                <!-- Error -->
                                @if ($errors->has('parent_id'))
                                <div class="error">
                                    {{ $errors->first('parent_id') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="image">Image (690 * 560 pixels)</label>
                                <input type="file" name="image" class="form-control" id="image">
                                <!-- Error -->
                                @if ($errors->first('image'))
                                <div class="error">
                                    {{ $errors->first('image') }}
                                </div>
                                @endif
                                @isset($formObj->image)
                                <div class="imgPreview">
                                    <img src="{{ URL::asset($cloud_front_url.$formObj->image) }}" width="200px" class="img-thumbnail" alt="Category">
                                </div>
                                @endisset
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="icon">Icon (24 * 24 pixels)</label>
                                <input type="file" name="icon" class="form-control" id="icon">
                                <!-- Error -->
                                @if ($errors->first('icon'))
                                <div class="error">
                                    {{ $errors->first('icon') }}
                                </div>
                                @endif
                                @isset($formObj->icon)
                                <div class="imgPreview">
                                    <img src="{{ URL::asset('uploads/category/'.$formObj->icon) }}" width="100px" class="img-thumbnail" alt="Category Icon">
                                </div>
                                @endisset
                            </div>
                        </div>
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
                                @isset($formObj->banner_image)
                                <div class="imgPreview">
                                    <img src="{{ URL::asset($cloud_front_url.$formObj->banner_image) }}" width="300px" class="img-thumbnail" alt="Category">
                                </div>
                                @endisset
                            </div>
                        </div>
                        @php $nameRequired=$statusRequired= 1; @endphp
                        @include('admin.input.status')
                        <div class="col-12 col-sm-6">
                            <div class="form-group dollor-sign">
                                <div class="icheck-primary">
                                    <input type="checkbox" @if ($formObj->is_show_size_chart) checked @endif
                                    id="is_show_size_chart" name="is_show_size_chart" value="1">
                                    <label for="is_show_size_chart">
                                        Show Size Chart
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label for="description">Short Description</label>
                                {!! Form::textarea('description',(old('description'))?old('description'):$formObj->description,['class'=>'form-control','id'=>'description','onkeyup' => 'countChar(this,95)', 'rows' => 2, 'cols' => 40]) !!}
                                <input type="hidden" name="text_limit" id="text_limit" value="95">
                                <div id="charNum" style="text-align: right;"></div>
                                <!-- Error -->
                                @if ($errors->first('description'))
                                <div class="error">
                                    {{ $errors->first('description') }}
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
                    @if ($formObj->id > 0)

                    @if (!empty($discover_products))
                    <section class="content">
                        <!-- Default box -->
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Discover</h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-lg-4">
                                <div class="form-group">

                                    <input type="file" name="discover_image" class="form-control" id="discover_image">
                                    <!-- Error -->
                                    @if ($errors->first('discover_image'))
                                    <div class="error">
                                        {{ $errors->first('discover_image') }}
                                    </div>
                                    @endif
                                    @if($formObj->discover_image)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('categories/'.$formObj->discover_image) }}" width="200px" class="img-thumbnail" alt="discover_image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-4  col-lg-6 select-inner-design-wrapper">
                                <div class="form-group">

                                    {!! Form::select('discover_product_id[]', $discover_products,$selectedDiscoverProducts, ['class' => 'form-control','id' => 'discover_product_id', 'multiple' => 'multiple']) !!}
                                    <!-- Error -->
                                    @if ($errors->has('discover_product_id'))
                                    <div class="error">
                                        {{ $errors->first('discover_product_id') }}
                                    </div>
                                    @endif


                                </div>
                            </div>
                            <div class="col-12 col-sm-4  col-lg-2">
                                <div class="form-group">
                                    {!! Form::select('discover_status', $discoverStatusData, $selecteddiscoverStatusID, ['class' => 'form-control', 'id' => 'discover_status']) !!}
                                    <!-- Error -->
                                    @if ($errors->has('discover_status'))
                                    <div class="error">
                                        {{ $errors->first('discover_status') }}
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
            @endif
            @if (!empty($shopthelook_products))
            <section class="content">
                <!-- Default box -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Shop The Look</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-4 col-lg-4">
                        <div class="form-group">

                            <input type="file" name="shopthelook_image" class="form-control" id="shopthelook_image">
                            <!-- Error -->
                            @if ($errors->first('shopthelook_image'))
                            <div class="error">
                                {{ $errors->first('shopthelook_image') }}
                            </div>
                            @endif
                            @if($formObj->shopthelook_image)
                            <div class="imgPreview">
                                <img src="{{ URL::asset('categories/'.$formObj->shopthelook_image) }}" width="200px" class="img-thumbnail" alt="shopthelook_image">
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-4  col-lg-6 select-inner-design-wrapper">
                        <div class="form-group">

                            {!! Form::select('shopthelook_product_id[]', $shopthelook_products,$selectedshopthelookProducts, ['class' => 'form-control','id' => 'shopthelook_product_id', 'multiple' => 'multiple']) !!}
                            <!-- Error -->
                            @if ($errors->has('shopthelook_product_id'))
                            <div class="error">
                                {{ $errors->first('shopthelook_product_id') }}
                            </div>
                            @endif

                            {{--  @isset($formObj->discover_image)
                            <div class="imgPreview">
                                <img src="{{ URL::asset('uploads/category/'.$formObj->discover_image) }}" width="200px" class="img-thumbnail" alt="discover_image">
                            </div>
                            @endisset --}}
                        </div>
                    </div>
                    <div class="col-12 col-sm-4  col-lg-2">
                        <div class="form-group">
                            {!! Form::select('shopthelook_status', $shopthelookStatusData, $selectedShopthelookStatusID, ['class' => 'form-control', 'id' => 'shopthelook_status']) !!}
                            <!-- Error -->
                            @if ($errors->has('shopthelook_status'))
                            <div class="error">
                                {{ $errors->first('shopthelook_status') }}
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
    @endif
    @endif
</div>
<!-- /.card-body -->

<div class="card-footer">
  <button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
  <a href="{{ route('admin.category.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function countChar(val,limit) {
      var len = val.value.length;
      if (len > limit) {
       val.value = val.value.substring(0, limit);
   } else {
       $('#charNum').text(limit - len);
   }
};
$('#discover_product_id').select2({
    placeholder: "Search Product",
    minimumInputLength: 1,
    multiple: true,
    ajax: {
        url:'{{ route("admin.search-cate-product") }}',
        dataType: 'json',
        data: function (params) {
            return {
                searchTerm: $.trim(params.term),
                parent_id: '{{$selectedParentID}}',
                cate_id: '{{$formObj->id}}'
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});

$('#shopthelook_product_id').select2({
    placeholder: "Search Product",
    minimumInputLength: 1,
    multiple: true,
    ajax: {
        url:'{{ route("admin.search-cate-product") }}',
        dataType: 'json',
        data: function (params) {
            return {
                searchTerm: $.trim(params.term),
                parent_id: '{{$selectedParentID}}',
                cate_id: '{{$formObj->id}}'
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});



$(function() {

        // Multiple images preview with JavaScript
        /* var multiImgPreview = function(input, imgPreviewPlaceholder) {

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
        }); */
    });
</script>
@endpush
