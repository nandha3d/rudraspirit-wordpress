<?php 


$wp_customize->add_control( new themesflat_Info( $wp_customize,
'page_cart_title',
array(
    'label' => esc_html__('Cart Page', 'vemus'),
    'section' => 'section_cart_page',
) )
);

$wp_customize->add_setting('extra_heading', array(
    'type'              => 'info_control',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',            
)
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'extra-body', array(
    'label' => esc_html__('Cart Total Extra', 'vemus'),
    'section' => 'section_cart_page',
    'settings' => 'extra_heading',
) )
);

$wp_customize->add_setting ( 
    'cart_form_extra',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox' ,
        'default' => themesflat_customize_default('cart_form_extra'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'cart_form_extra',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Cart Extra', 'vemus'),
        'section'   => 'section_cart_page',
    ))
);

$wp_customize->add_setting(
    'cart_form_extra_heading',
    array(
        'default' => themesflat_customize_default('cart_form_extra_heading'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control(
    'cart_form_extra_heading',
    array(
        'label' => esc_html__( 'Title', 'vemus' ),
        'section' => 'section_cart_page',
        'type' => 'textarea',
    )
);

$wp_customize->add_setting(
    'cart_form_extra_img',
    array(
        'sanitize_callback' => 'themesflat_sanitize_image_urls',
        'default'           => themesflat_customize_default('cart_form_extra_img'),        
    )
);
$wp_customize->add_control(
    new themesflat_MultiImages(
        $wp_customize,
        'cart_form_extra_img',
        array(
           'label'          => esc_html__( 'Upload Your Extra Image', 'vemus' ),
           'type'           => 'multi-image',
           'section'        => 'section_cart_page',
        )
    )
);

return;

$wp_customize->add_setting('icob_box_heading', array(
    'type'              => 'info_control',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',            
)
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'iconbox-body', array(
    'label' => esc_html__('Icon Box', 'vemus'),
    'section' => 'section_cart_page',
    'settings' => 'icob_box_heading',
) )
);

$wp_customize->add_setting ( 
    'cart_iconbox',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox' ,
        'default' => themesflat_customize_default('cart_iconbox'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'cart_iconbox',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Cart Iconbox', 'vemus'),
        'section'   => 'section_cart_page',
    ))
);

$wp_customize->add_setting('icon_boxes', array(
    'default'           => themesflat_customize_default('icon_boxes'),
    'sanitize_callback' => 'themesflat_sanitize_iconbox_repeater',
));

$wp_customize->add_control(new IconBox_Repeater_Control($wp_customize, 'icon_boxes', array(
    'label'    => __('Icon Boxes', 'vemus'),
    'section'  => 'section_cart_page',
    'settings' => 'icon_boxes',
)));

$wp_customize->add_setting('testimonial_heading', array(
    'type'              => 'info_control',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',            
)
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'testimonial-body', array(
    'label' => esc_html__('Testimonial', 'vemus'),
    'section' => 'section_cart_page',
    'settings' => 'testimonial_heading',
) )
);

$wp_customize->add_setting ( 
    'cart_testi',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox' ,
        'default' => themesflat_customize_default('cart_testi'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'cart_testi',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Cart Testimonial', 'vemus'),
        'section'   => 'section_cart_page',
    ))
);


$wp_customize->add_setting('testimonial_boxes', array(
    'default' => themesflat_customize_default('testimonial_boxes'),
    'sanitize_callback' => 'themesflat_sanitize_testimonial_repeater'
));

$wp_customize->add_control(new Testimonial_Repeater_Control($wp_customize, 'testimonial_boxes', array(
    'label' => 'Testimonials',
    'section' => 'section_cart_page',
    'settings' => 'testimonial_boxes',
)));
