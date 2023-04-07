@extends('frontend.layouts.layout')
@section('title', 'Book An Appointment | Bonica Jewels')
@section('meta_description', "LATEST COLLECTION Lab Grown Diamonds Stunning selection and the option to choose from a wide range of diamondContinue Reading 'Bonica Jewels'")
@section('content')
<div class="appointment-page">
	<!-- header -->
	@include('frontend.layouts.header')
		<!-- main -->
        <main>
			<section class="section appointment-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-10 col-xl-6 m-auto">
							<div class="form-wrapper">
								<div class="text-center">
									<h2>Book AN Appointment</h2>
									<p>It's simple to use our virtual consultation service. Simply schedule a time slot, and one of our jewelry professionals will be there to assist you.</p>
								</div>
								{{ Form::open(array('url' => route('frontend.save.appointment'), 'method'=> 'POST', 'enctype' => 'multipart/form-data', 'id' => 'frmAppointment')) }}
									<div class="row mt-4">
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="name" placeholder="Full Name" value="{{ old('name') }}">
												<span class="input-icon"><i class="fas fa-user"></i></span>
                                                <span class="text-danger" id="error_name"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email ID" value="{{ old('email') }}">
												<span class="input-icon"><i class="fas fa-envelope"></i></span>
                                                <span class="text-danger" id="error_email"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
                                                <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Your Mobile Number" value="{{ old('mobile') }}">
												<span class="input-icon"><i class="fas fa-phone-alt"></i></span>
                                                <span class="text-danger" id="error_mobile"></span>
											</div>
										</div>
									</div>
									<!-- <div class="row">
										<div class="col-md-12">

											<div class="form-group " id="bootstrap-datepicker">
												<input class="form-control startDate"  placeholder="DD/MM/YYYY" type="text" data-provide="datepicker" id="startDate" name="StartDate" value="">
											</div>
										</div>
									</div> -->
									<!-- <div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<div class="select-box ">
													<select class="form-control ps-0" name="subject" id="subject">
														<option>Subject</option>
														<option>Subject 1</option>
														<option>Subject 2</option>
													</select>
												</div>
											</div>
										</div>
									</div> -->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
                                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Your Message">{{ old('message') }}</textarea>
												<span class="input-icon">	<i class="fas fa-pencil"></i></span>
                                                <span class="text-danger" id="error_message"></span>

											</div>
										</div>
									</div>
									<div class="row mt-4">
										<div class="col-md-12 col-lg-12">
											{{-- <a href="#" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#thankyoumodal">Submit</a> --}}
                                            <button type="button" id="btnsubmit" class="btn btn-primary">Submit</button>
										</div>
									</div>
                            {{ Form::close() }}
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
        var form= $("#frmAppointment");
            $.ajax({
                type: "POST",
                url: '{!! route("frontend.save.appointment") !!}',
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
                        $('#subject').val('');
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
