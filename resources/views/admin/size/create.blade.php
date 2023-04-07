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
                {{ Breadcrumbs::render("size".$page_title) }}
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
                            $nameRequired=$statusRequired= 1;
                            @endphp
                            @include('admin.input.name')
                            <!-- <div class="col-12 col-sm-6">
                                <div class="form-group dollor-sign">
                                    <label id="lblprice">Price (&#8377;)</label>
                                    {{ Form::number('price', old('price') ? old('price') : $formObj->price, ['class' => 'form-control',
                                    'placeholder' => 'Price', 'id' => 'price','step'=> 'any']) }}

                                    @if ($errors->has('price'))
                                    <div class="text-danger">
                                        {{ $errors->first('price') }}
                                    </div>
                                    @endif
                                </div>
                            </div> -->
                            <div class="col-12 col-sm-12 col-lg-6 select-inner-design-wrapper multi-select-with-checkbo-wrapper">
                                <div class="form-group">
                                    <label for="country">Country <span class="error">*</span></label>

                                    {!! Form::select('country[]',$country,$selectedCountryID, ['class' => 'form-control','id' => 'country','multiple' =>
                                    'multiple']) !!}
                                    <!-- Error -->
                                    @if ($errors->has('country'))
                                    <div class="error">
                                        {{ $errors->first('country') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="email">Sort Order</label>
                                    {{ Form::number('sort_order',(old('sort_order'))?old('sort_order'):$formObj->sort_order, ['class' => 'form-control', 'placeholder' => 'Sort Order', 'id' => 'sort_order']) }}
                                </div>

                            </div> -->
                            @include('admin.input.status')
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
						<a href="{{ route('admin.size.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
<script>

    $(document).ready(function ()
        {

            $('#country').multiselect({
                maxHeight: 250,
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonText: function (options, select)
                {
                    if (options.length == 0)
                    {
                        return 'Select Country';
                    }
                    else
                    {
                        var selected = '';
                        options.each(function ()
                        {
                            selected += $(this).text() + ', ';

                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });

        });

</script>
@endpush

