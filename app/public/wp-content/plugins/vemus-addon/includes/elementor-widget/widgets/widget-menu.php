<?php

class Vemus_Menu extends \Elementor\Widget_Base {

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
		return 'vemus_menu';
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
		return esc_html__( 'Vemus Menu', 'vemus-addon' );
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
		return 'eicon-editor-list-ol';
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
		return ['menu' , 'tf'];
	}

    public function get_style_depends() {
		return [ 'vemus-addons' ];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Menu', 'vemus-addon'),
	            ]
	        );

            $this->add_control(
                'title_menu',
                [
                    'label' => esc_html__('Title Menu', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => 'PRODUCT LAYOUT',
                    'label_block' => true,
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'text_menu',
                [
                    'label' => esc_html__('Text Menu', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'badge',
                [
                    'label' => esc_html__('Badge', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Hot',
                    'label_block' => true,
                ]
            );

			$repeater->add_control(
				'badge_background',
				[
					'label' => __( 'Badge Background', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}_content .demo-label' => 'background-color: {{VALUE}} !important;',
					],
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
                    'label' => esc_html__('List Menu', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'title_field' => '{{{ text_menu }}}',
                ]
            );
        

        $this->end_controls_section();

        $this->start_controls_section( 'section_style',
            [
                'label' => esc_html__('Style', 'vemus-addon'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'heading_title_menu',
			[
				'label' => esc_html__( 'Title Menu', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_menu_typography',
				'selector' => '{{WRAPPER}} .widget-menu .title-menu',
			]
		);

        $this->add_control(
            'title_menu_color',
            [
                'label' => esc_html__('Text Color', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-menu .title-menu' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-menu .title-menu::before, {{WRAPPER}} .widget-menu .title-menu::after ' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_menu_margin',
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
                    '{{WRAPPER}} .widget-menu .title-menu' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
			'heading_menu',
			[
				'label' => esc_html__( 'Title Menu', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'selector' => '{{WRAPPER}} .widget-menu .list-menu a',
			]
		);

        $this->add_control(
            'menu_color',
            [
                'label' => esc_html__('Text Color', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-menu .list-menu a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_margin',
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
                    '{{WRAPPER}} .widget-menu .list-menu a' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
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

                <div class="widget-menu widget_nav_menu">
                    <div class="title-menu widget-title"><?php echo wp_kses_post( $settings['title_menu'] ); ?></div>
                    <ul class="list-menu tf-collapse-content">
                        <?php foreach ( $settings['collections'] as $index => $item ) : 
                            $title     = !empty( $item['text_menu'] ) ? wp_kses_post( $item['text_menu'] ) : '';
							$badge     = !empty( $item['badge'] ) ? wp_kses_post( $item['badge'] ) : '';
							$link_url  = !empty( $item['link']['url'] ) ? esc_url( $item['link']['url'] ) : '#';
							$link_target = ! empty( $item['link']['is_external'] ) ? ' target="_blank"' : '';
                        ?>
                            <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ?? '' ); ?>_content">
                                <a href="<?php echo $link_url; ?>">
                                    <?php echo $title; ?>
                                    <?php if ( $badge ) : ?>
                                        <span class="demo-label"><?php echo $badge; ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            <?php
        }


}



                            


