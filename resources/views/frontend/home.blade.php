@extends('frontend.layouts.layout')
@section('title', 'Sustainable Diamonds - 100% Original - Bonica Jewelry')
@section('meta_description', "100% real, ethically sourced, sustainable CVD diamonds for your next jewelry shopping
plan. Made with real diamond seed, grown with precision and care")
@section('content')
<div class="home-page">
    <!-- header -->
    @include('frontend.layouts.header')
    <!-- main -->
    <main>
        <style>
            video {
                height: 100vh;
                width: 100%;
                object-fit: cover; 
                position: absolute;
            }
        </style>
        @if($home_page->status)
        <section class="home-hero-banner---">
            @if ($home_page->banner_type)
            @if (Storage::disk('s3')->exists($home_page->video))
            <div class="video-banner-wrapper">
                <div class="bg-video-wrap">
                    <video src="{{$home_page->video_path}}" loop muted autoplay>
                    </video>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-xl-6">
                            <div class="hero-banner-info">
                                <h2>{!! $home_page->video_title !!}</h2>
                                <p>{!! $home_page->video_content !!}</p>
                                @if ($home_page->video_link)
                                <div class="banner-btn-wrapper mt-4">
                                    <a href="{{$home_page->video_link}}" target="_blank"
                                        class="btn btn-primary btn-xl-large">Explore Jewelry <i
                                            class="far fa-angle-right ms-3"></i> </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @else
            @if(!empty($sliderImage))
            <div class="image-banner-wrapper">
                <ul class="image-banner-slider">
                    @foreach($sliderImage as $value)
                    <li class="item">
                        @if($value['image'])
                        <img src="{{ file_exists(public_path('uploads/homepage/'.$value['image'])) ? asset('uploads/homepage/'.$value['image']) :  '' }}"
                            alt="" loading="lazy" class="d-none d-md-block" />
                        <img src="{{ asset('images/product-banner-1.png') }}" loading="lazy" alt="" class="d-block d-md-none" />
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            @endif
        </section>
        @endif
        
        <section class="our-story-section common-section">
            <div class="container">
                <div class="inner-container d-flex justify-content-between align-items-center">
                    <div class="left-content-box">
                        <div class="section-title">
                            <h2>{!! $home_page->fisrt_our_story_title !!}</h2>                        
                        </div>
                        <p>{!! $home_page->fisrt_our_story_content   !!}</p>
                        @if ($home_page->fisrt_our_story_link)
                            <a href="{{ $home_page->fisrt_our_story_link }}" target="_blank" class="btn btn-primary"><span>Read More</span></a>
                        @endif
                    </div>
                    @if ($home_page->our_story_image1)
                    <div class="right-img-box">
                        <img src="{{ asset('uploads/homepage/'.$home_page->our_story_image1) }}" loading="lazy" alt="Image">
                    </div>
                    @endif

                </div>
            </div>           
        </section>

        <section class="section pt-0">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-12 col-xl-7 m-auto text-center ">
                        <div class="section-title mt-4">
                            <h2>{!! $home_page->shringaar_title !!}</h2>
                        </div>

                        <p class="subtitle">{{$home_page->shringaar_sub_title }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="gallery-section">
            <!-- <div class="fixed-bar" style="opacity: 0;">
                        <label>Turn off fixed background attachment<input type="checkbox" id="turn-off" checked /></label>
                    </div> -->
            <div class="body-wrapper">
                @if ($home_page->shringaar_image1)

                <a href="{{$home_page->shringaar_image1_link}}" target="_blank" class="first background-div"
                    id="large-image-one"
                    style="background-image: url({{ env('CLOUDFRONTURL').'homepage/'.$home_page->shringaar_image1 }})">
                    <div class="caption-header">
                        <h2>{{$home_page->shringaar_image1_title }}</h2>
                    </div>
                </a>
                @endif

                <div class="wrapper">
                    @if ($home_page->shringaar_image2)
                    <a href="{{$home_page->shringaar_image2_link}}" target="_blank"
                        class="background-wrapper background-div" id="second-image"
                        style="background-image: url({{ env('CLOUDFRONTURL').'homepage/'.$home_page->shringaar_image2 }})">
                        <div class="caption-header">
                            <h2>{{$home_page->shringaar_image2_title }}</h2>
                        </div>
                    </a>
                    @endif
                    @if ($home_page->shringaar_image3)
                    <a href="{{$home_page->shringaar_image3_link}}" target="_blank"
                        class="background-wrapper background-div" id="third-image"
                        style="background-image: url({{ env('CLOUDFRONTURL').'homepage/'.$home_page->shringaar_image3 }})">
                        <div class="caption-header">
                            <h2>{{$home_page->shringaar_image3_title }}</h2>
                        </div>
                    </a>
                    @endif
                </div>
                <div class="wrapper">
                    @if ($home_page->shringaar_image4)
                    <a href="{{$home_page->shringaar_image4_link}}" target="_blank"
                        class="background-wrapper background-div" id="fourth-image"
                        style="background-image: url({{ env('CLOUDFRONTURL').'homepage/'.$home_page->shringaar_image4 }})">
                        <div class="caption-header">
                            <h2>{{$home_page->shringaar_image4_title }}</h2>
                        </div>
                    </a>
                    @endif
                    @if ($home_page->shringaar_image5)
                    <a href="{{$home_page->shringaar_image5_link}}" target="_blank"
                        class="background-wrapper background-div" id="fifth-image"
                        style="background-image: url({{ env('CLOUDFRONTURL').'homepage/'.$home_page->shringaar_image5 }})">
                        <div class="caption-header">
                            <h2>{{$home_page->shringaar_image5_title }}</h2>
                        </div>
                    </a>
                    @endif
                </div>
                @if ($home_page->shringaar_image6)
                <a href="{{$home_page->shringaar_image6_link}}" target="_blank" class="last background-div"
                    id="large-image-two"
                    style="background-image: url({{ env('CLOUDFRONTURL').'homepage/'.$home_page->shringaar_image6 }})">
                    <div class="caption-header">
                        <h2>{{$home_page->shringaar_image6_title }}</h2>
                    </div>
                </a>
                @endif
            </div>
        </section>
        @if(!empty($homecategories))
        <section class="section jewelry-section">
            <div class="custom-container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-12 text-center ">
                        <div class="section-title">
                            <h2>{!! $home_page->catalog_title !!}</h2>
                            <p>{{$home_page->catalog_sub_title}}</p>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center products-slider-row">
                    <div class="col-md-12 text-center ">
                        <div class="products-slider-1 mt-4">
                            @foreach($homecategories as $category)
                            <div class="item">
                                <a
                                    href="{{ route('frontend.show_category_product', ['category' => $category['slug']]) }}">
                                    <div class="products-slider-image-box">
                                        @if($category->image)
                                        <img src="{{ file_exists(public_path('uploads/category/'.$category->image)) ? asset('uploads/category/'.$category->image) :  asset('images/no_image.png')  }} "
                                            alt="product" loading="lazy">
                                        @else
                                            <img src="{{ asset('images/no_image.png') }}" alt="product" loading="lazy" />
                                        @endif
                                    </div>
                                    <h4>{{$category->name}}</h4>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </section>
        @endif
        <section class="our-story-section common-section">
            <div class="container">
                <div class="inner-container d-flex justify-content-between align-items-center">
                    @if ($home_page->our_story_image2)
                    <div class="right-img-box">
                        <img src="{{ asset('uploads/homepage/'.$home_page->our_story_image2) }}" loading="lazy" alt="Image">
                    </div>
                    @endif
                    <!-- <div class="left-content-box">
                        <div class="section-title">
                            <h2>{!! $home_page->second_our_story_title !!}</h2>
                            <p>{!! $home_page->second_our_story_content   !!}</p>
                            @if ($home_page->second_our_story_link)
                                <a href="{{ $home_page->second_our_story_link }}" target="_blank" class="btn btn-primary"><span>Read More</span></a>
                            @endif
                        </div>
                    </div> -->
                    <div class="left-content-box">
                        <div class="section-title">
                            <h2>{!! $home_page->second_our_story_title !!}</h2>                        
                        </div>
                        <p>{!! $home_page->second_our_story_content   !!}</p>
                        @if ($home_page->second_our_story_link)
                            <a href="{{ $home_page->second_our_story_link }}" target="_blank" class="btn btn-primary"><span>Read More</span></a>
                        @endif
                    </div>                   
                </div>
            </div>           
        </section>
        @if(count($recommendedProducts) > 0)
        <section class="section offer-section">
            <div class="custom-container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-12 text-center ">
                        <div class="section-title">
                            <h2>{!! $home_page->recommended_title !!}</h2>
                            <p>{{$home_page->recommended_sub_title}}</p>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center products-slider-row">
                    <div class="col-md-12 text-center ">
                        <div class="products-slider-2 mt-4">
                            @foreach($recommendedProducts as $recommendedProduct)
                            @php
                                if($recommendedProduct->subcategory){
                                $product_url = route('frontend.product_detail', ['category' => $recommendedProduct->category->slug,'subcategory' =>
                                $recommendedProduct->subcategory->slug,'product' => $recommendedProduct->slug]);
                                }
                                else if($recommendedProduct->category){
                                $product_url = route('frontend.show_sub_category_product', ['category' => $recommendedProduct->category->slug,'subcategory'
                                => $recommendedProduct->slug]);
                                }
                            @endphp
                                <div class="item">
                                    <a href="{{$product_url}}">
                                        <div class="products-slider-image-box">
                                            @if ($recommendedProduct->singleProductImages)
                                            <img src="{{ $recommendedProduct->singleProductImages['image_path'] }}" alt="Image" loading="lazy"/>
                                            @else
                                            <img src="{{ asset('images/no_image.png') }}" alt="Image"/>
                                            @endif
                                            @if($recommendedProduct->recommended_hover_image)
                                            <div class="on-hover-product-img-wrapper">
                                                <img src="{{ asset('uploads/product/'.$recommendedProduct->recommended_hover_image) }}" alt="product" class="back-image" loading="lazy"/>
                                                <span class="overlay"></span>
                                            </div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <section class="section about-section"
            style="background-image: url( asset('uploads/homepage/'.$home_page->about_bonica_bg_image))">
            <div class="container">
                <div class="row align-items-center ">
                    <div class="col-md-8  col-xl-6 text-left ">
                        <div class="about-info">
                            <div class="section-title">
                                <h2>{!! $home_page->about_bonica_title !!}</h2>
                            </div>
                            <p>{!! $home_page->about_bonica_content !!}</p>
                            <!-- <div class="btn-animate-wrapper btn-white">
                                        <a href="#" class="btn btn-animate"><span>Read More</span></a>
                                    </div> -->
                            @if ($home_page->about_bonica_link)
                            <div class="mt-4">
                                <a href="{{ $home_page->about_bonica_link }}" target="_blank"
                                    class="btn btn-primary"><span>Our Story</span></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(!empty($blogLists))
        <section class="section blog-section">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-12 text-center ">
                        <div class="section-title">
                            <h2>The <span>BLOG</span></h2>
                            <p>Our 2 Cents</p>
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
                                            alt="blog" loading="lazy">
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
