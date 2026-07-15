<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor_Widget_Addon class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class TFWC_Elementor_Widget_Addon {

	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.7.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '5.2';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Elementor_Widget_Addon The single instance of the class.
	 */
	private static $_instance = null;

	private $widget_settings = [];

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Elementor_Widget_Addon An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ], 100 );
			add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ], 100 );
			add_action( 'elementor/init', [ $this, 'init' ] );
			$this->init_ajax();
		}
			
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check if Woocommerce installed and activated
		if ( ! did_action( 'woocommerce_loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_woocommerce_plugin' ] );
			return;
        }

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) )
			unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'vemus-addon' ),
			'<strong>' . esc_html__( 'Vemus Addon', 'vemus-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'vemus-addon' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) )
			unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'vemus-addon' ),
			'<strong>' . esc_html__( 'Vemus Addon', 'vemus-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'vemus-addon' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	  /**
     * Admin notice
     *
     * Warning when the site doesn't have Woocommerce installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_woocommerce_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            /* translators: 1: Plugin name 2: Woocommerce */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'vemus-addon' ),
            '<strong>' . esc_html__( 'Vemus Addon', 'vemus-addon' ) . '</strong>',
            '<strong>' . esc_html__( 'Woocommerce', 'vemus-addon' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) )
			unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'vemus-addon' ),
			'<strong>' . esc_html__( 'Vemus Addon', 'vemus-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'vemus-addon' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		$elementsManager = \Elementor\Plugin::instance()->elements_manager;
		$elementsManager->add_category(
			'vemus_addons',
			array(
				'title' => esc_html__( 'Vemus Addon', 'vemus-addon' ),
				'icon'  => 'fonts',
			) );
		$elementsManager->add_category(
			'vemus_addons_core',
			array(
				'title' => esc_html__( 'Vemus Addon Core', 'vemus-addon' ),
				'icon'  => 'fonts',
			) );
		
		add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'register_icons_picker'] );
		add_action('elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action('elementor/controls/register', [$this, 'register_controls' ]);
	}

	public function init_ajax(){
		// add_action('wp_ajax_tfwc_select2_options', [ $this, 'fetch_tfwc_select2_product_options']);
		// // add_action('wp_ajax_nopriv_tfwc_select2_options', [ $this, 'fetch_tfwc_select2_product_options']);

		add_action('wp_ajax_vemus_get_tab_contents', [ 'TFWC_Elementor_Widget_Addon', 'get_tab_contents']);
		add_action('wp_ajax_nopriv_vemus_get_tab_contents', [ 'TFWC_Elementor_Widget_Addon', 'get_tab_contents']);

		// add_action('wp_ajax_vince_handle_bundle', [ $this, 'tf_handle_product_bundle']);
		// add_action('wp_ajax_nopriv_vince_handle_bundle', [ $this, 'tf_handle_product_bundle']);
	}

	public function widget_scripts() {
		// 3rd
		if ( ! wp_script_is( 'themesflat-bootstrap', 'registered' ) ) {
			wp_register_script( 'themesflat-bootstrap', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ), [], null, true );
		}

		if ( ! wp_script_is( 'themesflat-swiper', 'registered' ) ) {
			wp_register_script( 'themesflat-swiper', plugins_url( 'assets/js/swiper-bundle.min.js', __FILE__ ), [], null, true );
		}

		wp_register_script( 'gsap', plugins_url( 'assets/js/gsap.min.js', __FILE__ ), [], null, true );
		wp_register_script( 'splittext', plugins_url( 'assets/js/splittext.js', __FILE__ ), [], null, true );
		wp_register_script( 'scrolltrigger', plugins_url( 'assets/js/ScrollTrigger.min.js', __FILE__ ), [], null, true );
		wp_register_script( 'js-countdown', plugins_url( 'assets/js/count-down.js', __FILE__ ), [], null, true );
		wp_register_script( 'parallaxie', plugins_url( 'assets/js/parallaxie.js', __FILE__ ), [], null, true );

		wp_register_script( 'tf-magnific-popup', plugins_url( 'assets/js/magnific-popup.min.js', __FILE__ ), [], null, true );

		if ( ! wp_script_is( 'themesflat-lazysize', 'registered' ) ) {
			wp_register_script(
				'themesflat-lazysize',
				THEMESFLAT_LINK . 'assets/js/3rd/lazysize.min.js',
				array(),
				'',
				true
			);
		}

		wp_register_script( 'vemus-product-grid', plugins_url( 'assets/js/vemus-product-grid.js', __FILE__ ), [ 'jquery', 'js-countdown', 'themesflat-lazysize' ], null, true );
		wp_register_script( 'vemus-product-lookbook', plugins_url( 'assets/js/vemus-product-lookbook.js', __FILE__ ), [ 'jquery', 'themesflat-swiper'], null, true );
		wp_register_script( 'vemus-product-highlight', plugins_url( 'assets/js/vemus-product-highlight.js', __FILE__ ), [ 'jquery', 'themesflat-swiper', 'tf-magnific-popup'], null, true );
		wp_register_script( 'vemus-product-featured', plugins_url( 'assets/js/vemus-product-featured.js', __FILE__ ), [ 'jquery', 'themesflat-swiper'], null, true );
		wp_register_script( 'vemus-product-category-list', plugins_url( 'assets/js/vemus-product-category-list.js', __FILE__ ), [ 'jquery'], null, true );

		$tfwc_settings = [
			'admin_ajax_url' => admin_url( 'admin-ajax.php' ),
			'get_tabs_nonce'    => wp_create_nonce('tfwc_vemus_get_tabs_nonce'),
			'handle_bundle_nonce'    => wp_create_nonce('tfwc_vemus_handle_bundle_nonce')
		];

		wp_localize_script( 
			'vemus-product-grid',
			'tfwc_settings',
			 $tfwc_settings
		);

		wp_localize_script( 
			'vemus-product-bundle',
			'tfwc_settings',
			$tfwc_settings
		);

		// Core Js	
		wp_register_script( 'banner-hero', plugins_url( 'assets/js/banner-hero.js', __FILE__ ), [], null, true );
		wp_register_script( 'slider-core', plugins_url( 'assets/js/slider-core.js', __FILE__ ), [], null, true );
		wp_register_script( 'image-animation', plugins_url( 'assets/js/image-animation.js', __FILE__ ), [], null, true );
		wp_register_script( 'text-animation', plugins_url( 'assets/js/text-animation.js', __FILE__ ), [], null, true );

	}

	public function widget_styles() {
		// 3rd
		if ( ! wp_style_is( 'themesflat-bootstrap', 'registered' ) ) {
			wp_register_style( 'themesflat-bootstrap', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ) );
		}
		if ( ! wp_style_is( 'themesflat-swiper', 'registered' ) ) {
			wp_register_style( 'themesflat-swiper', plugins_url( 'assets/css/swiper-bundle.min.css', __FILE__ ) );
		}
		wp_register_style( 'vemus-addons', plugins_url( 'assets/css/vemus-addons.css', __FILE__ ) );
		wp_register_style( 'vemus-product-grid', plugins_url( 'assets/css/vemus-product-grid.min.css', __FILE__ ) );
		wp_register_style( 'tf-magnific-popup', plugins_url( 'assets/css/magnific-popup.min.css', __FILE__ ) );

	}

	public function widget_styles_editor() {
		if ( did_action( 'elementor/loaded' ) ) {
			
		}
	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {

		// Widget Core
		require_once( __DIR__ . '/widgets/widget-banner-hero.php' );
		$widgets_manager->register(  new \Vemus_Banner_Hero() );
		require_once( __DIR__ . '/widgets/widget-gallery.php' );
		$widgets_manager->register(  new \Vemus_Gallery() );
		require_once( __DIR__ . '/widgets/widget-list-collection.php' );
		$widgets_manager->register(  new \Vemus_List_Collection() );
		require_once( __DIR__ . '/widgets/widget-blog.php' );
		$widgets_manager->register(  new \Vemus_Blog() );
		require_once( __DIR__ . '/widgets/widget-image-animation.php' );
		$widgets_manager->register(  new \Vemus_Image_Animation() );
		require_once( __DIR__ . '/widgets/widget-group-information.php' );
		$widgets_manager->register(  new \Vemus_Group_Information() );
		require_once( __DIR__ . '/widgets/widget-accordion.php' );
		$widgets_manager->register(  new \Vemus_Accordion() );
		require_once( __DIR__ . '/widgets/widget-store-information.php' );
		$widgets_manager->register(  new \Vemus_Store_Information() );
		require_once( __DIR__ . '/widgets/widget-heading.php' );
		$widgets_manager->register(  new \Vemus_Heading() );
		require_once( __DIR__ . '/widgets/widget-section-information.php' );
		$widgets_manager->register(  new \Vemus_Section_Information() );
		require_once( __DIR__ . '/widgets/widget-banner.php' );
		$widgets_manager->register(  new \Vemus_Banner() );
		require_once( __DIR__ . '/widgets/widget-collection-grid.php' );
		$widgets_manager->register(  new \Vemus_Collection_Grid() );
		require_once( __DIR__ . '/widgets/widget-collection-list.php' );
		$widgets_manager->register(  new \Vemus_Collection_List() );
		require_once( __DIR__ . '/widgets/widget-text-scroll-animation.php' );
		$widgets_manager->register(  new \Vemus_Text_Scroll_Animation() );
		require_once( __DIR__ . '/widgets/widget-slider.php' );
		$widgets_manager->register(  new \Vemus_Slider() );
		require_once( __DIR__ . '/widgets/widget-image-box.php' );
		$widgets_manager->register(  new \Vemus_Image_Box() );
		require_once( __DIR__ . '/widgets/widget-button.php' );
		$widgets_manager->register(  new \Vemus_Button() );
		require_once( __DIR__ . '/widgets/widget-icon-box.php' );
		$widgets_manager->register(  new \Vemus_Icon_Box() );
		require_once( __DIR__ . '/widgets/widget-marquee.php' );
		$widgets_manager->register(  new \Vemus_Marquee() );
		require_once( __DIR__ . '/widgets/widget-countdown.php' );
		$widgets_manager->register(  new \Vemus_Countdown() );
		require_once( __DIR__ . '/widgets/widget-testimonial.php' );
		$widgets_manager->register(  new \Vemus_Testimonial() );
		require_once( __DIR__ . '/widgets/widget-testimonial-type-2.php' );
		$widgets_manager->register(  new \Vemus_Testimonial_Type_2() );
		require_once( __DIR__ . '/widgets/widget-product-video.php' );
		$widgets_manager->register(  new \Vemus_Product_Video() );
		require_once( __DIR__ . '/widgets/widget-mega-menu.php' );
		$widgets_manager->register(  new \Vemus_Mega_Menu() );
		require_once( __DIR__ . '/widgets/widget-menu.php' );
		$widgets_manager->register(  new \Vemus_Menu() );
		require_once( __DIR__ . '/widgets/widget-footer-bottom.php' );
		$widgets_manager->register(  new \Vemus_Footer_Bottom() );
		require_once( __DIR__ . '/widgets/widget-banner-with-product.php' );
		$widgets_manager->register(  new \Vemus_Banner_With_Product() );
		require_once( __DIR__ . '/widgets/widget-about-us.php' );
		$widgets_manager->register(  new \Vemus_About_Information() );
		require_once( __DIR__ . '/widgets/widget-slider-content.php' );
		$widgets_manager->register(  new \Vemus_Slider_Content() );


		// Product widgets

		require_once( __DIR__ . '/widgets/vemus-product-grid.php' );
		$widgets_manager->register(  new \Vemus_Product_Grid() );

		require_once( __DIR__ . '/widgets/vemus-product-list.php' );
		$widgets_manager->register(  new \Vemus_Product_List() );

		require_once( __DIR__ . '/widgets/vemus-product-tabs-carousel.php' );
		$widgets_manager->register(  new \Vemus_Product_Tabs_Carousel() );

		require_once( __DIR__ . '/widgets/vemus-product-category-grid.php' );
		$widgets_manager->register(  new \Vemus_Product_Category_Grid() );

		require_once( __DIR__ . '/widgets/vemus-product-category-list.php' );
		$widgets_manager->register(  new \Vemus_Product_Category_List() );

		require_once( __DIR__ . '/widgets/vemus-product-lookbook.php' );
		$widgets_manager->register(  new \Vemus_Product_Lookbook() );

		require_once( __DIR__ . '/widgets/vemus-product-highlight.php' );
		$widgets_manager->register(  new \Vemus_Product_Highlight() );

		require_once( __DIR__ . '/widgets/vemus-product-featured.php' );
		$widgets_manager->register(  new \Vemus_Product_Featured() );

		require_once( __DIR__ . '/widgets/widget-rudraksha-mukhi.php' );
		$widgets_manager->register(  new \Vemus_Widget_Rudraksha_Mukhi() );
	}

	public function register_controls( $controls_manager ) {
		require_once( __DIR__ . '/controls/tfwc-select2.php' );
    	$controls_manager->register_control('tfwc_select2', new TFWC_Select2_Control());
	}

	public function register_icons_picker( $icons = array() ) {			
		$icons['vemus_icon'] = array(
			'name'          => 'vemus_icon',
			'label'         => esc_html__( 'Vemus Icons', 'vemus-addon' ),
			'labelIcon'     => 'icon-luxury',
			'prefix'        => '',
			'displayPrefix' => '',
			'url' 			=> get_template_directory_uri() . '/assets/css/3rd/icon-vemus.css',
			'fetchJson'     => plugins_url( 'assets/icon/vemus-json.json', __FILE__ ),
			'ver'           => '1.0.0',
		);
	
		return $icons;
	}

	public function add_woo_hook(){
		add_filter( 'wcboost_variation_swatches_color_html', [$this, 'wcboost_variation_swatches_color_html' ], 20, 4);
		add_filter( 'wcboost_variation_swatches_image_html', [$this, 'wcboost_variation_swatches_color_html' ], 20, 4);
		add_filter( 'wcboost_variation_swatches_html', [$this, 'wcboost_variation_swatches_html' ], 20, 2);
		// add_filter( 'wcboost_variation_swatches_item_args', [ Woo_Single_Product_Hook::instance(), 'wcboost_variation_swatches_item_args' ], 20, 4 );
		// add_filter( 'woocommerce_product_single_add_to_cart_text', [$this, 'add_to_cart_button_text'], 10, 2 );
		// if( function_exists('tfwc_wishlish_button') ){
		// 	remove_filter( 'wcboost_wishlist_loop_add_to_wishlist_link', 'tfwc_wishlish_button' , 20, 2 );
		// }
	}

	public function remove_woo_hook(){
		remove_filter( 'wcboost_variation_swatches_color_html', [$this, 'wcboost_variation_swatches_color_html' ], 20, 4);
		remove_filter( 'wcboost_variation_swatches_image_html', [$this, 'wcboost_variation_swatches_color_html' ], 20, 4);
		remove_filter( 'wcboost_variation_swatches_html', [$this, 'wcboost_variation_swatches_html' ], 20, 2);
		// remove_filter( 'woocommerce_product_single_add_to_cart_text', [$this, 'add_to_cart_button_text'], 10, 2 );
		// if( function_exists('tfwc_wishlish_button') ){
		// 	add_filter( 'wcboost_wishlist_loop_add_to_wishlist_link', 'tfwc_wishlish_button' , 20, 2 );
		// }
	}

	public function fetch_tfwc_select2_product_options() {
        check_ajax_referer('tfwc_select2_nonce', 'security');

        $search = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
		$selected = isset($_GET['selected']) ? (array) $_GET['selected'] : [];

        $args = [
            'post_type'      => 'product',
            'posts_per_page' => 10,
            's'              => $search
        ];

		if (!empty($selected)) {
			$args['post__in'] = $selected;
			$args['orderby'] = 'post__in';
		}

        $query = new WP_Query($args);

        $results = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $results[] = [
                    'id'   => get_the_ID(),
                    'text' => get_the_title(),
                ];
            }
            wp_reset_postdata();
        }

        wp_send_json($results);
    }
	
	public function wcboost_variation_swatches_html($html, $args){

		$options   = $args['options'];
		$product   = $args['product'];
		$attribute = $args['attribute'];

		$swatches_args = \WCBoost\VariationSwatches\Swatches::instance()->get_swatches_args( $product->get_id(), $attribute );
		$swatches_args = wp_parse_args( $args, $swatches_args );

		if( $swatches_args['swatches_type'] != 'color' && $swatches_args['swatches_type'] != 'image' ){
			return $html;
		}

		$html = str_replace('<ul class="', '<ul class="list-color-product ', $html);
		if( $swatches_args['swatches_type'] == 'color'){
			$html = str_replace('<li class="', '<li class="list-color-item hover-tooltip tooltip-bot color-swatch ', $html);
		}
		if( $swatches_args['swatches_type'] == 'image'){
			$html = str_replace('<li class="', '<li class="list-color-image-item hover-tooltip tooltip-bot color-swatch ', $html);
		}
		$html = str_replace('</li>', '<span class="swatch-value"></span></li>', $html);
		$html = str_replace('wcboost-variation-swatches__name', 'tooltip', $html);
		return $html;
	}

	public function wcboost_variation_swatches_color_html($html, $args, $data, $term){
		$value = is_object( $term ) ? $term->slug : $term;
		$product   = $args['product'];
		$attribute = $args['attribute'];

		$variation_data = [];
        if ($product->is_type('variable')) {
            $variations = $product->get_available_variations();
            foreach ($variations as $variation) {
                $color_value = $variation['attributes']['attribute_pa_color'] ?? '';
                if ($color_value) {
                    $variation_data[$color_value] = $variation['image']['src'] ?? '';
                }
            }
			
        }
		
		if( !empty($variation_data[$value])){
			$html = preg_replace('/<li([^>]*)>/', '<li$1 data-image="' . esc_attr($variation_data[$value]) . '">', $html);
		};

		return $html;
    }

	public static function register_additional_controls($widget){
		$widget->add_control(
			'add-to-cart',
			[
				'label' => esc_html__( 'Add To Cart', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'vemus-addon' ),
				'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->add_control(
			'button-text',
			[
				'label' => esc_html__( 'Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Add To Cart',
				'condition' => [
					'add-to-cart' => 'yes'
				]
			]
		);

		$widget->add_control(
			'button-icon',
			[
				'label' => esc_html__( 'Icon', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'default' => [
					'value' => 'icon-shop-cart',
					'library' => 'vemus-icon',
				],
				'condition' => [
					'add-to-cart' => 'yes'
				]
			]
		);

		$widget->add_control(
			'icon-align',
			[
				'label' => esc_html__( 'Icon Position', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'row-reverse',
				'options' => [
					'row-reverse' => [
						'title' => esc_html__( 'Start', 'vemus-addon' ),
						'icon' => "eicon-h-align-left",
					],
					'row' => [
						'title' => esc_html__( 'End', 'vemus-addon' ),
						'icon' => "eicon-h-align-right",
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cls-btn .tf-btn' => 'flex-direction: {{VALUE}};gap: 16px;',
					'{{WRAPPER}} .cls-btn .tf-btn .icon' => 'margin: 0;',
				],
				'condition' => [
					'add-to-cart' => 'yes',
					'button-icon[value]!' => '',
				]
			]
		);

		$widget->add_control(
			'show-rating',
			[
				'label' => esc_html__( 'Rating', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'vemus-addon' ),
				'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->add_control(
			'in-stock-text',
			[
				'label' => esc_html__( 'In stock Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'In stock, ready to ship',
				'condition' => [
					'product-style' => 'style-5'
				]
			]
		);

		$widget->add_control(
			'out-of-stock',
			[
				'label' => esc_html__( 'Out of stock', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'vemus-addon' ),
				'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'out-of-stock-text',
			[
				'label' => esc_html__( 'Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Out of stock',
				'condition' => [
					'out-of-stock' => 'yes',
					'product-style' => 'style-5'
				]
			]
		);

		$widget->add_control(
			'out-of-stock-button-text',
			[
				'label' => esc_html__( 'Button Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Sold out',
				'condition' => [
					'out-of-stock' => 'yes',
					'add-to-cart' => 'yes'
				]
			]
		);

		$widget->add_control(
			'brand',
			[
				'label' => esc_html__( 'Brand', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'vemus-addon' ),
				'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		// $widget->add_control(
		// 	'countdown-box-style',
		// 	[
		// 		'label' => esc_html__( 'Countdown box style', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'options' => [
		// 			'style-1' => esc_html__( 'Style 1', 'vemus-addon' ),
		// 			'style-2' => esc_html__( 'Style 2', 'vemus-addon' ),
		// 			'style-3' => esc_html__( 'Style 3', 'vemus-addon' ),
		// 		],
		// 		'default' => 'style-1',
		// 	]
		// );

		// $widget->add_control(
		// 	'show-progress-sale',
		// 	[
		// 		'label' => esc_html__( 'Progress Sale', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => esc_html__( 'Show', 'vemus-addon' ),
		// 		'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
		// 		'return_value' => 'yes',
		// 		'default' => '',
		// 	]
		// );

		// $widget->add_control(
		// 	'show-sold-count',
		// 	[
		// 		'label' => esc_html__( 'Sold count', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => esc_html__( 'Show', 'vemus-addon' ),
		// 		'label_off' => esc_html__( 'Hide', 'vemus-addon' ),
		// 		'return_value' => 'yes',
		// 		'default' => '',
		// 		'condition' => [
		// 			'show-progress-sale' => 'yes',
		// 		]
		// 	]
		// );
	}

	public static function register_tab_style_controls($widget){

		$widget->start_controls_section(
			'tab_style_section',
			[
				'label' => esc_html__('Tab Items', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			],
		);

		$widget->add_control(
			'tab-title-heading',
			[
				'label' => esc_html__( 'Tab Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'tab-style' => 'title',
				]
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tab-title-typography',
				'selector' => '{{WRAPPER}} .box-title',
				'condition' => [
					'tab-style' => 'title',
				]
			]
		);

		$widget->add_control(
			'tab-title-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box-title' => 'color: {{VALUE}} !important',
				],
				'condition' => [
					'tab-style' => 'title',
				]
			]
		);

		$widget->add_control(
			'tab-description-heading',
			[
				'label' => esc_html__( 'Tab Description', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'tab-style' => 'title',
				]
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tab-description-typography',
				'selector' => '{{WRAPPER}} .box-title .desc',
				'condition' => [
					'tab-style' => 'title',
				]
			]
		);

		$widget->add_control(
			'tab-desciption-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box-title .desc' => 'color: {{VALUE}} !important',
				],
				'condition' => [
					'tab-style' => 'title',
				]
			]
		);

		$widget->add_control(
			'tab-heading',
			[
				'label' => esc_html__( 'Tab Heading', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$widget->add_control(
			'tab-heading-alignment',
			[
				'label' => esc_html__( 'Alignment', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'vemus-addon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'vemus-addon' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'vemus-addon' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'condition' => [
					'tab-style' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}} .sect-title' => 'display: none !important;',
					'{{WRAPPER}} .sect-top' => 'justify-content: {{VALUE}} !important;',
				],
				'render_type' => 'template',
			]
		);

		$widget->add_responsive_control(
			'tab-heading-margin',
			[
				'label' => __( 'Margin', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .flat-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tab-heading-typography',
				'selector' => '{{WRAPPER}} .flat-title .tab-link',
			]
		);

		$widget->start_controls_tabs(
			'tab_heading_style_tabs'
		);

		$widget->start_controls_tab(
			'tab_heading_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'tab-heading-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flat-title .tab-link' => 'color: {{VALUE}}',
				],
			]
		);

		// $widget->add_control(
		// 	'tab-heading-bgcolor',
		// 	[
		// 		'label' => esc_html__( 'Background Color', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .flat-title .tab-link' => 'background-color: {{VALUE}}',
		// 		],
		// 		'condition' => [
		// 			'tab-heading-style' => 'label',
		// 		]
		// 	]
		// );

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'tab_heading_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'tab-heading-hover-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flat-title .menu-tab-line .tab-link:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .flat-title .tab-link.active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .flat-title .menu-tab-line .tab-link::after' => 'background-color: {{VALUE}}',			
				],
			]
		);

		$widget->add_control(
			'tab-heading-hover-bgcolor',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flat-title .menu-tab-line .tab-link:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .flat-title .tab-link.active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .flat-title .menu-tab-fill .item-slide-effect' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'tab-heading-style' => 'label',
				]
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->add_responsive_control(
			'tab-heading-spaceBetween',
			[
				'label' => esc_html__('Space Between(px)', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => ['px'],
				'default' => ['size' => 24, 'unit' => 'px'],
				'tablet_default' => ['size' => 18, 'unit' => 'px'],
				'mobile_default' => ['size' => 12, 'unit' => 'px'],
				'range' => ['px' => ['min' => 0, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'selectors' => ['{{WRAPPER}} .menu-tab' => 'gap: {{SIZE}}{{UNIT}};'],
			]
		);

		$widget->add_control(
			'border-line-heading',
			[
				'label' => esc_html__( 'Border Line', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'tab-heading-style' => 'default',
				]
			]
		);

		$widget->add_control(
			'border-line-height',
			[
				'label' => __( 'Height', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'max' => 50,
				'min' => 0,
				'selectors' => [
					'{{WRAPPER}} .flat-title .menu-tab-line .tab-link::after' => 'height: {{VALUE}}px',
				],
				'condition' => [
					'tab-heading-style' => 'default',
				]
			]
		);

		$widget->add_control(
			'border-line-padding',
			[
				'label' => __( 'Spacing', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'max' => 100,
				'min' => 0,
				'selectors' => [
					'{{WRAPPER}} .flat-title .menu-tab-line .tab-link' => 'padding-bottom: {{VALUE}}px',
				],
				'condition' => [
					'tab-heading-style' => 'default',
				]
			]
		);

		$widget->end_controls_section();

	}

	public static function register_product_style_controls($widget){

		if( $widget->get_name() == 'vemus_product_grid' ){

			$widget->start_controls_section(
				'content_style_section',
				[
					'label' => esc_html__('Content', 'vemus-addon'),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'heading-enable' => 'yes'
					],
				]
			);

			$widget->add_responsive_control(
				'content_flex_direction',
				[
					'label' => __( 'Content Direction', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'row' => [
							'title' => __( 'Row', 'vemus-addon' ),
							'icon' => 'eicon-h-align-left',
						],
						'row-reverse' => [
							'title' => __( 'Row Reverse', 'vemus-addon' ),
							'icon' => 'eicon-h-align-right',
						],
						'column' => [
							'title' => __( 'Column', 'vemus-addon' ),
							'icon' => 'eicon-v-align-top',
						],
						'column-reverse' => [
							'title' => __( 'Column Reverse', 'vemus-addon' ),
							'icon' => 'eicon-v-align-bottom',
						],
					],
					'default' => 'column',
					'toggle' => false,
					'selectors' => [
						'{{WRAPPER}} .vemus-product-grid-wrapper' => 'display: flex; flex-direction: {{VALUE}};',
					],
				]
			);

			$widget->add_responsive_control(
				'content_spacing',
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
					'default' => [
						'size' => 48,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}}  .vemus-product-grid-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$widget->add_responsive_control(
				'content-heading-align',
				[
					'label' => __( 'Align', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'vemus-addon' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Right', 'vemus-addon' ),
							'icon' => 'eicon-text-align-right',
						],
						'right' => [
							'title' => __( 'Center', 'vemus-addon' ),
							'icon' => 'eicon-text-align-center',
						],
					],
					'default' => 'left',
					'toggle' => false,
					'selectors' => [
						'{{WRAPPER}} .vemus-product-grid-heading' => 'text-align: {{VALUE}};',
					],
				]
			);

			$widget->add_control(
				'content-heading-typo',
				[
					'label' => esc_html__( 'Heading', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					// 'separator' => 'before',
				]
			);

			$widget->add_control(
				'content-heading-color',
				[
					'label' => esc_html__( 'Color', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .vemus-product-grid-heading' => 'color: {{VALUE}} !important;',
					],
				]
			);

			$widget->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'content-heading-typography',
					'selector' => '{{WRAPPER}} .vemus-product-grid-heading',
				]
			);

			$widget->end_controls_section();

		}

		$widget->start_controls_section(
			'product_style_section',
			[
				'label' => esc_html__('Products', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'product-column-gap',
			[
				'label' => esc_html__('Column Gap(px)', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => ['px'],
				'default' => ['size' => 30, 'unit' => 'px'],
				'tablet_default' => ['size' => 20, 'unit' => 'px'],
				'mobile_default' => ['size' => 15, 'unit' => 'px'],
				'range' => ['px' => ['min' => 0, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .tf-grid-layout' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'product-row-gap',
			[
				'label' => esc_html__('Row Gap(px)', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => ['px'],
				'default' => ['size' => 30, 'unit' => 'px'],
				'tablet_default' => ['size' => 20, 'unit' => 'px'],
				'mobile_default' => ['size' => 15, 'unit' => 'px'],
				'range' => ['px' => ['min' => 0, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .tf-grid-layout' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'product-content-gap',
			[
				'label' => esc_html__('Content Gap(px)', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				// 'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => ['px'],
				'default' => ['size' => 35, 'unit' => 'px'],
				// 'tablet_default' => ['size' => 20, 'unit' => 'px'],
				// 'mobile_default' => ['size' => 15, 'unit' => 'px'],
				'range' => ['px' => ['min' => 0, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .tf-grid-layout .card-product.card_product--V01' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'product_alignment',
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
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .card_product-info' => 'text-align: {{VALUE}} !important;',
					'{{WRAPPER}} .card_product-info .list-color-product' => 'justify-content: {{VALUE}} !important;',
					'{{WRAPPER}} .card_product-info .card-product-rating' => 'justify-content: {{VALUE}} !important;',
					'{{WRAPPER}} .card_product-info .tf-rating-wrapper' => 'justify-content: {{VALUE}} !important;',
					'{{WRAPPER}} .card_product-info .price-wrap' => 'justify-content: {{VALUE}} !important;',
					'{{WRAPPER}} .card_product-info .cls-btn' => 'text-align: {{VALUE}} !important;',
					'{{WRAPPER}} .card_product-info .wcboost-variation-swatches__wrapper' => 'justify-content: {{VALUE}} !important;',
				],
				// 'render_type' => 'template',
			]
		);

		$widget->add_control(
			'product-card-bg-color',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-product' => 'background-color: {{VALUE}}',
				],
			]
		);

		$widget->add_responsive_control(
			'product-padding',
			[
				'label' => __( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .card-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'product-border-heading',
			[
				'label' => esc_html__( 'Border', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				// 'separator' => 'before',
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'product-border',
				'selector' => '{{WRAPPER}} .card-product',
				// 'exclude' => [ 'width' ]
			]
		);

		$widget->add_control(
			'product-border-radius',
			[
				'label' => __( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .card-product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'product-image-heading',
			[
				'label' => esc_html__( 'Product Image', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'product-image-padding',
			[
				'label' => __( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .card_product-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image-border',
				'selector' => '{{WRAPPER}} .card_product-wrapper',
			]
		);

		$widget->add_control(
			'product-image-radius',
			[
				'label' => __( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .card_product-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'aspect-ratio',
			[
				'label' => esc_html__( 'Aspect Ratio (Eg : 3/4)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$widget->add_control(
			'product-badges-heading',
			[
				'label' => esc_html__( 'Product Badges', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'product-badges-radius',
			[
				'label' => __( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .badge-box .badge-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'list-buttons-heading',
			[
				'label' => esc_html__( 'List buttons', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// $widget->add_responsive_control(
		// 	'list-buttons-position',
		// 	[
		// 		'label' => __( 'Position', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'em' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .list-product-btn' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left : {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		$widget->add_control(
			'list-buttons-custom-position',
			[
				'label' => esc_html__( 'Custom Position', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->add_responsive_control(
			'list-buttons-position-top',
			[
				'label' => esc_html__('Offset Top', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => [ 'px', '%', 'em' ],
				'default' => ['size' => 50, 'unit' => '%'],
				'tablet_default' => ['size' => 18, 'unit' => 'px'],
				'mobile_default' => ['size' => 12, 'unit' => 'px'],
				'range' => ['px' => ['min' => -500, 'max' => 500, 'step' => 1],'%' => ['min' => -100, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 500,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .list-product-btn' => 'bottom:unset !important; top: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [	
				    'list-buttons-custom-position' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'list-buttons-position-left',
			[
				'label' => esc_html__('Offset Left', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => [ 'px', '%', 'em' ],
				'default' => ['size' => 50, 'unit' => '%'],
				'tablet_default' => ['size' => 18, 'unit' => 'px'],
				'mobile_default' => ['size' => 12, 'unit' => 'px'],
				'range' => ['px' => ['min' => -500, 'max' => 500, 'step' => 1],'%' => ['min' => -100, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 500,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .list-product-btn' => 'right: unset !important; left: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [	
				    'list-buttons-custom-position' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'list-buttons-tooltip-border-radius',
			[
				'label' => __( 'Tooltip Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .list-product-btn a:hover .tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->start_controls_tabs(
			'product_list_buttons_style_tabs'
		);

		$widget->start_controls_tab(
			'list_buttons_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'list-buttons-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-product-btn a.box-icon' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$widget->add_control(
			'list-buttons-background-color',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-product-btn a.box-icon' => 'border-color: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'list_buttons_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'list-buttons-hover-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-product-btn a.box-icon:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .list-product-btn a.box-icon:hover .tooltip' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$widget->add_control(
			'list-buttons-background-hover-color',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-product-btn a.box-icon:hover' => 'border-color: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .list-product-btn a.box-icon .tooltip' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .list-product-btn a.box-icon .tooltip:before' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->add_control(
			'product-summary-heading',
			[
				'label' => esc_html__( 'Product Summary', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'product-summary-padding',
			[
				'label' => __( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .card_product-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'product-title-heading',
			[
				'label' => esc_html__( 'Product Title', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'product-title-typography',
				'selector' => '{{WRAPPER}} .name-product, {{WRAPPER}} .stock-status, {{WRAPPER}} .wcboost-variation-swatches, {{WRAPPER}} .text-brand',
			]
		);
		
		$widget->start_controls_tabs(
			'product_title_style_tabs'
		);

		$widget->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .name-product' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-product:hover .name-product' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->add_control(
			'product-price-heading',
			[
				'label' => esc_html__( 'Product price', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'product-price-typography',
				'selector' => '{{WRAPPER}} .price-wrap',
			]
		);

		$widget->add_control(
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

		$widget->add_control(
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

		$widget->end_controls_section();

		$widget->start_controls_section(
			'add_to_cart_style_section',
			[
				'label' => esc_html__('Add to cart button', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'add-to-cart' => 'yes'
				]
			]
		);

		$widget->add_control(
			'button-heading',
			[
				'label' => esc_html__( 'Button', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button-title-typography',
				'selector' => '{{WRAPPER}} .tf-btn',
			]
		);

		$widget->start_controls_tabs(
			'button_style_tabs'
		);

		$widget->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'button-color',
			[
				'label' => esc_html__( 'Text Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-btn .icon' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'button-bg-color',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'button-hover-color',
			[
				'label' => esc_html__( 'Text Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-btn:hover .icon' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'button-hover-bg-color',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->add_responsive_control(
			'button-padding',
			[
				'label' => __( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};width: max-content !important;',
				],
			]
		);

		$widget->add_control(
			'button-border-heading',
			[
				'label' => esc_html__( 'Border', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button-border',
				'selector' => '{{WRAPPER}} .tf-btn',
			]
		);

		$widget->add_control(
			'button-border-radius',
			[
				'label' => __( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button-border_border!' =>  [ '', 'none' ],
				],
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'carousel_style_section',
			[
				'label' => esc_html__('Carousel', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
				    'carousel' => 'yes',
				],
			]
		);

		$widget->add_control(
			'arrow-heading',
			[
				'label' => esc_html__( 'Arrow', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// $widget->add_control(
		// 	'arrow-style',
		// 	[
		// 		'type'        => \Elementor\Controls_Manager::SELECT,
		// 		'label'       => esc_html__( 'Arrow Style', 'vemus-addon' ),
		// 		'default'     => 'style-1',
		// 		'options'     => [
		// 			'style-1' => esc_html__( 'Style 1', 'vemus-addon' ),
		// 			// 'style-2' => esc_html__( 'Style 2', 'vemus-addon' ),
		// 		],
		// 	],
		// );

		// $widget->add_control(
		// 	'arrow-top',
		// 	[
		// 		'label' => esc_html__( 'Arrow top', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => esc_html__( 'On', 'vemus-addon' ),
		// 		'label_off' => esc_html__( 'Off', 'vemus-addon' ),
		// 		'return_value' => 'yes',
		// 		'default' => '',
		// 		//'condition' => [
		// 		//    'carousel' => 'yes',
		// 		//	'tab-style' => 'default'
		// 		//],
		// 	]
		// );

		$widget->add_control(
			'custom-box-position',
			[
				'label' => esc_html__( 'Arrow position', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [	
				    'arrow-top' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'arrow-box-position-x',
			[
				'label' => esc_html__('X', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => [ 'px', '%', 'em' ],
				'default' => ['size' => 100, 'unit' => '%'],
				'tablet_default' => ['size' => 18, 'unit' => 'px'],
				'mobile_default' => ['size' => 12, 'unit' => 'px'],
				'range' => ['px' => ['min' => -100, 'max' => 100, 'step' => 1],'%' => ['min' => -100, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .box-nav-swiper' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [	
				    'custom-box-position' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'arrow-box-position-y',
			[
				'label' => esc_html__('Y', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => [ 'px', '%', 'em' ],
				'default' => ['size' => 0, 'unit' => '%'],
				'tablet_default' => ['size' => 18, 'unit' => 'px'],
				'mobile_default' => ['size' => 12, 'unit' => 'px'],
				'range' => ['px' => ['min' => -100, 'max' => 100, 'step' => 1],'%' => ['min' => -100, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .box-nav-swiper' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [	
				    'custom-box-position' => 'yes',
				],
			]
		);

		$widget->add_control(
			'show-on-over',
			[
				'label' => esc_html__( 'Show on hover', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				// 'condition' => [	
				//     'arrow-top!' => 'yes',
				// ],
			]
		);

		$widget->add_control(
			'center-on-image',
			[
				'label' => esc_html__( 'Center arrow on image', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				// 'condition' => [	
				//     'arrow-top!' => 'yes',
				// ],
			]
		);

		// $widget->add_control(
		// 	'arrow-position',
		// 	[
		// 		'label' => esc_html__( 'Arrow position', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'options' => [
		// 			'inside' => esc_html__( 'Inside Container', 'vemus-addon' ),
		// 			'middle' => esc_html__( 'Half Inside / Outside', 'vemus-addon' ),
		// 			'outside' => esc_html__( 'Outside Container', 'vemus-addon' ),
		// 		],
		// 		'default' => 'outside',
		// 		'condition' => [
		// 			'arrow-top!' => 'yes',
		// 		],
		// 	]
		// );

		$widget->add_control(
            'heading_bullet',
            [
                'label' => esc_html__( 'Bullet', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,                
                'separator' => 'before',
            ]
        );      
 
        $widget->add_control(
            'bullet_border_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
 
        $widget->add_responsive_control(
            'bullet_margin',
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
                    '{{WRAPPER}}  .sw-dot-default' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$widget->add_responsive_control(
            'width_bullet',
            [
                'label'     => esc_html__( 'Width & Height', 'vemus-addon' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .sw-dot-default .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .sw-dot-default .swiper-pagination-bullet:before' => 'width: calc( 100% - 8px ) !important; height: calc( 100% - 8px ) !important;',
                ],
            ]
        );
 
        $widget->start_controls_tabs( 'bullet_styles_tab' );
 
        $widget->start_controls_tab( 'bullet_default', [ 'label' => esc_html__( 'Normal', 'vemus-addon' ) ] );
 
        $widget->add_control(
            'bullet_background',
            [
                'label' => esc_html__( 'Background Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet:before' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );  
 
        $widget->end_controls_tab();
 
        $widget->start_controls_tab( 'bullet_active', [ 'label' => esc_html__( 'Active', 'vemus-addon' ) ] );
 
        $widget->add_control(
            'bullet_background_active',
            [
                'label' => esc_html__( 'Background Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active:before' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );  
 
        $widget->add_control(
            'bullet_border_color_active',
            [
                'label' => esc_html__( 'Border Color', 'vemus-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
 
        $widget->end_controls_tab();
 
        $widget->end_controls_tabs();

		$widget->end_controls_section();
	}

	public static function register_category_style_controls($widget){
		$widget->start_controls_section(
			'category_style_section',
			[
				'label' => esc_html__('Categories', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'category-column-gap',
			[
				'label' => esc_html__('Column Gap(px)', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => ['px'],
				'default' => ['size' => 24, 'unit' => 'px'],
				'tablet_default' => ['size' => 18, 'unit' => 'px'],
				'mobile_default' => ['size' => 12, 'unit' => 'px'],
				'range' => ['px' => ['min' => 0, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .tf-grid-layout' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'category-row-gap',
			[
				'label' => esc_html__('Row Gap(px)', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => ['px'],
				'default' => ['size' => 24, 'unit' => 'px'],
				'tablet_default' => ['size' => 18, 'unit' => 'px'],
				'mobile_default' => ['size' => 12, 'unit' => 'px'],
				'range' => ['px' => ['min' => 0, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .tf-grid-layout' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'box-padding',
			[
				'label' => __( 'Padding', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wg-cls' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'cat-background-color',
			[
				'label' => esc_html__( 'Background Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wg-cls' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$widget->add_control(
			'box-border-heading',
			[
				'label' => esc_html__( 'Border', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box-border',
				'selector' => '{{WRAPPER}} .wg-cls',
				// 'exclude' => [ 'width' ]
			]
		);

		$widget->add_control(
			'box-border-radius',
			[
				'label' => __( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wg-cls' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'category-image-heading',
			[
				'label' => esc_html__( 'Category Image', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// $widget->add_group_control(
		// 	\Elementor\Group_Control_Border::get_type(),
		// 	[
		// 		'name' => 'image-box-border',
		// 		'selector' => '{{WRAPPER}} .image-box',
		// 	]
		// );

		$widget->add_control(
			'image-box-border-radius',
			[
				'label' => __( 'Border Radius', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		if( $widget->get_name() == 'vemus_product_category_tabs_carousel' ){
			$widget->add_control(
				'title-heading',
				[
					'label' => esc_html__( 'Title', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
	
			$widget->add_control(
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
					'default' => 'center',
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .title' => 'text-align: {{VALUE}} !important;',
					],
				]
			);
	
			$widget->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title-typography',
					'selector' => '{{WRAPPER}} .title',
				]
			);
		}

		$widget->add_control(
			'category-title-heading',
			[
				'label' => esc_html__( 'Category name', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'category-title-alignment',
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
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .cat-box' => 'text-align: {{VALUE}} !important;',
					'{{WRAPPER}} .name-cls' => 'justify-content: {{VALUE}} !important;',
				],
				// 'render_type' => 'template',
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'category-title-typography',
				'selector' => '{{WRAPPER}} .name-cls',
			]
		);

		$widget->start_controls_tabs(
			'category_title_style_tabs'
		);

		$widget->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'title-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cat-title' => 'color: {{VALUE}} !important',
					// '{{WRAPPER}} .count-item' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .cat-link' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .cat-link .icon' => 'color: {{VALUE}} !important',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'title-hover-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cat-title:hover' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .cat-link:hover' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .cat-link:hover .icon' => 'color: {{VALUE}} !important',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->add_control(
			'category-count-heading',
			[
				'label' => esc_html__( 'Count item', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'category-count-typography',
				'selector' => '{{WRAPPER}} .count-item',
			]
		);

		$widget->start_controls_tabs(
			'category_count_style_tabs'
		);

		$widget->start_controls_tab(
			'count_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'count-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .count-item' => 'color: {{VALUE}} !important',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'count_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'vemus-addon' ),
			]
		);

		$widget->add_control(
			'count-hover-color',
			[
				'label' => esc_html__( 'Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .count-item:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->end_controls_section();

		$widget->start_controls_section(
			'carousel_style_section',
			[
				'label' => esc_html__('Carousel', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
				    'carousel' => 'yes'
				],
			]
		);

		$widget->add_control(
			'arrow-heading',
			[
				'label' => esc_html__( 'Arrow', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'show-on-over',
			[
				'label' => esc_html__( 'Show on hover', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$widget->add_control(
			'center-on-image',
			[
				'label' => esc_html__( 'Center arrow on image', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		// $widget->add_control(
		// 	'arrow-position',
		// 	[
		// 		'label' => esc_html__( 'Arrow position', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'options' => [
		// 			'inside' => esc_html__( 'Inside Container', 'vemus-addon' ),
		// 			'middle' => esc_html__( 'Half Inside / Outside', 'vemus-addon' ),
		// 			'outside' => esc_html__( 'Outside Container', 'vemus-addon' ),
		// 		],
		// 		'default' => 'outside',
		// 	]
		// );

		$widget->end_controls_section();
	}

	public static function register_carousel_controls($widget){

		$widget->start_controls_section(
			'section_carousels',
			[
				'label' => esc_html__('Carousel', 'vemus-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'carousel',
			[
				'label' => esc_html__( 'Carousel', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		// $widget->add_control(
		// 	'custom-responsive',
		// 	[
		// 		'label' => esc_html__( 'Custom responsive', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => esc_html__( 'On', 'vemus-addon' ),
		// 		'label_off' => esc_html__( 'Off', 'vemus-addon' ),
		// 		'return_value' => 'yes',
		// 		'default' => 'yes',
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 		],
		// 	]
		// );

		$widget->add_responsive_control(
			'carousel-slidesPerView',
			[
				'label' => esc_html__('Slides Per View', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'default' => 4,
				'tablet_default' => 3,
				'mobile_default' => 2,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'condition' => [
				    'carousel' => 'yes',
					// 'custom-responsive!' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		$widget->add_control(
			'group-slidesPerView',
			[
				'label' => esc_html__( 'Slides Per View', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'default' => '',	
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes'
				],
			]
		);

		// $widget->start_popover();

		// $widget->add_control(
		// 	'slidesPerView-xs',
		// 	[
		// 		'label' => esc_html__( 'XS (<576px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 2,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerView' =>'yes'
		// 		],
		// 	]
		// );

		// $widget->add_control(
		// 	'slidesPerView-sm',
		// 	[
		// 		'label' => esc_html__( 'SM (≥576px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 2,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerView' =>'yes'
		// 		],
		// 	]
		// );
		
		// $widget->add_control(
		// 	'slidesPerView-md',
		// 	[
		// 		'label' => esc_html__( 'MD (≥768px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 3,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerView' =>'yes'
		// 		],
		// 	]
		// );
		
		// $widget->add_control(
		// 	'slidesPerView-lg',
		// 	[
		// 		'label' => esc_html__( 'LG (≥992px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 3,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerView' =>'yes'
		// 		],
		// 	]
		// );
		
		// $widget->add_control(
		// 	'slidesPerView-xl',
		// 	[
		// 		'label' => esc_html__( 'XL (≥1200px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 4,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerView' =>'yes'
		// 		],
		// 	]
		// );
		
		// $widget->end_popover();

		$widget->add_responsive_control(
			'carousel-slidesPerGroup',
			[
				'label' => esc_html__('Slides Per Group', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 2,
				'tablet_default' => 1,
				'mobile_default' => 1,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'condition' => [
				    'carousel' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		// $widget->add_control(
		// 	'group-slidesPerGroup',
		// 	[
		// 		'label' => esc_html__( 'Slides Per Group', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
		// 		'default' => '',	
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes'
		// 		],
		// 	]
		// );

		// $widget->start_popover();

		// $widget->add_control(
		// 	'slidesPerGroup-xs',
		// 	[
		// 		'label' => esc_html__( 'XS (<576px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 2,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerGroup' =>'yes'
		// 		],
		// 	]
		// );

		// $widget->add_control(
		// 	'slidesPerGroup-sm',
		// 	[
		// 		'label' => esc_html__( 'SM (≥576px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 2,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerGroup' =>'yes'
		// 		],
		// 	]
		// );
		
		// $widget->add_control(
		// 	'slidesPerGroup-md',
		// 	[
		// 		'label' => esc_html__( 'MD (≥768px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 3,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerGroup' =>'yes'
		// 		],
		// 	]
		// );
		
		// $widget->add_control(
		// 	'slidesPerGroup-lg',
		// 	[
		// 		'label' => esc_html__( 'LG (≥992px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 3,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerGroup' =>'yes'
		// 		],
		// 	]
		// );
		
		// $widget->add_control(
		// 	'slidesPerGroup-xl',
		// 	[
		// 		'label' => esc_html__( 'XL (≥1200px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 1,
		// 		'max' => 10,
		// 		'step' => 1,
		// 		'default' => 4,
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'custom-responsive' => 'yes',
		// 			'group-slidesPerGroup' =>'yes'
		// 		],
		// 	]
		// );
		
		// $widget->end_popover();

		$widget->add_responsive_control(
			'carousel-spaceBetween',
			[
				'label' => esc_html__('Space Between(px)', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => ['desktop', 'tablet', 'mobile'],
				'size_units' => ['px'],
				'default' => ['size' => 24, 'unit' => 'px'],
				'tablet_default' => ['size' => 18, 'unit' => 'px'],
				'mobile_default' => ['size' => 12, 'unit' => 'px'],
				'range' => ['px' => ['min' => 0, 'max' => 100, 'step' => 1]],
				'min' => 0,
				'max' => 100,
				'step' => 1,
				// 'selectors' => ['{{WRAPPER}} .al-post__wrapper-inner' => 'margin: {{SIZE}}{{UNIT}};'],
				'condition' => [
				    'carousel' => 'yes',
					// 'custom-responsive!' => 'yes'
				],
				'frontend_available' => true,
			]
		);

		$widget->add_control(
			'group-spaceBetween',
			[
				'label' => esc_html__( 'Space Between(px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'default' => '',	
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes'
				],
			]
		);

		$widget->start_popover();
		
		$widget->add_control(
			'spaceBetween-xs',
			[
				'label' => esc_html__( 'Space XS (<576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [ 'size' => 12, 'unit' => 'px' ],
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-spaceBetween' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'spaceBetween-sm',
			[
				'label' => esc_html__( 'Space SM (≥576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [ 'size' => 12, 'unit' => 'px' ],
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-spaceBetween' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'spaceBetween-md',
			[
				'label' => esc_html__( 'Space MD (≥768px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [ 'size' => 12, 'unit' => 'px' ],
				// 'reset_value' => [ 'size' => 12, 'unit' => 'px' ],
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-spaceBetween' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'spaceBetween-lg',
			[
				'label' => esc_html__( 'Space LG (≥992px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [ 'size' => 12, 'unit' => 'px' ],
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-spaceBetween' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'spaceBetween-xl',
			[
				'label' => esc_html__( 'Space XL (≥1200px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [ 'size' => 24, 'unit' => 'px' ],
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-spaceBetween' =>'yes'
				],
			]
		);
		
		// $widget->add_control(
		// 	'spaceBetween-xxl',
		// 	[
		// 		'label' => esc_html__( 'Space XXL (≥1400px)', 'vemus-addon' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 	]
		// );
		
		$widget->end_popover();

		$widget->add_control(
			'carousel-speed',
			[
				'label' => esc_html__('Speed', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 800,
				'min' => 100,
				'max' => 5000,
				'step' => 100,
				'condition' => [
				    'carousel' => 'yes'
				],
			]
		);

		$widget->add_control(
			'carousel-autoplay',
			[
				'label' => esc_html__('Autoplay', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
				    'carousel' => 'yes'
				],
			]
		);

		$widget->add_control(
			'carousel-autoplay-delay',
			[
				'label' => esc_html__('Autoplay delay', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 5000,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'condition' => [
				    'carousel' => 'yes',
					'carousel-autoplay' => 'yes',
				],
			]
		);

		$widget->add_control(
			'carousel-infinite',
			[
				'label' => esc_html__('Infinite Loop', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'vemus-addon' ),
				'label_off' => esc_html__( 'Off', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
				    'carousel' => 'yes'
				],
			]
		);

		$widget->add_responsive_control(
			'carousel-navigation',
			[
				'label' => esc_html__('Navigation', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'devices' => ['desktop', 'tablet', 'mobile'],
				'return_value' => 'yes',
				'default' => 'yes',
				'tablet_default' => 'yes',
				'mobile_default' => '',
				'condition' => [
				    'carousel' => 'yes',
					// 'custom-responsive!' => 'yes'
				],
				'frontend_available' => true,
			]
		);

		$widget->add_control(
			'group-navigation',
			[
				'label' => esc_html__( 'Navigation', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'default' => '',	
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes'
				],
			]
		);

		$widget->start_popover();

		$widget->add_control(
			'navigation-xs',
			[
				'label' => esc_html__( 'XS (<576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-navigation' =>'yes'
				],
			]
		);

		$widget->add_control(
			'navigation-sm',
			[
				'label' => esc_html__( 'SM (≥576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-navigation' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'navigation-md',
			[
				'label' => esc_html__( 'MD (≥768px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-navigation' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'navigation-lg',
			[
				'label' => esc_html__( 'LG (≥992px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-navigation' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'navigation-xl',
			[
				'label' => esc_html__( 'XL (≥1200px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-navigation' =>'yes'
				],
			]
		);
		
		$widget->end_popover();

		$widget->add_responsive_control(
			'carousel-pagination-show',
			[
				'label' => esc_html__('Pagination', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'devices' => ['desktop', 'tablet', 'mobile'],
				'return_value' => 'yes',
				'default' => '',
				'tablet_default' => 'yes',
				'mobile_default' => 'yes',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive!' => 'yes'
				],
				'frontend_available' => true,
			]
		);

		$widget->add_control(
			'group-pagination',
			[
				'label' => esc_html__( 'Pagination', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'default' => '',	
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes'
				],
			]
		);

		$widget->start_popover();

		$widget->add_control(
			'pagination-xs',
			[
				'label' => esc_html__( 'XS (<576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-pagination' =>'yes'
				],
			]
		);

		$widget->add_control(
			'pagination-sm',
			[
				'label' => esc_html__( 'SM (≥576px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-pagination' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'pagination-md',
			[
				'label' => esc_html__( 'MD (≥768px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-pagination' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'pagination-lg',
			[
				'label' => esc_html__( 'LG (≥992px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-pagination' =>'yes'
				],
			]
		);
		
		$widget->add_control(
			'pagination-xl',
			[
				'label' => esc_html__( 'XL (≥1200px)', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'vemus-addon' ),
				'label_off' => esc_html__( 'No', 'vemus-addon' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
				    'carousel' => 'yes',
					'custom-responsive' => 'yes',
					'group-pagination' =>'yes'
				],
			]
		);
		
		$widget->end_popover();

		$widget->add_control(
			'carousel-pagination-type',
			[
				'label' => esc_html__('Pagination type', 'vemus-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'bullets',
				'options'     => [
					// 'none' => esc_html__( 'None', 'vemus-addon' ),
					'bullets' => esc_html__( 'Bullets', 'vemus-addon' ),
					'progressbar' => esc_html__( 'Progressbar', 'vemus-addon' ),
					'fraction' => esc_html__( 'Fraction', 'vemus-addon' ),
				],
				'condition' => [
				    'carousel' => 'yes',
				],
			]
		);

		// $widget->add_responsive_control(
		// 	'carousel-pagination',
		// 	[
		// 		'label' => esc_html__('Pagination', 'vemus-addon'),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'devices' => ['desktop', 'tablet', 'mobile'],
		// 		'default' => 'bullets',
		// 		'tablet_default' => 'bullets',
		// 		'mobile_default' => '',
		// 		'options'     => [
		// 			'none' => esc_html__( 'None', 'vemus-addon' ),
		// 			'bullets' => esc_html__( 'Bullets', 'vemus-addon' ),
		// 			'progressbar' => esc_html__( 'Progressbar', 'vemus-addon' ),
		// 			'fraction' => esc_html__( 'Fraction', 'vemus-addon' ),
		// 		],
		// 		'condition' => [
		// 		    'carousel' => 'yes',
		// 			'auto-responsive!' => 'yes'
		// 		],
		// 		'frontend_available' => true,
		// 	]
		// );

		$widget->end_controls_section();
	}

	public static function get_tab_contents() {
		check_ajax_referer('tfwc_vemus_get_tabs_nonce', 'security');

		$data = $_POST['args'];

		$num_product = !empty($data['num_product']) ? sanitize_text_field($data['num_product']) : 1;
		$product_type = !empty($data['product_type']) ? $data['product_type'] : 'recent_products';
		$categories = !empty($data['categories']) ? (array) $data['categories'] : [];
		$brands = !empty($data['brands']) ? (array) $data['brands'] : [];
		$tags = !empty($data['tags']) ? (array) $data['tags'] : [];
		$product_ids = !empty($data['product_ids']) ? (array) $data['product_ids'] : [];
		$order_by = !empty($data['order_by']) ? sanitize_text_field($data['order_by']) : 'default';
		$order = !empty($data['order']) ? sanitize_text_field($data['order']) : 'asc';
		$product_style = !empty($data['product_style']) ? sanitize_text_field($data['product_style']) : 'style-1';
		$product_grid_classes = !empty($data['product_grid_classes']) ? sanitize_text_field($data['product_grid_classes']) : '';
		$card_params = !empty($data['card_params']) ? (array) $data['card_params'] : [];
		$carousel_configs = !empty($data['carousel_configs']) ? (array) $data['carousel_configs'] : [];

		$args = [
			'post_type'      => 'product',
			'status' => 'published',
			'posts_per_page' => $num_product,
			'order'       => $order,
		];

		$tax_query = [];

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

		if (!empty($product_ids) && $product_type== "custom-products" ) {
			$args['post__in'] = $product_ids;
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

		ob_start();
		?>
		
		<?php //echo wp_sprintf( self::get_product_grid_content($args, $product_style, $product_grid_classes, json_encode($carousel_configs), $card_params) ); ?>
		<?php echo ( self::get_product_grid_content($args, $product_style, $product_grid_classes, json_encode($carousel_configs), $card_params) ); ?>

		<?php
		wp_send_json_success(
			[
				'message' => 'success',
				'content' => ob_get_clean(),
			]
		);
	}

	public static function convertToAspectRatio($input) {

		if( is_numeric( $input ) ){
			return $input;
		}

		$aspect_ratio = '1/1';

		$parts = explode('/', $input);

		if (count($parts) != 2) {
			$parts = explode(':', $input);
		}

		if (count($parts) == 2) {
			$width = max( floatval($parts[0]), 1);
			$height = max( floatval($parts[1]), 1);
			$aspect_ratio = $width . '/' . $height;
		}

		return $aspect_ratio;
	}

	public function add_max_swatches(){
		add_filter( 'wcboost_variation_swatches_color_html', [ $this , 'max_swatches'], 99, 4);
		add_filter( 'wcboost_variation_swatches_button_html', [ $this , 'max_swatches'], 99, 4);
		add_filter( 'wcboost_variation_swatches_image_html', [ $this , 'max_swatches'], 99, 4);
		add_filter( 'wcboost_variation_swatches_label_html', [ $this , 'max_swatches'], 99, 4);
		add_filter( 'wcboost_variation_swatches_select_html', [ $this , 'max_swatches'], 99, 4);
	}

	public function remove_max_swatches(){
		remove_filter( 'wcboost_variation_swatches_color_html', [ $this , 'max_swatches'], 99, 4);
		remove_filter( 'wcboost_variation_swatches_button_html', [ $this , 'max_swatches'], 99, 4);
		remove_filter( 'wcboost_variation_swatches_image_html', [ $this , 'max_swatches'], 99, 4);
		remove_filter( 'wcboost_variation_swatches_label_html', [ $this , 'max_swatches'], 99, 4);
		remove_filter( 'wcboost_variation_swatches_select_html', [ $this , 'max_swatches'], 99, 4);
	}

	public function max_swatches( $html, $args, $data, $term ){
		if(!empty($args['option__in'])){
			$value = is_object( $term ) ? $term->slug : $term;
			if ( !in_array($value, $args['option__in'] ) ){
				return '';
			}
		}
		return $html;
	}

	public static function get_carousel_configs($widget, $tab_id = false){
		$settings = $widget->get_settings_for_display();
		$widget_id = $widget->get_id();

		$custom_responsive = !empty($settings['custom-responsive']) ? $settings['custom-responsive'] : false;
		$slides_per_view_desktop = !empty($settings['carousel-slidesPerView']) ? $settings['carousel-slidesPerView'] : 5;
		$slides_per_view_tablet = !empty($settings['carousel-slidesPerView_tablet']) ? $settings['carousel-slidesPerView_tablet'] : 3;
		$slides_per_view_mobile = !empty($settings['carousel-slidesPerView_mobile']) ? $settings['carousel-slidesPerView_mobile'] : 2;

		$slides_per_group_desktop = !empty($settings['carousel-slidesPerGroup']) ? $settings['carousel-slidesPerGroup'] : 2;
		$slides_per_group_tablet = !empty($settings['carousel-slidesPerGroup_tablet']) ? $settings['carousel-slidesPerGroup_tablet'] : 1;
		$slides_per_group_mobile = !empty($settings['carousel-slidesPerGroup_mobile']) ? $settings['carousel-slidesPerGroup_mobile'] : 1;

		$space_between_desktop = !empty($settings['carousel-spaceBetween']) ? $settings['carousel-spaceBetween']['size'] : 0;
		
		$space_between_tablet = !empty($settings['carousel-spaceBetween_tablet']) ? $settings['carousel-spaceBetween_tablet']['size'] : 0;
		$space_between_mobile = !empty($settings['carousel-spaceBetween_mobile']) ? $settings['carousel-spaceBetween_mobile']['size'] : 0;

		$carousel_navigation_desktop = !empty($settings['carousel-navigation']) ? $settings['carousel-navigation'] : false;
		$carousel_navigation_tablet = !empty($settings['carousel-navigation_tablet']) ? $settings['carousel-navigation_tablet'] : false;
		$carousel_navigation_mobile =!empty($settings['carousel-navigation_mobile']) ? $settings['carousel-navigation_mobile'] : false;

		$carousel_pagination_type = !empty($settings['carousel-pagination-type']) ? $settings['carousel-pagination-type'] : false;
		$carousel_pagination_desktop = !empty($settings['carousel-pagination-show']) ? $settings['carousel-pagination-show'] : false;
		$carousel_pagination_tablet =!empty($settings['carousel-pagination-show_tablet']) ? $settings['carousel-pagination-show_tablet'] : false;
		$carousel_pagination_mobile =!empty($settings['carousel-pagination-show_mobile']) ? $settings['carousel-pagination-show_mobile'] : false;

		$auto_play = !empty($settings['carousel-autoplay']) ? $settings['carousel-autoplay'] : false;
		$infinite = !empty($settings['carousel-infinite']) ? $settings['carousel-infinite'] : false;

		// $carousel_pagination_type_desktop = !empty($settings['carousel-pagination-type']) ? $settings['carousel-pagination-type'] : 'bullets';
		// $carousel_pagination_type_tablet = !empty($settings['carousel-pagination-type_tablet']) ? $settings['carousel-pagination-type_tablet'] : $carousel_pagination_type_desktop;
		// $carousel_pagination_type_mobile = !empty($settings['carousel-pagination-type_mobile']) ? $settings['carousel-pagination-type_mobile'] : $carousel_pagination_type_desktop;

		$carousel_speed = !empty($settings['carousel-speed']) ? $settings['carousel-speed'] : 800;

		$carousel_autoplay_delay = !empty($settings['carousel-autoplay-delay']) ? $settings['carousel-autoplay-delay'] : 5000;

		if( empty($custom_responsive)){
			$configs = [
				"slidesPerView" => $slides_per_view_mobile,
				"slidesPerGroup" => $slides_per_group_mobile,
				"spaceBetween" => $space_between_mobile,
				"speed" => $carousel_speed,
				"navigation" => [
					// "nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
					// "prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
					"nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id",
					"prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id",
				],
				"pagination" => [
					"el" => ".tf-sw-pagination",
					"clickable" => true,
					"type" => $carousel_pagination_type,
				],
				"observer" => true,
				"observeParents" => true,
				"breakpoints" => [
					"125" => [ 
						"slidesPerView" => $slides_per_view_mobile,
						"slidesPerGroup" => $slides_per_group_mobile,
						"spaceBetween" => $space_between_mobile,
						"navigation_responsive" => empty($carousel_navigation_mobile) ? false : [
							// "nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
							// "prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
							"nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id",
							"prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id",
						],	
						"pagination_responsive" => empty($carousel_pagination_mobile) ? false : true,
					],
					"768" => [ 
						"slidesPerView" => $slides_per_view_tablet,
						"slidesPerGroup" => $slides_per_group_tablet,
						"spaceBetween" => $space_between_tablet,
						"navigation_responsive" => empty($carousel_navigation_tablet) ? false : [
							// "nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
							// "prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
							"nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id",
							"prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id",
						],
						"pagination_responsive" => empty($carousel_pagination_tablet) ? false : true,
					],
					"1024" => [
						"slidesPerView" => $slides_per_view_desktop,
						"slidesPerGroup" => $slides_per_group_desktop,
						"spaceBetween" => $space_between_desktop,
						"navigation_responsive" => empty($carousel_navigation_desktop) ? false : [
							// "nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
							// "prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
							"nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id",
							"prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id",
						],
						"pagination_responsive" => empty($carousel_pagination_desktop) ? false : true,
					]
				]
			];
		}else{
			$group_spacebetween = !empty($settings['group-spaceBetween']) ? $settings['group-spaceBetween'] : false;
			$group_navigation = !empty($settings['group-navigation']) ? $settings['group-navigation'] : false;
			$group_pagination = !empty($settings['group-pagination']) ? $settings['group-pagination'] : false;
			
			if( $group_spacebetween){
				$space_between_xs = !empty($settings['spaceBetween-xs']) ? $settings['spaceBetween-xs']['size'] : 0;
				$space_between_sm = !empty($settings['spaceBetween-sm']) ? $settings['spaceBetween-sm']['size'] : 0;
				$space_between_md = !empty($settings['spaceBetween-md']) ? $settings['spaceBetween-md']['size'] : 0;
				$space_between_lg = !empty($settings['spaceBetween-lg']) ? $settings['spaceBetween-lg']['size'] : 0;
				$space_between_xl = !empty($settings['spaceBetween-xl']) ? $settings['spaceBetween-xl']['size'] : 0;
			}else{
				$space_between_xs = 12;
				$space_between_sm = 12;
				$space_between_md = 12;
				$space_between_lg = 12;
				$space_between_xl = 24;
			}

			$slides_per_view_xs = !empty($settings['slidesPerView-xs']) ? $settings['slidesPerView-xs'] : 2;
			$slides_per_view_sm = !empty($settings['slidesPerView-sm']) ? $settings['slidesPerView-sm'] : 2;
			$slides_per_view_md = !empty($settings['slidesPerView-md']) ? $settings['slidesPerView-md'] : 3;
			$slides_per_view_lg = !empty($settings['slidesPerView-lg']) ? $settings['slidesPerView-lg'] : 3;
			$slides_per_view_xl = !empty($settings['slidesPerView-xl']) ? $settings['slidesPerView-xl'] : 4;
			
			$slides_per_group_xs = !empty($settings['slidesPerGroup-xs']) ? $settings['slidesPerGroup-xs'] : 2;
			$slides_per_group_sm = !empty($settings['slidesPerGroup-sm']) ? $settings['slidesPerGroup-sm'] : 2;
			$slides_per_group_md = !empty($settings['slidesPerGroup-md']) ? $settings['slidesPerGroup-md'] : 3;
			$slides_per_group_lg = !empty($settings['slidesPerGroup-lg']) ? $settings['slidesPerGroup-lg'] : 3;
			$slides_per_group_xl = !empty($settings['slidesPerGroup-xl']) ? $settings['slidesPerGroup-xl'] : 4;

			if($group_navigation){
				$navigation_xs = !empty($settings['navigation-xs']) ? $settings['navigation-xs'] : false;
				$navigation_sm = !empty($settings['navigation-sm']) ? $settings['navigation-sm'] : false;
				$navigation_md = !empty($settings['navigation-md']) ? $settings['navigation-md'] : false;
				$navigation_lg = !empty($settings['navigation-lg']) ? $settings['navigation-lg'] : false;
				$navigation_xl = !empty($settings['navigation-xl']) ? $settings['navigation-xl'] : false;
			}else{
				$navigation_xs = false;
				$navigation_sm = false;
				$navigation_md = false;
				$navigation_lg = false;
				$navigation_xl = true;
			}
			
			if($group_pagination){
				$pagination_xs = !empty($settings['pagination-xs']) ? $settings['pagination-xs'] : false;
				$pagination_sm = !empty($settings['pagination-sm']) ? $settings['pagination-sm'] : false;
				$pagination_md = !empty($settings['pagination-md']) ? $settings['pagination-md'] : false;
				$pagination_lg = !empty($settings['pagination-lg']) ? $settings['pagination-lg'] : false;
				$pagination_xl = !empty($settings['pagination-xl']) ? $settings['pagination-xl'] : false;
			}else{
				$pagination_xs = true;
				$pagination_sm = true;
				$pagination_md = true;
				$pagination_lg = true;
				$pagination_xl = false;
			}

			$configs = [
				"customResponsive" => true,
				"slidesPerView" => $slides_per_view_xs,
				"slidesPerGroup" => $slides_per_group_xs,
				"spaceBetween" => $space_between_xs,
				"speed" => $carousel_speed,
				"navigation" => [
					// "nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
					// "prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id" . ( $tab_id ? ".in-tab-$tab_id" : ""),
					"nextEl" => ".vemus-swiper-button-next.swiper-button-next-element-$widget_id",
					"prevEl" => ".vemus-swiper-button-prev.swiper-button-prev-element-$widget_id",
				],
				"pagination" => [
					"el" => ".tf-sw-pagination",
					"clickable" => true,
					"type" => $carousel_pagination_type,
				],
				"observer" => true,
				"observeParents" => true,
			];

			$configs['breakpoints'] = [
				"125" => [
					"navigation_responsive" => empty($navigation_xs) ? false : true,
					"pagination_responsive" => empty($pagination_xs) ? false : true,
					"slidesPerView" => $slides_per_view_xs,
					"slidesPerGroup" => $slides_per_group_xs,
					"spaceBetween" => $space_between_xs,
				],
				"576" => [
					"slidesPerView" => $slides_per_view_sm,
					"slidesPerGroup" => $slides_per_group_sm,
					"spaceBetween" => $space_between_sm,
					"navigation_responsive" => empty($navigation_sm) ? false : true,
					"pagination_responsive" => empty($pagination_sm) ? false : true,
				],
				"768" => [
					"slidesPerView" => $slides_per_view_md,
					"slidesPerGroup" => $slides_per_group_md,
					"spaceBetween" => $space_between_md,
					"navigation_responsive" => empty($navigation_md) ? false : true,
					"pagination_responsive" => empty($pagination_md) ? false : true,
				],
				"992" => [
					"slidesPerView" => $slides_per_view_lg,
					"slidesPerGroup" => $slides_per_group_lg,
					"spaceBetween" => $space_between_lg,
					"navigation_responsive" => empty($navigation_lg) ? false : true,
					"pagination_responsive" => empty($pagination_lg) ? false : true,
				],
				"1200" => [
					"slidesPerView" => $slides_per_view_xl,
					"slidesPerGroup" => $slides_per_group_xl,
					"spaceBetween" => $space_between_xl,
					"navigation_responsive" => empty($navigation_xl) ? false : true,
					"pagination_responsive" => empty($pagination_xl) ? false : true,
				],
			];
		}

		if( !empty($auto_play) ){
			$configs["autoplay"] = [
				"delay" => $carousel_autoplay_delay,
			];
		}
		
		if( !empty($infinite) ){
			$configs["loop"] = true;
		}
		
		return json_encode($configs) ;
	}

	public static function get_product_categories($args=[]) {

		if( empty($args) ){
			$args = [
				'taxonomy' => 'product_cat',
				'hide_empty' => false,	
			];
		}

		$categories = get_terms($args);
	
		$category_options = [];

		if (!is_wp_error($categories) && !empty($categories)) {
			foreach ($categories as $category) {
				if( empty($args['get_image']) ){
					// $category_options[$category->term_id] = esc_html($category->name);
					$category_options[$category->slug] = esc_html($category->name);
				}else{
					$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
					$thumbnail_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
					// $category_options[$category->term_id] = [
					// 	'name' => esc_html($category->name),
					// 	'image' => empty($thumbnail_url) ? \Elementor\Utils::get_placeholder_image_src() : $thumbnail_url,
					// 	'url' => get_term_link($category->term_id, 'product_cat'),
					// 	'count' => $category->count,
					// ];
					$category_options[$category->slug] = [
						'name' => esc_html($category->name),
						'image' => empty($thumbnail_url) ? \Elementor\Utils::get_placeholder_image_src() : $thumbnail_url,
						'url' => get_term_link($category->term_id, 'product_cat'),
						'count' => $category->count,
						'description' => esc_html($category->description),
					];
				}
			}
		}
	
		return $category_options;
	}

	public static function tf_get_taxonomies( $category = 'category' ){
		$category_posts = get_terms( 
			array(
				'taxonomy' => $category,
			)
		);
		
		foreach ( $category_posts as $category_post ) {
			$category_posts_name[$category_post->slug] = $category_post->name;      
		}
		return $category_posts_name;
	}

	public static function get_product_brands() {
		$brands = get_terms([
			'taxonomy' => 'product_brand',
			'hide_empty' => false,
		]);
	
		$brand_options = [];
		
		if (!is_wp_error($brands) && !empty($brands)) {
			foreach ($brands as $brand) {
				// $brand_options[$brand->term_id] = esc_html($brand->name);
				$brand_options[$brand->slug] = esc_html($brand->name);
			}
		}
	
		return $brand_options;
	}

	public static function get_product_tags() {
		$tags = get_terms([
			'taxonomy' => 'product_tag',
			'hide_empty' => false	,
		]);
	
		$tag_options = [];
		
		if (!is_wp_error($tags) && !empty($tags)) {
			foreach ($tags as $tag) {
				// $tag_options[$tag->term_id] = esc_html($tag->name);
				$tag_options[$tag->slug] = esc_html($tag->name);
			}
		}
	
		return $tag_options;
	}

	public static function get_products($args = false) {

		if(empty($args)){
			$args = [
				'post_type'   => 'product',
				'post_status' => 'publish',
				'numberposts' => -1,
			];
		}
	
		$products = get_posts($args);
	
		$product_options = [];
	
		if (!empty($products)) {
			foreach ($products as $product) {
				$product_options[$product->ID] = esc_html(get_the_title($product->ID));
			}
		}
	
		return $product_options;
	}

	public static function get_product_grid_content($args = [], $product_style='style-1', $product_grid_classes='', $configs = '{}', $card_params = [] ){

		foreach ($card_params as $key => $value) {
			if ($value === 'false') {
				$card_params[$key] = false;
			} elseif ($value === 'true') {
				$card_params[$key] = true;
			}
		}

		$carousel_configs = json_decode($configs, true);
		$custom_responsive = !empty($carousel_configs['customResponsive']) ? $carousel_configs['customResponsive'] : false;

		$nav_responsive_classes = "";
		$pagi_responsive_classes = "d-xl-none";
		// if( !$custom_responsive ){
		// 	$nav_responsive_classes .= " d-none d-xl-flex";
		// 	$pagi_responsive_classes .= " d-flex d-xl-none";
		// }else{
		// 	$nav_responsive_classes .= " hidden";
		// 	$pagi_responsive_classes .= " hidden";
		// }
		// $nav_responsive_classes = " hidden";
		// $pagi_responsive_classes = " hidden";
		$query = new WP_Query($args);

		ob_start();

		self::instance()->add_woo_hook();
	
		if ($query->have_posts()) {
			?>
			<div class="wrapper-control-shop gridLayout-wrapper vemus-product-grid <?php echo empty($card_params['has_carousel']) ? "" : "swiper tf-swiper2 vemus-product-swiper wrap-sw-over";?>" data-swiper-configs='<?php echo $configs; ?>'
				data-preview="4"
				data-tablet="3"
				data-mobile-sm="2"
				data-mobile="2"
				data-space-lg="30"
				data-space-md="20"
				data-space="15"
				data-pagination="2"
				data-pagination-sm="2"
				data-pagination-md="3"
				data-pagination-lg="4"
			>
				<div class="<?php echo $product_grid_classes; ?>">
					<?php
						while ($query->have_posts()) {
							$query->the_post();
							wc_get_template(
								'content-product-' . $product_style .'.php',	
								$card_params,
								TF_PLUGIN_PATH . 'includes/elementor-widget/templates/product/',
								TF_PLUGIN_PATH . 'includes/elementor-widget/templates/product/',
							);							
						}
					?>
				</div>
				<?php if( !empty($card_params['has_carousel']) ){?>
					<!-- <div class="<?php echo esc_attr($pagi_responsive_classes); ?> sw-pagination-top-pick position-relative swiper-pagination swiper-pagination-horizontal sw-dot-default sw-pagination-tes justify-content-center"></div> -->
					<div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
				<?php }?>
		</div>

		<?php if( !empty($card_params['has_carousel'])  && empty($card_params['arrow_top']) ){?>
			<div class="<?php echo esc_attr($nav_responsive_classes); ?> nav-swiper style-2 nav-prev-swiper relative d-none d-xl-flex vemus-swiper-button-prev swiper-button-prev-element-<?php echo esc_attr( $card_params['id'] );?>">
				<i class="icon-arrow-left"></i>
			</div>
			<div class="<?php echo esc_attr($nav_responsive_classes); ?> nav-swiper style-2 nav-next-swiper relative d-none d-xl-flex vemus-swiper-button-next swiper-button-next-element-<?php echo esc_attr( $card_params['id'] );?>">
				<i class="icon-arrow-right"></i>
			</div>
		<?php }?>
		<?php if( !empty($card_params['has_carousel']) && !empty($card_params['arrow_top']) ){?>

			<div class="group-btn-slider">
				<div class="nav-prev-swiper tf-sw-nav vemus-swiper-button-prev relative swiper-button-prev-element-<?php echo esc_attr( $card_params['id'] );?>">
					<i class="icon-arrow-left"></i>
				</div>
				<div class="nav-next-swiper tf-sw-nav vemus-swiper-button-next relative swiper-button-next-element-<?php echo esc_attr( $card_params['id'] );?>">
					<i class="icon-arrow-right"></i>
				</div>
			</div>
		<?php }?>
		<?php

		} else {
			echo '<p>Not found product.</p>';
		}
	
		wp_reset_postdata();

		self::instance()->remove_woo_hook();

		return ob_get_clean();
	}

	public static function get_product_category_content($categories, $product_category_classes='', $configs = '{}', $card_params = []){
		$carousel_configs = json_decode($configs, true);
		$auto_responsive = !empty($carousel_configs['autoResponsive']) ? $carousel_configs['autoResponsive'] : false;

		// $nav_responsive_classes = "";
		// $pagi_responsive_classes = "";
		// if( $auto_responsive ){
		// 	$nav_responsive_classes .= " d-none d-xl-flex";
		// 	$pagi_responsive_classes .= " d-flex d-xl-none";
		// }else{
		// 	$nav_responsive_classes .= " hidden";
		// 	$pagi_responsive_classes .= " hidden";
		// }
		$nav_responsive_classes = " hidden";
		$pagi_responsive_classes = " hidden";

		ob_start();
		
		?>
		<div class="<?php echo empty($card_params['has_carousel']) ? "" : "swiper tf-swiper vemus-product-swiper tf-sw-right wrap-sw-over";?> <?php echo empty($card_params['show_on_hover']) ? "" : "hover-sw-nav hover-sw-2";?>" data-swiper-configs='<?php echo $configs; ?>'>
			<div class="<?php echo $product_category_classes; ?>">
			<?php
				foreach( $categories as $key => $category){
					wc_get_template(
						'content-product-category.php',	
						array_merge(
							$card_params,
							[
								'category' => $category
							]
						),
						TF_PLUGIN_PATH . 'includes/elementor-widget/templates/category/',
						TF_PLUGIN_PATH . 'includes/elementor-widget/templates/category/',
					);
				}
				?>
			</div>
			<?php if( !empty($card_params['has_carousel']) ){?>
				<div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
			<?php }?>
		</div>
		<?php if( !empty($card_params['has_carousel']) ){?>
			<div class="<?php echo esc_attr($nav_responsive_classes); ?> nav-swiper style-2 nav-prev-swiper relative d-none d-xl-flex vemus-swiper-button-prev swiper-button-prev-element-<?php echo esc_attr( $card_params['id'] );?>">
				<i class="icon-arrow-left"></i>
			</div>
			<div class="<?php echo esc_attr($nav_responsive_classes); ?> nav-swiper style-2 nav-next-swiper relative d-none d-xl-flex vemus-swiper-button-next swiper-button-next-element-<?php echo esc_attr( $card_params['id'] );?>">
				<i class="icon-arrow-right"></i>
			</div>
		<?php }?>
		<?php
	
		wp_reset_postdata();

		return ob_get_clean();
	}

}