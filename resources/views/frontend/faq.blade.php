@extends('frontend.layouts.layout')
@section('title', 'FAQ | Bonica Jewels')
@section('meta_description', "LATEST COLLECTION Lab Grown Diamonds Stunning selection and the option to choose from a wide range of diamondContinue Reading 'Bonica Jewels'")
@section('content')
<div class="faq-page">
	<!-- header -->
	@include('frontend.layouts.header')
		<!-- main -->
        <main>
			<section class="faq-banner-section" style="background-image:url({{ asset('images/banners/faq-banner.png') }}) ;" >
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-sm-12 ">
							<div class="inner-banner-info text-center ">
								<h2>FREQUENTLY ASKED QUESTIONs</h2>
									<div class="input-group">
										<input type="text" id="search_faq" onkeypress="handle(event)" name="search_faq" class="form-control" placeholder="Start typing..." aria-label="seach-faq" aria-describedby="button-addon2">
										<button class="btn" onclick="searchFaq();" type="button" id="button-addon2"><img src="{{ asset('images/icons/search-white.svg') }}" alt="search-white"></button>
									</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="section faq-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12 m-auto">
							<div class="faq-container">
								<ul  class="nav nav-tabs justify-content-sm-between pb-5 border-0" id="filterOptions">
									<li class="active"><a href="#" class="all"> <img src="{{ asset('images/icons/all-questions.svg') }}" alt="all-questions">  All Questions</a></li>
									<li><a href="#" class="popular-questions"> <img src="{{ asset('images/icons/popular-questions.svg') }}" alt="popular-questions">Popular Questions</a></li>
									<li><a href="#" class="shipping-questions"> <img src="{{ asset('images/icons/shipping-questions.svg') }}" alt="shipping-questions">Shipping Questions</a></li>
									<li><a href="#" class="warranty"><img src="{{ asset('images/icons/warranty.svg') }}" alt="warranty">Warranty</a></li>
								</ul>
								<div class="tab-content">
									<div class="accordion " id="accordionHolder" >
                                        @if (!empty($topics))
                                            @php $count = 1; @endphp
                                            @foreach ($topics as $topic)
                                                @if(count($topic->topics) > 0)
                                                @foreach ($topic->topics as $faq)
                                                    <div class="item {{$topic->slug}}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="{{$faq->id}}">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-{{$faq->id}}" aria-expanded="false" aria-controls="accordion-{{$faq->id}}">
                                                                    {{$faq->question}}
                                                                </button>
                                                            </h2>
                                                            <div id="accordion-{{$faq->id}}" class="accordion-collapse collapse @if ($count == 1) show @endif" aria-labelledby="{{$faq->id}}" data-bs-parent="#accordionHolder">
                                                                <div class="accordion-body">
                                                                    {!! $faq->answer !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @php $count++ @endphp

                                                @endforeach
                                                @endif
                                            @endforeach
                                        @endif
									</div>
                                    <div class="accordion" id="accordionHoldersearch" >
                                    </div>


								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
		<!-- footer -->
		@include('frontend.layouts.footer')
    	@include('frontend.layouts.footerjs')
	</div>
@endsection
@push('js')
<script>
    $('#filterOptions li a').on('click',function(){
        $('#accordionHoldersearch').hide();
        $('#accordionHolder').show();
    });
    function handle(e){
        var key=e.keyCode || e.which;
        if (key==13){
            $("#filterOptions li").removeClass("active");
            searchFaq();
        }
    }
    function searchFaq()
    {
        var search_faq = $('#search_faq').val();
        if(search_faq != ''){

            $.ajax({
                type: "GET",
                url: '{!! route("frontend.search_faq") !!}',
                data: {
                    search_faq:search_faq
                },
                dataType: 'JSON',
                beforeSend: function() {

                },
                success: function (data) {
                    $('#accordionHolder').hide();
                    $('#accordionHoldersearch').show();
                    $("#filterOptions li:first").addClass("active");
                    if(data.search_faq_html != ""){
                        $('#accordionHoldersearch').html(data.search_faq_html);
                    }
                    else{
                        $('#accordionHoldersearch').html('No record found');
                    }
                }
                });
        }
    }
   /*  $('.btn-serach').on('click',function(){

        var search_faq = $('#search_faq').val();
        if(search_faq != ''){

            $.ajax({
                type: "GET",
                url: '{!! route("frontend.search_faq") !!}',
                data: {
                    search_faq:search_faq
                },
                dataType: 'JSON',
                beforeSend: function() {

                },
                success: function (data) {
                    $('#accordionHolder').hide();
                    $('#accordionHoldersearch').show();
                    $("#filterOptions li:first").addClass("active");
                    if(data.search_faq_html != ""){
                        $('#accordionHoldersearch').html(data.search_faq_html);
                    }
                    else{
                        $('#accordionHoldersearch').html('No record found');
                    }
                }
                });
        }
    }); */
</script>
@endpush
