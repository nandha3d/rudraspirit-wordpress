
<?php 

$wp_customize->add_setting(
    'live_notification',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('live_notification'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'live_notification',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Live Notification', 'vemus'),
        'section' => 'section_live_notification',
    ))
);

$wp_customize->add_setting (
    'live_number',
    array(
        'default' => themesflat_customize_default('live_number'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'live_number',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Limit Number Display', 'vemus'),
        'section'   => 'section_live_notification',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'live_notification' )->value()
            );
        },
    )
);

$wp_customize->add_setting (
    'live_timeout',
    array(
        'default' => themesflat_customize_default('live_timeout'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'live_timeout',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Setting Timout  (ms)', 'vemus'),
        'section'   => 'section_live_notification',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'live_notification' )->value()
            );
        },
    )
);

$wp_customize->add_setting (
    'live_interval',
    array(
        'default' => themesflat_customize_default('live_interval'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'live_interval',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Setting Inteval (ms)', 'vemus'),
        'section'   => 'section_live_notification',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'live_notification' )->value()
            );
        },
    )
);



$wp_customize->add_setting(
    'product_from',
    array(
        'default'           => themesflat_customize_default('product_from'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    'product_from',
    array(
        'type'      => 'select',           
        'section'   => 'section_live_notification',
        'label'     => esc_html__('Get Product From', 'vemus'),
        'choices'   => array(
            'order'     => esc_html__( 'Product Order', 'vemus' ),
            'type'     => esc_html__( 'Product Type', 'vemus' ),            
            'category'     => esc_html__( 'Product Category', 'vemus' ),            
        ),
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'live_notification' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
    'product_type',
    array(
        'default'           => themesflat_customize_default('product_type'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    'product_type',
    array(
        'type'      => 'select',           
        'section'   => 'section_live_notification',
        'label'     => esc_html__('Product Type', 'vemus'),
        'choices'   => array(
            'recent'     => esc_html__( 'Recent', 'vemus' ),
            'featured'     => esc_html__( 'Featured', 'vemus' ),            
            'best_selling'     => esc_html__( 'Best Selling', 'vemus' ),            
            'top_rated'     => esc_html__( 'Top Rated', 'vemus' ),            
            'sale'     => esc_html__( 'Sale', 'vemus' ),                
        ),
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'live_notification' )->value()
                &&
                'type' === $wp_customize->get_setting( 'product_from' )->value()
            );
        },
    )
);

$wp_customize->add_setting( 'live_category', array(
    'default'   => themesflat_customize_default('live_category'),
    'sanitize_callback' => 'esc_attr',
) );


$wp_customize->add_control(
    'live_category',
    array(
        'type'      => 'select',           
        'section'   => 'section_live_notification',
        'label'     => esc_html__('Select categories', 'vemus'),
        'choices' => tfwc_get_product_categories(),
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'live_notification' )->value()
                &&
                'category' === $wp_customize->get_setting( 'product_from' )->value()
            );
        },
    )
);
