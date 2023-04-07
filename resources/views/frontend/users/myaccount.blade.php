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
                            <a href="{{ route('frontend.logout') }}"
                                class="btn btn-primary btn-small ms-sm-2">Logout</a>
                        </div>

                        <div class="tab-container d-flex  mt-4 mt-md-4">
                            <div class="tabs-wrapper">
                                <ul id="tabs" class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a id="tab-A" href="{{ route('frontend.myaccount') }}"
                                            class="nav-link @if(Route::currentRouteName() == 'frontend.myaccount') active @endif ">
                                            <img src="{{ asset('images/icons/account-detail.svg') }}"
                                                alt="account-detail" class="deactive">
                                            <img src="{{ asset('images/icons/active-account-detail.svg') }}"
                                                alt="active-account-detail" class="active">
                                            Account Detail </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="tab-B" href="{{ route('frontend.myorders') }}"
                                            class="nav-link @if(Route::currentRouteName() == 'frontend.myorders') active @endif ">
                                            <img src="{{ asset('images/icons/order-history.svg') }}"
                                                alt="account-detail" class="deactive">
                                            <img src="{{ asset('images/icons/active-order-history.svg') }}"
                                                alt="active-account-detail" class="active">
                                            My Orders </a>
                                    </li>
                                    <!-- <li class="nav-item">
											<a id="tab-C" href="login.php" class="nav-link"> Logout </a>
										</li> -->
                                </ul>
                            </div>

                            <div id="content" class="tab-content w-100" role="tablist">
                                <div id="profile"
                                    class="card tab-pane fade @if(Route::currentRouteName() == 'frontend.myaccount') show active @endif"
                                    role="tabpanel" aria-labelledby="tab-A">
                                    <div class="card-header" role="tab" id="heading-A">

                                        <h5 class="mb-0">
                                            <a data-bs-toggle="collapse" href="#collapse-A" data-bs-parent="#content"
                                                aria-expanded="true" aria-controls="collapse-A">
                                                <img src="{{ asset('images/icons/account-detail.svg') }}"
                                                    alt="account-detail" class="deactive">
                                                <img src="{{ asset('images/icons/active-account-detail.svg') }}"
                                                    alt="active-account-detail" class="active">
                                                Account Detail
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse-A" class="collapse show" role="tabpanel"
                                        aria-labelledby="heading-A">
                                        <div class="card-body pt-0">
                                            <div class="shiiping-info-wrapper">
                                                <div class="d-flex justify-content-between">
                                                    <h6>Shipping Information</h6>
                                                </div>
                                                @include('layouts.alert_message')
                                                <div class="inner-form-wrapper">
                                                    {{ Form::open(array('url' => route('frontend.save.myaccount'),
                                                    'method'=> 'POST', 'enctype' => 'multipart/form-data')) }}
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label>First Name <span class="error">*</span></label>
                                                                <input type="text" class="form-control" id="first_name"
                                                                    name="first_name" placeholder="First Name"
                                                                    value="{{ (old('first_name'))?old('first_name'):$formObj->first_name }}">
                                                                @if ($errors->has('first_name'))
                                                                <span class="text-danger">
                                                                    {{ $errors->first('first_name') }}
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label>Last Name <span class="error">*</span></label>
                                                                <input type="text" class="form-control" id="last_name"
                                                                    name="last_name" placeholder="Last Name"
                                                                    value="{{ (old('last_name'))?old('last_name'):$formObj->last_name }}">
                                                                @if ($errors->has('last_name'))
                                                                <span class="text-danger">
                                                                    {{ $errors->first('last_name') }}
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label>Email Address <span class="error">*</span></label>
                                                                <input type="text" class="form-control" id="email"
                                                                    name="email" placeholder="Email"
                                                                    value="{{ (old('email'))?old('email'):$formObj->email }}">
                                                                @if ($errors->has('email'))
                                                                <span class="text-danger">
                                                                    {{ $errors->first('email') }}
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label>Phone Number <span class="error">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="phone_number" name="phone_number"
                                                                    placeholder="Phone Number"
                                                                    value="{{ (old('phone_number'))?old('phone_number'):$formObj->phone_number }}" onkeypress="return /[0-9]/i.test(event.key)" maxlength="10" minlength="10">
                                                                @if ($errors->has('phone_number'))
                                                                <span class="text-danger">
                                                                    {{ $errors->first('phone_number') }}
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label>Street Address</label>
                                                                <input type="text" class="form-control"
                                                                    id="street_address" name="street_address"
                                                                    placeholder="Street Address"
                                                                    value="{{ (old('street_address'))?old('street_address'):$formObj->street_address }}">
                                                                @if ($errors->has('street_address'))
                                                                <span class="text-danger">
                                                                    {{ $errors->first('street_address') }}
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label>App, suite, building (opt)</label>
                                                                <input type="text" class="form-control"
                                                                    id="street_address2" name="street_address2"
                                                                    placeholder="App, suite, building"
                                                                    value="{{ (old('street_address2'))?old('street_address2'):$formObj->street_address2 }}">
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
                                                                <label>City</label>
                                                                <input type="text" class="form-control" id="city"
                                                                    name="city" placeholder="City"
                                                                    value="{{ (old('city'))?old('city'):$formObj->city }}">
                                                                @if ($errors->has('city'))
                                                                <span class="text-danger">
                                                                    {{ $errors->first('city') }}
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label>Pincode</label>
                                                                <input type="number" class="form-control" id="pincode"
                                                                    name="pincode" placeholder="Pin Code"
                                                                    value="{{ (old('pincode'))?old('pincode'):$formObj->pincode }}">
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
                                                                <label>State</label>
                                                                <input type="text" class="form-control" id="state"
                                                                    name="state" placeholder="State"
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
                                                                <label>Country</label>
                                                                <div class="select-box">
                                                                    <select class="form-control" name="country"
                                                                        id="country">
                                                                        @foreach($country as $key => $value)
                                                                        <option value="{{$key}}" @if($key==$formObj->
                                                                            country) selected @endif >{{$value}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="myorders"
                                    class="card tab-pane fade @if(Route::currentRouteName() == 'frontend.myorders') show active @endif"
                                    role="tabpanel" aria-labelledby="tab-B">
                                    <div class="card-header" role="tab" id="heading-B">
                                        <h5 class="mb-0">
                                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B"
                                                data-bs-parent="#content" aria-expanded="false"
                                                aria-controls="collapse-B">
                                                <img src="{{ asset('images/icons/order-history.svg') }}"
                                                    alt="account-detail" class="deactive">
                                                <img src="{{ asset('images/icons/active-order-history.svg') }}"
                                                    alt="active-account-detail" class="active">
                                                My Orders
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                                        <div class="card-body pt-0">
                                            <div class="shiiping-info-wrapper">
                                                <div class="d-flex justify-content-between">
                                                    <h6>Orders History</h6>
                                                </div>
                                                @if (count($myorders) > 0)
                                                <div class="order-history-box-wrapper">
                                                    @foreach ($myorders as $myorder)
                                                    <div class="order-history-box-item  d-flex ">
                                                        <div class="order-history-box-info">
                                                            <div
                                                                class="order-history-box-title d-flex justify-content-between">
                                                                <h5><a
                                                                    href="{{route('frontend.myorders-detail', ['order_id' => $myorder->order_id])}}">{{$myorder->order_id}}</a>
                                                                </h5>
                                                                <h6 class="price ms-2">{!! $myorder->currency_symbol.'
                                                                    '.number_format((float)($myorder->total), 2, '.',
                                                                    '') !!}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>
                                        </div>
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
