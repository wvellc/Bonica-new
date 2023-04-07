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
                {{ Breadcrumbs::render("contact".$page_title) }}
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
                                    <label for="name">Name <span class="error">*</span></label>
                                    {{ Form::text('name',(old('name'))?old('name'):$formObj->name, ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name','readonly' => 'true']) }}
                                   
                                </div>

                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="error">*</span></label>
                                    {{ Form::text('email',(old('email'))?old('email'):$formObj->email, ['class' => 'form-control', 'placeholder' => 'email', 'id' => 'email','readonly' => 'true']) }}
                                    
                                </div>

                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile <span class="error">*</span></label>
                                    {{ Form::text('email',(old('mobile'))?old('mobile'):$formObj->mobile, ['class' => 'form-control', 'placeholder' => 'mobile', 'id' => 'mobile','readonly' => 'true']) }}
                                   
                                </div>

                            </div>
                            
                           
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    {!! Form::textarea('message',(old('message'))?old('message'):$formObj->message,['class'=>'form-control','id'=>'message', 'rows' => 2, 'cols' => 40,'readonly' => 'true']) !!}
                                    <h5 id="maxContentPost" style="text-align:right"></h5>
                                   
                                </div>
                            </div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						{{-- <button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button> --}}
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
    
</script>
@endpush
