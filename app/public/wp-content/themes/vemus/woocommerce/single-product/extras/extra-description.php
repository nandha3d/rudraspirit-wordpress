<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(themesflat_get_opt('tf_extra_desc')){
    $seal_text = themesflat_get_opt('tf_trust_seal_text');

    $seal_items = themesflat_get_opt('tf_trust_seal_items');
    $seal_items = ! empty( $seal_items ) ? explode( ',', $seal_items ) : array();

    $time_text = themesflat_get_opt('tf_delivery_time_text');
    $time_text2 = themesflat_get_opt('tf_delivery_time_text2');

    $shipping_text = themesflat_get_opt('tf_delivery_shipping_text');
    $shipping_text2 = themesflat_get_opt('tf_delivery_shipping_text2');

    $delivery_icon = themesflat_get_opt('tf_product_delivery_icon');
    $shipping_icon = themesflat_get_opt('tf_product_shipping_icon');
}else{
    return;
}

?>

<div class="tf-product-info-trust-seal text-center">
    <p class="text-md text-dark-2 text-seal fw-medium"><?php echo esc_html($seal_text); ?></p>
    <ul class="list-card">
        <?php
        foreach ( $seal_items as $image_url ) {
            ?>
            <li class="card-item">
                <img src="<?php echo esc_url( $image_url ); ?>" alt="card">
            </li>
        <?php } ?>
    </ul>
</div>

<div class="tf-product-info-delivery-return">
    <?php if ( !empty( $time_text ) || !empty( $time_text2 )) : ?>
        <div class="product-delivery">
                <div class="<?php echo esc_attr($delivery_icon); ?>"></div>
                <p class="text-md"><?php echo esc_html($time_text); ?> <span class="fw-medium"><?php echo esc_html($time_text2); ?></span></p>
        </div>
    <?php endif; ?>
    <?php if ( !empty( $shipping_text ) || !empty( $shipping_text2 )) : ?>
        <div class="product-delivery">
            <div class="<?php echo esc_attr($shipping_icon); ?>"></div>
            <p class="text-md"><?php echo esc_html($shipping_text); ?> <span class="fw-medium"><?php echo esc_html($shipping_text2); ?></span></p>
        </div>
    <?php endif; ?>
</div>