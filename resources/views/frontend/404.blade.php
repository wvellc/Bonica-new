@extends('frontend.layouts.layout')
@section('content')
<div class="contact-page inner-header">
	<!-- header -->
	@include('frontend.layouts.header')
		<!-- main -->
		<main>
			<section class="section ">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<img src="{{ asset('images/logo.svg') }}" alt="" class="mb-5">
                                <h1 class="mb-4">404</h1>
                                <h3>Page Not Found</h3>
                                <a href="{{ route('frontend.home') }}" class="btn btn-primary mt-5"> Go To Home Page</a>
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
