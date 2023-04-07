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
									<h2>Forgot Password</h2>
                                    @include('layouts.alert_message')
									{{ Form::open(array('url' => route('frontend.forgot.password.link'), 'method'=> 'POST', 'enctype' => 'multipart/form-data')) }}
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
                                                    <input type="text" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Type your Email ID" value="{{ old('email') }}">
													@if ($errors->has('email'))
													<span class="text-danger">
														{{ $errors->first('email') }}
													</span>
													@endif
													<span class="input-icon"><i class="fas fa-user"></i></span>
													<p class="resetpara my-4">Enter your email address above to reset your password</p>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 ">
												<div>
													<button type="submit" class="btn btn-primary w-100 mw-100">Send</button>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12  mt-3 mt-sm-5">
												<div class="back-to-links text-center">
													<a href="{{ route('frontend.login') }}">Back to Login</a>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 mt-3  mt-sm-5">
												<div>
													<p><a href="terms.php">Terms & Conditions</a> &  <a href="policy.php">Privacy Policy</a></p>
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
