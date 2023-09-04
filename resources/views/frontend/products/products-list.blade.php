@extends('frontend.layouts.layout')
@section('title', $category->meta_title )
@section('meta_keywords', $category->meta_keywords)
@section('meta_description', $category->meta_description)
@section('content')
    <div class="full-page-overlay"></div>
    <div class="product-list-page">
        <!-- header -->
        @include('frontend.layouts.header')
        <!-- main -->
        @php
            $catSegment =  Request::segment(2);
            $subCategorySegment = '';
            if(Request::segment(3)){
                $subCategorySegment =  Request::segment(3);
            }

        @endphp
        <main>
            <section class="inner-banner-section" style="background-image:url({{ asset($category_banner_image) }}) ;">
                <input type="hidden" name="loader" id="loader" value="1">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-sm-12 col-md-6 col-xl-4 order-2 order-md-1">
                            <div class="inner-banner-info text-center text-md-start">
                                <h2>{{ $category['name'] }}</h2>
                                <h4 class="text-capitalize">{{ $category_description }}</h4>
                            </div>
                        </div>
                        <!-- <div class="col-sm-12 col-md-6  order-1 order-md-2">
               <div class="inner-banner-img text-center text-md-end me-auto ms-md-auto">
                <img src="assets/images/banners/inner-banner-image.png" alt="">
               </div>
              </div> -->
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
                                        <li class="breadcrumb-item @if ($is_parent_category) active @endif"
                                            aria-current="page">
                                            @if ($is_parent_category)
                                                {{ $category['name'] }}
                                            @else
                                                <a href="{{route('frontend.show_category_product', ['category' => $category->parent->slug])}}">{{ $category->parent->name}}</a>
                                            @endif
                                        </li>
                                        @if (!$is_parent_category)
                                            <li class="breadcrumb-item active" aria-current="page">{{ $category['name'] }}</li>
                                        @endif
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-12 col-xl-12">
                                <div
                                    class="filter-mobile-title my-3 d-flex align-items-center justify-content-between d-md-none text-end">
                                    <p class="p-0">Items - <span class="total_products"></span></p>
                                    <p class="filter-toggle ">Filter <img src="{{ asset('images/icons/filter.svg') }}"
                                            alt="filter" class="ms-2" /> </p>
                                </div>
                                <div class="filter-section  align-items-center justify-content-between flex-wrap my-4">
                                    <ul class="filter-list d-flex align-items-center  flex-wrap ">
                                        <li class="d-none d-md-block me-3">
                                            Filter
                                        </li>
                                        @if (count($metals) > 0)
                                        <li>
                                            <div class="btn-group  me-3">
                                                <button type="button" class="btn btn-filetr dropdown-toggle"
                                                    data-bs-toggle="dropdown" data-bs-display="static"
                                                    aria-expanded="false">
                                                    Metal
                                                </button>
                                                <ul class="metal-dropdown-menu dropdown-menu dropdown-menu-end dropdown-menu-lg-start" id="metal">
                                                    @foreach ($metals as $metal)
                                                     <li ><a  class="dropdown-item metal" value="{{$metal->id}}" id="metal_{{$metal->id}}" href="javascript:void(0)"><span class="color-gold" style="background-color:{{$metal->bgcolor}};"></span> {{$metal->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        @endif
                                        @if (count($materials) > 0)
                                        <li>
                                            <div class="btn-group me-3">
                                                <button type="button" class="btn btn-filetr dropdown-toggle"
                                                    data-bs-toggle="dropdown" data-bs-display="static"
                                                    aria-expanded="false">
                                                    Gold Karat
                                                </button>
                                                <ul class="material-dropdown-menu dropdown-menu dropdown-menu-end dropdown-menu-lg-start" id="material">
                                                    @foreach ($materials as $material)
                                                    <li><a class="dropdown-item material" value="{{$material->id}}" id="material_{{$material->id}}" href="javascript:void(0)">{{$material->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </li>
                                        @endif
                                        <li>
                                            <div class="btn-group me-3">
                                                <button type="button" class="btn btn-filetr dropdown-toggle"
                                                    data-bs-toggle="dropdown" data-bs-display="static"
                                                    aria-expanded="false">
                                                    Gender
                                                </button>
                                                <ul class="gender-dropdown-menu dropdown-menu dropdown-menu-end dropdown-menu-lg-start" id="gender">
                                                    <li><a class="dropdown-item gender" value="1" id="gender_1" href="javascript:void(0)">Men</a></li>
                                                    <li><a class="dropdown-item gender" value="2" id="gender_2" href="javascript:void(0)">Women</a></li>
                                                </ul>
                                            </div>

                                        </li>
                                        <li class="d-none d-md-block">
                                            <a href="javascript:void(0)" class="reset-text" id="filter_reset">Reset</a>
                                        </li>
                                    </ul>
                                    <ul class="filter-list d-flex align-items-center flex-wrap ">
                                        <li class="d-none d-md-block me-3">
                                            <a href="#">Items - <span class="total_products"></span></a>
                                        </li>
                                        <li>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-filetr dropdown-toggle"
                                                    data-bs-toggle="dropdown" data-bs-display="static"
                                                    aria-expanded="false">
                                                    Sort Type
                                                </button>
                                                <ul class="sorting-dropdown-menu dropdown-menu dropdown-menu-end" id="sorting">
                                                    <li><a class="dropdown-item sorting" value="recommended" id="sorting_recommended" href="javascript:void(0)">Recommended</a></li>
                                                    {{-- <li><a class="dropdown-item sorting" value="best_selling" id="sorting_best_selling" href="javascript:void(0)">Best Selling</a></li> --}}
                                                    <li><a class="dropdown-item sorting" value="new" id="sorting_new" href="javascript:void(0)">New</a></li>
                                                    <li><a class="dropdown-item sorting" value="price_high_to_low" id="sorting_price_high_to_low" href="javascript:void(0)">Price High to low</a></li>
                                                    <li><a class="dropdown-item sorting" value="price_low_to_high" id="sorting_price_low_to_high" href="javascript:void(0)">Price Low to High</a></li>
                                                </ul>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-12 col-xl-12">
                                <div class="main-prodcut-box-wrapper" id="prodcut-box"></div>
                            </div>
                        </div>
                        <div class="col-3" style="padding-left:50%;padding-top:10px;">
                        <div class="snippet" data-title="dot-flashing">
                            <div class="stage">
                                <div class="dot-flashing"></div>
                            </div>
                        </div>
                    </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="text-center mt-5">
                                    <a href="javascript:void(0)" class="btn btn-outline-primary load-more">LOAD MORE</a>
                                </div>
                            </div>
                        </div> --}}
                </div>
            </section>

        </main>
        <!--Discover Modal -->
        <div class="modal rightmodal discovermodal p-0" id="discovermodal" data-bs-backdrop="true"
            data-bs-keyboard="true" tabindex="-1" aria-labelledby="discovermodalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header pb-0 border-0">
                        <h5 class="modal-title" id="discovermodalLabel">Discover Similar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-between" id="discover_product">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Discover Modal -->
        <div class="modal rightmodal shopthelook p-0" id="shopthelook" data-bs-backdrop="true"
            data-bs-keyboard="true" tabindex="-1" aria-labelledby="shopthelookmodalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header pb-0 border-0">
                        <h5 class="modal-title" id="shopthelookmodalLabel">Shop The Look Similar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-between" id="shopthelook_product">
                        </div>
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
        var isLoading = false;  
        $('.dot-flashing').hide();
        var page = 1;
        $(function() {

            $('.metal-dropdown-menu li').click(function(e) {
                e.preventDefault();
                $('.metal').removeClass("active");
                $('#prodcut-box').html('');
                var id = $(this).find('a').attr('value');
                $("#metal_"+id).addClass("active");
                page = 1;
                gatData(page);
            });
            $('.material-dropdown-menu li').click(function(e) {
                e.preventDefault();
                $('.material').removeClass("active");
                $('#prodcut-box').html('');
                var id = $(this).find('a').attr('value');
                $("#material_"+id).addClass("active");
                page = 1;
                gatData(page);
            });
            $('.gender-dropdown-menu li').click(function(e) {
                e.preventDefault();
                $('.gender').removeClass("active");
                $('#prodcut-box').html('');
                var id = $(this).find('a').attr('value');
                $("#gender_"+id).addClass("active");
                page = 1;
                gatData(page);
            });
            $('#filter_reset').click(function(e) {
                e.preventDefault();
                $('#prodcut-box').html('');
                $('.metal').removeClass("active");
                $('.material').removeClass("active");
                $('.gender').removeClass("active");
                gatData(page);
            });


            $('.sorting-dropdown-menu li').click(function(e) {
                e.preventDefault();
                $('.sorting').removeClass("active");
                $('#prodcut-box').html('');
                var id = $(this).find('a').attr('value');
                $("#sorting_"+id).addClass("active");
                page = 1;
                gatData(page);
            });


            /* $(".product-col .pl-product-box-wrapper").slice(0, 12).show();
            $("body").on('click touchstart', '.load-more', function(e) {
                e.preventDefault();

                $(".product-col .pl-product-box-wrapper:hidden").slice(0, 4).slideDown();
                if ($(".product-col .pl-product-box-wrapper:hidden").length == 0) {
                    $(".load-more").css('visibility', 'hidden');
                }
                $('.pl-pro-image-box-slider-wrapper').slick('refresh');

                // $('html,body').animate({
                // 	scrollTop: $(this).offset().top
                // }, 5000);
            }); */
            gatData(page);
        });
        /* $(".btn-discovermodal").click(function() {
            $('.pl-pro-image-box-slider-wrapper').slick('refresh');
        }); */

        function getDiscoverProduct()
        {
            var url = '{!! route("frontend.get-discover-product") !!}';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    category_id: '{{$category['id']}}',
                    cat_segment : '{{$catSegment}}',
                    subcategory_segment : '{{$subCategorySegment}}'
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $("#div_load_more").html('<img src="{{asset('images/spinner.gif')}}" alt="spinner"/>');
                },
                complete: function(){
                    //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                },
                success: function (data) {
                    if(data.msg == 'success'){
                        $('#discovermodal').modal('show');
                        $('#discover_product').html(data.ProductData_Html);
                        $('.pl-pro-image-box-slider-wrapper').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false,
                            infinite: true,
                            prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-left"></i></div>',
                            nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-right"></i></div>',
                            arrows: true,
                            speed: 500,
                            fade: true,
                            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)'
                            // autoplay: true,
                            // autoplaySpeed: 3000,
                            //lazyLoad: 'ondemand'
                        });
                    }
                },
                error:function (response) {
                    //$('#error_rating').html(response.responseJSON.errors.rating);

                }
            });
        }
        function getShopthelookProduct()
        {
            var url = '{!! route("frontend.get-shopthelook-product") !!}';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    category_id: '{{$category['id']}}',
                    cat_segment : '{{$catSegment}}',
                    subcategory_segment : '{{$subCategorySegment}}'
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $("#div_load_more").html('<img src="{{asset('images/spinner.gif')}}" alt="spinner"/>');
                },
                complete: function(){
                    //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                },
                success: function (data) {
                    if(data.msg == 'success'){
                        $('#shopthelook').modal('show');
                        $('#shopthelook_product').html(data.ProductData_Html);
                        $('.pl-pro-image-box-slider-wrapper').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false,
                            infinite: true,
                            prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-left"></i></div>',
                            nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-right"></i></div>',
                            arrows: true,
                            speed: 500,
                            fade: true,
                            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)'
                            // autoplay: true,
                            // autoplaySpeed: 3000,
                            //lazyLoad: 'ondemand'
                        });
                    }
                },
                error:function (response) {
                    //$('#error_rating').html(response.responseJSON.errors.rating);

                }
            });
        }

        
        //gatData(page);
        var footer = document.getElementById("footer");
        // Get the height of the footer
        var footerHeight = footer.offsetHeight;

        $(window).scroll(function() {
            var loader_value = $("#loader").val();
            if (!isLoading && $(window).scrollTop() + $(window).height() >= $(document).height() - footerHeight)
            {
            page++;
            $('.dot-flashing').show();
            //setTimeout("gatData(page)", 100000);
                if(loader_value == 1){
                    isLoading = true;
                    gatData(page);
                }else{
                    $('.dot-flashing').hide();
                }
            }
        });


        function gatData(page)
        {
            var metal_id = '';
            if($('.metal-dropdown-menu li a.active').length > 0){
                metal_id = $('.metal-dropdown-menu li a.active').attr('value');
            }
            var material_id = '';
            if($('.material-dropdown-menu li a.active').length > 0){
                material_id = $('.material-dropdown-menu li a.active').attr('value');
            }
            var gender = '';
            if($('.gender-dropdown-menu li a.active').length > 0){
                gender = $('.gender-dropdown-menu li a.active').attr('value');
            }

            var sorting = '';
            if($('.sorting-dropdown-menu li a.active').length > 0){
                sorting = $('.sorting-dropdown-menu li a.active').attr('value');
            }

            var url = '{!! route("frontend.getdata") !!}';
            $.ajax({
                    type: "POST",
                    url: url+"?page=" + page,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        category_id: '{{$category['id']}}',
                        discover_status : '{{$category['discover_status']}}',
                        discover_image : '{{$discover_image}}',
                        shopthelook_status : '{{$category['shopthelook_status']}}',
                        shopthelook_image : '{{$shopthelook_image}}',
                        metal_id : metal_id,
                        material_id : material_id,
                        gender : gender,
                        sorting : sorting,
                        cat_segment : '{{$catSegment}}',
                        subcategory_segment : '{{$subCategorySegment}}',
                        page_no : page
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        // $("#prodcut-box").html('<div class="product-loader"><img src="{{asset('images/spinner2.gif')}}" alt="spinner"/></div>');
                    },
                    complete: function(){
                        //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                    },
                    success: function (data) {
                        if(data.msg == 'success'){
                            if(data.pageproductdata < 12){
                                $("#loader").val(0);
                            }else{
                                $("#loader").val(1);
                            }   
                            $('.dot-flashing').hide();
                            $('.total_products').html(data.totalProducts);
                            $('#prodcut-box').append(data.ProductData_Html);
                            //$('#prodcut-box').html(data.ProductData_Html);
                            // Update isLoading to false after successfully loading data
                            isLoading = false;
                            $(".pl-pro-image-box-slider-wrapper").not('.slick-initialized').slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                dots: false,
                                infinite: true,
                                prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-left"></i></div>',
                                nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-right"></i></div>',
                                arrows: true,
                                speed: 500,
                                fade: true,
                                cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)'
                                // autoplay: true,
                                // autoplaySpeed: 3000,
                                //lazyLoad: 'ondemand'
                            });
                        }
                    },
                    error:function (response) {
                        //$('#error_rating').html(response.responseJSON.errors.rating);
                        alert('No response from server');

                    }
                });
            }

            function addTocart(product_name ,product_id,shape_id,metal_id,material_id)
            {
                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };
                var url = '{!! route("frontend.add-to-cart") !!}';
                $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            product_id: product_id,
                            shape_id : shape_id,
                            metal_id : metal_id,
                            material_id : material_id,
                            quantity : 1
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            //$("#prodcut-box").html('<img src="{{asset('images/spinner2.gif')}}" alt="spinner"/>');
                        },
                        complete: function(){
                            //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                        },
                        success: function (data) {
                            if(data.msg == 'success'){
                                $('.cart-count').html(data.cart_count);
                                toastr.success(product_name+' has been added to your cart.');
                            }
                        },
                        error:function (response) {
                            //$('#error_rating').html(response.responseJSON.errors.rating);

                        }
                    });
            }

    </script>
@endpush
