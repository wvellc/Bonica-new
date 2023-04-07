<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.head')

<body class="hold-transition sidebar-mini layout-fixed control-sidebar-slide-open"> <!--  sidebar-mini layout-fixed control-sidebar-slide-open  sidebar-collapse -->
	<div class="wrapper">
		<!-- Preloader -->
		<!-- <div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="{{ asset('images/logo.svg') }}" alt="Evolv" width="500">
		</div> -->

		<!-- Navbar -->
		@include('admin.layouts.header')
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		@include('admin.layouts.sidebar')
		<!-- Main Sidebar Container -->


		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Main content -->
			@yield('content')
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->


		<!-- /.footer -->
		@include('admin.layouts.footer')
		<!-- /.footer -->

		@include('admin.layouts.alert')
	</div>
	<!-- ./wrapper -->

<!-- /.footer -->
@include('admin.layouts.footerjs')
<!-- /.footer -->

<script type="text/javascript">
	setTimeout(function() { $('#alert-hide').fadeOut('slow'); }, 10000); // <-- time in milliseconds
</script>

@stack('js')

</body>
</html>
