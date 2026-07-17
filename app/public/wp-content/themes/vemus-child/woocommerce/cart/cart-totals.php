<?php
/**
 * Cart totals (Child Theme Override)
 *
 * @package WooCommerce/Templates
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<div class="form-checkout-sidebar">
		<div class="form-content">
			<?php do_action( 'woocommerce_before_cart_totals' ); ?>
			
			<table cellspacing="0" class="shop_table shop_table_responsive">

				<tr class="cart-subtotal">
					<th class="px-0"><?php esc_html_e( 'Subtotal', 'vemus' ); ?></th>
					<td class="subtotal-value" data-title="<?php esc_attr_e( 'Subtotal', 'vemus' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
				</tr>

				<?php if ( wc_coupons_enabled() ) : ?>
					<tr class="cart-coupon-sidebar-row">
						<td colspan="2" style="padding: 18px 0; border-bottom: 1px solid #f0f0f0;">
							<form class="checkout_coupon woocommerce-form-coupon sidebar-coupon-form" method="post" action="<?php echo esc_url( wc_get_cart_url() ); ?>" style="display: flex; gap: 8px; width: 100%; margin: 0;">
								<input type="text" name="coupon_code" class="input-text" id="sidebar_coupon_code" value="" placeholder="<?php esc_attr_e( 'Discount code', 'vemus' ); ?>" style="flex: 1; height: 44px; border: 1px solid #ddd; border-radius: 6px; padding: 0 12px; font-size: 14px; background: #fff; color: #191410;" />
								<button type="submit" class="button tf-btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'vemus' ); ?>" style="height: 44px; padding: 0 18px; border-radius: 6px; font-weight: 600; background: #191410; color: #fff; border: none; cursor: pointer; font-size: 14px; text-transform: uppercase;"><?php esc_html_e( 'Apply', 'vemus' ); ?></button>
								<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
							</form>
						</td>
					</tr>
				<?php endif; ?>

				<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
					<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
						<td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

					<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

				<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

					<tr class="shipping">
						<th><?php esc_html_e( 'Shipping', 'vemus' ); ?></th>
						<td data-title="<?php esc_attr_e( 'Shipping', 'vemus' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
					</tr>

				<?php endif; ?>

				<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
					<tr class="fee">
						<th><?php echo esc_html( $fee->name ); ?></th>
						<td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php
				if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
					$taxable_address = WC()->customer->get_taxable_address();
					$estimated_text  = '';

					if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
						/* translators: %s location. */
						$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'vemus' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
					}

					if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
						foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
							?>
							<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
								<th><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
								<td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr class="tax-total">
							<th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
							<td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
						</tr>
						<?php
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

				<tr class="order-total">
					<th class="title-total h4"><?php esc_html_e( 'Total:', 'vemus' ); ?></th>
					<td class="h4 total-value" data-title="<?php esc_attr_e( 'Total', 'vemus' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
				</tr>

				<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

			</table>

			<span class="br-line"></span>
			<div class="checkbox-wrap" style="display: flex; align-items: center; margin: 18px 0;">
				<input id="agree-term" type="checkbox" class="tf-check style-4" required=true style="width: 18px; height: 18px; margin-right: 10px; cursor: pointer; accent-color: #191410;">
				<label for="agree-term" style="color: #191410 !important; font-size: 15px !important; font-weight: 600 !important; cursor: pointer; opacity: 1 !important; visibility: visible !important;">I agree to Terms and conditions</label>
			</div>

			<div class="wc-proceed-to-checkout draw-border checkout-btn" style="display: flex; flex-direction: column; gap: 12px;">
				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button alt wc-forward tf-btn btn-fill fw-medium animate-btn w-100" style="display: flex; align-items: center; justify-content: center; height: 54px; border-radius: 30px; font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; background: #191410; color: #ffffff; text-decoration: none;">
					<?php esc_html_e( 'Checkout', 'vemus' ); ?>
				</a>
				<a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="button continue-shopping tf-btn btn-out-line-dark-2 fw-medium animate-btn w-100" style="display: flex; align-items: center; justify-content: center; height: 50px; border-radius: 30px; font-weight: 700; font-size: 15px; text-transform: uppercase; letter-spacing: 1px; border: 2px solid #191410; color: #191410; background: transparent; text-decoration: none; transition: all 0.3s ease;">
					<?php esc_html_e( 'Continue Shopping', 'vemus' ); ?>
				</a>
			</div>

			<?php do_action( 'woocommerce_after_cart_totals' ); ?>
			
		</div>
	</div>

</div>
