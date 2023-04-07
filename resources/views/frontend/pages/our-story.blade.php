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
								<h2>Our <span>  Story</span></h2>
							</div>
						</div>
					</div>
                    @if($page->our_vision_image || $page->our_vision_content)
                        <div class="row align-items-center justify-content-between mt-4 mt-md-5">

                            @if ($page->our_vision_image)
                                <div class="col-md-6 col-xl-5 text-center ">
                                    <div class="mb-4 mb-md-0">
                                        <img src="{{ asset('uploads/cmspage/'.$page->our_vision_image) }}" alt="Image">
                                    </div>
                                </div>
                            @endif
                            @if ($page->our_vision_content)
                            @php
                                $cls_our_vision = ($page->our_vision_image) ? 'col-md-6 col-xl-6' : 'col-md-12 col-xl-12';
                            @endphp
                            <div class="{{$cls_our_vision}}">
                                <div class="story-info">
                                    <h5>Our Vision</h5>
                                    {!!$page->our_vision_content !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    @endif
                    @if($page->our_mission_image || $page->our_mission_content)
					<div class="row align-items-center justify-content-between mt-4 mt-md-5">
                        @if ($page->our_mission_image)
						<div class="col-md-6 col-xl-5 text-center order-1 order-md-2 ">
							<div class="mb-4 mb-md-0">
								<img src="{{ asset('uploads/cmspage/'.$page->our_mission_image) }}" alt="Image">
							</div>
						</div>
                        @endif
                        @if ($page->our_mission_content)
                            @php
                                $cls_our_mission = ($page->our_mission_image) ? 'col-md-6 col-xl-6 order-2 order-md-1' : 'col-md-12 col-xl-6 order-12 order-md-1';
                            @endphp
                            <div class="{{$cls_our_mission}}">
                                <div class="story-info">
                                    <h5>Our Mission</h5>
                                    {!!$page->our_mission_content !!}
                                </div>
                            </div>
                        @endif
					</div>
                    @endif
                    @if($page->big_diamond_image)
					<div class="row align-items-center mt-4 mt-md-5">
						<div class="col-md-12 text-center">

                            {{-- <video src="{{asset('uploads/cmspage/'.$page->big_diamond_video)}}" loop muted autoplay class="w-100"></video> --}}


                            <div class="video-wrap">
								<video src="{{$page->big_diamond_video}}" class="w-100" controls="controls" autoplay>
								</video>
							</div>



							{{-- <img src="{{ asset('uploads/cmspage/'.$page->big_diamond_image) }}" alt="" class="w-100"> --}}
						</div>
					</div>
                    @endif
				</div>
			</section>
			<section class="section bg-cream">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2> {!!$page->why_bonica_title !!} </h2>
								<p class="subtitle">{!!$page->why_bonica_sub_title !!}</p>
							</div>
						</div>
					</div>
					<div class="row align-items-center justify-content-between mt-4 mt-md-5">
						<div class="col-md-5 text-center ">
							<img src="{{ asset('uploads/cmspage/'.$page->why_bonica_image) }}" alt="" class="mb-3 mb-md-0">
						</div>

						<div class="col-md-6  ">
							<div class="guaranteed-list">
								<ul>
									<li>
										<h5>{{$page->why_bonica_authentic_title}}</h5>
										<p>{{$page->why_bonica_authentic_description}}</p>
									</li>
									<li>
										<h5>{{$page->why_bonica_economical_title}}</h5>
										<p>{{$page->why_bonica_economical_description}}</p>
									</li>
									<li>
										<h5>{{$page->why_bonica_protector_title}}</h5>
										<p>{{$page->why_bonica_protector_description}}</p>
									</li>
									<li>
										<h5>{{$page->why_bonica_maestros_title}}</h5>
										<p>{{$page->why_bonica_maestros_description}}</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 text-center ">
							<div class="section-title">
                                <h2>{!!$page->our_commitment_title !!}</h2>
							</div>
							<ul class="assurance-list row justify-content-center">
								<li class="col-md-6 col-xl-3">
									<img src="{{ asset('uploads/cmspage/'.$page->our_commitment_first_icon) }}" alt="" class="mb-3">
									{{-- <p>{{$page->our_commitment_first_description}}</p> --}}
                                    <p>{!!$page->our_commitment_first_description !!}</p>
								</li>
								<li class="col-md-6 col-xl-3">
									<img src="{{ asset('uploads/cmspage/'.$page->our_commitment_second_icon) }}" alt="" class="mb-3">
									{{-- <p>{{$page->our_commitment_second_description}}</p> --}}
                                    <p>{!!$page->our_commitment_second_description !!}</p>
								</li>
								<li class="col-md-6 col-xl-3">
									<img src="{{ asset('uploads/cmspage/'.$page->our_commitment_third_icon) }}" alt="" class="mb-3">
									{{-- <p>{{$page->our_commitment_third_description}}</p> --}}
                                    <p>{!!$page->our_commitment_third_description !!}</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<section class="section pt-0">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2>{!!$page->making_bonica_title !!}</h2>
								<p class="subtitle"> {{$page->making_bonica_sub_title}}</p>
							</div>
							<div class="diamond-tabs-wrapper">
								<div class="row justify-content-center my-5">
									<div class="col-12">
										<ul class="nav justify-content-center align-items-end">
											<li class="nav-item">
												<a class="nav-link active" id="t-d-s-tab" data-bs-toggle="tab" data-bs-target="#t-d-s" href="#"><img src="{{ asset('uploads/cmspage/'.$page->making_bonica_diamond_seed_icon) }}" alt="" ><span>{{$page->making_bonica_diamond_seed_title}}</span> </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="h-a-i-tab" data-bs-toggle="tab" data-bs-target="#h-a-i" href="#"><img src="{{ asset('uploads/cmspage/'.$page->making_bonica_heating_icon) }}" alt="" ><span> {{$page->making_bonica_heating_title}}</span> </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="t-p-c-tab" data-bs-toggle="tab" data-bs-target="#t-p-c" href="#"><img src="{{ asset('uploads/cmspage/'.$page->making_bonica_plasma_icon) }}" alt="" ><span> {{$page->making_bonica_plasma_title}}</span> </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="iia-tab" data-bs-toggle="tab" data-bs-target="#iia" href="#"><img src="{{ asset('uploads/cmspage/'.$page->making_bonica_all_diamonds_icon) }}" alt="" > <span>{{$page->making_bonica_all_diamonds_title}}</span> </a>
											</li>
										</ul>

										<div class="tab-content" id="tabContent">
											<div class="tab-pane text-start fade  show active" id="t-d-s" role="tabpanel" aria-labelledby="t-d-s-tab">
												{!!$page->making_bonica_diamond_seed_description !!}
											</div>
											<div class="tab-pane  text-start fade" id="h-a-i" role="tabpanel" aria-labelledby="h-a-i-tab">
												{!! $page->making_bonica_heating_description !!}
											</div>
											<div class="tab-pane text-start  fade" id="t-p-c" role="tabpanel" aria-labelledby="t-p-c-tab">
												{!! $page->making_bonica_plasma_description !!}
											</div>
											<div class="tab-pane  text-start fade" id="iia" role="tabpanel" aria-labelledby="iia-tab">
												{!! $page->making_bonica_all_diamonds_description !!}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
            @if (count($page->testimonials) > 0)
			<section class="section bg-cream">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 col-xl-8 m-auto">
							<div class="section-title  text-center ">
								<h2><span>BONICA TESTIMONIAL</span></h2>
							</div>
							<div class="testimonial-slider mt-4 mt-md-5">
                                @foreach ($page->testimonials as $testimonial)
								<div class="item">
									<div class="testimonial-slide">
										<div class="testimonial-img">
											<img src="{{ asset('uploads/testimonial/'.$testimonial->image) }}" alt="Image">
										</div>
										<div class="testimonial-info">
											<p>{!! $testimonial->content !!}</p>
											<p>- {{$testimonial->added_by}} <span class="text-small">{{ \Carbon\Carbon::parse($testimonial->created_at)->format('d M, Y') }} </span> </p>
										</div>
									</div>
								</div>
                                @endforeach
							</div>
						</div>
					</div>
				</div>
			</section>
            @endif
		</main>
		<!-- footer -->
		@include('frontend.layouts.footer')
    	@include('frontend.layouts.footerjs')
	</div>
@endsection
@push('js')
<script>

    $('.testimonial-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        infinite: true,
        prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-left"></i></div>',
        nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-right"></i></div>',
        arrows: false,
        speed: 500,
        fade: true,
        cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)'
// autoplay: true,
// autoplaySpeed: 3000,
//lazyLoad: 'ondemand'
});
</script>
@endpush

