<?php

class Vemus_Slider extends \Elementor\Widget_Base {

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
		return 'vemus_slider';
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
		return esc_html__( 'Vemus Slider', 'vemus-addon' );
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

			$this->add_control(
                'style',
                [
                    'label' => esc_html__('Style', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'style1',
                    'options'     => [
                        'style1' => esc_html__( 'Style 1', 'vemus-addon' ),
                        'style2' => esc_html__( 'Style 2', 'vemus-addon' ),
                        'style3' => esc_html__( 'Style 3', 'vemus-addon' ),
                    ],
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

        $this->end_controls_section();

		$this->start_controls_section( 'slider1_setting',
	        [
	            'label' => esc_html__('Vemus Slider Repeater', 'vemus-addon'),
				'condition' => [
                    'style'	=> 'style1',
                ],
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
			'is_3d_slide',
			[
				'label' => esc_html__( 'Enable 3D Spiritual ThreeJS Hero', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => 'no',
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
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .title-sld-2, {{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .title-sld-4' => 'color: {{VALUE}} !important;',
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
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .sub-title-sld' => 'color: {{VALUE}} !important;',
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

		$this->start_controls_section( 'slider2_setting',
	        [
	            'label' => esc_html__('Vemus Slider Repeater', 'vemus-addon'),
				'condition' => [
                    'style'	=> ['style2', 'style3'],
                ],
	        ]
	    );

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( 'slides_repeater2' );

		$repeater->start_controls_tab( 'text_content2', [ 'label' => esc_html__( 'Content', 'vemus-addon' ) ] );

		$repeater->add_control(
            'slider2_image',
            [
                'label' => esc_html__('Image', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

		$repeater->add_control(
			'subtitle2',
			[
				'label' => esc_html__( 'Subtitle', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'ring collection', 'vemus-addon' ),
			]
		);

		$repeater->add_control(
			'title2',
			[
				'label' => esc_html__( 'Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Style Redefined', 'vemus-addon' ),
			]
		);	

			$repeater->add_control(
				'show_button2',
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
				'button2_text',
				[
					'label' => esc_html__( 'Button Text', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Read More', 'vemus-addon' ),
					'condition' => [
	                    'show_button2'	=> 'yes',
	                ],
				]
			);

	        $repeater->add_control(
				'link_button2',
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
						'show_button2' => 'yes'
					]
				]
			);

			$repeater->end_controls_tab();

			$repeater->start_controls_tab( 'style2_tab', [ 'label' => esc_html__( 'Style', 'vemus-addon' ) ] );

				$repeater->add_control(
					'heading_re2_title_style',
					[
						'label' => __( 'Title', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);
				
				$repeater->add_control(
					're2_title_color',
					[
						'label' => __( 'Title Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .title-sld-2, {{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .title-sld-4' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					'heading_re2_subtitle_style',
					[
						'label' => __( 'Subtitle', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);

				$repeater->add_control(
					're2_subtitle_color',
					[
						'label' => __( 'Description Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .subtitle' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					'heading_re2_button_style',
					[
						'label' => __( 'Button', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);

				$repeater->add_control(
					're2_btn_color',
					[
						'label' => __( 'Button Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're2_btn_background_color',
					[
						'label' => __( 'Button Background Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn' => 'background-color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're2_border_btn_background_color',
					[
						'label' => __( 'Border Button Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn' => 'border-color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're2_btn_color_hover',
					[
						'label' => __( 'Button Color Hover', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn:hover' => 'color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're2_btn_background_color_hover',
					[
						'label' => __( 'Button Background Color Hover', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tf-slideshow {{CURRENT_ITEM}}_content .tf-btn:hover' => 'background-color: {{VALUE}} !important;',
						],
					]
				);

				$repeater->add_control(
					're2_border_btn_background_color_hover',
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
				'slider_list2',
					[					
						'type' => \Elementor\Controls_Manager::REPEATER,
						'fields' => $repeater->get_controls(),
						'default' => [
							[ 
								'title2' => 'Style Redefined',
								'button2_text'=> 'Shop Collection',
								'link_button2'=> '#',
							],
							[ 
								'title2' => 'Elegance Redefined',
								'button2_text'=> 'Shop Collection',
								'link_button2'=> '#',
							],
							[ 
								'title2' => 'Elegance Redefined',
								'button2_text'=> 'Shop Collection',
								'link_button2'=> '#',
							],
						],					
					]
			);

        $this->end_controls_section();

		// Start Carousel Setting        
		$this->start_controls_section( 'carousel_setting',
            [
                'label' => esc_html__('Carousel Settings', 'vemus-addon'),
				'condition' => [
                    'style'	=> 'style1',
                ],
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

		$this->add_responsive_control(

			'position_content_global',

			[
				'label' => esc_html__( 'Text Align', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'vemus-addon' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'vemus-addon' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'vemus-addon' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .content-sld' => 'text-align: {{VALUE}};',
				],
				'condition' => [
                    'style'	=> 'style1',
                ],
			]
		);

				$this->add_control(
			'heading_subtitle_style',
			[
				'label' => __( 'Subtitle Style', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
								'condition' => [
                    'style'	=> ['style2', 'style3'],
                ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .tf-slideshow .subtitle',
								'condition' => [
                    'style'	=> ['style2', 'style3'],
                ],
			]
		);
		
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Subtitle Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .subtitle' => 'color: {{VALUE}} !important;',
				],
								'condition' => [
                    'style'	=> ['style2', 'style3'],
                ],
			]
		);

		$this->add_responsive_control(
			'subtitle_margin',
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
					'{{WRAPPER}}  .tf-slideshow .subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
								'condition' => [
                    'style'	=> ['style2', 'style3'],
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
					'{{WRAPPER}} .tf-slideshow .title-sld-2, {{WRAPPER}} .tf-slideshow .title-sld-4' => 'color: {{VALUE}} !important;',
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
					'{{WRAPPER}} .tf-slideshow .title-sld-2 span, {{WRAPPER}} .tf-slideshow .title-sld-4 span' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'heading_desc_style',
			[
				'label' => __( 'Description Style', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
								'condition' => [
                    'style'	=> 'style1',
                ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .tf-slideshow .sub-title-sld',
								'condition' => [
                    'style'	=> 'style1',
                ],
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-slideshow .sub-title-sld' => 'color: {{VALUE}} !important;',
				],
								'condition' => [
                    'style'	=> 'style1',
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
								'condition' => [
                    'style'	=> 'style1',
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
        
		<?php
		 	$attr['settings'] = $settings; 
		 	tf_get_template_widget("slider/{$settings['style']}", $attr);
		?>

            <?php
        }


}