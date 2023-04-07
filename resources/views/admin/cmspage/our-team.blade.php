@extends('admin.layouts.layout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">{{ $module }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
                {{ Breadcrumbs::render("cmspage".$page_title) }}
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
					{{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method, 'enctype' => 'multipart/form-data', 'class' => 'form-vertical')) }}
                    @if ($method === "PUT")
                    <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                    @endif
                    <input type="hidden" id="page" name="page" value="our-team">
					<!-- form start -->
					<div class="card-body">
						<div class="row">
                            @php
                            $nameRequired=$statusRequired= 1;
                            @endphp
                            {{-- @include('admin.input.name') --}}
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    {!! Form::textarea('title',(old('title'))?old('title'):$formObj->title,['class'=>'form-control','placeholder' => '','id'=>'title', 'rows' => 2, 'cols' => 2]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('title'))
                                    <div class="error">
                                        {{ $errors->first('title') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @include('admin.input.status')
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="member1_name">Member1 Name</label>
                                    {{ Form::text('member1_name',(old('member1_name'))?old('member1_name'):$formObj->member1_name, ['class' => 'form-control', 'placeholder' => '', 'id' => 'member1_name']) }}
                                    <!-- Error -->
                                    @if ($errors->first('member1_name'))
                                    <div class="error">
                                        {{ $errors->first('member1_name') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="member1_image">Member1 Profile</label>
                                    <input type="file" name="member1_image" class="form-control" id="member1_image">
                                    <!-- Error -->
                                    @if ($errors->first('member1_image'))
                                    <div class="error">
                                        {{ $errors->first('member1_image') }}
                                    </div>
                                    @endif
                                    @if($formObj->member1_image)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->member1_image) }}" width="300px" class="img-thumbnail" alt="Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="member1_info">Member1 Info</label>
                                    {!! Form::textarea('member1_info',(old('member1_info'))?old('member1_info'):$formObj->member1_info,['class'=>'form-control','id'=>'member1_info', 'rows' => 2, 'cols' => 40]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('member1_info'))
                                    <div class="error">
                                        {{ $errors->first('member1_info') }}
                                    </div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="member2_name">Member2 Name</label>
                                    {{ Form::text('member2_name',(old('member2_name'))?old('member2_name'):$formObj->member2_name, ['class' => 'form-control', 'placeholder' => '', 'id' => 'member2_name']) }}
                                    <!-- Error -->
                                    @if ($errors->first('member2_name'))
                                    <div class="error">
                                        {{ $errors->first('member2_name') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="member2_image">Member2 Profile</label>
                                    <input type="file" name="member2_image" class="form-control" id="member2_image">
                                    <!-- Error -->
                                    @if ($errors->first('member2_image'))
                                    <div class="error">
                                        {{ $errors->first('member2_image') }}
                                    </div>
                                    @endif
                                    @if($formObj->member2_image)
                                    <div class="imgPreview">
                                        <img src="{{ URL::asset('uploads/cmspage/'.$formObj->member2_image) }}" width="300px" class="img-thumbnail" alt="Image">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="member2_info">Member2 Info</label>
                                    {!! Form::textarea('member2_info',(old('member2_info'))?old('member2_info'):$formObj->member2_info,['class'=>'form-control','id'=>'member2_info', 'rows' => 2, 'cols' => 40]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('member2_info'))
                                    <div class="error">
                                        {{ $errors->first('member2_info') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="team_title">Our Team</label>
                                    {!! Form::textarea('team_title',(old('team_title'))?old('team_title'):$formObj->team_title,['class'=>'form-control','placeholder' => '','id'=>'team_title', 'rows' => 2, 'cols' => 2]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('team_title'))
                                    <div class="error">
                                        {{ $errors->first('team_title') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="milestone_title">Milestone Title</label>
                                    {!! Form::textarea('milestone_title',(old('milestone_title'))?old('milestone_title'):$formObj->milestone_title,['class'=>'form-control','placeholder' => '','id'=>'milestone_title', 'rows' => 2, 'cols' => 2]) !!}
                                    <!-- Error -->
                                    @if ($errors->first('milestone_title'))
                                    <div class="error">
                                        {{ $errors->first('milestone_title') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            {{-- Our Teams --}}
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">OUR TEAM</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="card-body" style="display: block;">
                                    @php $lastcount = 1; @endphp
                                    <div id="alert_msg"></div>
                                    <div class="mt-3" id="div_images">
                                    @if (count($teams) > 0)
                                    @foreach ($teams as $team)
                                        @php
                                        $lastcount = $team->id;
                                        @endphp
                                            <div class="row mb-2 align-items-center" id="row-{{ $team->id }}">
                                                <input type="hidden" name="action[{{ $team->id }}]" value="update">
                                                <div class="col-sm-2">
                                                    
                                                    <div id="gallery-{{ $team['id'] }}"
                                                        class="galler-img-box-wrap form-group col-sm-4">
                                                        <div class="g-img-thumbnail">
                                                        @if ($team->image)
                                                            <img src="{{ asset('uploads/cmspage/'.$team->image) }}" class="img-thumbnail" alt="">
                                                        @else
                                                        <img src="{{ asset('images/no_image.png') }}" class="img-thumbnail" alt="">
                                                        @endif
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="file" name="images[{{$team->id}}]" class="form-control" id="image">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="select-box">
                                                        {!! Form::text('designation['.$team->id.']',$team->designation, [
                                                            'class' => 'form-control',
                                                            'placeholder' => 'designation',
                                                            'id' => 'designation'])
                                                        !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="select-box">
                                                        {!! Form::textarea('content['.$team->id.']',$team->content,
                                                            ['class'=>'form-control',
                                                            'placeholder' => 'content',
                                                            'id'=>'content', 'rows' => 2, 'cols' => 2])
                                                        !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                <button type="button"
                                                            onclick="deleteImage('{{ $team['id'] }}')"
                                                            class="btn btn btn-danger remove-action btn-action"><i
                                                                class="fas fa-trash"></i></button>
                                                    
                                                </div>
                                            </div>
                                    @endforeach
                                    @else
                                            <div class="row mb-2 align-items-center" id="row-{{ $lastcount }}">
                                                <input type="hidden" name="action[{{ $lastcount }}]" value="add">
                                                <div class="col-sm-5">
                                                    <input type="file" name="images[{{ $lastcount }}]" class="form-control" id="image">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="select-box">
                                                        {!! Form::text('designation['.$lastcount.']','', [
                                                            'class' => 'form-control',
                                                            'placeholder' => 'designation',
                                                            'id' => 'designation'])
                                                        !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="select-box">
                                                        {!! Form::textarea('content['.$lastcount.']','',
                                                            ['class'=>'form-control',
                                                            'placeholder' => 'content',
                                                            'id'=>'content', 'rows' => 2, 'cols' => 2])
                                                        !!}
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                </div>
                                    <div class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-primary add-itemBtn"><span
                                                class="plus-icon"></span> Add Team Member</a>
                                    </div>
                                    <input type="hidden" name="lastcount" id="lastcount" value="{{ $lastcount }}">
                                    </div>
                                </div>
                            </div>
                             {{--END Our Teams --}}

                             {{-- MILESTONE --}}
                             <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">MILESTONE</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="card-body" style="display: block;">
                                    @php $milestonelastcount = 1; @endphp
                                    <div id="milestone_alert_msg"></div>
                                    <div class="mt-3" id="div_milestone">
                                    @if (count($milestones) > 0)
                                    @foreach ($milestones as $milestone)
                                        @php
                                        $milestonelastcount = $milestone->id;
                                        @endphp
                                            <div class="row mb-2 align-items-center" id="milestonerow-{{ $milestone->id }}">
                                                <input type="hidden" name="milestoneaction[{{ $milestone->id }}]" value="update">
                                                <div class="col-sm-2">
                                                    
                                                    <div id="gallery-{{ $milestone['id'] }}"
                                                        class="galler-img-box-wrap form-group col-sm-4">
                                                        <div class="g-img-thumbnail">
                                                            @if ($milestone->image)
                                                            <img src="{{ asset('uploads/cmspage/'.$milestone->image) }}" class="img-thumbnail" alt="">
                                                            @else
                                                            <img src="{{ asset('images/no_image.png') }}" class="img-thumbnail" alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="file" name="milestoneimages[{{$milestone->id}}]" class="form-control" id="image">
                                                </div>
                                                <div class="col-sm-1">
                                                    <div class="select-box">
                                                        <input type="text" name="milestoneyear[{{$milestone->id}}]" class="form-control" id="milestoneyear" value="{{$milestone->year}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <div class="galler-img-box-wrap form-group col-sm-4">
                                                        <div class="g-img-thumbnail">
                                                        @if ($milestone->icon)
                                                            <img src="{{ asset('uploads/cmspage/'.$milestone->icon) }}" class="img-thumbnail" alt="">
                                                        @else
                                                            <img src="{{ asset('images/no_image.png') }}" class="img-thumbnail" alt="">
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="file" name="milestoneicons[{{$milestone->id}}]" class="form-control" id="image">
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="select-box">
                                                        {!! Form::textarea('milestonecontent['.$milestone->id.']',$milestone->content,
                                                            ['class'=>'form-control',
                                                            'placeholder' => 'content',
                                                            'id'=>'milestonecontent', 'rows' => 2, 'cols' => 2])
                                                        !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                <button type="button"
                                                            onclick="deleteMilestone('{{ $milestone['id'] }}')"
                                                            class="btn btn btn-danger remove-action btn-action"><i
                                                                class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                    @endforeach
                                    @else
                                            <div class="row mb-2 align-items-center" id="milestonerow-{{ $milestonelastcount }}">
                                                <input type="hidden" name="milestoneaction[{{ $milestonelastcount }}]" value="add">
                                                <div class="col-sm-3">
                                                    <input type="file" name="milestoneimages[{{ $milestonelastcount }}]" class="form-control" id="image">
                                                </div>
                                                <div class="col-sm-1">
                                                    <div class="select-box">
                                                        <select name="milestoneyear[{{ $milestonelastcount }}]" class="form-control" id="dropdownYear{{ $milestonelastcount }}"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="select-box">
                                                        <input type="file" name="milestoneicons[{{ $milestonelastcount }}]" class="form-control" id="image">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="select-box">
                                                        {!! Form::textarea('milestonecontent['.$milestonelastcount.']','',
                                                            ['class'=>'form-control',
                                                            'placeholder' => 'content',
                                                            'id'=>'milestonecontent', 'rows' => 2, 'cols' => 2])
                                                        !!}
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                </div>
                                    <div class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-primary addMilestoneBtn"><span
                                                class="plus-icon"></span> Add Milestone</a>
                                    </div>
                                    <input type="hidden" name="milestonelastcount" id="milestonelastcount" value="{{ $milestonelastcount }}">
                                    </div>
                                </div>
                            </div>
                             {{--END MILESTONE --}}

                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    {{ Form::text('meta_title',(old('meta_title'))?old('meta_title'):$formObj->meta_title, ['class' => 'form-control', 'placeholder' => 'Meta Title', 'id' => 'meta_title']) }}
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
                                    {{ Form::text('meta_keywords',(old('meta_keywords'))?old('meta_keywords'):$formObj->meta_keywords, ['class' => 'form-control', 'placeholder' => 'Meta Keywords', 'id' => 'meta_keywords']) }}
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
                                    {!! Form::textarea('meta_description',(old('meta_description'))?old('meta_description'):$formObj->meta_description,['class'=>'form-control','id'=>'meta_description', 'rows' => 2, 'cols' => 40]) !!}

                                    <!-- Error -->
                                    @if ($errors->first('meta_description'))
                                    <div class="error">
                                        {{ $errors->first('meta_description') }}
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
						<a href="{{ route('admin.dashboard.index') }}" class="btn btn-danger icon-btn">Cancel</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    $('#title').summernote({});
    $('#team_title').summernote({});
    $('#milestone_title').summernote({});

    $(function() {
            $('#dropdownYear1').each(function() {
                var year = (new Date()).getFullYear();
                var current = year;
                year -= 3;
                for (var i = 0; i < 6; i++) {
                if ((year+i) == current)
                    $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
                else
                    $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
                }
            })

            $(".add-itemBtn").click(function() {
                    var last_count = $('#lastcount').val();
                    var riw_id = parseInt(last_count) + 1;
                    var image_html = `<div class="row mb-2  align-items-center" id="row-${riw_id}">
                    <input type="hidden" name="action[${riw_id}]" value="add">
                    <div class="col-sm-5">
                        <input type="file" name="images[${riw_id}]" class="form-control" id="image">
                    </div>
                    <div class="col-sm-3">
                        <div class="select-box">
                        {!! Form::text('designation[${riw_id}]','', [
                            'class' => 'form-control',
                            'placeholder' => 'designation',
                            'id' => 'designation'
                        ]) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="select-box">
                            {!! Form::textarea('content[${riw_id}]','',
                                ['class'=>'form-control',
                                'placeholder' => 'content',
                                'id'=>'content', 'rows' => 2, 'cols' => 2
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

            $(".addMilestoneBtn").click(function() {
                    var last_count = $('#milestonelastcount').val();
                    var riw_id = parseInt(last_count) + 1;
                    var image_html = `<div class="row mb-2  align-items-center" id="milestonerow-${riw_id}">
                    <input type="hidden" name="milestoneaction[${riw_id}]" value="add">
                    <div class="col-sm-3">
                        <input type="file" name="milestoneimages[${riw_id}]" class="form-control" id="image">
                    </div>
                    <div class="col-sm-1">
                        <div class="select-box">
                            <select name="milestoneyear[${riw_id}]" class="form-control" id="dropdownYear${riw_id}"></select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="select-box">
                            <input type="file" name="milestoneicons[${riw_id}]" class="form-control" id="image">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="select-box">
                            {!! Form::textarea('milestonecontent[${riw_id}]','',
                                ['class'=>'form-control',
                                'placeholder' => 'content',
                                'id'=>'milestonecontent', 'rows' => 2, 'cols' => 2
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <button id="${riw_id}" class="btn btn-danger btn-sm remove-action  btn-action btnmilestonedelete" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`;
                $('#div_milestone').append(image_html);

                $('#dropdownYear'+riw_id).each(function() {
                    var year = (new Date()).getFullYear();
                    var current = year;
                    year -= 3;
                    for (var i = 0; i < 6; i++) {
                    if ((year+i) == current)
                        $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
                    else
                        $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
                    }
                })

                $('#milestonelastcount').val(riw_id);
            });
            $(document).on('click', '.btnmilestonedelete', function() {
                var button_id = $(this).attr("id");
                $('#milestonerow-' + button_id + '').remove();
            });
    });
    function deleteMilestone(id) {
            swal({
                title: "Are you sure you want delete?",
                text: "",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Delete!',
            }, function() {
                var msg_HTML = "";
                $.ajax({
                    type: "POST",
                    url: '{!! route('admin.cmspage.deletemilestone') !!}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    beforeSend: function() {
                        $('#milestonerow-' + id).html('<img src="{{asset('images/spinner1.gif')}}" alt="spinner"/>');
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.msg == 'delete') {
                            $('#milestonerow-' + id).hide();
                            msg_HTML = `<div class="col-xs-12 flashmessages">
                                        <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>${data.message}</strong>
                                            </div>
                                        </div>`;
                            $('#milestone_alert_msg').html(msg_HTML);
                        }
                    }
                });
            });
        }
    function deleteImage(id) {
            swal({
                title: "Are you sure you want delete?",
                text: "",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Delete!',
            }, function() {
                var msg_HTML = "";
                $.ajax({
                    type: "POST",
                    url: '{!! route('admin.cmspage.deleteteam') !!}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    beforeSend: function() {
                        $('#row-' + id).html('<img src="{{asset('images/spinner1.gif')}}" alt="spinner"/>');
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.msg == 'delete') {
                            $('#row-' + id).hide();
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
            });
        }
</script>
@endpush

