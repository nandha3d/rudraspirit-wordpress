<?php

class Vemus_Banner_Hero extends \Elementor\Widget_Base {

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
		return 'vemus_banner_hero';
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
		return esc_html__( 'Vemus Banner Hero', 'vemus-addon' );
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
		return 'eicon-post-slider';
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

    public function get_script_depends() {
		return [ 'gsap','banner-hero' ];
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
		return ['banner' , 'tf'];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Banner Hero', 'vemus-addon'),
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

            $this->add_control( 'tag_text', [
                'label' => esc_html__( 'Tag', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'TRENDING',
            ] );

            $this->add_control( 'main_title', [
                'label' => esc_html__( 'Main Title', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'UNVEIL YOUR <span class="fst-italic">Signature</span> LOOK',
            ] );

            $this->add_control( 'sub_title', [
                'label' => esc_html__( 'Sub Title', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Explore our stunning collection of handcrafted jewelry that blends timeless elegance with modern style.',
            ] );

            $this->add_control( 'btn1_text', [
                'label' => esc_html__( 'Primary Button Text', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Shop Now',
            ] );

            $this->add_control( 'btn1_link', [
                'label' => esc_html__( 'Primary Button Link', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                ],
            ] );

            $this->add_control( 'btn2_text', [
                'label' => esc_html__( 'Secondary Button Text', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore More',
            ] );

            $this->add_control( 'btn2_link', [
                'label' => esc_html__( 'Secondary Button Link', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                ],
            ] );

            for ( $i = 1; $i <= 4; $i++ ) {
                $this->add_control( "item_image_$i", [
                    'label' => esc_html__( "Image Item $i", 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                    ],
                    'condition' => [
                        'style'	=> 'style1',
                    ],
                ] );
            }

            $this->add_control( "item_image_banner", [
                'label' => esc_html__( "Image Banner Left", 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/banner-2.jpg",
                ],
                'condition' => [
                    'style'	=> 'style2',
                ],
            ] );

			$this->add_control( "item_image_banner_2", [
                'label' => esc_html__( "Image Banner Right", 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/banner-2.jpg",
                ],
                'condition' => [
                    'style'	=> 'style2',
                ],
            ] );

            $this->add_control( "item_image_banner_small", [
                'label' => esc_html__( "Image Banner Small", 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                ],
                'condition' => [
                    'style'	=> 'style2',
                ],
            ] );

       
		$this->end_controls_section();

        $this->start_controls_section( 'section_style', [
            'label' => esc_html__( 'Style', 'vemus-addon' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'tag_heading', [
            'label' => esc_html__( 'Tag Style', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'tag_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-banner-hero .tag',
        ] );

        $this->add_control( 'tag_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-banner-hero .tag' => 'color: {{VALUE}} !important',
            ],
        ] );
        
		$this->add_responsive_control(
			'tag_margin',
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
					'{{WRAPPER}}  .widget-banner-hero .tag' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_control( 'title_heading', [
            'label' => esc_html__( 'Title Style', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-banner-hero .title',
        ] );

        $this->add_control( 'title_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-banner-hero .title' => 'color: {{VALUE}} !important',
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
					'{{WRAPPER}}  .widget-banner-hero .title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_control( 'sub_heading', [
            'label' => esc_html__( 'Subtitle Style', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'sub_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-banner-hero .sub',
        ] );

        $this->add_control( 'sub_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-banner-hero .sub' => 'color: {{VALUE}} !important',
            ],
        ] );

        $this->add_responsive_control(
			'sub_margin',
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
					'{{WRAPPER}}  .widget-banner-hero .sub' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

    $this->add_control(
		'heading_button',
		[
			'label' => esc_html__( 'Button', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::HEADING,					
			'separator' => 'before',
		]
	);	

	$this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'button_typography',
            'selector' => '{{WRAPPER}} .widget-banner-hero .btn-1',
        ]
    );
		
		$this->add_responsive_control( 
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-banner-hero .btn-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-banner-hero .btn-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'button_styles_tab' );

		$this->start_controls_tab( 'button_default', [ 'label' => esc_html__( 'Default', 'vemus-addon' ) ] );

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-hero .btn-1' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'button_background',
			[
				'label' => esc_html__( 'Background', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-hero .btn-1' => 'background-color: {{VALUE}};',
				],
			]
		);	

        $this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-hero .btn-1' => 'border-color: {{VALUE}};',
				],
			]
		);	

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_hover', [ 'label' => esc_html__( 'Hover', 'vemus-addon' ) ] );

		$this->add_control(
			'button_color_hover',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-hero .btn-1:hover' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'button_background_hover',
			[
				'label' => esc_html__( 'Background', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-hero .btn-1:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);	

        $this->add_control(
			'button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-hero .btn-1:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tab();

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
	$settings = $this->get_settings_for_display();?>

        <?php
		 	$attr['settings'] = $settings; 
		 	tf_get_template_widget("banner-hero/{$settings['style']}", $attr);
		?>

        <?php
    }

}