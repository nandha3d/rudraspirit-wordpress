<?php

class Vemus_Product_Video extends \Elementor\Widget_Base {

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
		return 'vemus_product_video';
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
		return esc_html__( 'Vemus Product Video', 'vemus-addon' );
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
		return 'eicon-slider-video';
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
		return ['video' , 'tf'];
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
	                'label' => esc_html__('Vemus Product Video', 'vemus-addon'),
	            ]
	        );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
            'style',
            [
                'label' => esc_html__( 'Type URL Video', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style2',
                'options' => [
                    'style1' => esc_html__( 'Hosted URL', 'vemus-addon' ),
                    'style2' => esc_html__( 'Youtube URL', 'vemus-addon' ),
					'style3' => esc_html__( 'TikTok URL', 'vemus-addon' ),
                ],
            ]
        );

		$repeater->add_control(
			'hosted_link',
			[
				'label' => esc_html__('Video URL', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your URL', 'vemus-addon' ),
				'condition' => [
					'style'	=> 'style1',
				],
			]
		);

		$repeater->add_control(
			'ytb_link',
			[
				'label' => esc_html__('Video URL', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'https://www.youtube.com/watch?v=MLpWrANjFbI', 'vemus-addon' ),
				'condition' => [
					'style'	=> 'style2',
				],
			]
		);

		$repeater->add_control(
			'tiktok_link',
			[
				'label' => esc_html__('TikTok Video URL', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'https://www.tiktok.com/@username/video/1234567890', 'vemus-addon' ),
				'condition' => [
					'style'	=> 'style3',
				],
			]
		);

		$repeater->add_control(
			'product_id',
			[
				'label' => esc_html__( 'Product', 'vemus-addon' ),
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
				'default' => [
					[ 
						'ytb_link'=> 'https://www.youtube.com/watch?v=MLpWrANjFbI',
					],
					[ 
						'ytb_link'=> 'https://www.youtube.com/watch?v=MLpWrANjFbI',
					],
					[ 
						'ytb_link'=> 'https://www.youtube.com/watch?v=MLpWrANjFbI',
					],
				],	
			]
		);
        

        $this->end_controls_section();

		// Start Carousel Setting        
			$this->start_controls_section( 'carousel_setting',
                [
                    'label' => esc_html__('Carousel Settings', 'vemus-addon'),
                ]
            );

            $this->add_responsive_control( 
                'spacing',
                [
                    'label' => esc_html__( 'Spacing', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                	'devices' => ['desktop', 'tablet', 'mobile'],
                	'default' => 30,
                	'tablet_default' => 30,
                	'mobile_default' => 30,
					'frontend_available' => true,
                ]
            );


		$this->add_control(
			'group-slidesPerView',
			[
				'label' => esc_html__( 'Slides Per View', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'default' => '',	
			]
		);

		$this->start_popover();

		$this->add_control(
			'slidesPerView-xs',
			[
				'label' => esc_html__( 'XS (<576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'group-slidesPerView' =>'yes'
				],
			]
		);

		$this->add_control(
			'slidesPerView-sm',
			[
				'label' => esc_html__( 'SM (≥576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'condition' => [
					'group-slidesPerView' =>'yes'
				],
			]
		);
		
		$this->add_control(
			'slidesPerView-md',
			[
				'label' => esc_html__( 'MD (≥768px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 2,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'condition' => [
					'group-slidesPerView' =>'yes'
				],
			]
		);
		
		$this->add_control(
			'slidesPerView-xl',
			[
				'label' => esc_html__( 'XL (≥1200px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 2,
				'max' => 10,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'group-slidesPerView' =>'yes'
				],
			]
		);
		
		$this->end_popover();

	  	$this->add_control(
			'group-slidesPerGroup',
			[
				'label' => esc_html__( 'Slides Per Group', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'default' => '',	
			]
		);

		$this->start_popover();

		$this->add_control(
			'slidesPerGroup-xs',
			[
				'label' => esc_html__( 'XS (<576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'group-slidesPerGroup' =>'yes'
				],
			]
		);

		$this->add_control(
			'slidesPerGroup-sm',
			[
				'label' => esc_html__( 'SM (≥576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'condition' => [
					'group-slidesPerGroup' =>'yes'
				],
			]
		);
		
		$this->add_control(
			'slidesPerGroup-md',
			[
				'label' => esc_html__( 'MD (≥768px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'condition' => [
					'group-slidesPerGroup' =>'yes'
				],
			]
		);
		
		$this->add_control(
			'slidesPerGroup-xl',
			[
				'label' => esc_html__( 'XL (≥1200px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'group-slidesPerGroup' =>'yes'
				],
			]
		);
		
		$this->end_popover();

		
		$this->add_control(
			'bullet_enable',
			[ 
				'label'        => esc_html__( 'Bullet', 'vemus-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'vemus-addon' ),
				'label_off'    => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);


        $this->end_controls_section();

		  // Start Style
	$this->start_controls_section( 
        'section_content',
        [
        	'label' => esc_html__( 'Content', 'vemus-addon' ),
        	'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
	); 

	$this->add_control(
		'content_border_radius',
		[
			'label'      => __( 'Border Radius', 'vemus-addon' ),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .widget-product-video .cls_videoV01' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

    $this->end_controls_section();
	
		$this->start_controls_section( 
			'section_product',
			[
				'label' => esc_html__( 'Product', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		); 

		$this->add_control(
			'product_background',
			[
				'label' => esc_html__( 'Background', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .cls-content' => 'background-color: {{VALUE}};',
				],
			]
		);	

		$this->add_responsive_control( 
			'product_padding',
			[
				'label' => esc_html__( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .cls-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'product_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .cls-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_image_product',
			[
				'label' => esc_html__( 'Image', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

		$this->add_responsive_control(
			'image_product_width_size',
			[
				'label'     => esc_html__( 'Width & Height', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 50,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .img-product' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; max-width: unset;',
				],
			]
		);

		$this->add_control(
			'image_product_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .img-product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'selector' => '{{WRAPPER}} .widget-product-video .cls-content .name',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .cls-content .name' => 'color: {{VALUE}} !important;',
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
				'selector' => '{{WRAPPER}} .widget-product-video .cls-content .price-wrap',
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .cls-content .price-wrap' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'price_sale_color',
			[
				'label' => esc_html__( 'Sale Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .cls-content .price-wrap del' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .widget-product-video .cls-content .tf-btn-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .widget-product-video .cls-content .tf-btn-icon .icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
	
		$this->add_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'vemus-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .widget-product-video .cls-content .tf-btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .cls-content .tf-btn-icon' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'button_background',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-product-video .cls-content .tf-btn-icon' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
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
			 if (!function_exists('convertToEmbed')) {
			function convertToEmbed($url) {
				if (strpos($url, 'youtube.com') !== false) {
					parse_str(parse_url($url, PHP_URL_QUERY), $query);
					if (isset($query['v'])) {
						$videoId = $query['v'];
						return "https://www.youtube.com/embed/" . $videoId;
					}
				} elseif (strpos($url, 'youtu.be') !== false) {
					$videoId = basename(parse_url($url, PHP_URL_PATH));
					return "https://www.youtube.com/embed/" . $videoId;
				}
		
				return false;
			}
		}
		 $slides_per_view_xs = !empty($settings['slidesPerView-xs']) ? $settings['slidesPerView-xs'] : 1;
            $slides_per_view_sm = !empty($settings['slidesPerView-sm']) ? $settings['slidesPerView-sm'] : 2;
            $slides_per_view_md = !empty($settings['slidesPerView-md']) ? $settings['slidesPerView-md'] : 3;
            $slides_per_view_xl = !empty($settings['slidesPerView-xl']) ? $settings['slidesPerView-xl'] : 3;
            
            $slides_per_group_xs = !empty($settings['slidesPerGroup-xs']) ? $settings['slidesPerGroup-xs'] : 1;
            $slides_per_group_sm = !empty($settings['slidesPerGroup-sm']) ? $settings['slidesPerGroup-sm'] : 2;
            $slides_per_group_md = !empty($settings['slidesPerGroup-md']) ? $settings['slidesPerGroup-md'] : 3;
            $slides_per_group_xl = !empty($settings['slidesPerGroup-xl']) ? $settings['slidesPerGroup-xl'] : 3;

            $space_between_mobile = !empty($settings['spacing_mobile']) ? $settings['spacing_mobile'] : 0;
            $space_between_tablet = !empty($settings['spacing_tablet']) ? $settings['spacing_tablet'] : 0;
            $space_between_desktop = !empty($settings['spacing']) ? $settings['spacing'] : 0;
    ?>
        
        <!-- Shop The Look -->
        <section class="widget-product-video">
                <div class="swiper tf-swiper tfc-swiper" data-preview="<?php echo esc_attr($slides_per_view_xl); ?>" data-tablet="<?php echo esc_attr($slides_per_view_md); ?>" data-mobile-sm="<?php echo esc_attr($slides_per_view_sm); ?>" data-mobile="<?php echo esc_attr($slides_per_view_xs); ?>" data-space-lg="<?php echo esc_attr($space_between_desktop); ?>"
                    data-space-md="<?php echo esc_attr($space_between_tablet); ?>" data-space="<?php echo esc_attr($space_between_mobile); ?>" data-pagination="<?php echo esc_attr($slides_per_group_xs); ?>" data-pagination-sm="<?php echo esc_attr($slides_per_group_sm); ?>" data-pagination-md="<?php echo esc_attr($slides_per_group_md); ?>" data-pagination-lg="<?php echo esc_attr($slides_per_group_xl); ?>">
                    <div class="swiper-wrapper">

						<?php foreach ($settings['carousel_list'] as $carousel): ?>	
                        <div class="swiper-slide">
                            <div class="cls_videoV01">

							<?php if ( $carousel['style'] == 'style1' ): ?>
								<?php if ( !empty($carousel['hosted_link']) ) : ?>
									<video class="hover-video" width="486" height="814" muted playsinline loop autoplay>
										<source src="<?php echo esc_attr($carousel['hosted_link']) ?>" type="video/mp4">
									</video>
								<?php else : ?>
									<p class="video-notice"><?php esc_html_e('Video URL is unavailable or not provided.', 'vemus-addon'); ?></p>
								<?php endif; ?>

							<?php elseif ( $carousel['style'] == 'style2' ): ?>
								<?php 
									$url = $carousel['ytb_link'];
									$embedUrl = convertToEmbed($url);
									if ($embedUrl) {
										echo '<iframe src="' . $embedUrl . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
									} else {
										echo "Invalid URL!";
									}
								?>

								<?php elseif ( $carousel['style'] == 'style3' ): ?>
									<?php if ( !empty($carousel['tiktok_link']) ) : ?>
										<div class="tiktok-wrapper">
											<blockquote class="tiktok-embed" cite="<?php echo esc_url($carousel['tiktok_link']); ?>" data-video-id="<?php echo esc_attr(basename(parse_url($carousel['tiktok_link'], PHP_URL_PATH))); ?>" style="width:100%; height:100%;">
												<section></section>
											</blockquote>
										</div>
										<script async src="https://www.tiktok.com/embed.js"></script>
									<?php else: ?>
										<p class="video-notice"><?php esc_html_e('TikTok URL is unavailable or not provided.', 'vemus-addon'); ?></p>
									<?php endif; ?>
								<?php endif; ?>

								<?php
                					$product = wc_get_product($carousel['product_id']);
                					if ($product): 
                				?>
									<div class="cls-content">
										<div class="box-product">
											<div class="img-product">
												<img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id(), 'vemus-video-small')); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
											</div>
											<div class="info-product">
												<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="name h5 fw-normal link text-white text-line-clamp-1">
													<?php echo esc_html($product->get_name()); ?>
												</a>
												<div class="price-wrap style-white">
													<?php echo wp_kses_post($product->get_price_html()); ?>
												</div>
											</div>
										</div>
										<a href="#quickView" data-bs-toggle="modal" class="tf-btn-icon style-circle style-small hover-tooltip" data-product_id="<?php echo esc_attr($carousel['product_id']); ?>">
                    						<span class="icon icon-view"></span>
                    						<span class="tooltip"><?php esc_html_e('Quick View', 'vemus-addon'); ?></span>
                						</a>
									</div>
								<?php endif; ?>
                            </div>
                        </div>
             			<?php endforeach;?>

                    </div>
                    <?php if ( $settings['bullet_enable'] == 'yes' ) : ?>
                    	<div class="sw-dot-default tf-sw-pagination"></div>
					<?php endif; ?>
                </div>
        </section>
        <!-- /Shop The Look -->


            <?php
        }


}