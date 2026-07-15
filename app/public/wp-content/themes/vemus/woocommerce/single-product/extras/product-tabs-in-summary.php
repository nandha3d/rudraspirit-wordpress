<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$shipping_text = themesflat_get_opt('tf_product_shipping_text');
$ask_question_text = themesflat_get_opt('tf_product_ask_question_text');
$shipping_content = themesflat_get_opt('tf_product_shipping_content');
$ask_question_content = themesflat_get_opt('tf_product_ask_question_content');

$count_tab  = 99; // All collapsed by default

$tabs_position = empty ($_GET['product_tabs_pos']) ? themesflat_get_opt('tf_product_tabs_position') : $_GET['product_tabs_pos'];
$gallery_layout = empty($_GET['gallery_layout']) ? themesflat_get_opt('tf_product_gallery_layout') :  $_GET['gallery_layout'];

if( $tabs_position == 'in_summary' && $gallery_layout == 'middle_gallery'){
    $count_tab = 0;
}

?>

<div class="tf-product-accordion">

    <?php if( themesflat_get_opt('tf_product_description_tab') ): ?>
        <div class="widget-accordion-2 style-3">
            <div class="accordion-title <?php echo esc_attr( $count_tab == 0 ? '' : 'collapsed'); ?>" data-bs-target="#tf-vemus-description-tab" data-bs-toggle="collapse" aria-expanded="false" aria-controls="tab-description" role="button">
                <span><?php esc_html_e('Description', 'vemus'); ?></span>
                <span class="icon ic-accordion-custom"></span>
            </div>
            <div id="tf-vemus-description-tab" class="widget-desc <?php echo esc_attr( $count_tab == 0 ? 'collapse show' : 'collapse'); ?>">
                <div class="accordion-body">
                    <?php woocommerce_product_description_tab(); ?>
                </div>
            </div>
        </div>
        <?php $count_tab++; ?>
    <?php endif; ?>

    <?php if( themesflat_get_opt('tf_product_additional_info_tab') ): ?>
        <div class="widget-accordion-2 style-3">
            <div class="accordion-title <?php echo esc_attr( $count_tab == 0 ? '' : 'collapsed'); ?>" data-bs-target="#tf-vemus-additional-info-tab" data-bs-toggle="collapse" aria-expanded="false" aria-controls="tab-additional-info" role="button">
                <span><?php esc_html_e('Additional information', 'vemus'); ?></span>
                <span class="icon ic-accordion-custom"></span>
            </div>
            <div id="tf-vemus-additional-info-tab" class="widget-desc <?php echo esc_attr( $count_tab == 0 ? 'collapse show' : 'collapse'); ?>">
                <div class="accordion-body">
                    <?php woocommerce_product_additional_information_tab(); ?>
                </div>
            </div>
        </div>
        <?php $count_tab++; ?>
    <?php endif; ?>

    <?php if( themesflat_get_opt('tf_product_shipping_tab') ): ?>
        <div class="widget-accordion-2 style-3">
            <div class="accordion-title <?php echo esc_attr( $count_tab == 0 ? '' : 'collapsed'); ?>" data-bs-target="#tf-vemus-shipping-tab" data-bs-toggle="collapse" aria-expanded="false" aria-controls="tab-shipping" role="button">
                <span><?php echo esc_html($shipping_text); ?></span>
                <span class="icon ic-accordion-custom"></span>
            </div>
            <div id="tf-vemus-shipping-tab" class="widget-desc <?php echo esc_attr( $count_tab == 0 ? 'collapse show' : 'collapse'); ?>">
                <div class="accordion-body">
                    <?php echo wp_kses_post($shipping_content); ?>
                </div>
            </div>
        </div>
        <?php $count_tab++; ?>
    <?php endif; ?>

    <?php if( themesflat_get_opt('tf_product_ask_question_tab') ): ?>
        <div class="widget-accordion-2 style-3">
            <div class="accordion-title <?php echo esc_attr( $count_tab == 0 ? '' : 'collapsed'); ?>" data-bs-target="#tf-vemus-ask-question-tab" data-bs-toggle="collapse" aria-expanded="false" aria-controls="tab-ask-question" role="button">
                <span><?php echo esc_html($ask_question_text); ?></span>
                <span class="icon ic-accordion-custom"></span>
            </div>
            <div id="tf-vemus-ask-question-tab" class="widget-desc <?php echo esc_attr( $count_tab == 0 ? 'collapse show' : 'collapse'); ?>">
                <div class="accordion-body">
                    <?php echo do_shortcode($ask_question_content); ?>
                </div>
            </div>
        </div>
        <?php $count_tab++; ?>
    <?php endif; ?>

    <?php if( themesflat_get_opt('tf_product_reviews_tab') ): ?>
        <div class="widget-accordion-2 style-3">
            <div class="accordion-title <?php echo esc_attr( $count_tab == 0 ? '' : 'collapsed'); ?>" data-bs-target="#tf-vemus-reviews-tab" data-bs-toggle="collapse" aria-expanded="false" aria-controls="tab-reviews" role="button">
                <span><?php esc_html_e('Reviews', 'vemus'); ?></span>
                <span class="icon ic-accordion-custom"></span>
            </div>
            <div id="tf-vemus-reviews-tab" class="widget-desc <?php echo esc_attr( $count_tab == 0 ? 'collapse show' : 'collapse'); ?>">
                <div class="accordion-body">
                    <?php comments_template(); ?>
                </div>
            </div>
        </div>
        <?php $count_tab++; ?>
    <?php endif; ?>

</div>