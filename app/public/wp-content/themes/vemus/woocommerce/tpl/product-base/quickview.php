<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tfwc_quickview_button() {
    global $product;
    $product_id = $product->get_id(); 
    
    $product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');

    if (isset($_POST['product_style'])) {
        $product_style = sanitize_text_field($_POST['product_style']);
    }
   

    $class = '';
    if($product_style == 'style-2' || $product_style == 'style-3' || $product_style == 'style-list' || $product_style == 'style-wishlist style-3') {
        $class = ' tooltip-top ';
    } else {
        $class = ' tooltip-left ';
    }

    if($product_style == 'style-4' || $product_style == 'style-5'){
        $class .= ' bg-surface';
    }

    if($product_style == 'style-list') {
        echo
        '<a href="#quickView" data-bs-toggle="modal" class="hover-tooltip '.$class.' box-icon quickview tf_quickview_btn" data-product_id="'.$product_id.'">
            <span class="icon icon-view"></span>
            <span class="tooltip">'. esc_html__('Quick View','vemus') .'</span>
        </a>'  ;
    } else {
        echo
        '<li>
            <a href="#quickView" data-bs-toggle="modal" class="hover-tooltip '.$class.' box-icon quickview tf_quickview_btn" data-product_id="'.$product_id.'">
                <span class="icon icon-view"></span>
                <span class="tooltip">'. esc_html__('Quick View','vemus') .'</span>
            </a>
        </li>'  ;
    }
    
}

function tfwc_quickview_modal() {
    $output = '';
    ob_start();
    ?>
    <div class="modal fade modalCentered modal-quick-view" id="quickView">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">                
            </div>
        </div>
    </div>
    <?php 
     $output .= ob_get_clean();
     echo empty($output) ? '' : $output;
}

add_action( 'wp_footer', 'tfwc_quickview_modal' );

function tfwc_quickview_modal_content() {
    $output = '';
    add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ Woo_Single_Product_Hook::instance(), 'tf_variation_swatches_dropdown_html' ], 120,2);
    if(themesflat_get_opt('tf_out_of_stock_notification')){
        add_filter( 'woocommerce_out_of_stock_message', '__return_empty_string' );
    }
    // add_action( 'woocommerce_single_product_summary', [ Woo_Single_Product_Hook::instance(), 'woocommerce_template_out_of_stock_notification' ], 13 );
    add_filter( 'woocommerce_product_single_add_to_cart_text', [  Woo_Single_Product_Hook::instance(), 'add_to_cart_button_text'], 10, 2 );
    add_filter('woocommerce_available_variation', [ Woo_Single_Product_Hook::instance(), 'single_add_to_cart_text_variations'], 10, 3);

    themesflat_remove_hook( 'wcboost_wishlist_loop_add_to_wishlist_link', 'tfwc_wishlish_button' , 20, 2 );
    themesflat_remove_hook( 'wcboost_products_compare_loop_add_to_compare_link', 'tfwc_compare_button' , 20, 2 );
    
    add_action( 'woocommerce_before_add_to_cart_button', [ Woo_Single_Product_Hook::instance(), 'woocommerce_template_add_to_cart_quantity']);
    add_action( 'woocommerce_after_add_to_cart_button', [ Woo_Single_Product_Hook::instance(), 'woocommerce_template_extra_wcboost_button' ], 11);

    add_action('woocommerce_grouped_product_list_before', function(){
        themesflat_remove_hook('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
        themesflat_remove_hook( 'woocommerce_product_add_to_cart_text', 'tfwc_product_add_to_cart_text', 10, 2 );
        add_filter('woocommerce_loop_add_to_cart_link', [ Woo_Single_Product_Hook::instance(), 'quick_add_button'] , 21, 3 );
    } );

    add_action( 'woocommerce_end_add_to_cart_form', [ Woo_Single_Product_Hook::instance(), 'woocommerce_template_extra_button' ]);
    add_action( 'woocommerce_end_single_variation', [ Woo_Single_Product_Hook::instance(), 'woocommerce_template_extra_button' ]);
    Woo_Single_Product_Hook::instance()->size_guide_position();
    ob_start();
    global $product;

    ?>
        <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
        <div class="tf-product-media-wrap" style="<?php echo esc_attr('height:756px'); ?>">
            <?php tfwc_quickview_thumnail(); ?>
        </div>
        <div class="tf-product-info-wrap">
            <div class="tf-product-info-inner">
                <div class="tf-product-info-heading">
                    <?php 
                        tfwc_quickview_title();
                        tfwc_quickview_price();
                        tfwc_quickview_short_code();
                    ?>
                </div>
                <?php woocommerce_template_single_add_to_cart();?>
                <?php
                if( !$product->is_in_stock() ){
                    Woo_Single_Product_Hook::instance()->woocommerce_template_out_of_stock_notification();
                }
                ?>
                <a href="<?php echo esc_url( get_permalink());?>" class="tf-btn-line">
                    <span class="text-body"><?php echo esc_html__('View full details','vemus')?></span>
                    <i class="icon icon-arrow-top-right"></i>
                </a>
            </div>
        </div>
    <?php 
     $output .= ob_get_clean();
     echo empty($output) ? '' : $output;
}

function tfwc_quickview_thumnail() {
    global $product; 
    $attachment_ids = $product->get_gallery_image_ids();
    if (!empty($attachment_ids)) {
        ?>
        <div dir="" class="swiper tf-single-slide" style="<?php echo esc_attr('height:756px' ); ?>">
            <div class="swiper-wrapper">
            <?php
            foreach ($attachment_ids as $attachment_id) {
                $image_url = wp_get_attachment_url($attachment_id, 'themesflat-product'); 
                ?>
                <div class="swiper-slide" >
                    <div class="item">
                        <img class="lazyload" data-src="<?php echo esc_url($image_url) ;?>" alt="image">
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
            <!-- <div class="swiper-button-prev nav-swiper arrow-1 nav-prev-cls single-slide-prev"></div>
            <div class="swiper-button-next nav-swiper arrow-1 nav-next-cls single-slide-next"></div> -->
            <div class="nav-swiper-group style-3">
                <div class=" nav-thumbs thumbs-prev single-slide-prev">
                    <span class="fw-normal"><?php _e('PRE', 'vemus' ); ?></span>
                </div>
                <span class="text-main">/</span>
                <div class=" nav-thumbs thumbs-next single-slide-next">
                    <span class="fw-normal"><?php _e('NEXT', 'vemus' ); ?></span>
                </div>
            </div>
        </div>
    <?php
    } else{
		echo '<div class="item">
                    <img class="lazyload" data-src="'. esc_url(wp_get_attachment_image_url($product->get_image_id(), 'themesflat-product')) .'" alt="image">
             </div>';
	}
}

function tfwc_quickview_title() {
    the_title( ' <h6 class="product-info-name h4 fw-normal text-uppercase link"><a href="' . esc_url( get_permalink() ) .'">', '</a></h6>' );
}

function tfwc_quickview_price_old() {
    global $product;
    ?> 
    <div class="product-info-price price-wrap">
        <?php if ($product->is_on_sale()) : ?>
            <h6 class="price-new price-on-sale h4"><?php echo (wc_price($product->get_price())); ?></h6>
            <h6 class="price-old"><?php echo (wc_price($product->get_regular_price())); ?></h6>
        <?php else : ?>
            <h6 class="price-old compare-at-price fw-normal h6"><?php echo (wc_price($product->get_price())); ?></h6>
        <?php endif; ?>
    </div>
    <?php
}

function tfwc_quickview_price() {
    global $product;
    ?> 
    <div class="product-info-price tf-price">
        <div class="price-wrap">
            <?php echo wp_kses_post($product->get_price_html()); ?>
            <?php if ($product->is_on_sale()) : ?>
                <?php
                    $regular_price = (float) $product->get_regular_price();
                    $sale_price = (float) $product->get_sale_price();

                    if ($regular_price > 0 && $sale_price > 0) {
                        $discount = round((($regular_price - $sale_price) / $regular_price) * 100);
                        $discount_text = $discount . '% Off';
                    } else {
                        $discount = 0;
                        $discount_text = esc_html__('Sale!', 'vemus');
                    }
                ?>
                <p class="badges-on-sale">
                    <i class="icon-tag"></i>
                    <span class="number-sale" data-person-sale="<?php echo esc_attr($discount); ?>">
                        <?php echo esc_html($discount_text); ?>
                    </span>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

function tfwc_quickview_short_code() {
    global $product;
    $content = $product->get_short_description();
    if( empty( $content ) ) {
        return;
    }
    echo sprintf('<p class="product-infor-sub text-main-4">%s</p>', wp_kses_post( do_shortcode($content) ));

}


add_action('wp_ajax_load_quickview_product', 'load_quickview_product');
add_action('wp_ajax_nopriv_load_quickview_product', 'load_quickview_product');

function load_quickview_product() {
    check_ajax_referer('tfwc_nonce', 'nonce');

    if (!isset($_POST['product_id'])) {
        wp_send_json_error(['message' => 'No Product']);
    }

    $product_id = intval($_POST['product_id']);

    ob_start();

    $query = new WP_Query([
        'post_type' => 'product',
        'p' => $product_id
    ]);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());
            if ( ! $product || ! $product->exists() ) {
                continue; 
            }

            $GLOBALS['product'] = $product;
            set_query_var('is_quick_view_template', true);

            tfwc_quickview_modal_content();

            set_query_var('is_quick_view_template', false);
        }
        wp_reset_postdata();
    } else {
        echo '<p>No Product</p>';
    }

    $output = ob_get_clean();
    wp_send_json_success(['content' => $output]);

    wp_die();
}
?>