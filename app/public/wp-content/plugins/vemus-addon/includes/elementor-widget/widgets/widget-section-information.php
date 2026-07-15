<?php

class Vemus_Section_Information extends \Elementor\Widget_Base {

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
		return 'eicon-gallery-group';
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
		return esc_html__( 'Vemus Section Information', 'vemus-addon' );
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
		return 'eicon-ehp-zigzag';
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
		return ['section' , 'tf'];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
protected function register_controls() {

    // ===== Content Section =====
    $this->start_controls_section(
        'section_content',
        [
            'label' => esc_html__('Content', 'vemus-addon'),
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


    $this->end_controls_section();

	$this->start_controls_section(
        'section_content_style_1',
        [
            'label' => esc_html__('Style 1', 'vemus-addon'),
			'condition' => [
                'style'	=> 'style1',
            ],
        ]
    );

	$this->add_control(
        'banner_image',
        [
            'label' => esc_html__('Banner Image', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::MEDIA,
			'default' => [
                'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/banner-8.jpg",
            ],
        ]
    );

    $this->add_control(
        'icon_star',
        [
            'label' => esc_html__('Star Icon', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => '',
            ],
        ]
    );

    $this->add_control(
        'caption',
        [
            'label' => esc_html__('Caption', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('About Vemus', 'vemus-addon'),
        ]
    );

    $this->add_control(
        'title',
        [
            'label' => esc_html__('Title', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => esc_html__('Crafting Timeless Elegance', 'vemus-addon'),
        ]
    );

    $this->add_control(
        'sub_title',
        [
            'label' => esc_html__('Sub Title', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => esc_html__('Your description goes here...', 'vemus-addon'),
        ]
    );

    $this->add_control(
        'btn_text',
        [
            'label' => esc_html__('Button Text', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Our Story', 'vemus-addon'),
        ]
    );

    $this->add_control(
        'btn_link',
        [
            'label' => esc_html__('Button Link', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => 'https://your-link.com',
        ]
    );

    $this->end_controls_section();

	// ===== Content Style 2 =====
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
		'style2_title',
		[
			'label' => esc_html__('Title', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::TEXTAREA,
			'default' => esc_html__('CARING JEWELLERY IS STILL OUR PASSION', 'vemus-addon'),
		]
	);

	$this->add_control(
		'style2_subtitle',
		[
			'label' => esc_html__('Sub Title', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::TEXTAREA,
			'default' => esc_html__('We never want to waste a scrap of precious metal...', 'vemus-addon'),
		]
	);

	$this->add_control(
		'style2_btn_text',
		[
			'label' => esc_html__('Button Text', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__('Shop All Jewellery', 'vemus-addon'),
		]
	);

	$this->add_control(
		'style2_btn_link',
		[
			'label' => esc_html__('Button Link', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::URL,
			'placeholder' => 'https://your-link.com',
		]
	);

	$this->add_control(
		'style2_main_image',
		[
			'label' => esc_html__('Main Image', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::MEDIA,
			'default' => [
                'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/feature-visual.jpg",
            ],
		]
	);

	$this->add_control(
		'style2_brand_image',
		[
			'label' => esc_html__('Brand Box Image', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::MEDIA,
			'default' => [
				'url' => '',
			],
		]
	);

	$this->end_controls_section();


    // ===== Style Section =====
    $this->start_controls_section(
        'section_style_1',
        [
            'label' => esc_html__('Style', 'vemus-addon'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [
                'style'	=> 'style1',
            ],
        ]
    );

	$this->add_control(
		'heading_caption',
		[
			'label' => esc_html__( 'Caption', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::HEADING,					
			'separator' => 'before',
		]
	);	

    // Caption style
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'caption_typo',
            'selector' => '{{WRAPPER}} .banner_V05.style-2 .bn-content h6',
        ]
    );

    $this->add_control(
        'caption_color',
        [
            'label' => esc_html__('Caption Color', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .banner_V05.style-2 .bn-content h6' => 'color: {{VALUE}} !important;',
            ],
        ]
    );

	$this->add_responsive_control(
		'caption_margin',
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
				'{{WRAPPER}}  .banner_V05.style-2 .bn-content h6' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
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

    // Title style
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'title_typo',
            'selector' => '{{WRAPPER}} .banner_V05.style-2 .bn-content .title',
        ]
    );

    $this->add_control(
        'title_color',
        [
            'label' => esc_html__('Title Color', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .banner_V05.style-2 .bn-content .title' => 'color: {{VALUE}} !important;',
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
				'{{WRAPPER}}  .banner_V05.style-2 .bn-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
			],
		]
	);

	$this->add_control(
		'heading_subtitle',
		[
			'label' => esc_html__( 'Sub Title', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::HEADING,					
			'separator' => 'before',
		]
	);

    // Sub-title style
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'subtitle_typo',
            'selector' => '{{WRAPPER}} .banner_V05.style-2 .bn-content .sub-title',
        ]
    );

    $this->add_control(
        'subtitle_color',
        [
            'label' => esc_html__('Sub Title Color', 'vemus-addon'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .banner_V05.style-2 .bn-content .sub-title' => 'color: {{VALUE}} !important;',
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
				'{{WRAPPER}}  .banner_V05.style-2 .bn-content .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
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
            'selector' => '{{WRAPPER}} .wg-section-information .tf-btn',
        ]
    );
		
		$this->add_responsive_control( 
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wg-section-information .tf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .wg-section-information .tf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);


		$this->start_controls_tabs('button_styles_tabs');

			$this->start_controls_tab('button_styles_tab', ['label' => 'Normal']);
				
				$this->add_control(
					'button_color',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn' => 'color: {{VALUE}} !important;',
						],
					]
				);	

				$this->add_control(
					'button_background',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn' => 'background-color: {{VALUE}} !important;',
						],
					]
				);	

				$this->add_control(
					'border_color',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn' => 'border-color: {{VALUE}} !important;',
						],
					]
				);	

			$this->end_controls_tab();

			$this->start_controls_tab('button_styles_tab_hover', ['label' => 'Hover']);
				$this->add_control(
					'button_color_hover',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn:hover' => 'color: {{VALUE}} !important;',
						],
					]
				);	

				$this->add_control(
					'button_background_hover',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn:hover' => 'background-color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
						],
					]
				);	

				$this->add_control(
					'button_border_color_hover',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn:hover' => 'border-color: {{VALUE}} !important;',
						],
					]
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();



    $this->end_controls_section();

	// ===== Style Tab Style 2 =====
	$this->start_controls_section(
		'section_style_2',
		[
			'label' => esc_html__('Style 2', 'vemus-addon'),
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [
				'style'	=> 'style2',
			],
		]
	);

	// Title
	$this->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'style2_title_typo',
			'selector' => '{{WRAPPER}} .widget-section-information2 .feature-title',
		]
	);

	$this->add_control(
		'style2_title_color',
		[
			'label' => esc_html__('Title Color', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .widget-section-information2 .feature-title' => 'color: {{VALUE}};',
			],
		]
	);

	$this->add_responsive_control(
		'sstyle2_title_margin',
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
				'{{WRAPPER}}  .widget-section-information2  .feature-title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
			],
		]
	);

	// Subtitle
	$this->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'style2_subtitle_typo',
			'selector' => '{{WRAPPER}} .widget-section-information2  .feature-subtitle',
		]
	);

	$this->add_control(
		'style2_subtitle_color',
		[
			'label' => esc_html__('Subtitle Color', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .widget-section-information2  .feature-subtitle' => 'color: {{VALUE}};',
			],
		]
	);

	$this->add_responsive_control(
		'style2_subtitle_margin',
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
				'{{WRAPPER}}  .widget-section-information2  .feature-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
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
            'selector' => '{{WRAPPER}} .wg-section-information .tf-btn',
        ]
    );
		
		$this->add_responsive_control( 
			'button2_padding',
			[
				'label' => esc_html__( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wg-section-information .tf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .wg-section-information .tf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
							'{{WRAPPER}} .wg-section-information .tf-btn' => 'color: {{VALUE}} !important;',
						],
					]
				);	

				$this->add_control(
					'button2_background',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn' => 'background-color: {{VALUE}} !important;',
						],
					]
				);	

				$this->add_control(
					'button2_border_color',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn' => 'border-color: {{VALUE}} !important;',
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
							'{{WRAPPER}} .wg-section-information .tf-btn:hover' => 'color: {{VALUE}} !important;',
						],
					]
				);	

				$this->add_control(
					'button2_background_hover',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn:hover' => 'background-color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
						],
					]
				);	

				$this->add_control(
					'button2_border_color_hover',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wg-section-information .tf-btn:hover' => 'border-color: {{VALUE}} !important;',
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

		$banner_img = $settings['banner_image']['url'] ?? '';
		$icon_star  = $settings['icon_star']['url'] ?? '';
		$caption    = $settings['caption'] ?? '';
		$title      = $settings['title'] ?? '';
		$sub_title  = $settings['sub_title'] ?? '';
		$btn_text   = $settings['btn_text'] ?? '';
		$btn_link   = $settings['btn_link']['url'] ?? '#';
	    $link_attrs = '';
        if ( ! empty( $settings['btn_link']['url'] ) ) {
            if ( $settings['btn_link']['is_external'] ) {
                $link_attrs .= ' target="_blank"';
            }
            if ( $settings['btn_link']['nofollow'] ) {
                $link_attrs .= ' rel="nofollow"';
            }
        }
		$link_attrs2 = '';
        if ( ! empty( $settings['style2_btn_link']['url'] ) ) {
            if ( $settings['style2_btn_link']['is_external'] ) {
                $link_attrs2 .= ' target="_blank"';
            }
            if ( $settings['style2_btn_link']['nofollow'] ) {
                $link_attrs2 .= ' rel="nofollow"';
            }
        }
		?>
		<?php if ($settings['style'] == 'style1'): ?>
		<div class="flat-spacing-3 wg-section-information">
			<div class="container">
				<div class="banner_V05 style-2">
					<div class="shape-image wow fadeInUp">
						<div class="image">
							<img src="<?php echo esc_url($banner_img); ?>" alt="Banner">
						</div>
						<span class="line-circle"></span>
						<?php if ($icon_star): ?>
							<img class="img-ic-star" src="<?php echo esc_url($icon_star); ?>" alt="">
						<?php endif; ?>
					</div>
					<div class="bn-content wow fadeInUp">
						<?php if ($caption): ?>
							<h6 class="text-uppercase"><?php echo wp_kses_post($caption); ?></h6>
						<?php endif; ?>

						<?php if ($title): ?>
							<h2 class="title font-2 fw-normal"><?php echo wp_kses_post($title); ?></h2>
						<?php endif; ?>

						<?php if ($sub_title): ?>
							<p class="sub-title text-main-4"><?php echo wp_kses_post($sub_title); ?></p>
						<?php endif; ?>

						<?php if ($btn_text): ?>
							<a href="<?php echo esc_url($btn_link); ?>" <?php echo $link_attrs; ?> class="tf-btn type-large">
								<?php echo esc_html($btn_text); ?>
								<i class="icon-arrow-right-2 fs-24"></i>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<?php else: ?>

			<section class="flat-spacing-3 feature-intro widget-section-information2 wg-section-information">
				<div class="container">
					<div class="row flex-wrap-reverse">
						<div class="col-xxl-5 offset-xxl-1 col-md-6 d-flex align-items-center">
							<div class="text-content">
								<?php if (!empty($settings['style2_title'])): ?>
									<h2 class="feature-title"><?php echo wp_kses_post($settings['style2_title']); ?></h2>
								<?php endif; ?>

								<?php if (!empty($settings['style2_subtitle'])): ?>
									<p class="feature-subtitle"><?php echo wp_kses_post($settings['style2_subtitle']); ?></p>
								<?php endif; ?>

								<?php if (!empty($settings['style2_btn_text'])): ?>
									<a href="<?php echo esc_url($settings['style2_btn_link']['url'] ?? '#'); ?>" <?php echo $link_attrs2; ?> class="cta-btn tf-btn type-large">
										<?php echo esc_html($settings['style2_btn_text']); ?>
										<i class="icon-arrow-right-2 fs-24"></i>
									</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-xxl-5 col-md-6">
							<div class="visual-content mb-xl-0">
								<?php if (!empty($settings['style2_main_image']['url'])): ?>
									<img src="<?php echo esc_url($settings['style2_main_image']['url']); ?>" alt="" class="lazyload img-visual">
								<?php endif; ?>
								<?php if (!empty($settings['style2_brand_image']['url'])): ?>
									<div class="brand-box">
										<img src="<?php echo esc_url($settings['style2_brand_image']['url']); ?>" alt="" class="lazyload">
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php endif; ?>

		<?php
	}



}