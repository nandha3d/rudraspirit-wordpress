/**
 * isMobile
 * headerFixed
 * responsiveMenu
 * themesflatSearch
 * detectViewport
 * blogLoadMore
 * commingsoon
 * goTop
 * retinaLogos
 * customizable_carousel
 * parallax
 * iziModal
 * bg_particles
 * pagetitleVideo
 * toggleExtramenu
 * removePreloader
 */

(function ($) {
    "use strict";

    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (
                isMobile.Android() ||
                isMobile.BlackBerry() ||
                isMobile.iOS() ||
                isMobile.Opera() ||
                isMobile.Windows()
            );
        },
    };

    var dropdownSelect = function () {
        $(".tf-dropdown-select").selectpicker();
    };


    var selectImages = function () {
        if ($(".setting-curreny-language").length > 0) {
            const selectIMG = $(".setting-curreny-language");
            const selectCRR = $(".setting-curreny-language.type-currencies");
            const selectLGG = $(".setting-curreny-language.type-languages");

            selectIMG.find("option").each((idx, elem) => {
                const selectOption = $(elem);
                const imgURL = selectOption.attr("data-thumbnail");
                if (imgURL) {
                    selectOption.attr(
                        "data-content",
                        `<img src="${imgURL}" /> ${selectOption.text()}`
                    );
                }
            });
            selectIMG.selectpicker();
            selectCRR.on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                const currency = $(this).val();
                if (currency) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('currency', currency);
                    window.location.href = url.toString();
                }
            });
            selectLGG.on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                const language = $(this).val();
                if (language) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('lang', language);
                    window.location.href = url.toString();
                }
            });

        }

    };

    var openSearch = function () {
        if ($(".ajax-search-input-header").length > 0) {
            $(document).on('click', '.ajax-search-input-header', function (e) {
                e.preventDefault();
                var offcanvasEl = document.getElementById('tfsearch');
                var offcanvas = new bootstrap.Offcanvas(offcanvasEl);
                offcanvas.show();
            });
        }
    }

    var goTop = function () {
        var $goTop = $("#goTop");
        var $borderProgress = $(".border-progress");

        $(window).on("scroll", function () {
            var scrollTop = $(window).scrollTop();
            var docHeight = $(document).height() - $(window).height();
            var scrollPercent = (scrollTop / docHeight) * 100;
            var progressAngle = (scrollPercent / 100) * 360;

            $borderProgress.css("--progress-angle", progressAngle + "deg");

            if (scrollTop > 100) {
                $goTop.addClass("show");
            } else {
                $goTop.removeClass("show");
            }
        });

        $goTop.on("click", function () {
            $("html, body").animate({ scrollTop: 0 }, 0);
        });
    };

    var headerSticky = function () {
        let lastScrollTop = 0;
        let delta = 5;
        let navbarHeight = $("header").outerHeight();
        let adminBarHeight = $("#wpadminbar").length ? $("#wpadminbar").outerHeight() : 0;
        let didScroll = false;

        $(window).scroll(function () {
            didScroll = true;
        });

        setInterval(function () {
            if (didScroll) {
                let st = $(window).scrollTop();
                navbarHeight = $("header").outerHeight();

                if (st > navbarHeight) {
                    if (st > lastScrollTop + delta) {
                        $("header").css("top", `-${navbarHeight}px`);
                        $(".sticky-top").css("top", `${15 + adminBarHeight}px`);
                    } else if (st < lastScrollTop - delta) {
                        $("header").css("top", `${adminBarHeight}px`);
                        $("header").addClass("header-sticky");
                        $(".sticky-top").css("top", `${15 + navbarHeight + adminBarHeight}px`);
                    }
                } else {
                    $("header").css("top", `unset`);
                    $("header").removeClass("header-sticky");
                    $(".sticky-top").css("top", `${15 + adminBarHeight}px`);
                }
                lastScrollTop = st;
                didScroll = false;
            }
        }, 250);
    };

    var menu_mobile = function () {
        var hasChildMenu = $(".nav-ul-mb").find("li:has(ul)");
        hasChildMenu.children("ul").hide();
        if (hasChildMenu.find(">span").length == 0) {
            hasChildMenu
                .children("a")
                .after('<span class="btn-submenu btn-open-sub"></span>');
        }

        $(document).on(
            "click",
            ".nav-ul-mb li .btn-submenu",
            function (e) {
                $(this).toggleClass("active").next("ul").slideToggle(300);
                e.stopImmediatePropagation();
            }
        );
        $('.mobile-off-modal').on('click', function () {
            var offcanvasEl = $('#mobileMenu')[0];
            var bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);

            if (!bsOffcanvas) {
                bsOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
            }

            bsOffcanvas.hide();
        });
    }

    var swiper_slider = function () {
        var swiperInstances = {}
        if ($(".tfwc-slider").length > 0) {
            $(".tfwc-slider").each(function (index) {
                const config = $(this).data("swiper");
                if (swiperInstances[index]) {
                    swiperInstances[index].destroy(true, true);
                }
                swiperInstances[index] = new Swiper(this, config);

            });
        }
    }

    var fix_search = function () {
        jQuery(document).ready(function ($) {
            $('form.wp-block-search').on('submit', function (e) {
                e.preventDefault();
                const keyword = $.trim($(this).find('input[name="s"]').val());
                if (keyword !== '') {
                    const baseUrl = $(this).attr('action');
                    window.location.href = baseUrl + '?s=' + encodeURIComponent(keyword);
                }
            });
        });
    }

    var handleFooter = function () {
        var footerAccordion = function () {
            var args = { duration: 250 };
            $(".widget_nav_menu .widget-title,.footer-heading-mobile").on("click", function () {
                var widget = $(this).closest(".widget_nav_menu,.footer-col-block");
                widget.toggleClass("open");
                if (!widget.is(".open")) {
                    widget.find('> [class^="menu-"],.tf-collapse-content').slideUp(args);
                } else {
                    widget.find('> [class^="menu-"],.tf-collapse-content').slideDown(args);
                }
            });
        };
        function handleAccordion() {
            if (matchMedia("only screen and (max-width: 575px)").matches) {
                if (!$(".widget_nav_menu .widget-title,.footer-heading-mobile").data("accordion-initialized")) {
                    footerAccordion();
                    $(".widget_nav_menu .widget-title,.footer-heading-mobile").data("accordion-initialized", true);
                }
            } else {
                $(".widget_nav_menu .widget-title,.footer-heading-mobile").off("click");
                $(".widget_nav_menu .widget-title").closest(".widget_nav_menu").removeClass("open");
                $(".widget_nav_menu ").find('> [class^="menu-"]').removeAttr("style");
                $(".footer-heading-mobile").closest("footer-col-block").removeClass("open");
                $(".footer-col-block ").find('.tf-collapse-content').removeAttr("style");
                $(".widget_nav_menu .widget-title,.footer-heading-mobile").data("accordion-initialized", false);
            }
        }
        handleAccordion();
        window.addEventListener("resize", function () {
            handleAccordion();
        });
    };

    /* Infinite Slide 
    -------------------------------------------------------------------------*/
    var infiniteSlide = function () {
        if ($(".infiniteSlide").length > 0) {
            $(".infiniteSlide").each(function () {
                var $this = $(this);
                var style = $this.data("style") || "left";
                var clone = $this.data("clone") || 2;
                var speed = $this.data("speed") || 50;
                $this.infiniteslide({
                    speed: speed,
                    direction: style,
                    clone: clone,
                });
            });
        }
    };

    var styleSelect = function () {
        if ($(".st-select").length > 0) {
            $('select.st-select').niceSelect();
        }
    }

    var vemusSwiper = function ($container = null) {
        if (!$container) {
            $container = document;
        }
        $(".vemus-swiper").each(function (index, element) {
            var $this = $(element);
            if ($this.children('.swiper-wrapper').length === 0) {
                return;
            }
            var preview = $this.data("preview") || 1;
            var tablet = $this.data("tablet") || 1;
            var mobile = $this.data("mobile") || 1;
            var mobileSm = $this.data("mobile-sm") !== undefined ? $this.data("mobile-sm") : mobile;

            // Spacing
            var spacing = $this.data("space");
            var spacingMd = $this.data("space-md");
            var spacingLg = $this.data("space-lg");
            if (spacing !== undefined && spacingMd === undefined && spacingLg === undefined) {
                spacingMd = spacing;
                spacingLg = spacing;
            } else if (spacing === undefined && spacingMd !== undefined && spacingLg === undefined) {
                spacing = 0;
                spacingLg = spacingMd;
            }
            spacing = spacing || 0;
            spacingMd = spacingMd || 0;
            spacingLg = spacingLg || 0;

            var perGroup = $this.data("pagination") || 1;
            var perGroupSm = $this.data("pagination-sm") || 1;
            var perGroupMd = $this.data("pagination-md") || 1;
            var perGroupLg = $this.data("pagination-lg") || 1;
            var gridRows = $this.data("grid") || 1;
            var cursorType = $this.data("cursor") ?? false;
            var loop = $this.data("loop") ?? false;
            var loopMd = $this.data("loop-md") ?? false;
            var effect = $this.data("effect") || "slide";
            var atPlay = $this.data("auto"); // True || False
            var speed = $this.data("speed") || 800;
            var delay = $this.data("delay") || 1000;
            var direction = $this.data("direction") || "horizontal";

            var swiperT = new Swiper($this[0], {
                direction: direction,
                speed: speed,
                slidesPerView: mobile,
                spaceBetween: spacing,
                slidesPerGroup: perGroup,
                grabCursor: cursorType,
                loop: loop,
                effect: effect,
                autoplay: atPlay
                    ? {
                        delay: delay,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    }
                    : false,
                grid: {
                    rows: gridRows,
                    fill: "row",
                },
                pagination: {
                    el: [$this.find(".tf-sw-pagination")[0], $this.closest(".tf-pag-swiper").find(".tf-sw-pagination")[0]],
                    clickable: true,
                },
                observer: true,
                observeParents: true,
                navigation: {
                    nextEl: [
                        $this.closest(".tf-btn-swiper-item").find(".nav-next-swiper")[0],
                        $this.closest(".container").find(".group-btn-slider .nav-next-swiper")[0],
                    ],
                    prevEl: [
                        $this.closest(".tf-btn-swiper-item").find(".nav-prev-swiper")[0],
                        $this.closest(".container").find(".group-btn-slider .nav-prev-swiper")[0],
                    ],
                },
                breakpoints: {
                    575: {
                        slidesPerView: mobileSm,
                        spaceBetween: spacing,
                        slidesPerGroup: perGroupSm,
                        grid: {
                            rows: gridRows,
                            fill: "row",
                        },
                    },
                    768: {
                        slidesPerView: tablet,
                        spaceBetween: spacingMd,
                        slidesPerGroup: perGroupMd,
                        grid: {
                            rows: gridRows,
                            fill: "row",
                        },
                    },
                    1200: {
                        slidesPerView: preview,
                        spaceBetween: spacingLg,
                        slidesPerGroup: perGroupLg,
                        grid: {
                            rows: gridRows,
                            fill: "row",
                        },
                    },
                },
            });
            $(".swiper-button")
                .on("mouseenter", function () {
                    var slideIndex = $(this).data("slide");
                    swiperT.slideTo(slideIndex, 500, false);

                    $(".tf-swiper .card_product--V01.style_2").removeClass("active");
                    $(".tf-swiper .card_product--V01.style_2").eq(slideIndex).addClass("active");
                })
                .on("mouseleave", function () {
                    $(".tf-swiper .card_product--V01.style_2").removeClass("active");
                })
                .on("click", function () {
                    var slideIndex = $(this).data("slide");
                    $(".tf-swiper .card_product--V01.style_2").eq(slideIndex).toggleClass("clicked");
                });
        });
    }

    var popupSearch = function () {
        $(document).ready(function () {
            var $adminBar = $('#wpadminbar');
            var $offcanvas = $('.offcanvas-search');

            if ($adminBar.length && $offcanvas.length) {
                function adjustOffcanvasMargin() {
                    var adminBarHeight = $adminBar.outerHeight();
                    $offcanvas.css('top', adminBarHeight + 'px');
                }

                adjustOffcanvasMargin();

                $(window).on('resize', adjustOffcanvasMargin);
            }
        });
    };

    const preloader = function () {
        setTimeout(function () {
            $(".preload").fadeOut("slow", function () {
                $(this).remove();
            });
        }, 100);
    };


    // Dom Ready
    $(function () {
        dropdownSelect();
        goTop();
        headerSticky();
        menu_mobile();
        popupSearch();
        styleSelect();
        swiper_slider();
        fix_search();
        vemusSwiper();
        openSearch();
        selectImages();
        infiniteSlide();
        handleFooter();
        preloader();
    });
})(jQuery);
