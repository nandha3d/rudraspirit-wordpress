<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$content = $product->get_short_description();
if( empty( $content ) ) {
	return;
}
?>
<p class="decs text-sm text-main text-line-clamp-2"><?php echo wp_kses_post($content);?> </p>
