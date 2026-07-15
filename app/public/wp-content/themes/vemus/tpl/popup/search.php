<!-- search -->
<div class="offcanvas offcanvas-top offcanvas-search <?php if ( is_user_logged_in() && is_admin_bar_showing() ) { echo 'is-admin';} ?>" id="tfsearch">
    <div class="offcanvas-content">
    <span class="icon-close link icon-close-popup tf-close-canvas" data-bs-dismiss="offcanvas"></span>
        <div class="popup-content">
            <form class="form-search">
                <fieldset class="text">
                    <input type="text" class="ajax-search-input" placeholder="<?php echo esc_attr("ENTER YOUR SEARCH", "vemus"); ?>" class="" name="text" tabindex="0" value="" aria-required="true" required="">
                    <div class="search-results"></div>
                </fieldset>
                <button class="" type="submit">
                    <i class="icon icon-search"></i>
                </button>
                <span class="icon-close icon-close-popup clear-search-text" style="<?php echo esc_attr('display:none;'); ?>" title="<?php echo esc_attr("Clear", "vemus"); ?>" aria-label="<?php echo esc_attr("Clear", "vemus"); ?>"></span>
            </form>

            <div class="sm-col-2 tf-search-container">
                <!-- menu -->
                <div class="feature-wrap quick-link-content">
                    <p class="title"><?php echo esc_html( themesflat_get_opt('header_search_box_menu')); ?></p>
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'search-menu',
                            'fallback_cb'    => 'themesflat_menu_fallback',
                            'container'      => false,
                            'menu_class'     => 'quick-link-list', 
                        ) );
                    ?>
                </div>

                <div class="feature-wrap results-product">
                    <div class="d-flex flex-wrap justify-content-between">
                        <p class="title"><?php _e("PRODUCTS", "vemus"); ?></p>
                        <div class="tfwc-view-all"></div>
                    </div>
                    <div dir="ltr" class="swiper tf-swiper vemus-swiper wow fadeInUp"
                        data-preview="4"
                        data-tablet="3"
                        data-mobile="2"
                        data-mobile-sm="2"
                        data-space-lg="30"
                        data-space-md="20"
                        data-space="15"
                        data-pagination="2"
                        data-pagination-sm="2"
                        data-pagination-md="3"
                        data-pagination-lg="4"
                    >
                        <div class="swiper-wrapper">
                            <!-- Results will be appended here via AJAX -->
                        </div>
                    </div>
                </div>

                <!-- <div class="feature-wrap results-collection">
                    <p class="title"><?php _e("COLLECTIONS", "vemus"); ?></p>
                    <div class="results-content">
                    </div>
                </div> -->

                <!-- product -->
                <div class="feature-wrap results-suggestion">
                    <p class="title"><?php echo esc_html( themesflat_get_opt('header_search_box_product')); ?></p>
                    <div class="results-content">
                        <ul class="product-list">
                            <?php
                            $args = array(
                                'limit' => 2, 
                                'status' => 'publish',
                            );

                            if( function_exists( 'wc_get_products' ) ){
                                $products = wc_get_products( $args );
                            }

                            if ( ! empty( $products ) ) :
                                foreach ( $products as $product ) : ?>
                                    <li>
                                        <div class="tf-product-mini-view">
                                            <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" class="prd-image">
                                                <?php echo wp_kses_post($product->get_image()); ?>
                                            </a>
                                            <div class="prd-content">
                                                <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" class="prd-name link text-uppercase">
                                                    <?php echo esc_html( $product->get_name() ); ?>
                                                </a>
                                                <div class="price-wrap">
                                                    <?php echo wp_kses_post($product->get_price_html()); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="feature-wrap results-collection">
                    <p class="title"><?php _e("COLLECTIONS", "vemus"); ?></p>
                    <div class="results-content">
                    </div>
                </div>

            </div>

        </div>

        
    </div>
    <span class="close" data-bs-dismiss="offcanvas"></span>
</div>
<!-- /search -->
