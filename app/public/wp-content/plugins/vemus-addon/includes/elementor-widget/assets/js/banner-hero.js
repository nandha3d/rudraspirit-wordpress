;(function($) {

    "use strict";

    var bannerHero = function() {
        if (typeof gsap !== "undefined" && $(".hover-repel").length) {
            $(document).on("mousemove", function (e) {
                $(".hover-repel").each(function () {
                    const $this = $(this);
                    const offset = $this.offset();
                    const width = $this.outerWidth();
                    const height = $this.outerHeight();

                    const centerX = offset.left + width / 2;
                    const centerY = offset.top + height / 2;

                    const deltaX = centerX - e.pageX;
                    const deltaY = centerY - e.pageY;

                    const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);

                    const radius = 300;
                    const maxPush = 50;

                    if (distance < radius) {
                        const force = (1 - distance / radius) * maxPush;

                        const angle = Math.atan2(deltaY, deltaX);
                        const moveX = Math.cos(angle) * force;
                        const moveY = Math.sin(angle) * force;

                        gsap.to(this, {
                            x: moveX,
                            y: moveY,
                            duration: 0.3,
                            ease: "power2.out",
                        });
                    } else {
                        gsap.to(this, {
                            x: 0,
                            y: 0,
                            duration: 0.5,
                            ease: "power2.out",
                        });
                    }
                });
            });
        }
    }

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/vemus_banner_hero.default', bannerHero );
    });

})(jQuery);