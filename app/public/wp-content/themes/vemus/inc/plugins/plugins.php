<?php
// Register action to declare required plugins
add_action('tgmpa_register', 'themesflat_recommend_plugin');
function themesflat_recommend_plugin() {
    
    $plugins = array(
        array(
            'name' => esc_html__('Elementor', 'vemus'),
            'slug' => 'elementor',
            'required' => true
        ),
        array(
            'name' => esc_html__('Vemus Addon', 'vemus'),
            'slug' => 'vemus-addon',
            'source' => esc_url('http://vemus.wpvineta.com/wp-content/demo/vemus-addon.zip'),
            'required' => true
        ),  
        array(
            'name' => esc_html__('Contact Form 7', 'vemus'),
            'slug' => 'contact-form-7',
            'required' => false
        ),    
        array(
            'name' => esc_html__('Mailchimp', 'vemus'),
            'slug' => 'mailchimp-for-wp',
            'required' => false
        ),        
        array(
            'name' => esc_html__('WooCommerce', 'vemus'),
            'slug' => 'woocommerce',
            'required' => true
        ),
        array(
            'name' => esc_html__('One Click Demo Import', 'vemus'),
            'slug' => 'one-click-demo-import',
            'required' => false
        ),
        array(
            'name' => esc_html__('WCBoost - Wishlist', 'vemus'),
            'slug' => 'wcboost-wishlist',
            'required' => true
        ),
        array(
            'name' => esc_html__('WCBoost - Variation Swatches', 'vemus'),
            'slug' => 'wcboost-variation-swatches',
            'required' => true
        ),
        array(
            'name' => esc_html__('WCBoost - Products Compare', 'vemus'),
            'slug' => 'wcboost-products-compare',
            'required' => true
        ),

    );
    
    tgmpa($plugins);
}

