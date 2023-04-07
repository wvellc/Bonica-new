@extends('admin.auth.layouts.layout')
@section('content')
@include('admin.layouts.alert_message')

{{ Form::open(array('url' => route('admin.password.reset.store'),'method'=>'post')) }}
<input type="hidden" name="token" value="{{ $token }}">
<input type="hidden" name="user_type" value="admins">
<div class="input-group">
	{{ Form::text('email', $email ?? old('email'), ['class' => 'form-control', 'placeholder' => 'E-mail Address']) }}
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
	<input type="password" class="form-control" name="password" placeholder="Create a new password">
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
<div class="input-group">
	<input type="password" class="form-control" name="password_confirmation" placeholder="Reenter your new password">
	<div class="input-group-append">
		<div class="input-group-text">
			<span class="fas fa-lock"></span>
		</div>
	</div>
</div>
<!-- Error -->
@if ($errors->has('password_confirmation'))
<div class="error">
	{{ $errors->first('password_confirmation') }}
</div>
@endif
<div class="mb-3"></div>
<div class="row">
	<div class="col-6">
	</div>
	<!-- /.col -->
	<div class="col-6">
		<button type="submit" class="btn btn-info bg-gradient-info" style="width: 100%">{{ __('Update Password') }}</button>
	</div>
	<!-- /.col -->
</div>
{{ Form::close() }}
@stop
