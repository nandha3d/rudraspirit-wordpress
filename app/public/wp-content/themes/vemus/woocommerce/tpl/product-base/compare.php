<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter( 'wcboost_products_compare_button_icon', 'tfwc_compare_icon' , 20, 2 );
add_filter( 'wcboost_products_compare_loop_add_to_compare_link', 'tfwc_compare_button' , 20, 2 );

function tfwc_compare_button($html, $args) {
    $classes = is_singular( 'product' ) ? 'wcboost-products-compare-button wcboost-products-compare-button--single button' : 'wcboost-products-compare-button wcboost-products-compare-button--loop button';
    $product_title = isset( $args['product_title'] ) ? $args['product_title'] : '';
    if( empty( $product_title ) ) {
        $product = isset($args['product_id']) ? wc_get_product( $args['product_id'] ) : '';
        $product_title = $product ? $product->get_title() : '';
    }

    $label_add = \WCBoost\ProductsCompare\Helper::get_button_text( 'add' );
    $label_added = \WCBoost\ProductsCompare\Helper::get_button_text( 'view' );

    if( get_option( 'wcboost_products_compare_exists_item_button_behaviour' ) == 'remove' ) {
        $label_added = \WCBoost\ProductsCompare\Helper::get_button_text( 'remove' );
    }

    $product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
 
    if (isset($_POST['product_style'])) {
        $product_style = sanitize_text_field($_POST['product_style']);
    }

    
    
    $class = '';
    if($product_style == 'style-2' || $product_style == 'style-3' || $product_style == 'style-list' || $product_style == 'style-wishlist style-3') {
        $class = ' tooltip-top ';
    } else {
        $class = ' tooltip-left ';
    }

    if($product_style == 'style-4' || $product_style == 'style-5'){
        $class .= ' bg-surface';
    }

    if($product_style == 'style-list') {
        return sprintf(
            '<a href="%1s" class="box-icon hover-tooltip compare '.$class.' %2s" role="button" %3s data-tooltip="%4s" data-tooltip_added="%5s">
                <span class="wcboost-products-compare-button__icon">%s</span>            
                <span class="tooltip">%4s</span>
            </a>',
            esc_url( isset( $args['url'] ) ? $args['url'] : add_query_arg( [ 'add-to-compare' => $args['product_id'] ] ) ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : esc_attr( $classes ) ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            wp_kses_post( $label_add ),
            wp_kses_post( $label_added ),
            empty( $args['icon'] ) ? '' :  $args['icon'],
            esc_html( isset( $args['label'] ) ? $args['label'] : __( 'Add to Compare', 'vemus' ) )
        );
    } else {
        return sprintf(
            '<li class="compare">
                <a href="%1s" class="box-icon hover-tooltip '.$class.' %2s" role="button" %3s data-tooltip="%4s" data-tooltip_added="%5s">
                <span class="wcboost-products-compare-button__icon">%s</span>            
                <span class="tooltip">%4s</span>
            </a>
            </li>',
            esc_url( isset( $args['url'] ) ? $args['url'] : add_query_arg( [ 'add-to-compare' => $args['product_id'] ] ) ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : esc_attr( $classes ) ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            wp_kses_post( $label_add ),
            wp_kses_post( $label_added ),
            empty( $args['icon'] ) ? '' :  $args['icon'],
            esc_html( isset( $args['label'] ) ? $args['label'] : __( 'Add to Compare', 'vemus' ) )
        );
    }
}

function tfwc_compare_icon($svg, $icon) {
    if( $icon == 'arrows' ) {
        $product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
        if (isset($_POST['product_style'])) {
            $product_style = sanitize_text_field($_POST['product_style']);
        }
            
        $svg = '<span class="icon icon-compare"></span>';
    } else if( $icon == 'check' ) {
        $svg = '<span class="icon icon-trash"></span>';
    }

    return $svg;
}


if ( class_exists( 'WCBoost\ProductsCompare\Plugin' ) ) {
    $compare_behavior = get_option( 'wcboost_products_compare_added_behavior' );
    if ($compare_behavior != 'popup') {
        add_action('wp_footer', 'tfwc_compare_popup' );
    }
    
}

function tfwc_compare_popup(){
    global $product;
    ?>
        <div class="modal modalCentered fade modal-compare" id="compare" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <span class="icon-close-popup" data-bs-dismiss="modal">
                        <i class="icon-close"></i>
                    </span>
                    <div class="modal-heading">
                        <h3 class="title fw-normal text-uppercase"><?php _e('Compare Products','vemus')?></h3>
                    </div>
                    <div class="modal-body main-list-clear list-file-delete">
                        <div class="tf-compare-inner">
                            <div class="tf-compare-list list-empty">
                                <?php
                                    $items = \WCBoost\ProductsCompare\Plugin::instance()->list->get_items();  
                                    $clear_url = \WCBoost\ProductsCompare\Helper::get_clear_url();
                                    $product_ids = array_values($items);
                                    if ( empty( $product_ids ) ) {
                                        ?>
                                        <p class="text-empty"><?php echo esc_html__('Your compare is curently empty','vemus'); ?></p>
                                        <?php
                                    } else {
                                        foreach ( $product_ids as $product_id ) {
                                            $product = wc_get_product( $product_id );
                                
                                            if ( ! $product ) {
                                                continue;
                                            }
                                            $image_url_large = wp_get_attachment_url( $product->get_image_id() );
                                            $remove_url = \WCBoost\ProductsCompare\Helper::get_remove_url( $product );
                                            ?>
                                            <div class="tf-compare-item card_product--V01 file-delete">
                                                <div class="card_product-wrapper aspect-ratio-1">
                                                    <span class="remove icon-close tf-remove-compare" data-remove-url="<?php echo esc_url($remove_url); ?>"></span>
                                                    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="product-img" target="_blank">
                                                        <img class="img-product lazyload" data-src="<?php echo esc_url($image_url_large); ?>" src="<?php echo esc_url($image_url_large); ?>" alt="<?php echo esc_html($product->get_title()); ?>">
                                                        <img class="img-hover lazyload" data-src="<?php echo esc_url($image_url_large); ?>" src="<?php echo esc_url($image_url_large); ?>" alt="<?php echo esc_html($product->get_title()); ?>">
                                                    </a>
                                                </div>
                                                <div class="card_product-info text-center">
                                                    <a class="name-product link text-line-clamp-2" href="<?php echo esc_url($product->get_permalink()); ?>" target="_blank"><?php echo esc_html($product->get_title()); ?></a>
                                                    <p class="price-wrap justify-content-center tf-price">
                                                        <?php if ($product->is_on_sale() &&  $product->is_type('simple') ) : ?>
                                                            <span class="price-new"><?php echo (wc_price($product->get_sale_price())); ?></span>
                                                            <span class="price-old fw-normal text-caption"><?php echo (wc_price($product->get_regular_price())); ?></span>
                                                        <?php else : ?>
                                                            <span class="price-new"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="group-btn">
                            <a href="<?php echo esc_html(wc_get_page_permalink( 'compare' )); ?>" class="tf-btn btn-fill animate-btn fw-medium" target="_blank">
                                <?php _e('Compare','vemus')?>
                                <?php if(count($product_ids) > 0) : ?>
                                <span class="count-item-compare">(<?php echo esc_html(count($product_ids)); ?>)</span>
                                <?php endif; ?>
                            </a>
                            <a href="#" class="tf-btn fw-medium clear-list-empty tf-clear-compare" data-clear-url="<?php echo esc_url($clear_url); ?>">
                                <span><?php _e('Clear All','vemus')?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
?>