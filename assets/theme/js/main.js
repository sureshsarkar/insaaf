jQuery(document).ready(function ($) {
  
  
   
   
    
    $(".pull-bs-canvas-right").click(function () {
        $(".canvas-right").addClass("mr-0 d-block");
        $(".overlay2").show();
        $("body").addClass("overflow-hidden position-fixed");
    });
    //
    //$("").click(function(){
    //    alert("h");
    //    $(".canvas-right").removeClass("mr-0");
    //    $(".overlay2").hide();
    //});

    $(".overlay2 , .close-sidebar , .bs-canvas-close").click(function () {
        $(".canvas-right").removeClass("mr-0");
        $("body").removeClass("overflow-hidden position-fixed");
        $(this).hide();
    })
 $("#searchoverlay , .fa-times").click(function () {
     $("#searchoverlay").hide();
     $(".full-w-search").hide();
     //document.getElementById("mySidenav").style.width = "0";
 });

 $(".full-w-opt").click(function () {
     $("#searchoverlay").show();
 });
    $(".full-w-opt").click(function () {
    $(".full-w-search").toggle();
});
    
    
    
    $(".loadCatBtn").click(function(){
        $(this).hide();
    });
    
    $('#leader1').owlCarousel({
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
                stagePadding: 50,
                dots: true,
                margin: 20,
            },
            600: {
                items: 1,
                margin: 10,
            },
            1000: {
                items: 1,
                dots: false,
                margin: 10,
            }
        }
    });
       $('.slider-pic').owlCarousel({
        loop: true,
        nav: false,  
        items: 1,
        transitionStyle: "fade",
        dots:false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        touchDrag: false,
        mouseDrag: false,
        autoplay:true,
        autoplayTimeout:3000      
    });
    $('.videolist-slider').owlCarousel({
        loop: true,
        nav: true,  
        items: 1,      
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    });
    
    $('.recomendation-slider').owlCarousel({
        loop: 1,
        nav: false,  
        items: 1,
        transitionStyle: "fade",
        dots:false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        touchDrag  : false,
        mouseDrag  : false,
        autoplay:1,
        autoplayTimeout:9000 ,
          responsive: {
            0: {               
                margin: 0,

            },
            600: {               
                margin: 55,
            },
            1000: {               
                margin: 0,
            },
            1366: {               
                margin: 0,
            }
        }

     
    });
	
	
	
      $('.list-slider').owlCarousel({

        loop: true,
        dots: true,
        nav: false,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        //margin: 20,
       responsive: {
                0: {
                    items: 1,
                    stagePadding: 50,
                    margin: 20,

                },
               600: {
                    items: 2,
                    margin: 15,
                     stagePadding: 50,
                },
                1000: {
                    items: 3,
                    margin: 15,
                },

                1366: {
                    items: 4,
                    margin: 30,
                }
            }
    });
    
    $('#limeSlider2, #leaderPhone').owlCarousel({
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
                stagePadding: 50,
                dots: true,
                margin: 20,
            },
            600: {
                items: 1,
                margin: 10,
            },
            1000: {
                items: 4,
                dots: false,
                margin: 10,
            }
        }
    });

    $('#slidemyfilter').owlCarousel({
        loop: false,
        nav: true,
        mouseDrag: false,
        items: 4,
        margin:30,
        dots: false,
        navText: ["<i class='fa fa-caret-square-left'></i>", "<i class='fa fa-caret-square-right'></i>"],       
    });

    $(".stone_shape li").click(function () {
        $(this).find(".blackImg").hide();
        $(this).find(".hightlightImg").show();
    })
    $(".navbar-toggler").click(function () {
        $(".navbar-nav").toggleClass("left0");
        $("body").toggleClass("overflow-hidden position-fixed");
        $(".overlay1 , .closeBtn").toggle();
        $(".menuPhone").toggleClass("del9");
    });

    $(".overlay1 , .closeBtn").click(function () {
        $(".overlay1 , .closeBtn").hide();
        $(".navbar-nav").removeClass("left0");
        $("body").removeClass("overflow-hidden position-fixed");
        $(".menuPhone").removeClass("del9");
    });


    $('#video-thumb1').click(function () {
        $('#my-iframe1').show();
        $("#my-iframe1")[0].src += "?autoplay=1";
        $('#video-thumb1').hide();
    });


    $(".show_filter_btn").click(function () {
        $(".filter_section").slideToggle();
    })

    //desktop filter end


    //mobile filter
    $(".filter3").click(function () {
        $(".filterList1").addClass("left1");
        $("body").addClass("position-fixed overflow-hidden");
        $(".sticky-top").addClass("position-relative hide-header");
    });

    $(".filterList li").click(function () {
        $(this).find(".far").toggleClass("fa");
    })

    $(".filter4 i.fa.fa-arrow-left").click(function () {
        $(".filterList1").removeClass("left1");
        $(".filterList1").removeClass("left1");
        $("body").removeClass("position-fixed overflow-hidden");
        $(".sticky-top").removeClass("position-relative hide-header");
    });


    $(".filter2").click(function () {
        $(".filterList2").addClass("left1");
        $("body").addClass("position-fixed overflow-hidden");
        $(".sticky-top").addClass("position-relative hide-header");
    });

    $(".filterList2 .filter4 i.fa.fa-arrow-left").click(function () {
        $(".filterList2").removeClass("left1");
       // $(".filterList2").removeClass("left1");
         $("body").removeClass("position-fixed overflow-hidden");
        $(".sticky-top").removeClass("position-relative hide-header");
    });


    //    $(".phoneSearchIcon").click(function () {
    //        $(".searchBar").slideToggle();
    //    });

  $(".shortflt").click(function(e){
        $(".filterBox").fadeToggle();e.stopPropagation();
    });
    
    
    $(".type2 button").click(function () {
        $(".fa-minus").toggleClass("fa-plus");
    }); 
    
      // list page for shape opt in filter

  $('.ir246-product-shape li').removeClass('active');
  $('.ir246-product-shape li').click(function() {  
      $(this).addClass('active');
      $(this).attr('data-action', 'Unselect');      
  });

    //lightbox for description page
    $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr('id');
        var id = parseInt(id_selector.substr(id_selector.lastIndexOf('-') + 1));
        $('#myCarousel').carousel(id);
    });
    // Only display 3 items in nav on mobile.
    if ($(window).width() < 575) {
        $('#carousel-thumbs .row div:nth-child(4)').each(function () {
            var rowBoundary = $(this);
            $('<div class="row mx-0">').insertAfter(rowBoundary.parent()).append(rowBoundary.nextAll().addBack());
        });
        $('#carousel-thumbs .carousel-item .row:nth-child(even)').each(function () {
            var boundary = $(this);
            $('<div class="carousel-item">').insertAfter(boundary.parent()).append(boundary.nextAll().addBack());
        });
    }
    // Hide slide arrows if too few items.
    if ($('#carousel-thumbs .carousel-item').length < 2) {
        $('#carousel-thumbs [class^=carousel-control-]').remove();
        $('.machine-carousel-container #carousel-thumbs').css('padding', '0 5px');
    }
    // when the carousel slides, auto update
    $('#myCarousel').on('slide.bs.carousel', function (e) {
        var id = parseInt($(e.relatedTarget).attr('data-bs-slide-number'));
        $('[id^=carousel-selector-]').removeClass('selected');
        $('[id=carousel-selector-' + id + ']').addClass('selected');
    });


    $('#myCarousel .carousel-item img').on('click', function (e) {
        var src = $(e.target).attr('data-bs-remote');
        if (src) $(this).ekkoLightbox();
    });

    //wizard form

    new WOW().init();
    
     // Preview Sapphire Animations

  // init controller
  var controller = new ScrollMagic.Controller({
    globalSceneOptions: {
      reverse: true
    }
  });

  var tween = TweenMax.to(".sprite-sapphire", 1.0, {
    backgroundPosition: "0 100%",
    // First Version
    // ease: SteppedEase.config(17)
    // Second (Rotating Sapphire)
    ease: SteppedEase.config(20)
  });

  var scene = new ScrollMagic.Scene({
      triggerElement: '#trigger',
      duration: $('.preview-sapphire-wrap').height() - 150
    })
    .triggerHook(.4)
    
    // .setPin("#trigger")
    .setTween(tween)
    .addTo(controller);
    
//wizard form end
    
    
    //smooth scroll with offset
    $('.target a[href^="#"]').on('click', function (e) {
        // e.preventDefault();

        var target = this.hash,
            $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 90
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });

    //scroll end

   // new WOW().init();
    
    
    
    //data scroll for description phone page
    $('a[data-scroll]').click(function (e) {
        e.preventDefault();
        //Set Offset Distance from top to account for fixed nav
        var offset = 230;
        var target = ('#' + $(this).data('scroll'));
        var $target = $(target);
        //Animate the scroll to, include easing lib if you want more fancypants easings
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - offset
        }, 800, 'swing');
    });

    //swap image for desc page

    var $overlay = $('<div id="overlay"></div>')
    var $image = $('<img>');

    $overlay.append($image);

    $('body').append($overlay);
    //Hover and show in big image
    $('.swap img').hover(function () {
        var $src = $(this).attr('src');
        $('#main-img img').attr('src', $src);
    });

    //Click big image ans show overlay
    $('#main-img img').click(function () {
        $overlay.show();

        var imageLoad = $(this).attr('src');
        $image.attr('src', imageLoad);

    });

    $overlay.click(function () {
        $overlay.hide();
    });

    //swap end

    var btn = $('#button');

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '300');
    });
    //Home page end
});

//video play on product list page

function payPouseVideos(e) {
    var a = e;
    jQuery(".videostatus" + a).hasClass("fa-play") ? (jQuery(".videodata" + a).css("display", "block"), jQuery(".videostatus" + a).removeClass("fa-play").addClass("fa-times"), jQuery("#video" + a).show().get(0).play(), jQuery(".videodata" + a).css({
        background: "#fff"
    })) : (jQuery(".videodata" + a).css("display", "none"), jQuery(".videostatus" + a).removeClass("fa-times").addClass("fa-play"), jQuery("#video" + a).hide().get(0).pause(), jQuery(".videodata" + a).css({
        background: "none"
    }))
}

//number increment cart page
function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
}

function decreaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    document.getElementById('number').value = value;
}

$(window).scroll(function () {

    if ($(document).scrollTop() > 20) {
        //$(".menubarList").addClass("addBg");        
      //  $(".topHeader").addClass("add-top-0");
       // $(".searchBar").addClass("scroll-search");
        $(".menu2").addClass("scroll-menu");
       // $(".sec-menu-logo .img-fluid").show();
       // $(".sec-menu-list").show();
      
        $(".sec-search-bar").show();
      //  $(".menuBtn").addClass("position-sticky top-0");
    } else {
       // $(".menubarList").removeClass("addBg");
       // $(".topHeader").removeClass("add-top-0");
      //  $(".searchBar").removeClass("scroll-search");
        $(".menu2").removeClass("scroll-menu");
     //   $(".sec-menu-logo .img-fluid").hide();
      //  $(".sec-menu-list").hide();
      //  $(".phone-on-menu").hide();
        //$(".sec-search-bar").hide();
      //  $(".menuBtn").removeClass("position-sticky top-0");      
    }
});

  jQuery(window).scroll(function() {
        winWidth = jQuery(window).width();
        winHeight = jQuery(window).height();
        var cntScroll = jQuery(window).scrollTop();
        if (winWidth >= 768 && cntScroll >= 100) {
            jQuery('header').addClass('fixes');
            jQuery('#navbarNav').appendTo('.stickyNav');
            jQuery('.menuIcon').appendTo('.stickyUser');
              jQuery(".phone-on-menu").show();
        } else {
            jQuery('header').removeClass('fixes');
            jQuery('#fixedHeader #navbarNav').appendTo('.menubarList .span_12');
            jQuery('#fixedHeader .menuIcon').appendTo('.menuSec3');
             jQuery(".phone-on-menu").hide();
        }
    });







if (window.matchMedia('(max-width: 768px)').matches)
{
   $( "#mega-link" ).click(function() {
  $( ".megaMenu" ).toggle( "slow", function() {
  });
});
}


