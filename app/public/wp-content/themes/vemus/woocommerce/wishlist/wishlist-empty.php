<?php
/**
 * Template for displaying the empty wishlist.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/wishlist/wishlist-empty.php.
 *
 * @author  WCBoost
 * @package WCBoost\Wishlist\Templates
 * @version 10.3.4
 */

defined( 'ABSPATH' ) || exit;

do_action( 'wcboost_wishlist_before_wishlist' ); ?>

<div class="wishlist-empty tf-wishlist-empty text-center">
	<p class="text-md text-noti"><?php echo __( 'No product were added to the wishlist.', 'vemus' ) ;?></p>	
	<?php if ( ! empty( $args['return_url'] ) ) : ?>
		
		<?php
			echo wp_kses_post( apply_filters( 'wcboost_wishlist_return_to_shop_link', sprintf(
				'<a href="%s" class="tf-btn animate-btn button btn-back-shop wc-backward">%s</a>',
				esc_url( $args['return_url'] ),
				esc_html__( 'Back to Shopping', 'vemus' )
			), $args ) );
		?>
	<?php endif; ?>
</div>



<?php do_action( 'wcboost_wishlist_after_wishlist' ); ?>
