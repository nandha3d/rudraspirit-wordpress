<?php
/**
 * Elementor Vemus Product Category List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Vemus_Product_Category_List extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null) {
		parent::__construct( $data, $args );
    }

	/**
	 * Get widget name.
	 *
	 * Retrieve Vemus Product Category List widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'vemus_product_category_list';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Vemus Product Category List widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Vemus Product Category List', 'vemus-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Vemus Product Category List widget icon.
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
	 * Retrieve the list of categories the Vemus Product Category List widget belongs to.
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
		// $settings = $this->get_settings_for_display();
		// $button_icon = !empty($settings['button-icon']) ? $settings['button-icon'] : [];
		$style_depends = [
			'vemus-product-grid-style',
			'themesflat-swiper',
		];
		// if( !empty($button_icon['value ']) && !empty($button_icon['value']['url']) ){
			// $style_depends[] = 'elementor-icons-fa-solid';
		// }
        return $style_depends;
    }

    public function get_script_depends()
	{	
        return [
			'themesflat-bootstrap',
			'vemus-product-category-list',
		];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Vemus Product Category List widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['product-category-elementor-widget', 'product-category', 'tf-product-category', 'product-category', 'vemus-product-category' , 'product', 'category' , 'tf', 'vemus'];
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
	 * Register Vemus Product Category List widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls(): void
	{
		global $tfwc_widget_settings;

		$control_settings = empty($tfwc_widget_settings['control-settings']) ? [] : $tfwc_widget_settings['control-settings'];

		$this->start_controls_section(
			'section_categories',
			[
				'label' => esc_html__('Categories', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'list-style',
			empty($control_settings['list-style']) ?  [
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'List Style', 'vemus-addon' ),
				'default'     => 'style-1',
				'options'     => [
					'style-1' => esc_html__( 'Style 1', 'vemus-addon' ),
					'style-2' => esc_html__( 'Style 2', 'vemus-addon' ),
				],
				'show_in_editor' => true,
				'show_in_library' => true,
			] : $control_settings['list-style']
		);

		$this->add_control(
			'data-source',
			[
				'label' => esc_html__( 'Data Source', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default'   => esc_html__('Default', 'vemus-addon'),
					'custom'      => esc_html__('Custom', 'vemus-addon'),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'num-category',
			[
				'label' => esc_html__( 'Number Category', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 6,
				'min' => 1,
				'step' => 1,
				'condition' => [
					'data-source' => 'default'
				]
			],
		);

		$this->add_control(
			'order-by',
			[
				'label' => esc_html__( 'Order By', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default'   => esc_html__('Default', 'vemus-addon'),
					'date'      => esc_html__('Date', 'vemus-addon'),
					'title'     => esc_html__('Title', 'vemus-addon'),
					'count'     => esc_html__('Count product', 'vemus-addon'),
					'menu-order'     => esc_html__('Menu order', 'vemus-addon'),
				],
				'default' => 'default',
				'condition' => [
					'data-source' => 'default'
				]
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'asc'     => esc_html__('ASC', 'vemus-addon'),
					'desc'    => esc_html__('DESC', 'vemus-addon'),
				],
				'default' => 'asc',
				'condition' => [
					'data-source' => 'default'
				]
			]
		);

		$this->add_control(
			'category-items',
			[
				'label' => esc_html__( 'Category Items', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'image',
						'label' => esc_html__( 'Choose Image', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							// 'url' => \Elementor\Utils::get_placeholder_image_src(),
							'url' => ''
						],
					],
					[
						'name' => 'product_category',
						'label' => esc_html__( 'Product Category', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'label_block' => true,
						'multiple' => false,
						'options' => TFWC_Elementor_Widget_Addon::get_product_categories(),
						'default' => '',
					],
				],
				'default' => [
					[
						// 'title' => esc_html__( 'Category Item #1', 'vemus-addon' ),
						'image' => [
							'url' => ''
						],
						'product_category' => '',
					],
					[
						// 'title' => esc_html__( 'Category Item #2', 'vemus-addon' ),
						'image' => [
							'url' => ''
						],
						'product_category' => '',
					],
				],
				// 'title_field' => '{{{ get_category_titles(product-category) }}}',
				// 'title_field' => $this->get_category_name_by_id('{{product_category}}'),
				'condition' => [
					'data-source' => 'custom'
				]
			]
		);

		$this->end_controls_section();

		// $this->start_controls_section(
		// 	'section_button',
		// 	[
		// 		'label' => esc_html__('Content', 'vemus-addon'),
		// 		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		// 	]
		// );

		// $this->add_control(
		// 	'number-count',
		// 	[
		// 		'label' => esc_html__( 'Number count', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => esc_html__( 'ON', 'vemus-addon' ),
		// 		'label_off' => esc_html__( 'OFF', 'vemus-addon' ),
		// 		'return_value' => 'yes',
		// 		'default' => '',
		// 	]
		// );

		// $this->add_control(
		// 	'image-category',
		// 	[
		// 		'label' => esc_html__( 'Image', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'options' => [
		// 			'square'   => esc_html__('Square', 'vemus-addon'),
		// 			'circle'      => esc_html__('Circle', 'vemus-addon'),
		// 			'verticle'     => esc_html__('Verticle', 'vemus-addon'),
		// 			'custom-ratio'     => esc_html__('Custom ratio', 'vemus-addon'),
		// 		],
		// 		'default' => 'square',
		// 	]
		// );

		// $this->add_control(
		// 	'aspect-ratio',
		// 	[
		// 		'label' => esc_html__( 'Aspect Ratio (Eg : 3/4)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		'default' => '3/4',
		// 		'condition' => [
		// 			'image-category' => 'custom-ratio'
		// 		]
		// 	]
		// );

		// $this->add_control(
		// 	'show-button',
		// 	[
		// 		'label' => esc_html__( 'Show button', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'options' => [
		// 			''   => esc_html__('None', 'vemus-addon'),
		// 			'show-on-hover'      => esc_html__('Show on Hover', 'vemus-addon'),
		// 			'always'     => esc_html__('Always ', 'vemus-addon'),
		// 		],
		// 		'default' => '',
		// 	]
		// );

		// $this->add_control(
		// 	'button-icon',
		// 	[
		// 		'label' => esc_html__( 'Icon', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::ICONS,
		// 		'fa4compatibility' => 'icon',
		// 		'skin' => 'inline',
		// 		'label_block' => false,
		// 		'default' => [
		// 			'value' => 'icon-arrow1-top-left',
		// 			'library' => 'vemus-icon',
		// 		],
		// 		'condition' => [
		// 			'show-button!' => ''
		// 		]
		// 	]
		// );

		// $this->end_controls_section();

		$this->start_controls_section(
			'category_list_style_section',
			[
				'label' => esc_html__('Categories', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title-alignment',
			[
				'label' => esc_html__( 'Alignment', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'vemus-addon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'vemus-addon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'vemus-addon' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .cate-item' => 'justify-content: {{VALUE}} !important;',
					'{{WRAPPER}} a.tab-link' => 'justify-content: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title-typography',
				'selectors' => [
					'selector' => '{{WRAPPER}} .name-cate',
					'selector' => '{{WRAPPER}} a.tab-link',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Vemus Product Category List widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function render(): void
	{
		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		$has_carousel = !empty($settings['carousel']) ? $settings['carousel'] : false;
		$title_position = !empty($settings['title-position']) ? $settings['title-position'] : 'default';
		$image_category = !empty($settings['image-category']) ? $settings['image-category'] : 'square';
		$show_button = !empty($settings['show-button']) ? $settings['show-button'] : false;
		$button_text = !empty($settings['button-text']) ? $settings['button-text'] : 'Shop Now';
		$button_icon = !empty($settings['button-icon']) ? $settings['button-icon'] : [];
		$number_count = !empty($settings['number-count']) ? $settings['number-count'] : false;
		$has_carousel = !empty($settings['carousel']) ? $settings['carousel'] : false;
		$show_on_hover = !empty($settings['show-on-over']) ? $settings['show-on-over'] : false;
		$center_on_image = !empty($settings['center-on-image']) ? $settings['center-on-image'] : false;
		$arrow_position = !empty($settings['arrow-position']) ? $settings['arrow-position'] : 'outside';
		$style = !empty($settings['list-style']) ? $settings['list-style'] : 'style-1';

		$product_category_classes = '';
		$carousel_configs = '{}';

		$box_classes = 'wg-cls hover-img';

		if($show_button == 'show-on-hover'){
			$box_classes .= ' show-on-hover';
		}

		if( empty($show_button) ){
			$box_classes .= ' button-hidden';
		}

		if( $title_position == 'absolute'){
			$box_classes .= ' style-abs';
		}

		if( $has_carousel ){
			$product_category_classes .= " swiper-wrapper";
			$carousel_configs = TFWC_Elementor_Widget_Addon::get_carousel_configs($this);
		}else{
			$product_category_classes .= " tf-grid-layout tf-col-2 md-col-4 xl-col-6";
		}

		$aspect_ratio = '1';

		switch ($image_category) {
			case 'circle':
				$box_classes .= ' circle-box';
				break;
			case 'verticle':
				$aspect_ratio = '3/4';
				break;
			case 'custom-ratio':
				$aspect_ratio = TFWC_Elementor_Widget_Addon::convertToAspectRatio(trim($settings['aspect-ratio']));
				break;
		}

		$card_params = [
			'id' => $widget_id,
			'box_classes' => $box_classes,
			'aspect_ratio' => $aspect_ratio,
			'button_text' => $button_text,
			'button_icon' => $button_icon,
			'has_carousel' => $has_carousel,
			'number_count' => $number_count,
			'show_on_hover' => $show_on_hover,
			'center_on_image' => $center_on_image,
			'arrow_position' => $arrow_position,
		];
		
		$data_source = $settings['data-source'];
		$category_items = $settings['category-items'];

		$arrow_control_classes = 'has-arrow-control';
		if( !empty($card_params['arrow_position']) ){
			switch ($card_params['arrow_position']) {
				case 'outside':
					$arrow_control_classes .= ' fl-control-sw2';
					break;
				case 'middle':
					$arrow_control_classes .= ' fl-control-sw';
					break;
				default:
					$arrow_control_classes .= '';
					break;
			}
		}
		if( !empty($card_params['show_on_hover']) ){
			$arrow_control_classes .= ' hover-sw-nav hover-sw-2';
		}

		if( !empty($card_params['center_on_image']) ){
			$arrow_control_classes .= ' arrow-center-on-image';
		}
		
		if(  $data_source == "custom" ){

			$category_ids = [];
			foreach( $category_items as $key => $item){
				if( empty($item['product_category']) ){
					continue;
				}
				$category_ids[] = $item['product_category'];
			}

			$args = [
				'taxonomy' => 'product_cat',
				'hide_empty' => false,
				// 'number' => -1,
				'get_image' => true,
				'include' => $category_ids
			];
			if( empty($category_ids) ){
				echo ( TFWC_Elementor_Widget_Addon::get_product_category_content([]) );
				return;
			}

			$categories = TFWC_Elementor_Widget_Addon::get_product_categories($args);
			
			foreach( $category_items as $key => $item){
				$id = $item['product_category'];
				if( !empty($item['image']['url']) ){
					$categories[$id]['image'] = $item['image']['url'];
				}
			}

			$sorted_categories = [];
			foreach ($category_ids as $key) {
				if( empty($categories[$key]) ){
					continue;
				}
				$sorted_categories[] = $categories[$key];
			}
			wc_get_template(
				'category-list-' . $style .'.php',	
				[
					"categories" => $sorted_categories
				],
				TF_PLUGIN_PATH . 'includes/elementor-widget/templates/category-list/',
				TF_PLUGIN_PATH . 'includes/elementor-widget/templates/category-list/',
			);
			return;
		}

		$num_category = !empty($settings['num-category']) ? $settings['num-category'] : -1;
		
		$order_by = !empty($settings['order-by']) ? $settings['order-by'] : 'default';
		$order = !empty($settings['order']) ? $settings['order'] : 'asc';

		$args = [
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
			'number' => $num_category,
			'order' => $order,
			'get_image' => true
		];

		if ($order_by !== 'default') {
			switch ($order_by) {
				case 'date':
					$args['orderby'] = 'term_id';
					break;
				case 'title':
					$args['orderby'] = 'name';
					break;
				case 'count':
					$args['orderby'] = 'count';
					break;
				case 'menu-order':
					$args['orderby'] = 'menu_order';
					break;
			}
		}

		$categories = TFWC_Elementor_Widget_Addon::get_product_categories($args);

		wc_get_template(
			'category-list-' . $style .'.php',
			[
				"categories" => $categories,
				"widget_id" => $widget_id,
			],
			TF_PLUGIN_PATH . 'includes/elementor-widget/templates/category-list/',
			TF_PLUGIN_PATH . 'includes/elementor-widget/templates/category-list/',
		);
		return;
	}

	public function get_category_name_by_id($cat_id){
		$term = get_term($cat_id, 'product_cat');
		if (!is_wp_error($term) && $term) {
			return $term->name;
		} else {
			return "Category Item";
		}
	}

}