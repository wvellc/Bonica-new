<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ Config::get('constants.APP_NAME') }}</title>

	<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png')}}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png')}}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png')}}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png')}}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png')}}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png')}}">
	<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png')}}">
	<link rel="manifest" href="favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

	<!-- Font Awesome -->
	{{ Html::style("admin_theme/plugins/fontawesome-free/css/all.min.css") }}
	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<!-- Tempusdominus Bootstrap 4 -->
	{{ Html::style("admin_theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}
	<!-- iCheck -->
	{{ Html::style("admin_theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}
	<!-- JQVMap -->
	{{ Html::style("admin_theme/plugins/jqvmap/jqvmap.min.css") }}
	<!-- Theme style -->
	{{ Html::style("admin_theme/dist/css/bonica.min.css") }}
	<!-- overlayScrollbars -->
	{{ Html::style("admin_theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}
	<!-- Daterange picker -->

	{{ Html::style("admin_theme/plugins/daterangepicker/daterangepicker.css") }}
	<!-- summernote -->
	{{-- {{ Html::style("admin_theme/plugins/summernote/summernote-bs4.min.css") }} --}}
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<!-- Custom CSS -->
	{{ Html::style('admin_theme/dist/css/style.css') }}
	{{ Html::style('admin_theme/dist/css/custom_theme.css') }}
	@stack('css')
</head>
