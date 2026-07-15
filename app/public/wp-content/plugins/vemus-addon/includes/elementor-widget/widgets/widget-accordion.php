<?php

class Vemus_Accordion extends \Elementor\Widget_Base {

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
		return 'vemus_accordion';
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
		return esc_html__( 'Vemus Accordion', 'vemus-addon' );
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
		return 'eicon-accordion';
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
		return ['accordion' , 'tf'];
	}


	/**
	 * @since 1.0.0
	 * @access protected
	 */
        protected function register_controls() {

            $this->start_controls_section(
                'section_content',
                [
                    'label' => esc_html__( 'Accordion Items', 'vemus-addon' ),
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Accordion Title', 'vemus-addon' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'description',
                [
                    'label' => esc_html__( 'Description', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Accordion content goes here.', 'vemus-addon' ),
                    'show_label' => false,
                ]
            );

            $this->add_control(
                'accordion_items',
                [
                    'label' => esc_html__( 'Accordion List', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'title' => 'How can I place an order?',
                            'description' => 'Simply add your favorite items to the shopping cart...',
                        ],
                        [
                            'title' => 'Do you offer international shipping?',
                            'description' => 'Yes, we ship to many countries worldwide...',
                        ],
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );


            $this->end_controls_section();

            // Style Accordion Title
            $this->start_controls_section(
                'section_style_title',
                [
                    'label' => esc_html__( 'Accordion Title', 'vemus-addon' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typo',
                    'label'    => esc_html__( 'Typography', 'vemus-addon' ),
                    'selector' => '{{WRAPPER}} .faq-wrap .accordion-title',
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label'     => esc_html__( 'Color (Normal)', 'vemus-addon' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .accordion-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'title_active_color',
                [
                    'label'     => esc_html__( 'Color (Active)', 'vemus-addon' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .accordion-title:not(.collapsed)' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_section();

            // Style Accordion Body
            $this->start_controls_section(
                'section_style_body',
                [
                    'label' => esc_html__( 'Accordion Body', 'vemus-addon' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'     => 'body_typo',
                    'label'    => esc_html__( 'Typography', 'vemus-addon' ),
                    'selector' => '{{WRAPPER}} .accordion-body',
                ]
            );

            $this->add_control(
                'body_color',
                [
                    'label'     => esc_html__( 'Text Color', 'vemus-addon' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .accordion-body' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_section();


        }



	protected function render(): void {
	$settings = $this->get_settings_for_display();

	if ( empty( $settings['accordion_items'] ) ) {
		return;
	}

	?>


            <div class="faq-wrap" id="order-and-shipping">
                <?php foreach ( $settings['accordion_items'] as $index => $item ) :
                    $accordion_id = 'accordion-' . $this->get_id() . '-' . $index;
                    ?>
                    <div class="widget-accordion-2 style-2">
                        <div class="accordion-title collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#<?php echo esc_attr( $accordion_id ); ?>"
                            aria-expanded="false"
                            aria-controls="<?php echo esc_attr( $accordion_id ); ?>">
                            <span class="fw-medium"><?php echo wp_kses_post( $item['title'] ); ?></span>
                            <span class="icon ic-accordion-custom"></span>
                        </div>
                        <div id="<?php echo esc_attr( $accordion_id ); ?>"
                            class="collapse"
                            data-bs-parent="#order-and-shipping">
                            <div class="accordion-body">
                                <p><?php echo wp_kses_post( $item['description'] ); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


        <?php
    }
}

