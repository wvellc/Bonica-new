@extends('frontend.layouts.layout')
@section('content')

    <div class="login-page">
        <!-- header -->
	    @include('frontend.layouts.header')
		<!-- main -->
		<main>
			<section class="section login-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-10 col-xl-12">
							<div class="login-box-wrapper">
								<div class="form-wrapper">
									<h2>Reset password</h2>
                                    @include('layouts.alert_message')
									{{ Form::open(array('url' => route('frontend.reset.password'), 'method'=> 'POST', 'enctype' => 'multipart/form-data')) }}
                                        <input type="hidden" name="token" value="{{ $token }}">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
                                                    <input type="text" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Type your Email ID" value="{{ $email ?? old('email') }}">
													@if ($errors->has('email'))
													<span class="text-danger">
														{{ $errors->first('email') }}
													</span>
													@endif
													<span class="input-icon"><i class="fas fa-user"></i></span>
												</div>
											</div>
										</div>
                                        <div class="row">
											<div class="col-md-12">
												<div class="form-group">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Type your Password"  value="{{ old('password') }}">
													@if($errors->has('password'))
													<span class="text-danger">
														{{ $errors->first('password') }}
													</span>
													@endif
													<span toggle="#password" class="fa fa-fw fa-eye input-icon field-icon toggle-password"></span>
												</div>
											</div>
										</div>
                                        <div class="row">
											<div class="col-md-12">
												<div class="form-group">
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password" value="{{ old('password_confirmation') }}">
													@if($errors->has('password'))
													<span class="text-danger">
														{{ $errors->first('password') }}
													</span>
													@endif
													<span toggle="#password_confirmation" class="fa fa-fw fa-eye input-icon field-icon toggle-password"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 ">
												<div>
													<button type="submit" class="btn btn-primary w-100 mw-100">save</button>
												</div>
											</div>
										</div>
                                    {{ Form::close() }}
								</div>

							</div>
						</div>
					</div>
				</div>
			</section>

		</main>
		<!-- footer -->
        @include('frontend.layouts.footer')
		@include('frontend.layouts.footerjs')
	</div>
@endsection
