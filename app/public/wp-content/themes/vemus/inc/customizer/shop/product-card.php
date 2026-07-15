<?php 

$wp_customize->add_control( new themesflat_Info( $wp_customize,
    'product_cart_title',
    array(
        'label' => esc_html__('Product Card', 'vemus'),
        'section' => 'section_product_card',
    ) )
);


$wp_customize->add_setting(
    'product_style',
    array(
        'default'           => themesflat_customize_default('product_style'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'show_rating',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_rating'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_rating',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Rating', 'vemus'),
        'section' => 'section_product_card',
        
    ))
);

$wp_customize->add_setting(
    'show_category',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_category'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_category',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Category', 'vemus'),
        'section' => 'section_product_card',
        
    ))
);

$wp_customize->add_setting(
    'show_countdown',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_countdown'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_countdown',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Count Down', 'vemus'),
        'section' => 'section_product_card',
        
    ))
);

$wp_customize->add_setting(
    'show_badges',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_badges'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_badges',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Badges', 'vemus'),
        'section' => 'section_product_card',
        
    ))
);

$wp_customize->add_setting(
    'show_progressbar',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_progressbar'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_progressbar',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Progressbar', 'vemus'),
        'section' => 'section_product_card',
        
    ))
);

$wp_customize->add_setting(
    'show_in_out_stock',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_in_out_stock'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_in_out_stock',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show In/Out Stock', 'vemus'),
        'section' => 'section_product_card',
        
    ))
);

$wp_customize->add_setting(
    'show_out_stock_btn',
      array(
          'sanitize_callback' => 'absint',
          'default' => themesflat_customize_default('show_out_stock_btn'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_out_stock_btn',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Out Stock button', 'vemus'),
        'section' => 'section_product_card',
        
    ))
);

$wp_customize->add_setting(
    'out_stock_btn_text',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('out_stock_btn_text'),     
      )   
);

$wp_customize->add_control( 
      'out_stock_btn_text',
      array(
          'type' => 'text',
          'label' => esc_html__('Button Text', 'vemus'),
          'section' => 'section_product_card',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'show_out_stock_btn' )->value()
            );
          },
      )
);

$wp_customize->add_setting(
    'out_stock_form',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('out_stock_form'),     
      )   
);

$wp_customize->add_control( 
      'out_stock_form',
      array(
            'type' => 'text',
            'label' => esc_html__('Out stock form', 'vemus'),
            'input_attrs' => array(
                'placeholder' => '[contact-form-7 id="123" title="Notify me"]',
            ),
            'section' => 'section_product_card',
            'active_callback' => function() use ( $wp_customize ) {
                return ( 
                    1 == $wp_customize->get_setting( 'show_out_stock_btn' )->value()
                );
            },
      )
);

$wp_customize->add_setting(
    'attribute_first',
    array(
        'default'           => themesflat_customize_default('attribute_first'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_control( 
    'attribute_first',
    array (
        'type'      => 'select',           
        'section'   => 'section_product_card',
        'label'         => esc_html__('Attribute First (Display to card thumbnail)', 'vemus'),
        'choices'   => tfwc_attribute_customize_register(),
    )
);

$wp_customize->add_setting (
    'attr1_count',
    array(
        'default' => themesflat_customize_default('attr1_count'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'attr1_count',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Number Of Attribute 1', 'vemus'),
        'section'   => 'section_product_card',     
    )
);

$wp_customize->add_setting(
    'attribute_second',
    array(
        'default'           => themesflat_customize_default('attribute_second'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'attribute_second',
    array (
        'type'      => 'select',           
        'section'   => 'section_product_card',
        'label'         => esc_html__('Attribute Second (Display to card sumary)', 'vemus'),
        'choices'   => tfwc_attribute_customize_register(),
    )
);

$wp_customize->add_setting(
    'attr2_type',
    array(
        'default'           => themesflat_customize_default('attr2_type'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'swatches_image_hover',
      array(
          'sanitize_callback' => 'absint',
          'default' => themesflat_customize_default('swatches_image_hover'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'swatches_image_hover',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Apply swatches image when hover', 'vemus'),
        'section' => 'section_product_card',
    ))
);

$wp_customize->add_setting (
    'attr2_count',
    array(
        'default' => themesflat_customize_default('attr2_count'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'attr2_count',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Number Of Attribute 2', 'vemus'),
        'section'   => 'section_product_card',     
    )
);


function tfwc_attribute_customize_register() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return array(); 
    }
    $product_attributes = wc_get_attribute_taxonomies();
    
    $attribute_choices = array();
    
    foreach ( $product_attributes as $attribute ) {
        $attribute_choices[$attribute->attribute_name] = wc_attribute_label( $attribute->attribute_name );
    }
    
    return $attribute_choices;
}



