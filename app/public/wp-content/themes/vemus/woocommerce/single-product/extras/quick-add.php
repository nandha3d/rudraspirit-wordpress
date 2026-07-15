<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
if ( ! function_exists( 'tf_get_contents' ) ) {
	function tf_get_contents($contents) {
		if( !empty($contents) ){
			return $contents;
			// return wp_kses_post($contents);
		}
	}
}
$image_id = $product->get_image_id();
$image_url = wp_get_attachment_url( $image_id );

?>
<div class="tf-product-info-wrap mt-0">
    <div class="tf-product-info-inner tf-product-info-list mb-0">
        <div class="tf-product-mini-view">
            <a href="<?php echo esc_url($product->get_permalink()); ?>" class="prd-image">
                <img class="lazyload" src="<?php echo esc_url($image_url); ?>" alt="Image Product">
            </a>
            <div class="prd-content">
                <a href="<?php echo esc_url($product->get_permalink()); ?>" class="prd-name link h6 fw-normal text-uppercase">
                    <?php echo esc_html($product->get_name()); ?>
                </a>
                <div class="price-wrap tf-price">
                    <?php echo tf_get_contents($product->get_price_html()); ?>
                </div>
            </div>
            <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
        </div>
        <?php woocommerce_template_single_add_to_cart(); ?>
        <?php
        if( !$product->is_in_stock() ){
            Woo_Single_Product_Hook::instance()->woocommerce_template_out_of_stock_notification();
        }
        ?>
    </div>
</div>
<?php //woocommerce_template_single_variation(); ?>
