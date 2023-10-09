@php
    $product_price = $product->price;
    $shape_id = 0;
    $metal_id = 0;
    $material_id = 0;
    if($product->metal_display_priority_id){
        $metal_id = $product->metal_display_priority_id;
        $material_id = $product->firstProductMetalMaterial->material_id;
    }else if($product->firstProductMetalMaterial){
        //$product_price = $product_price + $product->firstProductMetalMaterial->price;
        $metal_id = $product->firstProductMetalMaterial->metal_id;
        $material_id = $product->firstProductMetalMaterial->material_id;
    }
    if($product->firstProductShape){
        //$product_price = $product_price + $product->firstProductShape->price;
        $shape_id = $product->firstProductShape->shape_id;
    }
    $currency =  countryCurrency();
    $countryMultiplyby = json_decode($product->multiplyby,true);
    $countryMultiplyby[1] = "1";
    //$product_price = $currency['symbol'].' '.number_format((float)($countryMultiplyby[$currency['country_id']] * $product_price) / $currency['rate'], 3, '.', '');
    $product_price = $currency['symbol'].' '.number_format((float)($product_price) / $currency['rate'], 3, '.', '');

    /*Get Product Images*/

    /*comment by dipali*/

    /* $productImages = productImages($product->id, $metal_id, $shape_id);
    $product_first_image = $productImages['product_list_first_image'];
    $image_paths = $productImages['product_first_image_paths'];*/

    /* Added By dipali */
    $proirityProductImages = proirityProductImages($product->id, $metal_id, $shape_id);
    $product_first_image = $proirityProductImages['product_list_first_image'];
    $image_paths = $proirityProductImages['product_first_image_paths'];

    /* end */

    if($subcategory_segment){
        $product_url =  route('frontend.product_detail', ['category' => $cat_segment,'subcategory' => $subcategory_segment,'product' => $product->slug]);
    }
    else if($cat_segment){
        $product_url =  route('frontend.show_sub_category_product', ['category' => $cat_segment,'subcategory' => $product->slug]);
    }
    $is_wishlist = 0;
    $wishlist_class = 'far fa-heart';
    if(Cookie::has('cookiewishlist')){
        $cookiewishlist = unserialize(Cookie::get('cookiewishlist'));
        if(in_array($product->id, $cookiewishlist)){
            $is_wishlist = 1;
            $wishlist_class = 'fas fa-heart active';
        }
    }

    if ($product->metals && $product->metals->name) {
        $metalName = $product->metals->name;
        $bgColor = $product->metals->bgcolor;
    } elseif ($product->firstProductMetalMaterial && $product->firstProductMetalMaterial->metal && $product->firstProductMetalMaterial->metal->name) {
        $metalName = $product->firstProductMetalMaterial->metal->name;
        $bgColor = $product->firstProductMetalMaterial->metal->bgcolor;
    }


@endphp

<div class="pl-product-box-wrapper  mt-3">
	<div class="pl-pro-head-info-box d-flex align-items-center justify-content-between">
        @if (!Carbon\Carbon::parse($product->created_at)->addDays(15)->isPast())
		<p class="text-small pb-0">New</p>
        @else
            <p class="text-small pb-0"></p>
        @endif
		<div class="wishlist-heart">
			<div class="d-inline-block d-md-none">
				<a href="JavaScript:void(0);" onclick="addTocart('{{$product->name}}','{{$product->id}}','{{$shape_id}}','{{$metal_id}}','{{$material_id}}')" class="">
					<img src="{{ asset('images/icons/cart.svg') }}"  alt="Image" class="cart-btn-img m-0" />
				</a>
			</div>
			<i value="{{$is_wishlist}}" id="wishlist_product_{{$product->id}}" class="updateFavorite {{$wishlist_class}}" onclick="wishlistProduct('{{ route('frontend.add-remove-wishlist') }}','{{$product->id}}')"></i>
		</div>
	</div>
	<div class="pl-pro-image-box">

        @if ($product_first_image)
		    <img  data-lazy="{{ $product_first_image }}"  src="{{  $product_first_image }}"  alt="Image" class="pl-pro-main-image" />
        @else
            <img  data-lazy="{{ asset('images/no_image.png') }}"  src="{{ asset('images/no_image.png') }}"  alt="Image" class="pl-pro-main-image" />
        @endif
		<div class="onhover-pl-pro-image-box-slider-wrapper">
			<div class="pl-pro-image-box-slider-wrapper ">
                @if(count($image_paths) > 0 && $product_first_image)
                    @foreach ($image_paths as $productImage)
                    <div class="item">
                        <a href="{{$product_url}}">
                            <img data-lazy="{{ $productImage }}" src="{{ $productImage }}"  alt="Image"/>
                        </a>
                    </div>
                    @endforeach
                @else
                    <div class="item">
                        <a href="{{$product_url}}">
                            <img data-lazy="{{ asset('images/no_image.png') }}"  src="{{ asset('images/no_image.png') }}"  alt="Image"/>
                        </a>
                    </div>
                @endif
			</div>
		</div>

	</div>
	<div class="pl-pro-info-box mobile-pl-pro-pro-title">
		<h6><a href="{{$product_url}}"> {{$product->name}}</a> </h6>
        @isset($metalName)
		  <h6 class=" d-block d-md-none">{{$metalName}}</h6>
        @endisset
		<h6 class="price">{!! $product_price  !!}</h6>
	</div>
	<div class="onhover-pl-product-box-wrapper">
		<div class="onhover-pl-pro-info-box text-center">
			<h5><a href="{{$product_url}}">{{$product->name}} </a></h5>
            @isset($metalName)
                <h6>
                    <span>Metal</span>
                    <span class="color-text-box"><span class="color-gold" style="background-color:{{$bgColor}};"></span> {{$metalName}}</span>
                </h6>
            @endisset
			<h6 class="price">{!! $product_price !!}</h6>
			<a href="JavaScript:void(0);" onclick="addTocart('{{$product->name}}','{{$product->id}}','{{$shape_id}}','{{$metal_id}}','{{$material_id}}')" class="btn btn-primary btn-white mt-2 btn-cart-img"><img src="{{ asset('images/icons/cart.svg') }}"  alt="Image" class="cart-btn-img" />Add to Bag</a>
		</div>
	</div>
</div>
