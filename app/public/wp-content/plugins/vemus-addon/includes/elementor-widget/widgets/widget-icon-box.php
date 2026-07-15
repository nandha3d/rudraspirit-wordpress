<?php

class Vemus_Icon_Box extends \Elementor\Widget_Base {

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
		return 'vemus_icon_box';
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
		return esc_html__( 'Vemus Icon Box', 'vemus-addon' );
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
		return 'eicon-navigation-horizontal';
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
		return ['icon' , 'tf'];
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
	                'label' => esc_html__('Vemus Icon Box', 'vemus-addon'),
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
        

        $repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'icon-diamond',
						'library' => 'theme_icon',
					],
				]
			);

            $repeater->add_control(
                'title',
                [
                    'label' => esc_html__('Title', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('Free Shipping', 'vemus-addon'),
                ]
            );
            
            $repeater->add_control(
                'description',
                [
                    'label' => esc_html__('Description', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__('Enjoy free shipping on all orders', 'vemus-addon'),
                ]
            );
			
            $this->add_control( 
                'carousel_list',
                [                    
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [ 
                            'icon' => [
                                'value' => 'icon-box',
                                'library' => 'theme_icon',
                            ],
                            'title' => 'Free Shipping',
                            'description' => 'Enjoy free shipping on all orders',
                        ],
                        [ 
                            'icon' => [
                                'value' => 'icon-credit-card',
                                'library' => 'theme_icon',
                            ],
                            'title' => 'Gift Package',
                            'description' => 'Perfectly packaged for gifting',
                        ],
                        [ 
                            'icon' => [
                                'value' => 'icon-return',
                                'library' => 'theme_icon',
                            ],
                            'title' => 'Free Returns',
                            'description' => 'Within 14 days for an return',
                        ],
                        [ 
                            'icon' => [
                                'value' => 'icon-headphone',
                                'library' => 'theme_icon',
                            ],
                            'title' => 'Support Online',
                            'description' => 'We support customers 24/7',
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
				'default' => 4,
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
				'default' => 4,
				'condition' => [
					'group-slidesPerGroup' =>'yes'
				],
			]
		);
		
		$this->end_popover();

			$this->add_control(
				'bullet_enable',
				[ 
					'label'        => esc_html__( 'Bullet', 'vemus-addon' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'On', 'vemus-addon' ),
					'label_off'    => esc_html__( 'Off', 'vemus-addon' ),
					'return_value' => 'yes',
					'default'      => 'no'
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
			'heading_content',
			[
				'label' => esc_html__( 'Content', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

        $this->add_responsive_control( 
			'content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
                    'style'	=> 'style1',
                ],
			]
		);

		$this->add_control(
			'content_border_color',
			[
				'label' => esc_html__( 'Border Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box ' => 'border-color: {{VALUE}};',
				],
				'condition' => [
                    'style'	=> 'style1',
                ],
			]
		);	

		$this->add_responsive_control( 
			'content_outside_padding',
			[
				'label' => esc_html__( 'Content Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
                    'style'	=> 'style2',
                ],
			]
		);

		$this->add_control(
			'content_outside_background_color',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box' => 'background-color: {{VALUE}} !important;',
				],
				'condition' => [
                    'style'	=> 'style2',
                ],
			]
		);	

		$this->add_control(
			'content_inner_border_color',
			[
				'label' => esc_html__( 'Border Box Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box .box_icon--V02 ' => 'border-color: {{VALUE}};',
				],
				'condition' => [
                    'style'	=> 'style1',
                ],
			]
		);	

		$this->add_responsive_control( 
			'content_inner_padding',
			[
				'label' => esc_html__( 'Content Box Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box .box_icon--V02' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
                    'style'	=> 'style1',
                ],
			]
		);

        $this->add_control(
			'heading_icon',
			[
				'label' => esc_html__( 'Icon', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box .icon ' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'icon_background_color',
			[
				'label' => esc_html__( 'Background', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box .wrap-icon ' => 'background: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Size Icon', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box .icon ' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size_cover',
			[
				'label'     => esc_html__( 'Width & Height', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'     => [
					'px' => [
						'min' => 30,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box .wrap-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; display: flex; align-items: center; justify-content: center;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => esc_html__( 'Border', 'vemus-addon' ),
				'selector' => '{{WRAPPER}} .widget-icon-box .wrap-icon',
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box .wrap-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'icon_margin',
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
					'{{WRAPPER}} .widget-icon-box .wrap-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .widget-icon-box  .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box  .title' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .widget-icon-box  .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .widget-icon-box  .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'description Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-icon-box  .description' => 'color: {{VALUE}};',
				],
			]
		);	

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
		 	tf_get_template_widget("icon-box/{$settings['style']}", $attr);
		?>

        <?php
    }


}