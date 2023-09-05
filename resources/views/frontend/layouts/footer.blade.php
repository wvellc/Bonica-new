<footer class="footer" id='footer'>
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-3 order-4 order-xl-1 contact">
                    <div class="footer-info web-footer">
                        <h5>Contact Us</h5>
                        <ul class="footer-contact-list">
                            <li>
                                <a href="mailto:jaysheel@bonicajewels.com" title="Mail Us"><img
                                        src="{{ asset('images/icons/email.svg') }}"
                                        alt="Mail Us">jaysheel@bonicajewels.com</a>
                            </li>
                            <li>
                                <a href="https://maps.app.goo.gl/4MCpt3WxJE6n1ttW9" target="_blank"
                                    title="Our Location"><img src="{{ asset('images/icons/f-location.svg') }}"
                                        alt="Our Location">104, Abhishree Avenue, Surendra Mangaldas Road, Opp. Hanuman Mandir, nr. Shakti Electronics, Patel Colony, Ambawadi,
                                        Ahmedabad, Gujarat 380015</a>
                            </li>
                            <li>
                                <a href="tel:+919726444567" title="Call Us"><img
                                        src="{{ asset('images/icons/phone.svg') }}" alt="Call Us">+ 91 97264 44567</a>
                            </li>
                        </ul>
                    </div>
                    <div class="f-link footer-info">
                        <div class="f-title">
                            <h5>Contact Us</h5>
                            <div class="toggle-arrow"></div>
                        </div>
                        <ul class="foot-col-data footer-contact-list">
                                <li><a href="mailto:jaysheel@bonicajewels.com" title="Mail Us"><img
                                        src="{{ asset('images/icons/email.svg') }}"
                                        alt="Mail Us">jaysheel@bonicajewels.com</a>
                                </li>
                                <li><a href="https://maps.app.goo.gl/4MCpt3WxJE6n1ttW9" target="_blank"
                                    title="Our Location"><img src="{{ asset('images/icons/f-location.svg') }}"
                                        alt="Our Location">104, Abhishree Avenue, Surendra Mangaldas Road, Opp. Hanuman Mandir, nr. Shakti Electronics, Patel Colony, Ambawadi,
                                        Ahmedabad, Gujarat 380015</a>
                                </li>
                                <li><a href="tel:+919726444567" title="Call Us"><img src="{{ asset('images/icons/phone.svg') }}" alt="Call Us">+ 91 97264 44567</a></li>                               
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3 order-2 order-xl-2">
                    <div class="footer-info web-footer">
                        <h5>Company</h5>
                        <ul class="footer-menu-links">
                            <li>
                                <a href="{{ route('frontend.home') }}" title="Home">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.page', 'about-us') }}" title="About Us">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.page', 'our-story') }}" title="Our Story">Our Story</a>
                            </li>

                            <li>
                                <a href="{{ route('frontend.blogs') }}" title="Blog">Blogs</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.faq') }}" title="FAQ">FAQ</a>
                            </li>
                        </ul>
                    </div>

                    <div class="f-link footer-info">
                        <div class="f-title">
                                <h5>Company</h5>
                                <div class="toggle-arrow"></div>
                        </div>
                        <ul class="foot-col-data">
                                <li><a href="{{ route('frontend.home') }}" title="Home">Home</a></li>
                                <li><a href="{{ route('frontend.page', 'about-us') }}" title="About Us">About Us</a></li>
                                <li><a href="{{ route('frontend.page', 'our-story') }}" title="Our Story">Our Story</a></li>
                                <li><a href="{{ route('frontend.blogs') }}" title="Blogs">Blogs</a></li>
                                <li><a href="{{ route('frontend.faq') }}" title="FAQ">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3 order-3 order-xl-3">
                    <div class="footer-info web-footer">
                        <h5>Help</h5>
                        <ul class="footer-menu-links">

                            <li>
                                <a href="{{ route('frontend.page', 'size-guide') }}" title="Size Guide">Size Guide</a>
                            </li>

                            <li>
                                <a href="{{ route('frontend.page', 'privacy-policy') }}" title="Privacy Policy">Privacy
                                    Policy</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.page', 'delivery-returns') }}"
                                    title="Delivery & Returns">Delivery & Returns</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.page', 'warranty') }}" title="Warranty">Warranty</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.page', 'terms-of-use') }}" title="Terms of use">Terms of
                                    use</a>
                            </li>
                        </ul>
                    </div>

                    <div class="f-link footer-info">
                        <div class="f-title">
                            <h5>Help</h5>
                            <div class="toggle-arrow"></div>
                        </div>
                        <ul class="foot-col-data">
                            <li><a href="{{ route('frontend.page', 'size-guide') }}" title="Size Guide">Size Guide</a></li>
                            <li><a href="{{ route('frontend.page', 'privacy-policy') }}" title="Privacy Policy">Privacy Policy</a></li>
                            <li><a href="{{ route('frontend.page', 'delivery-returns') }}" title="Delivery & Returns">Delivery & Returns</a></li>
                            <li><a href="{{ route('frontend.page', 'warranty') }}" title="Warranty">Warranty</a></li>
                            <li><a href="{{ route('frontend.page', 'terms-of-use') }}" title="Terms of use">Terms of use</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-6 col-xl-3 order-1 order-xl-4">
                    <div class="footer-info">
                        <h5>Newsletter</h5>
                        <span class="text-success" id="success_newsletter"></span>
                        <div class="newsletter-wrapper">

                                <label>Subscribe for newsletter</label>
                                <input type="text" name="newslatter" id="newslatter" class="form-control" placeholder="Your E - mail...">
                                <button type="submit" id="btnNewslatter" class="btn btn-outline-primary mt-2"><img
                                        src="{{ asset('images/icons/newslatter-send.svg') }}" alt="Send"> Subscribe
                                    Now</button>

                        </div>
                        <span class="text-danger" id="error_email"></span>

                        <ul class="footer-social-links d-flex align-items-center ">
                            <li>
                                <a href="https://www.instagram.com/bonicajewels/" target="_blank">
                                    <img src="{{ asset('images/icons/social/instagram.svg') }}" alt="instagram" />
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">

                                    <img src="{{ asset('images/icons/social/google.svg') }}" alt="google" />
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/Bonica-Jewels-100279099088475" target="_blank">

                                    <img src="{{ asset('images/icons/social/facebook.svg') }}" alt="facebook" />
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/channel/UCxZwrpdBSExhBd1p8EAxSUA" target="_blank">
                                    <img src="{{ asset('images/icons/social/youtube.svg') }}" alt="youtube" />
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <img src="{{ asset('images/icons/social/twitter.svg') }}" alt="twitter" />
                                </a>
                            </li>
                            <li>
                                <a href="https://in.pinterest.com/bonicajewels/_saved/" target="_blank">
                                    <img src="{{ asset('images/icons/social/pinterest.svg') }}" alt="pinterest" />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                        <li class="order-3 order-md-1">
                            <p class="copyright-text">&copy; {{date('Y')}} {{ Config::get('constants.APP_NAME')
                                }},<span> All Rights Reserved</span></p>
                        </li>
                        <li class="mb-3 mb-md-0 order-1 order-md-2">
                            <a href="{{ route('frontend.home') }}" class="d-inline-block"><img
                                    src="{{ asset('images/footer-logo.svg') }}" alt="footer-logo"></a>
                        </li>
                        <li class="mb-3 mb-md-0 order-2 order-md-3">
                            <ul class="d-flex align-items-center justify-content-between">
                                <li>
                                    <a href="#"><img src="{{ asset('images/icons/card-visa.svg') }}" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ asset('images/icons/card-mastercard.svg') }}" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ asset('images/icons/card-stripe.svg') }}" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ asset('images/icons/card-paypal.svg') }}" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ asset('images/icons/card-applePay.svg') }}" alt=""></a>
                                </li>
                            </ul>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
@push('js')
<script>
$("#btnNewslatter").click(function() {

    $.ajax({
        url: '{!! route("frontend.newsletter") !!}',
        type: 'post',
        dataType: "json",
        data: {
            _token: "{{ csrf_token() }}",
            email: $('#newslatter').val()
        },
        success: function (data)
        {
            if (data.msg == 'success')
            {
                $('#newslatter').val('');
                $('#success_newsletter').html('Thank you for subscribing.');
                setTimeout(function ()
                {
                    $('#success_newsletter').html('');
                }, 3000);
            }
        },
        error: function (response)
        {
            $('#error_email').html(response.responseJSON.errors.email);
            setTimeout(function ()
            {
                $('#error_email').html('');
            }, 3000);

        }
    });

});

$(document).ready(function() {
            $('.f-title').on("click", function(e) {
                if ($(this).hasClass('menushow')) {
                    remove_styles();
                    $(this).removeClass('menushow');
                    $(this).next('ul').removeClass('menushowtoggle');
                    if ($(this).next('ul').next('ul').length) {
                        $(this).next('ul').next('ul').removeClass('menushowtoggle');
                    }
                } else {
                    remove_styles();
                    $(this).addClass('menushow');
                    $(this).next('ul').addClass('menushowtoggle');
                    if ($(this).next('ul').next('ul').length) {
                        $(this).next('ul').next('ul').addClass('menushowtoggle');
                    }
                }
                e.stopPropagation();
                e.preventDefault();
            });

        function remove_styles() {
            $('.f-title').each(function() {
                $(this).removeClass('menushow');
                $(this).next('ul').removeClass('menushowtoggle');
                if ($(this).next('ul').next('ul').length) {
                    $(this).next('ul').next('ul').removeClass('menushowtoggle');
                }
            });
        }
    })

</script>
@endpush
