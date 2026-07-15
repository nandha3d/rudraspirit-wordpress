<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if( !function_exists('tf_wishlist_remove_icon_open') ){
	function tf_wishlist_remove_icon_open(){
		echo '<span class="remove icon-close">';
	}
}

if( !function_exists('tf_wishlist_remove_icon_close') ){
	function tf_wishlist_remove_icon_close(){
		echo '</span>';
	}
}

// Action Hook

if( class_exists('\WCBoost\Wishlist\Frontend') ) {

	add_action( 'woocommerce_before_shop_loop_item', 'tf_wishlist_remove_icon_open', 5 );
	add_action( 'woocommerce_before_shop_loop_item', array( \WCBoost\Wishlist\Frontend::instance(), 'loop_add_to_wishlist_button' ), 5 );
	add_action( 'woocommerce_before_shop_loop_item', 'tf_wishlist_remove_icon_close', 5 );

}

add_action( 'woocommerce_before_shop_loop_item', 'tfwc_class_thumnail_open' ,5);

add_action('woocommerce_before_shop_loop_item_title','tfwc_thumnail' ,10 );

add_action('woocommerce_before_shop_loop_item_title','tfwc_badges' ,22 );

add_action('woocommerce_before_shop_loop_item_title','tfwc_class_wrap_btn_open' ,25 );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 27 );

add_action( 'woocommerce_before_shop_loop_item_title', 'tfwc_quickview_button' , 40 );

if( class_exists('\WCBoost\ProductsCompare\Frontend') ) {
	add_action( 'woocommerce_before_shop_loop_item_title', array( \WCBoost\ProductsCompare\Frontend::instance(), 'loop_add_to_compare_button' ), 45 );
}

add_action( 'woocommerce_before_shop_loop_item_title', 'tfwc_class_wrap_btn_close' ,70);

add_action( 'woocommerce_before_shop_loop_item_title', 'tfwc_countdown' ,75);

add_action( 'woocommerce_before_shop_loop_item_title', 'tfwc_class_thumnail_close' ,80);

add_action('woocommerce_after_shop_loop_item_title','tfwc_class_content_open' ,20 );

add_action('woocommerce_after_shop_loop_item_title','tfwc_rating' ,22 );
add_action('woocommerce_after_shop_loop_item_title','tfwc_category' ,23 );
add_action('woocommerce_after_shop_loop_item_title','tfwc_title' ,25 );
add_action('woocommerce_after_shop_loop_item_title','tfwc_price' ,30 );
add_action('woocommerce_after_shop_loop_item_title','tfwc_attribute_second' ,40 );
add_action('woocommerce_after_shop_loop_item_title','tfwc_progressbar' ,45 );
add_action('woocommerce_after_shop_loop_item_title','tfwc_in_out_stock' ,50 );

add_action('woocommerce_after_shop_loop_item_title','tfwc_class_content_close' ,100 );