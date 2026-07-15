<?php
global $product;
    
$upsells = $product->get_upsell_ids();

$upsell_count = count( $upsells );
$upsell_count = 0;

$columns = themesflat_get_opt('upsell_product_columns');
$columns = is_string($columns) ? json_decode($columns, true) : $columns;
$columns = wp_parse_args($columns, [
    'desktop' => 4,
    'tablet'  => 3,
    'mobile'  => 2,
]);
$upsell_desk = $columns['desktop'];
$upsell_tab  = $columns['tablet'];
$upsell_mob  = $columns['mobile'];

if ( $upsells ) : ?>

<section class="flat-spacing-3 pt-0">
    <div class="container">
        <div class="sect-top wow fadeInUp">
            <h3 class="s-title"><?php echo esc_html(themesflat_get_opt('upsell_heading'));?></h4>
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
            data-preview="<?php echo esc_attr($upsell_desk); ?>"
            data-tablet="<?php echo esc_attr($upsell_tab); ?>"
            data-mobile="<?php echo esc_attr($upsell_mob); ?>"
            data-mobile-sm="<?php echo esc_attr($upsell_mob); ?>"
            data-space-lg="30"
            data-space-md="20"
            data-space="15"
            data-pagination="2"
            data-pagination-sm="2"
            data-pagination-md="3"
            data-pagination-lg="4"
        >
            <div class="swiper-wrapper">
                
        <?php foreach ( $upsells as $upsell ) : ?>
            <?php
                $upsell_product = wc_get_product( $upsell );

                if ( 'hidden' === $upsell_product->get_catalog_visibility() ) {
                    continue; 
                }    
                $upsell_count++;
                ?>
            <div class="swiper-slide">
                <?php

                $post_object = get_post( $upsell_product->get_id() );

                setup_postdata( $GLOBALS['post'] = $post_object ); 
                $product_style = themesflat_get_opt('upsell_product_style');
                $_POST['product_style'] = $product_style ;
                wc_get_template_part( 'content', 'product' );
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
                ?>
                </div>
                <?php endforeach;
                wp_reset_postdata();
                ?>
                
            </div>
            <div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
        </div>
        <div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
    </div>
</section>


<?php
endif;

wp_reset_postdata();
?>