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

$columns = themesflat_get_opt('recently_product_columns');
$columns = is_string($columns) ? json_decode($columns, true) : $columns;
$columns = wp_parse_args($columns, [
    'desktop' => 4,
    'tablet'  => 3,
    'mobile'  => 2,
]);
$recently_desk = $columns['desktop'];
$recently_tab  = $columns['tablet'];
$recently_mob  = $columns['mobile'];
if ($query) {
?>

<section class="flat-spacing-3 pt-0 tf-recently-viewed-product">
    <div class="container">
        <div class="sect-top wow fadeInUp">
            <h3 class="s-title"><?php echo esc_html(themesflat_get_opt('recently_heading'));?></h3>
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
            data-preview="<?php echo esc_attr($recently_desk); ?>"
            data-tablet="<?php echo esc_attr($recently_tab); ?>"
            data-mobile="<?php echo esc_attr($recently_mob); ?>"
            data-mobile-sm="<?php echo esc_attr($recently_mob); ?>"
            data-space-lg="30"
            data-space-md="20"
            data-space="15"
            data-pagination="2"
            data-pagination-sm="2"
            data-pagination-md="3"
            data-pagination-lg="4"
        >
            <div class="swiper-wrapper">
                
                <?php
                $limit = themesflat_get_opt('recently_limit');
                $recently_count = $limit;
                $count = 0;
                while ( $query->have_posts() && $count < $limit  )  : $query->the_post(); 
                $count++;
                $recently_count = $query->found_posts;
                global $product;
                if ( 'hidden' === $product->get_catalog_visibility() ) {
                    continue; 
                }
                
                ?>
                
                <div class="swiper-slide">
                    <?php
                    $product_style = themesflat_get_opt('recently_product_style');
                    $product_style = 'style-1';
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
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
        </div>
        <div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
    </div>
</section>
<?php }?>