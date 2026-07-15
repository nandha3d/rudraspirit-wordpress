<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(themesflat_get_opt('tf_trust_seal')){
    $seal_text = themesflat_get_opt('tf_trust_seal_text');

    $seal_items = themesflat_get_opt('tf_trust_seal_items');
    $seal_items = ! empty( $seal_items ) ? explode( ',', $seal_items ) : array();
}else{
    return;
}

?>

<div class="tf-product-payment-method">
    <p class="text-guarantee text-caption">
        <i class="icon icon-shield"></i>
        <?php echo esc_html($seal_text); ?>
    </p>
    <ul class="paymend-method-list">
        <?php
        foreach ( $seal_items as $image_url ) {
            ?>
            <li class="card-item">
                <img src="<?php echo esc_url( $image_url ); ?>" alt="card">
            </li>
        <?php } ?>
    </ul>
</div>