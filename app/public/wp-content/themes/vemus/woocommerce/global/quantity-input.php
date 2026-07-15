<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 10.3.4
 */

defined( 'ABSPATH' ) || exit;

$is_minicart = get_query_var('mini_cart_quantity');

if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
} else {
	/* translators: %s: Quantity. */
	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'vemus' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'vemus' );
	?>
	<div class="quantity">		
	    <label class="screen-reader-text label text-md d-block" for="<?php echo esc_attr( $input_id ); ?>"><?php esc_html_e( 'Quantity:', 'vemus' ); ?></label>
	    <div class="inner-quantity wg-quantity <?php echo esc_attr( empty($is_minicart) ? '' : 'style-2' ); ?>">
		    <button type="button" value="-" class="btn-quantity qty_button minus btn-decrease">
				<i class="icon-minus"></i>
			</button>
		    <input  type="number"
					id="<?php echo esc_attr( $input_id ); ?>"
					class="quantity-product <?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
					step="<?php echo esc_attr( $step ); ?>"
					min="<?php echo esc_attr( $min_value ); ?>"
					
					name="<?php echo esc_attr( $input_name ); ?>"
					value="<?php echo esc_attr( $input_value ); ?>"
					title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'vemus' ); ?>"
					placeholder="<?php echo esc_attr( $placeholder ); ?>"
					inputmode="<?php echo esc_attr( $inputmode ); ?>" />
		    <button type="button" value="+" class="btn-quantity qty_button plus btn-increase">
				<i class="icon-plus"></i>
			</button>
		</div>
	</div>
	<?php
}
