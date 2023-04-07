@extends('frontend.layouts.layout')
@section('title', $blog->meta_title )
@section('meta_keywords', $blog->meta_keywords)
@section('meta_description', $blog->meta_description)
@section('content')
<div class="blog-page">
    <!-- header -->
    @include('frontend.layouts.header')
    <!-- main -->
    <main>

        <section class="new-inner-banner-section"
            style="background-image:url({{ asset('images/banners/blog-banner.png') }}) ;">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-12 col-md-12">
                        <!-- <div class="inner-banner-info text-center text-md-start">
								<h2 class="text-white">Bonica Blog</h2>
							</div> -->
                    </div>

                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-12 col-xl-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('frontend.blogs') }}">Blogs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 col-xl-12 ">
                        <div class="blog-row  align-items-center  pe-xl-5">
                            <div class="blog-box-info-wrapper mw-100 blog-box-inner-info-wrapper">
                                <p><span class="blog-category">{{$blog['category']['name']}} </span> | <span
                                        class="blog-date">{{DateFormateDMY($blog['created_at'])}}</span> </p>
                                <p class="mb-3"><b>by {{$blog['admin']['name']}}</b></p>
                                <h5>{{$blog['title']}}</h5>
                                <div class="blogcontent">
                                    {!! $blog['content'] !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(!empty($blogLists))
        <section class="section blog-section pt-0">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-12 text-center ">
                        <div class="section-title">
                            <h2>You May Also <span> Like</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center blogs-slider-row">
                    <div class="col-md-12 text-center text-lg-start ">
                        <div class="blogs-slider-1 mt-4">
                            @foreach ($blogLists as $blog)
                            <div class="item">
                                <a href="{{ route('frontend.blogdetail',['slug' => $blog['slug']]) }}"
                                    class="blogs-item-wrapper">
                                    @if($blog['image'])
                                    <div class="blogs-slider-image-box mb-4">
                                        <img src="{{ file_exists(public_path('uploads/blog/'.$blog['image'])) ? asset('uploads/blog/'.$blog['image']) :  '' }} "
                                            alt="blog">
                                    </div>
                                    @endif
                                    <h3>{{$blog['title']}}</h3>
                                    <p class="link-read-more">READ MORE</p>
                                </a>
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
