<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(themesflat_get_opt('tf_delivery_info')){

    $tf_delivery_text = themesflat_get_opt('tf_delivery_text');
    $tf_delivery_icon = themesflat_get_opt('tf_delivery_icon');

    $tf_delivery_text2 = themesflat_get_opt('tf_delivery_text2');
    $tf_delivery_icon2 = themesflat_get_opt('tf_delivery_icon2');

    $tf_delivery_text3 = themesflat_get_opt('tf_delivery_text3');
    $tf_delivery_icon3 = themesflat_get_opt('tf_delivery_icon3');

    $tf_delivery_text4 = themesflat_get_opt('tf_delivery_text4');
    $tf_delivery_icon4 = themesflat_get_opt('tf_delivery_icon4');

}else{
    return;
}

?>

<ul class="tf-product-info-delivery">
    
    <?php if ( !empty( $tf_delivery_text ) ) : ?>
        <li>
            <i class="<?php echo esc_attr($tf_delivery_icon); ?>"></i>
            <h6 class="fw-normal"><?php echo esc_html($tf_delivery_text); ?></h6>
        </li>
    <?php endif; ?>

    <?php if ( !empty( $tf_delivery_text2 ) ) : ?>
        <li>
            <i class="<?php echo esc_attr($tf_delivery_icon2); ?>"></i>
            <h6 class="fw-normal"><?php echo esc_html($tf_delivery_text2); ?></h6>
        </li>
    <?php endif; ?>

    <?php if ( !empty( $tf_delivery_text3 ) ) : ?>
        <li>
            <i class="<?php echo esc_attr($tf_delivery_icon3); ?>"></i>
            <h6 class="fw-normal"><?php echo esc_html($tf_delivery_text3); ?></h6>
        </li>
    <?php endif; ?>

    <?php if ( !empty( $tf_delivery_text4 ) ) : ?>
        <li>
            <i class="<?php echo esc_attr($tf_delivery_icon4); ?>"></i>
            <h6 class="fw-normal"><?php echo esc_html($tf_delivery_text4); ?></h6>
        </li>
    <?php endif; ?>

</ul>