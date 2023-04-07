@extends('admin.layouts.layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Settings</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
                {{ Breadcrumbs::render('settings') }}
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
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Profile Update</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					{{ Form::open(array('url' => route('admin.profile.store'), 'method'=> 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-vertical')) }}
						<div class="card-body">
							<div class="form-group">
								<label for="name">Name <span class="error">*</span></label>
								{{ Form::text('name', auth()->guard('admin')->user()->name ?? old('name'), ['class' => 'form-control', 'placeholder' => 'Name']) }}
								<!-- Error -->
								@if ($errors->has('name'))
								<div class="error">
									{{ $errors->first('name') }}
								</div>
								@endif
							</div>
							<div class="form-group">
								<label for="email">Email <span class="error">*</span></label>
								{{ Form::text('email', auth()->guard('admin')->user()->email ?? old('email'), ['class' => 'form-control', 'placeholder' => 'E-mail Address']) }}
								<!-- Error -->
								@if ($errors->has('email'))
								<div class="error">
									{{ $errors->first('email') }}
								</div>
								@endif
							</div>
                            {{--  <div class="form-group">
								<label for="imageFile">{{ __('Profile Image') }}</label>
								<input type="file" name="imageFile" class="form-control" id="images">
								<!-- Error -->
								@if ($errors->has('imageFile'))
								<div class="error">
									{{ $errors->first('imageFile') }}
								</div>
								@endif
							</div>  --}}
						</div>
						<!-- /.card-body -->

						<div class="card-footer">
							<button type="submit" class="btn btn-info">{{ __('Update Profile') }}</button>
							<a href="{{ route('admin.dashboard.index') }}" class="btn btn-danger icon-btn"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
						</div>
					{{ Form::close() }}
				</div>
				<!-- /.card -->
			</div>
			<!--/.col (left) -->

			<!-- Right column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Change Password</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					{{ Form::open(array('url' => route('admin.change.password.store'),'method'=>'post')) }}
						<div class="card-body">
							<div class="form-group">
								<label for="current_password">{{ __('Current Password') }} <span class="error">*</span></label>
								<input id="current_password" type="password" class="form-control" name="current_password" placeholder="Current Password">
								<!-- Error -->
								@if ($errors->has('current_password'))
								<div class="error">
									{{ $errors->first('current_password') }}
								</div>
								@endif
							</div>
							<div class="form-group">
								<label for="new_password">{{ __('New Password') }} <span class="error">*</span></label>
								<input id="new_password" type="password" class="form-control" name="new_password" placeholder="New Password">
								<!-- Error -->
								@if ($errors->has('new_password'))
								<div class="error">
									{{ $errors->first('new_password') }}
								</div>
								@endif
							</div>
							<div class="form-group">
								<label for="new_confirm_password">{{ __('New Confirm Password') }} <span class="error">*</span></label>
								<input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" placeholder="New Confirm Password">
								<!-- Error -->
								@if ($errors->has('new_confirm_password'))
								<div class="error">
									{{ $errors->first('new_confirm_password') }}
								</div>
								@endif
							</div>
						</div>
						<!-- /.card-body -->

						<div class="card-footer">
							<button type="submit" class="btn btn-info">Update Password</button>
							<a href="{{ route('admin.dashboard.index') }}" class="btn btn-danger icon-btn"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
						</div>
					{{ Form::close() }}
				</div>
				<!-- /.card -->
			</div>
			<!--/.col (Right) -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
@stop
