@extends('frontend.layouts.layout')
@section('title', 'Contact Us | Bonica Jewels')
@section('meta_description', "LATEST COLLECTION Lab Grown Diamonds Stunning selection and the option to choose from a wide range of diamondContinue Reading 'Bonica Jewels'")
@section('content')
<div class="contact-page">
	<!-- header -->
	@include('frontend.layouts.header')
		<!-- main -->
        <main>

			<section class="section page-contact-section">
				<div class="container">
					<div class="row justify-content-between divider-row">
						<div class="h-divider"></div>
						<div class="col-md-12 col-lg-6 col-xl-6">
							<div class="store-intro-box-wrapper">
								<h3>Visit us</h3>
								<div class="store-intro-box pb-4">
									<img src="{{ asset('images/icons/store.svg') }}" alt="store">
									<p>104, Abhishree Avenue, Surendra Mangaldas Road,<br class="d-none d-sm-block d-lg-none d-xl-block  "> Opp. Hanuman Mandir, Patel Colony, Ambawadi, Ahmedabad,<br class="d-none d-sm-block d-lg-none d-xl-block  "> Gujarat 380015</p>
								</div>
								<h3>Timings</h3>
								<div class="store-intro-box">
									<img src="{{ asset('images/icons/time.svg') }}" alt="time">
									<p>Mon - Sat<br/>10.00am - 5.00pm</p>
									<p>Sunday<br/>11.00 - 4.00pm</p>
								</div>
							</div>


							<ul class="contact-box-wrapper-list mt-4">
								<li>
									<a href="https://api.whatsapp.com/send?phone=919726444567" target="_blank" class=" text-center contact-box-wrapper">
										<div class="">
											<img src="{{ asset('images/icons/whatsapp.svg') }}" alt="calender-icon">
											<h5><span data-text="WhatsApp Us"> WhatsApp Us </span></h5>
										</div>
									</a>
								</li>
								<li>
									<a href="tel:+919726444567" class=" text-center contact-box-wrapper">
										<div class="">
											<img src="{{ asset('images/icons/call-us.svg') }}" alt="call-us">
											<h5><span data-text="Call Us "> Call Us </span></h5>
										</div>
									</a>
								</li>
								<li>
									<a href="{{ route('frontend.appointment') }}" class="text-center contact-box-wrapper">
										<div class="">
											<img src="{{ asset('images/icons/calender-icon.svg') }}" alt="calender-icon">
											<h5><span data-text="Booking  Appointment"> Booking  Appointment</span></h5>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="col-md-12 col-lg-5 col-xl-5 mt-5 mt-lg-0">
							<div class="form-wrapper">
								<h3>Get In TOuch</h3>
                                @include('layouts.alert_message')
								{{ Form::open(array('url' => route('frontend.save.contact'), 'method'=> 'POST', 'enctype' => 'multipart/form-data', 'id' => 'frmContact')) }}
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="name" placeholder="Full Name" value="{{ old('name') }}">
                                                <span class="text-danger" id="error_name"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email ID" value="{{ old('email') }}">
                                                <span class="text-danger" id="error_email"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Your Mobile Number" value="{{ old('mobile') }}">
                                                <span class="text-danger" id="error_mobile"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Your Message">{{ old('message') }}</textarea>
                                                <span class="text-danger" id="error_message"></span>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-12 mb-3">
											<div>
                                                <button type="button" id="btnsubmit" class="btn btn-primary">Submit</button>
											</div>
										</div>
									</div>
                                {{ Form::close() }}
							</div>
						</div>
					</div>

				</div>
			</section>
			<section class="section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="iframe-wrapper">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.0643552005126!2d72.5431716153541!3d23.021409172147578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84e7774a9a0f%3A0x5131dd99d16de8ec!2sAbhishree%20Avenue!5e0!3m2!1sen!2sin!4v1659523069829!5m2!1sen!2sin" style="border:0;width: 100%;height: 100%;"  loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
							</div>
						</div>
					</div>
				</div>
			</section>
            <!--Thankyou Modal -->
            <div class="modal p-0 thankyoumodal" id="thankyoumodal" data-bs-backdrop="true" data-bs-keyboard="true" tabindex="-1" aria-labelledby="thankyoumodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header pb-0 border-0" style="    height: 40px;">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row align-items-center justify-content-between text-center py-4">
                                <img src="{{ asset('images/icons/checked.svg') }}" alt="checked" class="right-checked">
                                <h2>Thank you! <span id="inquery_name"></span></h2>
                                <p>Your query has been submitted. We will reach you soon</p>
                                <div class="my-1 my-md-4">
                                    <a href="{{ route('frontend.home') }}" class="btn btn-primary m-auto ">OK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</main>
		<!-- footer -->
		@include('frontend.layouts.footer')
    	@include('frontend.layouts.footerjs')
	</div>
@endsection
@push('js')
<script>
    $('#btnsubmit').on('click',function(){
            var form= $("#frmContact");
            $.ajax({
                type: "POST",
                url: '{!! route("frontend.save.contact") !!}',
                data: form.serialize(),
                dataType: 'JSON',
                beforeSend: function() {
                    $('#error_name').html('');
                    $('#error_email').html('');
                    $('#error_mobile').html('');
                    $('#error_message').html('');
                },
                success: function (data) {

                    if(data.status == 'success'){
                        $('#thankyoumodal').modal('show');
                        $('#inquery_name').html($('#name').val());
                        $('#name').val('');
                        $('#email').val('');
                        $('#mobile').val('');
                        $('#message').val('');
                    }
                },
                error:function (response) {
                    $('#error_name').html(response.responseJSON.errors.name);
                	$('#error_email').html(response.responseJSON.errors.email);
                    $('#error_mobile').html(response.responseJSON.errors.mobile);
                	$('#error_message').html(response.responseJSON.errors.message);

                }
            });
    });
</script>
@endpush
