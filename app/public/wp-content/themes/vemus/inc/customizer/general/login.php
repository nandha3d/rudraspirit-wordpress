<?php 

$wp_customize->add_setting(
  'enable_login_fb',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('enable_login_fb'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'enable_login_fb',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Login Facebook ( OFF | ON )', 'vemus'),
        'section' => 'section_login',
    ))
);
$wp_customize->add_setting(
    'facebook_login_client_id',
    array(
        'default' => themesflat_customize_default('facebook_login_client_id'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'facebook_login_client_id',
    array(
        'label' => esc_html__( 'Facebook login id', 'vemus' ),
        'section' => 'section_login',
        'type' => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'enable_login_fb' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
    'facebook_login_client_secret',
    array(
        'default' => themesflat_customize_default('facebook_login_client_secret'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'facebook_login_client_secret',
    array(
        'label' => esc_html__( 'Facebook login secret', 'vemus' ),
        'section' => 'section_login',
        'type' => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'enable_login_fb' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
  'enable_login_gg',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('enable_login_gg'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'enable_login_gg',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Login Google ( OFF | ON )', 'vemus'),
        'section' => 'section_login',
    ))
);

$wp_customize->add_setting(
    'google_login_client_id',
    array(
        'default' => themesflat_customize_default('google_login_client_id'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'google_login_client_id',
    array(
        'label' => esc_html__( 'Google login id', 'vemus' ),
        'section' => 'section_login',
        'type' => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'enable_login_gg' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
    'google_login_client_secret',
    array(
        'default' => themesflat_customize_default('google_login_client_secret'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'google_login_client_secret',
    array(
        'label' => esc_html__( 'Google login secret', 'vemus' ),
        'section' => 'section_login',
        'type' => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'enable_login_gg' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
    'text_privacy_policy',
    array(
        'default' => themesflat_customize_default('text_privacy_policy'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'text_privacy_policy',
    array(
        'label' => esc_html__( 'Text checkbox privacy policy', 'vemus' ),
        'section' => 'section_login',
        'type' => 'text',
    )
);