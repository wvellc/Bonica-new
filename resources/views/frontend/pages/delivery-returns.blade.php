@extends('frontend.layouts.layout')
@section('title', $page->meta_title )
@section('meta_keywords', $page->meta_keywords)
@section('meta_description', $page->meta_description)
@section('content')
<div class="appointment-page">
	<!-- header -->
	@include('frontend.layouts.header')
		<!-- main -->
        <main>
			<section class="inner-banner-section" style="background-image:url({{ asset('uploads/cmspage/'.$page->banner_image) }}) ;" >
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-sm-12 col-md-6 col-xl-4 order-2 order-md-1">
							<div class="inner-banner-info text-center text-md-start">
								<h2>{{$page->name}}</h2>
							</div>
						</div>

					</div>
				</div>
			</section>
			<section class="section terms-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-10 col-xl-10 m-auto">
                            {!! $page->content !!}
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

