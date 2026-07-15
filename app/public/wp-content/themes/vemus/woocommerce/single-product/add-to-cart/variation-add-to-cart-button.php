<?php
/**
 * Single variation cart button
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.3.4
 */

defined( 'ABSPATH' ) || exit;

global $product;
$tf_btn_classes = 'hover-primary';

if( !empty($_GET['tf_btn_classes']) ){
	$tf_btn_classes = sanitize_text_field($_GET['tf_btn_classes']);
}
?>
<div class="cart tf-product-total-quantity woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	<div class="group-btn">

		<button type="submit" class="tf-btn btn-fill-2 text-uppercase fw-medium animate-btn flex-grow-1 btn-add-to-cart single_add_to_cart_button button alt <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> <?php echo esc_attr($tf_btn_classes); ?>">
			<span class="single-add-to-cart-text">
				<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
			</span>
			<span class="dynamic-price" data-discount="0" data-price="0"></span>
			<span class="tf-add-to-cart-loading d-none position-relative">
				<span class="spinner"></span>
			</span>
		</button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</div>
	<?php do_action( 'woocommerce_end_single_variation' ); ?>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
