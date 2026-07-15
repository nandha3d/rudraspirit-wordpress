<?php 


$wp_customize->add_control( new themesflat_Info( $wp_customize,
'page_checkout_title',
array(
    'label' => esc_html__('Checkout Page', 'vemus'),
    'section' => 'section_checkout_page',
) )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'testimonial-thankyou-body', array(
    'label' => esc_html__('Testimonial', 'vemus'),
    'section' => 'section_checkout_page',
    'settings' => 'testimonial_thankyou_heading',
) )
);

$wp_customize->add_setting ( 
    'checkout_testi',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox' ,
        'default' => themesflat_customize_default('checkout_testi'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'checkout_testi',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Checkout Testimonial', 'vemus'),
        'section'   => 'section_checkout_page',
    ))
);

$wp_customize->add_setting('testimonial_checkout', array(
    'default' => themesflat_customize_default('testimonial_checkout'),
    'transport' => 'postMessage',
    'sanitize_callback' => 'themesflat_sanitize_testimonial_thankyou_repeater'
));

$wp_customize->add_control(new Testimonial_Thankyou_Repeater_Control($wp_customize, 'testimonial_checkout', array(
    'label' => 'Testimonials',
    'section' => 'section_checkout_page',
    'settings' => 'testimonial_checkout',
)));
