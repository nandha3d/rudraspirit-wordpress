<?php 

$wp_customize->add_setting (
    'blog_posts_per_page',
    array(
        'default' => themesflat_customize_default('blog_posts_per_page'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);

$wp_customize->add_control(
    'blog_posts_per_page',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Post Per Page', 'vemus'),
        'section'   => 'section_content_blog_archive',
        'priority'  => 1,       
    )
);


$wp_customize->add_setting(
    'blog_archive_layout',
    array(
        'default'           => themesflat_customize_default('blog_archive_layout'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'blog_archive_layout',
    array (
        'type'      => 'select',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 2,
        'label'         => esc_html__('Blog Layout', 'vemus'),
        'choices'   => array (
            'blog-list' =>  esc_html__( 'Blog List','vemus' ),                  
            'blog-grid'=> esc_html__( 'Blog Grid','vemus' ),
            )  
    )
);
$wp_customize->add_setting(
    'blog_grid_style',
    array(
        'default'           => themesflat_customize_default('blog_grid_style'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'blog_grid_style',
    array (
        'type'      => 'select',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 2,
        'label'         => esc_html__('Blog Grid Style', 'vemus'),
        'choices'   => array (
            'style-1' =>  esc_html__( 'Style 1','vemus' ),                  
            'style-2'=> esc_html__( 'Style 2','vemus' ),
        ),
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'blog-grid' === $wp_customize->get_setting( 'blog_archive_layout' )->value()
            );
        },  
    )
);

$wp_customize->add_setting (
    'blog_sidebar_list',
    array(
        'default'           => themesflat_customize_default('blog_sidebar_list'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_DropdownSidebars($wp_customize,
    'blog_sidebar_list',
    array(
        'type'      => 'dropdown',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 4,
        'label'         => esc_html__('List Sidebar', 'vemus'),
        
    ))
);

// Entry Content Elements
$wp_customize->add_setting (
    'post_content_elements',
    array (
        'sanitize_callback' => 'themesflat_sanitize_text',
        'default' => themesflat_customize_default('post_content_elements'),     
    )
);
$wp_customize->add_control( new themesflat_Control_Drag_And_Drop( $wp_customize,
    'post_content_elements',
    array(
        'type'      => 'draganddrop-controls',
        'label'     => esc_html__('Post Content Elements', 'vemus'),
        'description' => esc_html__( 'Drag and drop elements to re-order.', 'vemus' ),
        'section'   => 'section_content_blog_archive',
        'priority'  => 5,
        'choices' => array(
            'meta'            => esc_html__( 'Meta', 'vemus' ),
            'title'           => esc_html__( 'Title', 'vemus' ),
            'excerpt_content' => esc_html__( 'Excerpt', 'vemus' ),
            'readmore'        => esc_html__( 'Read More', 'vemus' ),
        ),        
    ))
); 

// Excerpt
$wp_customize->add_setting(
    'blog_archive_post_excepts_length',
    array(
        'default'   =>  themesflat_customize_default('blog_archive_post_excepts_length'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_Slide_Control( $wp_customize,
    'blog_archive_post_excepts_length',
        array(
            'type'      =>  'slide-control',
            'section'   =>  'section_content_blog_archive',
            'label'     =>  'Post Excepts Length',
            'priority'  => 6,
            'input_attrs' => array(
                'min' => 0,
                'max' => 500,
                'step' => 1,
            ),
        )

    )
); 

// Read More Text
$wp_customize->add_setting (
    'blog_archive_readmore_text',
    array(
        'default' => themesflat_customize_default('blog_archive_readmore_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'blog_archive_readmore_text',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Read More Text', 'vemus'),
        'section'   => 'section_content_blog_archive',
        'priority'  => 7
    )
);

// Meta Elements
$wp_customize->add_setting (
    'meta_elements',
    array (
        'sanitize_callback' => 'themesflat_sanitize_text',
        'default' => themesflat_customize_default('meta_elements'),     
    )
);
$wp_customize->add_control( new themesflat_Control_Drag_And_Drop( $wp_customize,
    'meta_elements',
    array(
        'type'      => 'draganddrop-controls',
        'label'     => esc_html__('Meta Elements', 'vemus'),
        'description' => esc_html__( 'Drag and drop elements to re-order.', 'vemus' ),
        'section'   => 'section_content_blog_archive',
        'priority'  => 8,
        'choices' => array(
            'author'    => esc_html__( 'Author', 'vemus' ),
            'date'      => esc_html__( 'Date', 'vemus' ),
        ),        
    ))
); 

// Pagination
$wp_customize->add_setting(
    'blog_archive_pagination_style',
    array(
        'default'           => themesflat_customize_default('blog_archive_pagination_style'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'blog_archive_pagination_style',
    array(
        'type'      => 'select',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 9,
        'label'         => esc_html__('Pagination Style', 'vemus'),
        'choices'   => array(
            'pager'     => esc_html__('Page','vemus'),
            'numeric'         =>  esc_html__('Numeric','vemus'),
            'pager-numeric'         =>  esc_html__('Page & Numeric','vemus'),
        ),
    )
);