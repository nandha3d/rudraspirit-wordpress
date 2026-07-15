<?php

    global $product;

    $related_products = wc_get_related_products( $product->get_id(), themesflat_get_opt('related_limit'));
    
    $related_count = count( $related_products );

    $columns = themesflat_get_opt('related_product_columns');
    $columns = is_string($columns) ? json_decode($columns, true) : $columns;
    $columns = wp_parse_args($columns, [
        'desktop' => 4,
        'tablet'  => 3,
        'mobile'  => 2,
    ]);
    $related_desk = $columns['desktop'];
    $related_tab  = $columns['tablet'];
    $related_mob  = $columns['mobile'];
?>

<?php if ($related_products) { ?>
<section class="flat-spacing-3 pt-0">
    <div class="container">
        <div class="sect-top wow fadeInUp">
            <h3 class="s-title"><?php echo esc_html(themesflat_get_opt('related_heading'));?></h3>
            <div class="group-btn-slider">
                <div class="nav-prev-swiper tf-sw-nav">
                    <i class="icon-arrow-left"></i>
                </div>
                <div class="nav-next-swiper tf-sw-nav">
                    <i class="icon-arrow-right"></i>
                </div>
            </div>
        </div>
        
        <div dir="ltr" class="swiper tf-swiper vemus-swiper wow fadeInUp"
            data-preview="<?php echo esc_attr($related_desk); ?>"
            data-tablet="<?php echo esc_attr($related_tab); ?>"
            data-mobile="<?php echo esc_attr($related_mob); ?>"
            data-mobile-sm="<?php echo esc_attr($related_mob); ?>"
            data-space-lg="30"
            data-space-md="20"
            data-space="15"
            data-pagination="2"
            data-pagination-sm="2"
            data-pagination-md="3"
            data-pagination-lg="4"
        >
            <div class="swiper-wrapper">
                
                <?php foreach ( $related_products as $related_product ) : ?>
                    <?php
                    $related_product = wc_get_product( $related_product );

                    if ( 'hidden' === $related_product->get_catalog_visibility() ) {
                        continue; 
                    }    
                    ?>
                    <div class="swiper-slide">
                    <?php
                    
                    $post_object = get_post( $related_product->get_id() );

                    setup_postdata( $GLOBALS['post'] = $post_object );

                    $product_style = themesflat_get_opt('related_product_style');
                    $_POST['product_style'] = $product_style ;
                    switch ($product_style) {
                        case 'style-1':
                            tfwc_get_template_part( '/product-style-remove/style-1.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-2.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-3.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-4.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-list.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-wishlist.php' );                           

                            tfwc_get_template_part( '/product-style/style-1.php' );                           
                            
                            break;                    
                        case 'style-2':
                            tfwc_get_template_part( '/product-style-remove/style-1.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-2.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-3.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-4.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-list.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-wishlist.php' );       
                            tfwc_get_template_part( '/product-style/style-2.php' );
                            
                            break;                    
                        case 'style-3':
                            tfwc_get_template_part( '/product-style-remove/style-1.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-2.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-3.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-4.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-list.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-wishlist.php' );       
                            tfwc_get_template_part( '/product-style/style-3.php' );
                            
                            break;
                        case 'style-4':
                            tfwc_get_template_part( '/product-style-remove/style-1.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-2.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-3.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-4.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-list.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-wishlist.php' );  

                            tfwc_get_template_part( '/product-style/style-4.php' );                            
                            
                            break;                    
                        default:
                            tfwc_get_template_part( '/product-style-remove/style-1.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-2.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-3.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-4.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-list.php' );                           
                            tfwc_get_template_part( '/product-style-remove/style-wishlist.php' );    
                                
                            tfwc_get_template_part( '/product-style/style-1.php' );
                            
                            break;
                    }
                    wc_get_template_part( 'content', 'product' );
                    ?>
                    </div>
                <?php endforeach;
                wp_reset_postdata();
                ?>
                
                
            </div>
            <div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
        </div>
    </div>
</section>
<?php } ?>