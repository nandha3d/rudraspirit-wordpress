<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?> 
<p class="price-wrap">
    <?php if ($product->is_on_sale() &&  $product->is_type('simple') ) : ?>
        <span class="price-new h5"><?php echo (wc_price($product->get_sale_price())); ?></span>
        <span class="price-old fw-normal"><?php echo (wc_price($product->get_regular_price())); ?></span>
    <?php else : ?>
        <span class="price-new h5">
            <?php echo wp_kses_post($product->get_price_html()); ?>
        </span>
    <?php endif; ?>
</p>