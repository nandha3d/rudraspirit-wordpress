<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.3.4
 */

defined( 'ABSPATH' ) || exit;
?>

<?php
	if( !function_exists('tf_remove_key_item_data') ){
		function tf_remove_key_item_data( $item_data, $cart_item ) {
			
			if ( is_array( $item_data ) ) {
				$i = 0;
				foreach ( $item_data as $key => $data ) {
					$i++;
					if( $i == 1 ){
						continue;
					}
					if( isset($item_data[ $key ]['display']) ){
						$item_data[ $key ]['display'] = '/ ' . $item_data[ $key ]['display'];
					}
					if( isset($item_data[ $key ]['value']) ){
						$item_data[ $key ]['value'] = '/ ' . $item_data[ $key ]['value'];
					}
				}
			}
			return $item_data;
		}
	}

	if( !function_exists('tf_coupon_label') ){
		function tf_coupon_label($label, $coupon){
			return sprintf( esc_html__( 'Discount: %s', 'vemus' ), $coupon->get_code() );
		}
	}
?>

<div class="shop_table woocommerce-checkout-review-order-table">

		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		echo '<ul class="list-order-product">';
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<li class="order-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<div class="content">
						<div class="img-product">
							<figure class="img-product-child">
								<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_image('tf-checkout'), $cart_item, $cart_item_key ) ); ?>
							</figure>
							
							<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <span class="text-caption quantity">' . sprintf( '%s', $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<div class="info">
							<p class="name">
								<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
							</p>
							<span class="variant">
								<?php add_filter( 'woocommerce_get_item_data', 'tf_remove_key_item_data', 10, 2 ); ?>
								<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php themesflat_remove_hook( 'woocommerce_get_item_data', 'tf_remove_key_item_data', 10, 2 ); ?>
							</span>
						</div>
					</div>
					<h6 class="price">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</h6>
				</li>
				<?php
			}
		}
		echo '</ul>';
		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	<span class="br-line"></span>

	<ul class="list-total text-uppercase">
		<li class="cart-subtotal total-item text-sm d-flex justify-content-between">
			<span class="text-uppercase"><?php esc_html_e( 'Subtotal:', 'vemus' ); ?></span>
			<span><?php wc_cart_totals_subtotal_html(); ?></span>
		</li>

		<?php add_filter('woocommerce_cart_totals_coupon_label', 'tf_coupon_label', 10, 2); ?>
		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<li class="total-item text-sm d-flex justify-content-between cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<span class="text-uppercase"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
				<span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
			</li>
		<?php endforeach; ?>

		<?php themesflat_remove_hook('woocommerce_cart_totals_coupon_label', 'tf_coupon_label', 10, 2); ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<div class="box-ip-shipping">

				<div class="form-content-2">

					<?php wc_cart_totals_shipping_html(); ?>

				</div>

			</div>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<li class="total-item text-sm d-flex justify-content-between fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</li>
		<?php endforeach; ?>

		<span class="br-line"></span>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
					<li class="total-item text-sm d-flex justify-content-between tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
				</li>
				<?php endforeach; ?>
			<?php else : ?>
				<li class="total-item text-sm d-flex justify-content-between tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</li>
			<?php endif; ?>
		<?php endif; ?>
		</ul>
		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<h4 class="last-total d-flex justify-content-between order-total">
			<span class="text-upercase"><?php esc_html_e( 'Total:', 'vemus' ); ?></span>
			<span class="total-price-order"><?php wc_cart_totals_order_total_html(); ?></span>
		</h4>
		
		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
		

</div>