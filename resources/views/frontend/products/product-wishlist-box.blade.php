@php
    $product_price = $product->price;
    $shape_id = 0;
    $metal_id = 0;
    $material_id = 0;
    if($product->firstProductMetalMaterial){
        $product_price = $product_price + $product->firstProductMetalMaterial->price;
        $metal_id = $product->firstProductMetalMaterial->metal_id;
        $material_id = $product->firstProductMetalMaterial->material_id;
    }
    if($product->firstProductShape){
        $product_price = $product_price + $product->firstProductShape->price;
        $shape_id = $product->firstProductShape->shape_id;
    }
    $currency =  countryCurrency();
    $product_price = $currency['symbol'].' '.number_format((float)($product_price) / $currency['rate'], 3, '.', '');

    $images = \App\Models\ProductImage::where(['product_id' => $product->id])->get()->toArray();
    $image_paths = array();
    $product_first_image = '';
    if(count($images) > 0){
        $count = 1;
        foreach ($images as  $productimg) {
            if($productimg['shape_id'] == $shape_id && $productimg['metal_id'] == $metal_id){
                if($count == 1)
                    $product_first_image = $productimg['image_path'];
                    break;
            }
        }
        $count = 1;
        if(count($image_paths) == 0){
            foreach ($images as  $productimg) {
                if($count == 1)
                    $product_first_image = $productimg['image_path'];
                    break;
            }
        }
    }

    if($product->subcategory){
        $product_url =  route('frontend.product_detail', ['category' => $product->category->slug,'subcategory' => $product->subcategory->slug,'product' => $product->slug]);
    }
    else if($product->category){
        $product_url =  route('frontend.show_sub_category_product', ['category' => $product->category->slug,'subcategory' => $product->slug]);
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
@endphp
<div class="pl-product-box-wrapper  product-wishlist-box-wrapper mt-3">
	<div class="d-flex justify-content-end">
		<a href="javascript:void(0)" onclick="deleteWishlist('{{$product->id}}')" class="close-div-btn"><i class="fal fa-times"></i></a>
	</div>
	<div class="pl-pro-image-box">
		<a href="{{$product_url}}" class="d-block">
            @if ($product_first_image)
		    <img  data-lazy="{{ $product_first_image }}"  src="{{  $product_first_image }}"  alt="Image" class="pl-pro-main-image" />
            @else
                <img  data-lazy="{{ asset('images/no_image.png') }}"  src="{{ asset('images/no_image.png') }}"  alt="Image" class="pl-pro-main-image" />
            @endif
		</a>
	</div>
	<div class="pl-pro-info-box mobile-pl-pro-pro-title">
		<div class="d-flex align-items-center justify-content-between">
			<h5 class="mb-0"><a href="{{$product_url}}">{{$product->name}}</a></h5>
			<h6 class="price mt-0">{!! $product_price !!}</h6>
		</div>
		<h6>
            @if($product->firstProductMetalMaterial)
            <span>Metal</span><br/>
			    {{$product->firstProductMetalMaterial->metal->name}}
            @else
            <span>&nbsp;</span><br/>
            &nbsp;
            @endif
		</h6>

		<a href="JavaScript:void(0);" onclick="addTocart('{{$product->name}}','{{$product->id}}','{{$shape_id}}','{{$metal_id}}','{{$material_id}}')" class="btn btn-primary  mt-2 btn-cart-img w-100 mw-100"><img src="{{ asset('images/icons/cart.svg') }}"  alt="Image" class="cart-btn-img" />Move to Bag</a>
	</div>
</div>
