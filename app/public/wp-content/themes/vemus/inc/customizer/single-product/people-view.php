<?php

$wp_customize->add_setting(
    'fake_view_title',
    array(
        'default'   => themesflat_customize_default('fake_view_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'fake_view',
    array(
        'default' => themesflat_customize_default('fake_view'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'fake_view_random_from',
    array(
        'default' => themesflat_customize_default('fake_view_random_from'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting( 
    'fake_view_random_to',
    array(
        'default' => themesflat_customize_default('fake_view_random_to'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting( 
    'fake_view_interval',
    array(
        'default' => themesflat_customize_default('fake_view_interval'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'fake_view_text',
    array(
        'default' => themesflat_customize_default('fake_view_text'),
        'sanitize_callback' => 'esc_attr',
    )   
); 

$wp_customize->add_control( new themesflat_Info( $wp_customize,
    'fake_view_title',
    array(
        'label' => esc_html__('Fake people view', 'vemus'),
        'section' => 'section_people_view',
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'fake_view',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Enable ( OFF | ON )', 'vemus'),
        'section' => 'section_people_view',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'fake_view_random_from',
    array(
        'label' => esc_html__('Random from', 'vemus'),
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1,
        ),
        'section' => 'section_people_view',
        'active_callback' => fn() => check_setting_is_on( 'fake_view' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'fake_view_random_to',
    array(
        'label' => esc_html__('Random to', 'vemus'),
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1,
        ),
        'section' => 'section_people_view',
        'active_callback' => fn() => check_setting_is_on( 'fake_view' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'fake_view_interval',
    array(
        'label' => esc_html__('Interval(milliseconds )', 'vemus'),
        'type' => 'number',
        'input_attrs' => array(
            'min' => 100,
            'step' => 100
        ),
        'section' => 'section_people_view',
        'active_callback' => fn() => check_setting_is_on( 'fake_view' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'fake_view_text',
    array(
        'label' => esc_html__('Text', 'vemus'),
        'type' => 'text',
        'section' => 'section_people_view',
        'active_callback' => fn() => check_setting_is_on( 'fake_view' )
    ) )
);