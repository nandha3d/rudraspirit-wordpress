<?php 
// Breadcrumb
$wp_customize->add_setting(
  'breadcrumb_enabled',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('breadcrumb_enabled'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'breadcrumb_enabled',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Breadcrumb ( OFF | ON )', 'vemus'),
        'section' => 'section_breadcrumb',
        'priority' => 1,
    ))
);    

$wp_customize->add_setting (
    'bread_crumb_prefix',
    array(
        'default' => themesflat_customize_default('bread_crumb_prefix') ,
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'bread_crumb_prefix',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Breadcrumb Prefix', 'vemus'),
        'section'   => 'section_breadcrumb',
        'priority'  => 2,
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'breadcrumb_enabled' )->value()
            );
        },
    )
);  

$wp_customize->add_setting (
    'breadcrumb_separator',
    array(
        'default' => themesflat_customize_default('breadcrumb_separator'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'breadcrumb_separator',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Breadcrumb Separator', 'vemus'),
        'section'   => 'section_breadcrumb',
        'priority'  => 3,
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'breadcrumb_enabled' )->value()
            );
        },
    )
);