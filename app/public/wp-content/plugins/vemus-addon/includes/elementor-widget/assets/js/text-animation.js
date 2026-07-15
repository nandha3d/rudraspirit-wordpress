;(function($) {

    "use strict";

    var animationText = function() {

        if ($(".text-color-change").length) {
            let animatedTextElements = document.querySelectorAll(".text-color-change");

            animatedTextElements.forEach((element) => {
                let startColor = element.getAttribute("data-color-start") || "#A9A9A9";
                let endColor = element.getAttribute("data-color-end") || "#1F1F1F";

                if (element.wordSplit) {
                    element.wordSplit.revert();
                }
                if (element.charSplit) {
                    element.charSplit.revert();
                }

                element.wordSplit = new SplitText(element, {
                    type: "words",
                    wordsClass: "word-wrapper",
                });

                element.charSplit = new SplitText(element.wordSplit.words, {
                    type: "chars",
                    charsClass: "char-wrapper",
                });

                gsap.set(element.charSplit.chars, {
                    color: startColor,
                    opacity: 1,
                });

                element.animation = gsap.to(element.charSplit.chars, {
                    scrollTrigger: {
                        trigger: element,
                        start: "top 90%",
                        end: "bottom 35%",
                        toggleActions: "play none none reverse",
                        scrub: true,
                    },
                    color: endColor,
                    stagger: {
                        each: 0.05,
                        from: "start",
                    },
                    duration: 0.5,
                    ease: "power2.out",
                });
            });
        }

        if ($(".text-color-change-2").length) {
            let animatedTextElements = document.querySelectorAll(".text-color-change-2");

            animatedTextElements.forEach((element) => {
                let startColor = element.getAttribute("data-color-start") || "#A9A9A9";
                let endColor = element.getAttribute("data-color-end") || "#1F1F1F";
                if (element.wordSplit) {
                    element.wordSplit.revert();
                }
                if (element.charSplit) {
                    element.charSplit.revert();
                }

                element.wordSplit = new SplitText(element, {
                    type: "words",
                    wordsClass: "word-wrapper",
                });

                element.charSplit = new SplitText(element.wordSplit.words, {
                    type: "chars",
                    charsClass: "char-wrapper",
                });

                gsap.set(element.charSplit.chars, {
                    color: startColor,
                    opacity: 1,
                });

                element.animation = gsap.to(element.charSplit.chars, {
                    scrollTrigger: {
                        trigger: element,
                        start: "top 90%",
                        end: "bottom 35%",
                        toggleActions: "play none none reverse",
                        scrub: true,
                    },
                    color: endColor,
                    stagger: {
                        each: 0.05,
                        from: "start",
                    },
                    duration: 0.5,
                    ease: "power2.out",
                });
            });
        }
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
        elementorFrontend.hooks.addAction( 'frontend/element_ready/vemus_text_scroll_animation.default', animationText );
    });

})(jQuery);