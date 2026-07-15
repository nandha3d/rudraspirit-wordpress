<?php 
// Show Bottom
$wp_customize->add_setting ( 
    'show_bottom',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox' ,
        'default' => themesflat_customize_default('show_bottom'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_bottom',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Bottom', 'vemus'),
        'section'   => 'section_bottom',
        'priority'  => 1
    ))
);

// Footer Copyright
$wp_customize->add_setting(
    'footer_copyright',
    array(
        'default' => themesflat_customize_default('footer_copyright'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control(
    'footer_copyright',
    array(
        'label' => esc_html__( 'Copyright', 'vemus' ),
        'section' => 'section_bottom',
        'type' => 'textarea',
        'priority' => 2,
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_bottom' )->value()
            );
        },
    )
);
  
  
$wp_customize->add_setting(
    'img_payment',
    array(
        'sanitize_callback' => 'themesflat_sanitize_image_urls',
        'default'           => themesflat_customize_default('img_payment'),        
    )
);
$wp_customize->add_control(
    new themesflat_MultiImages(
        $wp_customize,
        'img_payment',
        array(
           'label'          => esc_html__( 'Upload Your Partner Image', 'vemus' ),
           'type'           => 'multi-image',
           'section'        => 'section_bottom',
           'priority'       => 2,
           'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_bottom' )->value()
            );
            },
        )
    )
);

// Show Language
$wp_customize->add_setting ( 
    'language_bottom',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox' ,
        'default' => themesflat_customize_default('language_bottom'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'language_bottom',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Language Bottom', 'vemus'),
        'section'   => 'section_bottom',
        'priority'  => 3,
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_bottom' )->value()
            );
        },
    ))
);

// Show Currency
$wp_customize->add_setting ( 
    'currency_bottom',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox' ,
        'default' => themesflat_customize_default('currency_bottom'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'currency_bottom',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Currency Bottom', 'vemus'),
        'section'   => 'section_bottom',
        'priority'  => 4,
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_bottom' )->value()
            );
        },
    ))
);