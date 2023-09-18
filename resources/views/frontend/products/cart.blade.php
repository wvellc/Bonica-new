@extends('frontend.layouts.layout')
@section('title', 'Cart | Bonica Jewel')
@section('meta_description', "LATEST COLLECTION Lab Grown Diamonds Stunning selection and the option to choose from a wide range of diamondContinue Reading 'Bonica Jewels'")
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <div class="cart-page">
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
									<li class="breadcrumb-item active" aria-current="page">Cart</li>
								</ol>
							</nav>
							<h3 class="text-center mt-3">Shopping Cart</h3>
						</div>
					</div>
                    @if(count($cartData) > 0)
					<div class="row  justify-content-between  mt-4 mt-md-4">
						<div class="col-md-12 col-xl-7">
							<div class="shiiping-info-wrapper">
								<div class="d-flex justify-content-between">
									<h6>Shipping Information</h6>
									<!-- <a href="#">Edit</a> -->
								</div>
								<div class="inner-form-wrapper">
									{{ Form::open(array('url' => route("frontend.checkout"), 'method'=> 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-vertical', 'id' => 'frmcheckout')) }}
										<div class="row">
											<div class="col-md-12 col-lg-6">
												<div class="form-group">
													<label>First Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ (old('first_name'))?old('first_name'):$formObj->first_name }}">
                                                    @if ($errors->has('first_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('first_name') }}
                                                    </span>
                                                    @endif
												</div>
											</div>
											<div class="col-md-12 col-lg-6">
												<div class="form-group">
													<label>Last Name</label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ (old('last_name'))?old('last_name'):$formObj->last_name }}">
                                                    @if ($errors->has('last_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('last_name') }}
                                                    </span>
                                                    @endif
												</div>
											</div>
										</div>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                                                        value="{{ (old('phone_number'))?old('phone_number'):$formObj->phone_number }}">
                                                    @if ($errors->has('phone_number'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('phone_number') }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
											<div class="col-md-12 col-lg-12">
												<div class="form-group">
													<label>Address <span class="error">*</span></label>
                                                    <input type="text" class="form-control" id="street_address" name="street_address" value="{{ (old('street_address'))?old('street_address'):$formObj->street_address }}">
                                                    @if ($errors->has('street_address'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('street_address') }}
                                                    </span>
                                                    @endif
												</div>
											</div>
											<div class="col-md-12 col-lg-12">
												<div class="form-group">
													<label>Appartment</label>
													<input type="text" class="form-control" id="street_address2" name="street_address2" value="{{ (old('street_address2'))?old('street_address2'):$formObj->street_address2 }}">
                                                    @if ($errors->has('street_address2'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('street_address2') }}
                                                    </span>
                                                    @endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-lg-6">
												<div class="form-group">
													<label>City <span class="error">*</span></label>
													<input type="text" class="form-control" id="city" name="city"  value="{{ (old('city'))?old('city'):$formObj->city }}">
                                                    @if ($errors->has('city'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('city') }}
                                                    </span>
                                                    @endif

												</div>
											</div>
											<div class="col-md-12 col-lg-6">
												<div class="form-group">
													<label>Pincode <span class="error">*</span></label>
													<input type="number" class="form-control" id="pincode" name="pincode" value="{{ (old('pincode'))?old('pincode'):$formObj->pincode }}" >
                                                    @if ($errors->has('pincode'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('pincode') }}
                                                    </span>
                                                    @endif
												</div>
											</div>
										</div>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label>State <span class="error">*</span></label>
                                                    <input type="text" class="form-control" id="state" name="state"
                                                        value="{{ (old('state'))?old('state'):$formObj->state }}">
                                                    @if ($errors->has('state'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('state') }}
                                                    </span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label>Country <span class="error">*</span></label>
                                                    <div class="select-box">
                                                        <select class="form-control" name="country" id="country">
                                                            @foreach($country as $key => $value)
                                                            <option value="{{$key}}" @if($key==$formObj->country) selected @endif >{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="row mt-4">
											<div class="col-md-12 col-lg-12">
												<a href="JavaScript:void(0);" onclick="formsubmit()" class="btn btn-primary ">Continue</a>
												<!-- <a href="#" class="btn btn-outline-primary">Cancel</a> -->
											</div>
										</div>
                                    {{ Form::close() }}
								</div>
							</div>
						</div>
						<div class="col-md-12 col-xl-4 mt-5 mt-xl-0">
                            @php
                                $currency =  countryCurrency();
                                $subtotal = 0;
                                $shipping_charges = $currency['shipping_charge'];
                                $discount = 0;
                                $coupon_code = '';
                                if(Cookie::has('coupon_discount')){
                                    $coupon_discount = unserialize(Cookie::get('coupon_discount'));
                                    $discount = $coupon_discount['discount'];
                                    $coupon_code = $coupon_discount['coupon_code'];
                                }
                            @endphp
							<div class="cart-item-mini-wrappers ">
								<ul id="cart-list">
                                    @foreach ($cartData as  $cart)
                                        @php

                                            $productData = ['product_id' => $cart->product_id,
                                            'center_diamond_color' => $cart->center_diamond_color_id,
                                            'center_diamond_clarity' => $cart->center_diamond_clarity_id,
                                            'side_diamond_color' => $cart->side_diamond_color_id,
                                            'side_diamond_clarity' => $cart->side_diamond_clarity_id,
                                            'ringSize' => $cart->size_id,
                                            'shape_id' => $cart->shape_id,
                                            'metal_id' => $cart->metal_id,
                                            'material_id' => $cart->material_id];

                                            $productDataArr = productPriceCalculation($productData);

                                            $product_price = $productDataArr['total_price'];
                                            $metal = '';
                                            $material = '';
                                            $shape = '';
                                            $size = '';
                                            if($cart->size){
                                                $size = $cart->size->name;
                                            }
                                           /*  if($cart->shape_id){
                                                $shapeData = getSingleProductShapePrice($cart->product_id, $cart->shape_id);
                                                $product_price = $product_price + $shapeData['price'];
                                                $shape = $shapeData['shape'];
                                            } */
                                            if($cart->material_id){
                                                $productMetalMaterial = getSingleProductMetalMaterial($cart->product_id, $cart->metal_id, $cart->material_id);
                                                //$product_price = $product_price + $productMetalMaterial['price'];
                                                $metal =    $productMetalMaterial['metal'];
                                                $material = $productMetalMaterial['material'];
                                            }

                                            $subtotal += ($product_price * $cart->quantity);
                                            if($cart->product->subcategory){
                                                $product_url =  route('frontend.product_detail', ['category' => $cart->product->category->slug,'subcategory' => $cart->product->subcategory->slug,'product' => $cart->product->slug]);
                                            }
                                            else if($cart->product->category){
                                                $product_url =  route('frontend.show_sub_category_product', ['category' => $cart->product->category->slug,'subcategory' => $cart->product->slug]);
                                            }
                                            $product_first_image = getSingleProductImage($cart->product_id, $cart->metal_id , $cart->shape_id);
                                        @endphp


                                        @include('frontend.products.cart-box')
                                    @endforeach
								</ul>
							</div>
							<div class="totals">
								<div class="totals-item">
									<label>Subtotal</label>
									<div class="totals-value" id="cart-subtotal">{!! $currency['symbol'].' '.number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * $subtotal) / $currency['rate'], 3, '.', '') !!}</div>
								</div>
                                @if($shipping_charges > 0)
								<div class="totals-item">
									<label>Shipping charges</label>
									<div class="totals-value" id="cart-shipping-charge">+{!! $currency['symbol'].' '.number_format((float)$shipping_charges, 3, '.', '') !!}</div>
								</div>
                                @endif

                                <div class="totals-item" id="div_discount" style="display: none;">
									<label>Discount </label>
									<div class="totals-value" id="cart-shipping-discount">- <span id="cart-discount">{!! $currency['symbol'].' '.number_format((float)($discount) / $currency['rate'], 3, '.', '') !!}<span></div>
								</div>

								<div class="totals-item totals-item-total">
									<label>Total</label>
                                    <input type="hidden" name="hidden_cart_total" id="hidden_cart_total" value="{{number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($subtotal - $discount) / $currency['rate']) + $shipping_charges, 3, '.', '')}}">
									<div class="totals-value" id="cart-total">{!! $currency['symbol'].' '.number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($subtotal - $discount) / $currency['rate']) + $shipping_charges, 3, '.', '') !!}</div>
								</div>
							</div>
							<div class="inner-form-wrapper">
								<form>
									<label>Coupon code  <span id="span_coupon_code"  class="badge me-1 ms-1"> @if($coupon_code) ({{$coupon_code}}) <i class="fas fa-times" onclick="couponDelete();"></i> @endif </span></label>
									<div class="row">
										<div class="col-8">
											<div class="">
												<input type="text" name="coupon_code" id="coupon_code" class="form-control" >
											</div>
										</div>
										<div class="col-4">
											<a href="JavaScript:void(0);" id="apply_coupon_code" class="btn btn-primary ">Apply</a>
										</div>
									</div>
								</form>
                                <span class="text-danger" id="error_coupon_code"></span>
							</div>
						</div>
					</div>
                    @else
                        No products in the cart!
                    @endif
				</div>
			</section>
		</main>

        <!-- footer -->
        @include('frontend.layouts.footer')
        @include('frontend.layouts.footerjs')
    </div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>

        function formsubmit(){
            $('#frmcheckout').submit();
        }
        function couponDelete(){

            var url = '{!! route("frontend.coupon-delete") !!}';
            var hidden_cart_total = $('#hidden_cart_total').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    cart_total: hidden_cart_total,
                },
                dataType: 'JSON',
                beforeSend: function ()
                {
                    //$("#div_load_more").html('<img src="{{asset('images/spinner.gif')}}" alt="spinner"/>');
                },
                complete: function ()
                {
                    //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                },
                success: function (data)
                {
                    if (data.msg == 'success')
                    {
                        $('#div_discount').hide();
                        $('#span_coupon_code').html('');
                        $('#cart-total').html(data.cart_total);
                        $('#cart-discount').html(data.discount);
                    }
                },
                error: function (response)
                {
                    //$('#error_rating').html(response.responseJSON.errors.rating);
                }
            });
            /* swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this record!",
                        type: "warning",
                        showCancelButton: true,
                        dangerMode: true,
                        cancelButtonClass: '#dcccbd',
                        confirmButtonColor: '#40485b',
                        confirmButtonText: 'Delete',
                    },function () {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                cart_total: hidden_cart_total,
                            },
                            dataType: 'JSON',
                            beforeSend: function() {

                            },
                            complete: function(){

                            },
                            success: function (data) {
                                if(data.msg == 'success'){
                                    $('#div_discount').hide();
                                    $('#span_coupon_code').html('');
                                    $('#cart-total').html(data.cart_total);
                                    $('#cart-discount').html(data.discount);
                                }
                            },
                            error:function (response) {
                               // $('#error_rating').html(response.responseJSON.errors.rating);
                            }
                        });
                    }); */




        }
        $(function() {

            var discount  = '{{$discount}}';

            if(discount > 0){
                $('#div_discount').show();
            }
            $('#apply_coupon_code').click(function(e) {
                e.preventDefault();
                $('#error_coupon_code').html('');
                var coupon_code = $('#coupon_code').val();
                if(coupon_code == ''){
                    $('#error_coupon_code').html('Please enter coupon code');
                }
                else{
                    var url = '{!! route("frontend.checked-coupon") !!}';
                    var hidden_cart_total = $('#hidden_cart_total').val();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            coupon_code: coupon_code,
                            cart_total: hidden_cart_total,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            //$("#div_load_more").html('<img src="{{asset('images/spinner.gif')}}" alt="spinner"/>');
                        },
                        complete: function(){
                            //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                        },
                        success: function (data) {
                            if(data.msg == 'success'){
                                $('#div_discount').show();
                                if(data.error_msg == ''){
                                    $('#cart-total').html(data.cart_total);
                                    $('#cart-discount').html(data.discount);
                                    $('#span_coupon_code').html('('+coupon_code+') <i class="fas fa-times" onclick="couponDelete();"></i>');
                                }
                                else{
                                    $('#error_coupon_code').html(data.error_msg);
                                }
                            }
                        },
                        error:function (response) {
                            //$('#error_rating').html(response.responseJSON.errors.rating);
                        }
                    });
                }
            });
        });

        function cartDelete(cart_id){

            var url = '{!! route("frontend.cart-delete") !!}';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    cart_id: cart_id,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    //$("#div_load_more").html('<img src="{{asset('images/spinner.gif')}}" alt="spinner"/>');
                },
                complete: function(){
                    //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                },
                success: function (data) {
                    if(data.msg == 'success'){
                        if(data.cartData.total == 0){
                            location.reload();
                        }
                        else{
                            $("#cart_"+cart_id).remove();
                            $(".cart_product_price").each(function() {
                            $('#'+$( this ).attr('id')).html(data.cartData.cartPrice[$( this ).attr('id')]);
                            });
                            $('#cart-subtotal').html(data.cartData.subtotal);
                            $('#cart-total').html(data.cartData.total);
                            $('#cart-total').html(data.cartData.total);
                            $('#hidden_cart_total').val(data.cartData.hidden_cart_total);
                            $('.cart-count').html(data.cart_count);
                        }
                    }
                },
                error:function (response) {
                    //$('#error_rating').html(response.responseJSON.errors.rating);
                }
            });
            /* swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this record!",
                        type: "warning",
                        showCancelButton: true,
                        dangerMode: true,
                        cancelButtonClass: '#dcccbd',
                        confirmButtonColor: '#40485b',
                        confirmButtonText: 'Delete',
                    },function () {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                cart_id: cart_id,
                            },
                            dataType: 'JSON',
                            beforeSend: function() {
                                //$("#div_load_more").html('<img src="{{asset('images/spinner.gif')}}" alt="spinner"/>');
                            },
                            complete: function(){
                                //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                            },
                            success: function (data) {
                                if(data.msg == 'success'){
                                    if(data.cartData.total == 0){
                                        location.reload();
                                    }
                                    else{
                                        $("#cart_"+cart_id).remove();
                                        $(".cart_product_price").each(function() {
                                        $('#'+$( this ).attr('id')).html(data.cartData.cartPrice[$( this ).attr('id')]);
                                        });
                                        $('#cart-subtotal').html(data.cartData.subtotal);
                                        $('#cart-total').html(data.cartData.total);
                                        $('#cart-total').html(data.cartData.total);
                                        $('#hidden_cart_total').val(data.cartData.total);
                                        $('.cart-count').html(data.cart_count);
                                    }
                                }
                            },
                            error:function (response) {
                                //$('#error_rating').html(response.responseJSON.errors.rating);
                            }
                        });
                    }); */
        }
        function quantityUpdate(cart_id, quantity){
            var url = '{!! route("frontend.cart-quantity-update") !!}';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    cart_id: cart_id,
                    quantity : quantity
                },
                dataType: 'JSON',
                beforeSend: function() {
                    //$("#div_load_more").html('<img src="{{asset('images/spinner.gif')}}" alt="spinner"/>');
                },
                complete: function(){
                    //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                },
                success: function (data) {
                    if(data.msg == 'success'){

                        $(".cart_product_price").each(function() {
                           $('#'+$( this ).attr('id')).html(data.cartData.cartPrice[$( this ).attr('id')]);
                        });
                        $('#cart-subtotal').html(data.cartData.subtotal);
                        $('#cart-total').html(data.cartData.total);
                        $('#hidden_cart_total').val(data.cartData.hidden_cart_total);
                        //console.log(data.cartData.cartPrice[$( this ).attr('id')]);
                        //$('#discovermodal').modal('show');
                    }
                },
                error:function (response) {
                    //$('#error_rating').html(response.responseJSON.errors.rating);
                }
            });
        }
    </script>
@endpush
