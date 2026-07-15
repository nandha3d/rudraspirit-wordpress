<?php

$wp_customize->add_setting( 
    'tf_wishlist',
    array(
        'default' => themesflat_customize_default('tf_wishlist'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tf_wishlist',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Button positon by theme ', 'vemus'),
        'section' => 'wcboost_wishlist_button',
    ) )
);