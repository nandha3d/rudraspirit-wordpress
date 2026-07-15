;(function($) {

    "use strict";

var animationImage = function () {
    function setupDodger() {
        const $playArea = $(".play-area-2");
        const $dodger = $(".dodger-2");

        if (!$playArea.length || !$dodger.length) return;

        const dodgerW = $dodger.outerWidth();
        const dodgerH = $dodger.outerHeight();
        const areaW = $playArea.width();
        const areaH = $playArea.height();

        const offsetX = dodgerW / 2; 
        const offsetY = dodgerH / 2;

        if (window.innerWidth >= 1440) {
            $dodger.css({
                position: "absolute",
                top: areaH - dodgerH,
                left: areaW - dodgerW,
            });

            $playArea.off("mousemove.dodger").on("mousemove.dodger", function (e) {
                const offset = $playArea.offset();
                let mouseX = e.pageX - offset.left - offsetX;
                let mouseY = e.pageY - offset.top - offsetY;

                mouseX = Math.max(0, Math.min(mouseX, areaW - dodgerW));
                mouseY = Math.max(0, Math.min(mouseY, areaH - dodgerH));

                gsap.to($dodger, {
                    left: mouseX,
                    top: mouseY,
                    duration: 0.6,
                    ease: "power2.out",
                });
            });

            $playArea.off("mouseleave.dodger").on("mouseleave.dodger", function () {
                gsap.to($dodger, {
                    left: areaW - dodgerW,
                    top: areaH - dodgerH,
                    duration: 0.6,
                    ease: "power2.out",
                });
            });

            $dodger.off("mousedown");
            $(document).off("mousemove.drag mouseup.drag");
        } else {
            $playArea.off("mousemove.dodger mouseleave.dodger");
            $dodger.css({
                top: "",
                left: "",
                bottom: "",
                right: "",
                position: "",
                cursor: "",
            });
        }
    }

    $(document).ready(setupDodger);
    $(window).on("resize", setupDodger);
};


    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/vemus_image_animation.default', animationImage );
    });

})(jQuery);