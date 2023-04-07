@extends('admin.auth.layouts.layout')
@section('content')
@include('admin.layouts.alert_message')
{{ Form::open(array('url' => route('admin.loginPost'),'method'=>'post')) }}
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
<div class="input-group">
	<input type="password" class="form-control" name="password" placeholder="Password">
	<div class="input-group-append">
		<div class="input-group-text">
			<span class="fas fa-lock"></span>
		</div>
	</div>
</div>
<!-- Error -->
@if ($errors->has('password'))
<div class="error">
	{{ $errors->first('password') }}
</div>
@endif
<div class="mb-3"></div>
<div class="row align-items-center mb-4">
	<div class="col-sm-12 col-md-12 col-lg-7">
		<div class="icheck-primary">
			<input type="checkbox" id="remember" name="remember" value="remember">
			<label for="remember">
				Remember Me
			</label>
		</div>
	</div>
	<!-- /.col -->
	<div class="col-sm-12 col-md-12 col-lg-5">
		<button type="submit" class="btn btn-info bg-gradient-info" style="width: 100%" >Sign In</button>
	</div>
	<!-- /.col -->
</div>
{{ Form::close() }}

<p class="mb-1">
	<a class="theme-font-color" href="{{ route('admin.forgot.password') }}">Forgot my password</a>
</p>

@stop
