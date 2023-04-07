@extends('frontend.layouts.layout')
@section('content')
    <!--Custum cursor -->
    <div class="cursor--container">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
    </div>
    <div class="forgot-password-page">
		<!-- main -->
		<main class="bg-light-blue">
			<section class="login-section" >
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-lg-8 col-xl-5 m-auto" >
							<div class="white-box-with-order white-box-with-top-img ">
								<div class="top-logo wow rollIn"><a href="{{ route('frontend.home') }}" class="d-block "><img src="{{ asset('images/evolv-logo.svg') }}" alt="Logo"> </a></div>
								<h2 class="wow fadeInDown  text-center text-md-left">Reset password</h2>
                                @include('layouts.alert_message')
								<div class="form-wrapper wow fadeInUp">
                                {{ Form::open(array('url' => route('frontend.reset.password'), 'method'=> 'POST', 'enctype' => 'multipart/form-data')) }}
                                        <input type="hidden" name="token" value="{{ $token }}">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="exampleInputEmail1">Email</label>
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="email" placeholder="Email" value="{{ $email ?? old('email') }}">
													@if ($errors->has('email'))
													<span class="text-danger">
														{{ $errors->first('email') }}
													</span>
													@endif
												</div>
											</div>
										</div>
                                        <div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="password">Password</label>
													<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password"  value="{{ old('password') }}">
													@if($errors->has('password'))
													<span class="text-danger">
														{{ $errors->first('password') }}
													</span>
													@endif
												</div>
											</div>
										</div>
                                        <div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="password">Confirm password</label>
													<input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Password" value="{{ old('password_confirmation') }}">
													@if($errors->has('password_confirmation'))
													<span class="text-danger">
														{{ $errors->first('password_confirmation') }}
													</span>
													@endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group  text-center text-md-left">
													<button type="submit" class="btn btn-gradient">Reset Password</button>
												</div>
												<div class="font-18  text-center text-md-left">
													<p>Already have an account?  <a href="{{ route('frontend.login') }}" class="underline-link">Login</a></p>
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
		@include('frontend.layouts.footerjs')
	</div>
@endsection
