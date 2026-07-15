<?php

class Vemus_Button extends \Elementor\Widget_Base {

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
		return 'vemus_button';
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
		return esc_html__( 'Vemus Button', 'vemus-addon' );
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
		return 'eicon-button';
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
		return ['button' , 'tf'];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
            
            $this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Button', 'vemus-addon'),
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

            $this->add_control( 
				'button_text',
				[
					'label' => esc_html__( 'Button Text', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Shop Collection', 'vemus-addon' ),
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

            $this->add_responsive_control(
                'button_text_align',
                [
                    'label'       => esc_html__( 'Position', 'vemus-addon' ),
                    'type'        => \Elementor\Controls_Manager::CHOOSE,
                    'label_block' => false,
                    'options'     => [
                        'left'   => [
                            'title' => esc_html__( 'Left', 'vemus-addon' ),
                            'icon'  => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'vemus-addon' ),
                            'icon'  => 'eicon-h-align-center',
                        ],
                        'right'  => [
                            'title' => esc_html__( 'Right', 'vemus-addon' ),
                            'icon'  => 'eicon-h-align-right',
                        ],
                    ],
                    'default'     => '',
                    'selectors'   => [
                        '{{WRAPPER}} .wrap-tf-btn' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'style_icon',
                [
                    'label' => esc_html__('Show Icon', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'none',
                    'options'     => [
                        'none' => esc_html__( 'Hide', 'vemus-addon' ),
                        'show' => esc_html__( 'Show', 'vemus-addon' ),
                    ],
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label' => esc_html__( 'Icon', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'icon-arrow-right-2',
                        'library' => 'theme_icon',
                    ],
                    'condition' => [
	                    'style_icon!'	=> 'none',
	                ],
                ]
            );

		$this->end_controls_section();

         // Start Button
        $this->start_controls_section( 
            'section_style_button',
            [
                'label' => esc_html__( 'Button', 'vemus-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        ); 

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .wrap-tf-btn .tf-btn',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__( 'Border', 'vemus-addon' ),
				'selector' => '{{WRAPPER}} .wrap-tf-btn .tf-btn',
			]
		);

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn' => 'color: {{VALUE}};',
                ],
            ]
        );	

        $this->add_control(
            'button_background',
            [
                'label' => esc_html__( 'Background Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );	

        $this->end_controls_tab();

        $this->start_controls_tab( 'button_hover', [ 'label' => esc_html__( 'Hover', 'vemus-addon' ) ] );

        $this->add_control(
            'button_color_hover',
            [
                'label' => esc_html__( 'Color Hover', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );	

        $this->add_control(
            'button_background_hover',
            [
                'label' => esc_html__( 'Background Color Hover', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );	

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => esc_html__( 'Border Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_line',
            [
                'label' => esc_html__( 'Border Line Bottom Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn.btn-def-2::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'heading_button_icon',
            [
                'label' => esc_html__( 'Button Icon', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,					
                'separator' => 'before',
                'condition' => [
                    'style_icon!'	=> 'none',
                ],
            ]
        );	

        $this->add_responsive_control(
            'button_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'vemus-addon' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px','%','vh' ],
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style_icon!'	=> 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_icon_spacing',
            [
                'label'     => esc_html__( 'Icon Spacing', 'vemus-addon' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px','%','vh' ],
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wrap-tf-btn .tf-btn' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style_icon!'	=> 'none',
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
        $link_attrs = '';
        if ( ! empty( $settings['link_button']['url'] ) ) {
            if ( $settings['link_button']['is_external'] ) {
                $link_attrs .= ' target="_blank"';
            }
            if ( $settings['link_button']['nofollow'] ) {
                $link_attrs .= ' rel="nofollow"';
            }
        }
    ?>
            <div class="wrap-tf-btn">

                <?php if( $settings['style'] == 'style1' ): ?>

                    <a href="<?php echo esc_attr($settings['link_button']['url']); ?>" <?php echo $link_attrs; ?> class="tf-btn btn-fill animate-btn type-large">
                        <?php echo wp_kses_post( $settings['button_text'] ); ?>
                        <?php if ( $settings['style_icon'] != 'none' ) : ?>
                            <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>                            
                        <?php endif; ?>
                    </a>

                <?php elseif( $settings['style'] == 'style2' ): ?>

                    <a href="<?php echo esc_attr($settings['link_button']['url']); ?>" <?php echo $link_attrs; ?> class="tf-btn type-large">
                        <?php echo wp_kses_post( $settings['button_text'] ); ?>
                        <?php if ( $settings['style_icon'] != 'none' ) : ?>
                            <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>                            
                        <?php endif; ?>
                    </a>       
                    
                <?php else: ?>
                
                    <a href="<?php echo esc_attr($settings['link_button']['url']); ?>" <?php echo $link_attrs; ?> class="tf-btn btn-def-2 type-black">
                        <?php echo wp_kses_post( $settings['button_text'] ); ?>
                        <?php if ( $settings['style_icon'] != 'none' ) : ?>
                            <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>                            
                        <?php endif; ?>
                    </a>

                <?php endif; ?>

            </div>

            <?php
        }


}