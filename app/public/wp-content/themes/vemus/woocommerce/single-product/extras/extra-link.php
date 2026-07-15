<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$tabs_position = empty ($_GET['product_tabs_pos']) ? themesflat_get_opt('tf_product_tabs_position') : $_GET['product_tabs_pos'];
$style_bellow_cart = empty ($_GET['style_bellow_cart']) ? themesflat_get_opt('tf_product_tabs_style_bellow_cart') : $_GET['style_bellow_cart'];

if( ! $tabs_position == "below_cart" || !$style_bellow_cart == "sidebar" ){
    return;
}

    $description_icon = themesflat_get_opt('tf_product_description_icon');
    $additional_info_icon = themesflat_get_opt('tf_product_additional_info_icon');
    $reviews_icon = themesflat_get_opt('tf_product_reviews_icon');
    $shipping_icon = themesflat_get_opt('tf_product_shipping_icon');
    $ask_question_icon = themesflat_get_opt('tf_product_ask_question_icon');

    $shipping_text = themesflat_get_opt('tf_product_shipping_text');
    $ask_question_text = themesflat_get_opt('tf_product_ask_question_text');
?>
<div class="tf-product-info-extra-link">
    <?php if( themesflat_get_opt('tf_product_description_tab') ){ ?>
        <a href="#tf-vemus-description-tab" data-bs-toggle="offcanvas" class="product-extra-icon link text-caption">
            <i class="<?php echo esc_attr($description_icon); ?>"></i>
            <?php esc_html_e('Description', 'vemus'); ?>
        </a>
    <?php } ?>

    <?php if( themesflat_get_opt('tf_product_additional_info_tab') ){ ?>
        <a href="#tf-vemus-additional-info-tab" data-bs-toggle="offcanvas" class="product-extra-icon link text-caption">
            <i class="<?php echo esc_attr($additional_info_icon); ?>"></i>
            <?php esc_html_e('Additional information', 'vemus'); ?>
        </a>
    <?php } ?>

    <?php if( themesflat_get_opt('tf_product_shipping_tab') ){ ?>
        <a href="#vemus-shipping" data-bs-toggle="offcanvas" class="product-extra-icon link text-caption">
            <i class="<?php echo esc_attr($shipping_icon); ?>"></i>
            <?php echo esc_html($shipping_text); ?>
        </a>
    <?php } ?>

    <?php if( themesflat_get_opt('tf_product_ask_question_tab') ){ ?>
    <a href="#vemus-ask-question" data-bs-toggle="offcanvas" class="product-extra-icon link text-caption">
        <i class="<?php echo esc_attr($ask_question_icon); ?>"></i>
        <?php echo esc_html($ask_question_text); ?>
    </a>
    <?php } ?>

    <?php if( themesflat_get_opt('tf_product_reviews_tab') ){ ?>
        <a href="#tf-vemus-reviews-tab" data-bs-toggle="offcanvas" class="product-extra-icon link text-caption">
            <i class="<?php echo esc_attr($reviews_icon); ?>"></i>
            <?php esc_html_e('Reviews', 'vemus'); ?>
        </a>
    <?php } ?>

</div>