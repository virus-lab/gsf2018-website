(function ($) {
    "use strict";

    $('.flipper').matchHeight();
    $('.wcs-timetable__grid .wcs-class').matchHeight();
    $('.wcs-timetable__grid .wcs-class').click(function () {
        $('.wcs-timetable__grid .wcs-class.wcs-class--active').matchHeight({remove: true});
        $.fn.matchHeight._update();
        $('.wcs-timetable__grid .wcs-class.wcs-class--active').matchHeight({
            target: $('.wcs-timetable__grid .wcs-class.wcs-class--active')
        });
    });
    $('.wcs-timetable__grid .wcs-class__minimize.ti-fullscreen').click(function () {
        $('.wcs-timetable__grid .wcs-class.wcs-class--active').matchHeight({remove: false});
        $.fn.matchHeight._update();
    });
    $('.speakers4 .speaker').matchHeight();
    $('.stickywhile').matchHeight();
    $('.nonstickywhile').matchHeight();
    $('.feature2-content').matchHeight();
    
    
    $(document).ready(function () {

        // ======================================================

        // Header scroll function
        function scrollfFromTop() {
            var scroll = $(window).scrollTop();
            if (scroll > 1) {
                $("header").addClass("scroll");
            } else {
                $("header").removeClass("scroll");
            }
        }
        $(window).scroll(function () {
            scrollfFromTop();
        });
        scrollfFromTop();
        //=======================================================

        // Superslides

        $('#slider').superslides({
            play: 6000,
            animation: 'fade',
            animation_speed: 2000
        });

        $('#slider').css({'height': (($(window).height() - 0)) + 'px'});
        $(window).resize(function () {
            $('#slider').css({'height': (($(window).height() - 0)) + 'px'});
        });

        //=======================================================

        // Countdown
        var datetime_year = $("#datetime_year").val();
        var datetime_month = $("#datetime_month").val();
        var datetime_day = $("#datetime_day").val();
        var datetime_hour = $("#datetime_hour").val();
        var datetime_minutes = $("#datetime_minutes").val();
        var transday = $("#transday").val();
        var transdays = $("#transdays").val();
        var transhour = $("#transhour").val();
        var transhours = $("#transhours").val();
        var transminute = $("#transminute").val();
        var transminutes = $("#transminutes").val();
        var transsecond = $("#transsecond").val();
        var transseconds = $("#transseconds").val();

        var deadlineDate = datetime_month + '/' + datetime_day + '/' + datetime_year + ' ' + datetime_hour + ':' + datetime_minutes + ':00';
        var utc = $('#countdown').attr('data-utc');
        console.log(utc);
        
        if ($('#countdown').length) {
            $('#countdown').countdown({
                date: deadlineDate,
                offset: + utc,
                day: transday,
                days: transdays,
                hour: transhour,
                hours: transhours,
                minute: transminute,
                minutes: transminutes,
                second: transsecond,
                seconds: transseconds
            }, function () {
                alert('You are too late, sorry!');
            });

        }
        //=======================================================

        // Speakers flipping

        $('.flipper, .speakers2 .speaker').hover(function () {
            $(this).addClass('flip');
        }, function () {
            $(this).removeClass('flip');
        });

        //=======================================================

        // Schedule 2 

        $('.content-box .trigger').click(function () {
            $(this).toggleClass('active');
            $(this).siblings('.hidden-content').slideToggle(300);
            $(this).siblings('.show-content').slideToggle(300);
            
        });

        //=======================================================

        // Speakers 2 grid 

        $(".speakers2").mason({
            itemSelector: '.speaker',
            ratio: 1,
            sizes: [
                [1, 1]
            ],
            promoted: [
                ['large', 2, 2],
                ['tall', 2, 3],
                ['wide', 3, 2]
            ],
            columns: [
                [0, 480, 1],
                [480, 780, 3],
                [780, 920, 4],
                [920, 1920, 5]
            ],
            filler: {
                itemSelector: '.filler',
                filler_class: 'mason-filler'
            },
            gutter: 0,
            layout: 'fluid'
        });

        //=======================================================

        // Light Gallery

        $(".gallery").lightGallery();

        //=======================================================

        // Counter animation

        $('.number').counterUp({
            delay: 10,
            time: 1000
        });

        //=======================================================



        $('#progress').waypoint(function () {
            $(this).each(function () {
                var progressBar = $(".progress-bar");
                progressBar.each(function (indx) {
                    $(this).css("width", $(this).attr("aria-valuenow") + "%");
                });
            });
        }, {offset: 'bottom-in-view'});


        //=======================================================

// Carousels

        if ($().owlCarousel) {


            // Logo Carousel

            $(".sponsor-carousel").each(function () {

                var columns = parseInt($(this).attr('data-columns'));
                var autoplay = $(this).attr('data-autoplay');
                var navs = parseInt($(this).attr('data-navs'));
                var autoplayTimeout = 5000;

                if (!autoplay) {
                    autoplay = false;
                } else if (autoplay === true) {
                    autoplay = true;
                    autoplayTimeout = 5000;
                } else if (autoplay === false) {
                    autoplay = false;
                } else if (autoplay === 1) {
                    autoplay = true;
                    autoplayTimeout = 5000;
                } else {
                    autoplay = autoplay;
                    autoplayTimeout = autoplay;
                }


                if (navs === 1) {
                    navs = true;
                } else if (navs === true) {
                    navs = true;
                } else if (navs === false) {
                    navs = false;
                } else {
                    navs = false;
                }


                switch (columns) {
                    case 1:
                        var responsive = {0: {items: 1}, 767: {items: 1}, 992: {items: columns}, 1200: {items: columns}, 1600: {items: columns}};
                        break
                    case 2:
                        var responsive = {0: {items: 2}, 767: {items: 2}, 992: {items: columns}, 1200: {items: columns}, 1600: {items: columns}};
                        break
                    case 3:
                        var responsive = {0: {items: 2}, 767: {items: 2}, 992: {items: columns}, 1200: {items: columns}, 1600: {items: columns}};
                        break
                    case 4:
                        var responsive = {0: {items: 2}, 767: {items: 3}, 992: {items: columns}, 1200: {items: columns}, 1600: {items: columns}};
                        break
                    case 5:
                        var responsive = {0: {items: 2}, 767: {items: 3}, 992: {items: columns}, 1200: {items: columns}, 1600: {items: columns}};
                        break
                    default:
                        var responsive = {0: {items: 2}, 767: {items: 3}, 992: {items: columns}, 1200: {items: columns}, 1600: {items: columns}};
                        break
                }

                $(this).owlCarousel({
                    margin: 50,
                    loop: true,
                    dots: false,
                    nav: navs,
                    navText: ['<i class="fa fa-arrow-left fa-2x"></i>', '<i class="fa fa-arrow-right fa-2x"></i>'],
                    autoplayTimeout: autoplayTimeout,
                    autoplay: autoplay,
                    autoplaySpeed: 1500,
                    responsive: responsive
                });

            });

        }
        $(".tab-content :first").addClass('active');
        $(".schedule1 .nav :first, .schedule2 .nav :first, .floor-plan.nav :first").addClass('active');


        $('#wsnavtoggle').click(function () {
            $('.wsmenucontainer').toggleClass('wsoffcanvasopener');
        });

        $('.overlapblackbg').click(function () {
            $('.wsmenucontainer').removeClass('wsoffcanvasopener');
        });


        //MAIN Menu UL SHOW/HIDE JS
        $('.wsmenu-list> li').has('.wsmenu-submenu').prepend('<span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span>');
        $('.wsmenu-list > li').has('.megamenu').prepend('<span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span>');

        $('.wsmenu-click').click(function () {
            $(this).toggleClass('ws-activearrow')
                    .parent().siblings().children().removeClass('ws-activearrow');

            $(".wsmenu-submenu, .megamenu").not($(this).siblings('.wsmenu-submenu, .megamenu')).slideUp('slow');
            $(this).siblings('.wsmenu-submenu').slideToggle('slow');
            $(this).siblings('.megamenu').slideToggle('slow');
        });

        //MAIN Menu UL SHOW/HIDE JS
        //SUB Menu UL SHOW JS
        $('.wsmenu-list > li > ul > li').has('.wsmenu-submenu-sub').prepend('<span class="wsmenu-click02"><i class="wsmenu-arrow fa fa-angle-down"></i></span>');
        $('.wsmenu-list > li > ul > li > ul > li').has('.wsmenu-submenu-sub-sub').prepend('<span class="wsmenu-click02"><i class="wsmenu-arrow fa fa-angle-down"></i></span>');

        $('.wsmenu-click02').click(function () {
            $(this).children('.wsmenu-arrow').toggleClass('wsmenu-rotate');
            $(this).siblings('.wsmenu-submenu-sub').slideToggle('slow');
            $(this).siblings('.wsmenu-submenu-sub-sub').slideToggle('slow');

        });

        var prices3 = $('.prices3').closest('.vc_column-inner ');
        var prices1 = $('.prices1').closest('.vc_column-inner ');
        var prices4 = $('.prices4').closest('.vc_column-inner ');
        function removePaddings(elements) {
            elements.forEach(function (element) {
                $(element).addClass("remove-paddings");
            });

        }
        removePaddings([prices1, prices3, prices4]);
    });

})(jQuery);
