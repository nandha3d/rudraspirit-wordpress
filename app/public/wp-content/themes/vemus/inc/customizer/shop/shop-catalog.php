<?php 
$wp_customize->add_setting(
    'catalog_toolbar',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('catalog_toolbar'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'catalog_toolbar',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Catalog Toolbar', 'vemus'),
        'section' => 'section_shop_catalog',
    ))
);



$wp_customize->add_setting('catalog_btn_change', array(
    'default' => themesflat_customize_default('catalog_btn_change'),  
    'sanitize_callback' => 'absint', 
));

$wp_customize->add_control('catalog_btn_change', array(
    'label'    => __('Show Catalog Button Filter', 'vemus'),
    'section'  => 'section_shop_catalog',
    'type'     => 'checkbox', 
    'active_callback' => function() use ( $wp_customize ) {
        return ( 
            1 === $wp_customize->get_setting( 'catalog_toolbar' )->value()
        );
    },
));

$wp_customize->add_setting('catalog_sort_by', array(
    'default' => themesflat_customize_default('catalog_sort_by'),  
    'sanitize_callback' => 'absint', 
));

$wp_customize->add_control('catalog_sort_by', array(
    'label'    => __('Show Catalog Sort By', 'vemus'),
    'section'  => 'section_shop_catalog',
    'type'     => 'checkbox', 
    'active_callback' => function() use ( $wp_customize ) {
        return ( 
            1 === $wp_customize->get_setting( 'catalog_toolbar' )->value()
        );
    },
));

$wp_customize->add_setting('catalog_view', array(
    'default' => themesflat_customize_default('catalog_view'),  
    'sanitize_callback' => 'absint', 
));

$wp_customize->add_control('catalog_view', array(
    'label'    => __('Show Catalog View', 'vemus'),
    'section'  => 'section_shop_catalog',
    'type'     => 'checkbox', 
    'active_callback' => function() use ( $wp_customize ) {
        return ( 
            1 === $wp_customize->get_setting( 'catalog_toolbar' )->value()
        );
    },
));

$wp_customize->add_setting (
    'number_view',
    array(
        'default' => themesflat_customize_default('number_view'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'number_view',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Number Of Column View', 'vemus'),
        'section'   => 'section_shop_catalog',
        'description'   => 'Max 7 Column View ',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'catalog_view' )->value()
                && 
                1 === $wp_customize->get_setting( 'catalog_toolbar' )->value()
            );
        },
    )
);

$wp_customize->add_setting (
    'number_view_active',
    array(
        'default' => themesflat_customize_default('number_view_active'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'number_view_active',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Number Active View', 'vemus'),
        'section'   => 'section_shop_catalog',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'catalog_view' )->value()
                && 
                1 === $wp_customize->get_setting( 'catalog_toolbar' )->value()
            );
        },
    )
);