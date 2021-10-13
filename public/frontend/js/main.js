(function($) {
    ("use strict");
    // TO  Menu Sticky
    $(window).on("scroll", function() {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $("#sticky-header").removeClass("sticky");
            $("#back-top").fadeIn(500);
        } else {
            $("#sticky-header").addClass("sticky");
            $("#back-top").fadeOut(500);
        }
    });

    // sumer note
    // $("#summernote").summernote({
    //     placeholder: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.",
    //     tabsize: 2,
    //     height: 360,
    // });

    // load more

    $("#loadMore").on("click", function() {
        $(".load-content").addClass("active");
    });

    // TOP Menu Sticky(blog-page)
    $(window).on("scroll", function() {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $("#sticky-header").removeClass("sticky");
        } else {
            $("#sticky-header").addClass("sticky");
        }
    });

/* -------------------------------------------------------------------------- */
/*                            // update for isotop                            */
/* -------------------------------------------------------------------------- */

    $(".portfolio-menu").on("click", "button", function() {
        var filterValue = $(this).attr("data-filter");
        $grid.isotope({ filter: filterValue });
    });

    //for menu active class
    $(".portfolio-menu button").on("click", function(event) {
        $(this).siblings(".active").removeClass("active");
        $(this).addClass("active");
        event.preventDefault();
    });
    var $grid = $(".grid").isotope({
        itemSelector: ".grid-item",
        percentPosition: true,
        masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: 1,
        },
    });
    $grid.imagesLoaded().progress( function() {
        $grid.isotope('layout');
    });


    
    $(document).ready(function() {
        // main-menu
        $("ul#navigation").slicknav({
            prependTo: ".mobile_menu",
            closedSymbol: '<i class="ti-angle-down"></i>',
            openedSymbol: '<i class="ti-angle-up"></i>',
        });

        // blog-menu
        $("ul#blog-menu").slicknav({
            prependTo: ".blog_menu",
        });

        // review-active
        $(".review-active").owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            autoplay: true,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>',
            ],
            nav: false,
            dots: true,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1,
                },
                767: {
                    items: 1,
                },
                992: {
                    items: 1,
                },
            },
        });

        // for filter
        // init Isotope
        // $('#container').imagesLoaded( function() {
        //     var $grid = $(".grid").isotope({
        //         itemSelector: ".grid-item",
        //         percentPosition: true,
        //         masonry: {
        //             // use outer width of grid-sizer for columnWidth
        //             columnWidth: 1,
        //         },
        //     });

        //     // filter items on button click
        //     $(".portfolio-menu").on("click", "button", function() {
        //         var filterValue = $(this).attr("data-filter");
        //         $grid.isotope({ filter: filterValue });
        //     });

        //     //for menu active class
        //     $(".portfolio-menu button").on("click", function(event) {
        //         $(this).siblings(".active").removeClass("active");
        //         $(this).addClass("active");
        //         event.preventDefault();
        //     });
        // });
      


/* -------------------------------------------------------------------------- */
/*                                   WOW js                                   */
/* -------------------------------------------------------------------------- */
        new WOW().init();

        // brand-active
        $(".brand-active").owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            autoplay: true,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>',
            ],
            nav: false,
            dots: true,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 2,
                },
                767: {
                    items: 4,
                },
                992: {
                    items: 6,
                },
            },
        });

        // select js
        $("select").niceSelect({});

        // counter
        $(".counter").counterUp({
            delay: 10,
            time: 10000,
        });

        /* magnificPopup img view */
        $(".popup-image").magnificPopup({
            type: "image",
            gallery: {
                enabled: true,
            },
        });

        /* magnificPopup video view */
        $(".popup-video").magnificPopup({
            type: "iframe",
        });

        // scrollIt for smoth scroll
        $.scrollIt({
            upKey: 38, // key code to navigate to the next section
            downKey: 40, // key code to navigate to the previous section
            easing: "linear", // the easing function for animation
            scrollTime: 600, // how long (in ms) the animation takes
            activeClass: "active", // class given to the active nav element
            onPageChange: null, // function(pageIndex) that is called when page is changed
            topOffset: 0, // offste (in px) for fixed top navigation
        });

        // scrollup bottom to top
        $.scrollUp({
            scrollName: "scrollUp", // Element ID
            topDistance: "4500", // Distance from top before showing element (px)
            topSpeed: 300, // Speed back to top (ms)
            animation: "fade", // Fade, slide, none
            animationInSpeed: 200, // Animation in speed (ms)
            animationOutSpeed: 200, // Animation out speed (ms)
            scrollText: '<i class="fa fa-angle-double-up"></i>', // Text for element
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });

        //blog-slider-active
        $(".blog-slider-active").owlCarousel({
            loop: true,
            margin: 30,
            items: 1,
            // autoplay:true,
            navText: [
                '<i class="ti-arrow-left"></i>',
                '<i class="ti-arrow-right"></i>',
            ],
            nav: true,
            dots: false,
            // autoplayHoverPause: true,
            // autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },
                767: {
                    items: 1,
                },
                992: {
                    items: 2,
                },
            },
        });

        // blog-dtails-page

        //blog-slider-active
        $(".blog-dtails-active").owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            // autoplay:true,
            navText: [
                '<i class="ti-arrow-left"></i>',
                '<i class="ti-arrow-right"></i>',
            ],
            nav: false,
            dots: false,
            // autoplayHoverPause: true,
            // autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },
                767: {
                    items: 1,
                },
                992: {
                    items: 1,
                },
            },
        });

        // catagori menu hide and show
        $(".catagori-menu li a").mouseover(function() {
            $(".catagori-submenu-area").show();
        });

        $(".submenu-close").click(function() {
            $(".catagori-submenu-area").hide();
        });


        // deposite tabs 
        $('.single_deposite_item').click( function(){
            if ( $(this).hasClass('active') ) {
                $(this).removeClass('active');
            } else {
                $('.single_deposite_item.active').removeClass('active');
                $(this).addClass('active');    
            }
        });
        $(document).click(function(event){
            if (!$(event.target).closest(".single_deposite_item").length) {
                $("body").find(".single_deposite_item").removeClass("active");
            }
        });

        // popup

        $(".checkout-hide").click(function() {
            $(".cart_details_popup-show, .cart_details_popup_upper").hide();
        });
        $(".cart_details_popup-show").click(function() {
            $(".cart_details_popup-show").hide();
        });

        $(document).on("click", ".popup-modal-dismiss", function(e) {
            e.preventDefault();
            $.magnificPopup.close();
        });
    });
    //------- Mailchimp js --------//
    function mailChimp() {
        $("#mc_embed_signup").find("form").ajaxChimp();
    }
    mailChimp();

    // close set
    $(document).click(function(event) {
        if (!$(event.target).closest(".cart_details_popup_upper").length) {
            $("body").find(".cart_details_popup_upper").hide("list_visiable");
        }
    });


})(jQuery);