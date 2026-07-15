<?php
$wp_customize->add_setting(
    'recently_wl_display',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('recently_wl_display'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'recently_wl_display',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Recently Product', 'vemus'),
        'section' => 'wcboost_wishlist_page',
    ))
);


$wp_customize->add_setting (
    'recently_wl_heading',
    array(
        'default' => themesflat_customize_default('recently_wl_heading'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'recently_wl_heading',
    array(
        'type'      => 'textarea',
        'label'     => esc_html__('Heading Recently', 'vemus'),
        'section'   => 'wcboost_wishlist_page',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'recently_wl_display' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
    'recently_wl_style',
    array(
        'default'           => themesflat_customize_default('recently_wl_style'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting (
    'recently_wl_limit',
    array(
        'default' => themesflat_customize_default('recently_wl_limit'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'recently_wl_limit',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Limit Product', 'vemus'),
        'section'   => 'wcboost_wishlist_page',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'recently_wl_display' )->value()
            );
        },
    )
);

$wp_customize->add_setting( 'recently_wl_product_columns', array(
	'default'           => themesflat_customize_default('recently_wl_product_columns'),
	'sanitize_callback' => 'themesflat_sanitize_responsive_columns',
) );

$wp_customize->add_control( new themesflat_ResponsiveColumnsSwitch( $wp_customize, 'recently_wl_product_columns', array(
	'label'    => __( 'Columns', 'vemus' ),
	'section'  => 'wcboost_wishlist_page',
	'settings' => 'recently_wl_product_columns',
    'active_callback' => function() use ( $wp_customize ) {
        return ( 
            1 === $wp_customize->get_setting( 'recently_wl_display' )->value()
        );
    },
) ) );