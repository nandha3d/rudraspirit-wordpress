<?php 
// Customize Services Featured Title
$wp_customize->add_setting (
    'product_featured_title',
    array(
        'default' => themesflat_customize_default('product_featured_title'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'product_featured_title',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Customize Product Featured Title', 'vemus'),
        'section'   => 'section_shop_single',
        'priority'  => 1
    )
);

// Related Products
$wp_customize->add_setting( 
  'related_products',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('related_products'),     
    )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'related_products',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Related Products ( OFF | ON )', 'vemus'),
        'section' => 'section_shop_single',
        'priority' => 3,
    ))
);