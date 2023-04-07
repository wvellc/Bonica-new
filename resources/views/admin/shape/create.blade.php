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
                {{ Breadcrumbs::render("size".$page_title) }}
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
				<div class="card card-info" style="min-height: 500px;">

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
                            @include('admin.input.name')
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="image">Image (125 * 125 pixels)</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    <!-- Error -->
                                    @if ($errors->first('image'))
                                    <div class="error">
                                        {{ $errors->first('image') }}
                                    </div>
                                    @endif
                                    @isset($formObj->image)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/shape/'.$formObj->image) }}" width="100px" class="img-thumbnail" alt="Shape">
                                    </div>
                                    @endisset
                                </div>
                            </div>
                            @include('admin.input.status')
                            <div class="col-12 col-sm-6">
                                <div class="form-group dollor-sign">
                                    <label id="lblsort_order">Sort Order</label>

                                    <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder=""
                                        value="{{ (old('sort_order'))?old('sort_order'):$formObj->sort_order }}"
                                        onkeypress="return /[0-9]/i.test(event.key)">

                                    @if ($errors->has('sort_order'))
                                    <div class="text-danger">
                                        {{ $errors->first('sort_order') }}
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
						<a href="{{ route('admin.shape.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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
@endpush

