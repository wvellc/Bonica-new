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
									<h2>Sign Up</h2>
                                    @include('layouts.alert_message')
									{{ Form::open(array('url' => route('frontend.save.signup'), 'method'=> 'POST', 'enctype' => 'multipart/form-data')) }}
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">

                                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
													@if ($errors->has('first_name'))
													<span class="text-danger">
														{{ $errors->first('first_name') }}
													</span>
													@endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
                                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
													@if ($errors->has('last_name'))
													<span class="text-danger">
														{{ $errors->first('last_name') }}
													</span>
													@endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
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
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
													@if ($errors->has('password'))
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

                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
													@if ($errors->has('password_confirmation'))
													<span class="text-danger">
														{{ $errors->first('password_confirmation') }}
													</span>
													@endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 mb-3  mb-sm-4">
												<div class="form-check">
													<input type="checkbox" name="agree" id="agree" class="form-check-input mt-1"  @if(old('agree')) checked : '' @endif>
													<label class="form-check-label" for="agree">
														<p>By clicking this, I accept the  <a href="terms.php">Terms & Conditions</a> &  <a href="policy.php">Privacy Policy</a></p>
													</label>

												</div>
                                                @if ($errors->has('agree'))
													<span class="text-danger">
														{{ $errors->first('agree') }}
													</span>
													@endif
											</div>
										</div>
										<div class="row mt-3">
											<div class="col-md-12 mb-3">
												<div>
													<button type="submit" class="btn btn-primary w-100 mw-100">Sign UP</button>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12  mt-3 mt-sm-5">
												<div class="back-to-links text-center">
													<a href="{{ route('frontend.home') }}" class="me-2 me-md-4">Back to Store</a>
													<a href="{{ route('frontend.login') }}">Sign In  Account</a>
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
