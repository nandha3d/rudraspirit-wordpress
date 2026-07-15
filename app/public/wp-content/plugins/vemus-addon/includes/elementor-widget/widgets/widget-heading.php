<?php

class Vemus_Heading extends \Elementor\Widget_Base {

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
		return 'vemus_heading';
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
		return esc_html__( 'Vemus Heading', 'vemus-addon' );
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
		return 'eicon-heading';
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
		return ['heading' , 'tf'];
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
	                'label' => esc_html__('Vemus Heading', 'vemus-addon'),
	            ]
	        );

            $this->add_control(
                'title',
                [
                    'label' => esc_html__('Title', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '<span class="fst-italic">Our</span> Categories',
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'description',
                [
                    'label' => esc_html__('Description', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => 'Explore our collection of sophisticated, modern designs that make a statement without saying a word.
                        <br class="d-none d-xl-block">
                        Find your signature look today.',
                    'label_block' => true,
                ]
            );

            $this->add_responsive_control(
				'text_align',
				[
					'label'       => esc_html__( 'Alignment', 'vemus-addon' ),
					'type'        => \Elementor\Controls_Manager::CHOOSE,
					'label_block' => false,
					'options'     => [
						'left'   => [
							'title' => esc_html__( 'Left', 'vemus-addon' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'vemus-addon' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right'  => [
							'title' => esc_html__( 'Right', 'vemus-addon' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'default'     => '',
					'selectors'   => [
						'{{WRAPPER}}  .widget-heading' => 'text-align: {{VALUE}}',
					],
	
				]
            );
        

        $this->end_controls_section();

        $this->start_controls_section( 'section_style', [
            'label' => esc_html__( 'Style', 'vemus-addon' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'title_heading', [
            'label' => esc_html__( 'Title', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-heading .s-title',
        ] );

        $this->add_control( 'title_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-heading .s-title' => 'color: {{VALUE}} !important',
            ],
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'title__span_typography',
            'label' => esc_html__( 'Typography Highlight Title', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-heading .s-title span',
        ] );

        $this->add_control( 'title__span_color', [
            'label' => esc_html__( 'Color Highlight Title', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-heading .s-title span' => 'color: {{VALUE}} !important',
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
					'{{WRAPPER}}  .widget-heading .s-title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_control( 'desc_heading', [
            'label' => esc_html__( 'Description', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'desc_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-heading .s-sub-title',
        ] );

        $this->add_control( 'desc_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-heading .s-sub-title' => 'color: {{VALUE}} !important',
            ],
        ] );
        
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

<?php if ( !empty( $settings['title'] ) || !empty( $settings['description'] ) ) : ?>
    <div class="widget-heading">
        <?php if ( !empty( $settings['title'] ) ) : ?>
            <h2 class="s-title font-2">
                <?php echo wp_kses_post( $settings['title'] ); ?>
            </h2>
        <?php endif; ?>

        <?php if ( !empty( $settings['description'] ) ) : ?>
            <p class="s-sub-title">
                <?php echo wp_kses_post( $settings['description'] ); ?>
            </p>
        <?php endif; ?>
    </div>
<?php endif; ?>


        <?php
    }


}