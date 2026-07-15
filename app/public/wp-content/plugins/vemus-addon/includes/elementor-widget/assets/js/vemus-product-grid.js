(function ($) {
    "use strict";

    var initProductGrid = function ($scope) {
        var $scope = $scope;
        // swatchColor($scope);
        tabSlide($scope);
        swiper($scope);
        fetchTabContent($scope);
        countDown($scope);
    };

    var swiper = function (container) {
        $(".vemus-product-swiper", container).each(function (index, element) {
            var $this = $(element);
            var $parent = $this.closest('.has-arrow-control');
            var $imageWrapper = $('.product-img, .img-style', $parent).first();
            var preview = $this.data("preview") || 1;
            var tablet = $this.data("tablet") || 1;
            var mobile = $this.data("mobile") || 1;
            var mobileSm = $this.data("mobile-sm") !== undefined ? $this.data("mobile-sm") : mobile;
            var config = $(this).closest('.tab-pane').data("carousel-configs") || $this.data("swiper-configs") || {};

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

            // var swiperT = new Swiper($this[0], {
            //     direction: direction,
            //     speed: speed,
            //     slidesPerView: mobile,
            //     spaceBetween: spacing,
            //     slidesPerGroup: perGroup,
            //     grabCursor: cursorType,
            //     loop: loop,
            //     effect: effect,
            //     autoplay: atPlay
            //         ? {
            //             delay: delay,
            //             disableOnInteraction: false,
            //             pauseOnMouseEnter: true,
            //         }
            //         : false,
            //     grid: {
            //         rows: gridRows,
            //         fill: "row",
            //     },
            //     pagination: {
            //         el: [$this.find(".tf-sw-pagination")[0], $this.closest(".tf-pag-swiper").find(".tf-sw-pagination")[0]],
            //         clickable: true,
            //     },
            //     observer: true,
            //     observeParents: true,
            //     navigation: {
            //         nextEl: [
            //             $this.closest(".tf-btn-swiper-item").find(".nav-next-swiper")[0],
            //             $this.closest(".container").find(".group-btn-slider .nav-next-swiper")[0],
            //         ],
            //         prevEl: [
            //             $this.closest(".tf-btn-swiper-item").find(".nav-prev-swiper")[0],
            //             $this.closest(".container").find(".group-btn-slider .nav-prev-swiper")[0],
            //         ],
            //     },
            //     breakpoints: {
            //         575: {
            //             slidesPerView: mobileSm,
            //             spaceBetween: spacing,
            //             slidesPerGroup: perGroupSm,
            //             grid: {
            //                 rows: gridRows,
            //                 fill: "row",
            //             },
            //         },
            //         768: {
            //             slidesPerView: tablet,
            //             spaceBetween: spacingMd,
            //             slidesPerGroup: perGroupMd,
            //             grid: {
            //                 rows: gridRows,
            //                 fill: "row",
            //             },
            //         },
            //         1200: {
            //             slidesPerView: preview,
            //             spaceBetween: spacingLg,
            //             slidesPerGroup: perGroupLg,
            //             grid: {
            //                 rows: gridRows,
            //                 fill: "row",
            //             },
            //         },
            //     },
            // });

            config.on = {
                breakpoint: function (swiper) {

                    if (config?.breakpoints[swiper.currentBreakpoint]?.navigation_responsive && config?.breakpoints[swiper.currentBreakpoint]?.navigation_responsive != 'false') {
                        $(".vemus-swiper-button-prev", $parent).removeClass('hidden');
                        $(".vemus-swiper-button-next", $parent).removeClass('hidden');
                    } else {
                        $(".vemus-swiper-button-prev", $parent).addClass('hidden');
                        $(".vemus-swiper-button-next", $parent).addClass('hidden');
                    }

                    if (config?.breakpoints[swiper.currentBreakpoint]?.pagination_responsive && config?.breakpoints[swiper.currentBreakpoint]?.pagination_responsive != 'false') {
                        $(".vemus-swiper-pagination", $parent).removeClass('hidden');
                        $(".vemus-swiper-scrollbar", $parent).removeClass('hidden');
                    } else {
                        $(".vemus-swiper-pagination", $parent).addClass('hidden');
                        $(".vemus-swiper-scrollbar", $parent).addClass('hidden');
                    }
                },
                resize: function () {
                    if ($parent.hasClass('arrow-center-on-image') && $imageWrapper.length > 0) {
                        let imageHeight = $imageWrapper.outerHeight() || 0,
                            top = (imageHeight / 2);
                        $parent.css({
                            '--tf-card-arrow-top': `${top}px`
                        });
                    }
                }
            }

            config.navigation = {
                nextEl: $parent.find(config?.navigation?.nextEl).get(0),
                prevEl: $parent.find(config?.navigation?.prevEl).get(0)
            };

            config.pagination.el = $parent.find(config?.pagination?.el).get(0);

            var swiperT = new Swiper($this[0], config);

            if ($parent.hasClass('arrow-center-on-image') && $imageWrapper.length > 0) {
                let imageHeight = $imageWrapper.outerHeight() || 0,
                    top = (imageHeight / 2);
                $parent.css({
                    '--tf-card-arrow-top': `${top}px`
                });
            }
        });
    };

    var tabSlide = function (container) {
        $(".tab-slide", container).each(function () {

            $(".nav-tab-item", $(this)).first().addClass('active');

            function updateTabSlide() {
                var $activeTab = $(".nav-tab-item.active", container);
                $activeTab.click();
            }

            $(".nav-tab-item", $(this)).click(function (e) {
                e.preventDefault();
                var itemTab = $(this).parent().find("li");

                $(itemTab).removeClass("active");
                $(this).addClass("active");
                var $width = $(this).width();
                var $left = $(this).position().left;
                var sideEffect = $(this).parent().find(".item-slide-effect").removeClass('hidden');

                $(sideEffect).css({
                    width: $width,
                    transform: "translateX(" + $left + "px)",
                });
            });

            $(window).on("resize", function () {
                updateTabSlide();
            });

            updateTabSlide();
        });
    };

    var fetchTabContent = function (container) {

        var isLoading = false;

        $(".nav-tab-item", container).click(function (e) {
            // if(isLoading){return;}
            e.preventDefault();
            var tabPanes = $(".tab-pane", container);
            var targetTab = $(`.${$(this).data("target-tab")}`, container);
            var tfOverlay = $(".tf-overlay-container", container);

            if (targetTab.hasClass("loaded")) {
                tabPanes.removeClass("active show");
                targetTab.addClass("active show");
            } else {
                $.ajax({
                    url: tfwc_settings.admin_ajax_url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'vemus_get_tab_contents',
                        security: tfwc_settings.get_tabs_nonce,
                        args: {
                            num_product: targetTab.data('num-product'),
                            product_type: targetTab.data('product-type'),
                            categories: targetTab.data('categories'),
                            brands: targetTab.data('brands'),
                            tags: targetTab.data('tags'),
                            product_ids: targetTab.data('product-ids'),
                            order_by: targetTab.data('product-order-by'),
                            order: targetTab.data('product-order'),
                            product_style: targetTab.data('product-style'),
                            product_grid_classes: targetTab.data('product-grid-classes'),
                            card_params: targetTab.data('card-params'),
                            carousel_configs: targetTab.data('carousel-configs'),
                        }
                    },
                    beforeSend: function () {
                        isLoading = true;
                        tfOverlay.removeClass('hidden');
                    },
                    success: function (data) {
                        if (data.success) {
                            targetTab.addClass("loaded");
                            targetTab.removeData();
                            targetTab.html(data?.data?.content);
                            countDown(targetTab);
                            swiper(targetTab);
                            targetTab.attr('data-carousel-configs', '');
                            targetTab.attr('data-card-params', '');
                        }
                    },
                    error: function (err) {
                        // console.log(err);
                    },
                    complete: function () {
                        isLoading = false;
                        tfOverlay.addClass('hidden');
                        tabPanes.removeClass("active show");
                        targetTab.addClass("active show");
                    }
                });
            }
        });

    }

    var countDown = function (container) {
        window.initializeCountDowns($(container).get(0));
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/vemus_product_grid.default', initProductGrid);
        elementorFrontend.hooks.addAction('frontend/element_ready/vemus_product_tabs_carousel.default', initProductGrid);
        elementorFrontend.hooks.addAction('frontend/element_ready/vemus_product_category_grid.default', initProductGrid);
    });

})(jQuery);