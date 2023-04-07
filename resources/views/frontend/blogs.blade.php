@extends('frontend.layouts.layout')
@section('title', 'Blogs | Bonica Jewels')
@section('meta_description', "LATEST COLLECTION Lab Grown Diamonds Stunning selection and the option to choose from a wide range of diamondContinue Reading 'Bonica Jewels'")
@section('content')
<div class="blog-page">
	<!-- header -->
	@include('frontend.layouts.header')
		<!-- main -->
        <main>

			<section class="new-inner-banner-section" style="background-image:url({{ asset('images/banners/blog-banner.png') }}) ;" >
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-sm-12 col-md-12">
							<div class="inner-banner-info text-center text-md-start">
								<h2 class="text-white">Bonica Blog</h2>
							</div>
						</div>

					</div>
				</div>
			</section>
			<section class="section" >
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-md-12 col-xl-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb justify-content-center mb-0">
									<li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                    @if (Route::currentRouteName() == 'frontend.blogs')
                                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                                    @else
                                        <li class="breadcrumb-item"><a href="{{ route('frontend.blogs') }}">Blog</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{$category_name}}</li>
                                    @endif

								</ol>
							</nav>
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-md-12 col-lg-10 col-xl-10 m-auto">
							<ul class="blog-list-wrapper d-flex justify-content-center" id="blogfilterOptions">
                                @if (Route::currentRouteName() == 'frontend.blogs')
								<li class="active">
									<a href="{{ route('frontend.blogs') }}" class="all">
										All Blogs
									</a>
								</li>
                                @endif
                                @if (!empty($blogCategory))
                                @foreach ($blogCategory as $category)
                                    @if (count($category->blogs) > 0)
                                    <li>
                                        <a href="{{ route('frontend.categoryblog',['slug' => $category['slug']]) }}" class="category-general-inspiration">
                                            {{$category->name}}
                                        </a>
                                    </li>
                                    @endif
                                @endforeach
                                @endif
								{{-- <li>
									<a href="#"  class="category-general-lifestyle">
										General Lifestyle
									</a>
								</li>
								<li>
									<a href="#"   class="category-jewelry-knowledge">
										Jewelry Knowledge
									</a>
								</li>
								<li>
									<a href="#"  class="category-latest-post">
										Latest Post
									</a>
								</li> --}}
							</ul>
							<div  id="blogHolder">
                                @if(count($blogs) > 0)
                                @foreach ($blogs as $blog)
								<div class="item">
									<div class="blog-row d-flex align-items-center  mt-5">
										<div class="blog-image-wrapper @if($loop->even) order-md-2 @endif">
                                            @if($blog['image'])
											<img src="{{ file_exists(public_path('uploads/blog/'.$blog['image'])) ? asset('uploads/blog/'.$blog['image']) :  '' }} " alt="blog-image-1">
                                            @endif
										</div>
										<div class="blog-box-info-wrapper @if($loop->even) order-md-1  ms-auto @endif">
											<p><span class="blog-category">{{$blog['category']['name']}} </span> | <span class="blog-date">{{DateFormateDMY($blog['created_at'])}}</span> </p>
											<h5><a href="{{ route('frontend.blogdetail',['slug' => $blog['slug']]) }}" >{{$blog['title']}}</a></h5>
                                            @php
                                                $content = \Illuminate\Support\Str::limit($blog['content'], 350, $end='...');
                                                $content = mb_convert_encoding($content, "HTML-ENTITIES", 'UTF-8');
                                                $doc = new \DOMDocument();
                                                @$doc->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                                                $content = $doc->saveHTML();
                                            @endphp
                                            {!! $content !!}
											<a href="{{ route('frontend.blogdetail',['slug' => $blog['slug']]) }}" class="btn btn-primary btn-small">Discover >>></a>
										</div>
									</div>
								</div>
                                @endforeach
                                @else
                                No Blogs Available!
                                @endif
							</div>

						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
                            {{ $blogs->render("pagination::default") }}
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
@push('js')
<script>
     $('.pagination').addClass("mt-5 justify-content-center");
</script>
@endpush

