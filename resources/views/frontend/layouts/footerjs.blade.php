<script>
    var baseUrl = '{{ URL::asset('') }}';
    var currencyUpdate = '{!! route("frontend.currency-update") !!}';
</script>
{{ Html::script("frontend_theme/js/bootstrap.bundle.min.js") }}
{{ Html::script("frontend_theme/js/slick.js") }}
<!-- {{ Html::script("frontend_theme/js/translate-element.js") }} -->
<!-- custom js -->
{{ Html::script("frontend_theme/js/bootstrap-datepicker.min.js") }}
{{ Html::script("frontend_theme/js/jquery.fancybox.min.js") }}
{{ Html::script("frontend_theme/js/custom.js") }}
{{ Html::script("frontend_theme/js/loader.js") }}
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
