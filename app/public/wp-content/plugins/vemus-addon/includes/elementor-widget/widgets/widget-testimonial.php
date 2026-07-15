<?php

class Vemus_Testimonial extends \Elementor\Widget_Base {

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
		return 'vemus_testimonial';
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
		return esc_html__( 'Vemus Testimonial', 'vemus-addon' );
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
		return 'eicon-posts-carousel';
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
		return ['testimonial' , 'tf'];
	}

    public function get_style_depends() {
		return [ 'themesflat-swiper','vemus-addons' ];
	}

    public function get_script_depends() {
		return [ 'themesflat-swiper','parallaxie','slider-core' ];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Testimonial', 'vemus-addon'),
	            ]
	        );


            $this->add_control(
                'style',
                [
                    'label' => esc_html__('Style', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'style1',
                    'options'     => [
                        'style1' => esc_html__( 'Style 1', 'vemus-addon' ),
                        'style2' => esc_html__( 'Style 2', 'vemus-addon' ),
                    ],
                ]
            );

            $this->add_control(
                'title_section',
                [
                    'label' => esc_html__('Title Section', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => 'Customer <span class="fst-italic">Reviews</span>',
                    'label_block' => true,
                ]
            );

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name'     => 'banner_parallax',
					'label'    => esc_html__( 'Background Section', 'vemus-addon' ),
					'types'    => [ 'classic' ],
					'selector' => '{{WRAPPER}} .widget-testimonial',
					'fields_options' => [
						'background' => [
							'default' => 'classic',
						],
						'image' => [
							'default' => [
								'url' => TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/banner-parallax.jpg',
							],
						],
						'position' => [
							'default' => 'center center',
						],
						'attachment' => [
							'default' => 'fixed',
						],
						'repeat' => [
							'default' => 'no-repeat',
						],
						'size' => [
							'default' => 'cover',
						],
					],
				]
			);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'product_image',
                [
                    'label' => esc_html__( 'Feature Image (Style 1)', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                    ],
                ]
            );

            $repeater->add_control(
                'rating',
                [
                    'label' => esc_html__('Rating', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '5',
                    'options'     => [
                        '5' => esc_html__( '5 Stars', 'vemus-addon' ),
                        '4' => esc_html__( '4 Stars', 'vemus-addon' ),
                        '3' => esc_html__( '3 Stars', 'vemus-addon' ),
                        '2' => esc_html__( '2 Stars', 'vemus-addon' ),
                        '1' => esc_html__( '1 Star', 'vemus-addon' ),
                    ],
                ]
            );

            $repeater->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'RECOMMEND!', 'vemus-addon' ),
				]
			);		

            $repeater->add_control(
				'description',
				[
					'label' => esc_html__( 'Content', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'vemus-addon' ),
				]
			);

            $repeater->add_control(
                'avatar',
                [
                    'label' => esc_html__( 'Avatar Client (Style 1)', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                    ],
                ]
            );

            $repeater->add_control(
				'name',
				[
					'label' => esc_html__( 'Name', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Emily T.', 'vemus-addon' ),
				]
			);

            $repeater->add_control(
				'badge',
				[
					'label' => esc_html__( 'Badge', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Verified', 'vemus-addon' ),
				]
			);

			$repeater->add_control(
				'product_id',
				[
					'label' => esc_html__( 'Product', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => false,
					'options' => TFWC_Elementor_Widget_Addon::get_products(),
				]
			);

        $this->add_control( 
            'carousel_list',
                [					
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [ 
                            'name' => 'Emily T.',
                            'badge'=> 'Verified',
                            'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        ],
                        [ 
                            'name' => 'Jessica M.',
                            'badge'=> 'Verified',
                            'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        ],
                        [ 
                            'name' => 'Lisa P.',
                            'badge'=> 'Verified',
                            'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        ],
                        [ 
                            'name' => 'Emily T.',
                            'badge'=> 'Verified',
                            'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        ]
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
				'default' => 1,
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
				'default' => 1.5,
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
				'default' => 2,
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
				'default' => 1,
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
				'default' => 1.5,
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
				'default' => 2,
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

        // Start General
		$this->start_controls_section( 
			'section_style_general',
			[
				'label' => esc_html__( 'Content', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		); 

        $this->add_control(
			'heading_title_section',
			[
				'label' => esc_html__( 'Title Section Name', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_section_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .s-title',
			]
		);

		$this->add_control(
			'title_section_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .s-title' => 'color: {{VALUE}} !important;',
				],
			]
		);	

		$this->add_responsive_control(
			'title_section_margin',
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
					'{{WRAPPER}} .widget-testimonial .s-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_content',
			[
				'label' => esc_html__( 'Content', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .box_testimonial-content' => 'background-color: {{VALUE}};',
				],
			]
		);	

		$this->add_responsive_control( 
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .box_testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_badge',
			[
				'label' => esc_html__( 'Badge / Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .verify',
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .verify' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .widget-testimonial .verify .check-svg' => 'fill: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'heading_author',
			[
				'label' => esc_html__( 'Author Name', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .name',
			]
		);

		$this->add_control(
			'author_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .name' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_responsive_control(
			'author_margin',
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
					'{{WRAPPER}} .widget-testimonial .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'heading_title',
			[
				'label' => esc_html__( 'Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .title' => 'color: {{VALUE}};',
				],
			]
		);	

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
					'{{WRAPPER}} .widget-testimonial .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Description', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .text',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .text' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_responsive_control(
			'description_margin',
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
					'{{WRAPPER}} .widget-testimonial .text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Start Product
		$this->start_controls_section( 
			'section_style_product',
			[
				'label' => esc_html__( 'Product', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		); 

		$this->add_control(
			'heading_name',
			[
				'label' => esc_html__( 'Product Name', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .tf-btn-line, {{WRAPPER}} .widget-testimonial .product-text',
			]
		);

		$this->add_control(
			'title_product_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .product-text' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'style'	=> 'style2',
				],
			]
		);	

		$this->add_control(
			'title_product_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .product-text:hover' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'style'	=> 'style2',
				],
			]
		);	

        $this->add_control(
            'button2_color',
            [
                'label' => esc_html__( 'Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-testimonial .tf-btn-line' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-testimonial .tf-btn-line::after' => 'background-color: {{VALUE}};',
                ],
				'condition' => [
					'style'	=> 'style1',
				],
            ]
        );	

        $this->add_control(
            'button2_background_hover',
            [
                'label' => esc_html__( 'Color Hover', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                	'{{WRAPPER}} .widget-testimonial .tf-btn-line:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-testimonial .tf-btn-line:hover::before' => 'background-color: {{VALUE}};',
                ],
				'condition' => [
					'style'	=> 'style1',
				],
            ]
        );	

		$this->add_control(
			'heading_price',
			[
				'label' => esc_html__( 'Product Price', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
								'condition' => [
					'style'	=> 'style2',
				],
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .woocommerce-Price-amount',
								'condition' => [
					'style'	=> 'style2',
				],
			]
		);

		$this->add_control(
			'price_product_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .woocommerce-Price-amount' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'style'	=> 'style2',
				],
			]
		);	

		$this->add_control(
			'heading_rating',
			[
				'label' => esc_html__( 'Rating', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'rating_size',
			[
				'label'     => esc_html__( 'Size', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .rate-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .rate-wrap .text-star' => 'color: {{VALUE}} !important;',
				],
			]
		);	

		$this->add_responsive_control(
			'rating_margin',
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
					'{{WRAPPER}}  .widget-testimonial .rate-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section( 
			'section_style_navigation',
			[
				'label' => esc_html__( 'Arrow & Bullet', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		); 

        $this->add_control(
			'heading_arrow',
			[
				'label' => esc_html__( 'Arrow', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);

        $this->start_controls_tabs( 'arrow_styles_tab' );

            $this->start_controls_tab( 'arrow_default', [ 'label' => esc_html__( 'Default', 'vemus-addon' ) ] );
                $this->add_control(
                    'arrow_color',
                    [
                        'label' => esc_html__( 'Color', 'vemus-addon' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .group-btn-slider .tf-sw-nav' => 'color: {{VALUE}} !important;',
                        ],
                    ]
                );	
            $this->end_controls_tab();

            $this->start_controls_tab( 'arrow_disable', [ 'label' => esc_html__( 'Disable', 'vemus-addon' ) ] );
                $this->add_control(
                    'arrow_color_disable',
                    [
                        'label' => esc_html__( 'Color', 'vemus-addon' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .group-btn-slider .tf-sw-nav.swiper-button-disabled' => 'color: {{VALUE}} !important;',
                        ],
                    ]
                );	
            $this->end_controls_tab();

            $this->start_controls_tab( 'arrow_hover', [ 'label' => esc_html__( 'Hover', 'vemus-addon' ) ] );
                $this->add_control(
                    'arrow_color_hover',
                    [
                        'label' => esc_html__( 'Color', 'vemus-addon' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .group-btn-slider .tf-sw-nav:hover' => 'color: {{VALUE}} !important;',
                        ],
                    ]
                );	
            $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
			'heading_bullet',
			[
				'label' => esc_html__( 'Bullet', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);

        $this->add_control(
            'bullet_background',
            [
                'label' => esc_html__( 'Background', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sw-dot-default .swiper-pagination-bullet::before' => 'background: {{VALUE}} !important;',
                ],
            ]
        );	

        $this->add_control(
            'arrow_color_active',
            [
                'label' => esc_html__( 'Background Active', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sw-dot-default .swiper-pagination-bullet.swiper-pagination-bullet-active::before' => 'background: {{VALUE}} !important;',
                ],
            ]
        );	

        $this->add_control(
            'arrow_border_color_active',
            [
                'label' => esc_html__( 'Border Color Active', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sw-dot-default .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-color: {{VALUE}} !important;',
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
    ?>
        
        <?php
            $attr['settings'] = $settings; 
            tf_get_template_widget("testimonial/{$settings['style']}", $attr);
        ?>

        <?php
    }


}