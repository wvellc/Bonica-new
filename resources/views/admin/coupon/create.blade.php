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
                {{ Breadcrumbs::render("coupon".$page_title) }}
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
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="code">Code <span class="error">*</span></label>
                                    {{ Form::text('code', old('code') ? old('code') : $formObj->code, ['class' => 'form-control', 'placeholder' => 'Code', 'id' => 'code']) }}
                                    <!-- Error -->
                                    @if ($errors->has('code'))
                                        <div class="error">
                                            {{ $errors->first('code') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">&#8377;</span>
                                        </div>
                                        {{ Form::number('discount', old('discount') ? old('discount') : $formObj->discount, ['class' => 'form-control', 'placeholder' => 'Discount', 'id' => 'discount']) }}

                                      </div>
                                      @if ($errors->has('discount'))
                                      <div class="error">
                                          {{ $errors->first('discount') }}
                                      </div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="expired">Expired <span class="error">*</span></label>
                                    {{ Form::text('expired', old('expired') ? old('expired') : $formObj->expired, ['class' => 'form-control', 'id' => 'expired']) }}
                                    <!-- Error -->
                                    @if ($errors->has('expired'))
                                        <div class="error">
                                            {{ $errors->first('expired') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @php
                            $nameRequired=$statusRequired= 1;
                            @endphp

                            @include('admin.input.status')

						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
						<a href="{{ route('admin.coupon.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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
    $(function () {
        $('#expired').datepicker({
            format: 'dd/mm/yyyy'
        });
    });
</script>
@endpush

