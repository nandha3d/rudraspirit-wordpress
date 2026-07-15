<?php
themesflat_remove_hook('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
add_filter('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart_relatedv2', 20, 3 );

function tfwc_add_to_cart_relatedv2( $html, $product, $args ) {
   
    if ($product->is_type( 'variable' )) {
        $args['attributes']['data-bs-toggle'] = 'modal';
		$args['attributes']['data-bs-target'] = '#quickshop';
    }

    echo sprintf(
        '<a href="%1s" data-quantity="%2s" class="tf_add_to_cart tf-btn animate-btn d-inline-flex bg-dark-2 w-max-content %3s"  %4s> 
            <span class="text-md fw-medium">%4s</span>
        </a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        esc_html( $product->add_to_cart_text() ),
    );
}

?>
<div class="tf-minicart-recommendations">
    <div class="tf-minicart-recommendations-heading d-flex justify-content-between align-items-end">
        <div class="tf-minicart-recommendations-title text-md fw-medium"><?php echo esc_html__('You may also like','vemus'); ?></div>
        <!-- <div class="d-flex gap-10">
            <div class="swiper-button-prev swipper-navigation-prev nav-swiper arrow-1 size-30 nav-prev-also-cls"></div>
            <div class="swiper-button-next swipper-navigation-next nav-swiper arrow-1 size-30 nav-next-also-cls"></div>
        </div> -->
        <div class="group-btn-slider">
            <div class="nav-prev-swiper tf-sw-nav swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-cd1f46b4888d252e" aria-disabled="true">
                <i class="icon-arrow-left"></i>
            </div>
            <div class="nav-next-swiper tf-sw-nav" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-cd1f46b4888d252e" aria-disabled="false">
                <i class="icon-arrow-right"></i>
            </div>
        </div>
    </div>
    <div dir="" class="swiper vemus-swiper wow"

        data-preview="1"

        data-space="10"
        
        data-pagination="1"

        data-speed="800"

        data-autoplay="true"

    >
        <div class="swiper-wrapper">
            <?php
            $limit = themesflat_get_opt('related_minicart_limit');
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $limit, 
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
            );
        
            $recent_products = new WP_Query( $args );
        
            if ( $recent_products->have_posts() ) {
                
                while ( $recent_products->have_posts() ) {
                    $recent_products->the_post();
                    global $product;
        
                    $product_url = get_permalink();
                    $product_id = get_the_ID(); 
                    $product_image = get_the_post_thumbnail_url( $product_id, 'full' );
                    if ( !$product_image ) {
                        $product_image = wc_placeholder_img_src();
                    }
                    $product_name = get_the_title();
                    $product_price = $product->get_price_html(); 
                    
                    $product_regular_price = $product->get_regular_price() ? wc_price( $product->get_regular_price() ) : '';
        
                    ?>
                    <div class="swiper-slide">
                        <div class="tf-mini-cart-item line radius-16">
                            <div class="tf-mini-cart-image">
                                <a href="<?php echo esc_url( $product_url ) ?>">
                                    <img class="ls-is-cached lazyloaded" src="<?php echo esc_url( $product_image ) ?>" alt="img-product">
                                </a>
                            </div>
                            <div class="tf-mini-cart-info justify-content-center">
                                <a class="title link text-md fw-medium" href="<?php echo esc_url( $product_url ) ?>"><?php echo esc_html( $product_name ) ?></a>
                                <p class="price-wrap text-sm fw-medium">
                                    <?php if ($product->is_on_sale() &&  $product->is_type('simple') ) : ?>
                                        <span class="new-price text-primary"><?php echo (wc_price($product->get_sale_price())); ?></span>
                                        <span class="old-price text-decoration-line-through text-dark-1"><?php echo (wc_price($product->get_regular_price())); ?></span>
                                    <?php else : ?>
                                       <?php echo wp_kses_post($product->get_price_html()); ?>
                                    <?php endif; ?>
                                    <?php //echo wp_kses_post($product_price); ?>
                                </p>            
                                 <?php woocommerce_template_loop_add_to_cart()  ?>
                            </div>
                        </div>
                    </div>                    
                    <?php                   
                }
                
        
                wp_reset_postdata();
            } else {
                echo 'No recent products found.';
            }
        
            ?>            
        </div>
    </div>
</div>

<?php
add_filter('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
themesflat_remove_hook('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart_relatedv2', 20, 3 );
?>