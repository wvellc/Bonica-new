@extends('frontend.layouts.layout')
@section('title', $page->meta_title )
@section('meta_keywords', $page->meta_keywords)
@section('meta_description', $page->meta_description)
@section('content')
<div class="terms-page">
	<!-- header -->
	@include('frontend.layouts.header')
		<!-- main -->
        <main>
			<section class="new-inner-banner-section" style="background-image:url({{ asset('uploads/cmspage/'.$page->banner_image) }}) ;" >
				<div class="container">
					<div class="row ">
						<div class="col-sm-12 col-md-12">
						</div>

					</div>
				</div>
			</section>
			<section class="section">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2>{!!$page->title !!}</h2>
							</div>
						</div>
					</div>
					<div class="row align-items-center justify-content-between mt-4 mt-md-5">
						<div class="col-md-12 col-lg-6 col-xl-6">
							<div class="d-shape">
								<img src="{{ asset('uploads/cmspage/'.$page->big_image) }}" alt="" class="w-100">
							</div>
						</div>
						<div class="col-md-12 col-lg-6 col-xl-6 mt-4 mt-lg-0">
							<ul class="d-list-wrapper">
								<li>
									<div class="d-list-img">
										<img src="{{ asset('uploads/cmspage/'.$page->image_1) }}" alt="">
									</div>
									<div class="d-list-info">
										<h5>{{$page->title_1}}</h5>
										<p>{{$page->content_1}}</p>
									</div>
								</li>
								<li>
									<div class="d-list-img">
										<img src="{{ asset('uploads/cmspage/'.$page->image_2) }}" alt="">
									</div>
									<div class="d-list-info">
										<h5>{{$page->title_2}}</h5>
										<p>{{$page->content_2}}</p>
									</div>
								</li>
								<li>
									<div class="d-list-img">
										<img src="{{ asset('uploads/cmspage/'.$page->image_3) }}" alt="">
									</div>
									<div class="d-list-info">
										<h5>{{$page->title_3}}</h5>
										<p>{{$page->content_3}}</p>
									</div>
								</li>
								<li>
									<div class="d-list-img">
										<img src="{{ asset('uploads/cmspage/'.$page->image_4) }}" alt="">
									</div>
									<div class="d-list-info">
										<h5>{{$page->title_4}}</h5>
										<p>{{$page->content_4}}</p>
									</div>
								</li>
								<li>
									<div class="d-list-img">
										<img src="{{ asset('uploads/cmspage/'.$page->image_5) }}" alt="">
									</div>
									<div class="d-list-info">
										<h5>{{$page->title_5}}</h5>
										<p>{{$page->content_5}}</p>
									</div>
								</li>
							</ul>
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
{{-- @push('js')
<script>

</script>
@endpush
 --}}
