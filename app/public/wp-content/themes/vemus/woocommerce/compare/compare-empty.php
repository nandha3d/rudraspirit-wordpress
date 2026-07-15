<?php
/**
 * Template for displaying the notice of empty compare list.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/compare/compare-empty.php.
 *
 * @author  WCBoost
 * @package WCBoost\ProductsCompare\Templates
 * @version 1.0.3
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="vemus--empty">
	<?php
	wc_print_notice( wp_kses_post( apply_filters( 'wcboost_products_compare_empty_message', __( 'There is no product to compare.', 'vemus' ) ) ), 'notice' );
	?>
</div>

<?php if ( ! empty( $return_url ) ) : ?>
	<p class="return-to-shop">
		<?php
		echo wp_kses_post( apply_filters( 'wcboost_products_compare_return_to_shop_link', sprintf(
			'<a href="%s" class="tf-btn animate-btn button wc-backward">%s</a>',
			esc_url( $return_url ),
			esc_html__( 'Return to shop', 'vemus' )
		), $args ) );
		?>
	</p>
<?php endif; ?>
