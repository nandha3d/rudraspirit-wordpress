<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if( empty($product) ){
    return;
}

$text = $product->get_meta('_tfwc_sale_marquee_text');
$color = $product->get_meta('_tfwc_sale_marquee_color');
$bg = $product->get_meta('_tfwc_sale_marquee_bg');

?>
<div class="variant-box sale-marquee-box" style="--sale-marquee-color:<?php echo esc_attr($color); ?>;--sale-marquee-bg:<?php echo esc_attr($bg); ?>">
    <div class="marquee-sale type-2 vemus-marquee-sale" data-clone="2">
        <?php echo empty($text) ? '' : $text ?>
    </div>
</div>