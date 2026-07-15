<?php

$wp_customize->add_setting(
    'progress_sale_title',
    array(
        'default'   => themesflat_customize_default('progress_sale_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'progress_sale',
    array(
        'default' => themesflat_customize_default('progress_sale'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'progress_sale_text',
    array(
        'default' => themesflat_customize_default('progress_sale_text'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting( 
    'progress_sale_subtext',
    array(
        'default' => themesflat_customize_default('progress_sale_subtext'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'progress_sale_low_stock',
    array(
        'default' => themesflat_customize_default('progress_sale_low_stock'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_control( new themesflat_Info( $wp_customize,
    'progress_sale_title',
    array(
        'label' => esc_html__('Progress bar', 'vemus'),
        'section' => 'section_progress_sale',
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'progress_sale',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Enable ( OFF | ON )', 'vemus'),
        'section' => 'section_progress_sale',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'progress_sale_text',
    array(
        'label' => esc_html__('Text', 'vemus'),
        'type' => 'text',
        'section' => 'section_progress_sale',
        'active_callback' => fn() => check_setting_is_on( 'progress_sale' )
    ))
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'progress_sale_subtext',
    array(
        'label' => esc_html__('Sub Text', 'vemus'),
        'type' => 'text',
        'section' => 'section_progress_sale',
        'input_attrs' => array(
            'placeholder' => esc_html__(' {count} items.', 'vemus'),
        ),
        'active_callback' => fn() => check_setting_is_on( 'progress_sale' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'progress_sale_low_stock',
    array(
        'label' => esc_html__('Low stock', 'vemus'),
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1,
        ),
        'section' => 'section_progress_sale',
        'active_callback' => fn() => check_setting_is_on( 'progress_sale' )
    ) )
);