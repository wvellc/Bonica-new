@extends('frontend.layouts.layout')
@section('title', $product->meta_title )
@section('meta_keywords', $product->meta_keywords)
@section('meta_description', $product->meta_description)

@section('title', 'Products Details | Bonica Jewels')
@section('meta_description', "LATEST COLLECTION Lab Grown Diamonds Stunning selection and the option to choose from a wide range of diamondContinue Reading 'Bonica Jewels'")
@section('content')

<div class="product-list-page">

    <div class="main-page-loader" style="display: none;">
		<img src="{{ asset('images/b-logo-icon.svg') }}" alt="">
	</div>
	<!-- header -->
	@include('frontend.layouts.header')
		<!-- main -->
        <main>

			<section class="section" >
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-md-12 col-xl-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb justify-content-center mb-0">
									<li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>

                                    @if ($subcategory_segment)
                                        <li class="breadcrumb-item"><a href="{{route('frontend.show_sub_category_product', ['category' => $category->parent->slug,'subcategory' => $subcategory_segment])}}">{{ $category['name'] }}</a></li>

                                    @else
                                        <li class="breadcrumb-item"><a href="{{route('frontend.show_category_product', ['category' => $category->slug])}}">{{ $category['name'] }}</a></li>
                                    @endif
									<li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-md-12 col-xl-7">
                            <div class="product-row-wrapper" id="product_image-loading"></div>
							<div class="product-row-wrapper" id="product_image"></div>
						</div>
						<div class="col-md-12 col-xl-5">
							<div class="detials-wrapper-box">
								<div class="d-flex justify-content-between">
									<h3>{{$product->name}}</h3>
                                    @php
                                        $is_wishlist = 0;
                                        $wishlist_class = 'far fa-heart';
                                        if(Cookie::has('cookiewishlist')){
                                            $cookiewishlist = unserialize(Cookie::get('cookiewishlist'));
                                            if(in_array($product->id, $cookiewishlist)){
                                                $is_wishlist = 1;
                                                $wishlist_class = 'fas fa-heart active';
                                            }
                                        }
                                    @endphp
									<div class="wishlist-heart">
										<i value="{{$is_wishlist}}" id="wishlist_product_{{$product->id}}" class="updateFavorite {{$wishlist_class}}" onclick="wishlistProduct('{{ route('frontend.add-remove-wishlist') }}','{{$product->id}}')"></i>
									</div>
								</div>

								<div class="pice-info d-flex align-items-center">
									<h6 class="me-1 mb-0 pb-0" id="product_price"></h6>
                                    @if ($category['slug'] == 'sale')
                                    <s><span id="sales_product_price"></span></s>
                                    @endif
									{{-- <p>	Inc. vat</p> --}}
								</div>
                                @if(count($product->ProductShapes) > 0)

                                <div class="center-diamond">
                                    @if(count($product->ProductShapes) > 0)
                                    
                                    @if($product->is_solitaire == 1)
                                    <div class="mt-3 {{$product->is_solitaire}}">
                                        <h4 style="font-size: 16px;">Center Diamond</h4>
                                    </div>
                                    @endif

                                    <div class="center-dropdowns d-flex">
                                        <div class="b-dropdown shape f-item me-5">
											<div class="select-box">
												<h5>Diamond Shape</h5>
                                            	@if(count($product->ProductShapes) > 1)
													<select class="form-control" id="shape" name="shape" onchange="getProductPrice(); getProductPriceImage();">
														@foreach ($product->ProductShapes as $productshape)
														<option value="{{$productshape->shape->id}}" @if ($product->firstProductShape->shape_id == $productshape->shape->id) selected @endif >{{$productshape->shape->name}}</option>
														@endforeach
													</select>                                           
                                            	@else
                                                <p style="font-size: 15px;font-weight: 500;">{{$product->ProductShapes[0]['shape']['name']}}</p>
                                                <input type="hidden" data-name="{{$product->ProductShapes[0]['shape']['name']}}" name="shape" id="shape" value="{{$product->ProductShapes[0]['shape_id']}}">
                                                @endif
                                            </div>
										</div>

                                        @if (count($center_diamond_colors) > 0 || count($center_diamond_claritys) > 0)
											@if (count($center_diamond_colors) > 0)
												<div class="b-dropdown color f-item me-5">
													<h5>Color</h5>
													@if (count($center_diamond_colors) > 1)
														<div class="select-box">
															<select class="form-control" id="center_diamond_color" name="center_diamond_color" onchange="getProductPrice();">
																@foreach ($center_diamond_colors as $key => $center_diamond_color)
																<option value="{{$key}}" >{{$center_diamond_color}}</option>
																@endforeach
															</select>
														</div>
													@else
														@foreach ($center_diamond_colors as $key => $center_diamond_color)
														<p>{{$center_diamond_color}}</p>
														<input type="hidden" name="center_diamond_color" id="center_diamond_color" value="{{$key}}">
														@endforeach
													@endif
												</div>
											@endif
											  

											@if (count($center_diamond_claritys) > 0)
												<div class="b-dropdown clarity f-item">
													<h5>Clarity</h5>
													@if (count($center_diamond_claritys) > 1)
														<div class="select-box">
															<select class="form-control" id="center_diamond_clarity" name="center_diamond_clarity" onchange="getProductPrice();">
																@foreach ($center_diamond_claritys as $key => $center_diamond_clarity)
																<option value="{{$key}}" >{{$center_diamond_clarity}}</option>
																@endforeach
															</select>
														</div>
													@else
														@foreach ($center_diamond_claritys as $key => $center_diamond_clarity)
														<p>{{$center_diamond_clarity}}</p>
														<input type="hidden" name="center_diamond_clarity" id="center_diamond_clarity" value="{{$key}}">
														@endforeach
													@endif
												</div>
											@endif
										@endif
								    </div>
                                	@endif                              
                                    </div>
									@endif 
                               

                                @if (count($side_diamond_colors) > 0 || count($side_diamond_claritys) > 0)

                                @if($product->is_solitaire == 1)
                                <div class="mt-3">
                                    <h4 style="font-size: 16px;">Side Diamonds</h4>
                                </div>
                                @endif

                                <div class="d-flex">
                                    @if (count($side_diamond_colors) > 0)
                                        <div class="me-5">
                                            <h5>Color</h5>
                                            @if (count($side_diamond_colors) > 1)
                                                <div class="select-box">
                                                    <select class="form-control" id="side_diamond_color" name="side_diamond_color" onchange="getProductPrice();">
                                                        @foreach ($side_diamond_colors as $key => $side_diamond_color)
                                                        <option value="{{$key}}" >{{$side_diamond_color}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                @foreach ($side_diamond_colors as $key => $side_diamond_color)
                                                <p>{{$side_diamond_color}}</p>
                                                <input type="hidden" name="side_diamond_color" id="side_diamond_color" value="{{$key}}">
                                                @endforeach
                                            @endif

                                        </div>
                                    @endif
                                    @if (count($side_diamond_claritys) > 0)
                                    <div class="side-clarity">
                                        <h5>Clarity</h5>
                                        @if (count($side_diamond_claritys) > 1)
                                            <div class="select-box">
                                                <select class="form-control" id="side_diamond_clarity" name="side_diamond_clarity" onchange="getProductPrice();">
                                                    @foreach ($side_diamond_claritys as $key => $side_diamond_clarity)
                                                    <option value="{{$key}}" >{{$side_diamond_clarity}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            @foreach ($side_diamond_claritys as $key => $side_diamond_clarity)
                                            <p>{{$side_diamond_clarity}}</p>
                                            <input type="hidden" name="side_diamond_clarity" id="side_diamond_clarity" value="{{$key}}">
                                            @endforeach
                                        @endif

                                    </div>
                                    @endif
                                </div>
                            @endif

                                @if (count($product->ProductMetalMaterial) > 0)
                                    @php
                                    $metal_arr = array();
                                    $material_arr = array();
                                    @endphp
                                    @foreach ($product->ProductMetalMaterial as $ProductMetalMaterial)
                                        @php
                                        $metal_arr[$ProductMetalMaterial->metal_id] = array('name' => $ProductMetalMaterial->metal->name, 'bgcolor' => $ProductMetalMaterial->metal->bgcolor);
                                        if(isset($ProductMetalMaterial->material->name) && array_key_first($metal_arr) == $ProductMetalMaterial->metal_id){
                                            $material_arr[$ProductMetalMaterial->material_id] = $ProductMetalMaterial->material->name;
                                        }
                                        @endphp
                                        @endforeach
                                <div class="">
									<h5>Metal</h5>
									<div class="metal-list">
                                        @foreach ($metal_arr as $key => $metal)
										<input onclick="getProductPriceImage();" type="radio" @if ($product->firstProductMetalMaterial->metal_id == $key) checked @endif id="metal_{{$key}}" name="metal" value="{{$key}}" />
										<label for="metal_{{$key}}"><span class="color-gold" style="background-color:{{$metal['bgcolor']}};"></span> {{$metal['name']}}</label>
                                        @endforeach
									</div>
								</div>
                                
                                    @if(!empty($material_arr))
                                    <div class="" id="materialboxhide">

                                        <h5>Material</h5>
                                        <div class="square-radio-design" id="materialbox">
                                            @foreach ($material_arr as $key => $material)
                                                <input onclick="getProductPrice();" type="radio" @if ($product->firstProductMetalMaterial->material_id == $key) checked @endif id="material_{{$key}}" name="material" value="{{$key}}" />
                                                <label for="material_{{$key}}">{{$material}}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                @if (count($product->ProductSize) > 0 && count($country_size) > 0)
								<div class="ring-size bangles">
									<h5>Select your size</h5>
                                        @php $size_arr = array();  @endphp
                                        @foreach ($product->ProductSize as $ProductSize)
                                        @php $size_arr[$ProductSize->id] = $ProductSize->size; @endphp
                                        @endforeach
                                        @php ksort($size_arr); @endphp
                                        
                                    <div class="">
                                        <div class="select-box">
                                            <select class="form-control" id="ringSize" name="ringSize" onchange="getProductPrice();">
                                                @foreach($size_arr as $key => $value)
                                                @if(in_array($key,$country_size))
                                                <option value="{{$key}}" @if ($loop->first) selected @endif >{{$value}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
								</div>
                                @endif
    
                                @if($is_show_size_chart)
                                    @if($cat_segment == 'rings' || $cat_segment == 'bracelets' || $cat_segment == 'bangles')
    								<div class="pd-icon-title ring-size-info-link my-3">
    									<img src="{{ asset('images/icons/products/measure-tape.svg') }}" alt="measure-tape">
    									<h5><a href="#"  data-bs-toggle="modal" data-bs-target="#{{$cat_segment}}sizemodal">Find your size</a></h5>
    								</div>
                                    @endif
                                @endif
								<div class="pd-icon-title delivery-info d-sm-flex  align-items-end  flex-column flex-sm-row">
									<div class="delivery-truck-info">
										<img class="truck-img" src="{{ asset('images/icons/products/delivery.svg') }}" alt="delivery">
										<h5 class="mt-0"><a href="#">Free Delivery</a></h5>
										<p>

                                            @if ($product->free_delivery)
                                                {{$product->free_delivery}}
                                            @else
                                            usually takes 7 days to deliver
                                            @endif
                                        </p>
									</div>

									<div>
										<a href="{{ route('frontend.appointment') }}" class="btn mt-3 mt-sm-0 ms-sm-3  btn-outline-primary ">Booking  Appointment</a>
									</div>
								</div>
								<div class="quantity-box pb-3 d-flex align-items-end">
									<div>
										<h5>Quantity</h5>
										<form id='myform' method='POST' class='myform quantity' action='#'>
											<input type='button' value='-' class='qtyminus minus' field='quantity' />
											<input type='number' id="quantity" name='quantity' value='1' class='qty' />
											<input type='button' value='+' class='qtyplus plus' field='quantity' />
										</form>
									</div>
									<!-- <div>
										<a href="appointment.php" class="btn mt-2 ms-2  btn-outline-primary ">Booking  Appointment</a>
									</div> -->


								</div>
								<div class=" d-flex  align-items-center flex-row">
									<a href="JavaScript:void(0);" onclick="addTocart()" class="btn btn-primary mt-2 btn-cart-img"><img src="{{ asset('images/icons/cart.svg') }}"  alt="Image" class="cart-btn-img" />Add to Bag</a>

								</div>

							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section pd-section">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="pr-d-desc">
								<h5>Description</h5>
								{!! $product->description !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class=" mt-4  mt-md-0">
								<h5>Details</h5>
								<ul class="pro-d-list-info">
                                    @if ($product->sku)
									<li>
										<img src="{{ asset('images/icons/products/refrence.svg') }}" alt="icon">
										<h6>
											<span>Reference : </span>
											{{$product->sku}}
										</h6>
									</li>
                                    @endif
                                    @if ($product->stone)
                                    <li>
										<img src="{{ asset('images/icons/products/stone.svg') }}" alt="icon">
										<h6>
											<span>Stone : </span>
											{{$product->stone}}
										</h6>
									</li>
                                    @endif
                                    @if ($product->made_in)
                                    <li>
										<img src="{{ asset('images/icons/products/madein.svg') }}" alt="icon">
										<h6>
											<span>Made In : </span>
											{{$product->made_in}}
										</h6>
									</li>
                                    @endif
                                    @if ($product->metal)
                                    <li>
										<img src="{{ asset('images/icons/products/metal.svg') }}" alt="icon">
										<h6>
											<span>Metal : </span>
											{{$product->metal}}
										</h6>
									</li>
                                    @endif


                                    @if ($product->diamond_weight)
									<li>
										<img src="{{ asset('images/icons/products/diamonds.svg') }}" alt="icon">
										<h6>
											<span>Diamonds (WT) : </span>
											{{$product->diamond_weight}} Carats
										</h6>
									</li>
                                    @endif
                                    @if ($product->product_size)
                                    <li>
										<img src="{{ asset('images/icons/products/size.svg') }}" alt="icon">
										<h6>
											<span>Size : </span>
											{{$product->product_size}}
										</h6>
									</li>
                                    @endif
                                    @if ($product->igi_certified_text)
									<li>
										<img src="{{ asset('images/icons/products/igi.svg') }}" alt="icon">
										<h6>
											<span>IGI Certified : </span>
                                            {{$product->igi_certified_text}}
										</h6>
									</li>
                                    @endif
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
            @if(count($product->ProductShapes) > 0)
                @if($cat_segment == 'rings')
                @php
                    $productShapes = strtolower($product->ProductShapes[0]['shape']['name']);
                @endphp
                <section class="section diamond-section">
                    <div class="container-fluid p-0">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-lg-6 text-center">
                                <div class="hand-wrapper">
                                    <img id="hand" src="{{ asset('images/hand.png') }}" alt="image" class="v-hand" >
                                    <div class="box-diamond-on-hand">
                                        <img id="diamondOnhand" src="{{ asset('images/shapes/'.$productShapes.'.png') }}" alt="image" class="diamond-on-hand" style="transform: scale(2.20);">
                                    </div>
                                    <span>Shown with ring size 6</span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6  col-xl-5">
                                <div class="px-4 range-size-wrapper">
                                    <div class="d-flex align-items-center justify-content-between pb-5">
                                        <p class="pb-0">0.5 ct</p>
                                        <p>4 ct</p>
                                    </div>
                                    <div class="diamondOnhand-wrapper mb-5">

                                        <input class="range-slider__range" id="myRange" type='range' value="3" min="0.5" max="4" step="0.25">
                                    </div>
                                    <p class="text-center">
                                        Shown with <b ><span id="caratValue">3</span> carat</b> Diamond
                                    </p>

                                    <!-- <div class="slider-wrapper">
                                        <div id="employees"></div>
                                    </div> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                @endif
            @endif
			<section class="section assurance-section">
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2><span>BONICA's ASSURANCE</span></h2>
							</div>
							<ul class="assurance-list d-flex">
								<li>
									<img src="{{ asset('images/icons/products/certified.svg') }}" alt="">
									<h5>Diamond Certified</h5>
									<p>Drawing its inspiration from the most renowned amphitheatre of the world, the Colosseum,</p>
									<a href="#">Discover More</a>
								</li>
								<li>
									<img src="{{ asset('images/icons/products/ethical-diamonds.svg') }}" alt="">
									<h5>Conflict-Free/Ethical Diamonds</h5>
									<p>Drawing its inspiration from the most renowned amphitheatre of the world, the Colosseum,</p>
									<a href="#">Discover More</a>
								</li>
								<li>
									<img src="{{ asset('images/icons/products/bis-hallmark.svg') }}" alt="icon">
									<h5>BIS Hallmark Gold</h5>
									<p>Drawing its inspiration from the most renowned amphitheatre of the world, the Colosseum,</p>
									<a href="#">Discover More</a>
								</li>
								<li>
									<img src="{{ asset('images/icons/products/sustainable-practices.svg') }}" alt="icon">
									<h5>Sustainable Practices</h5>
									<p>Drawing its inspiration from the most renowned amphitheatre of the world, the Colosseum,</p>
									<a href="#">Discover More</a>
								</li>
								<li>
									<img src="{{ asset('images/icons/products/lifetime-exchange.svg') }}" alt="">
									<h5>Lifetime Exchange</h5>
									<p>Drawing its inspiration from the most renowned amphitheatre of the world, the Colosseum,</p>
									<a href="#">Discover More</a>
								</li>
							</ul>
						</div>
					</div>

				</div>
			</section>

            @if (count($likes_products) > 0)
			<section class="section">
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-md-12 text-center ">
							<div class="section-title">
								<h2><span>DISCOVER MORE PRODUCTS</span></h2>
							</div>
						</div>
					</div>

					<div class="row align-items-center">
                        @foreach ($likes_products as $likes_product)
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 product-col">
                            @include('frontend.products.product-box',['product' => $likes_product, 'cat_segment' => $cat_segment, 'subcategory_segment' => $subcategory_segment])
                        </div>
                        @endforeach
					</div>

				</div>
			</section>
            @endif
		</main>
        <!--ringsize Modal -->
<div class="modal rightmodal ringssizemodal p-0" id="ringssizemodal" data-bs-backdrop="true" data-bs-keyboard="true" tabindex="-1" aria-labelledby="ringsizemodalLabel" aria-hidden="true">
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

<div class="modal rightmodal braceletssizemodal p-0" id="braceletssizemodal" data-bs-backdrop="true" data-bs-keyboard="true" tabindex="-1" aria-labelledby="ringsizemodalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header pb-0 border-0" style="height: 40px;">
				<!-- <h5 class="modal-title" id="ringsizemodalLabel">ringsize Similar</h5> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <div class="text-center ">
                    <img src="{{ asset('images/icons/bracelet.svg') }}" alt="clock-size" class="mb-4">
                    <h5>Bonica Bracelet Size</h5>
                </div>
                <p>Do you want to know what your bracelet size is? Please follow the Size Chart to find out your bracelet size. If you are still not sure, click on our <a class="text-underline" href="{{ route('frontend.page', ['size-guide','bracelets']) }}" target="_blank"> size guide </a> or <a class="text-underline" href="{{ route('frontend.appointment') }}" target="_blanck">contact us for an appointment.</a> We look forward to hearing from you.</p>
                @include('frontend.braceletssizes')
			</div>
		</div>
	</div>
</div>

<div class="modal rightmodal necklacesizemodal p-0" id="necklacesizemodal" data-bs-backdrop="true" data-bs-keyboard="true" tabindex="-1" aria-labelledby="ringsizemodalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header pb-0 border-0" style="height: 40px;">
				<!-- <h5 class="modal-title" id="ringsizemodalLabel">ringsize Similar</h5> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <div class="text-center ">
                    <img src="{{ asset('images/icons/necklace.svg') }}" alt="clock-size" class="mb-4">
                    <h5>Bonica Necklace Size</h5>
                </div>
                <p>Do you want to know what your necklace size is? Please follow the Size Chart to find out your necklace size. If you are still not sure, click on our <a class="text-underline" href="{{ route('frontend.page', ['size-guide','necklaces']) }}" target="_blank"> size guide </a> or <a class="text-underline" href="{{ route('frontend.appointment') }}" target="_blanck">contact us for an appointment.</a> We look forward to hearing from you.</p>
                @include('frontend.necklacesizes')
			</div>
		</div>
	</div>
</div>

<div class="modal rightmodal pendantssizemodal p-0" id="pendantssizemodal" data-bs-backdrop="true" data-bs-keyboard="true" tabindex="-1" aria-labelledby="ringsizemodalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header pb-0 border-0" style="height: 40px;">
				<!-- <h5 class="modal-title" id="ringsizemodalLabel">ringsize Similar</h5> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <div class="text-center ">
                    <img src="{{ asset('images/icons/necklace.svg') }}" alt="clock-size" class="mb-4">
                    <h5>Bonica Pendants Size</h5>
                </div>
                <p>Do you want to know what your pendants size is? Please follow the Size Chart to find out your pendants size. If you are still not sure, click on our <a class="text-underline" href="{{ route('frontend.page', ['size-guide','pendants'])}}" target="_blank"> size guide </a> or <a class="text-underline" href="{{ route('frontend.appointment') }}" target="_blanck">contact us for an appointment.</a> We look forward to hearing from you.</p>
                @include('frontend.necklacesizes')
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
$(function ()
{
    getProductPrice();
    getProductPriceImage();

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
});
var slider = document.getElementById("myRange");
slider.oninput = function() {

        var zommSize = this.value;
        var range_zomm_size = 2;
        if(zommSize == 0.5){
            range_zomm_size = 1.6;
        }
        else if(zommSize == 0.75){
            range_zomm_size = 1.65;
        }
        else if(zommSize == 1){
            range_zomm_size = 1.70;
        }
        else if(zommSize == 1.25){
            range_zomm_size = 1.75;
        }
        else if(zommSize == 1.5){
            range_zomm_size = 1.80;
        }
        else if(zommSize == 1.75){
            range_zomm_size = 1.85;
        }
        else if(zommSize == 2){
            range_zomm_size = 1.90;
        }
        else if(zommSize == 2.25){
            range_zomm_size = 1.95;
        }
        else if(zommSize == 2.5){
            range_zomm_size = 2;
        }
        else if(zommSize == 2.75){
            range_zomm_size = 2.10;
        }
        else if(zommSize == 3){
            range_zomm_size = 2.20;
        }
        else if(zommSize == 3.25){
            range_zomm_size = 2.40;
        }
        else if(zommSize == 3.5){
            range_zomm_size = 2.60;
        }
        else if(zommSize == 3.75){
            range_zomm_size = 2.80;
        }
        else if(zommSize == 4){
            range_zomm_size = 3;
        }

        //console.log('zommSize =>',range_zomm_size);
        document.getElementById('diamondOnhand').style.transform = "scale("+range_zomm_size+")";
        $('#caratValue').html(zommSize);
    }


 function addTocart(){

    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-right"
    };

    var quantity = $('#quantity').val();
    var shape_id = $('#shape').val();
    var metal_id = $('input[name="metal"]:checked').val();
    var material_id = $('input[name="material"]:checked').val();
    var ringSize = $('#ringSize').val();
    var center_diamond_color = $('#center_diamond_color').val();
    var center_diamond_clarity = $('#center_diamond_clarity').val();
    var side_diamond_color = $('#side_diamond_color').val();
    var side_diamond_clarity = $('#side_diamond_clarity').val();
    var product_name = '{{$product->name}}';

    var url = '{!! route("frontend.add-to-cart") !!}';
    $.ajax({
            type: "POST",
            url: url,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: '{{$product->id}}',
                shape_id : shape_id,
                metal_id : metal_id,
                material_id : material_id,
                size_id : ringSize,
                quantity : quantity,
                center_diamond_color : center_diamond_color,
                center_diamond_clarity : center_diamond_clarity,
                side_diamond_color : side_diamond_color,
                side_diamond_clarity : side_diamond_clarity
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
function slickslider(){
        $('.product-row-wrapper .slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.product-row-wrapper .slider-nav'
        });
        $('.product-row-wrapper .slider-nav').slick({
            slidesToShow:3,
				slidesToScroll: 1,
				asNavFor: '.product-row-wrapper .slider-for',
				dots: false,
				vertical:true,
				prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-up"></i></div>',
				nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-down"></i></div>',
				arrows: true,
				centerMode: false,
				focusOnSelect: true,
                adaptiveHeight: true,

				responsive: [
				{
					breakpoint: 1300,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						vertical:false,
						dots:false
					}
				}
				]

        });
        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
            // "slideShow",
            // "thumbs",
            "zoom",
            "fullScreen",
            // "share",
            "close"
            ],
            wheel : false,
            'scrolling': 'no',
            loop: true,
            protect: true
        });
}
function getProductPrice()
{

    var shape_id = $('#shape').val();
    var center_diamond_color = $('#center_diamond_color').val();
    var center_diamond_clarity = $('#center_diamond_clarity').val();
    var side_diamond_color = $('#side_diamond_color').val();
    var side_diamond_clarity = $('#side_diamond_clarity').val();
    var ringSize = $('#ringSize').val();
    var metal_id = $('input[name="metal"]:checked').val();
    var material_id = $('input[name="material"]:checked').val();

    var url = '{!! route("frontend.get-product-price") !!}';
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: '{{$product->id}}',
            shape_id : shape_id,
            center_diamond_color : center_diamond_color,
            center_diamond_clarity : center_diamond_clarity,
            side_diamond_color : side_diamond_color,
            side_diamond_clarity : side_diamond_clarity,
            ringSize : ringSize,
            metal_id : metal_id,
            material_id : material_id,
        },
        dataType: 'JSON',
        beforeSend: function() {
        },
        complete: function(){
        },
        success: function (data) {
            if(data.msg == 'success'){
                $('#product_price').html(data.product_price);
                $('#sales_product_price').html(data.salesProductPrice);
            }
        },
        error:function (response) {
            //$('#error_rating').html(response.responseJSON.errors.rating);

        }
    });
}
function getProductPriceImage()
{
    var shape_id = $('#shape').val();
    var metal_id = $('input[name="metal"]:checked').val();
    var material_id = $('input[name="material"]:checked').val();

    var url = '{!! route("frontend.get-product-price-image") !!}';
    $.ajax({
            type: "POST",
            url: url,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: '{{$product->id}}',
                shape_id : shape_id,
                metal_id : metal_id,
                material_id : material_id,
            },
            dataType: 'JSON',
            start_time: new Date().getTime(),
            beforeSend: function() {
            $('#product_image').html('');
             $('#product_image-loading').html('<div class="slider-main-page-loader">
									<img src="{{asset('images/loader-slider.gif')}}" alt="">
								</div>');
                //$(".main-page-loader").css("display", "flex");
                //$(".slider-nav").css("display", "none");
                //$("#prodcut-box").html('<img src="{{asset('images/spinner2.gif')}}" alt="spinner"/>');
            },

            complete: function(){

                //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                //$(".main-page-loader").css("display", "none");
               /*  var taketime = (new Date().getTime() - this.start_time)* 2;

                setTimeout(
                    function() {
                        $('#product_image-loading').html('');

                        //$('#product_image').show();
                        //$("#product_image-loading").css("display", "none")



                        //$(".slider-nav").css("display", "block")
                    }, taketime); */

                    //alert('This request took '+(new Date().getTime() - this.start_time)* 10 +' ms');

            },
            success: function (data) {
                if(data.msg == 'success'){
                    if(data.materialMetalHTML == ""){
                        $("#materialboxhide").hide();
                    } else {
                        $("#materialboxhide").show();
                    }
                    $("#materialbox").html(data.materialMetalHTML);
                    getProductPrice();
                   /*  $('#product_price').html(data.product_price);
                    $('#sales_product_price').html(data.salesProductPrice); */
                    var taketime = (new Date().getTime() - this.start_time) * 2;
                    //console.log(window.screen.width);
                    //console.log(taketime);
                    setTimeout(
                        function() {
                            $('#product_image-loading').html('');
                            $('#product_image').html(data.ProductImageHtml);
                            slickslider();

                            if(window.screen.width > 1300 && window.screen.width < 1370){
                                $(".products-d-small-image-wrapper .slick-list").attr("style", "height: 522px;");
                                $(".products-d-small-image-wrapper .slick-list .slick-track").attr("style", "opacity: 1; height: 1740px;");
                            }
                            else{
                                $(".products-d-small-image-wrapper .slick-list").attr("style", "height: 711px;");
                                $(".products-d-small-image-wrapper .slick-list .slick-track").attr("style", "opacity: 1; height: 2370px;");
                            }



                            //$(".slider-nav").css("display", "block")
                        }, taketime);
                    var getnameShape = $( "#shape option:selected" ).text().toLowerCase();
                    if(getnameShape == ""){
                        var getnameShape = $( "#shape").getAttribute('data-name').toLowerCase();
                    }
                    //console.log(getnameShape);
                    $('#diamondOnhand').attr('src', "{{asset('images/shapes')}}/"+getnameShape+'.png');
                    
                }
            },
            error:function (response) {
                //$('#error_rating').html(response.responseJSON.errors.rating);

            }
        });
    }

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

</script>
@endpush
