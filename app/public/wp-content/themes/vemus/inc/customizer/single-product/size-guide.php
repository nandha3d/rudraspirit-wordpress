<?php

$wp_customize->add_setting(
    'tf_size_guide_title',
    array(
        'default'   => themesflat_customize_default('size_guide_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'tf_size_guide',
    array(
        'default' => themesflat_customize_default('tf_size_guide'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_size_guide_display',
    array(
        'default' => themesflat_customize_default('tf_size_guide_display'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_size_guide_button_position',
    array(
        'default' => themesflat_customize_default('tf_size_guide_button_position'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_size_guide_attribute',
    array(
        'default' => themesflat_customize_default('tf_size_guide_attribute'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_control( new themesflat_Info( $wp_customize,
    'tf_size_guide_title',
    array(
        'label' => esc_html__('Size guide', 'vemus'),
        'section' => 'section_size_guide',
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tf_size_guide',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Enable ( OFF | ON )', 'vemus'),
        'section' => 'section_size_guide',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_size_guide_display',
    array(
        'label' => esc_html__('Display', 'vemus'),
        'type' => 'select',
        // 'description' => esc_html__( 'This is a custom select option.', 'vemus' ),
        'choices' => array(
            'tabs' => esc_html__( 'Product tabs' , 'vemus' ),
            'button' => esc_html__( 'Button', 'vemus' ),
        ),
        'section' => 'section_size_guide',
        'active_callback' => fn() => check_setting_is_on( 'tf_size_guide' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_size_guide_button_position',
    array(
        'label' => esc_html__('Button Position', 'vemus'),
        'type' => 'select',
        // 'description' => esc_html__( 'This is a custom select option.', 'vemus' ),
        'choices' => array(
            'price' => esc_html__( 'Default (Bellow price)', 'vemus' ),
            'attribute' => esc_html__( 'Size attribute' , 'vemus' ),
            'add-to-cart' => esc_html__( 'Bellow Add to cart button', 'vemus' ),
            'short-desc' => esc_html__( 'Bellow short description', 'vemus' ),
        ),
        'section' => 'section_size_guide',
        'active_callback' => fn() => check_setting_is_on( 'tf_size_guide' ) && check_setting_is_on( 'tf_size_guide_display', 'button' )
    ) )
);

$attribute_taxonomies = wc_get_attribute_taxonomies();

$attribute_options = array();

foreach ($attribute_taxonomies as $attribute) {
    $attribute_options[$attribute->attribute_name] = ucfirst(str_replace('pa_', '', $attribute->attribute_name));
}

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_size_guide_attribute',
    array(
        'label' => esc_html__('Attribute', 'vemus'),
        'type' => 'select',
        'choices' => $attribute_options,
        'section' => 'section_size_guide',
        'active_callback' => fn() => check_setting_is_on( 'tf_size_guide' ) && check_setting_is_on( 'tf_size_guide_display', 'button' ) && check_setting_is_on( 'tf_size_guide_button_position', 'attribute' )
    ) )
);