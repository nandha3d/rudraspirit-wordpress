<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
add_filter( 'woocommerce_add_to_cart_fragments', 'tfwc_add_to_cart_fragment' );



function tfwc_add_to_cart( $html, $product, $args ) {
    if ($product->is_type( 'variable' )) {
		$args['attributes']['data-bs-target'] = '#quickshop';
    }

  
    $product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');

    if (isset($_POST['product_style'])) {
        $product_style = sanitize_text_field($_POST['product_style']);
    }

    

    $class = '';
    if($product_style == 'style-2' || $product_style == 'style-3' || $product_style == 'style-wishlist style-3') {
        $class = ' tooltip-top ';
    } else {
        $class = ' tooltip-left ';
    }

    if($product_style == 'style-4' || $product_style == 'style-5'){
        $class .= ' bg-surface';
    }

    if($product_style == 'style-3') {
        echo sprintf(
            '<div class="product-btn-main">
                <a href="%1s" data-quantity="%2s" class="tf_add_to_cart btn-main-product %3s"  %4s> 
                    <span class="icon icon-shop-cart"></span>
                    <span class="text-md fw-medium">%4s</span>
                </a>
            </div>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() ),
        );
    } elseif($product_style == 'style-list') {
        echo sprintf(
                '<a href="%1s" data-quantity="%2s" class="tf_add_to_cart tf-btn btn-main-product animate-btn %3s"  %4s> 
                    <span class="text-md fw-medium">%4s</span>
                </a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() ),
        );
    } else {      
       
        echo sprintf(
            '<li>
                <a href="%1s" data-quantity="%2s" class="tf_add_to_cart hover-tooltip '.$class.' box-icon %3s"  %4s> 
                    <span class="icon icon-shop-cart"></span>
                    <span class="tooltip">%4s</span>
                </a>
            </li>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() ),
        );
    }

    
}

function tfwc_add_to_cart_fragment( $data ) {

    $item_count = sprintf(
        _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'vemus' ),
        WC()->cart->get_cart_contents_count()
    );
    
            
     $data['.nav-cart a.nav-icon-item .shopping-cart-items-count'] = '<span class="count-box shopping-cart-items-count">'. esc_html( $item_count ).'</span>';

    return $data;
}


add_action('wp_ajax_tfwc_update_cart_item', 'tfwc_update_cart_item'); 
add_action('wp_ajax_nopriv_tfwc_update_cart_item', 'tfwc_update_cart_item'); 

function tfwc_update_cart_item() {
    if ( ! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'tfwc_nonce') ) {
        wp_send_json_error('Invalid nonce');
        return;
    }

    $cart_item_key 	= sanitize_text_field( $_POST['cart_item_key'] );
    $quantity 		= (int) sanitize_text_field( $_POST['quantity'] );
    if( !empty( $cart_item_key ) ){
        $cart =  WC()->cart->get_cart();
        if( isset($cart[$cart_item_key]) ){
            $quantity = apply_filters( 'woocommerce_stock_amount_cart_item', wc_stock_amount( preg_replace( '/[^0-9\.]/', '', $quantity ) ), $cart_item_key );
            if( !($quantity === '' || $quantity === $cart[$cart_item_key]['quantity']) ){
                if( !($cart[$cart_item_key]['data']->is_sold_individually() && $quantity > 1) ){
                    WC()->cart->set_quantity( $cart_item_key, $quantity, false );
                    $cart_updated = apply_filters( 'woocommerce_update_cart_action_cart_updated', true );
                    if( $cart_updated ){
                        WC()->cart->calculate_totals();
                    }
                }
            }
        }
        WC_AJAX::get_refreshed_fragments();
    }	
}


function tfwc_product_add_to_cart_text($text, $product) {
    if( $product && $product->get_type() == 'variable' ) {
        $text = esc_html__( 'Quick Add', 'vemus' );
    }

    return $text;
}

add_filter( 'woocommerce_product_add_to_cart_text', 'tfwc_product_add_to_cart_text', 10, 2 );

?>