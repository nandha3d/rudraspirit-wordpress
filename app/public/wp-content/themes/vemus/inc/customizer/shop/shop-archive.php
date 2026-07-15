<?php 
//Sidebar Position
$wp_customize->add_setting(
    'shop_layout',
    array(
        'default'           => themesflat_customize_default('shop_layout'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'shop_layout',
    array (
        'type'      => 'select',           
        'section'   => 'section_shop_archive',
        'priority'  => 1,
        'label'         => esc_html__('Sidebar Position', 'vemus'),
        'choices'   => array (
            'sidebar-right'     => esc_html__( 'Sidebar Right','vemus' ),
            'sidebar-left'      =>  esc_html__( 'Sidebar Left','vemus' ),
            'fullwidth'         =>   esc_html__( 'Full Width','vemus' ),
            'filter-top'     => esc_html__( 'Filter Top','vemus' ),
        ),
    )
);

$wp_customize->add_setting (
    'shop_products_per_page',
    array(
        'default' => themesflat_customize_default('shop_products_per_page'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);

$wp_customize->add_control(
    'shop_products_per_page',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Product Per Page', 'vemus'),
        'section'   => 'section_shop_archive',       
    )
);


$wp_customize->add_setting(
    'shop_pagination',
    array(
        'default'           => themesflat_customize_default('shop_pagination'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_control( 
    'shop_pagination',
    array (
        'type'      => 'select',           
        'section'   => 'section_shop_archive',
        'label'         => esc_html__('Pagination', 'vemus'),
        'choices'   => array (
            'number'     => esc_html__( 'Number','vemus' ),
            'loadmore'      =>  esc_html__( 'Load More','vemus' ),
            'autoload'      =>  esc_html__( 'Auto Load','vemus' ),
        ),

    )
);

$wp_customize->add_setting(
    'pagination_ajax',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('pagination_ajax'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'pagination_ajax',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Pagination Link Ajax', 'vemus'),
        'section' => 'section_shop_archive',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'number' == $wp_customize->get_setting( 'shop_pagination' )->value()
            );
          },
    ))
);


$wp_customize->add_setting(
    'shop_loadmore_text',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('shop_loadmore_text'),     
      )   
);

$wp_customize->add_control( 
      'shop_loadmore_text',
      array(
          'type' => 'text',
          'label' => esc_html__('Load More Text', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'loadmore' == $wp_customize->get_setting( 'shop_pagination' )->value()
            );
          },
      )
);

$wp_customize->add_setting('image_box_product', array(
    'default' => themesflat_customize_default('image_box_product'),  
    'sanitize_callback' => 'absint', 
));

$wp_customize->add_control('image_box_product', array(
    'label'    => __('Image box in loop', 'vemus'),
    'section'  => 'section_shop_archive',
    'type'     => 'checkbox',
));

$wp_customize->add_setting(
    'image_box_product_text',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('image_box_product_text'),     
      )   
);

$wp_customize->add_control( 
      'image_box_product_text',
      array(
          'type' => 'text',
          'label' => esc_html__('Text', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product' )->value()
            );
          },
      )
);

$wp_customize->add_setting(
    'image_box_product_btn_text',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('image_box_product_btn_text'),     
      )   
);

$wp_customize->add_control( 
      'image_box_product_btn_text',
      array(
          'type' => 'text',
          'label' => esc_html__('Button Text', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product' )->value()
            );
          },
      )
);

$wp_customize->add_setting(
    'image_box_product_btn_url',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('image_box_product_btn_url'),     
      )   
);

$wp_customize->add_control( 
      'image_box_product_btn_url',
      array(
          'type' => 'text',
          'label' => esc_html__('Button Url', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product' )->value()
            );
          },
      )
);

$wp_customize->add_setting(
    'image_box_product_url',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('image_box_product_url'),     
      )   
);

$wp_customize->add_control( 
      'image_box_product_url',
      array(
          'type' => 'text',
          'label' => esc_html__('Image URL', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product' )->value()
            );
          },
      )
);

$wp_customize->add_setting(
    'image_box_product_pos',
      array(
          'sanitize_callback' => 'absint',
          'default' => themesflat_customize_default('image_box_product_pos'),     
      )   
);

$wp_customize->add_control( 
      'image_box_product_pos',
      array(
          'type' => 'number',
            'input_attrs' => array(
                'min' => 1,
            ),
          'label' => esc_html__('Position', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product' )->value()
            );
          },
      )
);

$wp_customize->add_setting('image_box_product2', array(
    'default' => themesflat_customize_default('image_box_product2'),  
    'sanitize_callback' => 'absint', 
));

$wp_customize->add_control('image_box_product2', array(
    'label'    => __('Image box end loop', 'vemus'),
    'section'  => 'section_shop_archive',
    'type'     => 'checkbox',
));

$wp_customize->add_setting(
    'image_box_product_text2',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('image_box_product_text2'),
      )   
);

$wp_customize->add_control( 
      'image_box_product_text2',
      array(
          'type' => 'text',
          'label' => esc_html__('Text', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product2' )->value()
            );
          },
      )
);

$wp_customize->add_setting(
    'image_box_product_subtext2',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('image_box_product_subtext2'),
      )   
);

$wp_customize->add_control( 
      'image_box_product_subtext2',
      array(
          'type' => 'text',
          'label' => esc_html__('Sub Text', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product2' )->value()
            );
          },
      )
);

$wp_customize->add_setting(
    'image_box_product_btn_text2',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('image_box_product_btn_text2'),     
      )   
);

$wp_customize->add_control( 
      'image_box_product_btn_text2',
      array(
          'type' => 'text',
          'label' => esc_html__('Button Text', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product' )->value()
            );
          },
      )
);

$wp_customize->add_setting(
    'image_box_product_btn_url2',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('image_box_product_btn_url2'),     
      )   
);

$wp_customize->add_control( 
      'image_box_product_btn_url2',
      array(
          'type' => 'text',
          'label' => esc_html__('Button Url', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product' )->value()
            );
          },
      )
);

$wp_customize->add_setting(
    'image_box_product_url2',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('image_box_product_url2'),     
      )   
);

$wp_customize->add_control( 
      'image_box_product_url2',
      array(
          'type' => 'text',
          'label' => esc_html__('Image URL', 'vemus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 == $wp_customize->get_setting( 'image_box_product' )->value()
            );
          },
      )
);