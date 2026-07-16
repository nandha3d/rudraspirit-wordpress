<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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

do_action( 'woocommerce_before_cart' );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

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
?>
<?php set_query_var('mini_cart_quantity', true); ?>
<div class="flat-spacing s-shop-cart each-list-prd">
	<div class="container container-hd">
		<div class="row row-hd row-cart">
			<div class="col-xl-8 tf-cart-left">
				<div class="tf-page-cart-main">
					<form class="woocommerce-cart-form form-cart" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
						<div class="woocommerce-cart-form__contents">

							<?php do_action( 'woocommerce_before_cart_table' ); ?>

							<table class="table-shop-cart table-order-detail" cellspacing="0">
								<thead>
									<tr>
										<!-- <th class="product-remove">&nbsp;</th>
										<th class="product-thumbnail">&nbsp;</th> -->
										<th class="order_product h6 fw-normal product-name"><?php esc_html_e( 'Product', 'vemus' ); ?></th>
										<th class="order_price h6 fw-normal"><?php esc_html_e( 'Price', 'vemus' ); ?></th>
										<th class="order_quantity h6 fw-normal"><?php esc_html_e( 'Quantity', 'vemus' ); ?></th>
										<th class="order_subtotal h6 fw-normal"><?php esc_html_e( 'Subtotal', 'vemus' ); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php do_action( 'woocommerce_before_cart_contents' ); ?>

									<?php
									foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
										$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
										$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

										if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
											$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
											?>
											<tr class="each-prd file-delete tf-cart-item order_item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

												<td class="product-thumbnail tf-cart-item_product">
													<?php
													$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('tf-cart'), $cart_item, $cart_item_key );

													?>
													
													<div class="order_product">
														<?php
															if( ! (!empty($cart_item['tf_custom_bundle']) && !empty($cart_item['is_bundle_child'])) ){
																echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
																	'woocommerce_cart_item_remove_link',
																	sprintf(
																		'<a href="%s" class="remove tf-cart-remove-icon" aria-label="%s" data-product_id="%s" data-product_sku="%s" title="%s"><i class="icon-close"></i></a>',
																		esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
																		esc_html__( 'Remove this item', 'vemus' ),
																		esc_attr( $product_id ),
																		esc_attr( $_product->get_sku() ),
																		esc_attr__( 'Remove this item', 'vemus' )
																	),
																	$cart_item_key
																);
															}
														?>
														<a href="<?php echo esc_url($product_permalink); ?>" class="image">
															<?php echo wp_kses_post($thumbnail); ?>
														</a>
														<div class="infor">

															<a href="<?php echo esc_url($product_permalink); ?>" class="prd-name h6 fw-normal link">
																<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' ); ?>
																<?php
																	do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
																	do_action( 'tf_after_cart_item_name', $cart_item, $cart_item_key );
																?>
															</a>

															<p class="prd-type">
																<?php

																	add_filter( 'woocommerce_get_item_data', 'tf_remove_key_item_data', 10, 2 );
																
																	// Meta data.
																	echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

																	themesflat_remove_hook( 'woocommerce_get_item_data', 'tf_remove_key_item_data', 10, 2 );
																?>
															</p>

															<?php
																// Backorder notification.
																if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
																	echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'vemus' ) . '</p>', $product_id ) );
																}
															?>

														</div>
													</div>
												</td>

												<td class="order_price each-price" data-cart-title="<?php esc_attr_e( 'Price', 'vemus' ); ?>">
													<div class="price-wrap tf-price">
														<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
													</div>
												</td>

												<td class="order_quantity product-quantity tf-cart-item_quantity" data-cart-title="<?php esc_attr_e( 'Quantity', 'vemus' ); ?>">
												<?php
												if( !empty($cart_item['tf_custom_bundle']) ){
													?>
														<div class="cart-item-quantity">
															<div class="quantity-bundle-product">
																<?php echo esc_html__('Qty: ', 'vemus') . $cart_item['quantity']; ?>
															</div>
														</div>
													<?php
												}else{
													if ( $_product->is_sold_individually() ) {
														$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
													} else {
														$product_quantity = woocommerce_quantity_input(
															array(
																'input_name'   => "cart[{$cart_item_key}][qty]",
																'input_value'  => $cart_item['quantity'],
																'max_value'    => $_product->get_max_purchase_quantity(),
																'min_value'    => '0',
																'product_name' => $_product->get_name(),
															),
															$_product,
															false
														);
													}

													echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
												}
												?>
												</td>

												<td class="product-subtotal tf-cart-item_total order_subtotal each-subtotal-price" data-cart-title="<?php esc_attr_e( 'Subtotal', 'vemus' ); ?>">
													<?php
														echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
													?>
												</td>
											</tr>
											<?php
										}
									}
									?>

									<?php do_action( 'woocommerce_cart_contents' ); ?>

									<tr>
										<td colspan="6" class="extra-fields">
											<?php 
											    $tfwc_order_note = WC()->session->get('tfwc_order_note', '');
												$gift_applied = WC()->session->get('tfwc_gift') ? true : false; 
												$currency   = get_woocommerce_currency_symbol();
												$gift_fee = themesflat_get_opt('gift_fee');
											?>
											<div class="checkbox-wrap">
												<input name="add_gift" id="add-gift" type="checkbox" class="tf-check style-4 tf-add-gift" <?php echo esc_attr($gift_applied ? 'checked' : ''); ?> >
												<label for="add-gift"><?php _e('Add gift packaging', 'vemus'); ?> (<?php echo esc_html($currency) . (float) $gift_fee ; ?>)</label>
											</div>
											<fieldset>
												<label class="label-text">
													<?php _e('Special instructions for seller', 'vemus'); ?>
												</label>
												<textarea name="order_comments" class="order-comments"><?php echo esc_html($tfwc_order_note); ?></textarea>
											</fieldset>
										</td>
									</tr>

									<tr>
										<td colspan="6" class="actions ">

											<div class="wrap-coupon">
												<?php if ( wc_coupons_enabled() ) { ?>
													<div class="coupon box-ip-discount">
														<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Discount code', 'vemus' ); ?>" /> <button type="submit" class="tf-btn btn-fill animate-btn radius-6 btn-out-line-dark-2" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'vemus' ); ?>"><?php esc_html_e( 'Apply', 'vemus' ); ?></button>
														<?php do_action( 'woocommerce_cart_coupon' ); ?>
													</div>
												<?php } ?>
	
												<button type="submit" class="button tf-btn radius-6 btn-out-line-dark-2 tf-update-cart-btn" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'vemus' ); ?>"><?php esc_html_e( 'Update cart', 'vemus' ); ?></button>
											</div>


											<?php do_action( 'woocommerce_cart_actions' ); ?>

											<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
										</td>
									</tr>

									<?php do_action( 'woocommerce_after_cart_contents' ); ?>
								</tbody>
							</table>
							<?php do_action( 'woocommerce_after_cart_table' ); ?>

						</div>
					</form>
				</div>
			</div>
			<div class="col-xl-4 tf-cart-right">
				<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

				<div class="right">
					<div class="checkout-sidebar">
						<?php
							/**
							 * Cart collaterals hook.
							 *
							 * @hooked woocommerce_cross_sell_display
							 * @hooked woocommerce_cart_totals - 10
							 */
							do_action( 'woocommerce_cart_collaterals' );
						?>
					</div>
					<?php do_action( 'tf_after_cart_collaterals' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php set_query_var('mini_cart_quantity', false); ?>
<?php do_action( 'woocommerce_after_cart' ); ?>
