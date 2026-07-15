<?php

if( !function_exists('get_recently_viewed_products') ){
    function get_recently_viewed_products() {
        if (isset($_COOKIE['recently_viewed_products'])) {
            $product_ids = explode(',', $_COOKIE['recently_viewed_products']);
            $product_ids = array_filter($product_ids); 
            $product_ids = array_map('intval', $product_ids); 

            if (!empty($product_ids)) {
                $args = array(
                    'post_type'      => 'product',
                    'post__in'       => $product_ids,
                    'orderby'        => 'post__in',
                    'posts_per_page' => count($product_ids),
                    'post_status'    => 'publish',
                );

                $query = new WP_Query($args);

                return $query;
            }
        }
        return false;
    }
}
$query = get_recently_viewed_products();

$columns = themesflat_get_opt('recently_wl_product_columns');
$columns = is_string($columns) ? json_decode($columns, true) : $columns;
$columns = wp_parse_args($columns, [
    'desktop' => 4,
    'tablet'  => 3,
    'mobile'  => 2,
]);
$recently_des = $columns['desktop'];
$recently_tab  = $columns['tablet'];
$recently_mob  = $columns['mobile'];

$recently_count = 0;

$recently_wl_display = themesflat_get_opt('recently_wl_display');
$recently_wl_style = themesflat_get_opt('recently_wl_style');

if ($query && $recently_wl_display == 1) {
?>

<section class="flat-spacing pb-0">
    <div class="">
        <div class="flat-title wow fadeInUp">
            <h4 class="title"><?php echo esc_html(themesflat_get_opt('recently_wl_heading'));?></h4>
        </div>
        <div class="fl-control-sw2 wrap-pos-nav sw-over-product wow fadeInUp">
            <div dir="" class="swiper tf-swiper tfwc-slider wrap-sw-over" data-swiper='{
                "slidesPerView": <?php echo esc_attr($recently_mob);?>,
                "spaceBetween": 12,
                "speed": 800,
                "observer": true,
                "observeParents": true,
                "slidesPerGroup": 2,
                "navigation": {
                    "clickable": true,
                    "nextEl": ".nav-next-recently",
                    "prevEl": ".nav-prev-recently"
                },
                "pagination": { "el": ".sw-pagination-recently", "clickable": true },
                "breakpoints": {
                "768": { "slidesPerView": <?php echo esc_attr($recently_tab);?>, "spaceBetween": 12, "slidesPerGroup": 3 },
                "1200": { "slidesPerView": <?php echo esc_attr($recently_des);?>, "spaceBetween": 24, "slidesPerGroup": 4}
                }
            }'>
                <div class="swiper-wrapper">
                    
                    <?php
                    $limit = themesflat_get_opt('recently_wl_limit');
                    $count = 0;
                    while ( $query->have_posts() && $count < $limit  )  : $query->the_post(); 
                    $count++;
                    $recently_count = $query->found_posts;
                    global $product;
                    $product_style = $recently_wl_style;
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
                   
                    if ( 'hidden' === $product->get_catalog_visibility() ) {
                        continue; 
                    }
                    
                    ?>
                    
                    <div class="swiper-slide">
                        <?php
                        wc_get_template_part( 'content', 'product' );
                        ?>
                    </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    
                    ?>
                </div>
            </div>
            <div class="d-flex d-xl-none sw-dot-default sw-pagination-recently justify-content-center"></div>
            
            <?php if ($recently_count > $recently_des) { ?>
                <div class="d-none d-xl-flex swiper-button-next nav-swiper nav-next-recently"></div>
                <div class="d-none d-xl-flex swiper-button-prev nav-swiper nav-prev-recently"></div>
            <?php } ?>
        </div>
    </div>
</section>
<?php }?>