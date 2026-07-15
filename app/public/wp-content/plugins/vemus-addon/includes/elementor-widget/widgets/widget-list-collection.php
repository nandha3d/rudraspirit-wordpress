<?php

class Vemus_List_Collection extends \Elementor\Widget_Base {

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
		return 'vemus_list_collection';
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
		return esc_html__( 'Vemus List Collection', 'vemus-addon' );
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
		return 'eicon-gallery-grid';
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
		return ['collection' , 'tf'];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus List Collection', 'vemus-addon'),
	            ]
	        );

            $this->add_control(
                'title_section',
                [
                    'label' => esc_html__('Title Section', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => '<span>Inspired</span> STYLE <br>
                    FOR EVERY <span>Seasons</span>',
                    'label_block' => true,
                ]
            );

             $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'image',
                [
                    'label' => esc_html__('Image', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_control(
                'title',
                [
                    'label' => esc_html__('Title', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => 'Collection Title',
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'link',
                [
                    'label' => esc_html__('Link', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => 'https://your-link.com',
                    'default' => [
                        'url' => '#',
                    ],
                ]
            );

            $this->add_control(
                'collections',
                [
                    'label' => esc_html__('Collection Items', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
					'default' => [
						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Collection Title', 'vemus-addon' ),
						],
						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Collection Title', 'vemus-addon' ),
						],
						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Collection Title', 'vemus-addon' ),
						],
                        						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Collection Title', 'vemus-addon' ),
						],
                        						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Collection Title', 'vemus-addon' ),
						],
                        						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Collection Title', 'vemus-addon' ),
						],
	
					],
                    'title_field' => '{{{ title }}}',
                ]
            );


            $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'vemus-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title Section', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .wg-list-collection .s-title-2',
        ] );

        $this->add_control( 'title_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-list-collection .s-title-2' => 'color: {{VALUE}} !important',
            ],
        ] );

        $this->add_control( 'title_color_span', [
            'label' => esc_html__( 'Color Span', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-list-collection .s-title-2 span' => 'color: {{VALUE}} !important',
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
					'{{WRAPPER}}  .wg-list-collection .s-title-2' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_control(
            'btn_heading',
            [
                'label' => esc_html__( 'Button', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tf_btn_typography',
                'selector' => '{{WRAPPER}} .wg-list-collection .tf-btn .name-cls',
            ]
        );

        $this->add_control(
            'tf_btn_color',
            [
                'label' => esc_html__( 'Button Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wg-list-collection .tf-btn' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tf_btn_color_hover',
            [
                'label' => esc_html__( 'Button Color Hover', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wg-list-collection .tf-btn:hover' => 'color: {{VALUE}} !important;',
                                        '{{WRAPPER}} .wg-list-collection .tf-btn:hover i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .wg-list-collection .tf-btn.btn-line::after' => 'background-color: {{VALUE}} !important;',
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
    $collections = $settings['collections'];
    ?>

        <div class="flat-spacing-3 wg-list-collection">
            <div class="container">
                <p class="s-title-2 font-2 text-center text-lg-end letter-space-0 wow fadeInLeft">
                    <?php echo wp_kses_post($settings['title_section']); ?>
                </p>
                <div class="cls-wrap">
                    <?php $count=1; foreach ( $collections as $index => $item ) :
                        $img_url = $item['image']['url'] ?? '';
                        $title = $item['title'] ?? '';
                        $link = $item['link']['url'] ?? '#';
                        $link_attrs = '';
                        if ( ! empty( $item['link']['url'] ) ) {
                            if ( $item['link']['is_external'] ) {
                                $link_attrs .= ' target="_blank"';
                            }
                            if ( $item['link']['nofollow'] ) {
                                $link_attrs .= ' rel="nofollow"';
                            }
                        }
                        ?>
                        <a href="<?php echo esc_url($link); ?>" <?php echo $link_attrs; ?> class="box_collection--V02 hover-img wow fadeInUp" data-wow-delay="0.<?php echo esc_attr($count); ?>s">
                            <div class="image img-style">
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" class="lazyload">
                            </div>
                            <div class="tf-btn btn-line has-icon link">
                                <p class="name-cls fw-normal"><?php echo esc_html($title); ?></p>
                                <i class="ic-2 icon-arrow-top-right"></i>
                            </div>
                        </a>
                    <?php $count++; endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }



}