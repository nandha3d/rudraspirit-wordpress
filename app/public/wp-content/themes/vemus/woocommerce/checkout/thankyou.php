<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>
	
		<?php if ( $order->has_status( 'failed' ) ) : ?>
			<div class="thank-wrap flat-spacing pt-0">
				<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'vemus' ); ?></p>

				<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
					<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'vemus' ); ?></a>
					<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'vemus' ); ?></a>
					<?php endif; ?>
				</p>
			</div>
		<?php else : ?>

			<?php wc_get_template( 'checkout/order-received.php', array( 'order' => $order ) ); ?>
			<div class="s-checkout place-order-wrap">	
				<div class="left-col">
					<div class="table-order-finish">
						<table>
							<thead>
								<tr>
									<th class="order_product h6 fw-normal"><?php esc_html_e( 'Order number', 'vemus' ); ?></th>
									<th class="order_price h6 fw-normal"><?php esc_html_e( 'Order Date', 'vemus' ); ?></th>
									<th class="order_quantity h6 fw-normal"><?php esc_html_e( 'Order Total', 'vemus' ); ?></th>
									<th class="order_subtotal h6 fw-normal"><?php esc_html_e( 'Payment Method', 'vemus' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr class="order_item">
									<td class="order_number"><?php echo esc_html( $order->get_order_number() ); ?></td>
									<td class="order_date"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></td>
									<td class="order_total"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></td>
									<td class="order_payment">
										<?php if ( $order->get_payment_method_title() ) : ?>
											<?php echo wp_kses_post( $order->get_payment_method_title() ); ?>
										<?php endif; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="map d-flex">
						<?php
						$store_address   = get_option( 'woocommerce_store_address' );
						$store_address_2 = get_option( 'woocommerce_store_address_2' );
						$store_city      = get_option( 'woocommerce_store_city' );
						$store_postcode  = get_option( 'woocommerce_store_postcode' );
						$store_country   = get_option( 'woocommerce_default_country' );

						$full_address = trim( $store_address . ' ' . $store_address_2 . ', ' . $store_city . ', ' . $store_postcode . ', ' . $store_country );
						$encoded_address = urlencode( $full_address );
						?>

						<iframe 
							src="https://www.google.com/maps?q=<?php echo esc_attr($encoded_address); ?>&output=embed"
							width="100%" 
							height="499" 
							style="<?php echo esc_attr('border:0;'); ?>" 
							allowfullscreen 
							loading="lazy" 
							referrerpolicy="no-referrer-when-downgrade">
						</iframe>
					</div>
					<?php wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) ); ?>			
					<?php wc_get_template( 'order/testimonial-thankyou.php'); ?>
				</div>

				<div class="right-col">
					<div class="tf-page-cart-sidebar">
						<?php wc_get_template( 'order/order-details.php', array( 'order_id' => $order->get_id() ) ); ?>
					</div>
					<?php do_action('tf_after_order_details'); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php //do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

	<?php endif; ?>

</div>
