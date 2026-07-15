<?php

class Vemus_Testimonial_Type_2 extends \Elementor\Widget_Base {

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
		return 'vemus_testimonial_2';
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
		return esc_html__( 'Vemus Testimonial Type 2', 'vemus-addon' );
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
		return ['animation' , 'tf'];
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
	                'label' => esc_html__('Vemus Testimonial Type 2', 'vemus-addon'),
	            ]
	        );

            $this->add_control(
                'style',
                [
                    'label' => esc_html__('Style', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'type1',
                    'options'     => [
                        'type1' => esc_html__( 'Style 1', 'vemus-addon' ),
                        'type2' => esc_html__( 'Style 2', 'vemus-addon' ),
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section( 'section_setup_setting',
	        [
	            'label' => esc_html__('Vemus Setup', 'vemus-addon'),
                'condition' => [
					'style'	=> 'type1',
				],
	        ]
	    );

        $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'product_image',
                [
                    'label' => esc_html__( 'Feature Image', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
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
                    'label' => esc_html__( 'Avatar Client', 'vemus-addon' ),
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

        $this->start_controls_section( 'section_setup2_setting',
	        [
	            'label' => esc_html__('Vemus Setup', 'vemus-addon'),
                'condition' => [
					'style'	=> 'type2',
				],
	        ]
	    );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'thumbnail_type2',
                [
                    'label' => esc_html__( 'Feature Image', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                    ],
                ]
            );

            $repeater->add_control(
				'description2',
				[
					'label' => esc_html__( 'Content', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'vemus-addon' ),
				]
			);

            $repeater->add_control(
				'name2',
				[
					'label' => esc_html__( 'Name', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Emily T.', 'vemus-addon' ),
				]
			);

            $repeater->add_control(
				'position2',
				[
					'label' => esc_html__( 'Position', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Fashion Blogger', 'vemus-addon' ),
				]
			);

        $this->add_control( 
            'carousel_list2',
                [					
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [ 
                            'name2' => 'Emily T.',
                            'position2'=> 'Fashion Blogger',
                            'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        ],
                        [ 
                            'name2' => 'Jessica M.',
                            'position2'=> 'Fashion Blogger',
                            'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        ],
                        [ 
                            'name2' => 'Lisa P.',
                            'position2'=> 'Fashion Blogger',
                            'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        ],
                        [ 
                            'name2' => 'Emily T.',
                            'position2'=> 'Fashion Blogger',
                            'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        ]
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

        $this->add_control(
			'arrow_enable',
			[ 
				'label'        => esc_html__( 'Enable Arrow', 'vemus-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'vemus-addon' ),
				'label_off'    => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->end_controls_section();

         // Start General
		$this->start_controls_section( 
			'section_style_general',
			[
				'label' => esc_html__( 'Content', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
					'style'	=> 'type1',
				],
			]
		); 

        $this->add_control(
			'heading_title_section',
			[
				'label' => esc_html__( 'Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_section_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .title',
			]
		);

		$this->add_control(
			'title_section_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .title' => 'color: {{VALUE}} !important;',
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
				'selector' => '{{WRAPPER}} .widget-testimonial .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .description' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .widget-testimonial .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .widget-testimonial .name-author',
			]
		);

		$this->add_control(
			'author_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .name-author' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .widget-testimonial .name-author' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'heading_product_name',
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
				'selector' => '{{WRAPPER}} .widget-testimonial .product-name',
			]
		);

		$this->add_control(
			'title_product_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .product-name' => 'color: {{VALUE}} !important;',
				],
			]
		);	

		$this->add_control(
			'title_product_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .product-name:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);	

        $this->add_control(
			'heading_price',
			[
				'label' => esc_html__( 'Product Price', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .price-product',
			]
		);

		$this->add_control(
			'price_product_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .price-product' => 'color: {{VALUE}} !important;',
				],
			]
		);	

		$this->end_controls_section();

        // Start General
		$this->start_controls_section( 
			'section_style2_general',
			[
				'label' => esc_html__( 'Content', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
					'style'	=> 'type2',
				],
			]
		); 

        $this->add_control(
			'heading_description2',
			[
				'label' => esc_html__( 'Description', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description2_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .description',
			]
		);

		$this->add_control(
			'description2_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .description' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_responsive_control(
			'description2_margin',
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
					'{{WRAPPER}} .widget-testimonial .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'heading_name_author2',
			[
				'label' => esc_html__( 'Name Author', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_author2_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .name',
			]
		);

		$this->add_control(
			'name_author2_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .name' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_responsive_control(
			'author2_margin',
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
			'heading_name_position2',
			[
				'label' => esc_html__( 'Position', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_position2_typography',
				'selector' => '{{WRAPPER}} .widget-testimonial .duty',
			]
		);

		$this->add_control(
			'name_position2_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-testimonial .duty' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_responsive_control(
			'position2_margin',
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
					'{{WRAPPER}} .widget-testimonial .duty' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section( 
			'section_style_navigation',
			[
				'label' => esc_html__( 'Arrow', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
                            '{{WRAPPER}} .widget-testimonial .pagination-tes' => 'color: {{VALUE}} !important;',
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
                            '{{WRAPPER}} .widget-testimonial .pagination-tes.swiper-button-disabled' => 'color: {{VALUE}} !important;',
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
                            '{{WRAPPER}} .widget-testimonial .pagination-tes:hover' => 'color: {{VALUE}} !important;',
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
                tf_get_template_widget("testimonial/{$settings['style']}", $attr);
            ?>

            <?php
        }


}