@extends('frontend.layouts.layout')
@section('title', 'My wishlist | Bonica Jewels')
@section('meta_description', "LATEST COLLECTION Lab Grown Diamonds Stunning selection and the option to choose from a wide range of diamondContinue Reading 'Bonica Jewels'")
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<div class="full-page-overlay"></div>
    <div class="wishlist-list-page">
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
									<li class="breadcrumb-item active" aria-current="page">Wishlist</li>
								</ol>
							</nav>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-12 col-xl-12  text-center">
							<div class="section-title text-center">
								<h2>My wishlist</h2>
							</div>
						</div>
					</div>
					<div class="row align-items-center justify-content-between">
						<div class="col-md-12 col-xl-12">
							<div class="filter-mobile-title my-3 d-flex align-items-center justify-content-between d-md-none text-end">
								<p class="p-0">Items - <span>40</span></p>
								<p class="filter-toggle ">Filter <img src="{{ asset('images/icons/filter.svg') }}" alt="filter" class="ms-2" />	</p>
							</div>
							<div class="filter-section  align-items-center justify-content-end flex-wrap mt-1">

								<ul class="filter-list d-flex align-items-center flex-wrap ">

									<li>
										<div class="btn-group">
											<button type="button" class="btn btn-filetr dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
												Sort Type
											</button>
											<ul class="dropdown-menu dropdown-menu-end">
												<li><a class="dropdown-item active" href="#">Item Type</a></li>
												<li><a class="dropdown-item" href="#">Price </a></li>
											</ul>
										</div>

									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row align-items-center justify-content-between mt-3">
						<div class="col-md-12 col-xl-12">
							<div class="main-prodcut-box-wrapper" id="prodcut-box"></div>
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
<!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(function() {
        gatData();
        });
        function gatData()
        {
            var url = '{!! route("frontend.get-wishlist-data") !!}';
            $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $("#prodcut-box").html('<div class="product-loader"><img src="{{asset('images/spinner2.gif')}}" alt="spinner"/></div>');
                    },
                    complete: function(){
                        //$("#div_load_more").html('<button onclick="loadMore();"  class="btn btn-primary btn-load-more">Load More</button>');
                    },
                    success: function (data) {
                        if(data.msg == 'success'){
                            $('#prodcut-box').html(data.ProductData_Html);
                        }
                    },
                    error:function (response) {
                        //$('#error_rating').html(response.responseJSON.errors.rating);
                    }
                });
            }
            function deleteWishlist(product_id){
                var url = '{!! route("frontend.delete-wishlist") !!}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        product_id: product_id,
                    },
                    dataType: 'JSON',
                    success: function (data)
                    {
                        if (data.msg == 'success')
                        {
                            $('.mywishlist-count').html(data.wishlist_count);
                            $('#product-' + product_id).remove();
                        } else
                        {
                            swal({
                                title: "Deleted",
                                text: data.message,
                                type: "error",
                            });
                        }
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
                                product_id: product_id,
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                if(data.msg == 'success'){
                                    $('.mywishlist-count').html(data.wishlist_count);
                                    $('#product-'+product_id).remove();
                                } else {
                                    swal({
                                        title: "Deleted",
                                        text: data.message,
                                        type: "error",
                                    });
                                }
                            }
                        });
                    }); */
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
                            quantity : 1,
                            callfrom : 'wishlist'
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
                                $('.mywishlist-count').html(data.wishlist_count);
                                $('.cart-count').html(data.cart_count);
                                toastr.success(product_name+' has been added to your cart.');
                                $('#product-'+product_id).remove();
                            }
                        },
                        error:function (response) {
                            //$('#error_rating').html(response.responseJSON.errors.rating);

                        }
                    });
            }
    </script>
@endpush
