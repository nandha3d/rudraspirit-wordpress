<?php

class Vemus_Banner extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null) {
		parent::__construct( $data, $args );
    }

	public function get_name() {
		return 'vemus_banner';
	}

	public function get_title() {
		return esc_html__( 'Vemus Banner', 'vemus-addon' );
	}

	public function get_icon() {
		return 'eicon-gallery-group';
	}

	public function get_categories() {
		return [ 'vemus_addons_core' ];
	}

	public function get_keywords() {
		return ['banner', 'vemus', 'promo'];
	}

	protected function register_controls() {

        $this->start_controls_section( 'section_select_style', [
			'label' => esc_html__( 'Select Style', 'vemus-addon' ),
		] );

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

		$this->start_controls_section( 'section_content_style1', [
			'label' => esc_html__( 'Banner Content', 'vemus-addon' ),
			'condition' => [
                'style'	=> 'style1',
            ],
		] );

		$this->add_control(
			'enable_blur',
			[
				'label' => esc_html__( 'Enable Image Background Blur', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control( 'background_image', [
			'label' => esc_html__( 'Background Image', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::MEDIA,
			'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			],
		] );

		$this->add_control( 'caption', [
			'label' => esc_html__( 'Caption', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'discount code: vemus20off', 'vemus-addon' ),
		] );

		$this->add_control( 'title', [
			'label' => esc_html__( 'Title', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Unveil Your Sparkle', 'vemus-addon' ),
		] );

		$this->add_control( 'description', [
			'label' => esc_html__( 'Description', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Discover our handcrafted jewelry collection designed to elevate your style. Exclusive deals and limited-time offers—your moment to shine is now!', 'vemus-addon' ),
		] );

		$this->add_control( 'button_text', [
			'label' => esc_html__( 'Button Text', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'Shop Now', 'vemus-addon' ),
		] );

		$this->add_control( 'button_link', [
			'label' => esc_html__( 'Button Link', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::URL,
			'default' => [
				'url' => '#',
				'is_external' => false,
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_content_style2', [
			'label' => esc_html__( 'Banner Content', 'vemus-addon' ),
			'condition' => [
                'style'	=> 'style2',
            ],
		] );

		$this->add_control( 'banner2_image', [
			'label'   => esc_html__( 'Banner Image', 'vemus-addon' ),
			'type'    => \Elementor\Controls_Manager::MEDIA,
			'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			],
		] );

		$this->add_control( 'caption2', [
			'label' => esc_html__( 'Caption', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'SUMMER SALE', 'vemus-addon' ),
		] );

		$this->add_control( 'title2', [
			'label' => esc_html__( 'Title', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Radiate Elegance, Wear Confidence', 'vemus-addon' ),
		] );

		$this->add_control( 'sub_title2', [
			'label' => esc_html__( 'Sub Title', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Discover exquisitely crafted jewelry designed to complement your style.', 'vemus-addon' ),
		] );

		$this->add_control( 'button_text2', [
			'label' => esc_html__( 'Button Text', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'Shop Collection', 'vemus-addon' ),
		] );

		$this->add_control( 'button_link2', [
			'label' => esc_html__( 'Button Link', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::URL,
			'default' => [
				'url' => '#',
				'is_external' => false,
			],
		] );

		$this->end_controls_section();


		// Style
		$this->start_controls_section( 'section_style', [
			'label' => esc_html__( 'Banner Style', 'vemus-addon' ),
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [
                'style'	=> 'style1',
            ],
		] );

		// Background & padding for content box
		$this->add_group_control( \Elementor\Group_Control_Background::get_type(), [
			'name'     => 'content_background',
			'label'    => esc_html__( 'Content Background', 'vemus-addon' ),
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .banner_V02 .bn-content',
		] );

		$this->add_responsive_control( 'content_padding', [
			'label'      => esc_html__( 'Content Padding', 'vemus-addon' ),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .banner_V02 .bn-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Caption style
		$this->add_control( 'caption_heading', [
			'label' => esc_html__( 'Caption', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'caption_typo',
			'selector' => '{{WRAPPER}} .banner_V02 .caption',
		] );

		$this->add_control( 'caption_color', [
			'label'     => esc_html__( 'Color', 'vemus-addon' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner_V02 .caption' => 'color: {{VALUE}};',
			],
		] );

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
					'{{WRAPPER}} .banner_V02 .caption' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		// Title style
		$this->add_control( 'title_heading', [
			'label' => esc_html__( 'Title', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'title_typo',
			'selector' => '{{WRAPPER}} .banner_V02 .title',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'vemus-addon' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner_V02 .title' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .banner_V02 .title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		// Description style
		$this->add_control( 'desc_heading', [
			'label' => esc_html__( 'Description', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'desc_typo',
			'selector' => '{{WRAPPER}} .banner_V02 .sub-title',
		] );

		$this->add_control( 'desc_color', [
			'label'     => esc_html__( 'Color', 'vemus-addon' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner_V02 .sub-title' => 'color: {{VALUE}};',
			],
		] );

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
					'{{WRAPPER}} .banner_V02 .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
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
				'selector' => '{{WRAPPER}} .banner_V02 .tf-btn',
			]
		);
		
		$this->add_responsive_control( 
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banner_V02 .tf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .banner_V02 .tf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .banner_V02 .tf-btn' => 'color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button_background',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .banner_V02 .tf-btn' => 'background-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'border_color',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .banner_V02 .tf-btn' => 'border-color: {{VALUE}};',
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
							'{{WRAPPER}} .banner_V02 .tf-btn:hover' => 'color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button_background_hover',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .banner_V02 .tf-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button_border_color_hover',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .banner_V02 .tf-btn:hover' => 'border-color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section( 'section_style2', [
			'label' => esc_html__( 'Banner Style', 'vemus-addon' ),
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [
                'style'	=> 'style2',
            ],
		] );

		$this->add_control( 'caption2_heading', [
			'label' => esc_html__( 'Caption', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'caption2_typography',
			'selector' => '{{WRAPPER}} .vemus-banner .caption',
		] );

		$this->add_control( 'caption2_color', [
			'label' => esc_html__( 'Color', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .vemus-banner .caption' => 'color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control(
			'caption2_margin',
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
					'{{WRAPPER}} .vemus-banner .caption' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control( 'title2_heading', [
			'label' => esc_html__( 'Title', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'title2_typography',
			'selector' => '{{WRAPPER}} .vemus-banner .title',
		] );

		$this->add_control( 'title2_color', [
			'label' => esc_html__( 'Color', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .vemus-banner .title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control(
			'title2_margin',
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
					'{{WRAPPER}} .vemus-banner .title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control( 'sub2_heading', [
			'label' => esc_html__( 'Subtitle', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'sub2_title_typography',
			'selector' => '{{WRAPPER}} .vemus-banner .sub-title',
		] );

		$this->add_control( 'sub2_title_color', [
			'label' => esc_html__( 'Color', 'vemus-addon' ),
			'type'  => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .vemus-banner .sub-title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control(
			'sub2_margin',
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
					'{{WRAPPER}} .vemus-banner .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
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
            'selector' => '{{WRAPPER}} .vemus-banner .tf-btn',
        ]
    );
		
		$this->add_responsive_control( 
			'button2_padding',
			[
				'label' => esc_html__( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .vemus-banner .tf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .vemus-banner .tf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs('button2_styles_tabs');

			$this->start_controls_tab('button2_styles_tab', ['label' => 'Normal']);
				
				$this->add_control(
					'button2_color',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .vemus-banner .tf-btn' => 'color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button2_background',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .vemus-banner .tf-btn' => 'background-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button2_border_color',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .vemus-banner .tf-btn' => 'border-color: {{VALUE}};',
						],
					]
				);	

			$this->end_controls_tab();

			$this->start_controls_tab('button2_styles_tab_hover', ['label' => 'Hover']);
				$this->add_control(
					'button2_color_hover',
					[
						'label' => esc_html__( 'Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .vemus-banner .tf-btn:hover' => 'color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button2_background_hover',
					[
						'label' => esc_html__( 'Background', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .vemus-banner .tf-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);	

				$this->add_control(
					'button2_border_color_hover',
					[
						'label' => esc_html__( 'Border Color', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .vemus-banner .tf-btn:hover' => 'border-color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		?>

		<?php if( $settings['style'] == 'style1' ): 
			$bg_url = !empty($settings['background_image']['url']) ? $settings['background_image']['url'] : '';
			$btn_url = $settings['button_link']['url'] ? esc_url($settings['button_link']['url']) : '#';
			$btn_target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		?>

		<div class="banner_V02 <?php echo esc_attr( $settings['enable_blur'] != 'yes' ? 'hover-img' : ''); ?>">

			<?php if( $settings['enable_blur'] == 'yes' ):  ?>
				<div class="bn-image-blur">
					<div class="span-image-blur"><img src="<?php echo esc_url($bg_url); ?>" alt="<?php echo esc_attr($settings['title']); ?>" class="lazyload"></div>
					<div class="blur">
						<img src="<?php echo esc_url($bg_url); ?>" alt="<?php echo esc_attr($settings['title']); ?>" class="lazyload">
					</div>
				</div>
			<?php else: ?>
				<div class="bn-image img-style">
                	<img src="<?php echo esc_url($bg_url); ?>" alt="<?php echo esc_attr($settings['title']); ?>" class="lazyload">
            	</div>
			<?php endif; ?>

			<div class="bn-content bg-linear-light-brown text-white-2">
				<?php if ( $settings['caption'] ) : ?>
					<h6 class="caption text-uppercase wow fadeInUp"><?php echo wp_kses_post($settings['caption']); ?></h6>
				<?php endif; ?>

				<?php if ( $settings['title'] ) : ?>
					<h2 class="title font-2 fw-normal wow fadeInUp"><?php echo wp_kses_post($settings['title']); ?></h2>
				<?php endif; ?>

				<?php if ( $settings['description'] ) : ?>
					<p class="sub-title wow fadeInUp"><?php echo wp_kses_post($settings['description']); ?></p>
				<?php endif; ?>

				<?php if ( $settings['button_text'] ) : ?>
					<a href="<?php echo $btn_url; ?>" class="tf-btn style-white-2 type-large wow fadeInUp"<?php echo $btn_target; ?>>
						<?php echo esc_html($settings['button_text']); ?>
						<i class="icon icon-arrow-right-2"></i>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<?php else: 
			$target   = $settings['button_link2']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['button_link2']['nofollow'] ? ' rel="nofollow"' : '';	
		?>

		<div class="flat-spacing-3 pt-0 vemus-banner <?php echo esc_attr( $settings['style'] ); ?>">
            <div class="container-full-2">
                <div class="banner_V06">
                    <div class="bn-image mb-md-0">
                        <?php if ( ! empty( $settings['banner2_image']['url'] ) ) : ?>
                            <img src="<?php echo esc_url( $settings['banner2_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['title2'] ); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="bn-content">
                        <div class="container">
                            <div class="col-md-5 offset-md-7">
                                <div class="wrap wow fadeInUp">
                                    <?php if ( $settings['caption2'] ) : ?>
                                        <h6 class="caption fw-normal"><?php echo wp_kses_post( $settings['caption2'] ); ?></h6>
                                    <?php endif; ?>

                                    <?php if ( $settings['title2'] ) : ?>
                                        <p class="title text-hero-2 font-2"><?php echo wp_kses_post( $settings['title2'] ); ?></p>
                                    <?php endif; ?>

                                    <?php if ( $settings['sub_title2'] ) : ?>
                                        <p class="sub-title"><?php echo wp_kses_post( $settings['sub_title2'] ); ?></p>
                                    <?php endif; ?>

                                    <?php if ( $settings['button_text2'] && $settings['button_link2']['url'] ) : ?>
                                        <a href="<?php echo esc_url( $settings['button_link2']['url'] ); ?>" class="tf-btn btn-fill animate-btn type-large text-uppercase"<?php echo $target . $nofollow; ?>>
                                            <?php echo esc_html( $settings['button_text2'] ); ?>
                                            <i class="icon-arrow-right-2 fs-24"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php endif; ?>

		<?php
	}
}
