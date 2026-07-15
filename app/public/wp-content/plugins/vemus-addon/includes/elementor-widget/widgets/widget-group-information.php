<?php

class Vemus_Group_Information extends \Elementor\Widget_Base {

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
		return 'vemus_group_information';
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
		return esc_html__( 'Vemus Group Information', 'vemus-addon' );
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
		return 'eicon-kit-details';
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

	/**
	 * @since 1.0.0
	 * @access protected
	 */

	protected function register_controls() {
		// Section
		$this->start_controls_section( 'section_setting',
			[
				'label' => esc_html__('Vemus Group Information', 'vemus-addon'),
			]
		);

		// Image main (Core Values Image)
		$this->add_control(
			'main_image',
			[
				'label' => esc_html__( 'Main Image', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                ],
			]
		);

		// Repeater
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'TIMLESS CRAFTSMANSHIP', 'vemus-addon' ),
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Every piece is meticulously crafted...', 'vemus-addon' ),
			]
		);

		$repeater->add_control(
			'highlight',
			[
				'label' => esc_html__( 'Highlight Box?', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'values_list',
			[
				'label' => esc_html__( 'Core Values List', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
						[
							'title' => esc_html__( 'TIMLESS CRAFTSMANSHIP', 'vemus-addon' ),
							'description' => esc_html__( 'Every piece is meticulously crafted...', 'vemus-addon' ),
						],
												[
							'title' => esc_html__( 'TIMLESS CRAFTSMANSHIP', 'vemus-addon' ),
							'description' => esc_html__( 'Every piece is meticulously crafted...', 'vemus-addon' ),
						],
												[
							'title' => esc_html__( 'TIMLESS CRAFTSMANSHIP', 'vemus-addon' ),
							'description' => esc_html__( 'Every piece is meticulously crafted...', 'vemus-addon' ),
						],
												[
							'title' => esc_html__( 'TIMLESS CRAFTSMANSHIP', 'vemus-addon' ),
							'description' => esc_html__( 'Every piece is meticulously crafted...', 'vemus-addon' ),
						],
	
					],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_box_normal',
			[
				'label' => esc_html__( 'Normal Box Style', 'vemus-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'content_heading',
            [
                'label' => esc_html__( 'Content', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		// Background
		$this->add_control(
			'box_bg_normal',
			[
				'label' => esc_html__( 'Background', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .value-box:not(.hightlight)' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		// Title Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo_normal',
				'label' => esc_html__( 'Title Typography', 'vemus-addon' ),
				'selector' => '{{WRAPPER}} .value-box:not(.hightlight) .value-title',
			]
		);

		// Title Color
		$this->add_control(
			'title_color_normal',
			[
				'label' => esc_html__( 'Title Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .value-box:not(.hightlight) .value-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'desc_heading',
            [
                'label' => esc_html__( 'Description', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		// Description Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo_normal',
				'label' => esc_html__( 'Description Typography', 'vemus-addon' ),
				'selector' => '{{WRAPPER}} .value-box:not(.hightlight) .value-description',
			]
		);

		// Description Color
		$this->add_control(
			'desc_color_normal',
			[
				'label' => esc_html__( 'Description Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .value-box:not(.hightlight) .value-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Box Highlight Style
		$this->start_controls_section(
			'style_box_highlight',
			[
				'label' => esc_html__( 'Highlight Box Style', 'vemus-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'content2_heading',
            [
                'label' => esc_html__( 'Content', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		// Background
		$this->add_control(
			'box_bg_highlight',
			[
				'label' => esc_html__( 'Background', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .value-box.hightlight' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'title2_heading',
            [
                'label' => esc_html__( 'Title', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		// Title Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo_highlight',
				'label' => esc_html__( 'Title Typography', 'vemus-addon' ),
				'selector' => '{{WRAPPER}} .value-box.hightlight .value-title',
			]
		);

		// Title Color
		$this->add_control(
			'title_color_highlight',
			[
				'label' => esc_html__( 'Title Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .value-box.hightlight .value-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'desc2_heading',
            [
                'label' => esc_html__( 'Description', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		// Description Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo_highlight',
				'label' => esc_html__( 'Description Typography', 'vemus-addon' ),
				'selector' => '{{WRAPPER}} .value-box.hightlight .value-description',
			]
		);

		// Description Color
		$this->add_control(
			'desc_color_highlight',
			[
				'label' => esc_html__( 'Description Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .value-box.hightlight .value-description' => 'color: {{VALUE}};',
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
		<!-- Core Value -->
		<section class="s-core-values">
			<div class="container">
				<div class="values-grid tf-grid-layout md-col-2 xl-col-3">
					<?php if ( ! empty( $settings['main_image']['url'] ) ) : ?>
						<div class="core-values-image">
							<img src="<?php echo esc_url( $settings['main_image']['url'] ); ?>" alt="Core Value">
						</div>
					<?php endif; ?>

					<?php
					if ( ! empty( $settings['values_list'] ) ) :
						foreach ( $settings['values_list'] as $item ) :
							$highlight_class = $item['highlight'] === 'yes' ? 'hightlight' : '';
							?>
							<div class="value-box <?php echo esc_attr( $highlight_class ); ?>">
								<h4 class="value-title"><?php echo esc_html( $item['title'] ); ?></h4>
								<span class="br-line"></span>
								<p class="value-description"><?php echo esc_html( $item['description'] ); ?></p>
							</div>
							<?php
						endforeach;
					endif;
					?>
				</div>
			</div>
		</section>
		<!-- /Core Value -->
		<?php
	}


}