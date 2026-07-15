<?php
$wp_customize->add_setting('themesflat_options[info]', array(
        'type'              => 'info_control',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',            
    )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'announcement-style', array(
    'label' => esc_html__('Announcement Bar Typography & Color', 'vemus'),
    'section' => 'section_typo_announcement',
    'settings' => 'themesflat_options[info]',
    'priority' => 6
    ) )
);

// Topbar fonts
$wp_customize->add_setting(
    'typography_announcement',
    array(
        'default' => themesflat_customize_default('typography_announcement'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_Typography($wp_customize,
    'typography_announcement',
    array(
        'label' => esc_html__( 'Font name/style/sets', 'vemus' ),
        'section' => 'section_typo_announcement',
        'type' => 'typography',
        'fields' => array('family','style','line_height','size','letter_spacing'),
        'priority' => 7
    ))
);

$wp_customize->add_setting(
    'announcement_background_color',
    array(
        'default'           => themesflat_customize_default('announcement_background_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'announcement_background_color',
        array(
            'label'         => esc_html__('Background Announcement Bar', 'vemus'),
            'section' => 'section_typo_announcement',
            'priority'      => 8
        )
    )
);

$wp_customize->add_setting(
    'announcement_textcolor',
    array(
        'default'           => themesflat_customize_default('announcement_textcolor'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'announcement_textcolor',
        array(
            'label'         => esc_html__('Announcement Bar Text Color', 'vemus'),
            'section' => 'section_typo_announcement',
            'priority'      => 9
        )
    )
);

$wp_customize->add_setting(
    'announcement_link_color',
    array(
        'default'           => themesflat_customize_default('announcement_link_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'announcement_link_color',
        array(
            'label'         => esc_html__('Announcement Bar Link Color', 'vemus'),
            'section' => 'section_typo_announcement',
            'priority'      => 10
        )
    )
);

$wp_customize->add_setting(
    'announcement_link_color_hover',
    array(
        'default'           => themesflat_customize_default('announcement_link_color_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'announcement_link_color_hover',
        array(
            'label'         => esc_html__('Announcement Bar Link Color Hover', 'vemus'),
            'section' => 'section_typo_announcement',
            'priority'      => 11
        )
    )
);


