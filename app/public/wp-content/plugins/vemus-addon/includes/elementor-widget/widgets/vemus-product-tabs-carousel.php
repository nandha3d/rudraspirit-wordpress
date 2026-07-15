<?php
/**
 * Elementor Vemus Product Tab Carousel Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Vemus_Product_Tabs_Carousel extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null) {
		parent::__construct( $data, $args );
    }

	/**
	 * Get widget name.
	 *
	 * Retrieve Vemus Product Tab Carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'vemus_product_tabs_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Vemus Product Tab Carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Vemus Product Tab Carousel', 'vemus-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Vemus Product Tab Carousel widget icon.
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
	 * Retrieve the list of categories the Vemus Product Tab Carousel widget belongs to.
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
        return [
			// 'vemus-product-fonts-style',
			// 'vemus-product-font-icons-style',
			// 'themesflat-bootstrap',
			// 'vemus-product-tabs-carousel-style',
			'vemus-product-grid',
			'themesflat-swiper',
		];
    }

    public function get_script_depends()
	{	
        return [
			'themesflat-bootstrap',
			// 'vemus-nouislider-script',
			// 'vemus-wow-script',
			// 'vemus-product-tabs-carousel-script',
			'vemus-product-grid',
		];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Vemus Product Tab Carousel widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['product-tabs-carousel-elementor-widget', 'product-tabs-carousel', 'tf-product-tabs', 'product-tabs', 'vemus-product-tabs' , 'product', 'tab' , 'tf', 'vemus'];
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
	 * Register Vemus Product Tab Carousel widget controls.
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
			'section_products',
			[
				'label' => esc_html__('Contents', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'product-columns',
			empty($control_settings['product-columns']) ? [
				'label' => esc_html__('Columns', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'default' => 4,
				'tablet_default' => 3,
				'mobile_default' => 2,
				'options' => [
					'1' => esc_html__('1', 'vemus-addon'),
					'2' => esc_html__('2', 'vemus-addon'),
					'3' => esc_html__('3', 'vemus-addon'),
					'4' => esc_html__('4', 'vemus-addon'),
					'5' => esc_html__('5', 'vemus-addon'),
					'6' => esc_html__('6', 'vemus-addon'),
				],
				'selectors' => [
					'{{WRAPPER}} .tf-grid-layout' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			] : $control_settings['product-columns']
		);

		$this->add_control(
			'product-style',
			empty($control_settings['product-style']) ?  [
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Product Style', 'vemus-addon' ),
				'default'     => 'style-1',
				'options'     => [
					'style-1' => esc_html__( 'Style 1', 'vemus-addon' ),
					// 'style-2' => esc_html__( 'Style 2', 'vemus-addon' ),
					// 'style-3' => esc_html__( 'Style 3', 'vemus-addon' ),
					// 'style-4' => esc_html__( 'Style 4', 'vemus-addon' ),
					// 'style-5' => esc_html__( 'Style 5', 'vemus-addon' ),
					// 'style-6' => esc_html__( 'Style 6', 'vemus-addon' ),
				],
				'show_in_editor' => true,
				'show_in_library' => true,
			] : $control_settings['product-style']
		);

		$this->add_control(
			'num-products',
			empty($control_settings['num-products']) ?  [
				'label' => esc_html__( 'Number Products', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4,
				'min' => 1,
				'step' => 1,
			] : $control_settings['num-products']
		);

		$this->add_control(
			'tab-style',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Tab Style', 'vemus-addon' ),
				'default'     => 'default',
				'options'     => [
					'default' => esc_html__( 'Default', 'vemus-addon' ),
					'title' => esc_html__( 'Tab with Title', 'vemus-addon' ),
				],
			]
		);

		$this->add_control(
			'tab-title',
			[
				'label' => esc_html__( 'Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Best Sellers',
				'condition' => [
					'tab-style' => 'title',
				]
			]
		);

		$this->add_control(
			'tab-description',
			[
				'label' => esc_html__( 'Description', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => "",
				'condition' => [
					'tab-style' => 'title',
				]
			]
		);

		// $this->add_control(
		// 	'tab-heading-style',
		// 	[
		// 		'type'        => \Elementor\Controls_Manager::SELECT,
		// 		'label'       => esc_html__( 'Tab Heading Style', 'vemus-addon' ),
		// 		'default'     => 'default',
		// 		'options'     => [
		// 			'default' => esc_html__( 'Default', 'vemus-addon' ),
		// 			'label' => esc_html__( 'Label', 'vemus-addon' ),
		// 		],
		// 	]
		// );

		$this->add_control(
			'tab-items',
			[
				'label' => esc_html__( 'Tab Items', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Tab Item', 'vemus-addon' ),
						'default' => esc_html__( 'Tab Item', 'vemus-addon' ),
					],
					array_merge(
						[
							'name' => 'product-type',
						],
						empty($control_settings['product-type']) ? [
							'type'        => \Elementor\Controls_Manager::SELECT,
							'label'       => esc_html__( 'Product Type', 'vemus-addon' ),
							'default'     => 'recent-products',
							'options'     => [
								'recent-products' => esc_html__('Recent Products', 'vemus-addon'),
								'featured-products' => esc_html__('Featured Products', 'vemus-addon'),
								'sale-products' => esc_html__('Sale Products', 'vemus-addon'),
								'best-seller' => esc_html__('Best Seller', 'vemus-addon'),
								'top-rated' => esc_html__('Top Rated Products', 'vemus-addon'),
								'custom-products' => esc_html__('Custom Products', 'vemus-addon'),
							],
						] : $control_settings['product-type']
					),
					[
						'name' => 'product-category',
						'label' => esc_html__( 'Product Category', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'label_block' => true,
						'multiple' => true,
						'options' => TFWC_Elementor_Widget_Addon::get_product_categories(),
						'default' => [],
						'condition' => [
							'product-type!' => 'custom-products'
						]
					],
					[
						'name' => 'product-brand',
						'label' => esc_html__( 'Product Brand', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'label_block' => true,
						'multiple' => true,
						'options' => TFWC_Elementor_Widget_Addon::get_product_brands(),
						'default' => [],
						'condition' => [
							'product-type!' => 'custom-products'
						]
					],
					[
						'name' => 'product-tag',
						'label' => esc_html__( 'Product Tag', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'label_block' => true,
						'multiple' => true,
						'options' => TFWC_Elementor_Widget_Addon::get_product_tags(),
						'default' => [],
						'condition' => [
							'product-type!' => 'custom-products'
						]
					],
					[
						'name' => 'product-id',
						'label' => esc_html__( 'Product ID ( Custom product )', 'vemus-addon' ),
						'type' => 'tfwc_select2',
						'label_block' => true,
						'multiple' => true,
						'options' => [],
						'default' => [],
						'ajax' => true,
						'ajax_action' => 'tfwc_select2_options',
						'condition' => [
							'product-type' => 'custom-products'
						]
					],
					[
						'name' => 'order-by',
						'label' => esc_html__( 'Order By', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => [
							'default'   => esc_html__('Default', 'vemus-addon'),
							'date'      => esc_html__('Date', 'vemus-addon'),
							'id'        => esc_html__('Product ID', 'vemus-addon'),
							'title'     => esc_html__('Product Title', 'vemus-addon'),
							'price'     => esc_html__('Price', 'vemus-addon'),
							'rating'    => esc_html__('Rating', 'vemus-addon'),
							'sales'     => esc_html__('Popularity (Sales)', 'vemus-addon'),
							'random'    => esc_html__('Random', 'vemus-addon'),
						],
						'default' => 'default',
						'condition' => [
							'product-type!' => 'custom-products'
						]
					],		
					[
						'name' => 'order',
						'label' => esc_html__( 'Order', 'vemus-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => [
							'asc'     => esc_html__('Ascending', 'vemus-addon'),
							'desc'    => esc_html__('Descending', 'vemus-addon'),
						],
						'default' => 'asc',
						'condition' => [
							'product-type!' => 'custom-products'
						]
					]
			
				],
				'default' => [
					[
						'title' => esc_html__( 'Tab Item #1', 'vemus-addon' ),
						'product-type' => 'recent-products',
						'product-category' => [],
						'product-brand' => [],
                        'product-tag' => [],
                        'product-id' => [],
						'order-by' => 'default',
						'order' => 'asc'
					],
					[
						'title' => esc_html__( 'Tab Item #2', 'vemus-addon' ),
						'product-type' => 'featured-products',
						'product-category' => [],
						'product-brand' => [],
                        'product-tag' => [],
                        'product-id' => [],
						'order-by' => 'default',
						'order' => 'asc'
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		TFWC_Elementor_Widget_Addon::register_additional_controls($this);

		$this->end_controls_section();

		TFWC_Elementor_Widget_Addon::register_carousel_controls($this);

		TFWC_Elementor_Widget_Addon::register_tab_style_controls($this);

		TFWC_Elementor_Widget_Addon::register_product_style_controls($this);
	}

	/**
	 * Render Vemus Product Tab Carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function render(): void
	{
		$settings = $this->get_settings_for_display();
		$num_product = !empty($settings['num-products']) ? $settings['num-products'] : 1;

		$args = [
			'post_type'      => 'product',
			'status' => 'published',
			'post_status'    => 'publish',
			'posts_per_page' => $num_product,
		];

		// echo wp_sprintf( $this->get_tab_items($args) );
		echo ( $this->get_tab_items($args) );

	}

	public function get_tab_items($args){
		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();
		
		$tab_classes = "tab-content";
		$product_grid_classes = "wrapper-shop tf-col-2 md-col-3 xl-col-4";
		$product_style= !empty($settings['product-style']) ?  $settings['product-style'] : 'style-1';

		$tab_heading_style= !empty($settings['tab-heading-style']) ?  $settings['tab-heading-style'] : 'default';

		$show_rating = !empty($settings['show-rating']) ? $settings['show-rating'] : '';
		$in_stock_text = !empty($settings['in-stock-text']) ? $settings['in-stock-text'] : '';
		$show_out_stock = !empty($settings['out-of-stock']) ? $settings['out-of-stock'] : false;
		$out_of_stock_text = !empty($settings['out-of-stock-text']) ? $settings['out-of-stock-text'] : '';
		$out_of_stock_button_text = !empty($settings['out-of-stock-button-text']) ? $settings['out-of-stock-button-text'] : '';
		$show_brand = !empty($settings['brand']) ? $settings['brand'] : false;
		$has_carousel = !empty($settings['carousel']) ? $settings['carousel'] : '';
		$has_add_to_cart_btn = !empty($settings['add-to-cart']) ? $settings['add-to-cart'] : false;
		$button_text = !empty($settings['button-text']) ? $settings['button-text'] : 'Add to cart';
		$button_icon = !empty($settings['button-icon']) ? $settings['button-icon'] : false;
		$arrow_top = !empty($settings['arrow-top']) ? $settings['arrow-top'] : false;
		$show_on_hover = !empty($settings['show-on-over']) ? $settings['show-on-over'] : false;
		$tab_alignment = !empty($settings['tab-alignment']) ? $settings['tab-alignment'] : '';
		$center_on_image = !empty($settings['center-on-image']) ? $settings['center-on-image'] : false;
		$arrow_position = !empty($settings['arrow-position']) ? $settings['arrow-position'] : 'outside';
		$countdown_style = !empty($settings['countdown-box-style']) ? $settings['countdown-box-style'] : 'style-1';
		$show_progress_sale = !empty($settings['show-progress-sale']) ? $settings['show-progress-sale'] : false;
		$show_sold_count = !empty($settings['show-sold-count']) ? $settings['show-sold-count'] : false;

		$card_params = [
			'id' => $widget_id,
			'has_carousel' => $has_carousel,
			'in_stock_text' => $in_stock_text,
			'show_out_stock' => $show_out_stock,
			'out_of_stock_text' => $out_of_stock_text,
			'out_of_stock_button_text' => $out_of_stock_button_text,
			'show_brand' => $show_brand,
			'show_rating' => $show_rating,
			'button_text' => $button_text,
			'arrow_top' => $arrow_top,
			'show_on_hover' => $show_on_hover,
			'center_on_image' => $center_on_image,
			'arrow_position' => $arrow_position,
			'countdown_style' => $countdown_style,
			'show_progress_sale' => $show_progress_sale,
			'show_sold_count' => $show_sold_count,
			'aspect_ratio' => empty($settings['aspect-ratio']) ? '' : TFWC_Elementor_Widget_Addon::convertToAspectRatio(trim($settings['aspect-ratio']))
		];

		if($has_add_to_cart_btn && $button_icon){
			$card_params['button_icon'] = $button_icon;
		}else{
			$product_grid_classes .= ' add-to-cart-hidden';
		}

		$carousel_configs = '{}';

		if( $has_carousel ){
			$product_grid_classes .= " swiper-wrapper";
			if( $tab_alignment == 'end' ){
				$tab_classes .= ' box-nav-left';
			}
			// $carousel_configs = TFWC_Elementor_Widget_Addon::get_carousel_configs($this);
		}else{
			$product_grid_classes .= " tf-grid-layout";
		}

		$tab_items = !empty($settings['tab-items']) ? $settings['tab-items'] : [];
		
		ob_start();
		$tab_title = $this->get_tabs_title();
		$tab_heading = '';
		$tab_content = '';

		foreach( $tab_items as $index => $tab_item ){
			$tab_heading .= $this->get_tab_heading( $index == 0, $tab_item['_id'], $tab_item['title'], $tab_heading_style );	
			if( $has_carousel ){
				$carousel_configs = TFWC_Elementor_Widget_Addon::get_carousel_configs($this,$tab_item['_id']);
			}
			$tab_content .= $this->get_tab_content( $index == 0, $tab_item['_id'], $tab_item, $args, $product_style, $product_grid_classes, $carousel_configs, $card_params );
		}

		?>
		<div class="tf-flat-spacing-3 flat-animate-tab product-tablist <?php echo empty($arrow_top) ? '' : 'flat-controltab-nav' ; ?>">
			<div class="container">
				<div class="sect-top align-items-end wow fadeInUp <?php echo empty($tab_title) ? 'text-center' : 'style-between'; ?>" style="visibility: visible; animation-name: fadeInUp;">
                    <h2 class="s-title text-capitalize">
						<?php echo $tab_title; ?>
					</h2>
					<ul role="tablist" class="tab-prd menu-tab <?php echo $tab_heading_style == 'default' ? 'menu-tab-line' : 'menu-tab-fill'; ?> <?php echo empty($tab_title) ? 'style-lg' : ''; ?>" role="tablist">
						<?php if( $tab_heading_style == 'label') : ?>
						<li class="item-slide-effect hidden" style="width: 120px; transform: translateX(514px);"></li>
						<?php endif; ?>
						<?php echo $tab_heading; ?>
					</ul>
                </div>
				<div class="<?php echo esc_html($tab_classes); ?>">
					<?php echo $tab_content; ?>
					<div class="tf-overlay-container hidden">
						<div class="tf-overlay">
						</div>
						<div class="spinner"></div>
						<!-- <img src="<?php // echo plugins_url( '../assets/images/spinner.svg', __FILE__ );?>" alt="Loading"> -->
					</div>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
	
	public function get_tabs_title(){
		$settings = $this->get_settings_for_display();

		$tab_title = !empty($settings['tab-title']) ? $settings['tab-title'] : '';
		$tab_description = !empty($settings['tab-description']) ? $settings['tab-description'] : '';

		ob_start();
		
		if( $tab_title ){
			?>
			<div class="box-title">
				<?php echo $tab_title ?>
				<p class="desc text-main text-md"><?php echo $tab_description; ?></p>
			</div>
			<?php
		}

		return ob_get_clean();
	}

	public function get_tabs_arrow(){
		$settings = $this->get_settings_for_display();

		$arrow_top = !empty($settings['arrow-top']) ? $settings['arrow-top'] : false;

		ob_start();
		
		if( $arrow_top ){
			?>
			<div class="tf-nav-box">
				<div class="swiper-button-prev d-none d-xl-flex nav-swiper"></div>
				<div class="swiper-button-next d-none d-xl-flex nav-swiper"></div>
			</div>
			<?php
		}

		return ob_get_clean();
	}

	public function get_tab_heading( $active, $tab_id, $heading, $tab_heading_style){
		ob_start();
		?>
		<li class="nav-tab-item" data-target-tab="tf-tab-item-<?php echo esc_attr( $tab_id ); ?>" role="presentation">
			<a class="btn-tab tab-link <?php echo $tab_heading_style == 'label' ? 'display-xs' : ''; ?> <?php echo empty($active) ? '' : 'active'; ?>" data-bs-toggle="tab"><?php echo $heading; ?></a>
		</li>
		<?php
		return ob_get_clean();
	}

	public function get_tab_content( $active, $tab_id, $settings, $args, $product_style, $product_grid_classes, $carousel_configs, $card_params){

		$product_type = !empty($settings['product-type']) ? $settings['product-type'] : 'recent-products';
		$categories = !empty($settings['product-category']) ? (array) $settings['product-category'] : [];
		$brands = !empty($settings['product-brand']) ? (array) $settings['product-brand'] : [];
		$tags = !empty($settings['product-tag']) ? (array) $settings['product-tag'] : [];
		$product_ids = !empty($settings['product-id']) ? (array) $settings['product-id'] : [];

		$order_by = !empty($settings['order-by']) ? $settings['order-by'] : 'default';
		$order = !empty($settings['order']) ? $settings['order'] : 'asc';

		$args['order'] =  $order;

		$tax_query = [];

		// if (!empty($categories)) {
		// 	$tax_query[] = [
		// 		'taxonomy' => 'product_cat',
		// 		'field'    => 'id',
		// 		'terms'    => $categories,
		// 		'operator' => 'IN',
		// 	];
		// }

		// if (!empty($brands)) {
		// 	$tax_query[] = [
		// 		'taxonomy' => 'product_brand',
		// 		'field'    => 'id',
		// 		'terms'    => $brands,
		// 		'operator' => 'IN',
		// 	];
		// }

		// if (!empty($tags)) {
		// 	$tax_query[] = [
		// 		'taxonomy' => 'product_tag',
		// 		'field'    => 'id',
		// 		'terms'    => $tags,
		// 		'operator' => 'IN',
		// 	];
		// }

		if (!empty($categories)) {
			$tax_query[] = [
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $categories,
				'operator' => 'IN',
			];
		}

		if (!empty($brands)) {
			$tax_query[] = [
				'taxonomy' => 'product_brand',
				'field'    => 'slug',
				'terms'    => $brands,
				'operator' => 'IN',
			];
		}

		if (!empty($tags)) {
			$tax_query[] = [
				'taxonomy' => 'product_tag',
				'field'    => 'slug',
				'terms'    => $tags,
				'operator' => 'IN',
			];
		}

		

		if (!empty($tax_query) && $product_type != "custom-products") {
			$args['tax_query'] = $tax_query;
			$args['relation'] = 'AND';
		}

		switch ($product_type) {
			case 'featured-products':
				$args['tax_query'][] = [
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
				];
				break;
		
			case 'sale-products':
				$args['meta_query'][] = [
					'key'     => '_sale_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'NUMERIC',
				];
				break;
		
			case 'best-seller':
				$args['meta_key'] = 'total_sales';
				break;
		
			case 'top-rated':
				$args['meta_key'] = '_wc_average_rating';
				break;
			default:
				break;
		}

		if ($order_by !== 'default') {
			switch ($order_by) {
				case 'date':
					$args['orderby'] = 'date';
					break;
				case 'id':
					$args['orderby'] = 'ID';
					break;
				case 'title':
					$args['orderby'] = 'title';
					break;
				case 'price':
					$args['meta_key'] = '_price';
					$args['orderby']  = 'meta_value_num';
					break;
				case 'rating':
					$args['meta_key'] = '_wc_average_rating';
					$args['orderby']  = 'meta_value_num';
					break;
				case 'sales':
					$args['meta_key'] = 'total_sales';
					$args['orderby']  = 'meta_value_num';
					break;
			}
		}

		if (!empty($product_ids) && $product_type== "custom-products" ) {
			$args['post__in'] = $product_ids;
			$args['orderby'] = 'post__in';
		}

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

		ob_start();
		?>
		<div 
			class="tab-pane <?php echo esc_attr($arrow_control_classes); ?> <?php echo empty($active) ? '' : 'active show loaded'; ?> tf-tab-item-<?php echo esc_attr( $tab_id ); ?> <?php echo empty($card_params['show_on_hover']) ? '' : 'hover-sw-nav hover-sw-2';?>"
			data-tab-item='<?php echo esc_attr( $tab_id ); ?>'
			<?php if( empty($active) ) : ?>
			data-num-product='<?php echo esc_attr($args['posts_per_page']); ?>'
			data-product-type='<?php echo esc_attr($product_type); ?>'
			data-categories='<?php echo esc_attr(json_encode($categories)); ?>'
			data-brands='<?php echo esc_attr(json_encode($brands)); ?>'
			data-tags='<?php echo esc_attr(json_encode($tags)); ?>'
			data-product-ids='<?php echo esc_attr(json_encode($product_ids)); ?>'
			data-product-order-by='<?php echo esc_attr($order_by); ?>'
			data-product-order='<?php echo esc_attr($order); ?>'
			data-product-style='<?php echo esc_attr($product_style); ?>'
			data-product-grid-classes='<?php echo esc_attr($product_grid_classes); ?>'
			data-card-params='<?php echo esc_attr(json_encode($card_params)); ?>'
			data-carousel-configs='<?php echo esc_attr($carousel_configs); ?>'
			<?php endif; ?>
			role="tabpanel">
			<?php //echo empty($active) ? '' : wp_sprintf( TFWC_Elementor_Widget_Addon::get_product_grid_content($args, $product_style, $product_grid_classes, $carousel_configs, $card_params) ); ?>
			<?php echo empty($active) ? '' : ( TFWC_Elementor_Widget_Addon::get_product_grid_content($args, $product_style, $product_grid_classes, $carousel_configs, $card_params) ); ?>
			
		</div>
		<?php
		return ob_get_clean();
	}

}