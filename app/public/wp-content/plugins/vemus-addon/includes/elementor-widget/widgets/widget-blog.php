<?php

class Vemus_Blog extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null) {
		parent::__construct( $data, $args );
    }

	/**
	 * Get widget name.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'vemus_blog';
	}

	/**
	 * Get widget title.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Vemus Blog', 'vemus-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Get widget categories.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'vemus_addons_core' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['blog' , 'tf'];
	}

    public function get_style_depends() {
		return [ 'themesflat-swiper','vemus-addons' ];
	}

    public function get_script_depends() {
		return [ 'themesflat-swiper','slider-core' ];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Blog', 'vemus-addon'),
	            ]
	        );

            $this->add_control( 
				'posts_per_page',
	            [
	                'label' => esc_html__( 'Posts Per Page', 'vemus-addon' ),
	                'type' => \Elementor\Controls_Manager::NUMBER,
	                'default' => '3',
	            ]
	        );

	        $this->add_control( 
	        	'order_by',
				[
					'label' => esc_html__( 'Order By', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [						
			            'date' => esc_html__( 'Date', 'vemus-addon' ),
			            'ID' => esc_html__( 'Post ID', 'vemus-addon' ),			            
			            'title' => esc_html__( 'Title', 'vemus-addon' ),
					],
				]
			);

			$this->add_control( 
				'order',
				[
					'label' => esc_html__( 'Order', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'desc',
					'options' => [						
			            'desc' => esc_html__( 'Descending', 'vemus-addon' ),
			            'asc' => esc_html__( 'Ascending', 'vemus-addon' ),	
					],
				]
			);

			$this->add_control( 
				'posts_categories',
				[
					'label' => esc_html__( 'Categories', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'options' => TFWC_Elementor_Widget_Addon::tf_get_taxonomies(),
					'label_block' => true,
	                'multiple' => true,
				]
			);

			$this->add_control( 
				'exclude',
				[
					'label' => esc_html__( 'Exclude', 'vemus-addon' ),
					'type'	=> \Elementor\Controls_Manager::TEXT,	
					'description' => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'vemus-addon' ),
					'default' => '',
					'label_block' => true,				
				]
			);

            $this->add_group_control( 
				\Elementor\Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail',
					'default' => 'full',
				]
			);

            $this->add_control(
				'show_tags',
				[
					'label' => esc_html__( 'Show Tags', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'vemus-addon' ),
					'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

            $this->add_control(
				'show_date',
				[
					'label' => esc_html__( 'Show Date', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'vemus-addon' ),
					'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

            $this->add_control(
				'show_author',
				[
					'label' => esc_html__( 'Show Author', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'vemus-addon' ),
					'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

            $this->add_control(
				'show_comment',
				[
					'label' => esc_html__( 'Show Comment', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'vemus-addon' ),
					'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

            $this->add_control(
				'show_button',
				[
					'label' => esc_html__( 'Show Button', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'vemus-addon' ),
					'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

            $this->add_control( 
				'button_text',
				[
					'label' => esc_html__( 'Button Text', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Read more', 'vemus-addon' ),
                    'condition' => [
						'show_button'	=> 'yes',
					],
				]
			);	


            $this->end_controls_section();

             // Start Carousel Setting        
			$this->start_controls_section( 'carousel_setting',
                [
                    'label' => esc_html__('Carousel Settings', 'vemus-addon'),
                ]
            );

            $this->add_responsive_control( 
                'spacing',
                [
                    'label' => esc_html__( 'Spacing', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                	'devices' => ['desktop', 'tablet', 'mobile'],
                	'default' => 30,
                	'tablet_default' => 30,
                	'mobile_default' => 30,
					'frontend_available' => true,
                ]
            );


		$this->add_control(
			'group-slidesPerView',
			[
				'label' => esc_html__( 'Slides Per View', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'default' => '',	
			]
		);

		$this->start_popover();

		$this->add_control(
			'slidesPerView-xs',
			[
				'label' => esc_html__( 'XS (<576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'group-slidesPerView' =>'yes'
				],
			]
		);

		$this->add_control(
			'slidesPerView-sm',
			[
				'label' => esc_html__( 'SM (≥576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'condition' => [
					'group-slidesPerView' =>'yes'
				],
			]
		);
		
		$this->add_control(
			'slidesPerView-md',
			[
				'label' => esc_html__( 'MD (≥768px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 2,
				'max' => 10,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'group-slidesPerView' =>'yes'
				],
			]
		);
		
		$this->add_control(
			'slidesPerView-xl',
			[
				'label' => esc_html__( 'XL (≥1200px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 2,
				'max' => 10,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'group-slidesPerView' =>'yes'
				],
			]
		);
		
		$this->end_popover();

	  	$this->add_control(
			'group-slidesPerGroup',
			[
				'label' => esc_html__( 'Slides Per Group', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'default' => '',	
			]
		);

		$this->start_popover();

		$this->add_control(
			'slidesPerGroup-xs',
			[
				'label' => esc_html__( 'XS (<576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'group-slidesPerGroup' =>'yes'
				],
			]
		);

		$this->add_control(
			'slidesPerGroup-sm',
			[
				'label' => esc_html__( 'SM (≥576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'condition' => [
					'group-slidesPerGroup' =>'yes'
				],
			]
		);
		
		$this->add_control(
			'slidesPerGroup-md',
			[
				'label' => esc_html__( 'MD (≥768px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'group-slidesPerGroup' =>'yes'
				],
			]
		);
		
		$this->add_control(
			'slidesPerGroup-xl',
			[
				'label' => esc_html__( 'XL (≥1200px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'group-slidesPerGroup' =>'yes'
				],
			]
		);
		
		$this->end_popover();

            $this->add_responsive_control(
                'carousel-pagination',
                [
                    'label' => esc_html__('Pagination', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'devices' => ['desktop', 'tablet', 'mobile'],
                    'default' => 'bullet',
                    'tablet_default' => 'bullet',
                    'mobile_default' => 'bullet',
                    'options'     => [
                        'none' => esc_html__( 'None', 'vemus-addon' ),
                        'bullet' => esc_html__( 'Bullets', 'vemus-addon' ),
                        'arrow' => esc_html__( 'Arrows', 'vemus-addon' ),
                        'arrow-bullet' => esc_html__( 'Arrows & Bullets', 'vemus-addon' ),
                    ],
                    'description' => esc_html__('Works only when the number of items exceeds the current Slides to Show.', 'vemus-addon'),
                    'frontend_available' => true,
                ]
            );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'vemus-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-blog .title',
        ] );

        $this->add_control( 'title_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-blog .title a' => 'color: {{VALUE}} !important',
            ],
        ] );

        $this->add_control( 'title_color_hover', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-blog .title a:hover' => 'color: {{VALUE}} !important',
            ],
        ] );

        $this->add_responsive_control(
			'title_margin',
			[
				'label'     => esc_html__( 'Spacing', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .widget-blog .title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_control(
            'meta_heading',
            [
                'label' => esc_html__( 'Meta', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'meta_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-blog .meta-list li',
        ] );

        $this->add_control( 'meta_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-blog .meta-list li' => 'color: {{VALUE}} !important',
            ],
        ] );

        $this->add_responsive_control(
			'meta_margin',
			[
				'label'     => esc_html__( 'Spacing', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .widget-blog .meta-list' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);


        $this->end_controls_section();


	}

	/**
	 * Render vemus Button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function render(): void {
    $settings = $this->get_settings_for_display();

        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
         } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
         } else {
            $paged = 1;
         }
        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'paged'     => $paged
        );
        if (! empty( $settings['posts_categories'] )) {
            $query_args['category_name'] = implode(',', $settings['posts_categories']);
        }        
        if ( ! empty( $settings['exclude'] ) ) {				
            if ( ! is_array( $settings['exclude'] ) )
                $exclude = explode( ',', $settings['exclude'] );
        
            $query_args['post__not_in'] = $exclude;
        }
        $query_args['orderby'] = $settings['order_by'];
        $query_args['order'] = $settings['order'];	
        $query = new WP_Query( $query_args );

        $slides_per_view_xs = !empty($settings['slidesPerView-xs']) ? $settings['slidesPerView-xs'] : 1;
		$slides_per_view_sm = !empty($settings['slidesPerView-sm']) ? $settings['slidesPerView-sm'] : 2;
		$slides_per_view_md = !empty($settings['slidesPerView-md']) ? $settings['slidesPerView-md'] : 3;
		$slides_per_view_xl = !empty($settings['slidesPerView-xl']) ? $settings['slidesPerView-xl'] : 3;
		
		$slides_per_group_xs = !empty($settings['slidesPerGroup-xs']) ? $settings['slidesPerGroup-xs'] : 1;
		$slides_per_group_sm = !empty($settings['slidesPerGroup-sm']) ? $settings['slidesPerGroup-sm'] : 2;
		$slides_per_group_md = !empty($settings['slidesPerGroup-md']) ? $settings['slidesPerGroup-md'] : 3;
		$slides_per_group_xl = !empty($settings['slidesPerGroup-xl']) ? $settings['slidesPerGroup-xl'] : 3;

        $space_between_mobile = !empty($settings['spacing_mobile']) ? $settings['spacing_mobile'] : 0;
        $space_between_tablet = !empty($settings['spacing_tablet']) ? $settings['spacing_tablet'] : 0;
        $space_between_desktop = !empty($settings['spacing']) ? $settings['spacing'] : 0;

        $carousel_pagination_desktop = !empty($settings['carousel-pagination']) ? $settings['carousel-pagination'] : false;
		$carousel_pagination_tablet =!empty($settings['carousel-pagination_tablet']) ? $settings['carousel-pagination_tablet'] : $settings['carousel-pagination'];
		$carousel_pagination_mobile =!empty($settings['carousel-pagination_mobile']) ? $settings['carousel-pagination_mobile'] : $settings['carousel-pagination'];
    ?>

        <!-- Blog -->
        <section class="widget-blog">

                <div class="group-pagination <?php echo esc_attr($carousel_pagination_desktop); ?>-desktop <?php echo esc_attr($carousel_pagination_tablet); ?>-tablet <?php echo esc_attr($carousel_pagination_mobile); ?>-mobile">
                    <div class="wrap-arrow">
                        <div class="nav-swiper style-2 nav-prev-swiper d-none d-lg-flex">
                            <i class="icon-arrow-left"></i>
                        </div>
                        <div class="nav-swiper style-2 nav-next-swiper d-none d-lg-flex">
                            <i class="icon-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <div dir="ltr" class="swiper tf-swiper tfc-swiper" data-preview="<?php echo esc_attr($slides_per_view_xl); ?>" data-tablet="<?php echo esc_attr($slides_per_view_md); ?>" data-mobile-sm="<?php echo esc_attr($slides_per_view_sm); ?>" data-mobile="<?php echo esc_attr($slides_per_view_xs); ?>" data-space-lg="<?php echo esc_attr($space_between_desktop); ?>"
                    data-space-md="<?php echo esc_attr($space_between_tablet); ?>" data-space="<?php echo esc_attr($space_between_mobile); ?>" data-pagination="<?php echo esc_attr($slides_per_group_xs); ?>" data-pagination-sm="<?php echo esc_attr($slides_per_group_sm); ?>" data-pagination-md="<?php echo esc_attr($slides_per_group_md); ?>" data-pagination-lg="<?php echo esc_attr($slides_per_group_xl); ?>">
                    <div class="swiper-wrapper">
                    <?php if ( $query->have_posts() ) : ?>
                    <?php while ( $query->have_posts() ) : $query->the_post();?>
                        <?php 
                        $get_id_post_thumbnail = get_post_thumbnail_id();
                        $featured_image = sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));  
                        ?>

                        <div class="swiper-slide">
                            <div class="article-blog style-2 hover-img4 wow fadeInLeft">
                                <div class="entry_image">
                                    <a href="<?php echo esc_url( get_permalink() ) ?>" class="image img-style4">
                                        <?php echo sprintf( '%s', $featured_image ); ?>
                                    </a>
                                        <?php
                                            if ($settings['show_tags'] == 'yes') :
                                            $tags = get_the_tags();
                                            if ( $tags && ! is_wp_error( $tags ) ) :
                                        ?>
                                                <div class="entry_tag">
                                                    <?php foreach ( $tags as $tag ) : ?>
                                                        <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" 
                                                        class="name-tag text-caption link">
                                                            <?php echo esc_html( $tag->name ); ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                </div>

                                <div class="blog-content">
                                    <div class="box-title">

                                        <h5 class="title">
                                            <a href="<?php echo esc_url( get_permalink() ) ?>" class="link fw-normal text-line-clamp-2">
                                                <?php echo get_the_title(); ?>
                                            </a>
                                        </h5>

                                        <ul class="meta-list">
                                            <?php if ($settings['show_date'] == 'yes') :?>
                                            <li class="entry_day letter-space-0 text-caption text-main-4">
                                                <?php echo get_the_date( 'd M y' ); ?>
                                            </li>
                                            <?php endif; ?>
                                            <?php if ($settings['show_author'] == 'yes') :?>
                                            <li class="icon icon-rhombus"></li>
                                            <li class="entry_name letter-space-0 text-caption text-main-4">
                                               <?php the_author(); ?>
                                            </li>
                                            <?php endif; ?>
                                            <?php if ($settings['show_comment'] == 'yes') :?>
                                            <li class="icon icon-rhombus"></li>
                                            <li class="entry_comment letter-space-0 text-caption text-main-4">
                                                <?php
                                                    $comments_count = get_comments_number();
                                                    if ( $comments_count == 0 ) {
                                                        echo 'No Comment';
                                                    } elseif ( $comments_count == 1 ) {
                                                        echo '1 Comment';
                                                    } else {
                                                        echo esc_html( $comments_count ) . ' Comments';
                                                    }
                                                ?>
                                            </li>
                                            <?php endif; ?>
                                        </ul>

                                    </div>
                                    <?php if ($settings['show_button'] == 'yes') :?>
                                        <div class="box-btn">
                                            <a href="<?php echo esc_url( get_permalink() ) ?>" class="tf-btn-line hv-2 lh-28 text-uppercase fw-normal">
                                            <?php echo esc_attr( $settings['button_text'] ); ?>
                                                <i class="ic icon-arrow-right-2"></i></a>
                                        </div>
                                    <?php endif; ?>
                                </div>


                            </div>
                        </div>

                        <?php endwhile; 
                            wp_reset_postdata();
                        ?>

                        <?php
                        else:
                        	esc_html_e('No posts found', 'vemus-addon');
                        endif; ?>

                    </div>

                    <div class="group-pagination <?php echo esc_attr($carousel_pagination_desktop); ?>-desktop <?php echo esc_attr($carousel_pagination_tablet); ?>-tablet <?php echo esc_attr($carousel_pagination_mobile); ?>-mobile">
                        <div class="wrap-bullet">
                            <div class="sw-dot-default tf-sw-pagination"></div>
                        </div>
                    </div>

                </div>

        </section>
        <!-- /Blog -->
        
    <?php
    }



}