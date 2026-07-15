<?php 
$wp_customize->add_setting(
  'page_title_heading_woo',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('page_title_heading_woo'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'page_title_heading_woo',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Heading', 'vemus'),
        'section' => 'section_shop_pagetitle',
    ))
);

$wp_customize->add_setting(
    'breadcrumb_woo',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('breadcrumb_woo'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'breadcrumb_woo',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Breadcrumb', 'vemus'),
        'section' => 'section_shop_pagetitle',
    ))
);

$wp_customize->add_setting(
    'page_title_alignment_woo',
    array(
        'default'           => themesflat_customize_default('page_title_alignment_woo'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'page_title_alignment_woo',
    array (
        'type'      => 'select',           
        'section' => 'section_shop_pagetitle',
        'label'         => esc_html__('Page Title Alignment', 'vemus'),
        'choices'   => array (
            'left' =>  esc_html__( 'Left','vemus' ),
            'center' =>  esc_html__( 'Center','vemus' ),
            'right' =>  esc_html__( 'Right','vemus' )
            ) ,
    )
); 


$wp_customize->add_setting(
'pagetitle_des',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('pagetitle_des'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'pagetitle_des',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Description', 'vemus'),
        'section' => 'section_shop_pagetitle',
                'active_callback' => function( $control ) {
            $page_title_alignment   = $control->manager->get_setting( 'page_title_alignment_woo' )->value();
            return ( $page_title_alignment !== 'center' );
        },
    ))
);

$wp_customize->add_setting (
    'page_title_description_content_woo',
    array(
        'default' => themesflat_customize_default('page_title_description_content_woo') ,
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'page_title_description_content_woo',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Content Description', 'vemus'),
        'section' => 'section_shop_pagetitle',
        'active_callback' => function( $control ) {
            $page_title_description = $control->manager->get_setting( 'pagetitle_des' )->value();
            $page_title_alignment   = $control->manager->get_setting( 'page_title_alignment_woo' )->value();
            return ( $page_title_description == 1 && $page_title_alignment !== 'center' );
        },
    )
); 

// Box control
$wp_customize->add_setting(
    'page_title_controls_woo',
    array(
        'default' => themesflat_customize_default('page_title_controls_woo'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control( new themesflat_BoxControls($wp_customize,
    'page_title_controls_woo',
    array(
        'label' => esc_html__( 'Page Title Controls (px)', 'vemus' ),
        'section' => 'section_shop_pagetitle',
        'type' => 'box-controls',
    ))
);  



  