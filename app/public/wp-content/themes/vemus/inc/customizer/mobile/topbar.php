<?php 

$wp_customize->add_setting(
    'show_topbar_mobile_social',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_topbar_mobile_social'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_topbar_mobile_social',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Social', 'vemus'),
        'section' => 'section_mobile_topbar',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_topbar_mobile' )->value()
            );
        },
    ))
);


$wp_customize->add_setting(
    'show_topbar_mobile_language',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_topbar_mobile_language'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_topbar_mobile_language',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Language', 'vemus'),
        'section' => 'section_mobile_topbar',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_topbar_mobile' )->value()
            );
        },
    ))
);

$wp_customize->add_setting(
    'show_topbar_mobile_currency',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_topbar_mobile_currency'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_topbar_mobile_currency',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Currency', 'vemus'),
        'section' => 'section_mobile_topbar',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_topbar_mobile' )->value()
            );
        },
    ))
);

$wp_customize->add_setting(
    'show_topbar_mobile_marquee',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_topbar_mobile_marquee'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_topbar_mobile_marquee',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Marquee', 'vemus'),
        'section' => 'section_mobile_topbar',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_topbar_mobile' )->value()
            );
        },
    ))
);


