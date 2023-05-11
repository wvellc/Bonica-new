@extends('admin.layouts.layout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $module }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    {{ Breadcrumbs::render('product' . $page_title) }}
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="main-prodcut-box-wrapper" id="prodcut-box"></div>
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

                        {{ Form::open(['url' => route($action_url, $action_params), 'method' => $method, 'enctype' => 'multipart/form-data', 'class' => 'form-vertical', 'id' => 'frmproduct']) }}
                        @if ($method === 'PUT')
                            <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                        @endif
                        <!-- form start -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="mls">Category <span class="error">*</span></label>
                                        <div class="select-box">
                                            {!! Form::select('cat_id', ['' => 'Select Category'] + $category, $selectedcatID, [
                                                'class' => 'form-control',
                                                'id' => 'cat_id',
                                            ]) !!}
                                        </div>
                                        <!-- Error -->
                                        <div class="error" id="error_category"></div>
                                        @if ($errors->has('cat_id'))
                                            <div class="error">
                                                {{ $errors->first('cat_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="mls">Sub Category</label>
                                        <div class="select-box">
                                            {!! Form::select('sub_cat_id', ['' => 'Select Sub Category'], $selectedsubcatID, [
                                                'class' => 'form-control',
                                                'id' => 'sub_cat_id',
                                            ]) !!}
                                        </div>
                                        <!-- Error -->
                                        @if ($errors->has('sub_cat_id'))
                                            <div class="error">
                                                {{ $errors->first('sub_cat_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="error">*</span></label>
                                        {{ Form::text('name', old('name') ? old('name') : $formObj->name, ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name']) }}
                                        <!-- Error -->
                                        <div class="error" id="error_name"></div>
                                        @if ($errors->has('name'))
                                            <div class="error">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="sku">Reference </label>
                                        {{ Form::text('sku', old('sku') ? old('sku') : $formObj->sku, ['class' => 'form-control', 'placeholder' => 'Reference', 'id' => 'sku']) }}
                                        <!-- Error -->
                                        @if ($errors->has('sku'))
                                            <div class="error">
                                                {{ $errors->first('sku') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="description">Description <span class="error">*</span></label>
                                        {!! Form::textarea('description', old('description') ? old('description') : $formObj->description, [
                                            'class' => 'form-control',
                                            'id' => 'description',
                                            'rows' => 2,
                                            'cols' => 40,
                                        ]) !!}
                                        <!-- Error -->
                                        <div class="error" id="error_description"></div>
                                        @if ($errors->first('description'))
                                            <div class="error">
                                                {{ $errors->first('description') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3" id="div_sales_price" style="display: none;">
                                    <div class="form-group dollor-sign">
                                        <label>Price (&#8377;)<span class="error">*</span></label>
                                        {{ Form::number('sales_price', old('sales_price') ? old('sales_price') : $formObj->sales_price, ['class' => 'form-control', 'placeholder' => 'Sales Price', 'id' => 'sales_price', 'step' => 'any']) }}
                                        <div class="error" id="error_sales_price"></div>
                                        @if ($errors->has('sales_price'))
                                            <div class="text-danger">
                                                {{ $errors->first('sales_price') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Quantity <span class="error">*</span></label>
                                        <input type="number" name="quantity" id="quantity" class="form-control"
                                            placeholder="Quantity" onkeypress="return /[0-9]/i.test(event.key)"
                                            value="{{ old('quantity') ? old('quantity') : $formObj->quantity }}" min="1">

                                        <div class="error" id="error_quantity"></div>
                                        @if ($errors->has('quantity'))
                                            <div class="text-danger">
                                                {{ $errors->first('quantity') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="select-box">
                                            {!! Form::select('gender', [0 => 'Select Gender'] + ['1' => 'Men', '2' => 'Women'], $formObj->gender, [
                                                'class' => 'form-control',
                                                'id' => 'gender',
                                            ]) !!}
                                        </div>
                                        @if ($errors->has('gender'))
                                            <div class="text-danger">
                                                {{ $errors->first('gender') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Size</label>
                                        {{ Form::number('product_size', old('product_size') ? old('product_size') : $formObj->product_size, ['class' => 'form-control', 'placeholder' => 'Size', 'id' => 'product_size', 'step' => 'any']) }}
                                        @if ($errors->has('product_size'))
                                            <div class="text-danger">
                                                {{ $errors->first('product_size') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Made In</label>
                                        {{ Form::text('made_in', old('made_in') ? old('made_in') : $formObj->made_in, ['class' => 'form-control', 'placeholder' => 'Made In', 'id' => 'made_in']) }}
                                        @if ($errors->has('made_in'))
                                            <div class="text-danger">
                                                {{ $errors->first('made_in') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Metal</label>
                                        {{ Form::text('metal', old('metal') ? old('metal') : $formObj->metal, ['class' => 'form-control', 'placeholder' => 'Metal', 'id' => 'metal']) }}
                                        @if ($errors->has('metal'))
                                            <div class="text-danger">
                                                {{ $errors->first('metal') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Stone</label>
                                        {{ Form::text('stone', old('stone') ? old('stone') : $formObj->stone, ['class' => 'form-control', 'placeholder' => 'Stone', 'id' => 'stone']) }}
                                        @if ($errors->has('stone'))
                                            <div class="text-danger">
                                                {{ $errors->first('stone') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="clarity">Clarity</label>
                                        {{ Form::text('clarity', old('clarity') ? old('clarity') : $formObj->clarity, ['class' => 'form-control', 'placeholder' => 'Clarity', 'id' => 'clarity']) }}
                                        @if ($errors->has('clarity'))
                                            <div class="text-danger">
                                                {{ $errors->first('clarity') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Color</label>
                                        {{ Form::text('color', old('color') ? old('color') : $formObj->color, ['class' => 'form-control', 'placeholder' => 'Color', 'id' => 'color']) }}
                                        @if ($errors->has('color'))
                                            <div class="text-danger">
                                                {{ $errors->first('color') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Diamond Weight</label>
                                        {{ Form::number('diamond_weight', old('diamond_weight') ? old('diamond_weight') : $formObj->diamond_weight, ['class' => 'form-control', 'placeholder' => 'Diamond Weight', 'id' => 'diamond_weight', 'step' => 'any']) }}
                                        @if ($errors->has('diamond_weight'))
                                            <div class="text-danger">
                                                {{ $errors->first('diamond_weight') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3" id="div_igi_certified_text" style="display: none">
                                    <div class="form-group">
                                        <label for="igi_certified_text">IGI Certificate Text</label>
                                        {{ Form::text('igi_certified_text', old('igi_certified_text') ? old('igi_certified_text') : $formObj->igi_certified_text, ['class' => 'form-control', 'placeholder' => 'IGI Certified Text', 'id' => 'igi_certified_text']) }}
                                        @if ($errors->has('igi_certified_text'))
                                            <div class="text-danger">
                                                {{ $errors->first('igi_certified_text') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3" id="div_igi_certified" style="display: none">
                                    <div class="form-group">
                                        <label for="igi_certified">IGI Certificate</label>
                                        <input type="file" name="igi_certified" class="form-control"
                                            id="igi_certified">
                                        <!-- Error -->
                                        @if ($errors->first('igi_certified'))
                                            <div class="error">
                                                {{ $errors->first('igi_certified') }}
                                            </div>
                                        @endif
                                        @isset($formObj->igi_certified)
                                            <div class="imgPreview">
                                                @if (pathinfo($formObj->igi_certified, PATHINFO_EXTENSION) != 'pdf')
                                                    <img src="{{ URL::asset('uploads/product/' . $formObj->igi_certified) }}"
                                                        width="300px" class="img-thumbnail" alt="IGI Certified">
                                                @else
                                                    {!! Html::link('uploads/product/' . $formObj->igi_certified, 'Certificate') !!}
                                                @endif
                                            </div>
                                        @endisset

                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group dollor-sign">
                                        <div class="icheck-primary">
                                            <input type="checkbox" @if ($formObj->recommended) checked @endif
                                                id="recommended" name="recommended" value="1">
                                            <label for="recommended">
                                                Recommended
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="recommended_hover_image">Recommended Hover Image (Home Page)</label>
                                        <input type="file" name="recommended_hover_image" class="form-control"
                                            id="recommended_hover_image">
                                        <!-- Error -->
                                        @if ($errors->first('recommended_hover_image'))
                                            <div class="error">
                                                {{ $errors->first('recommended_hover_image') }}
                                            </div>
                                        @endif

                                        @if ($formObj->recommended_hover_image)
                                            <div class="imgPreview">
                                                <img src="{{ URL::asset('uploads/product/' . $formObj->recommended_hover_image) }}"
                                                    width="300px" class="img-thumbnail" alt="Banner Image">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Free Delivery</label>
                                        {{ Form::text('free_delivery', old('free_delivery') ? old('free_delivery') : $formObj->free_delivery, ['class' => 'form-control', 'placeholder' => 'Free Delivery', 'id' => 'free_delivery']) }}
                                        @if ($errors->has('free_delivery'))
                                            <div class="text-danger">
                                                {{ $errors->first('free_delivery') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="grosswt">Gross Wt</label>
                                        {{ Form::number('grosswt', old('grosswt') ? old('grosswt') : $formObj->grosswt, ['class' => 'form-control', 'placeholder' => 'Gross Wt Gram', 'id' => 'grosswt', 'step' => 'any', 'onkeyup' => 'grossWeightCalculat(); productPriceCalculation();']) }}
                                        @if ($errors->has('grosswt'))
                                            <div class="text-danger">
                                                {{ $errors->first('grosswt') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group dollor-sign">
                                        <div class="icheck-primary">
                                            <input type="checkbox" @if ($formObj->is_solitaire) checked @endif
                                                id="is_solitaire" name="is_solitaire" value="1">
                                            <label for="is_solitaire">
                                                Is Solitaire
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="labour_type">Labour Type </label>
                                        <div class="select-box">
                                            {!! Form::select('labour_type', ['' => 'Select Labour Type'] + $labour_type, $selectedLabourTypeID, [
                                                'class' => 'form-control',
                                                'id' => 'labour_type',
                                                'onchange' => 'productPriceCalculation()',
                                            ]) !!}
                                        </div>
                                        <!-- Error -->
                                        @if ($errors->has('labour_type'))
                                            <div class="error">
                                                {{ $errors->first('labour_type') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group dollor-sign">
                                        <label for="other_expenses">Other Expenses </label>
                                        {{ Form::number('other_expenses', old('other_expenses') ? old('other_expenses') : $formObj->other_expenses, ['class' => 'form-control', 'placeholder' => 'Other Expenses', 'id' => 'other_expenses', 'step' => 'any', 'onkeyup' => 'productPriceCalculation()']) }}

                                        @if ($errors->has('other_expenses'))
                                            <div class="text-danger">
                                                {{ $errors->first('other_expenses') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <div class="row">

                                <div
                                    class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper">
                                    <div class="form-group">
                                        <label for="materialmetal">Material & Metal</label>
                                        {!! Form::select('materialmetal[]', $materialmetal, $selected_materialmetal, [
                                            'class' => 'form-control',
                                            'id' => 'materialmetal',
                                            'multiple' => 'multiple',
                                        ]) !!}
                                        <!-- Error -->
                                        @if ($errors->has('materialmetal'))
                                            <div class="error">
                                                {{ $errors->first('materialmetal') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Diamonds</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="card-header">
                                                    <h3 class="card-title">Center Diamonds</h3>
                                                </div>
                                                <div
                                                    class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper">
                                                    <div class="form-group">
                                                        <label for="shape">Shape </label>
                                                        {!! Form::select('shape_ids[]', $shapes, $selectedShapeID, [
                                                            'class' => 'form-control shapes',
                                                            'id' => 'shape',
                                                            'multiple' => 'multiple',
                                                            'onchange' => 'newshapePacketPriceCalculation();',
                                                        ]) !!}
                                                        <!-- Error -->
                                                        @if ($errors->has('shape'))
                                                            <div class="error">
                                                                {{ $errors->first('shape') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div
                                                    class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper d-none">
                                                    <div class="form-group">
                                                        <label for="center_diamond_clarity">Clarity</label>
                                                        {!! Form::select('center_diamond_clarity[]', $center_diamond_clarity, $selectedCenterDiamondClarityID, [
                                                            'class' => 'form-control',
                                                            'id' => 'center_diamond_clarity',
                                                            'multiple' => 'multiple',
                                                        ]) !!}
                                                        <!-- Error -->
                                                        @if ($errors->has('center_diamond_clarity'))
                                                            <div class="error">
                                                                {{ $errors->first('center_diamond_clarity') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper d-none">
                                                    <div class="form-group">
                                                        <label for="center_diamond_color">Color</label>
                                                        {!! Form::select('center_diamond_color[]', $center_diamond_color, $selectedCenterDiamondColorID, [
                                                            'class' => 'form-control',
                                                            'id' => 'center_diamond_color',
                                                            'multiple' => 'multiple',
                                                        ]) !!}
                                                        <!-- Error -->
                                                        @if ($errors->has('center_diamond_color'))
                                                            <div class="error">
                                                                {{ $errors->first('center_diamond_color') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div id="div_shapes" class="col-md-12 col-lg-12">
                                                    @if ($selectedShape)
                                                        @foreach ($selectedShape as $value)
                                                            <div class="col-md-12 col-lg-12"
                                                                id="shape_id_{{ $value['shape_id'] }}">
                                                                <div class="content box-content-wrapper">
                                                                    <div class="card py-0" style="overflow: inherit;">
                                                                        <div class="card-header ">
                                                                            <div class="row align-items-center">
                                                                                <div
                                                                                    class="col-md-4 col-6 order-1 order-md-1">
                                                                                    <div class="icheck-primary">
                                                                                        <label
                                                                                            for="shape">{{ $value['shape']['name'] }}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-md-8 col-6 order-2 order-md-3">
                                                                                    <div class="card-tools  text-right">
                                                                                        <button type="button"
                                                                                            class="btn btn-tool"
                                                                                            data-card-widget="collapse"
                                                                                            title="Collapse">
                                                                                            <i class="fas fa-minus"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body"
                                                                            id="card_body-{{ $value['shape_id'] }}">

                                                                            @php
                                                                                $ProductShapePackets = App\Models\ProductCenterDiamondPacket::where([['product_id', $formObj->id], ['shape_id', $value['shape_id']]])
                                                                                    ->with('packet')
                                                                                    ->get()
                                                                                    ->toArray();
                                                                                $packet_row = 0;

                                                                                // dd($ProductShapePackets);

                                                                                $selected_product_center_diamond_arr = [];
                                                                                $selected_product_center_diamond_weight = '';
                                                                                $selected_product_center_diamond_pcs = '';
                                                                                $selected_product_center_diamond_price = '';
                                                                                if (count($ProductShapePackets) > 0) {
                                                                                    foreach ($ProductShapePackets as $key => $value) {
                                                                                        if ($key == 0) {
                                                                                            $selected_product_center_diamond_price = $value['packet']['price'] * $value['weight'];
                                                                                        }
                                                                                        $selected_product_center_diamond_arr[] = $value['packet_id'] . '-' . $value['color_id'] . '-' . $value['clarity_id'] . '-' . $value['packet']['price'];
                                                                                        $selected_product_center_diamond_weight = $value['weight'];
                                                                                        $selected_product_center_diamond_pcs = $value['pcs'];
                                                                                    }
                                                                                }
                                                                                //dd($selected_product_center_diamond_arr);
                                                                                //$data['selected_materialmetal'] = $selected_product_center_diamond_arr;
                                                                            @endphp
                                                                            @if ($ProductShapePackets)
                                                                                {{-- @foreach ($ProductShapePackets as $shapePacket) --}}

                                                                                <div
                                                                                    id="row-{{ $value['shape_id'] }}-{{ $packet_row }}">
                                                                                    <div class="row mb-2 align-items-center"
                                                                                        id="row">
                                                                                        <div
                                                                                            class="col-md-7 mb-2 mb-md-0 ">
                                                                                            <div
                                                                                                class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper">
                                                                                                <div class="">
                                                                                                    {!! Form::select(
                                                                                                        'center_diamonds_shape[' . $value['shape_id'] . '][]',
                                                                                                        $packet,
                                                                                                        $selected_product_center_diamond_arr,
                                                                                                        [
                                                                                                            'class' => 'form-control multipleselectshape shapediamondpacket',
                                                                                                            'multiple' => 'multiple',
                                                                                                            'id' => 'packet_' . $value['shape_id'] . '_' . $packet_row,
                                                                                                            'onchange' => 'newshapePacketPriceCalculation()',
                                                                                                        ],
                                                                                                    ) !!}

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-2 mb-2 mb-md-0 input-group">
                                                                                            <input type="number"
                                                                                                name="center_diamonds_weight[{{ $value['shape_id'] }}]"
                                                                                                class="form-control shapeweightct"
                                                                                                id="weight_{{ $value['shape_id'] }}_{{ $packet_row }}"
                                                                                                placeholder="Wt" step="any"
                                                                                                value="{{ $selected_product_center_diamond_weight }}"
                                                                                                onkeyup="newshapePacketPriceCalculation();">
                                                                                            <div
                                                                                                class="input-group-append">
                                                                                                <span
                                                                                                    class="input-group-text">CT</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-1 mb-2 mb-md-0 ">
                                                                                            <input type="number"
                                                                                                name="center_diamonds_pcs[{{ $value['shape_id'] }}]"
                                                                                                class="form-control"
                                                                                                id="pcs_{{ $value['shape_id'] }}_{{ $packet_row }}"
                                                                                                placeholder="Pcs"
                                                                                                value="{{ $selected_product_center_diamond_pcs }}">
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-2 mb-2 mb-md-0 ">
                                                                                            <input type="number"
                                                                                                name="center_diamonds_price[{{ $value['shape_id'] }}]"
                                                                                                class="form-control center_diamond_price shapediamondprice"
                                                                                                id="price_{{ $value['shape_id'] }}_{{ $packet_row }}"
                                                                                                placeholder="Price"
                                                                                                step="any"
                                                                                                readonly="readonly"
                                                                                                value="{{ $selected_product_center_diamond_price }}">
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="card-header">
                                                    <h3 class="card-title">Side Diamonds</h3>
                                                </div>
                                                <div
                                                    class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper d-none">
                                                    <div class="form-group">
                                                        <label for="side_diamond_clarity">Clarity</label>
                                                        {!! Form::select('side_diamond_clarity[]', $side_diamond_clarity, $selectedSideDiamondClarityID, [
                                                            'class' => 'form-control',
                                                            'id' => 'side_diamond_clarity',
                                                            'multiple' => 'multiple',
                                                        ]) !!}
                                                        <!-- Error -->
                                                        @if ($errors->has('side_diamond_clarity'))
                                                            <div class="error">
                                                                {{ $errors->first('side_diamond_clarity') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper d-none">
                                                    <div class="form-group">
                                                        <label for="side_diamond_color">Color</label>
                                                        {!! Form::select('side_diamond_color[]', $side_diamond_color, $selectedSideDiamondColorID, [
                                                            'class' => 'form-control',
                                                            'id' => 'side_diamond_color',
                                                            'multiple' => 'multiple',
                                                        ]) !!}
                                                        <!-- Error -->
                                                        @if ($errors->has('side_diamond_color'))
                                                            <div class="error">
                                                                {{ $errors->first('side_diamond_color') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- <code></code> -->
                                                <div class="col-md-12 col-lg-12" id="side_diamonds_shape_id_1">
                                                    <div class="content box-content-wrapper">
                                                        <div class="card py-0" style="overflow: inherit;">
                                                            <div class="card-header ">
                                                                <div class="row align-items-center">
                                                                    <div class="col-md-12 col-12 order-3 order-md-2 "
                                                                        style="text-align: right;">
                                                                        {{-- <input type="hidden" name="count_side_diamond_box" id="count_side_diamond_box" value="2"> --}}
                                                                        <input type="button"
                                                                            class=" btn btn-info  text-align:right"
                                                                            onclick="addNewSideDiamondsPacket()"
                                                                            value="Add New" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php
                                                                $ProductSideDiamondPackets = App\Models\ProductSideDiamondPacket::where([['product_id', $formObj->id]])
                                                                    ->with('packet')
                                                                    ->get()
                                                                    ->toArray();

                                                                //dd($ProductSideDiamondPackets);
                                                                $row_index_arr = [];
                                                                $side_d_wt_arr = [];
                                                                $side_d_pcs_arr = [];
                                                                $side_d_price_arr = [];
                                                                //$selected_last_side_diamond_id = 1;
                                                                if (count($ProductSideDiamondPackets) > 0) {
                                                                    foreach ($ProductSideDiamondPackets as $key => $value) {
                                                                        //$selected_last_side_diamond_id = $value['id'];
                                                                        $side_d_wt_arr[$value['row_index']] = $value['weight'];
                                                                        $side_d_pcs_arr[$value['row_index']] = $value['pcs'];
                                                                        $side_d_price_arr[$value['row_index']] = $value['weight'] * $value['packet']['price'];
                                                                        $row_index_arr[$value['row_index']][] = $value['packet_id'] . '-' . $value['color_id'] . '-' . $value['clarity_id'] . '-' . $value['packet']['price'];
                                                                    }
                                                                }
                                                               // dd($side_d_pcs_arr);
                                                            @endphp
                                                            @if (count($row_index_arr) > 0)

                                                                @foreach ($row_index_arr as $key => $sideDiamondPacket)
                                                                    <div class="card-body"
                                                                        id="side_diamond_card_body_{{ $key }}">
                                                                        <div id="row-1-0">
                                                                            <div class="row mb-2 align-items-center"
                                                                                id="row">
                                                                                <div class="col-md-4 mb-2 mb-md-0 ">
                                                                                    <div
                                                                                        class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper">
                                                                                        <div class="">
                                                                                            {!! Form::select('side_diamonds_packet[' . $key . '][]', $packet, $sideDiamondPacket, [
                                                                                                'class' => 'form-control multiple_select_side_diamonds_shape_1 sidediamondspacket',
                                                                                                'multiple' => 'multiple',
                                                                                                'id' => 'side_diamonds_packet_' . $key,
                                                                                                'onchange' => 'sideDiamondShapePacketPriceCalculation(' . $key . ');',
                                                                                            ]) !!}

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-md-2 mb-2 mb-md-0 input-group">
                                                                                    <input type="number"
                                                                                        name="side_diamonds_wt[{{ $key }}]"
                                                                                        class="form-control weightct"
                                                                                        id="side_diamonds_wt_{{ $key }}"
                                                                                        placeholder="Wt" step="any"
                                                                                        value="{{ $side_d_wt_arr[$key] }}"
                                                                                        onkeyup="sideDiamondShapePacketPriceCalculation({{ $key }});">
                                                                                    <div class="input-group-append">
                                                                                        <span
                                                                                            class="input-group-text">CT</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2 mb-2 mb-md-0 ">
                                                                                    <input type="number"
                                                                                        name="side_diamonds_pcs[{{ $key }}]"
                                                                                        class="form-control"
                                                                                        id="side_diamonds_pcs_{{ $key }}"
                                                                                        placeholder="Pcs"
                                                                                        value="{{ $side_d_pcs_arr[$key] }}">
                                                                                </div>
                                                                                <div class="col-md-3 mb-2 mb-md-0 ">
                                                                                    <input type="number"
                                                                                        name="side_diamonds_price[{{ $key }}]"
                                                                                        class="form-control side_diamond_price"
                                                                                        id="side_diamonds_price_{{ $key }}"
                                                                                        placeholder="Price" step="any"
                                                                                        readonly="readonly"
                                                                                        value="{{ $side_d_price_arr[$key] }}">
                                                                                </div>
                                                                                <div
                                                                                    class="col-md-1 mb-2 mb-md-0 btndelete text-right  data-value="">
                                                                                    <button id=""
                                                                                        onclick="removeSideDiamondsShapeSelection('{{ $key }}','{{ $formObj->id }}')"
                                                                                        class="btn btn-danger btn-sm remove-action  btn-action"
                                                                                        title="Delete"><i
                                                                                            class="fas fa-trash"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $count_side_diamond_box = $key + 1;

                                                                    @endphp
                                                                @endforeach
                                                            @else
                                                                @php
                                                                    $count_side_diamond_box = 1;
                                                                @endphp

                                                                <div class="card-body"
                                                                    id="side_diamond_card_body_{{ $count_side_diamond_box }}">
                                                                    <div id="row-1-0">
                                                                        <div class="row mb-2 align-items-center"
                                                                            id="row">
                                                                            <div class="col-md-4 mb-2 mb-md-0 ">
                                                                                <div
                                                                                    class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper">
                                                                                    <div class="">
                                                                                        {!! Form::select('side_diamonds_packet[' . $count_side_diamond_box . '][]', $packet, null, [
                                                                                            'class' => 'form-control multiple_select_side_diamonds_shape_1 sidediamondspacket',
                                                                                            'multiple' => 'multiple',
                                                                                            'id' => 'side_diamonds_packet_' . $count_side_diamond_box,
                                                                                            'onchange' => 'sideDiamondShapePacketPriceCalculation(' . $count_side_diamond_box . ');',
                                                                                        ]) !!}

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 mb-2 mb-md-0 input-group">
                                                                                <input type="number"
                                                                                    name="side_diamonds_wt[{{ $count_side_diamond_box }}]"
                                                                                    class="form-control weightct"
                                                                                    id="side_diamonds_wt_{{ $count_side_diamond_box }}"
                                                                                    placeholder="Wt" step="any"
                                                                                    value=""
                                                                                    onkeyup="sideDiamondShapePacketPriceCalculation({{ $count_side_diamond_box }});">
                                                                                <div class="input-group-append">
                                                                                    <span
                                                                                        class="input-group-text">CT</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 mb-2 mb-md-0 ">
                                                                                <input type="number"
                                                                                    name="side_diamonds_pcs[{{ $count_side_diamond_box }}]"
                                                                                    class="form-control"
                                                                                    id="side_diamonds_pcs_{{ $count_side_diamond_box }}"
                                                                                    placeholder="Pcs" value="">
                                                                            </div>
                                                                            <div class="col-md-3 mb-2 mb-md-0 ">
                                                                                <input type="number"
                                                                                    name="side_diamonds_price[{{ $count_side_diamond_box }}]"
                                                                                    class="form-control side_diamond_price"
                                                                                    id="side_diamonds_price_{{ $count_side_diamond_box }}"
                                                                                    placeholder="Price" step="any"
                                                                                    readonly="readonly" value="">
                                                                            </div>
                                                                            <div class="col-md-1 mb-2 mb-md-0 btndelete text-right d-none"
                                                                                data-value="">
                                                                                <button id=""
                                                                                    onclick="removeSideDiamondsShapeSelection('{{ $count_side_diamond_box }}')"
                                                                                    class="btn btn-danger btn-sm remove-action  btn-action"
                                                                                    title="Delete"><i
                                                                                        class="fas fa-trash"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <input type="hidden" name="count_side_diamond_box"
                                                                id="count_side_diamond_box"
                                                                value="{{ $count_side_diamond_box }}">
                                                            <div id="sideDiamondsAppend">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <code></code> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="net_weight">Net Wt</label>
                                                        {{ Form::number('net_weight', old('net_weight') ? old('net_weight') : $formObj->net_weight, ['class' => 'form-control', 'placeholder' => 'Net Wt In Gram', 'readonly' => 'true', 'id' => 'net_weight', 'step' => 'any', 'onkeyup' => 'productPriceCalculation()']) }}
                                                        @if ($errors->has('net_weight'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('net_weight') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group dollor-sign">
                                                        <label id="lblprice">Price <span class="error">*</span></label>
                                                        {{ Form::number('price', old('price') ? old('price') : $formObj->price, ['class' => 'form-control', 'placeholder' => 'Price', 'readonly' => 'true', 'id' => 'price', 'step' => 'any']) }}

                                                        <div class="error" id="error_price"></div>
                                                        @if ($errors->has('price'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('price') }}
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Images</h3>
                                            <div class="metal-priority">
                                                <!-- <h4>Metal Display Priority</h4> -->
                                                <div class="col-md-6 col-sm-3">
                                                    <div class="select-box">

                                                        {!! Form::select('metal_display_priority', ['' => 'Metal Display Priority'] + $metal_arr,$selectMetalDisplayPrio, ['class' => 'form-control','id' => 'metal_display_priority']) !!}

                                                    </div>
                                            </div>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        @php $lastcount = 1; @endphp
                                        <div id="alert_msg"></div>
                                        <!-- /.card-header -->
                                        @if ($formObj->id)
                                            @if ($productImages)
                                                @foreach ($productImages as $productImage)
                                                    @php
                                                        $lastcount = $productImage->id;
                                                    @endphp
                                                    <div class="mt-3" id="divimage-{{ $productImage->id }}">
                                                        <div class="row mb-2 align-items-center"
                                                            id="row-{{ $productImage->id }}">

                                                            <div id="gallery-{{ $productImage['id'] }}"
                                                                class="galler-img-box-wrap form-group col-sm-4">
                                                                <div class="g-img-thumbnail">
                                                                    @if (Storage::disk('s3')->exists('images/' . $productImage->image))
                                                                        <img src="{{ $productImage->image_path }}"
                                                                            class="img-thumbnail" alt="">
                                                                    @else
                                                                        <img src="{{ asset('images/no_image.png') }}"
                                                                            class="img-thumbnail" alt="">
                                                                    @endif

                                                                </div>
                                                                <button type="button"
                                                                    onclick="deleteImage('{{ $productImage['id'] }}')"
                                                                    class="img-close btn btn-block bg-gradient-danger"><i
                                                                        class="fas fa-times"></i></button>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="select-box">
                                                                    {!! Form::select('edit_video_type[]', ['0' => 'Image'] + ['1' => 'Video'], $productImage->video_type, [
                                                                        'disabled' => true,
                                                                        'class' => 'form-control',
                                                                        'id' => 'cat_id',
                                                                        'onchange' => "updateImageAttribute($productImage->id,this.value,'video_type')",
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="select-box">
                                                                    {!! Form::select('edit_shape_arr[]', ['' => 'Select Shape'] + $shape_arr, $productImage->shape_id, [
                                                                        'class' => 'form-control',
                                                                        'id' => 'cat_id',
                                                                        'onchange' => "updateImageAttribute($productImage->id,this.value,'shape_id')",
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="select-box">
                                                                    {!! Form::select('edit_metal_arr[]', ['' => 'Select Metal'] + $metal_arr, $productImage->metal_id, [
                                                                        'class' => 'form-control',
                                                                        'id' => 'cat_id',
                                                                        'onchange' => "updateImageAttribute($productImage->id,this.value,'metal_id')",
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                {!! Form::number('edit_sort_order[]', $productImage->sort_order, [
                                                                    'class' => 'form-control',
                                                                    'placeholder' => 'Sort Order',
                                                                    'id' => 'sort_order',
                                                                    'onblur' => "updateImageAttribute($productImage->id,this.value,'sort_order')",
                                                                ]) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif


                                        <div class="mt-3" id="div_images">
                                            <div class="row mb-2 align-items-center" id="row-{{ $lastcount }}">

                                                <div class="col-sm-5">
                                                    <input type="file" name="images[1][]" class="form-control"
                                                        id="image" multiple>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="select-box">
                                                        {!! Form::select('shape_arr[1]', ['' => 'Select Shape'] + $shape_arr, null, [
                                                            'class' => 'form-control',
                                                            'id' => 'cat_id',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="select-box">
                                                        {!! Form::select('metal_arr[1]', ['' => 'Select Metal'] + $metal_arr, null, [
                                                            'class' => 'form-control',
                                                            'id' => 'cat_id',
                                                        ]) !!}
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-primary add-itemBtn"><span
                                                    class="plus-icon"></span> Add Item</a>
                                        </div>

                                        <input type="hidden" name="lastcount" id="lastcount"
                                            value="{{ $lastcount }}">
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <div
                                    class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper">
                                    <div class="form-group">
                                        <label for="size">Ring Size</label>
                                        {!! Form::select('size[]', $sizes, $selectedSize, [
                                            'class' => 'form-control sizes',
                                            'id' => 'size',
                                            'multiple' => 'multiple',
                                        ]) !!}
                                        <!-- Error -->
                                        @if ($errors->has('size'))
                                            <div class="error">
                                                {{ $errors->first('size') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="div_sizes">
                                @if ($selectedSizePercentage)
                                    @foreach ($selectedSizePercentage as $value)
                                        <div class="col-md-4 col-lg-4" id="row_size_{{ $value['size_id'] }}">
                                            <div class="content box-content-wrapper">
                                                <div class="card py-0">
                                                    <div class="card-body" id="card_body">
                                                        <div id="row">
                                                            <div class="row mb-2 align-items-center" id="row">
                                                                <div class="col-md-6 mb-2 mb-md-0 ">
                                                                    <input type="number" name="size_name[]"
                                                                        class="form-control" id="size[]"
                                                                        placeholder="size" step="any"
                                                                        value="{{ $value['size']['name'] }}">
                                                                </div>
                                                                <div class="col-md-6 mb-2 mb-md-0 input-group">
                                                                    <input type="number" name="price_percentage[]"
                                                                        class="form-control" id="price_percentage"
                                                                        placeholder="" step="any"
                                                                        value="{{ $value['price_percentage'] }}"
                                                                        onkeyup="productPriceCalculation()">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">%</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @if ($countrys)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Country Price</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Multiply By</th>
                                                            <th>Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($countrys as $country)
                                                            <tr>
                                                                <td>{{ $country->name }}</td>
                                                                <td>
                                                                    <input type="number" class="form-control"
                                                                        name="multiplyby[{{ $country->id }}]"
                                                                        id="multiplyby_{{ $country->id }}"
                                                                        value="{{ $countrymultiplyby[$country->id] }}"
                                                                        step="any"
                                                                        onkeyup="countryPriceCalculation();" />
                                                                </td>
                                                                <td><input type="text" class="form-control" disabled
                                                                        name="country_price"
                                                                        id="country_price_{{ $country->id }}"
                                                                        value="" /></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        {{ Form::text('meta_title', old('meta_title') ? old('meta_title') : $formObj->meta_title, ['class' => 'form-control', 'placeholder' => 'Meta Title', 'id' => 'meta_title']) }}
                                        <!-- Error -->
                                        @if ($errors->first('meta_title'))
                                            <div class="error">
                                                {{ $errors->first('meta_title') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords (keywords seperated by comma)</label>
                                        {{ Form::text('meta_keywords', old('meta_keywords') ? old('meta_keywords') : $formObj->meta_keywords, ['class' => 'form-control', 'placeholder' => 'Meta Keywords', 'id' => 'meta_keywords']) }}
                                        <!-- Error -->
                                        @if ($errors->first('meta_keywords'))
                                            <div class="error">
                                                {{ $errors->first('meta_keywords') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        {!! Form::textarea(
                                            'meta_description',
                                            old('meta_description') ? old('meta_description') : $formObj->meta_description,
                                            ['class' => 'form-control', 'id' => 'meta_description', 'rows' => 2, 'cols' => 40],
                                        ) !!}

                                        <!-- Error -->
                                        @if ($errors->first('meta_description'))
                                            <div class="error">
                                                {{ $errors->first('meta_description') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" id="btnsubmit"
                                class="btn btn-info">{{ __('messages.save_button') }}</button>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js">
    </script>
    <script>
        window.onload = function() {

            var subcategory = $('#sub_cat_id').find("option:selected").text();
            if (subcategory == 'Solitaire') {
                $('#div_igi_certified').show();
                $('#div_igi_certified_text').show();
            }
        }

        function shapeSelection(shape, shape_id) {

            var items = ` <div class="col-md-12 col-lg-12" id="shape_id_${shape_id}">
                            <div class="content box-content-wrapper">
                                <div class="card py-0" style="overflow: inherit;">
                                    <div class="card-header ">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-6 order-1 order-md-1">
                                                <div class="icheck-primary">
                                                    <label for="adult">${shape}</label>
                                                </div>
                                            </div>

                                            <div class="col-md-8 col-6 order-2 order-md-3">
                                                <div class="card-tools  text-right">
                                                    <button type="button" class="btn btn-tool"
                                                        data-card-widget="collapse"
                                                        title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" id="card_body-${shape_id}">

                                            <div id="row-${shape_id}-0">
                                                <div class="row mb-2 align-items-center"
                                                    id="row">
                                                    <div class="col-md-7 mb-2 mb-md-0 ">
                                                        <div class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper">
                                                            <div class="">
                                                                {!! Form::select('center_diamonds_shape[${shape_id}][]', $packet, null, [
                                                                    'class' => 'form-control multipleselectshape shapediamondpacket',
                                                                    'multiple' => 'multiple',
                                                                    'id' => 'packet_${shape_id}_0',
                                                                    'onchange' => 'newshapePacketPriceCalculation();',
                                                                ]) !!}

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mb-2 mb-md-0 input-group">
                                                            <input type="number"
                                                            name="center_diamonds_weight[${shape_id}]"
                                                            class="form-control shapeweightct"
                                                            id="weight_${shape_id}_0"
                                                            placeholder="Wt"
                                                            step = "any"
                                                            value="" onkeyup="newshapePacketPriceCalculation();">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">CT</span>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-1 mb-2 mb-md-0 ">
                                                        <input type="number"
                                                        name="center_diamonds_pcs[${shape_id}]"
                                                        class="form-control"
                                                        id="pcs_${shape_id}_0"
                                                        placeholder="Pcs"
                                                        value="">
                                                    </div>
                                                    <div class="col-md-2 mb-2 mb-md-0 ">
                                                        <input type="number"
                                                        name="center_diamonds_price[${shape_id}]"
                                                        class="form-control center_diamond_price shapediamondprice"
                                                        id="price_${shape_id}_0"
                                                        placeholder="Price"
                                                        step = "any"
                                                        readonly = "readonly"
                                                        value="">
                                                    </div>

                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>`;
            $('#div_shapes').append(items);
            $('.multipleselectshape').multiselect({
                maxHeight: 250,
                includeSelectAllOption: false,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,

                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select Packet';
                    } else {
                        var selected = '';
                        options.each(function() {
                            selected += $(this).text() + ', ';
                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });
        }
        $('.multiple_select_side_diamonds_shape_1').multiselect({
            maxHeight: 250,
            includeSelectAllOption: false,
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonText: function(options, select) {
                if (options.length == 0) {
                    return 'Select Packet';
                } else {
                    var selected = '';
                    options.each(function() {
                        selected += $(this).text() + ', ';
                    });
                    return selected.substr(0, selected.length - 2);
                }
            }
        });

        function addNewSideDiamondsPacket() {
            var countSideDiamondBox = parseInt($("#count_side_diamond_box").val()) + 1;
            var items = `<div class="card-body" id="side_diamond_card_body_${countSideDiamondBox}">
                <div id="row-1-0">
                    <div class="row mb-2 align-items-center"
                        id="row">
                        <div class="col-md-4 mb-2 mb-md-0 ">
                            <div class="col-md-12 col-sm-12 select-inner-design-wrapper multi-select-with-checkbo-wrapper">
                                <div class="">
                                    {!! Form::select('side_diamonds_packet[${countSideDiamondBox}][]', $packet, null, [
                                        'class' => 'form-control sidediamondspacket multiple_select_side_diamonds_shape_${countSideDiamondBox}',
                                        'multiple' => 'multiple',
                                        'id' => 'side_diamonds_packet_${countSideDiamondBox}',
                                        'onchange' => 'sideDiamondShapePacketPriceCalculation(${countSideDiamondBox});',
                                    ]) !!}

                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2 mb-md-0 input-group">
                                <input type="number"
                                name="side_diamonds_wt[${countSideDiamondBox}]"
                                class="form-control weightct"
                                id="side_diamonds_wt_${countSideDiamondBox}"
                                placeholder="Wt"
                                step = "any"
                                value="" onkeyup="sideDiamondShapePacketPriceCalculation(${countSideDiamondBox});">
                                <div class="input-group-append">
                                    <span class="input-group-text">CT</span>
                                </div>
                        </div>
                        <div class="col-md-2 mb-2 mb-md-0 ">
                            <input type="number"
                            name="side_diamonds_pcs[${countSideDiamondBox}]"
                            class="form-control"
                            id="side_diamonds_pcs_${countSideDiamondBox}"
                            placeholder="Pcs"
                            value="">
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0 ">
                            <input type="number"
                            name="side_diamonds_price[${countSideDiamondBox}]"
                            class="form-control side_diamond_price"
                            id="side_diamonds_price_${countSideDiamondBox}"
                            placeholder="Price"
                            step = "any"
                            readonly = "readonly"
                            value="">
                        </div>
                        <div class="col-md-1 mb-2 mb-md-0 btndelete text-right" data-value="">
                            <button id="" onclick="removeSideDiamondsShapeSelection(${countSideDiamondBox})" class="btn btn-danger btn-sm remove-action  btn-action"
                                title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>`;
            $('#sideDiamondsAppend').append(items);
            $('.multiple_select_side_diamonds_shape_' + countSideDiamondBox).multiselect({
                maxHeight: 250,
                includeSelectAllOption: false,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select Packet';
                    } else {
                        var selected = '';
                        options.each(function() {
                            selected += $(this).text() + ', ';
                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });
            $("#count_side_diamond_box").val(countSideDiamondBox);
        }

        function removeSideDiamondsShapeSelection(count, product_id = '') {

            $('#side_diamond_card_body_' + count).remove();
            if (product_id != '') {
                $.ajax({
                    url: '{!! route('admin.product.delete.side.diamond.packet') !!}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "product_id": product_id,
                        "row_index": count
                    },
                    success: function(result) {
                        if (result.msg == "delete") {

                        }
                    },
                });
            }
            grossWeightCalculat();
            //productPriceCalculation();
        }

        function removeShapeSelection(shape_id) {
            //console.log(shape_id);
            $('#shape_id_' + shape_id).remove();
        }

        function sizeSelection(size, size_id) {
            var items = `<div class="col-md-4 col-lg-4" id="row_size_${size_id}">
                            <div class="content box-content-wrapper">
                                <div class="card py-0">
                                    <div class="card-body" id="card_body">
                                            <div id="row">
                                                <div class="row mb-2 align-items-center" id="row">
                                                    <div class="col-md-6 mb-2 mb-md-0 ">
                                                        <input type="number"
                                                            name="size_name[]"
                                                            class="form-control"
                                                            id="size[]"
                                                            step = "any"
                                                            placeholder="size"
                                                            value="${size}">
                                                    </div>
                                                    <div class="col-md-6 mb-2 mb-md-0 input-group">
                                                        <input type="number"
                                                        name="price_percentage[]"
                                                        class="form-control"
                                                        id="price_percentage"
                                                        placeholder=""
                                                        step = "any"
                                                        value="" onkeyup="productPriceCalculation()">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            $('#div_sizes').append(items);
        }

        function removeSizeSelection(size_id) {
            //console.log(shape_id);
            $('#row_size_' + size_id).remove();
        }

        function newshapePacketPriceCalculation() {

            $(".shapes").each(function(key, val) {

                var shape_ids = $(this).val();
                for (var i = 0; i < shape_ids.length; i++) {
                    var price = 0;
                    if ($('#packet_' + shape_ids[i] + '_0').val().length > 0) {
                        var packet = $('#packet_' + shape_ids[i] + '_0').val()[0].split("-");
                        var packet_price = packet[3];
                        var weight = $('#weight_' + shape_ids[i] + '_0').val();
                        if (typeof packet_price !== "undefined" && typeof weight !== "undefined") {
                            //var price =  packet_price * (Math.round(weight * 100) / 100);
                            var price = (Math.round(packet_price * weight * 100) / 100).toFixed(2);
                        }
                    }
                    $('#price_' + shape_ids[i] + '_0').val(price)

                    /* if(i == 0){
                        grossWeightCalculat();
                    } */
                }
            });
            grossWeightCalculat();
            //productPriceCalculation();

        }

        function shapePacketPriceCalculation(shape_id, row) {

            var price = 0;
            // console.log("shape_id",shape_id);
            //console.log($('#packet_' + shape_id + '_' + row).val().length);
            /* if($('#packet_' + shape_id + '_' + row).val().length > 0){
                var packet = $('#packet_' + shape_id + '_' + row).val()[0].split("-");
                //var packet_id = packet[0];
                var packet_price = packet[3];
                //console.log("packet_price",packet_price);
                var weight = $('#weight_' + shape_id + '_' + row).val();

                if (typeof packet_price !== "undefined" && typeof weight !== "undefined") {
                    var price =  packet_price * (Math.round(weight * 100) / 100);
                }
                $('#price_' + shape_id + '_' + row).val(price)
                productPriceCalculation();
                return weight;
            } */

        }

        function sideDiamondShapePacketPriceCalculation(count) {
            var price = 0;
            if ($('#side_diamonds_packet_' + count).val().length > 0) {
                var packet = $('#side_diamonds_packet_' + count).val()[0].split("-");
                var packet_price = packet[3];
                var weight = $('#side_diamonds_wt_' + count).val();

                if ($('#side_diamonds_packet_' + count).val().length > 0 && weight != "") {
                    var price = (Math.round(packet_price * weight * 100) / 100).toFixed(2);
                }
            }
            $('#side_diamonds_price_' + count).val(price)

            grossWeightCalculat();
            //productPriceCalculation();
            //return weight;
        }

        function grossWeightCalculat() {
            var grosswt = $('#grosswt').val();
            var total_weight = 0;

            /*only get first center diamond*/
            $(".shapes").each(function(key, val) {
                var shape_ids = $(this).val();
                for (var i = 0; i < 1; i++) {
                    var weight = $('#weight_' + shape_ids[i] + '_0').val();
                    if (typeof $('#packet_' + shape_ids[i] + '_0').val() !== "undefined" && typeof weight !== "undefined") {
                        if ($('#packet_' + shape_ids[i] + '_0').val().length > 0 && weight != '') {
                            if (weight > 0) {
                                total_weight += parseFloat(weight);
                            }
                        }
                    }
                }
            });

            $(".sidediamondspacket").each(function(key, val) {

                var parts = $(this).attr('id').split("_");
                var last_part = parts[parts.length-1];

                if ($('#side_diamonds_packet_' + last_part).val().length > 0) {
                    var side_diamonds_weight = $('#side_diamonds_wt_' + last_part).val();
                    if (typeof $('#side_diamonds_packet_' + last_part).val() !== "undefined" && side_diamonds_weight != "") {
                        //var price = (Math.round(packet_price * weight * 100) / 100).toFixed(2);
                        if (side_diamonds_weight > 0) {
                            total_weight += parseFloat(side_diamonds_weight);
                        }
                    }
                }
            });

            if (grosswt != '') {
                if (total_weight > 0 && total_weight != "NaN") {
                    var gross_weight = parseFloat(grosswt) - parseFloat(Math.round(total_weight * 0.2 * 100) / 100);
                } else {
                    var gross_weight = parseFloat(grosswt);
                }
                $('#net_weight').val(gross_weight);
            }
            productPriceCalculation();

        }

        function productPriceCalculation() {

            var labour_type_id = $('#labour_type').val();
            var other_expenses = $('#other_expenses').val();
            var net_weight = $('#net_weight').val();
            var grosswt = $('#grosswt').val();
            var price_percentage = $('#price_percentage').val();
            var materialmetal = $('#materialmetal').val();

            var diamond_price = 0;
            $(".side_diamond_price").each(function(key, val) {
                if ($(this).val() > 0) {
                    diamond_price += parseFloat($(this).val());
                }
            });

            /*only get first center diamond price*/
            $(".shapes").each(function(key, val) {
                var shape_ids = $(this).val();
                for (var i = 0; i < 1; i++) {
                    var price = $('#price_' + shape_ids[i] + '_0').val();
                    if (typeof price !== "undefined") {
                        if (price > 0) {
                            diamond_price += parseFloat(price);
                        }
                    }
                }
            });

            $.ajax({
                url: '{!! route('admin.product.price.calculation') !!}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "labour_type_id": labour_type_id,
                    "other_expenses": other_expenses,
                    "net_weight": net_weight,
                    "grosswt": grosswt,
                    "price_percentage": price_percentage,
                    "materialmetal": materialmetal,
                    "diamond_price": diamond_price
                },
                success: function(result) {
                    if (result.msg == "success") {
                        $('#price').val(result.total_price);
                        countryPriceCalculation();
                    }
                },
            });

        }

        function countryPriceCalculation() {
            var price = $('#price').val();
            $('#country_price_2').val((Math.round($('#multiplyby_2').val() * price * 100) / 100).toFixed(2));
            $('#country_price_3').val((Math.round($('#multiplyby_3').val() * price * 100) / 100).toFixed(2));
            $('#country_price_4').val((Math.round($('#multiplyby_4').val() * price * 100) / 100).toFixed(2));
            $('#country_price_5').val((Math.round($('#multiplyby_5').val() * price * 100) / 100).toFixed(2));
            $('#country_price_6').val((Math.round($('#multiplyby_6').val() * price * 100) / 100).toFixed(2));
            $('#country_price_7').val((Math.round($('#multiplyby_7').val() * price * 100) / 100).toFixed(2));
        }

        $(document).ready(function() {
            countryPriceCalculation();

            $('#shape').multiselect({
                maxHeight: 250,
                includeSelectAllOption: false,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                onChange: function(option, checked) {


                    //grossWeightCalculat();
                    //productPriceCalculation();
                    var shape_id = $(option).val();
                    var shape = $(option).text();
                    if (checked) {
                        shapeSelection(shape, shape_id);
                    } else {
                        removeShapeSelection(shape_id);
                        //grossWeightCalculat();
                        //productPriceCalculation();
                    }

                },
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select Shape';
                    } else {
                        var selected = '';
                        options.each(function() {
                            /* console.log($(this).text());
                            console.log($(this).val()); */
                            selected += $(this).text() + ', ';

                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });

            $('.multipleselectshape').multiselect({

                includeSelectAllOption: false,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select Packet';
                    } else {
                        var selected = '';
                        options.each(function() {
                            selected += $(this).text() + ', ';
                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });

            $('#center_diamond_clarity').multiselect({
                maxHeight: 250,
                includeSelectAllOption: false,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select Clarity';
                    } else {
                        var selected = '';
                        options.each(function() {
                            selected += $(this).text() + ', ';
                            //console.log(selected);
                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });

            $('#center_diamond_color').multiselect({
                maxHeight: 250,
                includeSelectAllOption: false,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select Color';
                    } else {
                        var selected = '';
                        options.each(function() {
                            selected += $(this).text() + ', ';
                            //console.log(selected);
                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });


            $('#side_diamond_clarity').multiselect({
                maxHeight: 250,
                includeSelectAllOption: false,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select Clarity';
                    } else {
                        var selected = '';
                        options.each(function() {
                            selected += $(this).text() + ', ';
                            //console.log(selected);
                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });

            $('#side_diamond_color').multiselect({
                maxHeight: 250,
                includeSelectAllOption: false,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select Color';
                    } else {
                        var selected = '';
                        options.each(function() {
                            selected += $(this).text() + ', ';
                            //console.log(selected);
                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });

            $('#materialmetal').multiselect({
                maxHeight: 250,
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                onChange: function(option, checked) {
                    productPriceCalculation();
                },
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select material & metal';
                    } else {
                        var selected = '';
                        options.each(function() {
                            selected += $(this).text() + ', ';
                            //console.log(selected);
                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });

            $('#size').multiselect({
                maxHeight: 250,
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                onChange: function(option, checked) {

                    productPriceCalculation();
                    var size_id = $(option).val();
                    var size = $(option).text();
                    if (checked) {
                        sizeSelection(size, size_id);
                    } else {
                        removeSizeSelection(size_id);
                    }

                },
                onSelectAll: function(options) {

                    if(options){
                        $(".sizes option:selected").map(function(){ sizeSelection(this.text, this.value) });
                    }
                    else{

                        $(".sizes option").map(function(){ removeSizeSelection(this.value) });
                    }
                },
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return 'Select Size';
                    } else {
                        var selected = '';
                        options.each(function() {
                            selected += $(this).text() + ', ';
                            //console.log(selected);
                        });
                        return selected.substr(0, selected.length - 2);
                    }
                }
            });


            CKEDITOR.replace('description');
            $("#frmproduct").on("submit", function() {

                var cat_id = $('#cat_id').val();
                var name = $('#name').val();
                var description = CKEDITOR.instances.description.getData();
                var price = $('#price').val();
                var sales_price = $('#sales_price').val();
                var quantity = $('#quantity').val();

                $('#error_category').html('');
                $('#error_name').html('');
                $('#error_description').html('');
                $('#error_price').html('');
                $('#error_sales_price').html('');
                $('#error_quantity').html('');

                var error = false;
                if (cat_id == '') {
                    $('#error_category').html('The category field is required.');
                    error = true;
                } else if (cat_id == 1) {
                    if (sales_price == '') {
                        $('#error_sales_price').html('The price field is required.');
                        error = true;
                    }
                }
                if (name == '') {
                    $('#error_name').html('The name field is required.');
                    error = true;
                }
                if (description == '') {
                    $('#error_description').html('The description field is required.');
                    error = true;
                }
                if (price == '') {
                    $('#error_price').html('The price field is required.');
                    error = true;
                }
                if (quantity == '') {
                    $('#error_quantity').html('The quantity field is required.');
                    error = true;
                }
                if (error) {
                    return false;
                }

                $("#prodcut-box").html(
                    '<div class="product-loader-admin"><img src="{{ asset('images/spinner2.gif') }}" alt="spinner"/></div>'
                );
            });
        });


        $('#cat_id').on('change', function() {
            var category = $(this).find("option:selected").text();
            $('#div_sales_price').hide();
            $('#lblprice').html('<label id="lblprice">Price (&#8377;)<span class="error">*</span></label>');

            if (category == 'Sale') {
                $('#div_sales_price').show();
                $('#lblprice').html(
                    '<label id="lblprice">Sales Price (&#8377;)<span class="error">*</span></label>');
            }

            /*get Sub Category*/
            getSubCategory(this.value);
        });
        $('#sub_cat_id').on('change', function() {
            var subcategory = $(this).find("option:selected").text();
            $('#div_igi_certified').hide();
            $('#div_igi_certified_text').hide();
            if (subcategory == 'Solitaire') {
                $('#div_igi_certified').show();
                $('#div_igi_certified_text').show();

            }
        });

        $(function() {
            /* $("#allshapes").click(function() {
                $(".chk_shape").prop('checked', $(this).prop('checked'));
            });

            $("#allmetalmaterial").click(function() {
                $(".chk_metalmaterial").prop('checked', $(this).prop('checked'));
            }); */


            var category = $('#cat_id').find("option:selected").text();
            $('#lblprice').html('<label id="lblprice">Price (&#8377;)<span class="error">*</span></label>');
            if (category == 'Sale') {
                $('#div_sales_price').show();
                $('#lblprice').html(
                    '<label id="lblprice">Sales Price (&#8377;)<span class="error">*</span></label>');
            }
            var cat_id = $('#cat_id').val();
            getSubCategory(cat_id);

            $(".add-itemBtn").click(function() {
                var last_count = $('#lastcount').val();
                var riw_id = parseInt(last_count) + 1;

                var image_html = `<div class="row mb-2  align-items-center" id="row-${riw_id}">

                <div class="col-sm-5">
                    <input type="file" name="images[${riw_id}][]" class="form-control" id="image" multiple>
                </div>
                <div class="col-sm-3">
                    <div class="select-box">
                    {!! Form::select('shape_arr[${riw_id}]', ['' => 'Select Shape'] + $shape_arr, null, [
                        'class' => 'form-control',
                        'id' => 'cat_id',
                    ]) !!}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="select-box">
                    {!! Form::select('metal_arr[${riw_id}]', ['' => 'Select Metal'] + $metal_arr, null, [
                        'class' => 'form-control',
                        'id' => 'cat_id',
                    ]) !!}
                    </div>
                </div>
                <div class="col-sm-1">
                    <button id="${riw_id}" class="btn btn-danger btn-sm remove-action  btn-action btndelete" title="Delete"><i class="fas fa-trash"></i></button>
                </div>

            </div>`;
                $('#div_images').append(image_html);
                $('#lastcount').val(riw_id);
            });

            $(document).on('click', '.btndelete', function() {
                var button_id = $(this).attr("id");
                $('#row-' + button_id + '').remove();
            });

        });


        function getSubCategory(cat_id) {

            $.ajax({
                url: '{!! route('admin.product.getsubproduct') !!}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": cat_id,
                    "subcat_id": '{{ $formObj->sub_cat_id }}'
                },
                success: function(result) {
                    if (result.status == "success") {
                        $('#sub_cat_id').html(result.sub_category_html);
                    }
                },
            });
        }

        function deleteImage(id) {

            var msg_HTML = "";
            $.ajax({
                type: "POST",
                url: '{!! route('admin.product.deleteimage') !!}',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
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

        function updateImageAttribute(id, value, type) {
            var metal_display_priority = $("#metal_display_priority").val();

            var msg_HTML = "";
            $.ajax({
                type: "POST",
                url: '{!! route('admin.product.updateimageattribute') !!}',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    value: value,
                    type: type,
                    metal_display_priority: metal_display_priority,
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
