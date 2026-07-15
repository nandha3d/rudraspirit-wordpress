<?php
$wp_customize->add_setting( 
  'show_announcement',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('show_announcement'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_announcement',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Announcement Bar', 'vemus'),
        'section' => 'section_announcement',
        'priority' => 1,
    ))
); 

$wp_customize->add_setting(
    'announcement_topbar_style',
    array(
        'default'           => themesflat_customize_default('announcement_topbar_style'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'announcement_topbar_style',
    array (
        'type'      => 'select',           
        'section'   => 'section_announcement',
        'priority'  => 2,
        'label'         => esc_html__('Announcement Bar Style', 'vemus'),
        'choices'   => array (
            'style-marquee'     => esc_html__( 'Marquee','vemus' ),
            'style-slider'      =>  esc_html__( 'Slider','vemus' ),
        ),
            'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'show_announcement' )->value()
                );
           },
    )
);

$wp_customize->add_setting('topbar_marquee_arr', array(
    'default' => themesflat_customize_default('topbar_marquee_arr'),
    'sanitize_callback' => 'vemus_sanitize_array',
));

$wp_customize->add_control(new Themesflat_Repeater_Controls($wp_customize, 'topbar_marquee_arr', array(
    'label'   => __('Marquee List', 'vemus'),
    'section' => 'section_announcement',
    'settings' => 'topbar_marquee_arr',
    'priority' => 3,
              'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    'style-marquee' === $wp_customize->get_setting( 'announcement_topbar_style' )->value()
                );
           },
            'active_callback' => function( $control ) {
                $show_announcement  = $control->manager->get_setting( 'show_announcement' )->value();
                $announcement_topbar_style = $control->manager->get_setting( 'announcement_topbar_style' )->value();

                return (
                    $show_announcement == 1 &&
                    in_array( $announcement_topbar_style, ['style-marquee'], true )
                );
            },
)));

$wp_customize->add_setting( 'topbar_swiper_fields', array(
    'default'           => themesflat_customize_default('topbar_swiper_fields'),
    'sanitize_callback' => 'vemus_sanitize_array',
));

$wp_customize->add_control(new Themesflat_Repeater2_Controls($wp_customize, 'topbar_swiper_fields', array(
    'label'   => __('Slider List', 'vemus'),
    'section' => 'section_announcement',
    'settings' => 'topbar_swiper_fields',
    'priority' => 4,
            'active_callback' => function( $control ) {
                $show_announcement  = $control->manager->get_setting( 'show_announcement' )->value();
                $announcement_topbar_style = $control->manager->get_setting( 'announcement_topbar_style' )->value();

                return (
                    $show_announcement == 1 &&
                    in_array( $announcement_topbar_style, ['style-slider'], true )
                );
            },
)));
