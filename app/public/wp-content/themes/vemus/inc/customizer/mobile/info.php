<?php 

$wp_customize->add_setting(
    'header_mb_heading',
    array(
        'default' => themesflat_customize_default('header_mb_heading'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_mb_heading',
    array(
        'label' => esc_html__( 'Heading', 'vemus' ),
        'section' => 'section_info',
        'type' => 'text',
        'priority' => 1
    )
);


$wp_customize->add_setting(
    'header_phone_label',
    array(
        'default' => themesflat_customize_default('header_phone_label'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_phone_label',
    array(
        'label' => esc_html__( 'Phone Label', 'vemus' ),
        'section' => 'section_info',
        'type' => 'text',
        'priority' => 2
    )
);

$wp_customize->add_setting(
    'header_phone',
    array(
        'default' => themesflat_customize_default('header_phone'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_phone',
    array(
        'label' => esc_html__( 'Phone Number', 'vemus' ),
        'section' => 'section_info',
        'type' => 'text',
        'priority' => 3
    )
);

$wp_customize->add_setting(
    'header_email_label',
    array(
        'default' => themesflat_customize_default('header_email_label'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_email_label',
    array(
        'label' => esc_html__( 'Email Label', 'vemus' ),
        'section' => 'section_info',
        'type' => 'text',
        'priority' => 4
    )
);

$wp_customize->add_setting(
    'header_email',
    array(
        'default' => themesflat_customize_default('header_email'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_email',
    array(
        'label' => esc_html__( 'Email', 'vemus' ),
        'section' => 'section_info',
        'type' => 'text',
        'priority' => 5
    )
);

$wp_customize->add_setting(
    'header_address_label',
    array(
        'default' => themesflat_customize_default('header_address_label'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_address_label',
    array(
        'label' => esc_html__( 'Address Label', 'vemus' ),
        'section' => 'section_info',
        'type' => 'text',
        'priority' => 6
    )
);

$wp_customize->add_setting(
    'header_address',
    array(
        'default' => themesflat_customize_default('header_address'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_address',
    array(
        'label' => esc_html__( 'Address', 'vemus' ),
        'section' => 'section_info',
        'type' => 'text',
        'priority' => 7
    )
);

$wp_customize->add_setting(
    'header_mb_language',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_mb_language'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_mb_language',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Show Language', 'vemus'),
          'section' => 'section_info',
          'priority' => 9
      ))
  );

  
  $wp_customize->add_setting(
    'header_mb_currency',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_mb_currency'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_mb_currency',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Show Currency', 'vemus'),
          'section' => 'section_info',
          'priority' => 10
      ))
  );
  
  $wp_customize->add_setting(
    'header_mb_wishlist',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_mb_wishlist'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_mb_wishlist',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Show Wishlist', 'vemus'),
          'section' => 'section_info',
          'priority' => 11
      ))
  );
  
  $wp_customize->add_setting(
    'header_mb_login',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_mb_login'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_mb_login',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Show Login', 'vemus'),
          'section' => 'section_info',
          'priority' => 12
      ))
  );
  
