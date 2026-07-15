<?php 
$wp_customize->add_setting(
    'header_search_box_menu',
    array(
        'default' => themesflat_customize_default('header_search_box_menu'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_search_box_menu',
    array(
        'label' => esc_html__( 'Menu Title', 'vemus' ),
        'section' => 'section_search',
        'type' => 'text',
    )
);

$wp_customize->add_setting(
    'header_search_box_product',
    array(
        'default' => themesflat_customize_default('header_search_box_product'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_search_box_product',
    array(
        'label' => esc_html__( 'Product Related Title', 'vemus' ),
        'section' => 'section_search',
        'type' => 'text',
    )
);
