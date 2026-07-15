<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// Function

function tfwc_class_thumnail_open() {		
    echo '<div class="card_product-wrapper">';
}

function tfwc_class_thumnail_close() {	
    global $product;
    if( $product->get_stock_status() == "outofstock" && themesflat_get_opt('show_out_stock_btn')){
    ?>
        <a href="#unavailable" data-bs-toggle="modal" class="variant-box stock bg-main link text-white d-none d-md-block">
            <p class="text-center">
                <?php echo esc_html(themesflat_get_opt('out_stock_btn_text')); ?>
            </p>
        </a>
    <?php
    }

    if( $product->get_stock_status() == "instock" && !empty( $product->get_meta('_tfwc_sale_marquee_text') ) ){
        wc_get_template( 'tpl/product-base/sale-marquee.php' );
    }

    echo '</div>';
}

function tfwc_class_content_open() {		
    echo '<div class="card_product-info">';
}

function tfwc_class_content_close() {		
    echo '</div>';
}

function tfwc_class_wishlist_open() {		
    echo '<li class="wishlist">';
}

function tfwc_class_wishlist_close() {		
    echo '</li>';
}

function tfwc_class_wrap_btn_open() {	
    $product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
    if (isset($_POST['product_style'])) {
        $product_style = sanitize_text_field($_POST['product_style']);
    }
    if($product_style == 'style-list'){
        echo '<div class="list-product-btn">';
    } else {
        echo '<ul class="list-product-btn">';
    }  
}

function tfwc_class_wrap_btn_close() {		
    $product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
    if (isset($_POST['product_style'])) {
        $product_style = sanitize_text_field($_POST['product_style']);
    }
    if($product_style == 'style-list'){
        echo '</div>';
    } else {
        echo '</ul>';
    }
    
}

function tfwc_thumnail() {			
    echo tfwc_get_template_part('/product-base/thumnail.php' );
}

function tfwc_title() {			
     echo tfwc_get_template_part( '/product-base/title.php' );
}

function tfwc_price() {		
    echo tfwc_get_template_part( '/product-base/price.php' );
}

function tfwc_attribute_first() {		
    echo tfwc_get_template_part( '/product-base/attribute-first.php' );
}

function tfwc_attribute_second() {
    echo tfwc_get_template_part( '/product-base/attribute-second.php' );
}

function tfwc_badges() {	
    if( themesflat_get_opt('show_badges') == 1) {		
        echo tfwc_get_template_part( '/product-base/badges.php' );
    }
}

function tfwc_rating() {
    if( themesflat_get_opt('show_rating') == 1) {		
        echo tfwc_get_template_part( '/product-base/rating.php' );
    }
}

function tfwc_in_out_stock() {	
    if( themesflat_get_opt('show_in_out_stock') == 1) {	
        echo tfwc_get_template_part( '/product-base/in-out-stock.php' );
    }
}

function tfwc_countdown() {		
    if( themesflat_get_opt('show_countdown') == 1) {
        echo tfwc_get_template_part( '/product-base/countdown.php' );
    }
}

function tfwc_progressbar() {
    if( themesflat_get_opt('show_progressbar') == 1) {			
        echo tfwc_get_template_part( '/product-base/progressbar.php' );
    }
}

function tfwc_description() {	
    if( themesflat_get_opt('show_description') == 1) {		
        echo tfwc_get_template_part( '/product-base/description.php' );
    }
}

function tfwc_category() {		
    if( themesflat_get_opt('show_category') == 1) {	
        echo tfwc_get_template_part( '/product-base/category.php' );
    }
}

?>