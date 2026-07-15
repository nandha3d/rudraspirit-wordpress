<?php

$wp_customize->add_setting(
    'tf_extra_link_title',
    array(
        'default'   => themesflat_customize_default('tf_extra_link_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'extra_link',
    array(
        'default' => themesflat_customize_default('extra_link'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting(
    'extra_link_description',
    array(
        'default' => themesflat_customize_default('extra_link_description'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting(
    'extra_link_shipping',
    array(
        'default' => themesflat_customize_default('extra_link_shipping'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting(
    'extra_link_ask_question',
    array(
        'default' => themesflat_customize_default('extra_link_ask_question'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )
);

$wp_customize->add_setting( 
    'extra_link_description_btn_text',
    array(
        'default' => themesflat_customize_default('extra_link_description_btn_text'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'extra_link_shipping_btn_text',
    array(
        'default' => themesflat_customize_default('extra_link_shipping_btn_text'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'extra_link_ask_question_btn_text',
    array(
        'default' => themesflat_customize_default('extra_link_ask_question_btn_text'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'extra_link_description_title',
    array(
        'default' => themesflat_customize_default('extra_link_description_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'extra_link_shipping_title',
    array(
        'default' => themesflat_customize_default('extra_link_shipping_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'extra_link_ask_question_title',
    array(
        'default' => themesflat_customize_default('extra_link_ask_question_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'extra_link_shipping_content',
    array(
        'default' => themesflat_customize_default('extra_link_shipping_content'),
        'sanitize_callback' => 'themesflat_sanitize_raw',
    )
);

$wp_customize->add_setting( 
    'extra_link_ask_question_content',
    array(
        'default' => themesflat_customize_default('extra_link_ask_question_content'),
        'sanitize_callback' => 'themesflat_sanitize_raw',
    )
);

$wp_customize->add_control( new themesflat_Info( $wp_customize,
    'tf_extra_link_title',
    array(
        'label' => esc_html__('Extra Link', 'vemus'),
        'section' => 'section_extra_link',
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'extra_link',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Enable ( OFF | ON )', 'vemus'),
        'section' => 'section_extra_link',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_description',
    array(
        'label' => esc_html__('Description', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_description_btn_text',
    array(
        'label' => esc_html__('Button text', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link_description' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_description_title',
    array(
        'label' => esc_html__('Title', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link_description' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_shipping',
    array(
        'label' => esc_html__('Shipping', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_shipping_btn_text',
    array(
        'label' => esc_html__('Button text', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link_shipping' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_shipping_title',
    array(
        'label' => esc_html__('Title', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link_shipping' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_shipping_content',
    array(
        'label' => esc_html__('Content', 'vemus'),
        'type' => 'textarea',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link_shipping' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_ask_question',
    array(
        'label' => esc_html__('Ask a question', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_ask_question_btn_text',
    array(
        'label' => esc_html__('Button text', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link_ask_question' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_ask_question_title',
    array(
        'label' => esc_html__('Title', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link_ask_question' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'extra_link_ask_question_content',
    array(
        'label' => esc_html__('Content', 'vemus'),
        'type' => 'textarea',
        'input_attrs' => array(
            'placeholder' => '[contact-form-7 id="123" title="Contact form 1"]',
        ),
        'section' => 'section_extra_link',
        'active_callback' => fn() => check_setting_is_on( 'extra_link_ask_question' )
    ) )
);