<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(!themesflat_get_opt('tf_buy_now') || empty(themesflat_get_opt('tf_buy_now_query_arg')) ){
	return;
}

?>

<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="tf-btn w-100 text-uppercase fw-medium tf-buy-now-btn">
	<?php echo esc_html__('Buy it now','vemus')?>
	<span class="tf-add-to-cart-loading d-none position-relative">
		<span class="spinner"></span>
	</span>
</a>