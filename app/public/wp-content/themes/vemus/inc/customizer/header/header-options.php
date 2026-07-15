<?php 
//Header Style
$wp_customize->add_setting(
    'style_header',
    array(
        'default'           => themesflat_customize_default('style_header'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_RadioImages($wp_customize,
    'style_header',
    array (
        'type'      => 'radio-images',           
        'section'   => 'section_options',
        'priority'  => 1,
        'label'         => esc_html__('Header Style', 'vemus'),
        'choices'   => array (
            'header-default' => array (
                'tooltip'   => esc_html__( 'Header Default','vemus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header-default.jpg'
            ),
            'header-01'=>  array (
                'tooltip'   => esc_html__( 'Header 01','vemus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header-01.jpg'
            ),
            'header-02'=>  array (
                'tooltip'   => esc_html__( 'Header 02','vemus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header-02.jpg'
            ),
            'header-03'=>  array (
                'tooltip'   => esc_html__( 'Header 03','vemus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header-03.jpg'
            ),
        ),
    ))
); 

// Enable Header Absolute
$wp_customize->add_setting(
  'header_absolute',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_absolute'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_absolute',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Absolute', 'vemus'),
        'section' => 'section_options',
        'priority' => 1,
    ))
);

// Enable Header Sticky
$wp_customize->add_setting(
  'header_sticky',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_sticky'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_sticky',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Sticky', 'vemus'),
        'section' => 'section_options',
        'priority' => 2,
    ))
);    

// Show search 
$wp_customize->add_setting(
  'header_search_box',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_search_box'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_search_box',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Search Box', 'vemus'),
        'section' => 'section_options',
        'priority' => 5,
    ))
);




// Show Login 
$wp_customize->add_setting(
    'header_login',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_login'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_login',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Header Login/Register', 'vemus'),
          'section' => 'section_options',
          'priority' => 5,
      ))
);



$wp_customize->add_setting(
    'header_wishlist_icon',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_wishlist_icon'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_wishlist_icon',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Header Wishlist', 'vemus'),
          'section' => 'section_options',
          'priority' => 5,
      ))
);


// Enable Header Cart
$wp_customize->add_setting(
  'header_cart_icon',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_cart_icon'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_cart_icon',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Cart', 'vemus'),
        'section' => 'section_options',
        'priority' => 6,
    ))
);


// Language Header
$wp_customize->add_setting(
    'language_header',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('language_header'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'language_header',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Language', 'vemus'),
          'section' => 'section_options',
          'priority' => 9,
          'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    'header-01' === $wp_customize->get_setting( 'style_header' )->value()
                );
           },
      ))
);

// Currency Header
$wp_customize->add_setting(
    'currency_header',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('currency_header'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'currency_header',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Currency', 'vemus'),
          'section' => 'section_options',
          'priority' => 9,
          'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    'header-01' === $wp_customize->get_setting( 'style_header' )->value()
                );
           },
      ))
);