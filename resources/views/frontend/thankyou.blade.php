@extends('frontend.layouts.layout')
@section('title', 'Contact Us | Bonica Jewels')
@section('meta_description', "LATEST COLLECTION Lab Grown Diamonds Stunning selection and the option to choose from a wide range of diamondContinue Reading 'Bonica Jewels'")
@section('content')
<div class="contact-page">
	<!-- header -->
	@include('frontend.layouts.header')
		<!-- main -->
        <main>

			<section class="inner-banner-section" style="background-image:url({{ asset('images/banners/banner-1.png') }}) ;" >
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-sm-12 col-md-6 col-xl-4 order-2 order-md-1">
							<div class="inner-banner-info text-center text-md-start">
								<!-- <h2>Terms and Conditions</h2> -->
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section terms-section bg-cream">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-10 col-xl-10 m-auto text-center">
							<img src="{{ asset('images/icons/checked.svg') }}" alt="checked" class="right-checked">
							<div class="section-title mb-4">
								<h2> <span>Thank You</span> For your order</h2>
								<p class="subtitle">Your order was successfully placed.</p>
							</div>

							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
							</p>
							<a href="{{ route('frontend.myorders') }}" class="btn btn-primary">View Order</a>
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
