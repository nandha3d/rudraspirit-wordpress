;(function($) {

    "use strict";

      function initSwiperInScope($scope) {
    $scope.find(".tfc-swiper").each(function (index, element) {
        var $container = $(element);

        if (element.swiper && typeof element.swiper.destroy === "function") {
        element.swiper.destroy(true, true);
        }

        var preview   = $container.data("preview") || 1;
        var tablet    = $container.data("tablet") || 1;
        var mobile    = $container.data("mobile") || 1;
        var mobileSm  = $container.data("mobile-sm") !== undefined ? $container.data("mobile-sm") : mobile;

        var spacing   = $container.data("space");
        var spacingMd = $container.data("space-md");
        var spacingLg = $container.data("space-lg");
        if (spacing !== undefined && spacingMd === undefined && spacingLg === undefined) {
        spacingMd = spacing; spacingLg = spacing;
        } else if (spacing === undefined && spacingMd !== undefined && spacingLg === undefined) {
        spacing = 0; spacingLg = spacingMd;
        }
        spacing   = spacing   || 0;
        spacingMd = spacingMd || 0;
        spacingLg = spacingLg || 0;

        var perGroup   = $container.data("pagination")    || 1;
        var perGroupSm = $container.data("pagination-sm") || 1;
        var perGroupMd = $container.data("pagination-md") || 1;
        var perGroupLg = $container.data("pagination-lg") || 1;

        var gridRows   = $container.data("grid") || 1;
        var cursorType = $container.data("cursor") ?? false;
        var loop       = $container.data("loop") ?? false;
        var effect     = $container.data("effect") || "slide";
        var atPlay     = $container.data("auto");
        var speed      = $container.data("speed") || 800;
        var delay      = $container.data("delay") || 1000;
        var direction  = $container.data("direction") || "horizontal";

        var $pagination = $container.find(".tf-sw-pagination").first();

        var nextEl =
            $container.find(".nav-next-swiper").get(0) ||
            $container.closest(".tf-btn-swiper-item").find(".nav-next-swiper").get(0) ||
            $container.closest(".container").find(".group-btn-slider .nav-next-swiper").get(0);

        var prevEl =
            $container.find(".nav-prev-swiper").get(0) ||
            $container.closest(".tf-btn-swiper-item").find(".nav-prev-swiper").get(0) ||
            $container.closest(".container").find(".group-btn-slider .nav-prev-swiper").get(0);

        var opts = {
        direction,
        speed,
        slidesPerView: mobile,
        spaceBetween: spacing,
        slidesPerGroup: perGroup,
        grabCursor: cursorType,
        loop,
        effect,
        autoplay: atPlay ? { delay, disableOnInteraction: false, pauseOnMouseEnter: true } : false,
        observer: true,
        observeParents: true,
        watchOverflow: false,
        breakpoints: {
            575:  { slidesPerView: mobileSm, spaceBetween: spacing,  slidesPerGroup: perGroupSm, grid: { rows: gridRows, fill: "row" } },
            768:  { slidesPerView: tablet,   spaceBetween: spacingMd, slidesPerGroup: perGroupMd, grid: { rows: gridRows, fill: "row" } },
            1200: { slidesPerView: preview,  spaceBetween: spacingLg, slidesPerGroup: perGroupLg, grid: { rows: gridRows, fill: "row" } },
        },
        };

        if (gridRows && gridRows > 1) {
        opts.grid = { rows: gridRows, fill: "row" };
        }

        if ($pagination.length) {
        opts.pagination = { el: $pagination.get(0), clickable: true };
        }

        if (nextEl || prevEl) {
        opts.navigation = {
            nextEl: nextEl || null,
            prevEl: prevEl || null,
        };
        }

        var swiperT = new Swiper(element, opts);

        if (nextEl) nextEl.addEventListener("click", function (e) { e.preventDefault(); swiperT.slideNext(); });
        if (prevEl) prevEl.addEventListener("click", function (e) { e.preventDefault(); swiperT.slidePrev(); });

        $container.find(".swiper-button")
        .off(".tfsw")
        .on("mouseenter.tfsw", function () {
            var slideIndex = $(this).data("slide");
            if (typeof slideIndex !== "undefined") swiperT.slideTo(slideIndex, 500, false);
            $container.find(".card_product--V01.style_2").removeClass("active")
            .eq(slideIndex).addClass("active");
        })
        .on("mouseleave.tfsw", function () {
            $container.find(".card_product--V01.style_2").removeClass("active");
        })
        .on("click.tfsw", function () {
            var slideIndex = $(this).data("slide");
            $container.find(".card_product--V01.style_2").eq(slideIndex).toggleClass("clicked");
        });
    });
    }



    var countDown = function (container) {
        window.initializeCountDowns( $(container).get(0) );
    }

    var parallaxie = function () {
        var $window = $(window);

        if ($(".parallaxie").length) {
            function initParallax() {
                if ($(".parallaxie").length && $window.width() > 991) {
                    $(".parallaxie").parallaxie({
                        speed: 0.55,
                        offset: 0,
                    });
                }
            }

            initParallax();

            $window.on("resize", function () {
                if ($window.width() > 991) {
                    initParallax();
                }
            });
        }
    };

    var testimonialThumb = function ($scope) {
    $scope.find(".tf-sw-thumbs").each(function (index, el) {
        var $wrap = $(el);

        var $thumb   = $wrap.find(".sw-thumb").get(0);
        var $main    = $wrap.find(".sw-main-thumb").get(0);
        var $nextBtn = $wrap.find(".next-thumb").get(0);
        var $prevBtn = $wrap.find(".prev-thumb").get(0);
        var $pagi    = $wrap.find(".sw-pg-thumb").get(0);

        if (!$thumb || !$main) return;

        var thumbSwiper = new Swiper($thumb, {
        slidesPerView: 1,
        watchSlidesProgress: true,
        watchSlidesVisibility: true,
        speed: 800,
        spaceBetween: 10,
        centeredSlides: true,
        });

        var mainSwiper = new Swiper($main, {
        grabCursor: true,
        speed: 800,
        navigation: {
            nextEl: $nextBtn,
            prevEl: $prevBtn,
        },
        pagination: {
            el: $pagi,
            clickable: true,
        },
        });

        thumbSwiper.controller.control = mainSwiper;
        mainSwiper.controller.control = thumbSwiper;
    });
    };


    $(window).on('elementor/frontend/init', function() {
        var widgets = [
        "vemus_slider_content.default",
        "vemus_blog.default",
        "vemus_testimonial.default",
        "vemus_product_video.default",
        "vemus_collection_list.default",
        "vemus_slider.default",
        "vemus_icon_box.default",
        "vemus_banner_with_product.default",
        ];
        widgets.forEach(function (hook) {
        elementorFrontend.hooks.addAction("frontend/element_ready/" + hook, initSwiperInScope);
        });
        initSwiperInScope($(document));
        elementorFrontend.hooks.addAction( 'frontend/element_ready/vemus_countdown.default', countDown );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/vemus_testimonial.default', parallaxie );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/vemus_testimonial_2.default', testimonialThumb );
    });

})(jQuery);