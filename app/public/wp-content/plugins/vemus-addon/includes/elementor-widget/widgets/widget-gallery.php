<?php

class Vemus_Gallery extends \Elementor\Widget_Base {

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
		return 'vemus_gallery';
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
		return esc_html__( 'Vemus Gallery', 'vemus-addon' );
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
		return ['gallery' , 'tf'];
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
	                'label' => esc_html__('Vemus Gallery', 'vemus-addon'),
	            ]
	        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/gallery-1.jpg",
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Gallery Title', 'vemus-addon' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Short description here.', 'vemus-addon' ),
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Show More', 'vemus-addon' ),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'gallery_items',
            [
                'label' => esc_html__( 'Gallery Items', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
					'default' => [
						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Gallery Title', 'vemus-addon' ),
							'description' => esc_html__( 'Short description here.', 'vemus-addon' ),
							'button_text' => esc_html__( 'Show More', 'vemus-addon' ),
						],
						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Gallery Title', 'vemus-addon' ),
							'description' => esc_html__( 'Short description here.', 'vemus-addon' ),
							'button_text' => esc_html__( 'Show More', 'vemus-addon' ),
						],
						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Gallery Title', 'vemus-addon' ),
							'description' => esc_html__( 'Short description here.', 'vemus-addon' ),
							'button_text' => esc_html__( 'Show More', 'vemus-addon' ),
						],
                        						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Gallery Title', 'vemus-addon' ),
							'description' => esc_html__( 'Short description here.', 'vemus-addon' ),
							'button_text' => esc_html__( 'Show More', 'vemus-addon' ),
						],
                        						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Gallery Title', 'vemus-addon' ),
							'description' => esc_html__( 'Short description here.', 'vemus-addon' ),
							'button_text' => esc_html__( 'Show More', 'vemus-addon' ),
						],
                        						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'Gallery Title', 'vemus-addon' ),
							'description' => esc_html__( 'Short description here.', 'vemus-addon' ),
							'button_text' => esc_html__( 'Show More', 'vemus-addon' ),
						],
	
					],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_responsive_control(
            'gallery_column',
            [
                'label' => esc_html__('Grid Column', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options'     => [
                    '1' => esc_html__( '1', 'vemus-addon' ),
                    '2' => esc_html__( '2', 'vemus-addon' ),
                    '3' => esc_html__( '3', 'vemus-addon' ),
                    '4' => esc_html__( '4', 'vemus-addon' ),
                ],
                'selectors' => [
					'{{WRAPPER}} .tf-widget-gallery .tf-grid-layout.xl-col-3' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
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

        // Style cho .gallery-V01 .content
        $this->add_control(
            'content_background',
            [
                'label' => esc_html__( 'Content Background', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-V01 .content' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .gallery-V01 .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Typography cho title
        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .gallery-V01 .title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-V01 .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography cho description
        $this->add_control(
            'desc_heading',
            [
                'label' => esc_html__( 'Description', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .gallery-V01 .desc',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Description Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-V01 .desc' => 'color: {{VALUE}} !important;',
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
                'selector' => '{{WRAPPER}} .gallery-V01 .tf-btn',
            ]
        );

        $this->add_control(
            'tf_btn_color',
            [
                'label' => esc_html__( 'Button Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-V01 .tf-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tf_btn_background_color',
            [
                'label' => esc_html__( 'Button Background', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-V01 .tf-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tf_btn_color_hover',
            [
                'label' => esc_html__( 'Button Color Hover', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-V01 .tf-btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .gallery-V01 .tf-btn.btn-def-2::after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tf_btn_background_color_hover',
            [
                'label' => esc_html__( 'Button Background Hover', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-V01 .tf-btn:hover' => 'background: {{VALUE}};',
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

            <section class="tf-widget-gallery">
                <div class="tf-grid-layout md-col-2 xl-col-3 gap-0">
                    <?php if ( ! empty( $settings['gallery_items'] ) ) :
                        foreach ( $settings['gallery_items'] as $item ) :
                            $img_url = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';
                            $title = $item['title'];
                            $desc = $item['description'];
                            $text_btn = $item['button_text'];
                            $link = $item['link']['url'] ?? '#';
                    ?>
                        <div class="gallery-V01 wow fadeInUp">
                            <a href="<?php echo esc_url($link); ?>" class="image">
                                <img src="<?php echo esc_url($img_url); ?>" alt="" class="lazyload">
                            </a>
                            <div class="content">
                                <div class="wrap-name">
                                    <a href="<?php echo esc_url($link); ?>" class="h4 fw-normal link text-line-clamp-1 title"><?php echo esc_html($title); ?></a>
                                    <p class="text-main-8 desc"><?php echo esc_html($desc); ?></p>
                                </div>
                                <div class="text-nowrap">
                                    <a href="<?php echo esc_url($link); ?>" class="tf-btn btn-def-2 type-large px-0">
                                        <?php echo esc_html($text_btn); ?>
                                        <i class="icon icon-arrow-right-3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
                </div>
            </section>

            <?php
        }


}