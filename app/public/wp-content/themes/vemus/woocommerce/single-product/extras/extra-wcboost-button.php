<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if( empty($product) ){
    $product = wc_get_product(get_the_ID());
}

if ( class_exists( 'WCBoost\Wishlist\Helper' ) ) {
    $wishlist = \WCBoost\Wishlist\Helper::get_wishlist( get_query_var( 'wishlist_token' ) );

    $item     = new \WCBoost\Wishlist\Wishlist_Item( $product );

    if( method_exists( 'WCBoost\Wishlist\Templates', 'get_button_template_args' ) ){
        $args = \WCBoost\Wishlist\Templates::get_button_template_args( $wishlist, $item );
    }else{
        $args = \WCBoost\Wishlist\Frontend::instance()->get_button_template_args( $wishlist, $item );
    }

    $is_quick_view_template = get_query_var( 'is_quick_view_template' );
    $is_quick_add_template = get_query_var( 'is_quick_add' );
    if( !$is_quick_view_template && !$is_quick_add_template ){
        $args['class'] = str_replace('wcboost-wishlist-button--ajax', '', $args['class']);
    }
    $args['class'] .= ' wcboost-wishlist-single-button product-extra-icon btn-add-wishlist tf-wishlist-btn tf-btn-icon hover-tooltip';
    $attributes = is_array($args['attributes']) ? $args['attributes'] : [];

    if( !empty($attributes['data-product_id']) ){
        $attributes['data-product-id'] = $attributes['data-product_id'];
        unset($attributes['data-product_id']);
    }

    if ( $wishlist->has_item( $item ) ) {
        $args['class'] .= ' added-wishlist';

        switch ( get_option( 'wcboost_wishlist_exists_item_button_behaviour', 'view_wishlist' ) ) {
            case 'hide':
                $args['class'][] = 'hidden';
                break;

            case 'remove':
                $args['url']        = $item->get_remove_url();
                $attributes['data-remove-url'] = $item->get_remove_url();
                /* translators: %s product name */
                $args['aria-label'] = sprintf( __( 'Remove %s from the wishlist', 'vemus' ), '&ldquo;' . $product->get_title() . '&rdquo;' );
                $args['label']      = \WCBoost\Wishlist\Helper::get_button_text( 'remove' );
                $args['icon'] = '<span class="icon icon-trash"></span>';
                break;

            case 'view_wishlist':
                $args['url']        = wc_get_page_permalink( 'wishlist' );
                $args['aria-label'] = __( 'Open the wishlist', 'vemus' );
                $args['label']      = \WCBoost\Wishlist\Helper::get_button_text( 'view' );
                break;
        }
    }

    $args['attributes'] = $attributes;

}

?>
<div class="group-btn-action">
    <?php if(themesflat_get_opt('tf_wishlist') && class_exists( 'WCBoost\Wishlist\Helper' )): ?>
        <?php
        wc_get_template( 'single-product/add-to-wishlist.php', $args);
        ?>
    <?php endif; ?>
    <?php if(class_exists( 'WCBoost\ProductsCompare\Helper' )): ?>
        <?php
            if( $is_quick_view_template || $is_quick_add_template ) :
                echo do_shortcode('[wcboost_compare_button]');
            else:
        ?>
            <a href="#compare" data-bs-toggle="" class="tf-compare-btn tf-btn-icon hover-tooltip" data-product-id="<?php echo esc_attr($product->get_id() ); ?>">
                <span class="icon icon-compare"></span>
                <span class="tooltip">
                    <?php echo esc_html__('Compare', 'vemus'); ?>
                </span>
            </a>
        <?php endif; ?>
    <?php endif; ?>
</div>