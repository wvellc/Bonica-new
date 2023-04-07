<!DOCTYPE html>
<html lang="en">
@include('frontend.layouts.head')
<body id="bodyid"  @if(Auth::guard('user')->check()) class="after-login" @endif>
	@yield('content')
@stack('js')
<script type="text/javascript">
	setTimeout(function() { $('#alert-hide').fadeOut('slow'); }, 10000); // <-- time in milliseconds
</script>
</body>
</html>
