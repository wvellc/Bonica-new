<!-- jQuery -->
{{ Html::script("admin_theme/plugins/jquery/jquery.min.js") }}
<!-- jQuery UI 1.11.4 -->
{{ Html::script("admin_theme/plugins/jquery-ui/jquery-ui.min.js") }}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)

	function backToTop() {
    	var offset = 20;
    	var duration = 400;
    	if ($(this).scrollTop() > offset) {
        	$('.back-to-top').slideDown(duration);
    	} else {
        	$('.back-to-top').slideUp(duration);
    	}
	}

	let scrollToBottom = document.querySelector(".back-to-top");
      	let pageBottom = document.querySelector(".main-footer");

      	scrollToBottom.addEventListener("click", function () {
    	pageBottom.scrollIntoView();
    });

	// $(document).ready(function() {
    // 	backToTop();
	// });

	// $('body').on('click', '.back-to-top', function(event) {
    //     var duration = 400;
    //     event.preventDefault();
    //     $('html, body').animate({
    //         scrollBottom: 0
    //     }, duration);
    //     return false;
    // });

	// $(window).scroll(function() {
    // 	backToTop();
	// });

</script>
<!-- Bootstrap 4 -->
{{ Html::script("admin_theme/plugins/bootstrap/js/bootstrap.bundle.min.js") }}
<!-- daterangepicker -->
{{ Html::script("admin_theme/plugins/moment/moment.min.js") }}
{{ Html::script("admin_theme/plugins/daterangepicker/daterangepicker.js") }}
<!-- Tempusdominus Bootstrap 4 -->
{{ Html::script("admin_theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}
<!-- overlayScrollbars -->
{{ Html::script("admin_theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}
<!-- Evolv App -->
{{ Html::script("admin_theme/dist/js/evolv.js") }}
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<!-- summernote Js -->
{{-- {{ Html::script("admin_theme/plugins/summernote/summernote-bs4.js") }} --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



