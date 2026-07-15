<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
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
<li class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item order-item', $item, $order ) ); ?>">
	<div class="content">
		<figure class="img-product">
			<?php $product = $item->get_product();
				if ( $product ) {
					echo wp_kses_post( $product->get_image() ) . '&nbsp;';
				} ?>						
			<?php 
				$qty          = $item->get_quantity();
				$refunded_qty = $order->get_qty_refunded_for_item( $item_id );

				if ( $refunded_qty ) {
					$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
				} else {
					$qty_display = esc_html( $qty );
				}

				echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="quantity product-quantity">' . sprintf( '%s', $qty_display ) . '</strong>', $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</figure>

		<div class="info">
			<p class="name">
				<?php
					$is_visible        = $product && $product->is_visible();
					$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
					echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ) );
				?>
			</p>
			<span class="variant">
				<?php 		
				do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );
				add_filter( 'woocommerce_get_item_data', 'tf_remove_key_item_data', 10, 2 );
				// print_r($item);
				wc_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				themesflat_remove_hook( 'woocommerce_get_item_data', 'tf_remove_key_item_data', 10, 2 );
				do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false ); 
				?>
			</span>
		</div>
	</div>
	<span class="h6 price">
		<?php echo empty($order->get_formatted_line_subtotal( $item )) ? '' : $order->get_formatted_line_subtotal( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</span>
</li>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

<li class="woocommerce-table__product-purchase-note product-purchase-note">

	<div ><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>

</li>

<?php endif; ?>
