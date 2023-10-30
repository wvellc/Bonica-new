@extends('admin.layouts.layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Order ID : {{$orders->order_id}}</h1>
                <h6 class="m-0">Payment ID : {{$orders->payment_id}}</h6>
			</div><!-- /.col -->
			<div class="col-sm-6">
				{{ Breadcrumbs::render("order".$page_title) }}
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
		@include('admin.layouts.alert_message')
        <div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header pt-0">
						<h3 class="card-title">User details</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row justify-content-start">
							<div class="col-lg-12">
								<table id="tbl_datatable" class="table table-responsive table-bordered ">

									<tbody>
										<tr>
											<td><b>First Name</b></td>
											<td>{{$orders->first_name}}</td>
											<td><b>Last Name</b></td>
											<td>{{$orders->last_name}}</td>
										</tr>

										<tr>
											<td><b>State</b></td>
											<td>{{$orders->state}}</td>
											<td><b>Country </b></td>
											<td>{{$orders->countryDetals->name}}</td>
										</tr>

										<tr>
											<td><b>Address </b></td>
											<td>{{$orders->street_address}}</td>
											<td><b>Appartment </b></td>
											<td>{{$orders->street_address2}}</td>
										</tr>

										<tr>
											<td><b>City </b></td>
											<td>{{$orders->city}}</td>
											<td><b>Pincode </b></td>
											<td>{{$orders->pincode}}</td>
										</tr>
										<tr>
											<td><b>Phone Number </b></td>
											<td>{{$orders->phone_number}}</td>
											<td></td>
											<td></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<div class="row">
			<div class="col-12">
                <div id="alert_msg"></div>
				<div class="card">
					<div class="card-header pt-0">
						<h3 class="card-title">Order details</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="tbl_datatable" class="table table-bordered ">
							<thead>
								<tr>
									<th>Product Image</th>
									<th>Product Name</th>
									<th>QTY</th>
                                    <th>Shape</th>
									<th>Metal</th>
									<th>Material</th>
									<th>Size</th>
                                    <th>CDcolor</th>
                                    <th>CDclarity</th>
                                    <th>SDcolor</th>
                                    <th>SDclarity</th>
									<th>Price</th>
                                    <th>Status</th>
								</tr>
							</thead>
							<tbody>
                                @foreach ($orderDetails as $orderDetail)
                                <tr>
									<td>
                                        @if ($orderDetail->image_path)
                                        <img width="100" src="{{$orderDetail->image_path}}" class="img-thumbnail" alt="category">
                                        @else
                                        <img width="100" src="{{ asset('images/default-img.png') }}" class="img-thumbnail" alt="category">
                                        @endif

                                    </td>
									<td>{{$orderDetail->product_name}}</td>
									<td>{{$orderDetail->quantity}}</td>
                                    <td>{{$orderDetail->shape}}</td>
									<td>{{$orderDetail->metal}}</td>
									<td>{{$orderDetail->material}}</td>
									<td>{{$orderDetail->size}}</td>
                                    <td>{{$orderDetail->center_diamond_color}}</td>
                                    <td>{{$orderDetail->center_diamond_clarity}}</td>
                                    <td>{{$orderDetail->side_diamond_color}}</td>
                                    <td>{{$orderDetail->side_diamond_clarity}}</td>
									<td>{!! $orderDetail->currency_symbol !!} {{$orderDetail->price}}</td>
                                    <td>
                                        @if (count($orderStatus) > 0)
                                        <div class="select-box">
                                        <select class="order_status form-control" name="order_status_{{$orderDetail->id}}" id="{{$orderDetail->id}}">
                                            @foreach ($orderStatus as $status)
                                            <option value="{{$status->id}}"  @if ($status->id == $orderDetail->order_status_id) selected  @endif>{{$status->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        @endif
                                    </td>
								</tr>
                                @endforeach
							</tbody>
						</table>
						<div class="row justify-content-end">
							<div class="col-lg-5  mt-5">
								<table id="tbl_datatable" class="table table-bordered ">
									<thead>
										<tr>
											<th colspan="2"><h5><b>Cart Totals</b></h5></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Subtotal</td>
											<td>{!! $orders->currency_symbol !!} {{$orders->subtotal}}</td>
										</tr>
										<tr>
											<td>Shipping Charges</td>
											<td>{!! $orders->currency_symbol !!} {{$orders->shipping_charges}}</td>
										</tr>
										<tr>
											<td>Coupon Code</td>
											<td>{{$orders->coupon_code}}</td>
										</tr>
                                        <tr>
											<td>Discount</td>
											<td>{!! $orders->currency_symbol !!} {{$orders->discount}}</td>
										</tr>
										<tr>
											<td><b>Total</b></td>
											<td><b>{!! $orders->currency_symbol !!} {{$orders->total}}</b></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>


		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
@stop
@push('js')
<script>
$('.order_status').on('change', function() {
    $.ajax({
                url: '{!! route("admin.order.shippingstatusupdate") !!}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": $(this).attr('id'),
                    "status_id": this.value
                },
                success: function(result) {

                    if(result.msg != ""){

                         msg_HTML = `<div class="col-xs-12 flashmessages">
                                        <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>${result.msg}</strong>
                                            </div>
                                        </div>`;
                            $('#alert_msg').html(msg_HTML);
                        }
                },
            });
  });

</script>
@endpush
