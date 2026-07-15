<?php 
// Top bar show
$wp_customize->add_setting( 
  'topbar_show',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('topbar_show'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'topbar_show',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Topbar', 'vemus'),
        'section' => 'section_topbar',
        'priority' => 1,
    ))
); 

$wp_customize->add_setting( 
  'topbar_fullwidth',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('topbar_fullwidth'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'topbar_fullwidth',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Topbar Fullwidth', 'vemus'),
        'section' => 'section_topbar',
        'priority' => 2,
    ))
); 

$wp_customize->add_setting('topbar_items_left', array(
    'default' => themesflat_customize_default('topbar_items_left'),
    'sanitize_callback' => 'vemus_sanitize_array',
));

$wp_customize->add_control( new Themesflat_Repeater_Select( $wp_customize, 'topbar_items_left', array(
    'label'    => esc_html__('Topbar Left Items', 'vemus'),
    'section'  => 'section_topbar',
    'priority'  => 3,
    'choices'  => array(
        'phone'   => __('Phone', 'vemus'),
        'address' => __('Address', 'vemus'),
        'email' => __('Email', 'vemus'),
        'currency'    => __('Currency', 'vemus'),
        'language'    => __('Language', 'vemus'),
    ),
            'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
)));

$wp_customize->add_setting('topbar_items_center', array(
    'default' => themesflat_customize_default('topbar_items_center'),
    'sanitize_callback' => 'vemus_sanitize_array',
));

$wp_customize->add_control( new Themesflat_Repeater_Select( $wp_customize, 'topbar_items_center', array(
    'label'    => esc_html__('Topbar Center Items', 'vemus'),
    'section'  => 'section_topbar',
    'priority'  => 4,
    'choices'  => array(
        'phone'   => __('Phone', 'vemus'),
        'address' => __('Address', 'vemus'),
        'email' => __('Email', 'vemus'),
        'text-countdown'    => __('Text & CountDown', 'vemus'),
        'text-support'    => __('Text Support & Phone', 'vemus'),
        'button'    => __('Button', 'vemus'),
    ),
                'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
)));

$wp_customize->add_setting('topbar_items_right', array(
    'default' => themesflat_customize_default('topbar_items_right'),
    'sanitize_callback' => 'vemus_sanitize_array',
));

$wp_customize->add_control( new Themesflat_Repeater_Select( $wp_customize, 'topbar_items_right', array(
    'label'    => esc_html__('Topbar Right Items', 'vemus'),
    'section'  => 'section_topbar',
    'priority'  => 5,
    'choices'  => array(
        'phone'   => __('Phone', 'vemus'),
        'address' => __('Address', 'vemus'),
        'email' => __('Email', 'vemus'),
        'currency'    => __('Currency', 'vemus'),
        'language'    => __('Language', 'vemus'),
    ),
                'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
)));

$wp_customize->add_setting('themesflat_options[info]', array(
        'type'              => 'info_control',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',            
    )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'topbar_information', array(
    'label' => esc_html__('Information Topbar', 'vemus'),
    'section'  => 'section_topbar',
    'settings' => 'themesflat_options[info]',
    'priority' => 6,
                'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
    ) )
);

$wp_customize->add_setting(
    'information_phone',
    array(
        'default' => themesflat_customize_default('information_phone'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    'sanitize_callback' => 'vemus_sanitize_array',
    )
);
$wp_customize->add_control(
    'information_phone',
    array(
        'label' => esc_html__( 'Phone Call', 'vemus' ),
        'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 7,
                    'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
    )
);

$wp_customize->add_setting(
    'information_address',
    array(
        'default' => themesflat_customize_default('information_address'),
        'sanitize_callback' => 'themesflat_sanitize_text',
        
    )
);
$wp_customize->add_control(
    'information_address',
    array(
        'label' => esc_html__( 'Address', 'vemus' ),
        'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 9,
                    'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
    )
);

$wp_customize->add_setting(
    'information_email',
    array(
        'default' => themesflat_customize_default('information_email'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    'sanitize_callback' => 'vemus_sanitize_array',
    )
);
$wp_customize->add_control(
    'information_email',
    array(
        'label' => esc_html__( 'Email', 'vemus' ),
        'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 9,
                    'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
    )
);

$wp_customize->add_setting(
    'information_heading',
    array(
        'default' => themesflat_customize_default('information_heading'),
        'sanitize_callback' => 'themesflat_sanitize_text',
        
    )
);
$wp_customize->add_control(
    'information_heading',
    array(
        'label' => esc_html__( 'Text Support', 'vemus' ),
        'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 11,
                    'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
    )
);

$wp_customize->add_setting(
    'topbar_button_text',
    array(
        'default' => themesflat_customize_default('topbar_button_text'),
        'sanitize_callback' => 'themesflat_sanitize_text',
        
    )
);
$wp_customize->add_control(
    'topbar_button_text',
    array(
        'label' => esc_html__( 'Topbar Button Text', 'vemus' ),
                  'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 15,
                    'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
    )
);

$wp_customize->add_setting(
    'topbar_button_url',
    array(
        'default' => themesflat_customize_default('topbar_button_url'),
        'sanitize_callback' => 'themesflat_sanitize_text',
        
    )
);
$wp_customize->add_control(
    'topbar_button_url',
    array(
        'label' => esc_html__( 'Topbar Button URL', 'vemus' ),
                  'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 16,
                    'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
    )
);

// countdown

$wp_customize->add_setting( 'countdown_end_date', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'countdown_end_date', array(
    'label'       => __( 'Count Down Value', 'vemus' ),
    'section' => 'section_topbar',
    'type'        => 'date', 
        'priority' => 17,
    'description' => __( 'Select Count Down Value', 'vemus' ),
                'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
) );

// Label Text

$wp_customize->add_setting(
    'topbar_label_text',
    array(
        'default' => themesflat_customize_default('topbar_label_text'),
        'sanitize_callback' => 'themesflat_sanitize_text',
        
    )
);
$wp_customize->add_control(
    'topbar_label_text',
    array(
        'label' => esc_html__( 'Text Label CountDown', 'vemus' ),
          'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 18,
                    'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
    )
);

$wp_customize->add_setting('topbar_height', [
    'default' => json_encode(themesflat_customize_default('topbar_height')),
    'transport' => 'refresh',
    'sanitize_callback' => 'esc_attr',
]);

$wp_customize->add_control(new themesflat_Responsive_Slider_Control($wp_customize, 'topbar_height', [
    'label' => __('Height', 'vemus'),
    'section' => 'section_topbar',
        'priority' => 19,
    'input_attrs' => [
        'min'  => 0,
        'max'  => 100,
        'step' => 1,
    ],
                'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 === $wp_customize->get_setting( 'topbar_show' )->value()
                );
           },
]));

