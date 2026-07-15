<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?> 
<a href="<?php echo esc_url(get_permalink($product->get_id())) ;?>" class="name-product h5 link fw-normal text-line-clamp-2"> <?php echo esc_html( $product->get_name() ); ?></a>