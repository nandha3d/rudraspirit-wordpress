<?php
/**
 * Elementor Vemus Product Highlight Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Vemus_Product_Highlight extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null) {
		parent::__construct( $data, $args );
    }

	/**
	 * Get widget name.
	 *
	 * Retrieve Vemus Product Highlight widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'vemus_product_highlight';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Vemus Product Highlight widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Vemus Product Highlight', 'vemus-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Vemus Product Highlight widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-products-archive';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Vemus Product Highlight widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'vemus_addons' ];
	}

	public function get_style_depends()
	{
		$style_depends = [
			'vemus-product-grid-style',
			'themesflat-swiper',
			'tf-magnific-popup'
		];
        return $style_depends;
    }

    public function get_script_depends()
	{	
        return [
			'themesflat-bootstrap',
			'vemus-product-highlight',
		];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Vemus Product Highlight widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['highlight-elementor-widget', 'highlight', 'tf-highlight', 'vemus-product-highlight' , 'vemus-highlight', 'tf', 'vemus'];
	}

	/**
	 * Get HTML wrapper class.
	 *
	 * Retrieve the widget container class. Can be used to override the
	 * container class for specific widgets.
	 *
	 * @since 2.0.9
	 * @access protected
	 */
	protected function get_html_wrapper_class() {
        return parent::get_html_wrapper_class() . ' elementor-vemus-widget-wrapper';
    }

	/**
	 * Register Vemus Product Highlight widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
		$this->start_controls_section( 'section_setting',
			[
				'label' => esc_html__('Vemus Product Highlight', 'vemus-addon'),
			]
		);

		// $this->add_control(
		// 	'image',
		// 	[
		// 		'label' => esc_html__( 'Image', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::MEDIA,
		// 		'default' => [
		// 			'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image-small.jpg",
		// 		],
		// 	]
		// );

        $repeater = new \Elementor\Repeater();

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

		$repeater->add_control(
			'video_url',
			[
				'label' => esc_html__( 'Video URL', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => esc_html__( 'https://www.youtube.com/watch?v=MLpWrANjFbI', 'vemus-addon' ),
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'show_external' => true,
			]
		);

		// $repeater->add_responsive_control(
		// 	'position_x',
		// 	[
		// 		'label' => esc_html__( 'Point Position X', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ '%','px' ],
		// 		'range' => [
		// 			'%' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 				'step' => 1,
		// 			],
		// 		],
		// 		'default' => [
		// 			'unit' => '%'
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} {{CURRENT_ITEM}}_position' => 'left: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $repeater->add_responsive_control(
		// 	'position_y',
		// 	[
		// 		'label' => esc_html__( 'Point Position Y', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ '%','px' ],
		// 		'range' => [
		// 			'%' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 				'step' => 1,
		// 			],
		// 		],
		// 		'default' => [
		// 			'unit' => '%'
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} {{CURRENT_ITEM}}_position' => 'bottom: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

		$this->add_control( 
            'carousel_list',
                [					
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                ]
        );

		$this->add_control(
			'heading-text',
			[
				'label' => esc_html__( 'Heading', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => '<span class="fst-italic">Highlight</span> Products',
			]
		);

		// $this->add_responsive_control(
		// 	'image_slides_height',
		// 	[
		// 		'label'     => esc_html__( 'Height', 'vemus-addon' ),
		// 		'type'      => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', '%', 'vh' ],
		// 		'range'     => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 1000,
		// 			],
		// 		],
		// 		'default' => [
		// 			'unit' => 'px',
		// 			'size' => 668,
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .banner-highlight > img' => 'height: {{SIZE}}{{UNIT}} !important;',
		// 		],
		// 		'separator'  => 'before',
		// 	]
		// );
            
		$this->end_controls_section();

		// Start Style
		// $this->start_controls_section( 
		// 	'section_title',
		// 	[
		// 		'label' => esc_html__( 'Banner', 'vemus-addon' ),
		// 		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// $this->add_control(
		// 	'image-position',
		// 	[
		// 		'label' => esc_html__( 'Banner Position', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::CHOOSE,
		// 		'default' => 'row',
		// 		'options' => [
		// 			'row-reverse' => [
		// 				'title' => esc_html__( 'Left', 'vemus-addon' ),
		// 				'icon' => "eicon-h-align-left",
		// 			],
		// 			'row' => [
		// 				'title' => esc_html__( 'Right', 'vemus-addon' ),
		// 				'icon' => "eicon-h-align-right",
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .flat-wrapper-highlight' => 'flex-direction: {{VALUE}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'highlight-style',
		// 	[
		// 		'type'        => \Elementor\Controls_Manager::SELECT,
		// 		'label'       => esc_html__( 'Style', 'vemus-addon' ),
		// 		'default'     => 'style-banner-right',
		// 		'options'     => [
		// 			'style-banner-left' => esc_html__( 'Banner left', 'vemus-addon' ),
		// 			'style-banner-right' => esc_html__( 'Banner right', 'vemus-addon' ),
		// 		],
		// 		'show_in_editor' => true,
		// 		'show_in_library' => true,
		// 	]
		// );

		// $this->end_controls_section();

		$this->start_controls_section( 
			'product_section',
			[
				'label' => esc_html__( 'Product Card', 'vemus-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_lb_title',
			[
				'label' => esc_html__( 'Highlight title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .s-title',
			]
		);

		$this->add_control(
			'heading_product_title',
			[
				'label' => esc_html__( 'Product name', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .card-product .name-product',
			]
		);

		$this->start_controls_tabs( 'product_name_styles_tab' );

		$this->start_controls_tab( 'product_name_style_normal', [ 'label' => esc_html__( 'Normal', 'vemus-addon' ) ] );

		$this->add_control(
			'product_name_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-product .name-product' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'product_name_style_hover', [ 'label' => esc_html__( 'Hover', 'vemus-addon' ) ] );

		$this->add_control(
			'product_name_color_hover',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-product .name-product:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_product_price',
			[
				'label' => esc_html__( 'Product price', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .card-product .tf-price, {{WRAPPER}} .card-product .tf-price bdi, {{WRAPPER}} .card-product .tf-price span, {{WRAPPER}} .card-product .tf-price ins, {{WRAPPER}} .card-product .tf-price del	',
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Regular price', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-price > .woocommerce-Price-amount' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-price span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-price del' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-price del span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-price .woocs_price_code > .woocommerce-Price-amount' => 'color: {{VALUE}}',
					'{{WRAPPER}} .price-old .woocommerce-Price-amount' => 'color: {{VALUE}}',
					'{{WRAPPER}} del .woocommerce-Price-amount' => 'color: {{VALUE}}',
					'{{WRAPPER}} del::after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_new_color',
			[
				'label' => esc_html__( 'Sale price', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-price .price-new .woocommerce-Price-amount' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-price ins .woocommerce-Price-amount' => 'color: {{VALUE}}',	
					'{{WRAPPER}} .tf-price ins' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-price ins span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_product_add_to_cart',
			[
				'label' => esc_html__( 'Add to cart button', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'add_to_cart__typography',
				'selector' => '{{WRAPPER}} .card-product .tf-btn',
			]
		);

		// $this->add_control(
		// 	'custom-container',
		// 	[
		// 		'label' => esc_html__( 'Custom container', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => esc_html__( 'Show', 'vemus-addon' ),
		// 		'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
		// 		'return_value' => 'yes',
		// 		'default' => '',
		// 	]
		// );

		// $this->add_control(
		// 	'heading_content',
		// 	[
		// 		'label' => esc_html__( 'Banner', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::HEADING,					
		// 		'separator' => 'before',
		// 	]
		// );

		// $this->add_responsive_control(
		// 	'image-col-width',
		// 	[
		// 		'label'     => esc_html__( 'Width', 'vemus-addon' ),
		// 		'type'      => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px','%','vh' ],
		// 		'range'     => [
		// 			'px' => [
		// 				'min' => 50,
		// 				'max' => 200,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .flat-wrapper-highlight .col-right' => 'width: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'content_border_radius',
		// 	[
		// 		'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .banner-highlight' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'heading_product',
		// 	[
		// 		'label' => esc_html__( 'Product', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::HEADING,					
		// 		'separator' => 'before',
		// 	]
		// );

		// $this->add_control(
		// 	'product_background',
		// 	[
		// 		'label' => esc_html__( 'Background', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product' => 'background-color: {{VALUE}};',
		// 		],
		// 	]
		// );	

		// $this->add_responsive_control( 
		// 	'product_padding',
		// 	[
		// 		'label' => esc_html__( 'Padding', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', 'em', '%' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'product_border_radius',
		// 	[
		// 		'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'heading_image_product',
		// 	[
		// 		'label' => esc_html__( 'Image', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::HEADING,					
		// 		'separator' => 'before',
		// 	]
		// );	

		// $this->add_responsive_control(
		// 	'image_product_width_size',
		// 	[
		// 		'label'     => esc_html__( 'Width & Height', 'vemus-addon' ),
		// 		'type'      => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px','%','vh' ],
		// 		'range'     => [
		// 			'px' => [
		// 				'min' => 50,
		// 				'max' => 200,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product .img-style' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; max-width: unset;',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'image_product_border_radius',
		// 	[
		// 		'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product .img-style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'heading_name',
		// 	[
		// 		'label' => esc_html__( 'Name', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::HEADING,					
		// 		'separator' => 'before',
		// 	]
		// );		

		// $this->add_group_control(
		// 	\Elementor\Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'name_typography',
		// 		'selector' => '{{WRAPPER}} .tf-highlight .loobook-product .name-product',
		// 	]
		// );

		// $this->add_control(
		// 	'name_color',
		// 	[
		// 		'label' => esc_html__( 'Color', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product .name-product' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );	

		// $this->add_responsive_control(
		// 	'name_margin',
		// 	[
		// 		'label'     => esc_html__( 'Spacing', 'vemus-addon' ),
		// 		'type'      => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px','%','vh' ],
		// 		'range'     => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 150,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product .wrap-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'heading_price',
		// 	[
		// 		'label' => esc_html__( 'Price', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::HEADING,					
		// 		'separator' => 'before',
		// 	]
		// );		

		// $this->add_group_control(
		// 	\Elementor\Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'price_typography',
		// 		'selector' => '{{WRAPPER}} .tf-highlight .loobook-product .price-wrap',
		// 	]
		// );

		// $this->add_control(
		// 	'price_color',
		// 	[
		// 		'label' => esc_html__( 'Sale Color', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product .price-wrap' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );	

		// $this->add_control(
		// 	'price_sale_color',
		// 	[
		// 		'label' => esc_html__( 'Regular Color', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product .price-wrap del' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'heading_button',
		// 	[
		// 		'label' => esc_html__( 'Button', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::HEADING,					
		// 		'separator' => 'before',
		// 	]
		// );	

		// $this->add_responsive_control(
		// 	'button_width_size',
		// 	[
		// 		'label'     => esc_html__( 'Width & Height', 'vemus-addon' ),
		// 		'type'      => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px','%','vh' ],
		// 		'range'     => [
		// 			'px' => [
		// 				'min' => 30,
		// 				'max' => 200,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product .tf_quickview_btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_responsive_control(
		// 	'button_size',
		// 	[
		// 		'label'     => esc_html__( 'Size', 'vemus-addon' ),
		// 		'type'      => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px','%','vh' ],
		// 		'range'     => [
		// 			'px' => [
		// 				'min' => 16,
		// 				'max' => 150,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product .tf_quickview_btn' => 'font-size: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'button_border_radius',
		// 	[
		// 		'label'      => __( 'Border Radius', 'vemus-addon' ),
		// 		'type'       => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'em' ],
		// 		'selectors'  => [
		// 			'{{WRAPPER}} .tf-highlight .loobook-product .tf_quickview_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		// 		],
		// 	]
		// );



		// $this->start_controls_tabs( 'button_styles_tab' );

		//     $this->start_controls_tab( 'button_default', [ 'label' => esc_html__( 'Default', 'vemus-addon' ) ] );

		// 	$this->add_control(
		// 		'button_color',
		// 		[
		// 			'label' => esc_html__( 'Color', 'vemus-addon' ),
		// 			'type' => \Elementor\Controls_Manager::COLOR,
		// 			'selectors' => [
		// 				'{{WRAPPER}} .tf-highlight .loobook-product .tf_quickview_btn' => 'color: {{VALUE}};',
		// 			],
		// 		]
		// 	);	
		
		// 	$this->add_control(
		// 		'button_background',
		// 		[
		// 			'label' => esc_html__( 'Background Color', 'vemus-addon' ),
		// 			'type' => \Elementor\Controls_Manager::COLOR,
		// 			'selectors' => [
		// 				'{{WRAPPER}} .tf-highlight .loobook-product .tf_quickview_btn' => 'background-color: {{VALUE}};',
		// 			],
		// 		]
		// 	);	

		//     $this->end_controls_tab();

		//     $this->start_controls_tab( 'button_hover', [ 'label' => esc_html__( 'Hover', 'vemus-addon' ) ] );

		// 	$this->add_control(
		// 		'button_color_hover',
		// 		[
		// 			'label' => esc_html__( 'Color', 'vemus-addon' ),
		// 			'type' => \Elementor\Controls_Manager::COLOR,
		// 			'selectors' => [
		// 				'{{WRAPPER}} .tf-highlight .loobook-product .tf_quickview_btn:hover' => 'color: {{VALUE}};',
		// 			],
		// 		]
		// 	);	
		
		// 	$this->add_control(
		// 		'button_background_hover',
		// 		[
		// 			'label' => esc_html__( 'Background Color', 'vemus-addon' ),
		// 			'type' => \Elementor\Controls_Manager::COLOR,
		// 			'selectors' => [
		// 				'{{WRAPPER}} .tf-highlight .loobook-product .tf_quickview_btn:hover' => 'background-color: {{VALUE}};',
		// 			],
		// 		]
		// 	);

		// 	$this->end_controls_tab();

		// 	$this->end_controls_tabs();
		
		$this->end_controls_section();
    
	}

	/**
	 * Render Vemus Product Highlight widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		// $style= !empty($settings['highlight-style']) ?  $settings['highlight-style'] : 'style-banner-right';
		// $classes = $style;

		// if( $style == 'style-banner-left' ){
		// 	$classes .= ' wrapper-highlight-1 type-2';
		// }

		$card_params = [
			'id' => '',
			'has_carousel' => '',
			'in_stock_text' => '',
			'show_out_stock' => '',
			'out_of_stock_text' => '',
			'out_of_stock_button_text' => '',
			'show_brand' => '',
			'button_text' => 'Add to cart',
			'show_rating' => true,
			'show_on_hover' => '',
			'center_on_image' => '',
			'arrow_style' => '',
			'arrow_position' => '',
			'countdown_style' => '',
			'show_progress_sale' => '',
			'show_sold_count' => '',
		];
	?>

	<section class="flat-spacing-3 pt-0">
		<div class="container">
			<div class="sect-border">
				<div class="sect-head wow fadeInUp">
					<h2 class="s-title font-2 text-capitalize">
						<?php echo wp_kses_post(empty($settings['heading-text']) ? '' : $settings['heading-text']); ?>
					</h2>
				</div>
				<div dir="ltr" class="swiper tf-swiper vemus-default-swiper wow fadeInUp" data-preview="3" data-tablet="2"
					data-mobile-sm="2" data-mobile="1" data-space-lg="80" data-space-md="30" data-space="15"
					data-pagination="1" data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="3">
					<div class="swiper-wrapper">
					<?php foreach ($settings['carousel_list'] as $carousel) :
						global $product;
						$product = wc_get_product($carousel['product_id']);
						$video_url= !empty($carousel['video_url']) ?  $carousel['video_url'] : '';
						$card_params['video_url'] = $video_url;
					?>
						<?php if($product) : ?>
							<div class="swiper-slide">
								<?php
									wc_get_template(
										'content-product-highlight.php',	
										$card_params,
										TF_PLUGIN_PATH . 'includes/elementor-widget/templates/product/',
										TF_PLUGIN_PATH . 'includes/elementor-widget/templates/product/',
									);
								?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
					</div>
					<div class="sw-dot-default tf-sw-pagination"></div>
				</div>
			</div>
		</div>
	</section>

	<?php
	}
 
 }