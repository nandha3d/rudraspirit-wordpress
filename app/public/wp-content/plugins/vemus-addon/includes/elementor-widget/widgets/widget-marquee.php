<?php

class Vemus_Marquee extends \Elementor\Widget_Base {

    public function __construct( $data = [], $args = null) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'vemus_marquee';
    }

    public function get_title() {
        return esc_html__( 'Vemus Marquee', 'vemus-addon' );
    }

    public function get_icon() {
        return 'eicon-animation';
    }

    public function get_categories() {
        return [ 'vemus_addons_core' ];
    }

    public function get_keywords() {
        return ['marquee' , 'tf'];
    }

    protected function register_controls() {

        // ====== CONTENT SECTION ======
        $this->start_controls_section( 'section_content',
            [
                'label' => esc_html__('Content', 'vemus-addon'),
            ]
        );

        // Speed
        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Speed (ms)', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 100,
                'min' => 10,
                'step' => 10,
            ]
        );

        // Repeater items
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sample Text', 'vemus-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'icon-diamond',
					'library' => 'theme_icon',
				],
			]
		);

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Marquee Items', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['text' => 'Black Friday Sale', 'icon' => 'icon-rhombus'],
                    ['text' => 'New Season Essential', 'icon' => 'icon-diamond'],
                    ['text' => 'Black Friday Sale', 'icon' => 'icon-rhombus'],
                    ['text' => 'New Season Essential', 'icon' => 'icon-diamond'],
                    ['text' => 'Black Friday Sale', 'icon' => 'icon-rhombus'],
                    ['text' => 'New Season Essential', 'icon' => 'icon-diamond'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

        // ====== STYLE SECTION ======
        $this->start_controls_section( 'section_style',
            [
                'label' => esc_html__('Style', 'vemus-addon'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Background color
        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .vemus-marquee-wrapper' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .vemus-marquee-wrapper .text-clip' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control( 
			'content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .vemus-marquee-wrapper .tf_marquee-V01' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => esc_html__( 'Border', 'vemus-addon' ),
				'selector' => '{{WRAPPER}} .vemus-marquee-wrapper',
			]
		);

        $this->add_control(
			'heading_text',
			[
				'label' => esc_html__( 'Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .vemus-marquee-wrapper p',
			]
		);

        // Text color
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .vemus-marquee-wrapper p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .vemus-marquee-wrapper .text-clip' => '    text-shadow: -1px -1px 0 {{VALUE}}, 1px -1px 0 {{VALUE}}, -1px 1px 0 {{VALUE}}, 1px 1px 0 {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color_clip',
            [
                'label' => esc_html__('Text Outline Color', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .vemus-marquee-wrapper .text-clip' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
			'heading_icon',
			[
				'label' => esc_html__( 'Icon', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .vemus-marquee-wrapper i' => 'color: {{VALUE}};',
				],
			]
		);	

        $this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Size Icon', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vemus-marquee-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
        $speed = intval($settings['speed']);
        ?>
        <div class="vemus-marquee-wrapper">
            <div class="tf_marquee-V01 infiniteSlide" data-speed="<?php echo $speed; ?>">
                <?php $count=1; foreach ( $settings['items'] as $item ) : ?>
                    <p class="<?php echo esc_attr($count%2 ? 'text-clip style-white' : ''); ?>"><?php echo esc_html($item['text']); ?></p>
                    <?php if ( !empty($item['icon']) ) : ?>
                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                    <?php endif; ?>
                <?php $count++; endforeach; ?>
            </div>
        </div>
        <?php
    }
}
