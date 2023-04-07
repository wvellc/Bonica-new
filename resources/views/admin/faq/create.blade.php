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
                {{ Breadcrumbs::render("faq".$page_title) }}
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
                                    <label for="cate_id">Topics</label>
                                    <div class="select-box">
                                        {!! Form::select('cate_id', $topics,$selectedtopicsID, ['class' => 'form-control','id' => 'cate_id']) !!}
                                    </div>
                                    <!-- Error -->
                                    @if ($errors->has('cate_id'))
                                    <div class="error">
                                        {{ $errors->first('cate_id') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @php $nameRequired=$statusRequired= 1; @endphp
                            @include('admin.input.status')
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="title">Question </label>
                                    {{ Form::text('question',(old('question'))?old('question'):$formObj->question, ['class' => 'form-control', 'placeholder' => 'Question', 'id' => 'question']) }}
                                    <!-- Error -->
                                    @if ($errors->has('question'))
                                    <div class="error">
                                        {{ $errors->first('question') }}
                                    </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="answer">Answer <span class="error">*</span></label>
                                    {!! Form::textarea('answer',(old('answer'))?old('answer'):$formObj->answer,['class'=>'form-control','id'=>'answer', 'rows' => 2, 'cols' => 40]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('answer'))
                                    <div class="error">
                                        {{ $errors->first('answer') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-info">{{ __('messages.save_button') }}</button>
						<a href="{{ route('admin.faq.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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
    $('#answer').summernote({
        height: 400,
        // fontNames: [],
        // fontNamesIgnoreCheck: ['Maven Pro'],
    });

</script>
@endpush
