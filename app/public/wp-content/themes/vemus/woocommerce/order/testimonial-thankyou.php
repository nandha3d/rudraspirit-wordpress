<?php if(themesflat_get_opt('checkout_testi') == 1) {?>

<div class="tes-slider-2 bg-linear-golden-cream">
    <div dir="ltr" class="swiper tf-swiper vemus-swiper">
        <div class="swiper-wrapper">
            <?php
                $testimonials = themesflat_get_opt('testimonial_checkout');
                $testimonials = json_decode($testimonials, true);

                if (!empty($testimonials)) {
                    foreach ($testimonials as $testimonial) {
                        ?>
                        <div class="swiper-slide">
                            <div class="box_testimonial--V05">
                                <span class="icon">
                                    <?php echo wp_kses_post($testimonial['quote']); ?>
                                </span>
                                <h5 class="tes-title">
                                    <?php echo esc_html($testimonial['title']); ?>
                                </h5>
                                <h6 class="tes-text">
                                    <?php echo esc_html($testimonial['review']); ?>
                                </h6>
                                <p class="tes-author">
                                    <?php echo esc_html($testimonial['name']); ?>
                                </p>
                            </div>
                        </div>

                    <?php } ?>
                <?php } ?>
        </div>
        <div class="sw-dot-default tf-sw-pagination type-space-3"></div>
    </div>
</div>

<?php
} ?>