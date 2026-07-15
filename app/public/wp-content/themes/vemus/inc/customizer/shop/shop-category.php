<?php 
$wp_customize->add_setting(
    'show_top_category',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_top_category'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_top_category',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Top Category', 'vemus'),
        'section' => 'section_shop_category',
    ))
);

$wp_customize->add_setting(
    'top_category_style',
    array(
        'default'           => themesflat_customize_default('top_category_style'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting(
    'category_order',
    array(
        'default'           => themesflat_customize_default('category_order'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_control(
    'category_order',
    array(
        'type'      => 'select',           
        'section'   => 'section_shop_category',
        'label'     => esc_html__('Orderby Category', 'vemus'),
        'choices'   => array(
            'name'     => esc_html__( 'Name', 'vemus' ),
            'id'     => esc_html__( 'ID', 'vemus' ),
            'count'    => esc_html__( 'Count', 'vemus' ),              
        ),
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_top_category' )->value()
            );
        },
    )
);

$wp_customize->add_setting (
    'category_number',
    array(
        'default' => themesflat_customize_default('category_number'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'category_number',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Number Of Category', 'vemus'),
        'section'   => 'section_shop_category',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_top_category' )->value()
            );
        },
    )
);

$wp_customize->add_setting( 'category_columns', array(
	'default'           => themesflat_customize_default('category_columns'),
	'sanitize_callback' => 'themesflat_sanitize_responsive_columns',
) );

$wp_customize->add_control( new themesflat_ResponsiveColumnsSwitch( $wp_customize, 'category_columns', array(
	'label'    => __( 'Columns', 'vemus' ),
	'section'  => 'section_shop_category',
	'settings' => 'category_columns',
    'active_callback' => function() use ( $wp_customize ) {
        return ( 
            1 === $wp_customize->get_setting( 'show_top_category' )->value()
        );
    },
) ) );



