<?php

class Vemus_Text_Scroll_Animation extends \Elementor\Widget_Base {

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
		return 'vemus_text_scroll_animation';
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
		return esc_html__( 'Vemus Text Scroll Animation', 'vemus-addon' );
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
		return 'eicon-animated-headline';
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

    public function get_script_depends() {
		return [ 'gsap','scrolltrigger','splittext','text-animation' ];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Text Scroll Animation', 'vemus-addon'),
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

            $this->add_control( "image", [
                'label' => esc_html__( "Image", 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                ],
                'condition' => [
                    'style'	=> 'style2',
                ],
            ] );

            $this->add_control( "banner_image", [
                'label' => esc_html__( "Banner", 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/banner-7.jpg",
                ],
                'condition' => [
                    'style'	=> 'style3',
                ],
            ] );


        $this->add_control(
			'text_content',
			[
				'label' => esc_html__( 'Main Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => 'We believe jewelry is more than an accessory—it’s a story of <br class="d-none d-xl-block">
				individuality and style. Our curated collection blends timeless <br class="d-none d-xl-block">
				craftsmanship with modern design, creating pieces that empower <br class="d-none d-xl-block">
				you to express your unique elegance every day.',
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'our story',
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Button Link', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '#',
					'is_external' => false,
				]
			]
		);

        

        $this->end_controls_section();

        // Style
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control( 'title_heading', [
            'label' => esc_html__( 'Title', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .widget-text-scroll .text-color-change, {{WRAPPER}} .widget-text-scroll .title',
            ]
        );

        $this->add_control(
            'start_color',
            [
                'label' => esc_html__( 'Start Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#A9A9A9',
            ]
        );

        $this->add_control(
            'end_color',
            [
                'label' => esc_html__( 'End Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1F1F1F',
            ]
        );


		$this->end_controls_section();

        $this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style!'	=> 'style3',
                ],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .widget-text-scroll .tf-btn, {{WRAPPER}} .widget-text-scroll .tf-btn-line span',
            ]
        );
		
		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-text-scroll .tf-btn, {{WRAPPER}} .widget-text-scroll .tf-btn-line' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            '{{WRAPPER}} .widget-text-scroll .tf-btn' => 'color: {{VALUE}};',
                        ],
                    ]
                );	

                $this->add_control(
                    'button_background',
                    [
                        'label' => esc_html__( 'Background', 'vemus-addon' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .widget-text-scroll .tf-btn' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );	

                $this->add_control(
                    'border_color',
                    [
                        'label' => esc_html__( 'Border Color', 'vemus-addon' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .widget-text-scroll .tf-btn' => 'border-color: {{VALUE}};',
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
                            '{{WRAPPER}} .widget-text-scroll .tf-btn:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );	

                $this->add_control(
                    'button_background_hover',
                    [
                        'label' => esc_html__( 'Background', 'vemus-addon' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .widget-text-scroll .tf-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                        ],
                    ]
                );	

                $this->add_control(
                    'button_border_color_hover',
                    [
                        'label' => esc_html__( 'Border Color', 'vemus-addon' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .widget-text-scroll .tf-btn:hover' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

		$this->end_controls_tab();

		$this->end_controls_section();

        $this->start_controls_section(
			'section_btn2',
			[
				'label' => esc_html__( 'Button', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style'	=> 'style3',
                ],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn2_typography',
                'selector' => '{{WRAPPER}} .widget-text-scroll .tf-btn-line span',
            ]
        );
		
        $this->add_control(
            'button2_color',
            [
                'label' => esc_html__( 'Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-text-scroll .tf-btn-line::after' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .widget-text-scroll .tf-btn-line' => 'color: {{VALUE}} !important;',
                ],
            ]
        );	

        $this->add_control(
            'button2_background_hover',
            [
                'label' => esc_html__( 'Color Hover', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-text-scroll .tf-btn-line:hover' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .widget-text-scroll .tf-btn-line::before' => 'background-color: {{VALUE}} !important;',
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
    $btn_url     = !empty($settings['button_link']['url']) ? esc_url($settings['button_link']['url']) : '#';
    $btn_target  = !empty($settings['button_link']['is_external']) ? ' target="_blank"' : '';
    $btn_rel     = !empty($settings['button_link']['nofollow']) ? ' rel="nofollow"' : '';
    ?>

        <?php if ($settings['style'] == 'style1'): ?>

        <!-- Banner Text -->
        <section class="flat-spacing-3 pt-0 widget-text-scroll">   
			<div class="container">
				<div class="banner_text flex-sm-nowrap">
                    <h3 
                        class="text-color-change fw-normal text-sm-start mb-0"
                        data-color-start="<?php echo esc_attr( $settings['start_color'] ); ?>"
                        data-color-end="<?php echo esc_attr( $settings['end_color'] ); ?>"
                    >
                        <?php echo $settings['text_content']; ?>
                    </h3>
					<?php if (!empty($settings['button_link']['url'])): ?>
                        <a href="<?php echo $btn_url; ?>" class="tf-btn style-4"<?php echo $btn_target . $btn_rel; ?>>
                            <?php if (!empty($settings['button_text'])): ?>
                                <?php echo esc_html($settings['button_text']); ?>
                                <i class="icon-arrow-right-2 fs-24"></i>
                            <?php endif; ?>
                        </a>
				    <?php endif; ?>
				</div>
			</div>
		</section>
        <!-- /Banner Text -->

        <?php elseif($settings['style'] == 'style2'): ?>

        <section class="flat-spacing widget-text-scroll">
            <div class="container">
                <div class="banner_text style-2 flex-sm-nowrap">
					<?php if (!empty($settings['image']['url'])): ?>
                        <a href="<?php echo $btn_url; ?>" class=" tf-btn style-4 type-size-2 border-primary">
                            <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="logo">
                        </a>
					<?php endif; ?>
                    <div class="d-flex flex-column ">
					    <?php if (!empty($settings['text_content'])): ?>
                            <h3 
                                class="text-color-change fw-normal text-sm-start"
                                data-color-start="<?php echo esc_attr( $settings['start_color'] ); ?>"
                                data-color-end="<?php echo esc_attr( $settings['end_color'] ); ?>"
                            >
                                <?php echo $settings['text_content']; ?>
                            </h3>
					    <?php endif; ?>
					    <?php if (!empty($settings['button_link']['url'])): ?>
                            <a href="<?php echo $btn_url; ?>" class="tf-btn btn-def fw-medium justify-content-sm-start"<?php echo $btn_target . $btn_rel; ?>>
                                <?php if (!empty($settings['button_text'])): ?>
                                    <?php echo esc_html($settings['button_text']); ?>
                                    <i class="icon-arrow-right-2 fs-24"></i>
					            <?php endif; ?>
                            </a>
					    <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="container border-bt-primary flat-spacing pt-0"></div>
        </section>

        <?php else: ?>

        <!-- Banner Text Line -->
        <div class="banner_V04 widget-text-scroll">
            <?php if (!empty($settings['banner_image']['url'])): ?>
                <div class="background-banner">
                    <img src="<?php echo esc_url($settings['banner_image']['url']); ?>" alt="banner">
                </div>
			<?php endif; ?>
            <div class="bn-content">
                <h3 
                    class="title text-color-change-2 fw-normal"
                    data-color-start="<?php echo esc_attr( $settings['start_color'] ); ?>"
                    data-color-end="<?php echo esc_attr( $settings['end_color'] ); ?>"
                >
                    <?php echo $settings['text_content']; ?>
                </h3>
               	<?php if (!empty($settings['button_link']['url'])): ?>
                    <a href="<?php echo $btn_url; ?>" class="tf-btn-line style-white text-uppercase lh-32 gap-10"<?php echo $btn_target . $btn_rel; ?>>
                        <?php if (!empty($settings['button_text'])): ?>
                            <span class="fs-16">
                                <?php echo esc_html($settings['button_text']); ?>
                            </span>
                            <i class="icon icon-arrow-top-right-2 fs-12"></i>
				        <?php endif; ?>
                    </a>
				<?php endif; ?>
            </div>
        </div>
        <!-- /Banner Text Line -->

        <?php endif; ?>



            <?php
        }


}