<?php

$wp_customize->add_setting(
    'tf_product_tabs_position',
    array(
        'default'           => themesflat_customize_default('tf_product_tabs_position'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'tf_product_tabs_style',
    array(
        'default'           => themesflat_customize_default('tf_product_tabs_style'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'tf_product_tabs_style_bellow_cart',
    array(
        'default'           => themesflat_customize_default('tf_product_tabs_style_bellow_cart'),
        'sanitize_callback' => 'esc_attr',
    )
);

// TABS Settings
$wp_customize->add_setting(
    'tf_product_description_tab',
    array(
        'default' => themesflat_customize_default('tf_product_description_tab'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )
);

$wp_customize->add_setting(
    'tf_product_additional_info_tab',
    array(
        'default' => themesflat_customize_default('tf_product_additional_info_tab'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )
);

$wp_customize->add_setting(
    'tf_product_reviews_tab',
    array(
        'default' => themesflat_customize_default('tf_product_reviews_tab'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )
);

$wp_customize->add_setting(
    'tf_product_shipping_tab',
    array(
        'default' => themesflat_customize_default('tf_product_shipping_tab'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting(
    'tf_product_ask_question_tab',
    array(
        'default' => themesflat_customize_default('tf_product_ask_question_tab'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )
);

$wp_customize->add_setting(
    'tf_product_description_icon',
    array(
        'default' => themesflat_customize_default('tf_product_description_icon'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'tf_product_additional_info_icon',
    array(
        'default' => themesflat_customize_default('tf_product_additional_info_icon'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'tf_product_reviews_icon',
    array(
        'default' => themesflat_customize_default('tf_product_reviews_icon'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'tf_product_shipping_icon',
    array(
        'default' => themesflat_customize_default('tf_product_shipping_icon'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'tf_product_ask_question_icon',
    array(
        'default' => themesflat_customize_default('tf_product_ask_question_icon'),
        'sanitize_callback' => 'esc_attr',
    )
);

// Buttom Text
$wp_customize->add_setting(
    'tf_product_shipping_text',
    array(
        'default' => themesflat_customize_default('tf_product_shipping_text'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'tf_product_ask_question_text',
    array(
        'default' => themesflat_customize_default('tf_product_ask_question_text'),
        'sanitize_callback' => 'esc_attr',
    )
);

// Title
$wp_customize->add_setting(
    'tf_product_shipping_title',
    array(
        'default' => themesflat_customize_default('tf_product_shipping_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'tf_product_ask_question_title',
    array(
        'default' => themesflat_customize_default('tf_product_ask_question_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

// Content
$wp_customize->add_setting( 
    'tf_product_shipping_content',
    array(
        'default' => themesflat_customize_default('tf_product_shipping_content'),
        'sanitize_callback' => 'themesflat_sanitize_raw',
    )
);

$wp_customize->add_setting( 
    'tf_product_ask_question_content',
    array(
        'default' => themesflat_customize_default('tf_product_ask_question_content'),
        'sanitize_callback' => 'themesflat_sanitize_raw',
    )
);

// CONTROLS

$wp_customize->add_control(
    'tf_product_tabs_position',
    array(
        'type'      => 'select',           
        'section'   => 'section_tabs',
        'label'     => esc_html__('Product Tabs Position', 'vemus'),
        'choices'   => array(
            'default'       => esc_html__( 'Default', 'vemus' ),
            'below_cart'    => esc_html__( 'Below Add to Cart form', 'vemus' ),
            'in_summary'    => esc_html__( 'Inside Product Summary', 'vemus' ),
        ),
    )
);

$wp_customize->add_control(
    'tf_product_tabs_style',
    array(
        'type'      => 'select',           
        'section'   => 'section_tabs',
        'label'     => esc_html__('Product Tabs Style', 'vemus'),
        'choices'   => array(
            'default'     => esc_html__( 'Default', 'vemus' ),
            'verticle'     => esc_html__( 'Verticle', 'vemus' ),
            'accordion'     => esc_html__( 'Accordion', 'vemus' ),
        ),
        'active_callback' => fn() => check_setting_is_on( 'tf_product_tabs_position', 'default' )
    )
);

$wp_customize->add_control(
    'tf_product_tabs_style_bellow_cart',
    array(
        'type'      => 'select',           
        'section'   => 'section_tabs',
        'label'     => esc_html__('Product Tabs Style', 'vemus'),
        'choices'   => array(
            'accordion'     => esc_html__( 'Accordion', 'vemus' ),
            'sidebar'     => esc_html__( 'Sidebar', 'vemus')
        ),
        'active_callback' => fn() => check_setting_is_on( 'tf_product_tabs_position', 'below_cart' )
    )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_description_tab',
    array(
        'label' => esc_html__('Description', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_tabs',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_description_icon',
    array(
        'label' => esc_html__('Icon class', 'vemus'),
        'type' => 'text',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_description_tab' ) && check_setting_is_on( 'tf_product_tabs_style_bellow_cart', 'sidebar' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_additional_info_tab',
    array(
        'label' => esc_html__('Additional information', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_tabs',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_additional_info_icon',
    array(
        'label' => esc_html__('Icon class', 'vemus'),
        'type' => 'text',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_additional_info_tab' ) && check_setting_is_on( 'tf_product_tabs_style_bellow_cart', 'sidebar' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_reviews_tab',
    array(
        'label' => esc_html__('Reviews', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_tabs',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_reviews_icon',
    array(
        'label' => esc_html__('Icon class', 'vemus'),
        'type' => 'text',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_reviews_tab' ) && check_setting_is_on( 'tf_product_tabs_style_bellow_cart', 'sidebar' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_shipping_tab',
    array(
        'label' => esc_html__('Shipping', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_tabs',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_shipping_icon',
    array(
        'label' => esc_html__('Icon class', 'vemus'),
        'type' => 'text',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_shipping_tab' ) && check_setting_is_on( 'tf_product_tabs_style_bellow_cart', 'sidebar' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_shipping_text',
    array(
        'label' => esc_html__('Text', 'vemus'),
        'type' => 'text',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_shipping_tab' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_shipping_title',
    array(
        'label' => esc_html__('Title', 'vemus'),
        'type' => 'text',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_shipping_tab' ) && check_setting_is_on( 'tf_product_tabs_style_bellow_cart', 'sidebar' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_shipping_content',
    array(
        'label' => esc_html__('Content', 'vemus'),
        'type' => 'textarea',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_shipping_tab' )
    ) )
);

//Ask a Question

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_ask_question_tab',
    array(
        'label' => esc_html__('Ask a Question', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_tabs',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_ask_question_icon',
    array(
        'label' => esc_html__('Icon class', 'vemus'),
        'type' => 'text',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_ask_question_tab' ) && check_setting_is_on( 'tf_product_tabs_style_bellow_cart', 'sidebar' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_ask_question_text',
    array(
        'label' => esc_html__('Button text', 'vemus'),
        'type' => 'text',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_ask_question_tab' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_ask_question_title',
    array(
        'label' => esc_html__('Title', 'vemus'),
        'type' => 'text',
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_ask_question_tab' ) && check_setting_is_on( 'tf_product_tabs_style_bellow_cart', 'sidebar' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_ask_question_content',
    array(
        'label' => esc_html__('Content', 'vemus'),
        'type' => 'textarea',
        'input_attrs' => array(
            'placeholder' => '[contact-form-7 id="123" title="Contact form 1"]',
        ),
        'section' => 'section_tabs',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_ask_question_tab' )
    ) )
);