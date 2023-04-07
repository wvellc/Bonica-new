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
			<section class="section pb-0">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2>{!!$page->page_title !!}</h2>
							</div>
							<div class="size-g-tabs-wrapper">
								<div class="row justify-content-center ">
									<div class="col-12">
										<ul class="nav justify-content-center align-items-end">
											<li class="nav-item">
												<a class="nav-link active" id="rings-tab" data-bs-toggle="tab" data-bs-target="#rings" href="#">Rings </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="bracelets-tab" data-bs-toggle="tab" data-bs-target="#bracelets" href="#">Bracelets </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="necklaces-tab" data-bs-toggle="tab" data-bs-target="#necklaces" href="#">Necklaces </a>
											</li>

										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="section pt-0">
				<div class="container-fluid p-0">
					<div class="size-g-tabs-wrapper">
						<div class="tab-content" id="tabContent">
							<div class="tab-pane text-start fade  show active" id="rings" role="tabpanel" aria-labelledby="rings-tab">

								<div class="container">
									<div class="row mb-4">
										<div class="col-md-12">
											<div class="text-center text-md-end">

												<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ringsizemodal">Ring Size Guide</a>
											</div>
										</div>
										<div class="col-xl-11 m-auto text-center">
											<div class="text-center mt-4">
												<h4>{{$page->rings_title}}</h4>
                                                <p>{!!$page->rings_content1 !!}</p>
											</div>
										</div>
									</div>
								</div>
								<section class=" bg-cream mb-4">
									<div class="container-fluid ps-0">
										<div class="row align-items-center justify-content-between ">
                                            @if ($page->measurement_image)
                                            <div class="col-lg-1 col-4">
                                                <img src="{{ asset('uploads/cmspage/'.$page->measurement_image) }}" alt="Image">
											</div>
                                            @endif
                                            @if ($page->diamond_skeleton_image)
                                            <div class="col-lg-3 col-8 col-md-6 mb-3 mb-lg-0 text-center">
                                                <img src="{{ asset('uploads/cmspage/'.$page->diamond_skeleton_image) }}" alt="Image">
											</div>
                                            @endif

											<div class="col-lg-8  text-center">
												<div class="row justify-content-center align-items-center ring-hand-mode">

                                                    @if ($page->step1_image)
                                                    <div class="col-md-6  mb-3 mb-lg-0 text-center">
                                                        <img src="{{ asset('uploads/cmspage/'.$page->step1_image) }}" alt="Image">
                                                    </div>
                                                    @endif

                                                    @if ($page->step2_image)
                                                    <div class="col-md-6  mb-3 mb-lg-0 text-center">
                                                        <img src="{{ asset('uploads/cmspage/'.$page->step2_image) }}" alt="Image">
                                                    </div>
                                                    @endif

												</div>

											</div>

										</div>
									</div>

								</section>
								<div class="container">
									<div class="row mb-4">
										<div class="col-lg-8 col-xl-7 m-auto text-center">
											<p>{!!$page->rings_content2 !!}</p>
										</div>
									</div>

                                    @if (count($page->rings) > 0)
									<div class="row">
										<div class="col-md-12 col-xl-8 m-auto">
											<div class="row">
                                                @foreach ($page->rings as $ring)
                                                @if ($ring['image'])
                                                <div class="col-sm-12 col-md-6 mb-3 mb-lg-4">
                                                    @if ($ring['product_url'])
                                                        <a href="{{$ring['product_url']}}" class="d-block" target="_blank">
                                                            <img src="{{ asset('uploads/cmspage/'.$ring['image']) }}" alt="" class="w-100">
                                                        </a>
                                                    @else
                                                        <img src="{{ asset('uploads/cmspage/'.$ring['image']) }}" alt="" class="w-100">
                                                    @endif
                                                </div>
                                                @endif
                                                @endforeach
											</div>
										</div>
									</div>
                                    @endif
								</div>
							</div>
							<div class="tab-pane  text-start fade" id="bracelets" role="tabpanel" aria-labelledby="bracelets-tab">
								<div class="container">
									<div class="row mb-4">
										<div class="col-xl-11 m-auto text-center">
											<div class="text-center mt-4">
												<h4>{{$page->bracelets_title}}</h4>
												<p>{!!$page->bracelets_content1 !!}</p>
											</div>
										</div>
									</div>
								</div>

								<section class="section bg-cream mb-4">
									<div class="container">
										<div class="row align-items-center justify-content-between ">
                                            @if ($page->diameter_skeleton_image)
                                            <div class="col-lg-6 col-md-6 mb-3 mb-lg-4 text-center">
                                                <img src="{{ asset('uploads/cmspage/'.$page->diameter_skeleton_image) }}" alt="Image">
											</div>
                                            @endif

                                            @if ($page->bracelets_image)
                                            <div class="col-lg-6 col-md-6 mb-3 mb-lg-4 text-center">
                                                <img src="{{ asset('uploads/cmspage/'.$page->bracelets_image) }}" alt="Image">
											</div>
                                            @endif
										</div>
									</div>

								</section>
								<div class="container">
									<div class="row mb-4">
										<div class="col-lg-8 col-xl-6 m-auto ">
                                            @include('frontend.braceletssizes')
											<p>{!!$page->bracelets_content2 !!}</p>
										</div>
									</div>
                                    @if (count($page->bracelets) > 0)
									<div class="row ">
										<div class="col-md-12 col-xl-8 m-auto">
											<div class="row ">
                                                @foreach ($page->bracelets as $bracelet)
                                                @if ($bracelet)
                                                <div class="col-sm-12 col-md-6 mb-3 mb-lg-4">
                                                    <img src="{{ asset('uploads/cmspage/'.$bracelet) }}" alt="" class="w-100">
                                                </div>
                                                @endif
                                                @endforeach
											</div>
										</div>
									</div>
                                    @endif
								</div>
							</div>
							<div class="tab-pane text-start  fade" id="necklaces" role="tabpanel" aria-labelledby="necklaces-tab">

								<div class="container">
									<div class="row mb-4 align-items-center">
                                        @if ($page->necklaces_image)

                                            <div class="col-lg-6 col-xl-6">
                                                <div class=" text-center">
                                                    <img src="{{ asset('uploads/cmspage/'.$page->necklaces_image) }}" alt="Image">
                                                </div>
                                            </div>
                                        @endif

										<div class="col-lg-6  col-xl-6 ">
                                            @include('frontend.necklacesizes')
											<p>{!!$page->necklaces_content !!}</p>
										</div>
									</div>
                                    @if (count($page->necklaces) > 0)
									<div class="row ">
										<div class="col-md-12 col-xl-8 m-auto">
											<div class="row ">
                                                @foreach ($page->necklaces as $necklace)
                                                @if ($necklace)
                                                <div class="col-sm-12 col-md-6 mb-3 mb-lg-4">
                                                    <img src="{{ asset('uploads/cmspage/'.$necklace) }}" alt="" class="w-100">
                                                </div>
                                                @endif
                                                @endforeach
											</div>
										</div>
									</div>
                                    @endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
        <!--ringsize Modal -->
<div class="modal rightmodal ringsizemodal p-0" id="ringsizemodal" data-bs-backdrop="true" data-bs-keyboard="true" tabindex="-1" aria-labelledby="ringsizemodalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header pb-0 border-0" style="height: 40px;">
				<!-- <h5 class="modal-title" id="ringsizemodalLabel">ringsize Similar</h5> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                @include('frontend.products.ringsizes')
			</div>
		</div>
	</div>
</div>
		<!-- footer -->
		@include('frontend.layouts.footer')
    	@include('frontend.layouts.footerjs')
	</div>
@endsection
@push('js')
<script>
    var option = '{{request()->segment(3)}}';
    $('#rings-tab').removeClass('active')
    $('#rings').removeClass('active show');
    $('#necklaces-tab').removeClass('active')
    $('#necklaces').removeClass('active show');

    $('#bracelets-tab').removeClass('active')
    $('#bracelets').removeClass('active show');

    if(option == 'pendants' || option == 'necklaces'){
        $('#necklaces-tab').addClass('active');
        $('#necklaces').addClass('active show');
    }
    else if (option == 'bracelets')
    {
        $('#bracelets-tab').addClass('active');
        $('#bracelets').addClass('active show');
    }
    else{
        $('#rings-tab').addClass('active');
        $('#rings').addClass('active show');
    }

   $('.team-slider').slick({
			slidesToShow: 4,
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

