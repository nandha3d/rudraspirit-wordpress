<?php 
$wp_customize->add_control( new themesflat_Info( $wp_customize,
'page_404_title',
array(
    'label' => esc_html__('Page 404', 'vemus'),
    'section' => 'section_404_page',
) )
);

$wp_customize->add_setting (
    'page_404_heading',
    array(
        'default' => themesflat_customize_default('page_404_heading') ,
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'page_404_heading',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Heading', 'vemus'),
        'section' => 'section_404_page',
        'priority'  => 1,
    )
); 

$wp_customize->add_setting (
    'page_404_desc',
    array(
        'default' => themesflat_customize_default('page_404_desc') ,
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'page_404_desc',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Description', 'vemus'),
        'section' => 'section_404_page',
        'priority'  => 2,
    )
); 

$wp_customize->add_setting (
    'text_button_404',
    array(
        'default' => themesflat_customize_default('text_button_404') ,
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'text_button_404',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Text Button', 'vemus'),
        'section' => 'section_404_page',
        'priority'  => 3,
    )
); 

$wp_customize->add_setting(
    'banner_404',
    array(
        'default' => themesflat_customize_default('banner_404'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'banner_404',
        array(
           'label'          => esc_html__( 'Banner 404', 'vemus' ),
           'description'    => esc_html__( 'If you don\'t display logo please remove it your website display 
            Site Title default in General', 'vemus' ),
           'type'           => 'image',
           'section'        => 'section_404_page',           
        )
    )
);