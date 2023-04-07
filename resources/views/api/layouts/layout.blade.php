<!DOCTYPE html>
<html lang="en">
@include('admin.auth.layouts.head')

<body class="hold-transition login-page" id="{{ Route::currentRouteName() }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-6 m-auto">
                <div class="login-box w-100">
                    <!-- /.login-logo -->
                    <div class="box-logo image-area">
                        <img src="{{ asset('logo/logo.png') }}" class="logo" />
                    </div>
                    <div class="card card-outline card-primary">
                        <div class="card-header text-center">
                            @if (Route::currentRouteName() === 'admin.forgot.password')
                                <h2 class="theme-font-color">{!! __('Forgot Password') !!}</h2>
                            @elseif(Route::currentRouteName() === 'admin.password.reset')
                                <h2 class="theme-font-color">{!! __('Reset Your Password') !!}</h2>
                            @else
                                <h2 class="theme-font-color">{!! __('Login') !!}</h2>
                            @endif
                            {{-- <img src="{{ asset('favicons/apple-icon-57x57.png') }}" height="57" width="57"> --}}
                        </div>
                        <div class="card-body">
                            @yield('content')
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.login-box -->
            </div>
        </div>
    </div>
	@include('admin.auth.layouts.footer')
	@yield('js')
	<script type="text/javascript">
		setTimeout(function() { $('#alert-hide').fadeOut('slow'); }, 10000); // <-- time in milliseconds
	</script>
</body>

</html>
