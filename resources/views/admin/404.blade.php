@extends('admin.layouts.layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
		@include('admin.layouts.alert_message')
        <div class="row">
            <div class="col-md-12 text-center">
                    <h1 class="mb-4">404</h1>
                    <h3>Page Not Found</h3>
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-primary mt-5"> Go To Dashboard</a>
            </div>
        </div>
	</div><!-- /.container-fluid -->
</section>
@stop
@push('js')
<script>
    $('#answer').summernote({
        height: 400,
    });

</script>
@endpush
