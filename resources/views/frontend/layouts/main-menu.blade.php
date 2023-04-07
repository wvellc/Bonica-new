<ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center justify-content-end">
	<?php   $name = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>

	<li  class="nav-item">
        @php $mywishlist_count = "0"; @endphp
        @if (Cookie::get('cookiewishlist') !== null)
        @php
            $mywishlist_count = count(unserialize(Cookie::get('cookiewishlist')));
        @endphp
        @endif
		<a class="nav-link <?php echo ($name == 'mywishlist.php')? 'active':'';?>" href="{{ route('frontend.mywishlist') }}" title="Wishlist"><img src="{{ asset('images/icons/wishlist.svg') }}" alt="" class="ms-1"> <span class="d-block d-lg-none">Wishlist</span> <span class="count-number mywishlist-count">{{$mywishlist_count}}</span></a>
	</li>
	<li  class="nav-item">
        @if(Auth::guard('user')->check())
        <a class="nav-link" href="{{ route('frontend.myaccount') }}" title="Account"><img src="{{ asset('images/icons/account.svg') }}" alt="" class="ms-1"> <span  class="d-block d-lg-none">Account</span></a>
        @else
        <a class="nav-link" href="{{ route('frontend.login') }}" title="Account"><img src="{{ asset('images/icons/account.svg') }}" alt="" class="ms-1"> <span  class="d-block d-lg-none">Account</span></a>
        @endif

	</li>
	<li  class="nav-item" >
        @php
            $cart_class = "";
            $cart_count = "0";
        @endphp

        @if (Cookie::get('cookiecart') !== null)
            @php
            $cart_class = "count-number";
            $cart_count = count(unserialize(Cookie::get('cookiecart')));
            @endphp
        @endif
		<a class="nav-link active" href="{{ route('frontend.cart') }}" title="Cart"><img src="{{ asset('images/icons/cart.svg') }}" alt="" class="ms-1"> <span  class="d-block d-lg-none">Cart</span><span class="count-number cart-count">{{$cart_count}}</span></a>
	</li>

</ul>
