<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter( 'wcboost_wishlist_add_to_wishlist_fragments', 'tfwc_wishlist_count', 10, 1 );
add_filter( 'wcboost_wishlist_svg_icon', 'tfwc_wishlish_icon' , 20, 2 );
add_filter( 'wcboost_wishlist_loop_add_to_wishlist_link', 'tfwc_wishlish_button' , 20, 2 );

function tfwc_wishlish_button($html, $args) {

    $classes = is_singular( 'product' ) ? 'wcboost-wishlist-button wcboost-wishlist-button--single button tf-btn-icon' : 'wcboost-wishlist-button wcboost-wishlist-button--theme button';

    $label_add = \WCBoost\Wishlist\Helper::get_button_text( 'add' );
    $label_added = \WCBoost\Wishlist\Helper::get_button_text( 'remove' );

    if( get_option( 'wcboost_wishlist_exists_item_button_behaviour' ) == 'view_wishlist' ) {
        $label_added = \WCBoost\Wishlist\Helper::get_button_text( 'view' );
    }

    $product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');

    if (isset($_POST['product_style'])) {
        $product_style = sanitize_text_field($_POST['product_style']);
    }
    
    

    $class = '';
    if($product_style == 'style-2' || $product_style == 'style-3' || $product_style == 'style-list') {
        $class = ' tooltip-top ';
    } else {
        $class = ' tooltip-left ';
    }

    if($product_style == 'style-4' || $product_style == 'style-5'){
        $class .= ' bg-surface';
    }


    if($product_style == 'style-wishlist style-3') {
        return sprintf(
            '<li class="wishlist product-remove">
                <a href="%1s" class="box-icon hover-tooltip '.$class.' %2s" role="button" %3s data-tooltip="%4s" data-tooltip_added="%5s">
                    <span class="wcboost-wishlist-button__icon">%6s</span>            
                    <span class="tooltip">%4s</span>
                </a>
            </li>',
            esc_url( isset( $args['url'] ) ? $args['url'] : add_query_arg( [ 'add-to-compare' => $args['product_id'] ] ) ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : esc_attr( $classes ) ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            wp_kses_post( $label_add ),
            wp_kses_post( $label_added ),
            empty( $args['icon'] ) ? '' :  $args['icon'],
            esc_html( isset( $args['label'] ) ? $args['label'] : __( 'Add to wishlist', 'vemus' ) )
        );
    } elseif($product_style == 'style-list') {
        return sprintf(
            '<a href="%1s" class="box-icon hover-tooltip wishlist '.$class.'  tooltip-top %2s" role="button" %3s data-tooltip="%4s" data-tooltip_added="%5s">
                <span class="wcboost-wishlist-button__icon">%s</span>            
                <span class="tooltip">%4s</span>
            </a>',
            esc_url( isset( $args['url'] ) ? $args['url'] : add_query_arg( [ 'add-to-compare' => $args['product_id'] ] ) ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : esc_attr( $classes ) ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            wp_kses_post( $label_add ),
            wp_kses_post( $label_added ),
            empty( $args['icon'] ) ? '' :  $args['icon'],
            esc_html( isset( $args['label'] ) ? $args['label'] : __( 'Add to wishlist', 'vemus' ) )
        );
    } else {
        return sprintf(
            '
                <a href="%1s" class="box-icon hover-tooltip '.$class.' %2s" role="button" %3s data-tooltip="%4s" data-tooltip_added="%5s">
                    <span class="wcboost-wishlist-button__icon">%6s</span>            
                    <span class="tooltip">%4s</span>
                </a>
            ',
            esc_url( isset( $args['url'] ) ? $args['url'] : add_query_arg( [ 'add-to-compare' => $args['product_id'] ] ) ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : esc_attr( $classes ) ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            wp_kses_post( $label_add ),
            wp_kses_post( $label_added ),
            empty( $args['icon'] ) ? '' :  $args['icon'],
            esc_html( isset( $args['label'] ) ? $args['label'] : __( 'Add to wishlist', 'vemus' ) )
        );
    }
}

function tfwc_wishlish_icon($svg, $icon) {
    
    if ( function_exists( 'wcboost_wishlist' ) ) {
        $product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
       
        if (isset($_POST['product_style'])) {
            $product_style = sanitize_text_field($_POST['product_style']);
        }
        if($product_style == 'style-wishlist style-3') {
            if( $icon == 'heart' ) {
                $svg = '<span class="icon icon icon-heart-2"></span>';
            } else if( $icon == 'heart-filled' && get_option( 'wcboost_wishlist_exists_item_button_behaviour' ) == 'remove' ) {
                $svg = '<span class="icon icon-close remove"></span>';
            }     
        } else {
            if( $icon == 'heart' ) {
                $svg = '<span class="icon icon icon-heart-2"></span>';
            } else if( $icon == 'heart-filled' && get_option( 'wcboost_wishlist_exists_item_button_behaviour' ) == 'remove' ) {
                $svg = '<span class="icon icon-trash"></span>';
            }
        }
    } 
    return $svg;
}

function tfwc_wishlist_count($data) {
    $wishlist = \WCBoost\Wishlist\Helper::get_wishlist();
    $wishlist_count = intval( $wishlist->count_items() );

    $data['.wishlist-btn-fragment .count-box'] = '<span class="count-box">'. $wishlist_count . '</span>';

    return $data;
}

?>
