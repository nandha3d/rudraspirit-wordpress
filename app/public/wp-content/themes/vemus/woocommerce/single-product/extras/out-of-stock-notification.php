<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(!themesflat_get_opt('tf_out_of_stock_notification') || $product->is_in_stock()){
    return;
}

$html = themesflat_get_opt('tf_out_of_stock_notification_html');
add_filter( 'woocommerce_out_of_stock_message', '__return_empty_string' );
?>

<div class="tf-out-stock-wrapper">
    <?php echo html_entity_decode($html); ?>
</div>