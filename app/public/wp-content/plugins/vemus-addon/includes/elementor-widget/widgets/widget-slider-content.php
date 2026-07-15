<?php

class Vemus_Slider_Content extends \Elementor\Widget_Base {

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
		return 'vemus_slider_content';
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
		return esc_html__( 'Vemus Slider Content', 'vemus-addon' );
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
		return 'eicon-slides';
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
		return ['slider' , 'tf'];
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
	                'label' => esc_html__('Vemus Slider', 'vemus-addon'),
	            ]
	        );

			$this->add_group_control(
				\Elementor\Group_Control_Image_Size::get_type(),
				[
					'name'      => 'image_size', 
					'default'   => 'full',
					'separator' => 'none',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name'     => 'banner_parallax',
					'label'    => esc_html__( 'Background Section', 'vemus-addon' ),
					'types'    => [ 'classic' ],
					'selector' => '{{WRAPPER}} .tf-slideshow.slider-content .slider_wrap',
					'fields_options' => [
						'background' => [
							'default' => 'classic',
						],
						'image' => [
							'default' => [
								'url' => TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/slider2.jpg',
							],
						],
						'position' => [
							'default' => 'center center',
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

        $this->end_controls_section();

		$this->start_controls_section( 'slider1_setting',
	        [
	            'label' => esc_html__('Vemus Slider Repeater', 'vemus-addon'),
	        ]
	    );

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( 'slides_repeater' );

		$repeater->start_controls_tab( 'text_content', [ 'label' => esc_html__( 'Content', 'vemus-addon' ) ] );

		$repeater->add_control(
            'slider_image',
            [
                'label' => esc_html__('Image', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

		$repeater->add_control(
			'tagline',
			[
				'label' => esc_html__( 'Tagline / Subheading', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Sacred Rudraksha from Nepal', 'vemus-addon' ),
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Style Redefined', 'vemus-addon' ),
			]
		);	

		$repeater->add_control(
			'features_text',
			[
				'label' => esc_html__( 'Features Bar Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '100% Authentic • Lab Certified • Energized', 'vemus-addon' ),
			]
		);

		$repeater->add_control(
			'desc',
			[
				'label' => esc_html__( 'Description', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Make a statement with colors and cuts that stand out. Be bold, be beautiful.', 'vemus-addon' ),
			]
		);

			$repeater->add_control(
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

			$repeater->add_control( 
				'button_text',
				[
					'label' => esc_html__( 'Button Text', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Read More', 'vemus-addon' ),
					'condition' => [
	                    'show_button'	=> 'yes',
	                ],
				]
			);

	        $repeater->add_control(
				'link_button',
				[
					'label' => esc_html__( 'Link', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'vemus-addon' ),
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
					'condition' => [
						'show_button' => 'yes'
					]
				]
			);

			$repeater->end_controls_tab();

			$repeater->start_controls_tab( 'style_tab', [ 'label' => esc_html__( 'Style', 'vemus-addon' ) ] );

				$repeater->add_control(
					'heading_re_tagline_style',
					[
						'label' => __( 'Tagline / Subheading', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);

				$repeater->add_control(
					're_tagline_color',
					[
						'label' => __( 'Tagline Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .hero-tagline-auth, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap {{CURRENT_ITEM}}_content .hero-tagline-auth, {{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .sub-title-sld-top' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					'heading_re_title_style',
					[
						'label' => __( 'Title', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);
				
				$repeater->add_control(
					're_title_color',
					[
						'label' => __( 'Title Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .title-sld-2, {{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .hero-main-title-rudra, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap {{CURRENT_ITEM}}_content .title-sld-2, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap {{CURRENT_ITEM}}_content .hero-main-title-rudra' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					'heading_re_features_style',
					[
						'label' => __( 'Features Bar & Divider', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);

				$repeater->add_control(
					're_features_color',
					[
						'label' => __( 'Features Bar Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .hero-features-bar, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap {{CURRENT_ITEM}}_content .hero-features-bar' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're_divider_color',
					[
						'label' => __( 'Divider Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .hero-divider-custom .divider-dot, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap {{CURRENT_ITEM}}_content .hero-divider-custom .divider-dot, {{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .hero-divider-custom .divider-lotus, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap {{CURRENT_ITEM}}_content .hero-divider-custom .divider-lotus' => 'color: {{VALUE}} !important;',
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .hero-divider-custom .divider-line, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap {{CURRENT_ITEM}}_content .hero-divider-custom .divider-line' => 'background: linear-gradient(90deg, {{VALUE}}, transparent) !important;',
						],
					]
				);

				$repeater->add_control(
					'heading_re_desc_style',
					[
						'label' => __( 'Description', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);

				$repeater->add_control(
					're_desc_color',
					[
						'label' => __( 'Description Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .sub-title-sld, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap {{CURRENT_ITEM}}_content .sub-title-sld' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					'heading_re_button_style',
					[
						'label' => __( 'Button', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);

				$repeater->add_control(
					're_btn_color',
					[
						'label' => __( 'Button Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're_btn_background_color',
					[
						'label' => __( 'Button Background Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn' => 'background-color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're_border_btn_background_color',
					[
						'label' => __( 'Border Button Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn' => 'border-color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're_btn_color_hover',
					[
						'label' => __( 'Button Color Hover', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn:hover' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're_btn_background_color_hover',
					[
						'label' => __( 'Button Color Hover', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn:hover' => 'background-color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're_border_btn_background_color_hover',
					[
						'label' => __( 'Border Button Color Hover', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn:hover' => 'border-color: {{VALUE}} !important;',
						],
					]
				);
	
			$repeater->end_controls_tab();

			$this->add_control( 
				'slider_list',
					[					
						'type' => \Elementor\Controls_Manager::REPEATER,
						'fields' => $repeater->get_controls(),
						'default' => [
							[ 
								'title' => 'Style Redefined',
								'button_text'=> 'Shop Collection',
								'link_button'=> '#',
							],
							[ 
								'title' => 'Elegance Redefined',
								'description'=> 'Discover the latest trends in fashion that speak your style.',
								'button_text'=> 'Shop Collection',
								'link_button'=> '#',
							],
							[ 
								'title' => 'Elevate Your Wardrobe',
								'button_text'=> 'Shop Collection',
								'link_button'=> '#',
							],
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

			$this->add_control(
				'autoplay_enable',
				[ 
					'label'        => esc_html__( 'Auto Play', 'vemus-addon' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'On', 'vemus-addon' ),
					'label_off'    => esc_html__( 'Off', 'vemus-addon' ),
					'return_value' => 'yes',
					'default'      => 'no'
				]
			);

			$this->add_control(
				'loop_enable',
				[ 
					'label'        => esc_html__( 'Infinity Loop', 'vemus-addon' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'On', 'vemus-addon' ),
					'label_off'    => esc_html__( 'Off', 'vemus-addon' ),
					'return_value' => 'yes',
					'default'      => 'no'
				]
			);

			$this->add_control(
				'bullet_enable',
				[ 
					'label'        => esc_html__( 'Bullet', 'vemus-addon' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'On', 'vemus-addon' ),
					'label_off'    => esc_html__( 'Off', 'vemus-addon' ),
					'return_value' => 'yes',
					'default'      => 'yes'
				]
			);

        $this->end_controls_section();



		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Style', 'vemus-addon' ),
            	'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_tagline_style',
			[
				'label' => __( 'Tagline / Subheading Style', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'tagline_color',
			[
				'label' => __( 'Tagline Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .hero-tagline-auth, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .hero-tagline-auth, {{WRAPPER}} .tf-slideshow .sub-title-sld-top' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'heading_features_style',
			[
				'label' => __( 'Features Bar & Divider Style', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'features_color',
			[
				'label' => __( 'Features Bar Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .hero-features-bar, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .hero-features-bar' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Divider Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .hero-divider-custom .divider-dot, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .hero-divider-custom .divider-dot, {{WRAPPER}} .tf-slideshow .hero-divider-custom .divider-lotus, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .hero-divider-custom .divider-lotus' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .tf-slideshow .hero-divider-custom .divider-line, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .hero-divider-custom .divider-line' => 'background: linear-gradient(90deg, {{VALUE}}, transparent) !important;',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title Style', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tf-slideshow .title-sld-2, {{WRAPPER}} .tf-slideshow .title-sld-4',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .title-sld-2, {{WRAPPER}} .tf-slideshow .hero-main-title-rudra, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .title-sld-2, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .hero-main-title-rudra' => 'color: {{VALUE}} !important;',
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
					'{{WRAPPER}}  .tf-slideshow .title-sld-2, {{WRAPPER}}  .tf-slideshow .title-sld-4' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'heading_title_span_style',
			[
				'label' => __( 'Title Highlight Span Tag', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_span_typography',
				'selector' => '{{WRAPPER}} .tf-slideshow .title-sld-2 span, {{WRAPPER}} .tf-slideshow .title-sld-4 span',
			]
		);

		$this->add_control(
			'title_span_color',
			[
				'label' => __( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .title-sld-2 span, {{WRAPPER}} .tf-slideshow .hero-main-title-rudra span, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .title-sld-2 span, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .hero-main-title-rudra span' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'heading_desc_style',
			[
				'label' => __( 'Description Style', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .tf-slideshow .sub-title-sld',
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .sub-title-sld, {{WRAPPER}} .tf-slideshow.slider-content .slider_wrap .sub-title-sld' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'desc_margin',
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
					'{{WRAPPER}}  .tf-slideshow .sub-title-sld' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

	$this->add_control(
		'heading_button2',
		[
			'label' => esc_html__( 'Button', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::HEADING,					
			'separator' => 'before',
		]
	);	

	$this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'button2_typography',
            'selector' => '{{WRAPPER}} .tf-slideshow .tf-btn',
        ]
    );
		
		$this->add_responsive_control( 
			'button2_padding',
			[
				'label' => esc_html__( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .tf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button2_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .tf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs('button_styles_tabs2');

			$this->start_controls_tab('button_styles_tab2', ['label' => 'Normal']);

							$this->add_control(
					'button2_color',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow .tf-btn' => 'color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button2_background',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow .tf-btn' => 'background-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button2_border_color',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow .tf-btn' => 'border-color: {{VALUE}};',
						],
					]
				);	
			$this->end_controls_tab();

			$this->start_controls_tab('button_styles_tab2_hover', ['label' => 'Hover']);
							$this->add_control(
					'button2_color_hover',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow .tf-btn:hover' => 'color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button2_background_hover',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow .tf-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button2_border_color_hover',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow .tf-btn:hover' => 'border-color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();





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
        
        <!-- Banner Slider -->
        <div class="tf-slideshow widget-slider-1 slider-content">
                <div dir="ltr" class="swiper tf-swiper tfc-swiper sw-slide-show slider_effect_fade" data-auto="<?php echo esc_attr($settings['autoplay_enable'] == 'yes' ? 'true' : 'false'); ?>" data-loop="<?php echo esc_attr($settings['loop_enable'] == 'yes' ? 'true' : 'false'); ?>" data-effect="fade"
                    data-delay="3000">
                    <div class="swiper-wrapper">

                        <?php foreach ($settings['slider_list'] as $slider):
                            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src(
								$slider['slider_image']['id'],
								'image_size',
								$settings
							);
                            if ( empty($image_url) && !empty($slider['slider_image']['url']) ) {
                                $image_url = $slider['slider_image']['url'];
                            }
                            ?>	
                            <div class="swiper-slide">
                                <div class="slider_wrap elementor-repeater-item-<?php echo esc_attr($slider['_id']);?>_content">

                                    <div class="sld-image2">
                                        <?php if ( $image_url ) : ?>
                                            <img src="<?php echo esc_url( $image_url ); ?>" alt="Image">
                                        <?php else: ?>
                                            <img src="<?php echo TF_PLUGIN_URL."includes/elementor-widget/assets/images/slider-1.jpg"; ?>" alt="Image">
                                        <?php endif; ?>
                                    </div>

                                    <div class="sld-content">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="content-sld">
                                                        <?php if ( !empty($slider['tagline']) || $slider['title'] ) : ?>
                                                            <div class="fade-item fade-item-0">
                                                                <span class="hero-tagline-auth"><?php echo !empty($slider['tagline']) ? wp_kses_post($slider['tagline']) : 'Sacred Rudraksha from Nepal'; ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ( $slider['title'] ) : ?>
                                                            <div class="wrap-item fade-item fade-item-1">
                                                                <h3 class="title-sld-2 hero-main-title-rudra">
                                                                    <?php echo wp_kses_post($slider['title']); ?>
																</h3>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ( !empty($slider['features_text']) || $slider['title'] ) : ?>
                                                            <div class="fade-item fade-item-1-5">
                                                                <div class="hero-divider-custom">
                                                                    <span class="divider-line"></span>
                                                                    <span class="divider-dot">♦</span>
                                                                    <span class="divider-line"></span>
                                                                </div>
                                                                <div class="hero-features-bar"><?php echo !empty($slider['features_text']) ? wp_kses_post($slider['features_text']) : '100% Authentic • Lab Certified • Energized'; ?></div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ( $slider['desc'] ) : ?>
                                                            <div class="fade-item fade-item-2">
                                                                <p class="sub-title-sld">
                                                                    <?php echo wp_kses_post($slider['desc']); ?>
                                                                </p>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php 
                                                        $show_btn = ! isset( $slider['show_button'] ) || $slider['show_button'] === 'yes';
                                                        if ( ! empty( $slider['button_text'] ) && $show_btn ) : 
                                                            $link_url = '#';
                                                            $link_target = '';
                                                            $link_rel = '';
                                                            if ( is_array( $slider['link_button'] ) && ! empty( $slider['link_button']['url'] ) ) {
                                                                $link_url = $slider['link_button']['url'];
                                                                if ( ! empty( $slider['link_button']['is_external'] ) ) {
                                                                    $link_target = ' target="_blank"';
                                                                }
                                                                if ( ! empty( $slider['link_button']['nofollow'] ) ) {
                                                                    $link_rel = ' rel="nofollow"';
                                                                }
                                                            } elseif ( is_string( $slider['link_button'] ) && ! empty( $slider['link_button'] ) ) {
                                                                $link_url = $slider['link_button'];
                                                            }
                                                        ?>
                                                            <div class="fade-item fade-item-3">
                                                                <a href="<?php echo esc_url( $link_url ); ?>"<?php echo $link_target . $link_rel; ?> class="tf-btn type-large style-white-2">
                                                                    <?php echo wp_kses_post( $slider['button_text'] ); ?>
                                                                    <i class="icon-arrow-right fs-24"></i>
                                                                </a>
                                                            </div>
                                                         <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach;?>

                    </div>

                    <?php if ( $settings['bullet_enable'] == 'yes' ) : ?>
                        <div class="sw-dot-default style-white tf-sw-pagination"></div>
                    <?php endif; ?>

                </div>
        </div>
        <!-- /Banner Slider -->

            <?php
        }


}