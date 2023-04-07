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
                {{ Breadcrumbs::render("packet".$page_title) }}
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
				<div class="card card-info" style="min-height: 500px;">
					{{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method, 'enctype' => 'multipart/form-data', 'class' => 'form-vertical')) }}
                    @if ($method === "PUT")
                    <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                    @endif
					<!-- form start -->
					<div class="card-body">
						<div class="row">
                            @php
                            $nameRequired=$statusRequired= 1;
                            @endphp
                            @include('admin.input.name')
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="diamond_size">Diamond Size <span class="error">*</span></label>
                                    {{ Form::text('diamond_size', old('diamond_size') ? old('diamond_size') : $formObj->diamond_size, ['class' => 'form-control', 'placeholder' => 'Diamond Size', 'id' => 'diamond_size']) }}
                                    <!-- Error -->
                                    @if ($errors->has('diamond_size'))
                                        <div class="error">
                                            {{ $errors->first('diamond_size') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="shape">Shape <span class="error">*</span></label>
                                    <div class="select-box">
                                    {!! Form::select('shape', ['' => 'Select Shape'] + $shape,$selectedshapeID, ['class' => 'form-control','id' => 'shape']) !!}
                                    </div>
                                    <!-- Error -->
                                    @if ($errors->has('shape'))
                                    <div class="error">
                                        {{ $errors->first('shape') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="color">Color <span class="error">*</span></label>
                                    <div class="select-box">
                                    {!! Form::select('color', ['' => 'Select Color'] + $color,$selectedcolorID, ['class' => 'form-control','id' => 'color']) !!}
                                    </div>
                                    <!-- Error -->
                                    @if ($errors->has('color'))
                                    <div class="error">
                                        {{ $errors->first('color') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="clarity">Metal <span class="error">*</span></label>
                                    <div class="select-box">
                                    {!! Form::select('clarity', ['' => 'Select Clarity'] + $clarity,$selectedclarityID, ['class' => 'form-control','id' => 'clarity']) !!}
                                    </div>
                                    <!-- Error -->
                                    @if ($errors->has('clarity'))
                                    <div class="error">
                                        {{ $errors->first('clarity') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group dollor-sign">
                                    <label id="price">Price / CT <span class="error">*</span></label>
                                    {{ Form::number('price', old('price') ? old('price') : $formObj->price, ['class' => 'form-control', 'placeholder' => 'Price', 'id' => 'price','step'=> 'any']) }}

                                    @if ($errors->has('price'))
                                        <div class="text-danger">
                                            {{ $errors->first('price') }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                            @include('admin.input.status')
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
						<a href="{{ route('admin.packet.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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
@endpush

