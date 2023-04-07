@extends('frontend.layouts.layout')
@section('content')

<div class="login-page">
    <!-- header -->
    @include('frontend.layouts.header')
    <!-- main -->
    <main>
        <section class="section">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-12 col-xl-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Account</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row align-items-center justify-content-between  mt-4 mt-md-4">
                    <div class="col-md-12 col-xl-12">
                        <div class="d-flex justify-content-between align-items-center flex-wrap flex-sm-wrap">
                            <h3 class="mb-2 mb-sm-0">Welcome, {{Auth::guard('user')->user()->first_name}}</h3>
                            <a href="{{ route('frontend.logout') }}" class="btn btn-primary btn-small ms-sm-2">Logout</a>
                        </div>

                        <div class="tab-container d-flex  mt-4 mt-md-4">
                            <div class="tabs-wrapper">
                                <ul id="tabs" class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a id="tab-A" href="{{ route('frontend.myaccount') }}" class="nav-link @if(Route::currentRouteName() == 'frontend.myaccount') active @endif ">
                                            <img src="{{ asset('images/icons/account-detail.svg') }}" alt="account-detail" class="deactive">
                                            <img src="{{ asset('images/icons/active-account-detail.svg') }}" alt="active-account-detail" class="active">
                                            Account Detail </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="tab-B" href="{{ route('frontend.myorders') }}" class="nav-link active">
                                            <img src="{{ asset('images/icons/order-history.svg') }}" alt="account-detail" class="deactive">
                                            <img src="{{ asset('images/icons/active-order-history.svg') }}" alt="active-account-detail" class="active">
                                            My Orders </a>
                                    </li>
                                </ul>
                            </div>

                            <div id="content" class="tab-content w-100" role="tablist">

                                <div id="myorders" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-B">
                                    <div class="card-header" role="tab" id="heading-B">
                                        <h5 class="mb-0">
                                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" data-bs-parent="#content" aria-expanded="false" aria-controls="collapse-B">
                                                <img src="{{ asset('images/icons/order-history.svg') }}" alt="account-detail" class="deactive">
                                                <img src="{{ asset('images/icons/active-order-history.svg') }}" alt="active-account-detail" class="active">
                                                My Orders
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">

                                        @if (count($myorders) > 0)
                                        <div class="card-body pt-0">

                                            <div class="shiiping-info-wrapper">
                                                <div class="d-flex justify-content-between">
                                                    <h6>Orders Details</h6>
                                                </div>
                                                @foreach ($myorders as $myorder)
                                                @php
                                                if($myorder->subcategory_slug){
                                                $product_url = route('frontend.product_detail', ['category' => $myorder->category_slug,'subcategory' =>
                                                $myorder->subcategory_slug,'product' => $myorder->product_slug]);
                                                }
                                                else if($myorder->category_slug){
                                                $product_url = route('frontend.show_sub_category_product', ['category' => $myorder->category_slug,'subcategory' =>
                                                $myorder->product_slug]);
                                                }
                                                @endphp

                                                <div class="order-history-box-wrapper">
                                                    <div class="order-history-box-item  d-flex ">
                                                        <div class="order-history-box-image">
                                                            <a href="{{$product_url}}">
                                                                @if($myorder->image)
                                                                <img src="{{ $myorder->image}}" alt="product">
                                                                @else
                                                                <img src="{{ asset('images/no_image.png') }}" alt="product" />
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="order-history-box-info">
                                                            <div class="order-history-box-title d-flex justify-content-between">
                                                                <h5><a href="{{$product_url}}">{{$myorder->product_name}}</a></h5>
                                                                <h6 class="price ms-2">{!! $myorder->currency_symbol.' '.number_format((float)($myorder->price), 3, '.', '') !!}</h6>
                                                            </div>
                                                            <div class="d-flex">
                                                                @if ($myorder->metal)
                                                                <h6 class="me-4 me-md-5">
                                                                    <span>Metal</span>
                                                                    {{$myorder->metal}} {{$myorder->material}}
                                                                </h6>
                                                                @endif
                                                                @if ($myorder->shape)
                                                                <h6 class="me-4 me-md-5">
                                                                    <span>Shape</span>
                                                                    {{$myorder->shape}}
                                                                </h6>
                                                                @endif
                                                                <h6>
                                                                    <span>QTY</span>
                                                                    {{$myorder->quantity}}
                                                                </h6>
                                                            </div>
                                                            <h4 class="tag-badge delivered-tag-badge ">{{ $myorder->orderStatus->name }}</h4>
                                                        </div>

                                                    </div>

                                                </div>
                                                @endforeach
                                                <div class="d-flex justify-content-between">
                                                    <h6>Subtotal</h6>
                                                    <h6>{!! $orders->currency_symbol !!} {{$orders->subtotal}}</h6>
                                                </div>
                                                @if($orders->shipping_charges > 0)
                                                <div class="d-flex justify-content-between">
                                                    <h6>Shipping Charges</h6>
                                                    <h6>{!! $orders->currency_symbol !!} {{$orders->shipping_charges}}</h6>
                                                </div>
                                                @endif
                                                @if($orders->coupon_code != '')
                                                <div class="d-flex justify-content-between">
                                                    <h6>Coupon Code</h6>
                                                    <h6>{{$orders->coupon_code}}</h6>
                                                </div>
                                                @endif
                                                @if($orders->discount > 0)
                                                <div class="d-flex justify-content-between">
                                                    <h6>Discount</h6>
                                                    <h6>{!! $orders->currency_symbol !!} {{$orders->discount}}</h6>
                                                </div>
                                                @endif
                                                <div class="d-flex justify-content-between">
                                                    <h6>Total Order Price</h6>
                                                    <h6>{!! $orders->currency_symbol !!} {{$orders->total}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>

                        </div>
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

</script>
@endpush
