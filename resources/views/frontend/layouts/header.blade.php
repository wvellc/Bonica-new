<header class="header ">
    <div class="googletranslate-wrapper">
        <img src="{{ asset('images/google_translate_logo.svg') }}" alt="">
        <div id="google_translate_element"></div>
    </div>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="d-flex align-items-center justify-content-sm-between">
                        <li class="d-none d-md-inline-block">
                            <a href="{{ route('frontend.home') }}"><img src="{{ asset('images/logo-icon.svg') }}"
                                alt="logo" class="mini-logo"></a>
                            </li>
                            <li class="d-flex align-items-center">
                                <p>FOR COMPLIMENTARY DELIVERY ACROSS INDIA, WHATSAPP US ON <a href="tel:+919726444567">+91
                                9726444567</a></p>
                            </li>
                            @if(isset($countries))
                            <li>
                                <!-- <a href="#"><img src="assets/images/icons/flag.svg" alt="" class="me-2"> <span class="d-none d-md-inline-block">United StateS</span></a> -->
                                <div class="center">
                                    @php
                                    $currentcountry = 'India';
                                    if(Session::has('currency')){
                                        $currentcountry = Session::get('currency')['country'];
                                    }
                                    @endphp
                                    <select name="sources" id="sources"
                                    country="{!! strtolower(str_replace(' ', '-', $currentcountry)) !!}"
                                    class="custom-select sources" placeholder="{{$currentcountry}}">
                                    @foreach ($countries as $country)
                                    @if ($country->name != $currentcountry)
                                    <option value="{{ $country->slug }}">{{ $country->name }}</option>
                                    @endif
                                    @endforeach
                                    {{-- <option value="india" id="india-id" selected>India</option> --}}
                                </select>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <div class="fixed-logo">
                            <a href="{{ route('frontend.home') }}"><img src="{{ asset('images/logo-icon.svg') }}"
                                alt="logo"></a>
                            </div>
                            <div class="container-fluid p-0">
                                <div class="search-box-wrapper d-flex align-items-center">
                                    <ul>
                                        <li class="nav-item">
                                            <a class="nav-link " href="{{ route('frontend.contact') }}" title="Contact Us">
                                                <img src="{{ asset('images/icons/contact.svg') }}" alt=""
                                                class="me-1"><span>Contact</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="d-none d-lg-flex ">
                                        <img src="{{ asset('images/icons/search.svg') }}" alt=""  class="me-1 cursor-pointer"  data-bs-toggle="modal" data-bs-target="#searchModalBox">
                                     <!--    <input class="form-control" type='text' placeholder="Search" id='categorySearch'
                                        name="categorySearch" value=""> -->

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center d-lg-none input-box">
                                       <img src="{{ asset('images/icons/search.svg') }}" alt=""  class="me-1 cursor-pointer"  data-bs-toggle="modal" data-bs-target="#searchModalBox">
                                   </div>

                                  <!--  <div class="d-block d-lg-none input-box">
                                    <input type="text" placeholder="Search...">
                                    <span class="main-search-icon">
                                        <img src="{{ asset('images/icons/search-dark.svg') }}" alt="" class=" search-icon">
                                    </span>
                                    <i class="fal fa-times close-icon"></i>
                                </div> -->

                            </div>
                            <a class="main-logo-wrapper text-center navbar-brand  p-0 m-auto"
                            href="{{ route('frontend.home') }}"> <img src="{{ asset('images/logo.svg') }}"
                            alt="logo"></a>
                            <div class="navbar-toggler" id="menu_button" data-bs-toggle="collapse"
                            data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <input type="checkbox" id="menu_checkbox">
                            <label for="menu_checkbox" id="menu_label">
                                <span id="menu_text_bar"></span>
                            </label>
                        </div>
                        <div class="main-menu-links">
                            <div class="d-none d-lg-block">
                                @include('frontend.layouts.main-menu')
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="bottom-header">
            <div class="row">
                <div class="col-md-12 col-xl-10 m-auto">
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <div class="d-block d-lg-none">
                            @include('frontend.layouts.main-menu')
                        </div>
                        @include('frontend.layouts.product-menu')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<!-- Modal -->
<div class="modal fade searchModalBox" id="searchModalBox" tabindex="-1" aria-labelledby="searchModalBoxLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Search here</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

               <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="categorySearch-wrapper m-auto d-flex">
                         <input class="form-control" type='text' placeholder="Search" id='categorySearch'
                         name="categorySearch" value="">
                         <!-- <img src="{{ asset('images/icons/search.svg') }}" alt="" class="ms-3 cursor-pointer" > -->
                     </div>
                     
                 </div>
             </div>
         </div>

     </div>

 </div>
</div>
</div>
<!-- scroll to top -->
<a href="#" id="scroll-to-top" style="display: none;">
    <span>
        <i class="far fa-chevron-up"></i>
    </span>
</a>
@push('js')
<script>
    $("#categorySearch").autocomplete({
        source: function (request, response)
        {
            $.ajax({
                url: '{!! route("frontend.search") !!}',
                type: 'post',
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}",
                    search: request.term
                },
                success: function (data)
                {
                    response(data);
                }
            });
        },
        select: function (event, ui)
        {
            $('#categorySearch').val(ui.item.label); // display the selected text
            //$('#hidden_service_id').val(ui.item.value); // save selected id to input
            //console.log(ui.item.value1);
            setTimeout(function (){
               window.location.href = ui.item.value1;
           }, 300);
            return false;
        },
        focus: function (event, ui)
        {
            //console.log(ui.item.label);
            $("#categorySearch").val(ui.item.label);
            //$("#hidden_service_id").val(ui.item.value);
            //return false;
        },
    }).data("ui-autocomplete")._renderItem = function (ul, item)
    {
        var inner_html = '<div style="display: flex; width:100%;"><div style="width: 20%;margin-right: 15px;"><img  src="' + item.image + '" ></div><div style="width: 80%;display: flex; align-items: center;">' + item.label + '</div></div>';

        return $("<li style='display: flex; align-items: center;'></li>")
        .data("item.autocomplete", item)
        .append(inner_html)
        .appendTo(ul);
    };

    $("#menu_label").on('click',function(){    
        $('.re-direct').remove("a");
        $('.for-mobile-view').css("display", "block");
        $("body").addClass("menu-open");
    });
</script>

@endpush
