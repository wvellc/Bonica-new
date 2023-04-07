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
								<h2>{!!$page->sustainability_title !!}</h2>
								<p class="subtitle">{{$page->sustainability_sub_title}}</p>
							</div>
						</div>
					</div>
                    @if($page->sustainability_image || $page->sustainability_content)
					<div class="row align-items-center justify-content-between mt-4 mt-md-5">
                        @if ($page->sustainability_image)
						<div class="col-md-6 col-xl-5 text-center order-1 order-md-2 ">
							<div class="mb-4 mb-md-0">
								<img src="{{ asset('uploads/cmspage/'.$page->sustainability_image) }}" alt="Image">
							</div>
						</div>
                        @endif
                        @if ($page->sustainability_content)
                        @php
                            $cls_sustainability_content = ($page->sustainability_image) ? 'col-md-6 col-xl-6 order-2 order-md-1' : 'col-md-12 col-xl-12 order-2 order-md-1';
                        @endphp
						<div class="{{$cls_sustainability_content}}">
							<div class="story-info">
                                {!!$page->sustainability_content !!}
							</div>
						</div>
                        @endif
					</div>
                    @endif
					<div class="row align-items-center  mt-4 mt-md-5">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2>{!!$page->mining_free_process_title !!}</h2>
							</div>
						</div>
					</div>
                    @if($page->mining_free_process_image || $page->mining_free_process_content)
					<div class="row align-items-center justify-content-between mt-4 mt-md-5">
                        @if ($page->mining_free_process_image)
						<div class="col-md-6 col-xl-5 text-center ">
							<div class="mb-4 mb-md-0">
								<img src="{{ asset('uploads/cmspage/'.$page->mining_free_process_image) }}" alt="Image">
							</div>
						</div>
                        @endif
                        @if ($page->mining_free_process_content)
                        @php
                        $mining_free_process_content = ($page->mining_free_process_image) ? 'col-md-6 col-xl-6' : 'col-md-12 col-xl-12';
                        @endphp
						<div class="{{$mining_free_process_content}}">
							<div class="story-info">
                                {!!$page->mining_free_process_content !!}
							</div>
						</div>
                        @endif
					</div>
                    @endif
				</div>
			</section>
			<section class="section bg-cream">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2>{!!$page->mining_free_title !!}</h2>
								<p class="subtitle">{{$page->mining_free_sub_title}}</p>
							</div>
						</div>
						<div class="col-md-12 col-lg-9 m-auto ">
							<div class="row align-items-center justify-content-center mt-4 mt-md-5">
                                @if ($page->mining_free_image_1)
								<div class="col-md-6 col-xl-4">
									<img src="{{ asset('uploads/cmspage/'.$page->mining_free_image_1) }}" alt="" class="w-100 mb-3">
								</div>
                                @endif
                                @if ($page->mining_free_image_2)
								<div class="col-md-6 col-xl-4">
									<img src="{{ asset('uploads/cmspage/'.$page->mining_free_image_2) }}" alt="" class="w-100 mb-3">
								</div>
                                @endif
                                @if ($page->mining_free_image_3)
								<div class="col-md-6 col-xl-4">
									<img src="{{ asset('uploads/cmspage/'.$page->mining_free_image_3) }}" alt="" class="w-100 mb-3">
								</div>
                                @endif
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
{{-- @push('js')
<script>

</script>
@endpush
 --}}
