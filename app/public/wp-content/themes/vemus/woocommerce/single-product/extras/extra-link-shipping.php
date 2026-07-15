<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(themesflat_get_opt('tf_product_shipping_tab')){

    $tabs_position = empty ($_GET['product_tabs_pos']) ? themesflat_get_opt('tf_product_tabs_position') : $_GET['product_tabs_pos'];

    $shipping_title = themesflat_get_opt('tf_product_shipping_title');
    $shipping_content = themesflat_get_opt('tf_product_shipping_content');
}else{
    return;
}

?>

<?php if( $tabs_position == "default" ): ?>
    <div>
        <span class="h6">
            <?php echo wp_kses_post($shipping_content); ?>
        </span>
    </div>
<?php else : ?>
    <div class="offcanvas offcanvas-end canvas-sidebar canvas-shipping canvas-delivery" id="vemus-shipping" aria-modal="true" role="dialog">
        <div class="canvas-header align-items-start">
            <h3 class="title fw-normal text-uppercase">
                <?php echo esc_html($shipping_title); ?>
            </h3>
            <span class="icon-close link icon-close-popup p-0" data-bs-dismiss="offcanvas"></span>
        </div>
        <div class="canvas-body">
            <?php echo wp_kses_post($shipping_content); ?>
        </div>
    </div>
<?php endif; ?>