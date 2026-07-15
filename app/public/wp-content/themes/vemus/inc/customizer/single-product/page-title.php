<?php

$wp_customize->add_setting(
  'page_title_heading_woo_single',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('page_title_heading_woo_single'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'page_title_heading_woo_single',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Heading', 'vemus'),
        'section' => 'single_product_pagetitle',
    ))
);

$wp_customize->add_setting(
    'breadcrumb_woo_single',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('breadcrumb_woo_single'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'breadcrumb_woo_single',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Breadcrumb', 'vemus'),
        'section' => 'single_product_pagetitle',
    ))
);

$wp_customize->add_setting(
'pagetitle_des_single',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('pagetitle_des_single'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'pagetitle_des_single',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Description', 'vemus'),
        'section' => 'single_product_pagetitle',
    ))
);

$wp_customize->add_setting (
    'page_title_description_content_woo_single',
    array(
        'default' => themesflat_customize_default('page_title_description_content_woo_single') ,
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'page_title_description_content_woo_single',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Content Description', 'vemus'),
        'section' => 'single_product_pagetitle',
                  'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'pagetitle_des_single' )->value()
                );
           },
    )
);
  
  $wp_customize->add_setting(
      'single_navigation',
        array(
            'sanitize_callback' => 'themesflat_sanitize_checkbox',
            'default' => themesflat_customize_default('single_navigation'),     
        )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'single_navigation',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Prev Next Product', 'vemus'),
          'section' => 'single_product_pagetitle',
      ))
  );  