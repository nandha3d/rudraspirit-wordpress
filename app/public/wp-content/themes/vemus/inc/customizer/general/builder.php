<?php 
$wp_customize->add_setting(
  'shop_builder',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('shop_builder'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'shop_builder',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Archive Builder ( OFF | ON )', 'vemus'),
        'section' => 'section_builder',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
  'cart_builder',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('cart_builder'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'cart_builder',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Cart Builder ( OFF | ON )', 'vemus'),
        'section' => 'section_builder',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
  'checkout_builder',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('checkout_builder'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'checkout_builder',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Checkout Builder ( OFF | ON )', 'vemus'),
        'section' => 'section_builder',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
  '404_builder',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('404_builder'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    '404_builder',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('404 Page Builder ( OFF | ON )', 'vemus'),
        'section' => 'section_builder',
        'priority' => 2,
    ))
);
