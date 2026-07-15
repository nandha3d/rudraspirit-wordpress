<?php

class Vemus_Image_Box extends \Elementor\Widget_Base {

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
		return 'vemus_image_box';
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
		return esc_html__( 'Vemus Image Box', 'vemus-addon' );
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
		return 'eicon-image';
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
		return ['image' , 'tf'];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Image Box', 'vemus-addon'),
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


        $this->start_controls_section(
            'section_content_style_1',
            [
                'label' => esc_html__('Style 1', 'vemus-addon'),
                'condition' => [
                    'style'	=> ['style1','style3'],
                ],
            ]
        );

        $this->add_control(
            'slider_image',
            [
                'label' => esc_html__('Image', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                    ],
            ]
        );

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Shine with Seasonal Picks', 'vemus-addon' ),
			]
		);	

        $this->add_control( 
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Explore Collection', 'vemus-addon' ),
			]
		);

	    $this->add_control(
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
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
            'section_content_style_2',
            [
                'label' => esc_html__('Style 2', 'vemus-addon'),
                'condition' => [
                    'style'	=> 'style2',
                ],
            ]
        );

        $this->add_control(
            'slider_image2',
            [
                'label' => esc_html__('Image', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                    ],
            ]
        );

		$this->add_control(
			'title2',
			[
				'label' => esc_html__( 'Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Shine with Seasonal Picks', 'vemus-addon' ),
			]
		);	

		$this->add_control(
			'desc2',
			[
				'label' => esc_html__( 'Description', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Express your individuality with stackable rings, bracelets, and necklaces. Mix, match, and layer to create a style thats entirely your own.', 'vemus-addon' ),
			]
		);

        $this->add_control( 
			'button_text2',
			[
				'label' => esc_html__( 'Button Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Shop Now', 'vemus-addon' ),
			]
		);

	    $this->add_control(
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
			'content_direction',
				[
				'label' => esc_html__( 'Direction', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row-reverse' => [
						'title' => esc_html__( 'Row - reversed', 'vemus-addon' ),
						'icon' => 'eicon-arrow-left',
					],
					'unset' => [
						'title' => esc_html__( 'Row - horizontal', 'vemus-addon' ),
						'icon' => 'eicon-arrow-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-image-box .banner_V03' => 'flex-direction: {{VALUE}};',
				],
				'default' => 'unset',
								'condition' => [
					'style'	=> 'style2',
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
				'selector' => '{{WRAPPER}} .widget-image-box .title',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-image-box .title' => 'color: {{VALUE}} !important;',
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
					'{{WRAPPER}}  .widget-image-box .title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'heading_desc',
			[
				'label' => esc_html__( 'Description', 'vemus-addon' ),
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
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .widget-image-box .sub-title',
				'condition' => [
					'style'	=> 'style2',
				],
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Title Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-image-box .sub-title' => 'color: {{VALUE}} !important;',
				],
								'condition' => [
					'style'	=> 'style2',
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
					'{{WRAPPER}}  .widget-image-box .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
								'condition' => [
					'style'	=> 'style2',
				],
			]
		);


	$this->add_control(
		'heading_button2',
		[
			'label' => esc_html__( 'Button', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::HEADING,					
			'separator' => 'before',
			'condition' => [
				'style'	=> 'style1',
			],
		]
	);	

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn2_typography',
                'selector' => '{{WRAPPER}} .widget-image-box .tf-btn-line span',
				'condition' => [
					'style'	=> 'style1',
				],
            ]
        );
		
        $this->add_control(
            'button2_color',
            [
                'label' => esc_html__( 'Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .widget-image-box .tf-btn-line' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-image-box .tf-btn-line::after' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .widget-image-box .tf-btn-line:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-image-box .tf-btn-line:hover::before' => 'background-color: {{VALUE}};',
                ],
				'condition' => [
					'style'	=> 'style1',
				],
            ]
        );	


        $this->end_controls_section();

	$this->start_controls_section(
		'section_content_button',
		[
			'label' => __( 'Button', 'vemus-addon' ),
        	'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [
				'style'	=> 'style2',
			],
		]
	);

	$this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'button_typography2',
            'selector' => '{{WRAPPER}} .widget-image-box .tf-btn',
        ]
    );
		

		$this->start_controls_tabs('button_styles_tabs');

			$this->start_controls_tab('button_styles_tab', ['label' => 'Normal']);
				
				$this->add_control(
					'button_color2',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .widget-image-box .tf-btn' => 'color: {{VALUE}};',
							'{{WRAPPER}} .tf-btn.btn-def-2::after' => 'background-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button_background2',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .widget-image-box .tf-btn' => 'background-color: {{VALUE}};',
						],
					]
				);	

			$this->end_controls_tab();

			$this->start_controls_tab('button_styles_tab_hover', ['label' => 'Hover']);
				$this->add_control(
					'button_color_hover2',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .widget-image-box .tf-btn:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} .tf-btn.btn-def-2:hover::after' => 'background-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button_background_hover2',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .widget-image-box .tf-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);	

			$this->end_controls_tab();

		$this->end_controls_tabs();



    $this->end_controls_section();

	$this->start_controls_section(
		'section_content_button3',
		[
			'label' => __( 'Button', 'vemus-addon' ),
        	'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [
				'style'	=> 'style3',
			],
		]
	);

	$this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'button_typography3',
            'selector' => '{{WRAPPER}} .widget-image-box .tf-btn',
        ]
    );
		

		$this->start_controls_tabs('button_styles_tabs3');

			$this->start_controls_tab('button_styles_tab3', ['label' => 'Normal']);
				
				$this->add_control(
					'button_color3',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .widget-image-box .tf-btn' => 'color: {{VALUE}};',
							'{{WRAPPER}} .tf-btn.btn-def-2::after' => 'background-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button_background3',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .widget-image-box .tf-btn' => 'background-color: {{VALUE}};',
						],
					]
				);	

			$this->end_controls_tab();

			$this->start_controls_tab('button_styles_tab_hover3', ['label' => 'Hover']);
				$this->add_control(
					'button_color_hover3',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .widget-image-box .tf-btn:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} .tf-btn.btn-def-2:hover::after' => 'background-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button_background_hover3',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .widget-image-box .tf-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
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
		 	tf_get_template_widget("image-box/{$settings['style']}", $attr);
		?>

        <?php
    }


}