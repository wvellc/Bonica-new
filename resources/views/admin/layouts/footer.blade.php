<footer class="main-footer">
	<strong>Copyright &copy; {{date('Y')}} <a href="{{ route('admin.dashboard.index') }}">{{ Config::get('constants.APP_NAME') }}</a>.</strong>
	All rights reserved.

	<div class="back-to-top">
        <a href="javascript:void(0);" title="Back To Top">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
  			<path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
		</svg>
		</a>
    </div>
</footer>
