<?php

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'header-style', array(
    'label' => esc_html__('Header Typography & Color', 'vemus'),
            'section'       => 'section_typo_header',
    'settings' => 'themesflat_options[info]',
    'priority' => 1
    ) )
);

$wp_customize->add_setting(
    'header_backgroundcolor',
    array(
        'default'           => themesflat_customize_default('header_backgroundcolor'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'header_backgroundcolor',
        array(
            'label'         => esc_html__('Header Background', 'vemus'),
            'section'       => 'section_typo_header',
            'priority'      => 1
        )
    )
);

// Menu fonts
$wp_customize->add_setting('themesflat_options[info]', array(
        'type'              => 'info_control',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',            
    )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'menu_fonts', array(
    'label' => esc_html__('Menu', 'vemus'),
                'section'       => 'section_typo_header',
    'settings' => 'themesflat_options[info]',
    'priority' => 1
    ) )
);

$wp_customize->add_setting(
    'typography_menu',
    array(
        'default' => themesflat_customize_default('typography_menu'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_Typography($wp_customize,
    'typography_menu',
    array(
        'label' => esc_html__( 'Font name/style/sets', 'vemus' ),
                    'section'       => 'section_typo_header',
        'type' => 'typography',
        'fields' => array('family','style','line_height','size','letter_spacing'),
        'priority' => 2
    ))
);

// Menu a color
$wp_customize->add_setting(
    'mainnav_color',
    array(
        'default'           => themesflat_customize_default('mainnav_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'mainnav_color',
        array(
            'label' => esc_html__('Regular', 'vemus'),
                        'section'       => 'section_typo_header',
            'priority' => 4
        )
    )
);
// Menu hover color
$wp_customize->add_setting(
    'mainnav_hover_color',
    array(
        'default'           => themesflat_customize_default('mainnav_hover_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'mainnav_hover_color',
        array(
            'label' => esc_html__('Hover', 'vemus'),
                        'section'       => 'section_typo_header',
            'priority' => 5
        )
    )
);

// Menu active color
$wp_customize->add_setting(
    'mainnav_active_color',
    array(
        'default'           => themesflat_customize_default('mainnav_active_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'mainnav_active_color',
        array(
            'label' => esc_html__('Active', 'vemus'),
                        'section'       => 'section_typo_header',
            'priority' => 6
        )
    )
);

// Sub Menu fonts
$wp_customize->add_setting('themesflat_options[info]', array(
        'type'              => 'info_control',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',            
    )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'sub_menu_fonts', array(
    'label' => esc_html__('Sub Menu', 'vemus'),
                'section'       => 'section_typo_header',
    'settings' => 'themesflat_options[info]',
    'priority' => 20
    ) )
);

$wp_customize->add_setting(
    'typography_sub_menu',
    array(
        'default' => themesflat_customize_default('typography_sub_menu'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_Typography($wp_customize,
    'typography_sub_menu',
    array(
        'label' => esc_html__( 'Font name/style/sets', 'vemus' ),
                    'section'       => 'section_typo_header',
        'type' => 'typography',
        'fields' => array('family','style','line_height','size','letter_spacing'),
        'priority' => 21
    ))
);

// Sub menu a color
$wp_customize->add_setting(
    'sub_nav_color',
    array(
        'default'           => themesflat_customize_default('sub_nav_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_color',
        array(
            'label' => esc_html__('Regular', 'vemus'),
                        'section'       => 'section_typo_header',
            'priority' => 23
        )
    )
);    

// Sub nav background hover
$wp_customize->add_setting(
    'sub_nav_color_hover',
    array(
        'default'   => themesflat_customize_default('sub_nav_color_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_color_hover',
        array(
            'label' => esc_html__('Hover & Active', 'vemus'),
                        'section'       => 'section_typo_header',
            'priority' => 24
        )
    )
);

// Sub nav background
$wp_customize->add_setting(
    'sub_nav_background',
    array(
        'default'           => themesflat_customize_default('sub_nav_background'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_background',
        array(
            'label' => esc_html__('Background', 'vemus'),
                        'section'       => 'section_typo_header',
            'priority' => 25
        )
    )
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'action-button-style', array(
    'label' => esc_html__('Button ( Cart, Wishlist, Login, Search )', 'vemus'),
                'section'       => 'section_typo_header',
    'settings' => 'themesflat_options[info]',
    'priority' => 26
    ) )
);

// Sub nav background hover
$wp_customize->add_setting(
    'button_action_header_color',
    array(
        'default'   => themesflat_customize_default('button_action_header_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'button_action_header_color',
        array(
            'label' => esc_html__('Color', 'vemus'),
                        'section'       => 'section_typo_header',
            'priority' => 27
        )
    )
);

// Sub nav background hover
$wp_customize->add_setting(
    'button_action_header_color_hover',
    array(
        'default'   => themesflat_customize_default('button_action_header_color_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'button_action_header_color_hover',
        array(
            'label' => esc_html__('Color Hober', 'vemus'),
                        'section'       => 'section_typo_header',
            'priority' => 28
        )
    )
);