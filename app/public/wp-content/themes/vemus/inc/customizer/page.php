<?php 

require THEMESFLAT_DIR . "inc/customizer/page/page-wishlist.php";

$wp_customize->add_section('section_cart_page',array(
    'title'         => 'Cart Page',
    'priority'      => 1,
    'panel'         => 'woocommerce',
));
require THEMESFLAT_DIR . "inc/customizer/page/page-cart.php";

$wp_customize->add_section('section_checkout_page',array(
    'title'         => 'Checkout Page',
    'priority'      => 1,
    'panel'         => 'woocommerce',
));
require THEMESFLAT_DIR . "inc/customizer/page/page-checkout.php";

