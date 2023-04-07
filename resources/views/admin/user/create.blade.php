@extends('admin.layouts.layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">{{ $module }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
                {{ Breadcrumbs::render("user".$page_title) }}
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
		@include('admin.layouts.alert_message')
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="card card-info">

					{{-- <div class="card-header">
						<h3 class="card-title">{{ $page_title }}</h3>
					</div> --}}
					<!-- /.card-header -->

					{{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method, 'enctype' => 'multipart/form-data', 'class' => 'form-vertical')) }}
                    @if ($method === "PUT")
                    <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                    @endif
					<!-- form start -->
					<div class="card-body">
						<div class="row">
                            @php
                            $nameRequired=$emailRequired=$passwordRequired=$statusRequired=$isSuperRequired=$confirmPasswordRequired=$genderRequired=$dobRequired= 1;
                            $imageRequired=$mobileRequired = 0;
                            @endphp
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>First Name <span class="error">*</span></label>
                                        {{ Form::text('first_name',(old('first_name'))?old('first_name'):$formObj->first_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'id' => 'first_name']) }}
                                        @if ($errors->has('first_name'))
                                        <span class="text-danger">
                                            {{ $errors->first('first_name') }}
                                        </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Last Name <span class="error">*</span></label>
                                    {{ Form::text('last_name',(old('last_name'))?old('last_name'):$formObj->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name', 'id' => 'last_name']) }}
                                    @if ($errors->has('last_name'))
                                    <span class="text-danger">
                                        {{ $errors->first('last_name') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @include('admin.input.email')
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ (old('phone_number'))?old('phone_number'):$formObj->phone_number }}">
                                    @if ($errors->has('phone_number'))
                                    <span class="text-danger">
                                        {{ $errors->first('phone_number') }}
                                    </span>
                                    @endif
                                </div>

                            </div>
                            @include('admin.input.password')
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label>Street Address</label>
                                    <input type="text" class="form-control" id="street_address" name="street_address" placeholder="Street Address" value="{{ (old('street_address'))?old('street_address'):$formObj->street_address }}">
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
                                    <input type="text" class="form-control" id="street_address2" name="street_address2" placeholder="App, suite, building" value="{{ (old('street_address2'))?old('street_address2'):$formObj->street_address2 }}">
                                    @if ($errors->has('street_address2'))
                                    <span class="text-danger">
                                        {{ $errors->first('street_address2') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ (old('city'))?old('city'):$formObj->city }}">
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
                                    <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pin Code" value="{{ (old('pincode'))?old('pincode'):$formObj->pincode }}">
                                    @if ($errors->has('pincode'))
                                    <span class="text-danger">
                                        {{ $errors->first('pincode') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ (old('state'))?old('state'):$formObj->state }}">
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
                                        <select class="form-control" name="country" id="country">
                                            @foreach($country as $key => $value)
                                                <option value="{{$key}}" @if($key == $formObj->country) selected @endif >{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            @include('admin.input.status')

                            {{--  @if($method !== "PUT")
                                @include('admin.input.password')
                            @endif  --}}

							{{--  @include('admin.input.image')  --}}


						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
						<a href="{{ route('admin.user.index') }}" class="btn btn-danger icon-btn">Cancel</a>
					</div>
					{{ Form::close() }}
				</div>
				<!-- /.card -->
			</div>
			<!--/.col (left) -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
@stop
@push('js')

<script>

    $(function() {
        $('#dob').datepicker({
            format: 'mm/dd/yyyy'
        });
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {
                var filesAmount = input.files.length;
                $('.imgPreview').html('');
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
    });
</script>
@endpush
