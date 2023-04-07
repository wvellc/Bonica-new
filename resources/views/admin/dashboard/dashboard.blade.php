@extends('admin.layouts.layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">{{$module}}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
        {{ Breadcrumbs::render('dashboard') }}
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<!-- ./col -->
			<div class="col-lg-4">
        <!-- small box -->
        <div class="card small-box bg-white height-manage">
          <div class="inner p-0">
            <h3 class="counter-count">{{$todayOrders}}</h3>
            <h4>Today Orders</h4>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <!-- <a href="{{ route('admin.order.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>


      <div class="col-lg-4">
        <div class="card small-box bg-white  height-manage">
          <div class="inner p-0">
            <h3  id="total_sales_value"></h3>
            <h4>Sales Value</h4>
            <div class="select-box mt-3">
              <select name="sales_value" id="sales_value" class="form-control">
                @foreach ($months as $key => $month)
                <option value="{{$key}}-{{date('Y')}}" @if(date('F')==$month) selected @endif><a class="nav-item active">{{$month}}
                {{date('Y')}}</a></option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
            <!-- <ion-icon name="card-outline"></ion-icon> -->
          </div>
          <!-- <a href="{{ route('admin.order.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
        <!--  -->
      </div>

      <div class="col-lg-4">
        <div class="card  height-manage">
          <div class="card-header border-transparent">
            <h3 class="card-title">Top Selling Categories</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Total Orders</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($latesSaleCategorys) > 0)
                  @foreach ($latesSaleCategorys as $latesSaleCategory)
                  <tr>
                    <td>{{$latesSaleCategory->name}}</td>
                    <td>{{$latesSaleCategory->total_orders}}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td>Record Not Found!</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-12">
        <div class="card height-manage">
          <div class="card-header border-transparent">
            <h3 class="card-title">Latest Orders</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Order Date</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($latesOrders) > 0)
                  @foreach ($latesOrders as $latesOrder)
                  <tr>
                    <td><a href="{{ route('admin.order.show', $latesOrder->id) }}">{{$latesOrder->order_id}}</a></td>
                    <td>{{$latesOrder->first_name}}</td>
                    <td>{!! $latesOrder->currency_symbol !!} {{$latesOrder->total}}</td>
                    <td>
                      {{ \Carbon\Carbon::parse($latesOrder->created_at)->format('m/d/Y') }}
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td>Record Not Found!</td>
                  </tr>
                  @endif

                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- ./col -->
      </div>

      <div class="col-lg-6 col-12">
        <div class="card height-manage">
          <div class="card-header border-transparent">
            <h3 class="card-title">New User Registered</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Register Date</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($latesCustomers) > 0)
                  @foreach ($latesCustomers as $latesCustomer)
                  <tr>
                    <td>{{$latesCustomer->first_name}}</td>
                    <td>{{$latesCustomer->last_name}}</td>
                    <td>{{$latesCustomer->email}}</td>
                    <td>
                      {{ \Carbon\Carbon::parse($latesCustomer->created_at)->format('m/d/Y') }}
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td>Record Not Found!</td>
                  </tr>
                  @endif

                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

@endsection
@push('js')

<script>

  $(document).ready(function ()
  {
    var sales_value = $('#sales_value').val();
    getSalesValue(sales_value);
    $('#sales_value').on('change', function ()
    {
      console.log(this.value);
      getSalesValue(this.value);
    });
  });
  function getSalesValue(month_year) {
    $.ajax({
      type: "POST",
      url: '{!! route('admin.sales.value') !!}',
      data: {
        _token: "{{ csrf_token() }}",
        month_year: month_year,
      },
      beforeSend: function ()
      {
            //$('#divimage-' + id).html('<img src="{{asset('images / spinner1.gif')}}" alt="spinner"/>');
      },
      dataType: 'JSON',
      success: function (data)
      {
        $('#total_sales_value').html(data.total_payment);
      }
    });

  }


  $('.counter-count').each(function () {
    $(this).prop('Counter',0).animate({
      Counter: $(this).text()
    }, {
      //chnage count up speed here
      duration: 1000,
      easing: 'swing',
      step: function (now) {
        $(this).text(Math.ceil(now));
      }
    });
  });
</script>
@endpush
