<?php

class Vemus_Banner_With_Product extends \Elementor\Widget_Base {

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
		return 'vemus_banner_with_product';
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
		return esc_html__( 'Vemus Banner With Product', 'vemus-addon' );
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
		return 'eicon-banner';
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

        public function get_style_depends() {
		return [ 'themesflat-swiper','vemus-addons' ];
	}

    public function get_script_depends() {
		return [ 'themesflat-swiper','slider-core' ];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Banner With Product', 'vemus-addon'),
	            ]
	        );

        $this->add_control(
            'banner_image',
            [
                'label' => esc_html__('Image', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
                    ],
            ]
        );

            $this->add_group_control(
				\Elementor\Group_Control_Image_Size::get_type(),
				[
					'name'      => 'image_size', 
					'default'   => 'full',
					'separator' => 'none',
				]
			);

        $this->add_control(
			'sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'NEW IN', 'vemus-addon' ),
			]
		);	

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Radiate Elegance Wear Confidence', 'vemus-addon' ),
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

        $this->add_control(
			'heading_product',
			[
				'label' => esc_html__( 'Select Product Preview', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'product_id',
			[
				'label' => esc_html__( 'Product Preview', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => TFWC_Elementor_Widget_Addon::get_products(),
			]
		);

		$this->add_control( 
			'carousel_list',
			[                    
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Image Box Style', 'vemus-addon' ),
            	'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        	$this->add_control(
			'heading_desc',
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
				'selector' => '{{WRAPPER}} .widget-banner-with-product .sub-title',
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-with-product .sub-title' => 'color: {{VALUE}} !important;',
				],
			]
		);

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
					'{{WRAPPER}}  .widget-banner-with-product .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                ],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title Style', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .widget-banner-with-product .title',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-with-product .title' => 'color: {{VALUE}} !important;',
				],
			]
		);

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
					'{{WRAPPER}}  .widget-banner-with-product .title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        
		$this->add_control(
			'heading_button_style',
			[
				'label' => __( 'Button Style', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .widget-banner-with-product .tf-btn',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__( 'Border', 'vemus-addon' ),
				'selector' => '{{WRAPPER}} .widget-banner-with-product .tf-btn',
			]
		);

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .widget-banner-with-product .tf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .widget-banner-with-product .tf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .widget-banner-with-product .tf-btn' => 'color: {{VALUE}};',
                ],
            ]
        );	

        $this->add_control(
            'button_background',
            [
                'label' => esc_html__( 'Background Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-banner-with-product .tf-btn' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .widget-banner-with-product .tf-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );	

        $this->add_control(
            'button_background_hover',
            [
                'label' => esc_html__( 'Background Color Hover', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-banner-with-product .tf-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );	

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => esc_html__( 'Border Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-banner-with-product .tf-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section( 
			'section_product',
			[
				'label' => esc_html__( 'Product', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		); 

        $this->add_control(
			'heading_content_bg',
			[
				'label' => esc_html__( 'Content Background', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .banner_V07 .wrap',
			]
		);

		$this->add_control(
			'heading_name',
			[
				'label' => esc_html__( 'Name', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .widget-banner-with-product .name',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-with-product .name' => 'color: {{VALUE}} !important;',
				],
			]
		);	

		$this->add_control(
			'heading_price',
			[
				'label' => esc_html__( 'Price', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .widget-banner-with-product .price-new',
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-with-product .price-new' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'price_sale_color',
			[
				'label' => esc_html__( 'Sale Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-with-product .price-new del' => 'color: {{VALUE}};',
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

		$this->add_responsive_control(
			'button_width_size',
			[
				'label'     => esc_html__( 'Width & Height', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 30,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-banner-with-product .tf-btn-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
	
		$this->add_responsive_control(
			'button_size',
			[
				'label'     => esc_html__( 'Size', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 16,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-banner-with-product .tf-btn-icon .icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
	
		$this->add_control(
			'button_border_radius_product',
			[
				'label'      => __( 'Border Radius', 'vemus-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .widget-banner-with-product .tf-btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'button_color_product',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-with-product .tf-btn-icon' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'button_background_product',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-banner-with-product .tf-btn-icon' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
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
        $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src(
            $settings['banner_image']['id'],
            'image_size',
            $settings
        );
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

        <!-- Banner Image Text -->
        <section class="widget-banner-with-product">
            <div class="banner_V07">
                <div class="bn-image-text">
                    <?php if ( $image_url ) : ?>
                        <div class="image">
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="Image">
                        </div>
                    <?php else: ?>
                        <div class="image">
                            <img src="<?php echo TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg"; ?>" alt="Image">
                        </div>
                    <?php endif; ?>
                    <div class="content wow fadeInUp">
                        <?php if ( !empty($settings['sub_title']) ): ?>
                            <h6 class="caption fw-normal sub-title"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                        <?php endif; ?>
                        <?php if ( !empty($settings['title']) ): ?>
                            <p class="title text-hero-2 font-2">
                                <?php echo wp_kses_post($settings['title']); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ( !empty($settings['link_button']['url']) && !empty($settings['button_text']) ): ?>
                            <a href="<?php echo esc_url($settings['link_button']['url']); ?>" 
                            class="tf-btn btn-fill-2 type-large animate-btn text-uppercase" <?php echo $link_attrs; ?>>
                                <?php echo wp_kses_post( $settings['button_text'] ); ?>
                                <i class="icon-arrow-right-2 fs-24"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="wrap">
                <?php if ( !empty($settings['carousel_list']) && is_array($settings['carousel_list']) ): ?>
                                <div class="tf-swiper tfc-swiper swiper wow fadeInUp" data-cursor="true" data-space="30">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['carousel_list'] as $carousel): ?>
                                            <?php 
                                                $product_id = !empty($carousel['product_id']) ? $carousel['product_id'] : 0;
                                                $product = wc_get_product($product_id);
                                                if ($product): 
                                            ?>
                                                <div class="swiper-slide">
                                                    <div class="card_product--V03">
                                                        <div class="card_product-wrapper">
                                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id(), 'vemus-product-video')); ?>" 
                                                                alt="<?php echo esc_attr($product->get_name()); ?>">
                                                        </div>
                                                        <div class="card_product-info">
                                                            <div class="infor">
                                                                <div class="info-product">
                                                                    <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" 
                                                                    class="name h5 fw-normal link text-line-clamp-2">
                                                                        <?php echo wp_kses_post($product->get_name()); ?>
                                                                    </a>
                                                                    <div class="price-wrap">
                                                                        <span class="price-new h5">
                                                                            <?php echo wp_kses_post($product->get_price_html()); ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="btn-action">
                                                                <a href="#quickView" data-bs-toggle="modal" 
                                                                class="tf-btn-icon style-circle hover-tooltip quickview tf_quickview_btn" data-quantity="1" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
                                                                    <i class="icon icon-view"></i>
                                                                    <span class="tooltip"><?php esc_html_e('Quick View', 'vemus-addon'); ?></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="sw-dot-default style-white tf-sw-pagination d-lg-none"></div>
                                </div>
                            <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- /Banner Image Text -->


            <?php
        }


}