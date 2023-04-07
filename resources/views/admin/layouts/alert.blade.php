@section('style_toster')
	<?= Html::style('plugins/toster/toster.min.css') ?>
@stop
@section('script_toster')
	<?= Html::script('plugins/toster/toster.min.js') ?>
@stop
@if(Session::has('message'))
	@if(Session::get('type'))
		<script>
	        $(document).ready(function(){
		        toastr.{{ Session::get('type') }}
		        ('{{ Session::get('message') }}');
	        });
	    </script>
    @endif
@endif