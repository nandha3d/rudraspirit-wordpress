<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// do_action( 'woocommerce_before_single_product' );

if ( isset($add_hooks) && is_callable($add_hooks) ) {
    call_user_func($add_hooks);
}


if( !class_exists('Woo_Single_Product_Hook') ){
    return;
}

$_GET['tf_btn_classes'] = 'animate-btn';

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_filter('woocommerce_available_variation', [ Woo_Single_Product_Hook::instance(), 'add_schedule_sale_to_variations'], 10, 3);
add_filter( 'woocommerce_single_product_image_thumbnail_html', [ Woo_Single_Product_Hook::instance(), 'single_product_image_thumbnail_html'], 10, 2 );
add_filter( 'woocommerce_gallery_image_html_attachment_image_params', [ Woo_Single_Product_Hook::instance(), 'gallery_image_params'], 10, 4 );
add_filter( 'wcboost_variation_swatches_color_html', [ Woo_Single_Product_Hook::instance(), 'wcboost_variation_swatches_color_html' ], 20, 4);
add_filter( 'wcboost_variation_swatches_image_html', [ Woo_Single_Product_Hook::instance(), 'wcboost_variation_swatches_image_html' ], 20, 4);
add_filter( 'wcboost_variation_swatches_item_args', [ Woo_Single_Product_Hook::instance(), 'wcboost_variation_swatches_item_args' ], 20, 4 );
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ Woo_Single_Product_Hook::instance(), 'tf_variation_swatches_dropdown_html' ], 120,2);
add_filter( 'woocommerce_product_single_add_to_cart_text', [ Woo_Single_Product_Hook::instance(), 'add_to_cart_button_text'], 10, 2 );
add_filter('woocommerce_available_variation', [ Woo_Single_Product_Hook::instance(), 'single_add_to_cart_text_variations'], 10, 3);
add_action( 'woocommerce_end_add_to_cart_form', [ Woo_Single_Product_Hook::instance(), 'woocommerce_template_extra_button' ]);
add_action( 'woocommerce_end_single_variation', [ Woo_Single_Product_Hook::instance(), 'woocommerce_template_extra_button' ]);

?>
<div class="tf-single-product tf-product-feature tf-main-product">
    <div class="row section-image-zoom">
        <div class="col-md-6 gallery-col">
            <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
        </div>
        <div class="col-md-6 product-main-col">
            <div class="tf-zoom-main"></div>
            <div class="tf-product-info-wrap other-image-zoom">
                <div class="tf-product-info-list tf-product-info-heading">
                    <div class="tf-product-feature-brand">
                        <?php Woo_Single_Product_Hook::instance()->brands_html(); ?>
                    </div>

                    <div class="tf-product-feature-title">
                        <?php wc_get_template( 'single-product/title.php' ); ?>
                    </div>

                    <div class="tf-product-feature-rating">
                        <?php wc_get_template( 'single-product/rating.php' ); ?>
                    </div>

                    <div class="tf-product-feature-price">
                        <?php wc_get_template( 'single-product/price.php' ); ?>
                    </div>

                    <div class="tf-product-feature-badges-group group-badges">
                        <div class="tf-product-feature-badges-group">
                            <?php wc_get_template( 'single-product/extras/badges.php' ); ?>
                        </div>
                        <div class="tf-product-feature-progress-sale">
                            <?php wc_get_template( 'single-product/extras/recent-sales-count.php' ); ?>
                        </div>
                    </div>

                    <div class="tf-product-feature-countdown">
                        <?php wc_get_template( 'single-product/extras/countdown-2.php' ); ?>
                    </div>

                    <div class="tf-product-feature-people-view">
                        <?php wc_get_template( 'single-product/extras/people-view.php' ); ?>
                    </div>

                    <div class="tf-product-feature-add-to-cart-wrapper">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>

                    <?php
                        if( !$product->is_in_stock() && class_exists('Woo_Single_Product_Hook') ){
                            Woo_Single_Product_Hook::instance()->woocommerce_template_out_of_stock_notification();
                        }
                    ?>
                </div>
            </div>
            <a href="<?php echo esc_url( get_permalink());?>" class="d-flex align-items-center gap-4 view-details link fw-medium">
                <?php esc_html_e( 'View full details', 'vineta-addon' ); ?>
                <i class="icon icon-arrow-right"></i>
            </a>
        </div>
        <?php
            // do_action( 'woocommerce_after_single_product' );
        ?>
    </div>
</div>

<?php
if ( isset($remove_hooks) && is_callable($remove_hooks) ) {
    call_user_func($remove_hooks);
}

$_GET['tf_btn_classes'] = '';
return;

if ( ! function_exists( 'tf_get_contents' ) ) {
	function tf_get_contents($contents) {
		if( !empty($contents) ){
			return $contents;
			// return wp_kses_post($contents);
		}
	}
}