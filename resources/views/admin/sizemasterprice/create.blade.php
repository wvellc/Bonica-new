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
                {{ Breadcrumbs::render("sizemasterprice".$page_title) }}
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
					@php $lastcount = 1; @endphp
					<div class="card-body">
						@foreach($sizeMasterPrices as $key => $sizeMasterPrice)	
	                        <div class="col-12" id="divimage-{{ $sizeMasterPrice->id }}">
								<div class="row" >
									@php
		                                $lastcount = $sizeMasterPrice->id;
		                            @endphp
		                            <div class="col-sm-3">
		                                <div class="form-group">
		                                    <label for="size">Category <span class="error">*</span></label>
		                                    <div class="select-box">
		                                        {!! Form::select('category[]', ['' => 'Select Category'] + $parent_category,$sizeMasterPrice->category_id, ['class' => 'form-control category','id' => 'category','onchange'=> "updateContent($sizeMasterPrice->id,this.value,'category_id')"]) !!}
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-sm-2">
		                                <div class="form-group dollor-sign">
		                                    <label id="price">Price </label>
		                                    {{ Form::number('update_price[]', old('price') ? old('price') : $sizeMasterPrice->price, ['class' => 'form-control',
		                                    'placeholder' => 'Price', 'id' => 'price','onchange'=> "updateContent($sizeMasterPrice->id,this.value,'price')"]) }}
		                                </div>
		                            </div>                            
		                            <div class="col-sm-3">
		                                <div class="form-group">
		                                    <label for="size">Select Min Size Range <span class="error">*</span></label>
		                                    <div class="select-box">
		                                        {!! Form::select('update_min_size[]', ['' => 'Select Min Size Range']+$size ,$sizeMasterPrice->min_size, ['class' => 'form-control size_'.$sizeMasterPrice->id,'id' => 'min_size','onchange'=> "updateContent($sizeMasterPrice->id,this.value,'min_size')"]) !!}
		                                    
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-sm-3">
		                                <div class="form-group">
		                                    <label for="size">Select Max Size Range <span class="error">*</span></label>
		                                    <div class="select-box">
		                                        {!! Form::select('update_max_size[]', ['' => 'Select Max Size Range']+$size,$sizeMasterPrice->max_size, ['class' => 'form-control size_'.$sizeMasterPrice->id,'id' => 'max_size','onchange'=> "updateContent($sizeMasterPrice->id,this.value,'max_size')"]) !!}
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-sm-1 deletepricebtn">
		                            	<button onclick="deleteData('{{ $sizeMasterPrice['id'] }}')" class="btn btn-danger btn-sm remove-action btn-action btndelete" title="Delete"><i class="fas fa-trash"></i></button>
		                            </div>
		                        </div>
	                        </div> 
                        @endforeach
					</div>
					@php
						$lastcount += 1;
					@endphp
					<div class="col-sm-12" id="div_images">
                        <div class="row mb-2 align-items-center" id="row-{{ $lastcount }}">
                        	 <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="mls">Category<span class="error">*</span></label>
                                    <div class="select-box">
                                    {!! Form::select('category[1]', ['' => 'Select Category'] + $parent_category,$selectedParentID, ['class' => 'form-control','id' => 'category','required','onchange'=> "updateContent($lastcount,this.value,'category_id')"]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group ">
                                    <label id="price">Price </label>
                                    {{ Form::number('price[1]',(old('price')[1] ?? ''), ['class' => 'form-control price', 'placeholder' => 'Price', 'id' => 'price'.$lastcount]) }}
                                </div>
                            </div>                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="min_size">Select Min Size Range <span class="error">*</span></label>
                                    <div class="select-box">
                                        {{ Form::select('min_size[1]',['' => 'Select Min Size Range']+ $size,(old('min_size')[1] ?? ''), ['class' => 'form-control size_'. $lastcount, 'id' => 'min_size'.$lastcount]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="max_size">Select Max Size Range <span class="error">*</span></label>
                                    <div class="select-box">
                                        {{ Form::select('max_size[1]',['' => 'Select Max Size Range']+ $size,(old('max_size')[1] ?? ''), ['class' => 'form-control size_'. $lastcount, 'id' => 'max_size'.$lastcount]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="text-center col-lg-12">
		                <a href="javascript:void(0)" class="btn btn-primary add-itemBtn"><span class="plus-icon"></span> Add More</a>
		                <input type="hidden" name="lastcount" id="lastcount" value="{{ $lastcount }}">
			        </div> 
					<div class="card-footer">
						<button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
						<a href="{{ route('admin.size-master-price.index') }}" class="btn btn-danger icon-btn">Cancel</a>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</section>
@stop

@push('js')
<script type="text/javascript">
	$(".add-itemBtn").click(function() {
	    var last_count = $('#lastcount').val();
	    var riw_id = parseInt(last_count) + 1;
	    
	    var price_html = `<div class="row mb-2 align-items-center" id="row-${riw_id}">
	    	<div class="col-sm-3 form-group">
	            <label for="size">Category</label>
	            {!! Form::select('category[${riw_id}]', ['' => 'Select Category']+$parent_category, null, [ // Provide the options for the select box
	                    'class' => 'form-control category',
	                    'id' => 'category${riw_id}', // Use riw_id instead of parseInt(last_count) + 1
	                    'onchange'=> 'updateContent(${riw_id}, this.value, "category_id")'
	                ]) !!}
	        </div>
	        <div class="col-sm-2 form-group">
	            <label for="price">Price</label>
	            {!! Form::number('price[${riw_id}]', null, [
	                    'class' => 'form-control price',
	                    'id' => 'price${riw_id}', // Use riw_id instead of parseInt(last_count) + 1
	                    'rows' => '4',
	                    'placeholder'=>'Price'
	                ]) !!}
	        </div>
	        <div class="col-sm-3 form-group">
	            <label for="size">Select Min Size Range</label>
	            {!! Form::select('min_size[${riw_id}]', ['' => 'Select Min Size Range']+$size, null, [ // Provide the options for the select box
	                    'class' => 'form-control size_${riw_id}',
	                    'id' => 'min_size${riw_id}', // Use riw_id instead of parseInt(last_count) + 1
	                ]) !!}
	        </div>
	        <div class="col-sm-3 form-group">
	            <label for="size">Select Max Size Range</label>
	            {!! Form::select('max_size[${riw_id}]', ['' => 'Select Max Size Range']+$size, null, [ // Provide the options for the select box
	                    'class' => 'form-control size_${riw_id}',
	                    'id' => 'max_size${riw_id}', // Use riw_id instead of parseInt(last_count) + 1
	                ]) !!}
	        </div>
	        <div class="col-sm-1">
	            <button id="${riw_id}" class="btn btn-danger btn-sm remove-action btn-action btndelete" title="Delete"><i class="fas fa-trash"></i></button>
	        </div>
	    </div>`;

	    $('#div_images').append(price_html);

	    $('#lastcount').val(riw_id);
	});

    $(document).on('click', '.btndelete', function() {
        var button_id = $(this).attr("id");
        $('#row-' + button_id + '').remove();
    });

    function deleteData(id) {
        var msg_HTML = "";
        $.ajax({
            type: "POST",
            url: '{!! route('admin.size-master-price.delete.prices') !!}',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
            },
            beforeSend: function() {
         		$('#divimage-' + id).html(
               	'<img src="{{ asset('images/spinner1.gif') }}" alt="spinner"/>');
      
            },
            dataType: 'JSON',
            success: function(data) {
                if (data.msg == 'delete') {
                    $('#divimage-' + id).hide();

                    msg_HTML = `<div class="col-xs-12 flashmessages">
                                    <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>${data.message}</strong>
                                        </div>
                                    </div>`;
                    $('#alert_msg').html(msg_HTML);
                }
            }
        });
    }

    function updateContent(id,value,field){

    	if(field == 'category_id'){
	    	var selectBox = $(".size_"+id);
			selectBox.empty().append('<option value="">---Select Size---</option>');
    		$.ajax({
	            type: "POST",
	            url: '{!! route('admin.size-master-price.sizechange') !!}',
	            data: {
	                _token: "{{ csrf_token() }}",
	                id: id,
	                value: value,
	                field: field,
	            },
	            dataType: 'JSON',
	            success: function(response) {
	                if (response.code == 200) {
	                	var size = response.data;
	                	
					    // Loop through the new options and append them to the select box
					    $.each(size, function(value, text) {
					        selectBox.append($('<option>', {
					            value: value,
					            text: text
					        }));
					    });
	                }
	            }
        	});
    	}

    	var msg_HTML = "";
        $.ajax({
            type: "POST",
            url: '{!! route('admin.size-master-price.price.update') !!}',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                value: value,
                field: field,
            },
            dataType: 'JSON',
            success: function(data) {
                if (data.msg == 'update') {
                    msg_HTML = `<div class="col-xs-12 flashmessages">
                                    <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>${data.message}</strong>
                                        </div>
                                    </div>`;
                    $('#alert_msg').html(msg_HTML);
                }
            }
        });
    }
</script>
@endpush