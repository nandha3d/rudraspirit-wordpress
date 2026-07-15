<?php 
// Page title heading
$wp_customize->add_setting(
  'page_title_heading_enabled',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('page_title_heading_enabled'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'page_title_heading_enabled',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Heading ( OFF | ON )', 'vemus'),
        'section' => 'section_page_title',
        'priority' => 1,
    ))
);

$wp_customize->add_setting('themesflat_options[info]', array(
        'type'              => 'info_control',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',            
    )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'page-title-style', array(
    'label' => esc_html__('Page Title Style', 'vemus'),
    'section' => 'section_page_title',
    'settings' => 'themesflat_options[info]',
    'priority' => 2
    ) )
);

$wp_customize->add_setting(
    'page_title_alignment',
    array(
        'default'           => themesflat_customize_default('page_title_alignment'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'page_title_alignment',
    array (
        'type'      => 'select',           
        'section'   => 'section_page_title',
        'priority'  => 3,
        'label'         => esc_html__('Page Title Alignment', 'vemus'),
        'choices'   => array (
            'left' =>  esc_html__( 'Left','vemus' ),
            'center' =>  esc_html__( 'Center','vemus' ),
            'right' =>  esc_html__( 'Right','vemus' )
            ) ,
    )
); 

// Enable Count
$wp_customize->add_setting(
  'page_title_count',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('page_title_count'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'page_title_count',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Count Blog', 'vemus'),
        'section' => 'section_page_title',
        'priority' => 4,
    ))
);

// Enable Description
$wp_customize->add_setting(
  'page_title_description',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('page_title_description'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'page_title_description',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Page Title Description', 'vemus'),
        'section' => 'section_page_title',
        'priority' => 5,
        'active_callback' => function( $control ) {
            $page_title_alignment   = $control->manager->get_setting( 'page_title_alignment' )->value();
            return ( $page_title_alignment !== 'center' );
        },
    ))
);

$wp_customize->add_setting (
    'page_title_description_content',
    array(
        'default' => themesflat_customize_default('page_title_description_content') ,
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'page_title_description_content',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Content Description', 'vemus'),
        'section' => 'section_page_title',
        'priority'  => 6,
          'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'page_title_description' )->value()
                );
           },
    )
); 

// Box control
$wp_customize->add_setting(
    'page_title_controls',
    array(
        'default' => themesflat_customize_default('page_title_controls'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control( new themesflat_BoxControls($wp_customize,
    'page_title_controls',
    array(
        'label' => esc_html__( 'Page Title Controls (px)', 'vemus' ),
        'section' => 'section_page_title',
        'type' => 'box-controls',
        'priority' => 7
    ))
);  