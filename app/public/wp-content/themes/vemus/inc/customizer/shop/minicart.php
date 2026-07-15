
<?php 
// Free Shipping
$wp_customize->add_setting('free_shipping_bar_heading', array(
    'type'              => 'info_control',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',            
)
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'free_shipping_bar-body', array(
    'label' => esc_html__('Free Shipping Bar', 'vemus'),
    'section' => 'section_shop_minicart',
    'settings' => 'free_shipping_bar_heading',
) )
);
$wp_customize->add_setting(
    'free_shipping_bar',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('free_shipping_bar'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'free_shipping_bar',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Free Shipping', 'vemus'),
        'section' => 'section_shop_minicart',
    ))
);


$wp_customize->add_setting (
    'progress_cart_text',
    array(
        'default' => themesflat_customize_default('progress_cart_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'progress_cart_text',
    array(
        'type'      => 'textarea',
        'label'     => esc_html__('Progessbar text', 'vemus'),
        'section'   => 'section_shop_minicart',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'free_shipping_bar' )->value()
            );
        },
    )
);

$wp_customize->add_setting (
    'success_cart_text',
    array(
        'default' => themesflat_customize_default('success_cart_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'success_cart_text',
    array(
        'type'      => 'textarea',
        'label'     => esc_html__('Success text', 'vemus'),
        'section'   => 'section_shop_minicart',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'free_shipping_bar' )->value()
            );
        },
    )
);

// Bottom
$wp_customize->add_setting('minicart_bottom_heading', array(
    'type'              => 'info_control',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',            
)
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'minicart_bottom-body', array(
    'label' => esc_html__('Bottom Extra', 'vemus'),
    'section' => 'section_shop_minicart',
    'settings' => 'minicart_bottom_heading',
) )
);
$wp_customize->add_setting(
    'minicart_gift',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('minicart_gift'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'minicart_gift',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Gift', 'vemus'),
        'section' => 'section_shop_minicart',
    ))
);

$wp_customize->add_setting (
    'gift_fee',
    array(
        'default' => themesflat_customize_default('gift_fee'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'gift_fee',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Fee to Gift', 'vemus'),
        'section'   => 'section_shop_minicart',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'minicart_gift' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
    'minicart_note',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('minicart_note'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'minicart_note',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Note', 'vemus'),
        'section' => 'section_shop_minicart',
    ))
);


$wp_customize->add_setting(
    'minicart_shipping',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('minicart_shipping'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'minicart_shipping',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Shipping', 'vemus'),
        'section' => 'section_shop_minicart',
    ))
);

$wp_customize->add_setting(
    'minicart_coupon',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('minicart_coupon'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'minicart_coupon',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Coupon', 'vemus'),
        'section' => 'section_shop_minicart',
    ))
);






