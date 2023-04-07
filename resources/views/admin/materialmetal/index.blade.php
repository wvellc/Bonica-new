@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $module }} Price / Gram</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    {{ Breadcrumbs::render('materialmetal' . $page_title) }}
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
                        {{ Form::open(['url' => route($action_url, $action_params), 'method' => $method, 'enctype' => 'multipart/form-data', 'class' => 'form-vertical']) }}

                        <!-- form start -->
                        <div class="card-body">
                            <div class="row">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Yellow Gold</th>
                                            <th>White Gold</th>
                                            <th>Rose Gold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($materials) > 0)
                                            @foreach ($materials as $material)
                                                <tr>
                                                    <td>{{ $material['name'] }}</td>
                                                    @foreach ($metals_with_material as $metal)
                                                        @php
                                                            $metalmaterial_price = '';
                                                            if (count($selected_metalmaterial) > 0) {
                                                                if (isset($selected_metalmaterial[$metal->id. '-' . $material->id])) {
                                                                    $metalmaterial_price = $selected_metalmaterial[$metal->id . '-' . $material->id];
                                                                }
                                                            }
                                                        @endphp

                                                        <td><input type="number" class="form-control"
                                                                name="metalmaterial_price[{{ $metal->id }}-{{ $material->id }}]"
                                                                id="metalmaterial_price_{{ $metal->id }}_{{ $material->id }}"
                                                                value="{{ $metalmaterial_price }}"></td>
                                                    @endforeach

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Silver</th>
                                            <th>Platinum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($metals_without_material) > 0)

                                                <tr>
                                                    @foreach ($metals_without_material as $metal)
                                                        @php
                                                            $metalmaterial_price = '';
                                                            if (count($selected_metalmaterial) > 0) {
                                                                if (isset($selected_metalmaterial[$metal->id])) {
                                                                    $metalmaterial_price = $selected_metalmaterial[$metal->id];
                                                                }
                                                            }
                                                        @endphp

                                                        <td><input type="number" class="form-control"
                                                                name="metalmaterial_price[{{ $metal->id }}]"
                                                                id="metalmaterial_price_{{ $metal->id }}"
                                                                value="{{ $metalmaterial_price }}"></td>
                                                    @endforeach

                                                </tr>

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
                            <a href="{{ route('admin.materialmetal.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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
        $("#metalmaterial_price_1_1").on("keyup", function() {
            $('#metalmaterial_price_2_1').val(this.value);
            $('#metalmaterial_price_3_1').val(this.value);
        });
        $("#metalmaterial_price_1_2").on("keyup", function() {
            $('#metalmaterial_price_2_2').val(this.value);
            $('#metalmaterial_price_3_2').val(this.value);
        });
        $("#metalmaterial_price_1_3").on("keyup", function() {
            $('#metalmaterial_price_2_3').val(this.value);
            $('#metalmaterial_price_3_3').val(this.value);
        });
        $("#metalmaterial_price_1_4").on("keyup", function() {
            $('#metalmaterial_price_2_4').val(this.value);
            $('#metalmaterial_price_3_4').val(this.value);
        });
    </script>
@endpush
