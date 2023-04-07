@extends('admin.auth.layouts.layout')
@section('content')
@include('admin.layouts.alert_message')

{{ Form::open(array('url' => route('admin.password.email'),'method'=>'post')) }}
<div class="input-group">
	{{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'E-mail Address']) }}
	<div class="input-group-append">
		<div class="input-group-text">
			<span class="fas fa-envelope"></span>
		</div>
	</div>
</div>
<!-- Error -->
@if ($errors->has('email'))
<div class="error">
	{{ $errors->first('email') }}
</div>
@endif
<div class="mb-3"></div>
<div class="row align-items-center">
	<div class="col-sm-12 col-md-12 col-lg-4">
		<p class="mb-1">
			<a href="{{ route('admin.login') }}" class="theme-font-color">Back To Login</a>
		</p>
	</div>
	<!-- /.col -->
	<div class="col-sm-12 col-md-12 col-lg-8">
		<button type="submit" class="btn btn-info bg-gradient-info" style="width: 100%">{{ __('Send Password Reset Link') }}</button>
	</div>
	<!-- /.col -->
</div>
{{ Form::close() }}
@stop
