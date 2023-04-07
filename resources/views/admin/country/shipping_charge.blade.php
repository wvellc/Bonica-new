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
                {{ Breadcrumbs::render("country".$page_title) }}
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
					{{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method, 'enctype' => 'multipart/form-data', 'class' => 'form-vertical')) }}

					<!-- form start -->
					<div class="card-body">
						<div class="row">
                            @if (count($countries) > 0)
                                @foreach ($countries as $country)
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="{{$country->name}}">{{$country->name}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">{!! $country->symbol !!}</span>
                                                </div>
                                                <input type="text" name="shipping_charge[{{$country->slug}}]" id="{{$country->id}}" class="form-control" value="{{$country->shipping_charge}}">

                                              </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
						<a href="{{ route('admin.shipping_charge') }}" class="btn btn-danger icon-btn">Cancel</a>
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

