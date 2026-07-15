<?php

$wp_customize->add_setting(
    'tf_product_gallery_title',
    array(
        'default'   => themesflat_customize_default('tf_product_gallery_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'tf_product_gallery_layout',
    array(
        'default' => themesflat_customize_default('tf_product_gallery_layout'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_product_gallery_zoom',
    array(
        'default' => themesflat_customize_default('tf_product_gallery_zoom'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_product_gallery_lightbox',
    array(
        'default' => themesflat_customize_default('tf_product_gallery_lightbox'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )
);

$wp_customize->add_setting( 
    'tf_variation_gallery',
    array(
        'default' => themesflat_customize_default('tf_variation_gallery'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_product_video',
    array(
        'default' => themesflat_customize_default('tf_product_video'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_product_3d',
    array(
        'default' => themesflat_customize_default('tf_product_3d'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_control( new themesflat_Info( $wp_customize,
    'tf_product_gallery_title',
    array(
        'label' => esc_html__('Product Gallery', 'vemus'),
        'section' => 'section_product_gallery',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_gallery_layout',
    array(
        'label' => esc_html__('Layout', 'vemus'),
        'type' => 'select',
        'choices' => array(
            'grid' => esc_html__( 'Grid' , 'vemus' ),
            'left_thumb' => esc_html__( 'Left Thumbnail' , 'vemus' ),
            'right_thumb' => esc_html__( 'Right Thumbnail' , 'vemus' ),
            'bottom_thumb' => esc_html__( 'Bottom Thumbnail' , 'vemus' ),
            'no_thumb' => esc_html__( 'Slide no Thumbnail' , 'vemus' ),
            'middle_gallery' => esc_html__( 'Middle Gallery' , 'vemus' ),
        ),
        'section' => 'section_product_gallery',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_gallery_zoom',
    array(
        'label' => esc_html__('Zoom', 'vemus'),
        'type' => 'select',
        'choices' => array(
            '' => esc_html__( 'No zoom' , 'vemus' ),
            'inner' => esc_html__( 'Inner Zoom' , 'vemus' ),
            'inner_circle' => esc_html__( 'Inner Circle Zoom' , 'vemus' ),
            'external' => esc_html__( 'External Zoom' , 'vemus' ),
        ),
        'section' => 'section_product_gallery',
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tf_product_gallery_lightbox',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Lightbox', 'vemus'),
        'section' => 'section_product_gallery',
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tf_product_video',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Product Video', 'vemus'),
        'section' => 'section_product_gallery',
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tf_product_3d',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Product 3D Viewer', 'vemus'),
        'section' => 'section_product_gallery',
    ) )
);