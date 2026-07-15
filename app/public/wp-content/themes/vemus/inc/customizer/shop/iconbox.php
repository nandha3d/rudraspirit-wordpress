
<?php 

$wp_customize->add_setting(
    'shop_iconbox',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('shop_iconbox'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'shop_iconbox',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Iconbox', 'vemus'),
        'section' => 'section_iconbox',
    ))
);

$wp_customize->add_setting('icon_boxes_shop', array(
    'default'           => themesflat_customize_default('icon_boxes_shop'),
    'sanitize_callback' => 'themesflat_sanitize_iconbox_repeater',
));

$wp_customize->add_control(new IconBox2_Repeater_Control($wp_customize, 'icon_boxes_shop', array(
    'label'    => __('Icon Boxes', 'vemus'),
    'section'  => 'section_iconbox',
    'settings' => 'icon_boxes_shop',
)));