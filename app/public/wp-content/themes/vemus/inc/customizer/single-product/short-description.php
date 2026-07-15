<?php

$wp_customize->add_setting(
    'tf_short_desc_title',
    array(
        'default'   => themesflat_customize_default('size_guide_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'tf_short_desc',
    array(
        'default' => themesflat_customize_default('tf_short_desc'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_control( new themesflat_Info( $wp_customize,
    'tf_short_desc_title',
    array(
        'label' => esc_html__('Short Description', 'vemus'),
        'section' => 'section_short_desc',
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tf_short_desc',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Enable ( OFF | ON )', 'vemus'),
        'section' => 'section_short_desc',
    ) )
);