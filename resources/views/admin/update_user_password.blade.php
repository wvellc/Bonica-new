@extends('admin.layouts.layout')
@section('content')
{{-- <section class="content-header">
    <h1>
        Change Password
    </h1>
</section> --}}
<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="card-body">
                <fieldset>
                	<legend><b>Update User Password</b></legend>
                	{{ Form::open(array('url' => route('admin.user.update.password'), 'class' => 'form-horizontal')) }}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                        	<div class="input-group">
                            	<?=Form::text('email', old('email'), ['placeholder' => 'Email', 'class' => 'form-control'])?>
                           		<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            </div>
                           	@if($errors->has('email'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">New Password</label>
                        <div class="col-sm-6">
                        	<div class="input-group">
                            	<?=Form::password('password', ['class' => 'form-control', 'placeholder' => "New Password"])?>
                            	<span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>
                            @if($errors->has('password'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-6">
                        	<div class="input-group">
                            	<?=Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => "Confirm New Password"])?>
                            	<span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>
                            @if($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
            	</fieldset>
           	</div>
           	<div class="card-footer">
                <div class="row">
                    <div class="col-md-7 col-md-offset-4">
                        <button type="submit" class="btn btn-primary icon-btn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('admin.dashboard.index') }}" class="btn btn-default icon-btn"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
     @include('admin.layouts.overlay')
        </div>
    </div>
</section>
@stop

