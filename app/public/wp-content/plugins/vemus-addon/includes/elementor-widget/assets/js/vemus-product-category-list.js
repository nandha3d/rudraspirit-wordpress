(function ($) {
    "use strict";

    var initProductCategoryList = function ($scope) {
        var $scope = $scope;
        // swatchColor($scope);
        hoverImgCursor($scope);
    };

    var hoverImgCursor = function (container) {
        let offsetX = 20;
        let offsetY = 20;
        $(".hover-cursor-img", container).on("mousemove", function (e) {
            let hoverImage = $(this).find(".hover-image");
            hoverImage.css({
                top: e.clientY + offsetY + "px",
                left: e.clientX + offsetX + "px",
            });
        });

        $(".hover-cursor-img", container).on("mouseenter", function () {
            let hoverImage = $(this).find(".hover-image");
            hoverImage.css({
                transform: "scale(1)",
                opacity: 1,
            });
        });

        $(".hover-cursor-img", container).on("mouseleave", function () {
            let hoverImage = $(this).find(".hover-image");
            hoverImage.css({
                transform: "scale(0)",
                opacity: 0,
            });
        });
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/vemus_product_category_list.default', initProductCategoryList);
    });

})(jQuery);