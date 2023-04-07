@extends('admin.layouts.layout')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">{{ $module }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
                {{ Breadcrumbs::render("homepageslider".$page_title) }}
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
					<div class="card-body">
                        {{ Form::open(array('url' => route($action_url, $action_params), 'method'=> $method, 'enctype' => 'multipart/form-data', 'class' => 'form-vertical', 'id' => 'frm-homepageslider')) }}
                        @if ($method === "PUT")
                        <input type="hidden" id="id" name="id" value="{{ $action_params }}">
                        @endif
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="slider_type">Slider Type </label>
                                    {!! Form::select('slider_type', $sliderTypeData, $selectedSliderTypeID, ['class' => 'form-control', 'id' => 'slider_type']) !!}
                                    <!-- Error -->
                                    @if ($errors->has('slider_type'))
                                    <div class="error">
                                        {{ $errors->first('slider_type') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @php $nameRequired=$statusRequired= 1; @endphp
                            @include('admin.input.status')
                        </div>
                        <section class="content">
                            <!-- Default box -->
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Slider Video</h3>

                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-12 col-sm-12">
                                <div class="form-group">

                                    <input type="file" name="video" class="form-control" id="video">
                                    <!-- Error -->
                                    @if ($errors->first('video'))
                                    <div class="error">
                                        {{ $errors->first('video') }}
                                    </div>
                                    @endif
                                    @if (Storage::disk('s3')->exists($formObj->video))
                                    <video width="100%" height="400" controls>
                                        <source src="{{ $formObj->video_path }}">
                                    </video>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    {{ Form::close() }}
                    <section class="content">
                        <!-- Default box -->
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Slider Image</h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group col-md-12">
                            <form method="post" action="{{ route('admin.homepageslider.dropzone.store') }}" enctype="multipart/form-data"
                            class="dropzone" id="dropzone">
                            @csrf
                        </form>
                    </div>
                    <div class="row">
                       @if($sliderImage)
                       @foreach ($sliderImage as $item)
                       @if(file_exists('uploads/slider/'.$item->image))
                       <div id="gallery-{{$item['id']}}" class="galler-img-box-wrap form-group col-md-3">
                          <div class="g-img-thumbnail">
                              <img src="{{ URL::asset('uploads/slider/'.$item->image) }}" class="img-thumbnail" alt="">
                          </div>
                          <button type="button" onclick="deleteGallery('{{$item['id']}}','{{$item['image']}}')" class="img-close btn btn-block bg-gradient-danger"><i class="fas fa-times"></i></button>
                      </div>
                      @endif
                      @endforeach
                      @endif
                  </div>

              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </section>
      <!-- /.row -->
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
      <button type="submit"  onClick='submitcompany()' class="btn btn-info">{{ __('messages.save_button') }}</button>
      <a href="{{ route('admin.faq.index') }}" class="btn btn-danger icon-btn">Cancel</a>
  </div>
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
<script src="https:/cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    function submitcompany() {
      $("#frm-homepageslider").submit();
  }
  Dropzone.options.dropzone =
  {
    maxFilesize: 12,
        /* renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time+file.name;
        }, */
        /* renameFile: function (file) {
            let newName = new Date().getTime() + '_' + file.name;
            return newName;
        }, */
        /* renameFile: function (file) {
            return file.renameFile ="YourNewfileName." + file.split('.').pop();
        } */
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        removedfile: function(file)
        {
            var name = file.name;
            //console.log(name);
            $.ajax({

                type: 'POST',
                url: '{!! route("admin.homepageslider.dropzone.delete") !!}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "filename": name
                },
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
            var fileRef;
            return (fileRef = file.previewElement) != null ?
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file, response)
        {
          //file.name = response.success;
          //console.log(file.name);
          console.log(response);
      },
      error: function(file, response)
      {
        return false;
    }
};
function deleteGallery(id,image) {
    swal({
        title: "Are you sure you want delete?",
        text: "",
        type: "error",
        showCancelButton: true,
        dangerMode: true,
        cancelButtonClass: '#DD6B55',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete!',
    },function () {
        var msg_HTML = "";
        $.ajax({
            type: "POST",
            url: '{!! route("admin.homepageslider.dropzone.delete") !!}',
            data: {
                _token: "{{ csrf_token() }}",
                id:id,
                filename:image,
            },
            dataType: 'JSON',
            success: function (data) {
                if(data.msg == 'delete'){
                  $('#gallery-'+id).hide();
              }
          }
      });
    });
}

</script>

@endpush
