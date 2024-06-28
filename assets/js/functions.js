(function ($) {
    "use strict";

     // counter
     $('.counter').counterUp({
        delay: 10,
        time: 2000
    });

     // fixed menu app home page
     $(window).on("scroll",function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            $(".header").addClass("fixed-menu animated slideInDown");
        } else {
            $(".header").removeClass("fixed-menu  animated slideInDown");
        }
    });

    // testimonial-container swiper slider init
    var testimonialContainer = new Swiper('.testimonial-container', {
        slidesPerView: 1,
        loop: true,
        navigation: {
            nextEl: '.testimonial-slider-next1',
            prevEl: '.testimonial-slider-prev1',
          },
          breakpoints: {
            767: {
                slidesPerView: 2
            }
        },
        spaceBetween: 30
    });

    // product-container swiper slider init
    var productContainer = new Swiper('.product-container', {
        slidesPerView: 1,
        loop: true,
        navigation: {
            nextEl: '.testimonial-slider-next1',
            prevEl: '.testimonial-slider-prev1',
          },
          breakpoints: {
            990: {
                slidesPerView: 3
            },
            767: {
                slidesPerView: 2
            }
        },
        spaceBetween: 30
    });

    // product-container swiper slider init
    var productSliderContainer = new Swiper('.product-slider-container', {
        slidesPerView: 1,
        loop: true,
        navigation: {
            nextEl: '.product-slider-next1',
            prevEl: '.product-slider-prev1',
          }
    });

    //menu
    $('.menu-bar').on("click", function(){
        $('body').toggleClass('open-mobile-menu');
    });
    $('.close-bar,.mobile-menu-overlay').on("click", function(){
        $('body').removeClass('open-mobile-menu');
    });
    $('.close-btn').on("click", function(){
        $('body').removeClass('open-mobile-menu');
    });


    $('.mobile-cart-option').on("click", function(){
        $('body').addClass('cart-menu-open');
    });
    $('.close-cart-sidebar').on("click", function(){
        $('body').removeClass('cart-menu-open');
    });



    if($(window).width() > 780) {
        $('.banner-section').mousemove(function (e) {
            $('[data-depth]').each(function () {
                var depth = $(this).data('depth');
                var amountMovedX = (e.pageX * -depth / 3);
                var amountMovedY = (e.pageY * -depth / 6);

                $(this).css({
                    'transform': 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
                    'transition': '0.3s ease',
                });
            });
        });
    }
    if($(window).width() > 990) {
        $(document).ready(function() {
            $('.main-content, .sidebar,.left-sidebar,.product-sidebar')
                .theiaStickySidebar({
                    additionalMarginTop: 110
                });
        });
    }



    $('.cart-submenu .cart-item>.close-item').on('click',function(){
        $(this).parent('.cart-item').remove();
    })

    //lightcase video popup init js
    jQuery(document).ready(function($) {
		$('a[data-rel^=lightcase]').lightcase();
    });
    

    var contentwidth = jQuery(window).width();
    if ((contentwidth) < '990') {
        // jQuery('.item-has-child>a,.cart-option>a').append('<span class="according-menu"></span>');
        jQuery('.item-has-child>a,.cart-option>a').on('click', function() {
            jQuery('.item-has-child>a,.cart-option>a').removeClass('active');
            jQuery('.item-has-child .submenu,.cart-submenu').slideUp('normal');
            if (jQuery(this).next().is(':hidden') == true) {
                jQuery(this).addClass('active');
                jQuery(this).next().slideDown('normal');
            }
        });
        jQuery('.item-has-child .submenu,.cart-submenu').hide();
    } else {
        jQuery('.item-has-child .submenu,.cart-submenu').show();
    }


    var contentwidth = jQuery(window).width();
    if ((contentwidth) < '991') {
        $('.widget .widget-wrapper,.widget-filter-wrapper').addClass('collapse')
        $('.widget .widget-wrapper').removeClass('show')
        $('.widget .widget-title,.widget-head h6 a').addClass('collapsed')
    }


    $(function () {
        setNavigation();
    });
    
    function setNavigation() {
        var pathArray = window.location.pathname.split('/');
        var lastItem = pathArray.pop();
        $(".menu a").each(function () {
            var href = $(this).attr('href');
            if (lastItem.substring(0, href.length) === href) {
                var myLi = $(this).closest('li');
                myLi.addClass('active');
                myLi.parent().parent().addClass('active');
            }
        });
    }




    //lightcase video popup init js
    jQuery(document).ready(function($) {
		$('a[data-rel^=lightcase]').lightcase({
            transitionIn: "scrollRight",
            transitionOut: "scrollLeft"
        });
    });
   
    
})(jQuery);	