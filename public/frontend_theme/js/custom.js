function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}

$(function () {
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        // ==== HEADER ====
        if (scroll >= 50) {
            $(".header").addClass("fixed");
            $(".mobile-menu-wrapper").addClass("fixed");
        }
        else {
            $(".header").removeClass("fixed");
            $(".mobile-menu-wrapper").removeClass("fixed");
        }
        // ==== SCROLL-TO-TOP ====

        if ($(this).scrollTop() > 100) {
            $('#scroll-to-top').fadeIn();
        } else {
            $('#scroll-to-top').fadeOut();
        }

    });
    $('#scroll-to-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 400);
        return false;
    });

});

// ==== SEARCH BOX ====

// let inputBox = document.querySelector(".input-box"),
// searchIcon = document.querySelector(".main-search-icon"),
// closeIcon = document.querySelector(".close-icon");
// searchIcon.addEventListener("click", () => inputBox.classList.add("open"));
// closeIcon.addEventListener("click", () => inputBox.classList.remove("open"));

// ==== DROPDOWN ====

const $dropdown = $(".header .dropdown");
const $dropdownToggle = $(".header .dropdown-toggle");
const $dropdownMenu = $(".header .dropdown-menu");
const showClass = "show";
$(window).on("load resize", function() {
    if (this.matchMedia("(min-width: 992px)").matches) {
        $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
    } else {
        $dropdown.off("mouseenter mouseleave");
    }
});
jQuery('.header .dropdown-toggle').click(function() {
    var location = jQuery(this).attr('href');
    window.location.href = location;
    return false;
});
jQuery('.header .navbar-nav li.dropdown').prepend('<span class="submenu-button"></span>');

jQuery(".header .submenu-button").click(function () {
    jQuery(this).siblings('.header .dropdown-menu').slideToggle();
    jQuery(this).toggleClass('submenu-opened');
});


var $slide = $(".image-banner-slider")
.slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    // fade: true,
    // speed: 2000,
    autoplaySpeed: 2000,
    autoplay: true
})
.on({
    beforeChange: function(event, slick, currentSlide, nextSlide) {
      $(".slick-slide", this).eq(currentSlide).addClass("preve-slide");
      $(".slick-slide", this).eq(nextSlide).addClass("slide-animation");
  },
  afterChange: function() {
      $(".preve-slide", this).removeClass("preve-slide　slide-animation");
  }
});
$slide.find(".slick-slide").eq(0).addClass("slide-animation");



/* $('.pl-pro-image-box-slider-wrapper').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    infinite: true,
    prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-left"></i></div>',
    nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-right"></i></div>',
    arrows: true,
    speed: 500,
    fade: true,
    cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)'
    // autoplay: true,
    // autoplaySpeed: 3000,
    //lazyLoad: 'ondemand'
}); */



$('.blogs-slider-1').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    infinite: true,
    prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-left"></i></div>',
    nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-right"></i></div>',
    arrows: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true
    }
},
{
    breakpoint: 991,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 1
    }
},
{
    breakpoint: 768,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 1
    }
},
{
    breakpoint: 479,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots:false
    }
}
]
});


$('.products-slider-1').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: false,
    infinite: true,
    prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-left"></i></div>',
    nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-right"></i></div>',
    arrows: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true
    }
},
{
    breakpoint: 991,
    settings: {
        slidesToShow: 3,
        slidesToScroll: 1
    }
},
{
    breakpoint: 768,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 1
    }
},
{
    breakpoint: 479,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots:true
    }
}
]
});


$('.products-slider-2').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: false,
    infinite: true,
    prevArrow: '<div class="catArrowLeft trans"><i class="far fa-chevron-left"></i></div>',
    nextArrow: '<div class="catArrowRight trans"><i class="far fa-chevron-right"></i></div>',
    arrows: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true
    }
},
{
    breakpoint: 991,
    settings: {
        slidesToShow: 3,
        slidesToScroll: 1
    }
},
{
    breakpoint: 768,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 1
    }
},
{
    breakpoint: 479,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots:true
    }
}
]
});

// =============

$(document).ready(function() {
    $(".background-div").hover(function() {
        $(this).addClass("filter-class");
    },
    function() {
        $(this).removeClass("filter-class");
    });
    $(".offer-section .products-slider-image-box").hover(function() {
        $(this).addClass("onhover");
    },
    function() {
        $(this).removeClass("onhover");
    });

    // discover
    $(".filter-toggle").click(function(){
        $(".filter-section").slideToggle();
        $('.full-page-overlay').toggleClass("active");
    });

    // filterOptions
    $('#filterOptions li a').click(function() {

        var ourClass = $(this).attr('class');

        $('#filterOptions li').removeClass('active');
        $(this).parent().addClass('active');

        if(ourClass == 'all') {
            $('#accordionHolder').children('div.item').show();
        }
        else {
            $('#accordionHolder').children('div:not(.' + ourClass + ')').hide();

            $('#accordionHolder').children('div.' + ourClass).show();
        }
        return false;
    });
     // filterOptions

     /* $('#blogfilterOptions li a').click(function() {
        var ourClass = $(this).attr('class');

        $('#blogfilterOptions li').removeClass('active');
        $(this).parent().addClass('active');

        if(ourClass == 'all') {
            $('#blogHolder').children('div.item').show();
        }
        else {
            $('#blogHolder').children('div:not(.' + ourClass + ')').hide();

            $('#blogHolder').children('div.' + ourClass).show();
        }
        return false;
    }); */



 });



/* $(".category-list li a").hover( function() {

    var value=$(this).attr('data-src');

    $(".image-holder img").attr("src", value);
});
 */
// FAVORITE WISHLIST

/* $('.updateFavorite').click(function() {
    event.preventDefault();
    var get = $(this).attr('value');
    var id = $(this).attr('id');

    if(get == 1){
        $(this).removeClass('fas');
        $(this).addClass('far');
        $(this).removeClass('active');
        $("#"+id).attr('value',0);

    }else {
        $(this).removeClass('far');
        $(this).addClass('fas');
        $(this).addClass('active');
        $("#"+id).attr('value',1);
        svgContainer.classList.remove('hide');
        animItem.goToAndPlay(0, true);

    }
}); */

function wishlistProduct(url,id){

    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id : id,
            status : $('#wishlist_product_'+id).attr('value')
        },
        dataType: 'JSON',
        success: function (data) {
            if(data.msg == 'success'){
                $('.mywishlist-count').html(data.wishlist_count);
                var get = $('#wishlist_product_'+id).attr('value');
                if(get == 1){
                    $('#wishlist_product_'+id).removeClass('fas');
                    $('#wishlist_product_'+id).addClass('far');
                    $('#wishlist_product_'+id).removeClass('active');
                    $('#wishlist_product_'+id).attr('value',0);

                }else {
                    $('#wishlist_product_'+id).removeClass('far');
                    $('#wishlist_product_'+id).addClass('fas');
                    $('#wishlist_product_'+id).addClass('active');
                    $('#wishlist_product_'+id).attr('value',1);
                    svgContainer.classList.remove('hide');
                    animItem.goToAndPlay(0, true);

                }
            }
        },
        error:function (response) {
            //$('#error_rating').html(response.responseJSON.errors.rating);

        }
    });
}
// SELECT COUNTRY

$(".custom-select").each(function() {

    var classes = $(this).attr("class");

    var id  = $(this).attr("id");
    var country  = $(this).attr("country");
    var name = $(this).attr("name");
    var template =  '<div class="' + classes + '">';
    template += '<span class="custom-select-trigger"><img src="'+baseUrl+'images/icons/'+country+'-flag.svg" alt="" class="me-2"><span class="text">' + $(this).attr("placeholder") + '</span></span>';
    template += '<div class="custom-options">';
    $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '"><img src="'+baseUrl+'images/icons/' + $(this).attr("value") + '-flag.svg" alt="" class="me-2" /><span class="text">' + $(this).html() + '</span></span>';
    });
    template += '</div></div>';

    $(this).wrap('<div class="custom-select-wrapper"></div>');
    $(this).hide();
    $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
    $(this).parents(".custom-options").addClass("option-hover");
}, function() {
    $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
    $('html').one('click',function() {
        $(".custom-select").removeClass("opened");
    });
    $(this).parents(".custom-select").toggleClass("opened");
    event.stopPropagation();
});
$(".custom-option").on("click", function() {

    //console.log($(this).data("value"));
    $.ajax({
        type: "POST",
        url: currencyUpdate,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            slug : $(this).data("value")
        },
        dataType: 'JSON',
        success: function (data) {
            if(data.msg == 'success'){
                location.reload();
            }
        },
        error:function (response) {
            //$('#error_rating').html(response.responseJSON.errors.rating);

        }
    });
    $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
    $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
    $(this).addClass("selection");
    $(this).parents(".custom-select").removeClass("opened");
    $(this).parents(".custom-select").find(".custom-select-trigger").html('<img src="'+baseUrl+'images/icons/' + $(this).data("value") + '-flag.svg" alt="" class="me-2" /><span class="text">'+ $(this).text() +'</span>');
});


$(".toggle-password").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
} else {
    input.attr("type", "password");
}
});

$('.close-div-btn').on('click', function(){
    $(this).closest(".product-wishlist-box-wrapper-col").remove();
});


jQuery(document).ready(($) => {
    $('.quantity').on('click', '.plus', function(e) {
        let $input = $(this).prev('input.qty');
        let val = parseInt($input.val());
        $input.val( val+1 ).change();
    });

    $('.quantity').on('click', '.minus',
        function(e) {
            let $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            if (val > 1) {
                $input.val( val-1 ).change();
            }
        });
});

