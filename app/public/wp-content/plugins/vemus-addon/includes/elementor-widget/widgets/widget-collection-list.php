<?php

class Vemus_Collection_List extends \Elementor\Widget_Base {

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
		return 'vemus_collection_list';
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
		return esc_html__( 'Vemus Collection Box', 'vemus-addon' );
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
		return 'eicon-navigation-horizontal';
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
	                'label' => esc_html__('Vemus Collection List', 'vemus-addon'),
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
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__('Collection Title', 'vemus-addon'),
				]
			);

			$repeater->add_control(
				'desc',
				[
					'label' => esc_html__('Description', 'vemus-addon'),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__('Collection description here...', 'vemus-addon'),
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
						'is_external' => true,
					],
				]
			);

			$repeater->add_control(
				'btn_text',
				[
					'label' => esc_html__('Button Text', 'vemus-addon'),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__('Shop Now', 'vemus-addon'),
				]
			);

			$this->add_control(
				'collections',
				[
					'label' => esc_html__('Collections', 'vemus-addon'),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'title' => esc_html__( 'Modern Luxe', 'vemus-addon' ),
							'desc' => esc_html__( 'Chic and contemporary pieces for the trendsetters of today', 'vemus-addon' ),
							'btn_text' => esc_html__( 'Shop Now', 'vemus-addon' ),
						],
						[
							'title' => esc_html__( 'Modern Luxe', 'vemus-addon' ),
							'desc' => esc_html__( 'Chic and contemporary pieces for the trendsetters of today', 'vemus-addon' ),
							'btn_text' => esc_html__( 'Shop Now', 'vemus-addon' ),
						],
						[
							'title' => esc_html__( 'Modern Luxe', 'vemus-addon' ),
							'desc' => esc_html__( 'Chic and contemporary pieces for the trendsetters of today', 'vemus-addon' ),
							'btn_text' => esc_html__( 'Shop Now', 'vemus-addon' ),
						],
                        						[
							'title' => esc_html__( 'Modern Luxe', 'vemus-addon' ),
							'desc' => esc_html__( 'Chic and contemporary pieces for the trendsetters of today', 'vemus-addon' ),
							'btn_text' => esc_html__( 'Shop Now', 'vemus-addon' ),
						],
					],
					'title_field' => '{{{ title }}}',
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
				'default' => 3,
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
				'default' => 3,
				'condition' => [
				    'carousel' => 'yes',
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


        $this->end_controls_section();

			$this->start_controls_section(
				'section_content',
				[
					'label' => __( 'Style', 'vemus-addon' ),
                	'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			// --- Title Style Heading ---
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
					'selector' => '{{WRAPPER}} .widget-collection-list .title a',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Title Color', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .widget-collection-list .title a' => 'color: {{VALUE}} !important;',
					],
				]
			);

			// --- Description Style Heading ---
			$this->add_control(
				'heading_desc_style',
				[
					'label' => __( 'Description Style', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .widget-collection-list .promo-circle .sub-title',
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label' => __( 'Description Color', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .widget-collection-list .promo-circle .sub-title' => 'color: {{VALUE}} !important;',
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
					'selector' => '{{WRAPPER}} .widget-collection-list .tf-btn',
				]
			);

			$this->add_control(
				'button_color',
				[
					'label' => __( 'Button Color', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .widget-collection-list .tf-btn' => 'color: {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'button_hover_color',
				[
					'label' => __( 'Button Hover Color', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .widget-collection-list .tf-btn:hover' => 'color: {{VALUE}} !important;',
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

	$slides_per_view_xs = !empty($settings['slidesPerView-xs']) ? $settings['slidesPerView-xs'] : 1;
	$slides_per_view_sm = !empty($settings['slidesPerView-sm']) ? $settings['slidesPerView-sm'] : 2;
	$slides_per_view_md = !empty($settings['slidesPerView-md']) ? $settings['slidesPerView-md'] : 3;
	$slides_per_view_xl = !empty($settings['slidesPerView-xl']) ? $settings['slidesPerView-xl'] : 3;
	
	$slides_per_group_xs = !empty($settings['slidesPerGroup-xs']) ? $settings['slidesPerGroup-xs'] : 21;
	$slides_per_group_sm = !empty($settings['slidesPerGroup-sm']) ? $settings['slidesPerGroup-sm'] : 2;
	$slides_per_group_md = !empty($settings['slidesPerGroup-md']) ? $settings['slidesPerGroup-md'] : 3;
	$slides_per_group_xl = !empty($settings['slidesPerGroup-xl']) ? $settings['slidesPerGroup-xl'] : 3;
    $space_between_mobile = !empty($settings['spacing_mobile']) ? $settings['spacing_mobile'] : 0;
    $space_between_tablet = !empty($settings['spacing_tablet']) ? $settings['spacing_tablet'] : 0;
    $space_between_desktop = !empty($settings['spacing']) ? $settings['spacing'] : 0;
    ?>

		<div class="flat-spacing-3 pb-0 widget-collection-list">


			<div class="container">
				<div dir="ltr" class="swiper tf-swiper tfc-swiper wow fadeInUp" data-preview="<?php echo esc_attr($slides_per_view_xl); ?>" data-tablet="<?php echo esc_attr($slides_per_view_md); ?>" data-mobile-sm="<?php echo esc_attr($slides_per_view_sm); ?>" data-mobile="<?php echo esc_attr($slides_per_view_xs); ?>" data-space-lg="<?php echo esc_attr($space_between_desktop); ?>"
                    data-space-md="<?php echo esc_attr($space_between_tablet); ?>" data-space="<?php echo esc_attr($space_between_mobile); ?>" data-pagination="<?php echo esc_attr($slides_per_group_xs); ?>" data-pagination-sm="<?php echo esc_attr($slides_per_group_sm); ?>" data-pagination-md="<?php echo esc_attr($slides_per_group_md); ?>" data-pagination-lg="<?php echo esc_attr($slides_per_group_xl); ?>">
					<div class="swiper-wrapper">
						<?php foreach ( $settings['collections'] as $item ): 
							$link_url = !empty($item['link']['url']) ? $item['link']['url'] : '#';
							$target   = $item['link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
							$image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src(
								$item['image']['id'],
								'image_size',
								$settings
							);
						?>
							<div class="swiper-slide">
								<div class="promo-circle hover-img">
									<div class="image img-style">
										<?php if ( $image_url ) : ?>
											<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg"; ?>" alt="Image">
                                        <?php endif; ?>
									</div>
									<h3 class="title">
										<a href="<?php echo esc_url($link_url); ?>" class="text-primary-3" <?php echo $target . $nofollow; ?>>
											<?php echo esc_html($item['title']); ?>
										</a>
									</h3>
									<p class="sub-title font-4 letter-space-0">
										<?php echo esc_html($item['desc']); ?>
									</p>
									<a href="<?php echo esc_url($link_url); ?>" class="tf-btn type-large border-0 fw-medium" <?php echo $target . $nofollow; ?>>
										<?php echo esc_html($item['btn_text']); ?>
										<i class="icon icon-arrow-top-right-2"></i>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="sw-dot-default tf-sw-pagination"></div>
	
				</div>
			</div>
		</div>


            <?php
        }


}