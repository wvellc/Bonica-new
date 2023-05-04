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
									<h2>Login</h2>
                                    @include('layouts.alert_message')
									{{ Form::open(array('url' => route('frontend.save.login'), 'method'=> 'POST', 'enctype' => 'multipart/form-data')) }}
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Type your Email ID" value="{{ old('email') }}">
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
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Type your Password">
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
											<div class="col-sm-6 mb-3">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="remember" >
													<label class="form-check-label" for="remember">
														Remember Me
													</label>
												</div>
											</div>
											<div class="col-sm-6 mb-3">
												<label class="d-block text-center text-sm-end">
													<a href="{{ route('frontend.forgot-password') }}" class="text-underline">Forgot Password<span class="jost-fonts bold">?</span></a>
												</label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 mt-3 mt-sm-4">
												<div>
													<button type="submit" class="btn btn-primary w-100 mw-100">Sign IN</button>
													<div class="optiional-divider">
														<span> or </span>
													</div>
													<!-- <button type="submit" class="btn btn-google w-100 mw-100"><img src="{{ asset('images/icons/google.svg') }}" alt=""> Login With Google</button>
 -->
                                                    <a href="{{ url('auth/google') }}"
                                                        class="btn btn-google w-100 mw-100"><img src="{{ asset('images/icons/google.svg') }}" alt="">Login With Google</a>

												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12  mt-3 mt-sm-5">
												<div class="back-to-links text-center">
													<a href="{{ route('frontend.home') }}" class="me-2 me-md-4">Back to Store</a>
													<a href="{{ route('frontend.signup') }}">Create Account</a>
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
