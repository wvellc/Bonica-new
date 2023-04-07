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

			<section class="section">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 text-center mb-5">
							<div class="section-title">
								<h2>{!!$page->title !!}</h2>
							</div>
						</div>
						<div class="col-md-12 col-xl-8 m-auto">
							<div class="row justify-content-between">
								<div class="col-md-6 col-xl-5 ">
                                    @if($page->member1_image)
                                    <img src="{{ file_exists(public_path('uploads/cmspage/'.$page->member1_image)) ? asset('uploads/cmspage/'.$page->member1_image) :  asset('images/no_image.png')  }} " class="w-100 mb-4" alt="Image">
                                    @else
                                    <img  src="{{ asset('images/no_image.png') }}" class="w-100 mb-4"  alt="product"/>
                                    @endif
									<h5>{{$page->member1_name}}</h5>
									<p>{{$page->member1_info}}</p>
								</div>
								<div class="col-md-6 col-xl-5 ">
                                    @if($page->member2_image)
                                    <img src="{{ file_exists(public_path('uploads/cmspage/'.$page->member2_image)) ? asset('uploads/cmspage/'.$page->member2_image) :  asset('images/no_image.png')  }} " class="w-100 mb-4" alt="Image">
                                    @else
                                    <img  src="{{ asset('images/no_image.png') }}" class="w-100 mb-4"  alt="product"/>
                                    @endif
									<h5>{{$page->member2_name}}</h5>
									<p>{{$page->member2_info}}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
            @if (count($page->teams) > 0)
			<section class="section ">
				<div class="container-fluid p-0">
					<div class="row align-items-center">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2>{!!$page->team_title !!}</h2>
							</div>

							<div class="team-slider d-flex">
                                @foreach ($page->teams as $team)
								<div class="item">
									<div class="team-box">
										<div class="team-img-box">
                                            @if($team->image)
                                            <img src="{{ file_exists(public_path('uploads/cmspage/'.$team->image)) ? asset('uploads/cmspage/'.$team->image) :  asset('images/no_image.png')  }} " class="w-100 " alt="Image">
                                            @else
                                            <img  src="{{ asset('images/no_image.png') }}" class="w-100 "  alt="product"/>
                                            @endif
										</div>
										<h5>{{$team->designation}}</h5>
										<p>{{$team->content}}</p>
									</div>
								</div>
                                @endforeach

							</div>
						</div>
					</div>

				</div>
			</section>
            @endif
            @if (count($page->milestones) > 0)
			<section class="section">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2>{!!$page->milestone_title !!}</h2>
							</div>
							<div class="demo-two">
								<div class="timeline">
                                    @foreach ($page->milestones as $milestone)
                                    @php
                                        $clsoddeven = ($loop->iteration % 2 != 0) ? 'right' : 'left' ;
                                        $clstext = ($loop->iteration % 2 != 0) ? 'text-start' : 'text-end' ;
                                    @endphp
                                    <div class="tl-container {{$clsoddeven}}">
                                        <div class="year-box {{$clstext}}">
                                            <h3>{{$milestone->year}}</h3>
                                        </div>
                                        <div class="date">
                                            @if($milestone->image)
                                            <img src="{{ file_exists(public_path('uploads/cmspage/'.$milestone->image)) ? asset('uploads/cmspage/'.$milestone->image) :  asset('images/img-not-available.png')  }} " class="w-100 " alt="Image">
                                            @else
                                            <img  src="{{ asset('images/img-not-available.png') }}" class="w-100 "  alt="Image"/>
                                            @endif
                                        </div>
                                        <i class="icon">
                                            @if($milestone->icon)
                                            <img src="{{ file_exists(public_path('uploads/cmspage/'.$milestone->icon)) ? asset('uploads/cmspage/'.$milestone->icon) :  asset('images/default-img.png')  }} " class="w-100 " alt="Image">
                                            @else
                                            <img  src="{{ asset('images/default-img.png') }}" class="w-100 "  alt="Image"/>
                                            @endif
                                        </i>
                                        <div class="content">
                                            <p>{{$milestone->content}}</p>
                                        </div>
                                    </div>
                                    @endforeach
								</div>
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
   $('.team-slider').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			dots: false,
			centerMode:true,
			infinite: true,
			prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-left"></i></div>',
			nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-right"></i></div>',
			arrows: true,
			autoplay: true,
			autoplaySpeed: 3000,
			responsive: [
			{
			breakpoint: 1300,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 1,
				infinite: true
			}
		},
		{
			breakpoint: 991,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 768,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 479,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				dots:false
			}
		}
		]
		});
</script>
@endpush

