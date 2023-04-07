<li  id="cart_{{$cart->id}}">
    <div class="order-history-box-item  d-flex ">
        <span class="remove-order" onclick="cartDelete('{{$cart->id}}');"><i class="fas fa-times"></i></span>
        <div class="me-3">
            <a href="{{$product_url}}" class="order-history-box-image d-block">
                @if ($product_first_image)
		            <img src="{{ $product_first_image }}"  alt="Image" />
                @else
                    <img src="{{ asset('images/no_image.png') }}"  alt="Image" />
                @endif
               {{--  <img src="{{ asset('images/products/rings/ring-1.png') }}" alt=""> --}}
            </a>
        </div>
        <div class="order-history-box-info">
            <div class="order-history-box-title d-flex justify-content-between">
                <h5><a href="{{$product_url}}">{{$cart->product->name}}</a></h5>
            </div>
            <div class=" d-flex justify-content-between align-items-end">

                <h6>

                    @if($metal != '')
                    <span>Metal</span>
                    {{$metal}}
                    {{$material}}
                    @endif

                    @if($size != '')
                    <span style="margin-top: 5px;">Size</span>
                    {{$size}}
                    @endif
                </h6>

                <h6 class="price ms-2 cart_product_price" id="price_{{$cart->id}}">{!! $currency['symbol'].' '.number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($product_price * $cart->quantity)) / $currency['rate'], 3, '.', '') !!}</h6>
            </div>
            <div class="d-flex mt-2">
                <label>QTY</label>
                <form id='myform' method='POST' class='myform quantity  ms-3' action='#'>
                    <input type='button' value='-' class='qtyminus minus' field='quantity' />
                    <input type='number' name='quantity' value='{{$cart->quantity}}' class='qty' onchange="quantityUpdate('{{$cart->id}}',this.value)"/>
                    <input type='button' value='+' class='qtyplus plus' field='quantity' />
                </form>
            </div>

        </div>
    </div>
</li>
