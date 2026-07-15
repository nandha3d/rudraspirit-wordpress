<?php

defined( 'ABSPATH' ) || exit;

class Woo_Single_Product_Hook {

    protected static $instance = null;
    
    public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

    public function __construct() {

        add_action( 'after_setup_theme', function(){
            $this->init_actions();
            $this->init_size_guide();
            $this->init_volume_discount();
            $this->init_buy_now();
            $this->init_product_together();
            $this->init_buyx_gety();
            $this->init_product_video();
            $this->init_product_3d_viewer();
            $this->init_quick_add();
        });
    }

    public function init_actions(){

        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 99);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'], 99);
        add_action( 'after_setup_theme', [$this, 'single_setup_theme'] );
        add_action( 'template_redirect', [$this, 'tf_buy_now'] );
        // add_action('wp', [$this, 'remove_shop_actions'], 8 );
        add_action('woocommerce_before_single_product', [$this, 'custom_woocommerce_hooks_on_single_product']);
        add_filter('pickup_location_save_location', [$this, 'admin_local_pickup']);

    }

    public function admin_enqueue_scripts($hook){
        
        if (get_post_type() === 'tf_size_guide') {
            wp_enqueue_script('themesflat-size-guide', THEMESFLAT_LINK . 'assets/js/admin/size-guide.js', array('jquery'),null,true);
            wp_enqueue_style('themesflat-size-guide', THEMESFLAT_LINK . 'assets/css/admin/size-guide.css');
            
        }

        if (get_post_type() === 'tf_volume_discount') {
            wp_enqueue_media();
            wp_enqueue_script('select2', THEMESFLAT_LINK . 'assets/js/admin/3rd/select2.min.js', array('jquery'),null,true);
            wp_enqueue_style('select2', THEMESFLAT_LINK . 'assets/css/admin/3rd/select2.min.css');

            $params = [
                'ajax_url' => admin_url('admin-ajax.php'),
                'tf_search_products_nonce'    => wp_create_nonce('tf_search_products_nonce')
                
            ];
            wp_enqueue_script('themesflat-volume-discount', THEMESFLAT_LINK . 'assets/js/admin/volume-discount.js', array('select2'), null, true);
            wp_localize_script('themesflat-volume-discount', 'tfWooParams', $params);
            wp_enqueue_style('themesflat-volume-discount', THEMESFLAT_LINK . 'assets/css/admin/volume-discount.css');
        }

        if ('post.php' == $hook || 'product' == get_post_type()) {
            wp_enqueue_media();
            wp_enqueue_script('themesflat-size-guide', THEMESFLAT_LINK . 'assets/js/admin/custom-edit-product.js', array('jquery'), null, true);
            wp_enqueue_style('themesflat-size-guide', THEMESFLAT_LINK . 'assets/css/admin/custom-edit-product.css');
        }
    }

    public function enqueue_scripts(){
        $this->remove_woocommerce_styles_scripts();
        wp_enqueue_script( 'wc-add-to-cart-variation' );
        if ( ! wp_script_is( 'themesflat-variation-swatch', 'registered' ) ) {
            wp_register_script('themesflat-variation-swatch', THEMESFLAT_LINK . 'assets/js/frontend/single-product/variation-swatch.js', array('jquery', 'wcboost-variation-swatches'),time(),true);
        }
        if(is_product()){

            $script_depends = [
                'themesflat-toast',
                'themesflat-bootstrap',
            ];

            $currency_settings = array(
                'currency_symbol'      => html_entity_decode(get_woocommerce_currency_symbol(), ENT_QUOTES, 'UTF-8'),
                'currency_position'    => get_option('woocommerce_currency_pos'), // left, right, left_space, right_space
                'thousand_separator'   => wc_get_price_thousand_separator(),
                'decimal_separator'    => wc_get_price_decimal_separator(),
                'decimal_count'        => wc_get_price_decimals(),
            );

            $params = [
                'cart_url' => wc_get_cart_url(),
                'checkout_url' => wc_get_checkout_url(),
                'ajax_url' => admin_url('admin-ajax.php'),
                'currency_settings' => $currency_settings,
                'tf_get_variation_gallery_nonce'    => wp_create_nonce('tf_get_variation_gallery_nonce'),
                'tf_product_fbt_nonce'    => wp_create_nonce('tf_product_fbt_nonce'),
                'tf_add_buyx_gety_bundle_nonce'    => wp_create_nonce('tf_add_buyx_gety_bundle_nonce'),
                'tf_get_quick_add_nonce'    => wp_create_nonce('tf_get_quick_add_nonce'),
                'tf_get_size_guide_nonce'    => wp_create_nonce('tf_get_size_guide_nonce')
                
            ];

            $gallery_layout = empty($_GET['gallery_layout']) ? themesflat_get_opt('tf_product_gallery_layout') :  $_GET['gallery_layout'];

            if( $gallery_layout == "left_thumb" || $gallery_layout == "right_thumb" || $gallery_layout == "bottom_thumb" || true ){
                // wp_enqueue_script('themesflat-swiper', THEMESFLAT_LINK . 'js/3rd/swiper-bundle.min.js', array(),'',true);
                // wp_enqueue_style('themesflat-swiper', THEMESFLAT_LINK . 'css/3rd/swiper-bundle.min.css');
                $script_depends[] = 'themesflat-swiper';
                $params['thumb_swiper'] = $gallery_layout;
            }

            if(themesflat_get_opt('tf_variation_gallery')){
                $params['variation_gallery'] = true;
            }

            if(themesflat_get_opt('tf_product_3d')){
                wp_enqueue_script('themesflat-model-viewer', THEMESFLAT_LINK . 'assets/js/3rd/model-viewer-umd.js', array(),'',true);
                $script_depends[] = 'themesflat-model-viewer';
                $params['model_viewer'] = true;
            }

            $zoom_style = empty($_GET['zoom_style']) ? themesflat_get_opt('tf_product_gallery_zoom') :  $_GET['zoom_style'];

            if( !empty($zoom_style) ){
                wp_enqueue_script('themesflat-drift', THEMESFLAT_LINK . 'assets/js/3rd/drift.min.js', array(),'',true);
                wp_enqueue_style('themesflat-drift', THEMESFLAT_LINK . 'assets/css/3rd/drift-basic.min.css');
                $script_depends[] = 'themesflat-drift';
                $params['zoom'] = $zoom_style;
            }

            if( themesflat_get_opt('tf_product_gallery_lightbox') ){
                wp_enqueue_script('themesflat-photoswipe', THEMESFLAT_LINK . 'assets/js/3rd/photoswipe.umd.min.js', array(),'',true);
                wp_enqueue_script('themesflat-photoswipe-lightbox', THEMESFLAT_LINK . 'assets/js/3rd/photoswipe-lightbox.umd.min.js', array('themesflat-photoswipe'),'',true);
                wp_enqueue_style('themesflat-photoswipe', THEMESFLAT_LINK . 'assets/css/3rd/photoswipe.min.css');

                $script_depends[] = 'themesflat-photoswipe-lightbox';
                $params['lightbox'] = true;
            }

            if(themesflat_get_opt('tf_buy_now') && !empty(themesflat_get_opt('tf_buy_now_query_arg')) ){
                $params['buy_now'] = themesflat_get_opt('tf_buy_now_query_arg');
            }

            if(themesflat_get_opt('tf_volume_discount')){
                $params['volume_discount'] = true;
            }

            wp_enqueue_script('themesflat-variation-swatch');
            wp_enqueue_script('themesflat-single-product', THEMESFLAT_LINK . 'assets/js/frontend/single-product/single-product.js', $script_depends,'',true);
            wp_localize_script('themesflat-single-product', 'tfWooParams', $params);

            wp_enqueue_style('themesflat-zoom', THEMESFLAT_LINK . 'assets/css/frontend/single-product/zoom.css');
            
        }
        if(!is_singular('post')) {
            wp_enqueue_style('themesflat-single-style', THEMESFLAT_LINK . 'assets/css/vemus-single-product.min.css');
        }

         if( is_rtl() ){
            wp_style_add_data( 'themesflat-single-style', 'rtl', 'replace' );
            wp_style_add_data( 'themesflat-single-product', 'rtl', 'replace' );
        }
        
    }

    public function single_setup_theme(){
        if(themesflat_get_opt('tf_wishlist')){
            $theme_support_woo =  get_theme_support( 'woocommerce' );
            if ( is_array( $theme_support_woo ) ) {
                $theme_support_woo['wishlist'] = [
                    'single_button_position' => 'theme'
                ];
            }else{
                $theme_support_woo = [
                    'wishlist' => [
                        'single_button_position' => 'theme'
                    ]
                ];
            }
            add_theme_support( 'woocommerce', $theme_support_woo );
        }
    }

    public function admin_local_pickup($location){
        if (isset($_POST['pickup_phone'])) {
            $location['pickup_phone'] = sanitize_text_field($_POST['pickup_phone']);
        }
        if (isset($_POST['pickup_map_url'])) {
            $location['pickup_map_url'] = esc_url_raw($_POST['pickup_map_url']);
        }
        return $location;
    }

    public function remove_shop_actions(){
        if(is_product()){
            if(themesflat_get_opt('tf_wishlist')){
                // themesflat_remove_hook( 'wcboost_wishlist_loop_add_to_wishlist_link', 'tfwc_wishlish_button', 20 );
            }
        }
    }

    public function init_size_guide() {
        
        if(!themesflat_get_opt('tf_size_guide')){
            return;
        }

        add_action('wp_footer', [$this, 'size_guide_quick_view_popup'] );

        add_action('save_post', [$this, 'save_size_guide_data'], 10, 3);

        // Add product data tabs
        add_action('woocommerce_product_data_tabs', [$this, 'add_size_guide_product_tab']);

        // Display the content
        add_action( 'woocommerce_product_data_panels', [$this,'display_size_guide_product_data_tab_content'] );
        
        // Save field values
        add_action( 'woocommerce_admin_process_product_object', [$this, 'save_size_guide_fields_values'] );

        add_action('wp_ajax_tf_get_size_guide',  [$this, 'tf_size_guide_ajax']);
        add_action('wp_ajax_nopriv_tf_get_size_guide',  [$this, 'tf_size_guide_ajax']);
        
    }

    public function init_variation_gallery() {
        if(!themesflat_get_opt('tf_variation_gallery')){
            return;
        }

        add_action('woocommerce_variation_options', [$this, 'add_variation_gallery_metabox'], 10, 3);

        add_action('woocommerce_save_product_variation', [$this, 'save_variation_gallery_metabox'], 10, 2);

        add_action( 'wc_ajax_tf_get_variation_gallery', [$this, 'tf_get_variation_gallery'] );
    }

    public function init_product_together() {
        if(!themesflat_get_opt('tf_buy_together')){
            return;
        }
        add_action( 'woocommerce_product_options_related', array( $this, 'add_product_together_metabox' ) );
        add_action('woocommerce_admin_process_product_object', [$this, 'save_product_together_metabox']);
        add_filter('woocommerce_json_search_found_products', [$this, 'tf_json_search_found_products']);
        add_action( 'wc_ajax_tf_product_fbt', [$this, 'tf_product_fbt'] );
    }

    public function init_buyx_gety() {
        if(!themesflat_get_opt('tf_buyx_gety')){
            return;
        }
        
        add_action( 'woocommerce_product_options_related', array( $this, 'add_buyx_gety_metabox' ) );
        add_action('woocommerce_admin_process_product_object', [$this, 'save_buyx_gety_metabox']);
        add_filter('woocommerce_json_search_found_products', [$this, 'tf_json_search_found_products']);

        add_action('woocommerce_before_calculate_totals', [$this, 'apply_bundle_discount_for_child']);
        add_action('woocommerce_cart_item_removed', [$this, 'remove_entire_bundle_when_one_removed'], 10, 2);
        // add_filter('woocommerce_cart_contents', [$this, 'sort_cart_items_by_bundle'], 20);
        add_action('woocommerce_after_cart_item_price', [$this, 'display_bundle_info'], 10, 2);
        add_action('tf_after_cart_item_name', [$this, 'display_bundle_info'], 10, 2);
        add_filter( 'woocommerce_cart_item_price', [$this, 'cart_item_price'], 10, 3 );
        add_filter( 'woocommerce_mini_cart_item_class', [$this, 'woocommerce_mini_cart_item_class'], 10, 3 );
        add_filter( 'woocommerce_cart_item_class', [$this, 'woocommerce_mini_cart_item_class'], 10, 3 );
        add_action('woocommerce_before_calculate_totals', [$this, 'lock_bundle_item_quantity'], 10, 1);
        // add_filter('woocommerce_cart_item_quantity', [$this, 'lock_bundle_item_quantity_field'], 10, 3);
        add_action('woocommerce_cart_item_restored', [$this, 'restore_entire_bundle_on_undo'], 10, 2);

        add_action('wc_ajax_tf_add_buyx_gety_bundle',  [$this, 'handle_add_custom_bundle']);
        // add_action('wp_ajax_nopriv_add_custom_bundle', [$this, 'handle_add_custom_bundle']);
    }

    public function init_product_video() {
        if(!themesflat_get_opt('tf_product_video')){
            return;
        }

        // Add product data tabs
        add_action('woocommerce_product_data_tabs', [$this, 'add_tf_video_product_tab']);

        // Display the content
        add_action( 'woocommerce_product_data_panels', [$this,'display_tf_video_product_data_tab_content'] );
        
        // Save field values
        add_action( 'woocommerce_admin_process_product_object', [$this, 'save_tf_video_fields_values'] );

    }

    public function init_product_3d_viewer() {
        if(!themesflat_get_opt('tf_product_3d')){
            return;
        }

        // Add product data tabs
        add_action('woocommerce_product_data_tabs', [$this, 'add_tf_3d_viewer_product_tab']);

        // Display the content
        add_action( 'woocommerce_product_data_panels', [$this,'display_tf_3d_viewer_product_data_tab_content'] );
        
        // Save field values
        add_action( 'woocommerce_admin_process_product_object', [$this, 'save_tf_3d_viewer_fields_values'] );

    }

    public function init_volume_discount(){
        if(!themesflat_get_opt('tf_volume_discount')){
            return;
        }
        
        add_action('save_post', [$this, 'save_volume_discount_data'], 10, 3);
        add_action('wp_ajax_tf_search_products', [$this, 'handle_search_products']);
        // add_action('woocommerce_cart_calculate_fees', [$this, 'apply_volume_discount_in_cart'], 10, 1);
        add_action('woocommerce_before_calculate_totals', [$this, 'apply_volume_discount_in_cart'], 10, 1);

        add_action('woocommerce_before_mini_cart', function() {
            if (WC()->cart && !WC()->cart->is_empty()) {
                WC()->cart->calculate_totals();
            }
        });
                
    }

    public function init_quick_add(){
        add_action('wp_footer', [$this, 'quick_add_popup'] );
        add_action( 'wc_ajax_tf_get_quick_add', [$this, 'quick_add_content'] );
    }

    public function render_size_guide_metabox($post) {
        wp_nonce_field('save_size_guide_table', 'size_guide_nonce');
        $size_guide_table_data = get_post_meta($post->ID, '_size_guide_table_data', true);
        $size_guide_table_data = json_decode($size_guide_table_data, true);
        $size_guide_table_name = get_post_meta($post->ID, '_size_guide_table_name', true);
        $size_guide_table_desc = get_post_meta($post->ID, '_size_guide_table_desc', true);
        $size_guide_table_image = get_post_meta($post->ID, '_size_guide_table_image', true);
        ?>
        <div class="tf-metabox-group">
            <div class="tf-field-group">
                <label><?php _e('Table Name', 'vemus'); ?></label>
                <input type="text" name="size_guide_table_name" value="<?php echo esc_html($size_guide_table_name); ?>">
            </div>
            <div class="tf-field-group">
                <label><?php _e('Description', 'vemus'); ?></label>
                <?php
                 wp_editor(
                        $size_guide_table_desc,
                        'custom_text_editor',
                        array(
                            'textarea_name' => 'size_guide_table_desc',
                            'textarea_rows' => 10,
                            'editor_class'  => 'wp-editor-area',
                            'editor_height' => 300,
                        )
                    );
                ?>
            </div>
            
            <div class="tf-field-group">
                <label><?php _e('Data', 'vemus'); ?></label>
                <input type="hidden" id="size-guide-table-data" name="size_guide_table_data">
                <table id="dynamic-table">
                    <?php if( empty($size_guide_table_data) ): ?>
                        <thead>
                            <tr id="header-row">
                                <th><span class="add-column icon-button">+</span> <span class="remove-column icon-button">-</span></th>
                                <th><span class="add-column icon-button">+</span> <span class="remove-column icon-button">-</span></th>
                                <th><span class="add-column icon-button">+</span> <span class="remove-column icon-button">-</span></th>
                                <th><span class="add-column icon-button">+</span> <span class="remove-column icon-button">-</span></th>
                                <th><?php _e('Actions', 'vemus'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row-input">
                                <td><input type="text" value=""></td>
                                <td><input type="text" value=""></td>
                                <td><input type="text" value=""></td>
                                <td><input type="text" value=""></td>
                                <td><span class="add-row icon-button">+</span> <span class="remove-row icon-button">-</span></td>
                            </tr>
                        </tbody>
                    <?php else: ?>
                        <?php
                        $row_count = count($size_guide_table_data);
                        $col_count = count($size_guide_table_data[0]);
                        ?>
                        <thead>
                            <tr id="header-row">
                                <?php foreach($size_guide_table_data[0] as $cell_data) : ?>
                                    <th><span class="add-column icon-button">+</span> <span class="remove-column icon-button">-</span></th>
                                <?php endforeach; ?>
                                <th><?php _e('Actions', 'vemus'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($size_guide_table_data as $row_data) : ?>
                            <tr class="row-input">
                                <?php foreach($row_data as $cell_data) : ?>
                                    <td><input type="text" value="<?php echo esc_html($cell_data); ?>"></td>
                                <?php endforeach; ?>
                                <td><span class="add-row icon-button">+</span> <span class="remove-row icon-button">-</span></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <?php
    }

    public function save_size_guide_data_ajax() {

        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'save_size_guide_data')) {
            wp_send_json_error(array('message' => 'Security check failed.'));
        }

        if (isset($_POST['data']) && !empty($_POST['data'])) {
            $post_id = intval($_POST['post_id']);
            $data = sanitize_text_field($_POST['data']);

            update_post_meta($post_id, '_size_guide_data', $data);

            wp_send_json_success(array('message' => 'Data saved successfully.'));
        }

        wp_send_json_error(array('message' => 'No data provided.'));
    }

    public function save_size_guide_data($post_id, $post, $update) {

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
        if (!isset($_POST['size_guide_nonce']) || !wp_verify_nonce($_POST['size_guide_nonce'], 'save_size_guide_table')) return $post_id;
        
        if ($post->post_type != 'tf_size_guide') return $post_id;
        
        if (isset($_POST['size_guide_table_data'])) {
            $size_guide_table_data = sanitize_text_field($_POST['size_guide_table_data']);
            update_post_meta($post_id, '_size_guide_table_data', $size_guide_table_data);
        }

        if (isset($_POST['size_guide_table_name'])) {
            $size_guide_table_name = sanitize_text_field($_POST['size_guide_table_name']);
            update_post_meta($post_id, '_size_guide_table_name', $size_guide_table_name);
        }

        if (isset($_POST['size_guide_table_desc'])) {
            $size_guide_table_desc = wp_kses_post($_POST['size_guide_table_desc']);
            update_post_meta($post_id, '_size_guide_table_desc', $size_guide_table_desc);
        }

        if (isset($_POST['size_guide_table_image'])) {
            $size_guide_table_image = sanitize_text_field($_POST['size_guide_table_image']);
            update_post_meta($post_id, '_size_guide_table_image', $size_guide_table_image);
        }

        return $post_id;
    }

    public function add_size_guide_product_tab($tabs) {
        $tabs['tf_size_guide'] = array(
            'label'    => __( 'Size Guide', 'vemus' ),
            'target'   => 'tf_size_guide_product_data',
            'class'    => array(),
        );
        return $tabs;
    }

    public function display_size_guide_product_data_tab_content() {
        global $product_object;

        $size_guide_options = [];

        $args = array(
            'post_type'      => 'tf_size_guide',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );
        
        $size_guide_posts = get_posts($args);

        $size_guide_options = [
            '' => 'No Size Guide'
        ];
        foreach ($size_guide_posts as $post) {
            $size_guide_options[$post->ID] = $post->post_title;
        }

        $attributes = $product_object->get_attributes();

        $attribute_options = array();
    
        foreach ($attributes as $attribute) {
            if ($attribute->is_taxonomy()) {
                $taxonomy = $attribute->get_name();
                $attribute_options[str_replace('pa_', '', $taxonomy)] = ucfirst(str_replace('pa_', '', $taxonomy));
            }
        }

        echo '<div id="tf_size_guide_product_data" class="panel woocommerce_options_panel" style="display:none;">
        <div class="options_group">';

        ## ---- Content Start ---- ##

        woocommerce_wp_select( array(
            'id'          => '_tf_size_guide_data',
            'value'       => $product_object->get_meta('_tf_size_guide_data'),
            'options'        => $size_guide_options,
            'label'       => __('Size guide', 'vemus'),
            
        ));

        woocommerce_wp_select( array(
            'id'          => '_tf_size_guide_display',
            'value'       => $product_object->get_meta('_tf_size_guide_display'),
            'options'        => array(
                '' => 'Default',
                'tabs' => 'Product tabs',
                'button' => 'Button'
            ),
            'label'       => __('Display', 'vemus'),
            
        ));

        woocommerce_wp_select( array(
            'id'          => '_tf_size_guide_button_position',
            'value'       => $product_object->get_meta('_tf_size_guide_button_position'),
            'options'        => array(
                'price' => esc_html__( 'Default (Bellow price)', 'vemus' ),
                'attribute' => esc_html__( 'Size attribute' , 'vemus' ),
                'add-to-cart' => esc_html__( 'Bellow Add to cart button', 'vemus' ),
                'short-desc' => esc_html__( 'Bellow short description', 'vemus' ),
            ),
            'label'       => __('Button Position', 'vemus'),
            
        ));

        woocommerce_wp_select( array(
            'id'          => '_tf_size_guide_attribute',
            'value'       => $product_object->get_meta('_tf_size_guide_attribute'),
            'options'        => $attribute_options,
            'label'       => __('Attribute', 'vemus'),
        ));


        ## ---- Content End  ---- ##

        echo '</div></div>';
        ?>
        <?php
    }

    public function save_size_guide_fields_values( $product ) {
        $tf_size_guide_data = isset( $_POST['_tf_size_guide_data'] ) ? sanitize_text_field($_POST['_tf_size_guide_data']) : '';
        $tf_size_guide_display = isset( $_POST['_tf_size_guide_display'] ) ? sanitize_text_field($_POST['_tf_size_guide_display']) : '';
        $tf_size_guide_button_position = isset( $_POST['_tf_size_guide_button_position'] ) ? sanitize_text_field($_POST['_tf_size_guide_button_position']) : '';
        $tf_size_guide_attribute = isset( $_POST['_tf_size_guide_attribute'] ) ? sanitize_text_field($_POST['_tf_size_guide_attribute']) : '';

        $product->update_meta_data( '_tf_size_guide_data', $tf_size_guide_data );
        $product->update_meta_data( '_tf_size_guide_display', $tf_size_guide_display );
        $product->update_meta_data( '_tf_size_guide_button_position', $tf_size_guide_button_position );
        $product->update_meta_data( '_tf_size_guide_attribute', $tf_size_guide_attribute );
    }

    public function add_variation_gallery_metabox($loop, $variation_data, $variation) {
        ?>
        <div class="options_group tf-variation-gallery-options_group">
            <?php

                $images = get_post_meta($variation->ID, '_tf_variation_gallery', true);
                woocommerce_wp_hidden_input(array(
                    'id'          => '_tf_variation_gallery_' . $loop,
                    'value'       => $images,
                    'custom_attributes' => array(
                        'readonly' => 'readonly',
                    ),
                    'class' => 'tf-input-gallery'
                ));

                $images_array = json_decode($images, true);
                $images_array = empty( $images_array ) ? [] : $images_array;
                ?>
                <div class="variation-gallery-box">
                    <label for="_tf_variation_gallery">
                        <?php echo esc_html__('Variation Gallery', 'vemus'); ?>
                    </label>
                    <div class="image-preview-container">
                        <?php foreach( $images_array as $image_id) : ?>
                            <?php
                                $image_id = absint($image_id);
                                if(empty($image_id)){
                                    continue;
                                }
                                $image_url = wp_get_attachment_url($image_id);
                            ?>
                            <span class="image-preview">
                                <img src="<?php echo esc_url($image_url); ?>" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr__('Variation image', 'vemus'); ?>" style="<?php echo esc_attr('max-width: 100%; height: auto;'); ?>">
                                <span class="remove-image tf-remove-image-btn">×</span>
                            </span>
                        <?php endforeach; ?>
                    </div>
                    <span class="image-preview-el hidden">
                        <img src="" alt="<?php echo esc_attr__('Variation image', 'vemus'); ?>" style="<?php echo esc_attr('max-width: 100%; height: auto;'); ?>">
                        <span class="remove-image tf-remove-image-btn">×</span>
                    </span>
                    <span class='tf-button tf-select-image-btn'><?php echo esc_html__('Select Images', 'vemus'); ?></span>
                </div>
        </div>
        <?php
    }

    public function save_variation_gallery_metabox($variation_id, $index) {
        if (isset($_POST['_tf_variation_gallery_' . $index])) {
            $images = sanitize_text_field($_POST['_tf_variation_gallery_' . $index]);
            $images_array = json_decode($images, true);
            $images_array = empty( $images_array ) ? [] : $images_array;
            $ids_only = array_values(array_filter($images_array, function($item) {
                return is_numeric($item) && absint($item) > 0;
            }));
            update_post_meta($variation_id, '_tf_variation_gallery', json_encode($ids_only));
        }
    }

    public function add_product_together_metabox() {
        global $post;
        global $product_object;
        ?>
            <div class="options_group">
                <p class="form-field hide_if_grouped hide_if_external">
                    <label for="_tf_product_together_ids" style="<?php echo esc_attr('display: block;float: none;width:auto;'); ?>">
                        <span style="<?php echo esc_attr('display: block; margin-bottom: 10px;'); ?>">
                            <strong>
                                <?php esc_html_e( 'Frequently Bought Together', 'vemus' ); ?>
                            </strong>
                        </span>
                    </label>
                    <label for="_tf_product_together_ids"><?php esc_html_e( 'Products', 'vemus' ); ?></label>
                    <select class="wc-product-search" multiple="multiple" style="<?php echo esc_attr('width: 50%;'); ?>" id="_tf_product_together_ids" name="_tf_product_together_ids[]" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'vemus' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>" data-exclude_type="tf_fbt">
                        <?php
                        $product_ids = $product_object->get_meta( '_tf_product_together_ids' ) ?? [];
                        if( $product_ids ){
                            foreach ( $product_ids as $product_id ) {
                                $product = wc_get_product( $product_id );
                                if ( is_object( $product ) ) {
                                    echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . esc_html( wp_strip_all_tags( $product->get_formatted_name() ) ) . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </p>
                <?php

                    $style = $product_object->get_meta('_tf_product_together_style');
                    $position = $product_object->get_meta('_tf_product_together_position');
                    $check = $product_object->get_meta('_tf_product_together_check_all');
                    $check = empty($check) ? ( themesflat_get_opt('tf_buy_together_check_all') ? 'yes' : 'no') : $check;

                    // woocommerce_wp_select( array(
                    //     'id'          => '_tf_product_together_style',
                    //     'value'       => empty( $style ) ? themesflat_get_opt('tf_buy_together_style') : $style,
                    //     'options'        => array(
                    //         'list' => 'List',
                    //         'grid' => 'Grid'
                    //     ),
                    //     'label'       => __('Style', 'vemus'),
                    //     'wrapper_class'       => 'hide_if_grouped hide_if_external'
                    // ));

                    woocommerce_wp_select( array(
                        'id'          => '_tf_product_together_position',
                        'value'       => empty( $position ) ? themesflat_get_opt('tf_buy_together_position') : $position,
                        'options'        => array(
                            'left' => 'Left',
                            'right' => 'Right'
                        ),
                        'label'       => __('Position', 'vemus'),
                        'wrapper_class'       => 'hide_if_grouped hide_if_external'
                    ));

                    woocommerce_wp_checkbox( array(
                        'id'    => '_tf_product_together_check_all',
                        'label' => __('Check all', 'vemus'),
                        'value' =>  $check == 'yes' ? 'yes' : '',
                        'wrapper_class'       => 'hide_if_grouped hide_if_external'
                    ) );

                ?>
            </div>
        <?php
    }

    public function save_product_together_metabox($product) {
        $tf_product_together_style = isset( $_POST['_tf_product_together_style'] ) ? sanitize_text_field($_POST['_tf_product_together_style']) : '';
        $tf_product_together_position = isset( $_POST['_tf_product_together_position'] ) ? sanitize_text_field($_POST['_tf_product_together_position']) : '';
        $tf_product_together_check_all = isset( $_POST['_tf_product_together_check_all'] ) ? 'yes' : 'no';

        $product->update_meta_data( '_tf_product_together_style', $tf_product_together_style );
        $product->update_meta_data( '_tf_product_together_position', $tf_product_together_position );
        $product->update_meta_data( '_tf_product_together_check_all', $tf_product_together_check_all );

        if (isset($_POST['_tf_product_together_ids'])) {
            $ids = !empty($_POST['_tf_product_together_ids']) ? $_POST['_tf_product_together_ids'] : [];
            $product->update_meta_data( '_tf_product_together_ids', $ids );
        }
    }

    public function tf_json_search_found_products($products){

        if( empty($_GET['exclude_type']) ){
            return $products;
        }

        if( $_GET['exclude_type'] == 'tf_fbt' || $_GET['exclude_type'] == 'tf_buyx_gety' ){
            unset($_GET['exclude_type']);
            $products = array_filter( $products, function( $name, $product_id ) {
                $product = wc_get_product( $product_id );
                $empty = false;
                $multiple = false;
                if( $product->is_type('variation') ){
                    $atributes = $product->get_attributes();
                    foreach( $atributes as $atribute_key => $value){
                        if( empty($value) ){
                            $empty = true;
                            break;
                        }
                    }
                }

                if( $product->is_type('variable') ){
                    $all_attrs = $product->get_variation_attributes();
                    if( count($all_attrs) > 5 ){
                        $multiple = true;
                    }

                }

                return !$empty
                    && !$multiple
                    && $product->is_in_stock()
                    && ! $product->is_type( 'external' )
                    && ! $product->is_type( 'grouped' );
            }, ARRAY_FILTER_USE_BOTH );
        }

        return $products;
    }

    public function tf_product_fbt() {
        check_ajax_referer('tf_product_fbt_nonce', 'security');
        if ( !themesflat_get_opt( 'tf_buy_together' ) || empty( $_POST['data'] ) || !is_array($_POST['data']) ) {
            wp_send_json_error( [ 'message' => 'Invalid request' ] );
            exit;
        }
    
        $added = 0;
    
        foreach ( $_POST['data'] as $item ) {
            $product_id   = isset( $item['product_id'] ) ? intval( $item['product_id'] ) : 0;
            $variation_id = isset( $item['variation_id'] ) ? intval( $item['variation_id'] ) : 0;
            $quantity     = isset( $item['quantity'] ) ? max( 1, intval( $item['quantity'] ) ) : 1;
            $attributes   = isset( $item['attributes'] ) && is_array($item['attributes']) ? $item['attributes'] : [];
    
            if ( $product_id <= 0 ) continue;
    
            $product = wc_get_product( $product_id );
            if ( !$product || !$product->is_in_stock() ) continue;
    
            if ( $product->is_type( 'variable' ) && $variation_id ) {
                $variation = wc_get_product( $variation_id );
    
                if ( $variation && $variation->exists() && $variation->get_parent_id() === $product->get_id() ) {
                    WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $attributes );
                    $added++;
                }
            } elseif ( !$product->is_type('variable') ) {
                WC()->cart->add_to_cart( $product_id, $quantity );
                $added++;
            }
        }
    
        if ( $added > 0 ) {
            wp_send_json_success([
                'message' => sprintf( _n('%d product added to cart.', '%d products added to cart.', $added, 'vemus'), $added ),
                'redirect' => wc_get_checkout_url()
            ]);
        } else {
            wp_send_json_error([ 'message' => 'No products were added. Check stock and IDs.' ]);
        }
    
        exit;
    }

    public function tf_size_guide_ajax() {
        check_ajax_referer('tfwc_nonce', 'security');

        if ( !themesflat_get_opt( 'tf_size_guide' ) || empty( $_POST['product_id'] ) ) {
            wp_send_json_error( [ 'message' => 'Invalid request' ] );
            exit;
        }

        global $product;
        
        if( empty($product) ){
            $product = wc_get_product( $product_id = absint( $_POST['product_id'] ) );
        }

        if( empty($product) ){
            wp_send_json_error( [ 'message' => 'Product not found' ] );
            exit;
        }

        ob_start();

        $this->size_guide_quick_view_popup();
    
        wp_send_json_success([
            'content' => ob_get_clean(),
        ]);
    
        exit;
    }

    public function add_buyx_gety_metabox() {
        global $post;
        global $product_object;
        ?>
            <div class="options_group">
                <p class="form-field hide_if_grouped hide_if_external">
                    <label for="_tf_buyx_gety_item_id" style="<?php echo esc_attr('display: block;float: none;width:auto;'); ?>">
                        <span style="<?php echo esc_attr('display: block; margin-bottom: 10px;'); ?>">
                            <strong>
                                <?php esc_html_e( 'Buy X Get Y', 'vemus' ); ?>
                            </strong>
                        </span>
                    </label>
                    <label for="_tf_buyx_gety_item_id"><?php esc_html_e( 'Discount item', 'vemus' ); ?></label>
                    <select class="wc-product-search" data-multiple="false" style="<?php echo esc_attr('width: 50%;'); ?>" id="_tf_buyx_gety_item_id" name="_tf_buyx_gety_item_id" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'vemus' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>" data-exclude_type="tf_buyx_gety">
                        <?php
                        $product_id = $product_object->get_meta( '_tf_buyx_gety_item_id' ) ?? '';
                        if( $product_id ){
                            $product = wc_get_product( $product_id );
                            if ( is_object( $product ) ) {
                                echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . esc_html( wp_strip_all_tags( $product->get_formatted_name() ) ) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </p>
                <?php

                    woocommerce_wp_text_input( array(
                        'id'          => '_tf_buyx_gety_title',
                        'value'       => $product_object->get_meta('_tf_buyx_gety_title'),
                        'label'       => __('Discount title', 'vemus'),
                        'wrapper_class'       => 'hide_if_grouped hide_if_external'
                    ));

                    woocommerce_wp_text_input( array(
                        'id'          => '_tf_buyx_gety_number_main',
                        'value'       => $product_object->get_meta('_tf_buyx_gety_number_main'),
                        'type'        => 'number',
                        'data_type'   => 'decimal',
                        'label'       => __('Number main item to get discount', 'vemus'),
                        'custom_attributes' => [
                            'min' => 1
                        ],
                        'wrapper_class'       => 'hide_if_grouped hide_if_external'
                    ));

                    woocommerce_wp_text_input( array(
                        'id'          => '_tf_buyx_gety_number_get',
                        'value'       => $product_object->get_meta('_tf_buyx_gety_number_get'),
                        'type'        => 'number',
                        'data_type'   => 'decimal',
                        'label'       => __('Number discount item', 'vemus'),
                        'custom_attributes' => [
                            'min' => 1
                        ],
                        'wrapper_class'       => 'hide_if_grouped hide_if_external'
                    ));

                    woocommerce_wp_text_input( array(
                        'id'          => '_tf_buyx_gety_discount',
                        'value'       => $product_object->get_meta('_tf_buyx_gety_discount'),
                        'type'        => 'number',
                        'data_type'   => 'decimal',
                        'label'       => __('Discount (%)', 'vemus'),
                        'custom_attributes' => [
                            'min' => 1,
                            'max' => 100
                        ],
                        'wrapper_class'       => 'hide_if_grouped hide_if_external'
                    ));

                    woocommerce_wp_text_input( array(
                        'id'          => '_tf_buyx_gety_limit',
                        'value'       => $product_object->get_meta('_tf_buyx_gety_limit'),
                        'type'        => 'number',
                        'data_type'   => 'decimal',
                        'label'       => __('Limit per cart', 'vemus'),
                        'custom_attributes' => [
                            'min' => 0
                        ],
                        'wrapper_class'       => 'hide_if_grouped hide_if_external'
                    ));


                ?>
            </div>
        <?php
    }

    public function save_buyx_gety_metabox($product) {
        $tf_buyx_gety_item_id = isset( $_POST['_tf_buyx_gety_item_id'] ) ? sanitize_text_field($_POST['_tf_buyx_gety_item_id']) : '';
        $tf_buyx_gety_title = isset( $_POST['_tf_buyx_gety_title'] ) ? sanitize_text_field($_POST['_tf_buyx_gety_title']) : '';
        $tf_buyx_gety_number_main = isset( $_POST['_tf_buyx_gety_number_main'] ) ? sanitize_text_field($_POST['_tf_buyx_gety_number_main']) : '';
        $tf_buyx_gety_number_get = isset( $_POST['_tf_buyx_gety_number_get'] ) ? sanitize_text_field($_POST['_tf_buyx_gety_number_get']) : '';
        $tf_buyx_gety_discount = isset( $_POST['_tf_buyx_gety_discount'] ) ? sanitize_text_field($_POST['_tf_buyx_gety_discount']) : '';
        $tf_buyx_gety_limit = isset( $_POST['_tf_buyx_gety_limit'] ) ? sanitize_text_field($_POST['_tf_buyx_gety_limit']) : '';
 
        $product->update_meta_data( '_tf_buyx_gety_item_id', $tf_buyx_gety_item_id );
        $product->update_meta_data( '_tf_buyx_gety_title', $tf_buyx_gety_title );
        $product->update_meta_data( '_tf_buyx_gety_number_main', $tf_buyx_gety_number_main );
        $product->update_meta_data( '_tf_buyx_gety_number_get', $tf_buyx_gety_number_get );
        $product->update_meta_data( '_tf_buyx_gety_discount', $tf_buyx_gety_discount );
        $product->update_meta_data( '_tf_buyx_gety_limit', $tf_buyx_gety_limit );
    }

    public function handle_add_custom_bundle() {
        check_ajax_referer('tf_add_buyx_gety_bundle_nonce', 'security');
        if ( !themesflat_get_opt( 'tf_buyx_gety' )){
            return;
        }
        $product_id_x     = intval($_POST['product_id_x'] ?? 0);
        $variation_id_x   = intval($_POST['variation_id_x'] ?? 0);
        $variation_x      = !empty($_POST['variation_x']) ? $_POST['variation_x'] : [];

        $product_id_y     = intval($_POST['product_id_y'] ?? 0);
        $variation_id_y   = intval($_POST['variation_id_y'] ?? 0);
        $variation_y      = !empty($_POST['variation_y']) ? $_POST['variation_y'] : [];
    
        if (!$product_id_x || !$product_id_y) {
            return wp_send_json_error(
                [
                    'message' => esc_html('Please select valid variation!', 'vemus')
                ]
            );
        }

        $product_x = wc_get_product($product_id_x);
        $product_y = wc_get_product($product_id_y);

        if (
            !$product_x || !$product_y ||
            !$product_x->is_purchasable() || !$product_y->is_purchasable() ||
            !$product_x->is_in_stock() || !$product_y->is_in_stock()
        ) {
            return wp_send_json_error(
                [
                    'message' => esc_html('Please select valid variation!', 'vemus')
                ]
            );
        }

        if ($product_x->is_type('variable')) {
            $variation_product_x = wc_get_product($variation_id_x);
            if (
                !$variation_product_x ||
                $variation_product_x->get_parent_id() !== $product_id_x
            ) {
                return wp_send_json_error(
                    [
                        'message' => esc_html('Please select valid variation!', 'vemus')
                    ]
                );
            }
        }

        if ($product_y->is_type('variable')) {
            $variation_product_y = wc_get_product($variation_id_y);
            if (
                !$variation_product_y ||
                $variation_product_y->get_parent_id() !== $product_id_y
            ) {
                return wp_send_json_error(
                    [
                        'message' => esc_html('Please select valid variation!', 'vemus')
                    ]
                );
            }
        }

        $tf_buyx_gety_item_id = $product_x->get_meta( '_tf_buyx_gety_item_id' ) ?? '';
        $quantity_x = $product_x->get_meta( '_tf_buyx_gety_number_main' ) ?? '';
        $quantity_y = $product_x->get_meta( '_tf_buyx_gety_number_get' ) ?? '';
        $discount_y = $product_x->get_meta( '_tf_buyx_gety_discount' ) ?? '';
        $limit = $product_x->get_meta( '_tf_buyx_gety_limit' ) ?? '';

        if( empty($quantity_x) || empty($quantity_y) || empty($discount_y) || empty($tf_buyx_gety_item_id) ){
            return wp_send_json_error(
                [
                    'message' => esc_html('Please select valid variation!', 'vemus')
                ]
            );
        }

        if( $tf_buyx_gety_item_id != $product_id_y){
            return wp_send_json_error(
                [
                    'message' => esc_html('Please select valid variation!', 'vemus')
                ]
            );
        }

        if( !empty($limit) ){
            $bundle_count = 0;

            foreach (WC()->cart->get_cart() as $cart_item) {
                if (
                    isset($cart_item['tf_custom_bundle']) && 
                    $cart_item['tf_custom_bundle'] === true &&
                    isset($cart_item['is_bundle_parent']) && 
                    $cart_item['is_bundle_parent'] === true &&
                    $cart_item['product_id'] == $product_id_x
                ) {
                    $bundle_count++;
                }
            }

            if ($bundle_count >= $limit) {
                return wp_send_json_error(
                    [
                        'message' => sprintf(
                            __('The bundle limit for this product has been exceeded (maximum: %d). Some items were not restored.', 'vemus'),
                            $limit
                        )
                    ]
                );
            }
        }

        $valid_x = $this->validate_product_before_add($product_id_x, $variation_id_x, $quantity_x, $variation_x);
        $valid_y = $this->validate_product_before_add($product_id_y, $variation_id_y, $quantity_y, $variation_y);
    
        if (!$valid_x || !$valid_y) {
            $errors = wc_get_notices('error');
            $latest_error = !empty($errors) ? end($errors)['notice'] : esc_html('Please select valid variation!', 'vemus');
            wc_clear_notices();
            return wp_send_json_error(
                ['message' => $latest_error]
            );
        }
    
        $bundle_key = uniqid('bundle_', true);

        $cart_item_key_x = WC()->cart->add_to_cart($product_id_x, $quantity_x, $variation_id_x, $variation_x, [
            'tf_custom_bundle' => true,
            'bundle_key'    => $bundle_key,
            'original_qty' => $quantity_x,
            'tf_bundle_limit' => $limit,
            'is_bundle_parent'     => true
        ]);

        if (!$cart_item_key_x) {
            $errors = wc_get_notices('error');
            $latest_error = !empty($errors) ? end($errors)['notice'] : esc_html('Please select valid variation!', 'vemus');
            wc_clear_notices();
            return wp_send_json_error(
                ['message' => $latest_error]
            );
        }
    
        $cart_item_key_y = WC()->cart->add_to_cart($product_id_y, $quantity_y, $variation_id_y, $variation_y, [
            'tf_custom_bundle' => true,
            'bundle_key'    => $bundle_key,
            'original_qty' => $quantity_y,
            'is_bundle_child'      => true,
            'tf_bundle_limit' => $limit,
            'tf_bundle_discount'      => $discount_y
        ]);

        if (!$cart_item_key_y) {
            WC()->cart->remove_cart_item($cart_item_key_x);
        }
    
        if ($cart_item_key_x && $cart_item_key_y) {
            wc_clear_notices();
            wp_send_json_success();
        } else {
            $errors = wc_get_notices('error');
            $latest_error = !empty($errors) ? end($errors)['notice'] : esc_html('Please select valid variation!', 'vemus');
            wc_clear_notices();
            return wp_send_json_error(
                ['message' => $latest_error]
            );
        }
    }

    public function validate_product_before_add($product_id, $variation_id = 0, $quantity = 1, $variation_data = []) {
        $product = wc_get_product($variation_id ?: $product_id);
        if (!$product) return false;
    
        if (!$product->is_purchasable() || !$product->is_in_stock()) {
            wc_add_notice(esc_html('This product is currently unavailable!', 'vemus'), 'error');
            return false;
        }
    
        return apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variation_data);
    }

    public function apply_bundle_discount_for_child($cart) {
        if(!empty($_POST['tf_bundle_discount_applied'])){
            return;
        }
        $_POST['tf_bundle_discount_applied'] = true;
        foreach ($cart->get_cart() as $cart_item) {
            if (!empty($cart_item['tf_custom_bundle']) && !empty($cart_item['is_bundle_child'])) {
                $product = $cart_item['data'];
                $original_price = $product->get_price();
                $discount = floatval($cart_item['tf_bundle_discount']);
                $product->set_price($original_price * (1 - $discount / 100));
            }
        }
    }

    public function lock_bundle_item_quantity($cart) {
        if (is_admin() || defined('DOING_AJAX') && DOING_AJAX) return;
    
        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            if (!empty($cart_item['tf_custom_bundle']) && isset($cart_item['original_qty'])) {
                if ($cart_item['quantity'] != $cart_item['original_qty']) {
                    $cart->cart_contents[$cart_item_key]['quantity'] = $cart_item['original_qty'];
                }
            }
        }
    }

    public function lock_bundle_item_quantity_field($quantity, $cart_item_key, $cart_item) {
        if (!empty($cart_item['tf_custom_bundle']) && isset($cart_item['original_qty']) && $quantity != $cart_item['original_qty']) {
            return $cart_item['original_qty'];
        }
        return $quantity;
    }

    public function remove_entire_bundle_when_one_removed($removed_cart_item_key, $cart) {
        $removed_item = $cart->removed_cart_contents[$removed_cart_item_key] ?? null;
        if (!$removed_item || empty($removed_item['tf_custom_bundle'])) return;
    
        $bundle_key = $removed_item['bundle_key'];
    
        foreach (WC()->cart->get_cart() as $key => $item) {
            if (!empty($item['tf_custom_bundle']) && $item['bundle_key'] === $bundle_key) {
                WC()->cart->remove_cart_item($key);
            }
        }
    }

    public function restore_entire_bundle_on_undo($restored_item_key, $cart) {
        $restored_item = $cart->get_cart_item($restored_item_key);
        if (empty($restored_item['tf_custom_bundle']) || empty($restored_item['bundle_key'])) {
            return;
        }

        if( !empty($restored_item['is_bundle_child']) && empty($_POST['tf_restore_bundle_key'])){
            WC()->cart->remove_cart_item($restored_item_key);
            wc_add_notice(__('This bundle cannot be added individually.', 'vemus'), 'error');
            return;
        }

        if( empty($restored_item['is_bundle_parent']) ){
            return;
        }

        $_POST['tf_restore_bundle_key'] = $restored_item['bundle_key'];

        $limit = !empty($restored_item['tf_bundle_limit']) ? $restored_item['tf_bundle_limit'] : '';
        if( !empty($limit) ){
            $bundle_count = 0;

            foreach (WC()->cart->get_cart() as $cart_item) {
                if (
                    isset($cart_item['tf_custom_bundle']) && 
                    $cart_item['tf_custom_bundle'] === true &&
                    isset($cart_item['is_bundle_parent']) && 
                    $cart_item['is_bundle_parent'] === true &&
                    $cart_item['product_id'] == $restored_item['product_id']
                ) {
                    $bundle_count++;
                }
            }

            if ($bundle_count > $limit) {
                WC()->cart->remove_cart_item($restored_item_key);
                wc_add_notice(sprintf(
                    __('The bundle limit for this product has been exceeded (maximum: %d). Some items were not restored.', 'vemus'),
                    $limit
                ), 'error');
                return;
            }
        }
        $bundle_key = $restored_item['bundle_key'];
        $removed_items = WC()->session->get('removed_cart_contents', []);

        foreach ($removed_items as $key => $item) {
            if (
                $key !== $restored_item_key &&
                !empty($item['tf_custom_bundle']) &&
                $item['bundle_key'] === $bundle_key
            ) {
                WC()->cart->restore_cart_item($key);
            }
        }

        unset($_POST['tf_restore_bundle_key']);
    }

    public function sort_cart_items_by_bundle($cart_contents) {
        $bundles = [];
        $others = [];
    
        foreach ($cart_contents as $key => $item) {
            if (!empty($item['tf_custom_bundle']) && !empty($item['bundle_key'])) {
                $bundles[$item['bundle_key']][$key] = $item;
            } else {
                $others[$key] = $item;
            }
        }
    
        $sorted = [];

        foreach ($bundles as $bundle_items) {
            foreach ($bundle_items as $key => $item) {
                $sorted[$key] = $item;
            }
        }
    
        foreach ($others as $key => $item) {
            $sorted[$key] = $item;
        }
    
        return $sorted;
    }

    public function display_bundle_info($cart_item, $cart_item_key) {

        if (empty($cart_item['tf_custom_bundle'])) return;

        $main_icon = themesflat_get_opt('tf_buyx_gety_main_icon');
        $free_icon = themesflat_get_opt('tf_buyx_gety_free_icon');
        $discount_icon = themesflat_get_opt('tf_buyx_gety_discount_icon');
        $main_text = themesflat_get_opt('tf_buyx_gety_main_text');
        $free_text = themesflat_get_opt('tf_buyx_gety_free_text');
        $discount_text = themesflat_get_opt('tf_buyx_gety_discount_text');

        if (!empty($cart_item['is_bundle_parent'])) {
            ?>
                <div class="tf-bundle-note fw-medium">
                    <i class="<?php echo esc_attr($main_icon); ?>"></i>
                    <span class="d-none d-sm-inline"><?php echo esc_html($main_text, 'vemus'); ?></span>
                </div>
            <?php
        }

        if (!empty($cart_item['is_bundle_child'])) {
            $discount = isset($cart_item['tf_bundle_discount']) ? floatval($cart_item['tf_bundle_discount']) : 0;
            $discount_text = str_replace('{discount}', $discount, $discount_text);
            if ($discount >= 100) {
                ?>
                    <div class="tf-bundle-note bundle-free-item fw-medium">
                        <i class="<?php echo esc_attr($free_icon); ?>"></i>
                        <span class="d-none d-sm-inline"><?php echo esc_html($free_text, 'vemus'); ?></span>
                    </div>
                <?php
            } else {
                ?>
                    <div class="tf-bundle-note bundle-discount-item fw-medium">
                        <i class="<?php echo esc_attr($discount_icon); ?>"></i>
                        <span class="d-none d-sm-inline"><?php echo esc_html($discount_text, 'vemus'); ?></span>
                    </div>
                <?php
            }
        }
    }

    public function cart_item_price( $price_html, $cart_item, $cart_item_key){
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

        if( !$_product ){
            return $price_html;
        }
        ob_start();
        if( $_product->get_regular_price() != $_product->get_price()){
            echo '<del>' . wc_price($_product->get_regular_price()) . '</del> ';
            echo '<ins>' . wc_price($_product->get_price()) . '</ins>';
        }else{
            echo wc_price($_product->get_price());
        }
        return ob_get_clean();
    }

    public function woocommerce_mini_cart_item_class($classes, $cart_item, $cart_item_key){
        if( !empty($cart_item['tf_custom_bundle']) && !empty($cart_item['is_bundle_child'])){
            $classes .= " tf-bundle-child";
        }
        return $classes;
    }

    public static function renderVideo($url) {
        $videoExtensions = ['mp4', 'webm', 'ogg'];
    
        $pathInfo = pathinfo(parse_url($url, PHP_URL_PATH));
        $extension = strtolower($pathInfo['extension'] ?? '');
    
        if (in_array($extension, $videoExtensions)) {
            return "<video controls width='100%' preload='metadata' playsinline='true' autoplay='true' controls='' loop='' muted=''>
                        <source src='" . htmlspecialchars($url) . "' type='video/{$extension}'>
                    </video>";
        }
    
        if (preg_match('/(youtube\.com|youtu\.be)/', $url)) {
           parse_str(parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? '';
    
            if (!$videoId) {
                if (preg_match('#youtu\.be/([^?\&]+)#', $url, $matches)) {
                    $videoId = $matches[1];
                } elseif (preg_match('#/shorts/([^?\&]+)#', $url, $matches)) {
                    $videoId = $matches[1];
                }
            }
    
            if ($videoId) {
                return "<iframe
                    src='https://www.youtube.com/embed/{$videoId}'
                    frameborder='0'
                    allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
                    allowfullscreen
                ></iframe>";
            }
        }
    
        if (preg_match('/tiktok\.com/', $url)) {
            return "<iframe src='{$url}' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>";
        }
    
        if (preg_match('/instagram\.com/', $url)) {
            return "<iframe src='{$url}embed' frameborder='0' allowfullscreen></iframe>";
        }
    
        return "<iframe src='{$url}' frameborder='0' allowfullscreen></iframe>";
    }

    public function tf_get_variation_gallery() {
        check_ajax_referer('tf_get_variation_gallery_nonce', 'security');
		if ( empty( $_POST['product_id'] ) ) {
			wp_send_json_error();
			exit;
		}
        $product_id = absint( $_POST['product_id'] );
        $variation_id = empty( $_POST['variation_id'] ) ? 0 : absint( $_POST['variation_id'] );

        $product = wc_get_product( $product_id );
        $variation_product = wc_get_product( $variation_id );
        if( !$product && !$variation_product ) {
            wp_send_json_error();
            exit;
        }
        $attachment_ids = [];
        $post_thumbnail_id = 0;

        if( $variation_product){
            $post_thumbnail_id = $variation_product->get_image_id();
            $images = get_post_meta($variation_product->get_id(), '_tf_variation_gallery', true);
            if( !empty($images) ){
                $attachment_ids = json_decode($images, true);
            }
        }

        if( empty($post_thumbnail_id) ){
            $post_thumbnail_id = $product->get_image_id();
        }

        if( empty($attachment_ids) ){
            $attachment_ids = $product->get_gallery_image_ids();
            if( themesflat_get_opt('tf_product_video')){
                $video_url = $product->get_meta('_tf_video_url');
                $video_thumb = $product->get_meta('_tf_video_thumb');
            }

            if( themesflat_get_opt('tf_product_3d')){
                $model_viewer_url = $product->get_meta('_tf_3d_viewer_url');
                $model_viewer_thumb = $product->get_meta('_tf_3d_viewer_thumb');
            }
        }

        add_filter( 'woocommerce_single_product_image_thumbnail_html', [$this, 'single_product_image_thumbnail_html'], 10, 2 );
        add_filter( 'woocommerce_gallery_image_html_attachment_image_params', [$this, 'gallery_image_params'], 10, 4 );

        ob_start();

        $html = '';

        if ( $post_thumbnail_id ) {
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

        if ( $attachment_ids) {
            foreach ( $attachment_ids as $key => $attachment_id ) {
                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id, true, $key ), $attachment_id ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
            
            if(!empty($video_url) ){
                ?>
                    <div class="swiper-slide slide-video">
                        <div class="item" data-video-thumb="<?php echo esc_url($video_thumb); ?>">
                            <?php echo self::renderVideo($video_url); ?>
                        </div>
                    </div>
                <?php
            }

            if(!empty($model_viewer_url) ){
                ?>
                    <div class="swiper-slide slide-3d">
                        <div class="item" data-model-viewer-thumb="<?php echo esc_url($model_viewer_thumb); ?>">
                            <div class="tf-model-viewer">
                                <model-viewer reveal="auto" toggleable="true" src="<?php echo esc_url($model_viewer_url); ?>" camera-controls="true" alt="<?php echo esc_html( $product->get_title() ); ?>" poster="<?php echo esc_url($model_viewer_thumb); ?>" class="tf-model-viewer-ui disabled" ar-status="not-presenting">
                                </model-viewer>
                                <div class="tf-model-viewer-ui-button">
                                    <div class="wrap-btn-viewer">
                                        <i class="icon icon-btn3d"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }

        $content = ob_get_clean();

        wp_send_json_success( [
			'content'      => $content,
		] );
    }

    public function add_tf_video_product_tab($tabs) {
        $tabs['tf_video'] = array(
            'label'    => __( 'Product Video', 'vemus' ),
            'target'   => 'tf_video_product_data',
            'class'    => array(),
        );
        return $tabs;
    }

    public function display_tf_video_product_data_tab_content() {
        global $product_object;

        echo '<div id="tf_video_product_data" class="panel woocommerce_options_panel" style="display:none;">
        <div class="options_group">';

        ## ---- Content Start ---- ##

        woocommerce_wp_text_input( array(
            'id'          => '_tf_video_url',
            'value'       => $product_object->get_meta('_tf_video_url'),
            'label'       => __('Video URL', 'vemus'),
            'data_type'   => 'url'
        ));

        // woocommerce_wp_text_input( array(
        //     'id'          => '_tf_video_position',
        //     'value'       => $product_object->get_meta('_tf_video_position'),
        //     'type'        => 'number',
        //     'data_type'   => 'decimal',
        //     'label'       => __('Video position', 'vemus'),
        //     'custom_attributes' => [
        //         'min' => 1
        //     ]
        // ));

        woocommerce_wp_hidden_input(array(
            'id'          => '_tf_video_thumb',
            'value'       => $product_object->get_meta('_tf_video_thumb'),
        ));

        ?>
            <p class="form-field ">
                <label for="_tf_video_thumb">
                    <?php echo esc_html__('Video thumbnail', 'vemus'); ?>
                </label>
                <span class="image-preview-container" style="<?php echo esc_attr('display: none; max-width: 150px;'); ?>">
                    <span class="image-preview">
                        <img src="<?php echo esc_url($product_object->get_meta('_tf_video_thumb')); ?>" data-src="<?php echo esc_url($product_object->get_meta('_tf_video_thumb')); ?>" alt="<?php echo esc_attr__('Video thumbnail image', 'vemus'); ?>" style="<?php echo esc_attr('max-width: 100%; height: auto;'); ?>">
                        <span class="remove-image tf-remove-thumb-btn">×</span>
                    </span>
                </span>
                <span class='tf-button tf-select-thumb-btn'><?php echo esc_html__('Select thumbnail', 'vemus'); ?></span>
            </p>
        <?php
        ## ---- Content End  ---- ##

        echo '</div></div>';
        ?>
        <?php
    }

    public function save_tf_video_fields_values( $product ) {
        $tf_video_url = isset( $_POST['_tf_video_url'] ) ? sanitize_text_field($_POST['_tf_video_url']) : '';
        $tf_video_position = isset( $_POST['_tf_video_position'] ) ? sanitize_text_field($_POST['_tf_video_position']) : '';
        $tf_video_thumb = isset( $_POST['_tf_video_thumb'] ) ? sanitize_text_field($_POST['_tf_video_thumb']) : '';

        $product->update_meta_data( '_tf_video_url', $tf_video_url );
        $product->update_meta_data( '_tf_video_position', $tf_video_position );
        $product->update_meta_data( '_tf_video_thumb', $tf_video_thumb );
    }

    public function add_tf_3d_viewer_product_tab($tabs) {
        $tabs['tf_3d_viewer'] = array(
            'label'    => __( 'Product 3D Viewer', 'vemus' ),
            'target'   => 'tf_3d_viewer_product_data',
            'class'    => array(),
        );
        return $tabs;
    }

    public function display_tf_3d_viewer_product_data_tab_content() {
        global $product_object;

        echo '<div id="tf_3d_viewer_product_data" class="panel woocommerce_options_panel" style="display:none;">
        <div class="options_group">';

        ## ---- Content Start ---- ##

        woocommerce_wp_text_input( array(
            'id'          => '_tf_3d_viewer_url',
            'value'       => $product_object->get_meta('_tf_3d_viewer_url'),
            'label'       => __('3D URL (gltf/glb file)', 'vemus'),
            'data_type'   => 'url'
        ));

        // woocommerce_wp_text_input( array(
        //     'id'          => '_tf_3d_viewer_position',
        //     'value'       => $product_object->get_meta('_tf_3d_viewer_position'),
        //     'type'        => 'number',
        //     'data_type'   => 'decimal',
        //     'label'       => __('Position', 'vemus'),
        //     'custom_attributes' => [
        //         'min' => 1
        //     ]
        // ));

        woocommerce_wp_hidden_input(array(
            'id'          => '_tf_3d_viewer_thumb',
            'value'       => $product_object->get_meta('_tf_3d_viewer_thumb'),
        ));

        ?>
            <p class="form-field ">
                <label for="_tf_3d_viewer_thumb">
                    <?php echo esc_html__('Thumbnail', 'vemus'); ?>
                </label>
                <span class="image-preview-container" style="<?php echo esc_attr('display: none; max-width: 150px;'); ?>">
                    <span class="image-preview">
                        <img src="<?php echo esc_url($product_object->get_meta('_tf_3d_viewer_thumb')); ?>" data-src="<?php echo esc_url($product_object->get_meta('_tf_3d_viewer_thumb')); ?>" alt="<?php echo esc_attr__('Video thumbnail image', 'vemus'); ?>" style="<?php echo esc_attr('max-width: 100%; height: auto;'); ?>">
                        <span class="remove-image tf-remove-thumb-btn">×</span>
                    </span>
                </span>
                <span class='tf-button tf-select-thumb-btn'><?php echo esc_html__('Select thumbnail', 'vemus'); ?></span>
            </p>
        <?php
        ## ---- Content End  ---- ##

        echo '</div></div>';
        ?>
        <?php
    }

    public function save_tf_3d_viewer_fields_values( $product ) {
        $tf_3d_viewer_url = isset( $_POST['_tf_3d_viewer_url'] ) ? sanitize_text_field($_POST['_tf_3d_viewer_url']) : '';
        $tf_3d_viewer_position = isset( $_POST['_tf_3d_viewer_position'] ) ? sanitize_text_field($_POST['_tf_3d_viewer_position']) : '';
        $tf_3d_viewer_thumb = isset( $_POST['_tf_3d_viewer_thumb'] ) ? sanitize_text_field($_POST['_tf_3d_viewer_thumb']) : '';

        $product->update_meta_data( '_tf_3d_viewer_url', $tf_3d_viewer_url );
        $product->update_meta_data( '_tf_3d_viewer_position', $tf_3d_viewer_position );
        $product->update_meta_data( '_tf_3d_viewer_thumb', $tf_3d_viewer_thumb );
    }

    public function render_volume_discount_metabox($post) {
        wp_nonce_field('save_volume_discount', 'volume_discount_nonce');
        $volume_discount_position = get_post_meta($post->ID, '_volume_discount_position', true);
        $volume_discount_style = get_post_meta($post->ID, '_volume_discount_style', true);
        $volume_discount_products = get_post_meta($post->ID, '_volume_discount_products', true);
        $volume_discount_data = get_post_meta($post->ID, '_volume_discount_data', true);
        $volume_discount_data = json_decode($volume_discount_data, true);
        $products = [];
        if (!empty($volume_discount_products) && is_array($volume_discount_products)) {
            $products = get_posts(array(
                'post_type' => 'product', 
                'posts_per_page' => -1,
                'post__in' => $volume_discount_products,
                'orderby' => 'post__in'
            ));
        }

        ?>
        <div class="tf-metabox-group">
            <div class="tf-field-group">
                <label><?php echo esc_html__('Layout', 'vemus'); ?></label>
                <select name='volume_discount_style' class='volume-discount-style'> 
                    <option value='list' <?php echo esc_attr($volume_discount_style == 'list' ? 'selected': ''); ?> ><?php echo esc_html__('List', 'vemus'); ?></option>
                    <option value='thumbnail' <?php echo esc_attr($volume_discount_style == 'thumbnail' ? 'selected': ''); ?> ><?php echo esc_html__('Thumbnail', 'vemus'); ?></option>
                </select>
            </div>
            <div class="tf-field-group">
                <label><?php echo esc_html__('Position', 'vemus'); ?></label>
                <select name='volume_discount_position' class='volume-discount-position'>
                    <option value='before' <?php echo esc_attr($volume_discount_position == 'before' ? 'selected': ''); ?> ><?php echo esc_html__('Before add to cart button', 'vemus'); ?></option>
                    <option value='after' <?php echo esc_attr($volume_discount_position == 'after' ? 'selected': ''); ?> ><?php echo esc_html__('After add to cart button', 'vemus'); ?></option>
                </select>
            </div>
            <div class="tf-field-group">
                <label><?php echo esc_html__('Products', 'vemus'); ?></label>
                <select name='volume_discount_products[]' class='volume-discount-products' multiple>
                    <?php foreach ($products as $product) : ?>
                        <option value="<?php echo esc_attr($product->ID); ?>" <?php echo in_array($product->ID, $volume_discount_products) ? 'selected' : ''; ?>>
                            <?php echo esc_html($product->post_title); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="tf-field-group">
                <label><?php echo esc_html__('Volume Discounts', 'vemus'); ?></label>
                <input type="hidden" name="volume_discount_data" class="volume-discount-data">
                <div class="volume-discount-items loading">
                <?php if( empty($volume_discount_data) ): ?>
                    <div class="volume-discount-item">
                        <div class="volume-discount-item-data">
                            <span class="label"><?php echo esc_html__('From', 'vemus'); ?></span><input type="number" name="from" value="3">
                            <span class="label"><?php echo esc_html__('To', 'vemus'); ?></span><input type="number" name="to" value="5">
                            <span class="label">:</span><input type="number" name="discount" value="15"><span class="label">(%) <?php echo esc_html__('Off', 'vemus'); ?></span>
                        </div>
                        <div class="volume-discount-item-options">
                            <span class="label"><?php echo esc_html__('Tag', 'vemus'); ?></span>
                            <input type="checkbox" name="tag_enable" class="tag-enable" checked>
                            <input type="text" value="Most Popular" name="tag_label" class="tag-label">
                            <input name="tag_color" class="tag-color" type="color" value="#ff6f61">
                            <input name="tag_icon" class="tag-icon" type="text" value="icon-tag" placeholder="<?php echo esc_attr__('icon class', 'vemus'); ?>">
                        </div>
                        <div class="volume-discount-item-thumbnails">
                            <span class="label"><?php echo esc_html__('Thumbnail', 'vemus'); ?></span>
                            <div class="image-preview-container">
                                <div class="image-preview">
                                    <img src="" alt="<?php echo esc_attr__('Select Image', 'vemus'); ?>" style="<?php echo esc_attr('max-width: 100%; height: auto;'); ?>">
                                    <span class="remove-image">×</span>
                                </div>
                            </div>
                            <input type="hidden" name="volume_discount_image" class="volume-discount-image">
                            <button type="button" class="button volume-discount-image-button"><?php echo esc_html__('Select Image', 'vemus'); ?></button>
                            <span class="label"><?php echo esc_html__('Unit', 'vemus'); ?></span>
                            <input type="text" name="unit" value="pant">
                        </div>
                        <span class="tf-button remove-item-btn" style="<?php echo esc_attr('display:none;'); ?>"><?php echo esc_html__('Remove', 'vemus'); ?></span>
                    </div>
                <?php else: ?>
                    <?php foreach( $volume_discount_data as $key => $item ) : ?>
                        <div class="volume-discount-item">
                            <div class="volume-discount-item-data">
                                <span class="label"><?php echo esc_html__('From', 'vemus'); ?></span><input type="number" min="0" name="from" value="<?php echo esc_attr($item['from']); ?>">
                                <span class="label"><?php echo esc_html__('To', 'vemus'); ?></span><input type="number" min="0" name="to" value="<?php echo esc_attr($item['to']); ?>">
                                <span class="label">:</span><input type="number" min="0" max="100" name="discount" value="<?php echo esc_attr($item['discount']); ?>"><span class="label">(%) <?php echo esc_html__('Off', 'vemus'); ?></span>
                            </div>
                            <div class="volume-discount-item-options">
                                <span class="label"><?php echo esc_html__('Tag', 'vemus'); ?></span>
                                <input type="checkbox" name="tag_enable" class="tag-enable" <?php echo !empty($item['tag_enable']) ? 'checked': ''; ?> >
                                <input type="text" name="tag_label" class="tag-label" value="<?php echo esc_attr($item['tag_label']); ?>">
                                <input name="tag_color" class="tag-color" type="color" value="<?php echo esc_attr($item['tag_color']); ?>">
                                <input name="tag_icon" class="tag-icon" type="text" value="<?php echo esc_attr($item['tag_icon']); ?>" placeholder="<?php echo esc_attr__('icon class', 'vemus'); ?>">
                            </div>
                            <div class="volume-discount-item-thumbnails">
                                <span class="label"><?php echo esc_html__('Thumbnail', 'vemus'); ?></span>
                                <div class="image-preview-container">
                                    <div class="image-preview">
                                        <img src="<?php echo esc_attr($item['volume_discount_image']); ?>" alt="<?php echo esc_attr__('Volume Discount Image', 'vemus'); ?>" style="<?php echo esc_attr('max-width: 100%; height: auto;'); ?>">
                                        <span class="remove-image">×</span>
                                    </div>
                                </div>
                                <input type="hidden" name="volume_discount_image" class="volume-discount-image" value="<?php echo esc_attr($item['volume_discount_image']); ?>">
                                <button type="button" class="button volume-discount-image-button"><?php echo esc_html__('Select Image', 'vemus'); ?></button>
                                <span class="label"><?php echo esc_html__('Unit', 'vemus'); ?></span>
                                <input type="text" name="unit" value="<?php echo esc_attr($item['unit']); ?>" >
                            </div>
                            <span class="tf-button remove-item-btn"><?php echo esc_html__('Remove', 'vemus'); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                    <span class="tf-button new-item-btn"><?php echo esc_html__('Add new', 'vemus'); ?></span>
                </div>
            </div>
        </div>
        <?php
    }

    public function save_volume_discount_data($post_id, $post, $update) {

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
        if (!isset($_POST['volume_discount_nonce']) || !wp_verify_nonce($_POST['volume_discount_nonce'], 'save_volume_discount')) return $post_id;
        
        if ($post->post_type != 'tf_volume_discount') return $post_id;
        
        if (isset($_POST['volume_discount_data'])) {
            $volume_discount_data = sanitize_text_field($_POST['volume_discount_data']);
            update_post_meta($post_id, '_volume_discount_data', $volume_discount_data);
        }

        if (isset($_POST['volume_discount_style'])) {
            $volume_discount_style = sanitize_text_field($_POST['volume_discount_style']);
            update_post_meta($post_id, '_volume_discount_style', $volume_discount_style);
        }

        if (isset($_POST['volume_discount_position'])) {
            $volume_discount_position = sanitize_text_field($_POST['volume_discount_position']);
            update_post_meta($post_id, '_volume_discount_position', $volume_discount_position);
        }

        if (isset($_POST['volume_discount_products'])) {
            $volume_discount_products = !empty($_POST['volume_discount_products']) ? $_POST['volume_discount_products'] : [];
            if (!is_array($volume_discount_products)) {
                $volume_discount_products = array($volume_discount_products);
            }
            $volume_discount_products = array_map('intval', $volume_discount_products);
            update_post_meta($post_id, '_volume_discount_products', $volume_discount_products);
        }else{
            update_post_meta($post_id, '_volume_discount_products', []);
        }

        return $post_id;
    }

    public function handle_search_products() {
        check_ajax_referer('tf_search_products_nonce', 'security');
        $search_term = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';

        if (empty($search_term)) {
            wp_send_json_success(array('items' => []));
            return;
        }

        $products = wc_get_products(array(
            'limit' => -1,
            's' => $search_term,
            'type' => array('simple', 'variable'),
        ));

        $results = array();
        foreach ($products as $product) {
            $results[] = array(
                'id' => $product->get_id(),
                'text' => $product->get_title(),
            );
        }

        wp_send_json_success(array('items' => $results));
    }

    public function apply_volume_discount_in_cart($cart) {
        if(!empty($_POST['tf_volume_discount_applied'])){
            return;
        }
        $_POST['tf_volume_discount_applied'] = true;

        if ($cart->is_empty()) {
            return;
        }

        $discount_list = $this->get_volume_discount_posts();

        if (empty($discount_list)) {
            return;
        }

        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            $product = $cart_item['data'];
            $quantity = $cart_item['quantity'];
            $product_id = empty($product->get_parent_id()) ? $product->get_id() : $product->get_parent_id();
            $highest_discount = 0;

            if (!empty($cart_item['tf_custom_bundle']) && !empty($cart_item['is_bundle_child'])) {
                continue;
            }

            foreach( $discount_list as $discount_id => $product_ids){
                if (in_array($product_id, $product_ids)) {
                    $volume_discount_data = get_post_meta( $discount_id, '_volume_discount_data', true);
                    $discount_items = json_decode( $volume_discount_data, true);

                    foreach ($discount_items as $item) {
                        if ($quantity >= $item['from'] && ( ( $quantity <= $item['to'] && $item['from'] < $item['to']) || empty($item['to']) ) ) {
                            if ($item['discount'] > $highest_discount) {
                                $highest_discount = $item['discount'];
                            }
                        }
                    }

                    if ($highest_discount > 0) {
                        $original_price = $product->get_price();
                        $new_price = $original_price - ($original_price * ($highest_discount / 100));
                        $product->set_price($new_price);
                    }

                    break;
                }
            }
        }

    }

    public function people_view_enqueue_scripts(){
        if(themesflat_get_opt('fake_view')){
            $random_from = max(1, themesflat_get_opt('fake_view_random_from'));
            $random_to = max(1, themesflat_get_opt('fake_view_random_to'));
            $interval = max(1000, themesflat_get_opt('fake_view_interval'));
            wp_localize_script(
                'themesflat-single-product', 'peopleViewData',
                [
                    'randomFrom' => $random_from,
                    'randomTo' => $random_to,
                    'interval' => $interval,
                ]
            );
        }
    }

    public function init_buy_now(){
        if(!themesflat_get_opt('tf_buy_now') || empty(themesflat_get_opt('tf_buy_now_query_arg')) ){
            return;
        }
        add_filter( 'woocommerce_add_to_cart_validation', [$this, 'tf_buy_now'] , 99, 1 );
    }

    public function tf_buy_now($passed){
        if( $passed ){
            if( !empty( $_REQUEST[themesflat_get_opt('tf_buy_now_query_arg')] ) && $_REQUEST[themesflat_get_opt('tf_buy_now_query_arg')] == $_REQUEST['add-to-cart']){
                unset($_REQUEST[themesflat_get_opt('tf_buy_now_query_arg')]);
                wc_empty_cart();
            };
        }
        return $passed;
    }

    public function remove_woocommerce_styles_scripts() {
        if (is_product()) {
            wp_dequeue_style('woocommerce-general');
            wp_dequeue_style('woocommerce-layout');
            wp_dequeue_style('woocommerce-smallscreen');
            wp_dequeue_style('woocommerce-inline');
            
            // wp_dequeue_script('wc-add-to-cart');
            // wp_dequeue_script('woocommerce');
            // wp_dequeue_script('woocommerce-cart');
            // wp_dequeue_script('wc-cart-fragments');
        }
    }

    public function custom_woocommerce_hooks_on_single_product() {

        remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);


        $gallery_layout = empty($_GET['gallery_layout']) ? themesflat_get_opt('tf_product_gallery_layout') : $_GET['gallery_layout'];

        add_action( 'woocommerce_single_product_summary', [$this, 'tf_custom_breadcums'], 1);    

        if( $gallery_layout == 'no_thumb' || $gallery_layout == 'middle_gallery' ){
            add_action( 'woocommerce_single_product_summary', [$this, 'tfwc_prev_next_product' ], 1);
        }
        add_action( 'woocommerce_single_product_summary', [$this, 'brands_html' ], 2);
        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );
        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

        if(themesflat_get_opt('tf_short_desc')){
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);
        }

        add_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_recent_sales_count' ], 11 );
        add_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_people_view' ], 12 );
        add_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_countdown' ], 12 );
        add_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_progress_sale' ], 12 );

        add_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_out_of_stock_notification' ], 13 );
        $this->gallery_layout();
        
        // add_action( 'woocommerce_single_product_summary', [ $this, 'woocommerce_template_add_to_cart_quantity'], 29 );
        add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'woocommerce_template_add_to_cart_quantity']);

        add_filter( 'woocommerce_single_product_image_thumbnail_html', [$this, 'single_product_image_thumbnail_html'], 10, 2 );
        add_filter( 'woocommerce_gallery_image_html_attachment_image_params', [$this, 'gallery_image_params'], 10, 4 );

        add_filter( 'woocommerce_product_single_add_to_cart_text', [$this, 'add_to_cart_button_text'], 10, 2 );

        // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

        add_action('woocommerce_grouped_product_list_before', function(){
            themesflat_remove_hook('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
            themesflat_remove_hook( 'woocommerce_product_add_to_cart_text', 'tfwc_product_add_to_cart_text', 10, 2 );
            add_filter('woocommerce_loop_add_to_cart_link', [$this, 'quick_add_button'] , 21, 3 );
        } );

        add_action('woocommerce_grouped_product_list_after', function(){
            add_filter('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
            add_filter( 'woocommerce_product_add_to_cart_text', 'tfwc_product_add_to_cart_text', 10, 2 );
            themesflat_remove_hook('woocommerce_loop_add_to_cart_link', [$this, 'quick_add_button'], 21, 3 );
        } );

        add_action('wp_footer', [$this, 'share_popup'] );

        add_filter( 'wcboost_variation_swatches_color_html', [$this, 'wcboost_variation_swatches_color_html' ], 20, 4);
        add_filter( 'wcboost_variation_swatches_image_html', [$this, 'wcboost_variation_swatches_image_html' ], 20, 4);
        add_filter( 'wcboost_variation_swatches_item_args', [$this, 'wcboost_variation_swatches_item_args' ], 20, 4 );

        add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [$this, 'tf_variation_swatches_dropdown_html' ], 120,2);

        $this->size_guide_position();

        add_action( 'woocommerce_after_add_to_cart_button', [$this, 'woocommerce_template_extra_wcboost_button' ], 11);
        add_action( 'woocommerce_end_add_to_cart_form', [$this, 'woocommerce_template_extra_button' ]);
        add_action( 'woocommerce_end_single_variation', [$this, 'woocommerce_template_extra_button' ]);
        
        add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_trust_seal' ], 11);
        add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_pickup_store' ], 11);
        $this->tabs_position();
        add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_product_share' ], 11);
        add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_delivery_info' ], 11);
        
        $this->volume_discount_position();

        add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_buyx_gety' ], 12);

        add_action( 'woocommerce_after_add_to_cart_form', [$this, 'sku_html' ], 12);
        add_action( 'woocommerce_after_add_to_cart_form', [$this, 'category_html' ], 13);

        add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_extra_desc' ], 14);
        add_action( 'woocommerce_after_single_product_summary', [$this, 'woocommerce_template_sticky_add_to_cart' ], 99 );
        $this->buy_together_position();
        // return;

        if(themesflat_get_opt('tf_countdown')){
            add_filter('woocommerce_available_variation', [$this, 'add_schedule_sale_to_variations'], 10, 3);
        }

        add_filter('woocommerce_available_variation', [$this, 'single_add_to_cart_text_variations'], 10, 3);

        add_action( 'woocommerce_after_single_product_summary', [$this, 'woocommerce_template_sticky_add_to_cart' ], 99 );

    }

    public function gallery_layout() {

        $gallery_layout = empty($_GET['gallery_layout']) ? themesflat_get_opt('tf_product_gallery_layout') :  $_GET['gallery_layout'];
        
        if( $gallery_layout == 'no_thumb'){

            add_filter('tf_single_main_classes', function($class){
                return 'tf-main-product tf-main-product-2';
            });

            add_filter('tf_single_container_classes', function($class){
                return 'container-layout-left';
            });

            add_filter('tf_single_left_col_classes', function($class){
                return 'col-lg-7 col-xxl-8';
            });

            add_filter('tf_single_right_col_classes', function($class){
                return 'col-lg-5 col-xxl-4';
            });
        }

        if( $gallery_layout == 'middle_gallery'){

            add_action('tf_single_product_summary_left' , [$this, 'tf_single_product_summary_left_content']);

            add_filter('tf_single_row_classes', function($class){
                return 'tf-main-product-grid';
            });

            add_filter('tf_single_left_col_classes', function($class){
                return 'main-grid-a';
            });

            add_filter('tf_single_right_col_classes', function($class){
                return 'main-grid-c';
            });
        }
    }

    public function tf_single_product_summary_left_content(){
        // woocommerce_template_single_rating();
        // woocommerce_template_single_title();
        // woocommerce_template_single_price();
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        do_action('woocommerce_single_product_summary');
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating');  
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title');
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price');

        
        remove_action( 'woocommerce_single_product_summary', [$this, 'tf_custom_breadcums' ], 1);
        remove_action( 'woocommerce_single_product_summary', [$this, 'tfwc_prev_next_product' ], 1);
        remove_action( 'woocommerce_single_product_summary', [$this, 'brands_html' ], 2);
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);

        remove_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_recent_sales_count' ], 11 );
        remove_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_people_view' ], 12 );
        remove_action( 'woocommerce_single_product_summary', [$this, 'tf_product_tabs_in_summary' ], 12 );
        remove_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_countdown' ], 12 );
        remove_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_progress_sale' ], 12 );
        remove_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_out_of_stock_notification' ], 13 );
    }

    public function add_schedule_sale_to_variations($variation_data, $product, $variation) {
        $sale_start_date = $variation->get_date_on_sale_from();
        $sale_end_date = $variation->get_date_on_sale_to();
    
        if ( $variation->is_on_sale() && $sale_start_date && $sale_end_date) {
            $current = new DateTime();
            $interval = $current->diff($sale_end_date);
            $seconds_remaining = $interval->days * 86400 + $interval->h * 3600 + $interval->i * 60 + $interval->s;

            if( new DateTime($sale_start_date) <= $current && $seconds_remaining > 0 ){
                $variation_data['countdown'] = $seconds_remaining;
            }
        }

        
        return $variation_data;
    }

    public function variation_available_gallery($variation_data, $product, $variation) {
        $variation_data['available_gallery'] = false;
        $images = get_post_meta($variation->get_id(), '_tf_variation_gallery', true); 
        if( empty($images) ){
            return $variation_data;
        }
        $attachment_ids = json_decode($images, true);
        if( !empty($attachment_ids) ){
            $variation_data['available_gallery'] = true;
        }
        return $variation_data;
    }

    public function single_add_to_cart_text_variations($variation_data, $product, $variation) {
        $variation_data['add_to_cart_text'] = $variation->single_add_to_cart_text();
        return $variation_data;
    }

    public function gallery_image_params( $params, $attachment_id, $image_size, $main_image ){
        if( empty($params['class']) ){
            $params['class'] = 'tf-image-zoom lazyload';
        }else{
            $params['class'] .= ' tf-image-zoom lazyload';
        }

        $params['data-zoom'] = $params['data-src'];

        return $params;
    }

    public function single_product_image_thumbnail_html($html, $post_thumbnail_id ){
        $pattern = '/<div[^>]*class="([^"]*)"/';
        $a_pattern = '/<a/';
        $classes = "";
        $a_classes = "item item-scroll-target tf-inner-zoom-box";
        $attributes = [];
        $pswp_width = '';
        $pswp_height = '';
        $classes .= " swiper-slide";
        $replacement = '<div class="${1} '. $classes .'"';
        $a_replacement = '<a class="'. $a_classes .'"';
        $html = preg_replace($pattern, $replacement, $html);
        $html = preg_replace($a_pattern, $a_replacement, $html);
        
        preg_replace('/\s+src="([^"]*)"/', ' data-src="$1"', $html);
        return $html;
    }

    public function select_option_button($html, $product, $args){
        $args['class'] = 'select-option-btn tf-btn btn-fill fw-medium animate-btn';
        $aria_describedby = isset( $args['aria-describedby_text'] ) ? sprintf( 'aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s"', esc_attr( $product->get_id() ) ) : '';
        echo sprintf(
            '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            '#',
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html__( 'Select options', 'vemus')
        );
    }

    public function quick_add_button($html, $product, $args){
        if( !$product->is_in_stock() ){
            $args['class'] = 'tf-btn btn-fill fw-medium animate-btn';
            return sprintf(
                '<a href="%s" class="%s">%s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
                // esc_html( $product->add_to_cart_text() )
                esc_html__( 'Read more', 'vemus' )
            );
        }

        if( $product->is_type('variable') ){
            $args['class'] = 'tf_quick_add_btn tf-btn btn-fill fw-medium animate-btn';
            $aria_describedby = isset( $args['aria-describedby_text'] ) ? sprintf( 'aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s"', esc_attr( $product->get_id() ) ) : '';
            return sprintf(
                '<a href="%s" %s data-quantity="%s" class="%s" %s>%s</a>',
                esc_url( $product->add_to_cart_url() ),
                $aria_describedby,
                esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
                isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
                // esc_html( $product->add_to_cart_text() )
                esc_html__( 'Quick Shop', 'vemus' )
            );
        }

        if( $product->is_type('external') ){
            $args['class'] = 'tf-btn btn-fill fw-medium animate-btn';
            $aria_describedby = isset( $args['aria-describedby_text'] ) ? sprintf( 'aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s"', esc_attr( $product->get_id() ) ) : '';
            return sprintf(
                '<a href="%s" %s class="%s">%s</a>',
                esc_url( $product->get_product_url() ),
                $aria_describedby,
                esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
                esc_html( $product->add_to_cart_text() )
            );
        }
        return $html;
    }

    public function add_to_cart_button_text( $text, $product){

        if( $product->is_in_stock() ){
            $text = themesflat_get_opt('single_add_to_cart_text');
        }

        if ( $product->is_type('external') ) {
            $text =  $product->get_button_text();
        }

        if( !$product->is_in_stock() ){
            $text = themesflat_get_opt('single_sold_out_text');
        }

        if($product->is_on_backorder()) {
			$text = themesflat_get_opt('single_pre_order_text');
		}
        return $text;
    }

    public function tf_custom_product_tabs($tabs){

        $last_tab = end($tabs);
        $new_priority = max($last_tab['priority'], 0) + 10;

        if( !themesflat_get_opt('tf_product_description_tab') ){
            unset($tabs['description']);
        }

        if( !themesflat_get_opt('tf_product_additional_info_tab') ){
            unset($tabs['additional_information']);
        }

        if( themesflat_get_opt('tf_product_shipping_tab') ){
            $tabs['shipping'] = array(
                'title'    => themesflat_get_opt('tf_product_shipping_text'),
                'priority' => $new_priority,
                'callback' => array( Woo_Single_Product_Hook::instance(), 'woocommerce_template_extra_link_shipping' ),
            );
        }

        if( themesflat_get_opt('tf_product_ask_question_tab') ){
            $tabs['ask_question'] = array(
                'title'    => esc_html( themesflat_get_opt('tf_product_ask_question_text') ),
                'priority' => $new_priority + 10,
                'callback' => array( Woo_Single_Product_Hook::instance(), 'woocommerce_template_extra_link_ask_question' ),
            );
        }

        if( !themesflat_get_opt('tf_product_reviews_tab') ){
            unset($tabs['reviews']);
        }else{
            $tabs['reviews']['priority'] = $new_priority + 20;
        }

        return $tabs;
    }

    public function tabs_position(){

        $tabs_position = empty ($_GET['product_tabs_pos']) ? themesflat_get_opt('tf_product_tabs_position') : $_GET['product_tabs_pos'];
        $style_bellow_cart = empty ($_GET['style_bellow_cart']) ? themesflat_get_opt('tf_product_tabs_style_bellow_cart') : $_GET['style_bellow_cart'];

        if( $tabs_position == "default"){
            add_filter( 'woocommerce_product_tabs', [ $this, 'tf_custom_product_tabs'], 20);
            return;
        }else{
            add_filter( 'woocommerce_product_tabs', function($tabs){ return [];}, 20);
        }

        if( $tabs_position == "below_cart"){

            if( $style_bellow_cart == "sidebar" ){

                add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_extra_link' ], 11);

                add_action('wp_footer', function(){
                    if( themesflat_get_opt('tf_product_description_tab') ){
                        $this->tf_product_description_tab_canvas();
                    }

                    if( themesflat_get_opt('tf_product_additional_info_tab') ){
                        $this->tf_product_additional_info_tab_canvas();
                    }

                    if( themesflat_get_opt('tf_product_reviews_tab') ){
                        $this->tf_product_reviews_tab_canvas();
                    }

                    if( themesflat_get_opt('tf_product_shipping_tab') ){
                        $this->woocommerce_template_extra_link_shipping();
                    }

                    if( themesflat_get_opt('tf_product_ask_question_tab') ){
                        $this->woocommerce_template_extra_link_ask_question();
                    }

                });

            }else{
                add_action( 'woocommerce_after_add_to_cart_form', [$this, 'tf_product_tabs_in_summary' ], 11 );
            }

        }else{
            add_action( 'woocommerce_single_product_summary', [$this, 'tf_product_tabs_in_summary' ], 12 );
        }
        
    }

    public function tf_product_tabs_in_summary(){
        wc_get_template( 'single-product/extras/product-tabs-in-summary.php' );
    }

    public function tf_product_description_tab_canvas(){
        ?>
            <div class="offcanvas offcanvas-end canvas-sidebar canvas-description" id="tf-vemus-description-tab" aria-modal="true" role="dialog">
                <div class="canvas-header align-items-start">
                    <h3 class="title fw-normal text-uppercase">
                        <?php esc_html_e('Description', 'vemus'); ?>
                    </h3>
                    <span class="icon-close link icon-close-popup p-0" data-bs-dismiss="offcanvas"></span>
                </div>
                <div class="canvas-body">
                    <?php woocommerce_product_description_tab(); ?>
                </div>
            </div>
        <?php
    }

    public function tf_product_additional_info_tab_canvas(){
        ?>
            <div class="offcanvas offcanvas-end canvas-sidebar canvas-additional-info" id="tf-vemus-additional-info-tab" aria-modal="true" role="dialog">
                <div class="canvas-header align-items-start">
                    <h3 class="title fw-normal text-uppercase">
                        <?php esc_html_e('Additional info', 'vemus'); ?>
                    </h3>
                    <span class="icon-close link icon-close-popup p-0" data-bs-dismiss="offcanvas"></span>
                </div>
                <div class="canvas-body">
                    <?php woocommerce_product_additional_information_tab(); ?>
                </div>
            </div>
        <?php
    }

    public function tf_product_reviews_tab_canvas(){

        ?>
            <div class="offcanvas offcanvas-end canvas-sidebar canvas-reviews" id="tf-vemus-reviews-tab" aria-modal="true" role="dialog">
                <div class="canvas-header align-items-start">
                    <h3 class="title fw-normal text-uppercase">
                        <?php esc_html_e('Reviews', 'vemus'); ?>
                    </h3>
                    <span class="icon-close link icon-close-popup p-0" data-bs-dismiss="offcanvas"></span>
                </div>
                <div class="canvas-body">
                    <?php comments_template(); ?>
                </div>
            </div>
        <?php
    }

    public function woocommerce_template_recent_sales_count(){
        echo '<div class="group-badges">';
        wc_get_template( 'single-product/extras/badges.php' );
        wc_get_template( 'single-product/extras/recent-sales-count.php' );       
        echo '</div>';
    }

    public function woocommerce_template_progress_sale(){
        wc_get_template( 'single-product/extras/progress-sale.php' );
    }

    public function woocommerce_template_countdown(){
        wc_get_template( 'single-product/extras/countdown.php' );
    }

    public function woocommerce_template_people_view(){
        wc_get_template( 'single-product/extras/people-view.php' );
    }

    public function woocommerce_template_extra_button(){
        wc_get_template( 'single-product/extras/extra-button.php' );
    }

    public function woocommerce_template_extra_wcboost_button($product_origin = null){
        global $product;
        if( empty($product) ){
            $product = $product_origin;
        }
        wc_get_template( 'single-product/extras/extra-wcboost-button.php' );
    }

    public function woocommerce_template_pickup_store(){
        wc_get_template( 'single-product/extras/pickup-store.php' );
    }

    public function woocommerce_template_extra_link(){
        wc_get_template( 'single-product/extras/extra-link.php' );
    }

    public function woocommerce_template_extra_link_shipping(){
        wc_get_template( 'single-product/extras/extra-link-shipping.php' );
    }

    public function woocommerce_template_extra_link_ask_question(){
        wc_get_template( 'single-product/extras/extra-link-ask-question.php' );
    }

    public function woocommerce_template_trust_seal(){
        wc_get_template( 'single-product/extras/trust-seal.php' );
    }

    public function woocommerce_template_product_share(){
        wc_get_template( 'single-product/extras/product-share.php' );
    }

    public function woocommerce_template_delivery_info(){
        wc_get_template( 'single-product/extras/delivery-info.php' );
    }

    public function woocommerce_template_extra_desc(){
        wc_get_template( 'single-product/extras/extra-description.php' );
    }

    public function woocommerce_template_size_guide(){
        wc_get_template( 'single-product/extras/size-guide.php' );
    }

    public function woocommerce_template_volume_discount(){
        $discount_list = $this->get_volume_discount_posts();
        wc_get_template( 'single-product/extras/volume-discount.php',
            [
                'discount_list' => $discount_list
            ]
        );
    }

    public function woocommerce_template_buyx_gety(){
        wc_get_template( 'single-product/extras/buyx-gety.php');
    }

    public function woocommerce_template_sticky_add_to_cart(){
        wc_get_template( 'single-product/extras/sticky-add-to-cart.php' );
    }

    public function woocommerce_template_buy_together(){
        wc_get_template( 'single-product/extras/buy-together.php' );
    }

    public function woocommerce_template_out_of_stock_notification(){   
        wc_get_template( 'single-product/extras/out-of-stock-notification.php' );
    }

    public function woocommerce_template_quick_add(){
        set_query_var( 'is_quick_add', true );
        wc_get_template( 'single-product/extras/quick-add.php' );
        set_query_var( 'is_quick_add', false );
    }

    public function woocommerce_template_add_to_cart_quantity(){
        global $product;
        if( empty($product) || !$product->is_type( 'simple' ) ) {
            return;
        }
        ?>
        <div class="tf-product-info-variant">
            <div class="variant-picker-item">
                <div class="tf-label label m-0 p-0 border-0">
                    <div class="d-flex justify-content-between variant-picker-label h6 fw-normal">
                        <span><?php echo _e('Quantity', 'vemus') ; // WPCS: XSS ok. ?></span>
                    </div>
                </div>
                <div class="tf-variation-items value border-0">
                    <?php wc_get_template( 'single-product/extras/add-to-cart-quantity.php'); ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function brands_html(){
        $single_brand = themesflat_get_opt('single_brand');
        
        global $product;

       

        $brands = wc_get_product_terms($product->get_id(), 'product_brand', array('fields' => 'ids'));
        if (!empty($brands && $single_brand == 1 )) {
            echo '<div class="brands">';
            $brand_links = [];
            foreach ($brands as $brand_id) {
                $brand_link = get_term_link($brand_id, 'product_brand');
                if (!is_wp_error($brand_link)) {
                    $brand_links[] = '<a href="' . esc_url($brand_link) . '">' . get_term($brand_id, 'product_brand')->name . '</a>';
                }
            }
            echo implode(', ', $brand_links);
            echo '</div>';
        }

       
    }

    public function category_html(){
        $single_category = themesflat_get_opt('single_category');
        global $product;

        $categories = wc_get_product_terms($product->get_id(), 'product_cat', array('fields' => 'ids'));
        if (!empty($categories) && $single_category ==  1) {
            echo '<div class="category">';
            echo '<span>' . __('Category', 'vemus') . ':</span><span class="content"> ';
            $category_links = [];
            foreach ($categories as $category_id) {
                $category_link = get_term_link($category_id, 'product_cat');
                if (!is_wp_error($category_link)) {
                    $category_links[] = '<a href="' . esc_url($category_link) . '">' . get_term($category_id, 'product_cat')->name . '</a>';
                }
            }
            echo implode(', ', $category_links);
            echo '</span>';
            echo '</div>';
        }
        
    }

    public function sku_html(){
        $single_sku = themesflat_get_opt('single_sku');

        global $product;      

        $sku = $product->get_sku();

        if ( $sku && $single_sku == 1 ) {
            echo '<div class=" category sku">';
            echo '<span>' . esc_html__('SKU:', 'vemus') . '</span><span class="content"> ' . esc_html($sku) . '</span>';
            echo '</div>';
        }
  
    }

    public function wcboost_variation_swatches_image_html($html, $args, $data, $term){
        $name  = is_object( $term ) ? $term->name : $term;
        return preg_replace(
            '/<img[^>]*>/i',
            '<div class="img">$0</div>
            <span class="tooltip">' . esc_html( $name ) . '</span>',
            $html);
    }

    public function wcboost_variation_swatches_color_html($html, $args, $data, $term){
        $name  = is_object( $term ) ? $term->name : $term;
        return preg_replace(
            '/<span class="wcboost-variation-swatches__name">[^>]*<\/span>/i',
            '$0
            <span class="tooltip">' . esc_html( $name ) . '</span>',
            $html);
    }

    public function tf_variation_swatches_dropdown_html($html, $args){
        $product   = $args['product'];
		$attribute = $args['attribute'];
        $options   = $args['options'];
        if( class_exists( 'WCBoost\VariationSwatches\Helper' ) ){

            $swatches_args = \WCBoost\VariationSwatches\Swatches::instance()->get_swatches_args( $product->get_id(), $attribute );
		    $swatches_args = wp_parse_args( $args, $swatches_args );
            if ( \WCBoost\VariationSwatches\Helper::is_swatches_type( $swatches_args['swatches_type'] ) ) {
                return $html;
            }
        }
        else{
            return $html;
        }

        $html = str_replace( 'class="', 'class="hidden ', $html );
        ob_start();
        ?>
            <div class="tf-variant-dropdown full" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="btn-select">
                    <span class="text-sort-value current-value"><?php echo wc_attribute_label($args['selected'] ?? ''); ?></span>
                    <span class="icon icon-arrow-down"></span>
                </div>
                <div class="dropdown-menu">
                    <?php foreach( $options as $option ): ?>
                        <div class="select-item <?php echo esc_attr($args['selected'] == $option ? 'active' : '');?>" data-value="<?php echo esc_attr($option); ?>">
                            <span class="text-value-item"><?php echo wc_attribute_label($option); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php
        return apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            'tf_variation_swatches_dropdown_html',
            sprintf(
                '<div class="tf-variation-dropdown-wrapper wcboost-variation-swatches">' .
                $html . ob_get_clean() .
                '</div>'
            ),
            $html, $args
        );

    }

    public function wcboost_variation_swatches_item_args($swatches_args, $attribute, $product_id){
        if($swatches_args['swatches_type'] == 'color' || $swatches_args['swatches_type'] == 'image'){
            if(empty($swatches_args['swatches_class']) ){
                $swatches_args['swatches_class'] = 'hover-tooltip';
            }else{
                $swatches_args['swatches_class'] .= ' hover-tooltip';
            }
        }
        return $swatches_args;
    }

    public function size_guide_position(){

        if(!themesflat_get_opt('tf_size_guide')){
            return;
        }
        
        global $product;
        $size_guide_data = $product->get_meta('_tf_size_guide_data');
        $size_guide_display = $product->get_meta('_tf_size_guide_display');

        if( empty($size_guide_display) ){
            $size_guide_display = themesflat_get_opt('tf_size_guide_display');
        }

        if( empty($size_guide_data) || empty(get_post_status($size_guide_data)) ){
            return;
        }
        
        if( $size_guide_display == 'tabs' ){
            add_filter('woocommerce_product_tabs',[$this, 'tfwc_size_guide_tab']);
        }

        if( $size_guide_display == 'button' ){
            // Modal
            add_action('wp_footer', [$this, 'size_guide_popup'] );

            $size_guide_button_position = $product->get_meta('_tf_size_guide_button_position');

            if( empty($size_guide_button_position) ){
                $size_guide_button_position = themesflat_get_opt('tf_size_guide_button_position');
            }

            switch ($size_guide_button_position) {
                case 'add-to-cart':
                    add_action( 'woocommerce_after_add_to_cart_button', [$this, 'size_guide_button'] );
                    // add_action( 'woocommerce_single_product_summary', [$this, 'size_guide_button' ], 31 );
                    break;
                case 'short-desc':
                    add_action( 'woocommerce_single_product_summary', [$this, 'size_guide_button' ], 21 );
                    break;
                case 'attribute':
                    $size_guide_attribute = $product->get_meta('_tf_size_guide_attribute');
                    if( empty($size_guide_attribute) ){
                        $size_guide_attribute = themesflat_get_opt('tf_size_guide_attribute');
                    }
                    add_action( 'tf_size_guide_pa_' . esc_attr( $size_guide_attribute ), [$this, 'size_guide_button'] );
                    break;
                default: // price
                    add_action( 'woocommerce_single_product_summary', [$this, 'size_guide_button' ], 11 );
                    break;
            }
        }
    }

    public function buy_together_position(){
        if(themesflat_get_opt('tf_buy_together')){
            global $product;
            $position = $product->get_meta('_tf_product_together_position');
            
            if( empty($position)){
                $position = themesflat_get_opt('tf_buy_together_position');
            }
            if( $position == 'left'){
                add_action( 'woocommerce_after_product_thumbnails', [$this, 'woocommerce_template_buy_together']);
            }else{
                add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_buy_together'], 14);
            }
        }
    }

    public function tfwc_size_guide_tab($tabs) {
        $tabs['size_guide_tab'] = array(
            'title'    => __('Size Guide', 'vemus'), 
            'priority' => 50, 
            'callback' => [$this,'size_guide_tabs'] 
        );
        return $tabs;
    }

    public function size_guide_tabs(){
        ?>
        <div class="modal-find-size size-guide-tabs">
            <?php $this->woocommerce_template_size_guide(); ?>
        </div>
        <?php
    }

    public function volume_discount_position(){
        global $product;
        
        $discount_list = $this->get_volume_discount_posts();
        $discount_post_id = '';
        foreach( $discount_list as $discount_id => $product_ids){
            if ( in_array($product->get_id(), $product_ids) ) {
                $discount_post_id = $discount_id;
                break;
            }
        }

        if ( empty($discount_post_id) ) {
            return;
        }

        switch ( get_post_meta( $discount_post_id , '_volume_discount_position', true) ) {
            case 'before':
                add_action( 'woocommerce_before_add_to_cart_form', [$this, 'woocommerce_template_volume_discount' ]);
                break;
                
            // case 'price':
            //     add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_volume_discount' ], 12);
            //     break;

            default:
                add_action( 'woocommerce_after_add_to_cart_form', [$this, 'woocommerce_template_volume_discount' ], 12);
                break;
        }
    }

    public function get_volume_discount_posts(){

        $discount_list = [];
        $args = [
            'post_type' => 'tf_volume_discount',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
            'fields' => 'ids'
        ];
    
        $post_ids = get_posts($args);

        if (empty($post_ids)) {
            return $discount_list;
        }

        foreach( $post_ids as $id){
            $discount_list[ $id ] = get_post_meta( $id , '_volume_discount_products', true);
        }

        return $discount_list;
    }

    public function size_guide_button(){
        global $product;
        if( empty($product) ){
            $product_id = get_the_ID();
        }else{
            $product_id = $product->get_id();
        }
        $is_quick_view = empty(get_query_var('is_quick_view_template')) ? false : true;
        ?>
            <span>
                <a href="#<?php echo esc_attr( $is_quick_view ? 'sizeGuideQV' : 'sizeGuide'); ?>" data-product_id="<?php echo esc_attr( $product_id ); ?>" data-bs-toggle="offcanvas" class="tf-btn-line style-line-2 fw-normal <?php echo esc_attr( $is_quick_view ? 'open-size-guide-btn' : ''); ?>">
                    <?php _e('Size Guide','vemus');?>
                </a>
            </span>
        <?php
    }
    
    public function size_guide_popup(){
        $product = wc_get_product(get_the_ID());
        $size_guide_data = $product->get_meta('_tf_size_guide_data');
        $size_guide_title = get_the_title($size_guide_data);
        ?>
            <div class="offcanvas offcanvas-end canvas-sidebar canvas-size modal-find-size" id="sizeGuide" aria-modal="true" role="dialog">
                <div class="canvas-header">
                    <h3 class="title fw-normal text-uppercase"><?php echo esc_html($size_guide_title); ?></h3>
                    <span class="icon-close link icon-close-popup" data-bs-dismiss="offcanvas"></span>
                </div>
                <div class="canvas-body">
                    <?php $this->woocommerce_template_size_guide(); ?>
                </div>
                    
            </div>
        <?php
    }

    public function size_guide_quick_view_popup(){
        global $product;

        if( empty( $product) ){
            $product = wc_get_product(get_the_ID());
        }

        if( empty( $product) ){
            ?>
                <div class="offcanvas offcanvas-end canvas-sidebar canvas-size modal-find-size" id="sizeGuideQV" aria-modal="true" role="dialog">
                </div>
            <?php
            return;
        }
        
        $size_guide_data = $product->get_meta('_tf_size_guide_data');
        $size_guide_title = get_the_title($size_guide_data);
        ?>
            <div class="offcanvas offcanvas-end canvas-sidebar canvas-size modal-find-size" id="sizeGuideQV" aria-modal="true" role="dialog">
                <div class="canvas-header">
                    <h3 class="title fw-normal text-uppercase"><?php echo esc_html($size_guide_title); ?></h3>
                    <span class="icon-close link icon-close-popup" data-bs-dismiss="offcanvas"></span>
                </div>
                <div class="canvas-body">
                    <?php $this->woocommerce_template_size_guide(); ?>
                </div>
                <div class="canvas-footer">
                    <div class="overlay-close" data-bs-dismiss="offcanvas"></div>
                </div>
            </div>
        <?php
    }

    public function question_popup(){
        ?>
            <div class="offcanvas offcanvas-end canvas-sidebar canvas-description" id="askQuestion" aria-modal="true" role="dialog">
                <div class="canvas-header align-items-start">
                    <h3 class="title fw-normal text-uppercase"><?php _e('Ask a Question' , 'vemus'); ?></h3>
                    <span class="icon-close link icon-close-popup p-0" data-bs-dismiss="offcanvas"></span>
                </div>
                <div class="canvas-body">
                    <?php
                        echo do_shortcode( html_entity_decode(themesflat_get_opt('tf_question_form_shortcode')) );
                    ?>
                </div>
            </div>
        <?php
    }

    public function share_popup(){
        global $product;
        ?>
            <div class="modal modalCentered fade modal-share-social popup-style-2" id="shareSocial" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="title text-xl-2 fw-medium"><?php _e('Share','vemus');?></span>
                            <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                        </div>
                        <div class="wrap-code style-1">
                            <div class="coppyText" id="coppyText"><?php echo esc_url($product->get_permalink()); ?></div>
                            <div class="btn-coppy-text tf-btn animate-btn d-inline-flex w-max-content" id="btn-coppy-text"><?php _e('Copy','vemus');?>
                            </div>
                        </div>
                        <ul class="topbar-left tf-social-icon style-1">
                            <?php
                                echo themesflat_render_social(
                                    '',
                                    [
                                        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(get_permalink()),
                                        'instagram' => 'https://www.instagram.com/?url=' . urlencode(get_permalink()),
                                        'twitter' => 'https://x.com/intent/tweet?url' . urlencode(get_permalink()) . '&text=' . urlencode(get_the_title()),
                                        'snapchat' => 'https://www.snapchat.com/scan?attachment_url=' . urlencode(get_permalink())
                                    ],
                                );
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
    }

    public function extra_link(){
        if( themesflat_get_opt('extra_link_description') ){
            $this->woocommerce_template_extra_link_description();
        }

        if( themesflat_get_opt('extra_link_shipping') ){
            $this->woocommerce_template_extra_link_shipping();
        }

        if( themesflat_get_opt('extra_link_ask_question') ){
            $this->woocommerce_template_extra_link_ask_question();
        }
    }

    public function quick_add_popup(){
        ?>
        <div class="modal fade modalCentered popup-quickadd modal-quick-add tf-quick-add-modal" style="<?php echo esc_attr('display: none;'); ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span> -->
                    <div class="main-product-quickadd card-product">
                        <!--  -->
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function quick_add_content(){
        check_ajax_referer('tfwc_nonce', 'security');
        if( empty($_POST['quick_add_id']) ){
            return wp_send_json_error();
        }
        global $product;
        $product_id = intval($_POST['quick_add_id']);
        $product = wc_get_product($product_id);
        if( !$product ){
            return wp_send_json_error();
        }

        add_filter( 'wcboost_variation_swatches_color_html', [$this, 'wcboost_variation_swatches_color_html' ], 20, 4);
        add_filter( 'wcboost_variation_swatches_image_html', [$this, 'wcboost_variation_swatches_image_html' ], 20, 4);
        add_filter( 'wcboost_variation_swatches_item_args', [$this, 'wcboost_variation_swatches_item_args' ], 20, 4 );
        add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [$this, 'tf_variation_swatches_dropdown_html' ], 120,2);
        add_filter( 'woocommerce_product_single_add_to_cart_text', [ $this, 'add_to_cart_button_text'], 10, 2 );
        add_filter('woocommerce_available_variation', [$this, 'single_add_to_cart_text_variations'], 10, 3);
        themesflat_remove_hook( 'wcboost_wishlist_loop_add_to_wishlist_link', 'tfwc_wishlish_button' , 20, 2 );
        themesflat_remove_hook( 'wcboost_products_compare_loop_add_to_compare_link', 'tfwc_compare_button' , 20, 2 );
    
        add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'woocommerce_template_extra_wcboost_button' ], 11);

        add_action('woocommerce_grouped_product_list_before', function(){
            themesflat_remove_hook('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
            themesflat_remove_hook( 'woocommerce_product_add_to_cart_text', 'tfwc_product_add_to_cart_text', 10, 2 );
            add_filter('woocommerce_loop_add_to_cart_link', [ Woo_Single_Product_Hook::instance(), 'quick_add_button'] , 21, 3 );
        } );

        if(themesflat_get_opt('tf_out_of_stock_notification')){
            add_filter( 'woocommerce_out_of_stock_message', '__return_empty_string' );
        }
        add_action( 'woocommerce_end_add_to_cart_form', [$this, 'woocommerce_template_extra_button' ]);
        add_action( 'woocommerce_end_single_variation', [$this, 'woocommerce_template_extra_button' ]);
        ob_start();
        $this->woocommerce_template_quick_add();
        return wp_send_json_success(
            [
                'content' => ob_get_clean()
            ]
        );
    }   

    public function compare_popup(){
        global $product;
        ?>
            <div class="modal modalCentered fade modal-compare" id="compare" style="<?php echo esc_attr('display: none;'); ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <span class="icon icon-close btn-hide-popup" data-bs-dismiss="modal"></span>
                        <div class="modal-compare-wrap list-file-delete">
                            <h6 class="title text-center"><?php echo esc_html__('Compare Products','vemus');?></h6>
                            <div class="tf-compare-inner">
                                <div class="tf-compare-list">
                                    <?php
                                        $items = \WCBoost\ProductsCompare\Plugin::instance()->list->get_items();
                                        $clear_url = \WCBoost\ProductsCompare\Helper::get_clear_url();
                                        $product_ids = array_values($items);
                                        foreach ( $product_ids as $product_id ) {
                                            $product = wc_get_product( $product_id );
                                
                                            if ( ! $product ) {
                                                continue;
                                            }
                                            $image_url_large = wp_get_attachment_url( $product->get_image_id() );
                                            $remove_url = \WCBoost\ProductsCompare\Helper::get_remove_url( $product );
                                            ?>
                                            <div class="tf-compare-item file-delete">
                                                <span class="icon-close remove tf-remove-compare" data-remove-url="<?php echo esc_url($remove_url); ?>"></span>
                                                <a href="<?php echo esc_url($product->get_permalink()); ?>" class="image" target="_blank">
                                                    <img class="lazyload" data-src="<?php echo esc_url($image_url_large); ?>" src="<?php echo esc_url($image_url_large); ?>" alt="<?php echo esc_html($product->get_title()); ?>">
                                                </a>
                                                <div class="content">
                                                    <div class="text-title">
                                                        <a class="link text-line-clamp-2" href="<?php echo esc_url($product->get_permalink()); ?>" target="_blank"><?php echo esc_html($product->get_title()); ?></a>
                                                    </div>
                                                    <p class="price-wrap tf-price">
                                                        <?php echo wp_kses_post($product->get_price_html()); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="tf-compare-buttons justify-content-center">
                                <a href="<?php echo esc_html(wc_get_page_permalink( 'compare' )); ?>" class="tf-btn animate-btn justify-content-center" target="_blank"><?php echo esc_html__('Compare','vemus');?></a>
                                <div class="tf-btn btn-out-line-dark justify-content-center clear-file-delete tf-clear-compare" data-clear-url="<?php echo esc_url($clear_url); ?>">
                                    <span><?php echo esc_html__('Clear All','vemus');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    public function tf_custom_breadcums() {
        $gallery_layout = empty($_GET['gallery_layout']) ? themesflat_get_opt('tf_product_gallery_layout') : $_GET['gallery_layout'];
        $breadcrumb = themesflat_get_opt('breadcrumb_woo_single');
        if ( $breadcrumb  == 1 && ( $gallery_layout == 'no_thumb' || $gallery_layout == 'middle_gallery') ):                
            themesflat_breadcrumb();
        endif;
    }
    
    public function tfwc_prev_next_product() {
        ob_start();
        $single_navigation = themesflat_get_opt('single_navigation');
        if ($single_navigation == 1) {
            echo '<div class="group-breadcrumb">';                        
                echo '<div class="product-navigation">';
                global $post;
                
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,  
                    'orderby' => 'title',
                    'order' => 'ASC', 
                    'fields' => 'ids'
                );
                
                $product_ids = get_posts( $args );

                $terms = wp_get_post_terms($post->ID, 'product_cat');
                if ( !empty($terms) ) {
                    $category = $terms[0];
                    $category_name = $category->name; 
                    $category_link = get_term_link($terms[0]);
                    
                } else {
                    $category_name = 'Shop';
                    $category_link = get_post_type_archive_link('product');
                }
            
                $current_index = array_search( $post->ID, $product_ids );

                $prev_product_id = isset( $product_ids[$current_index - 1] ) ? $product_ids[$current_index - 1] : null;
                $next_product_id = isset( $product_ids[$current_index + 1] ) ? $product_ids[$current_index + 1] : null;
                
                if ( $prev_product_id ) {
                    $prev_product_name = get_the_title($prev_product_id);
                    $prev_product_link = get_permalink( $prev_product_id );
                    echo '<a class="prev-product hover-tooltip tooltip-top" href="' . esc_url( $prev_product_link ) . '">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8467 2.77838C12.1761 3.10789 12.1761 3.64212 11.8467 3.97162L6.81824 9L11.8467 14.0284C12.1761 14.3579 12.1761 14.8921 11.8467 15.2216C11.5171 15.5511 10.9829 15.5511 10.6534 15.2216L5.02837 9.59665C4.69891 9.26713 4.69891 8.73287 5.02837 8.40336L10.6534 2.77838C10.9829 2.44887 11.5171 2.44887 11.8467 2.77838Z" fill="currentColor"/>
                            </svg>';
                    echo '<span class="tooltip">'. esc_html($prev_product_name).'</span></a>';
                }

                echo '<div class="home-icon">';
                echo '<a href="' .  esc_url($category_link) . '" class="hover-tooltip tooltip-top">';
                echo '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_7884_21395)">
                            <path d="M6.90594 0H2.31281C1.03754 0 0 1.03754 0 2.31281V6.90594C0 8.18121 1.03754 9.21875 2.31281 9.21875H6.90594C8.18121 9.21875 9.21875 8.18121 9.21875 6.90594V2.31281C9.21875 1.03754 8.18121 0 6.90594 0ZM7.65625 6.90594C7.65625 7.31965 7.31965 7.65625 6.90594 7.65625H2.31281C1.8991 7.65625 1.5625 7.31965 1.5625 6.90594V2.31281C1.5625 1.8991 1.8991 1.5625 2.31281 1.5625H6.90594C7.31965 1.5625 7.65625 1.8991 7.65625 2.31281V6.90594Z" fill="currentColor"/>
                            <path d="M17.6562 0H13.125C11.8327 0 10.7812 1.05141 10.7812 2.34375V6.875C10.7812 8.16734 11.8327 9.21875 13.125 9.21875H17.6562C18.9486 9.21875 20 8.16734 20 6.875V2.34375C20 1.05141 18.9486 0 17.6562 0ZM18.4375 6.875C18.4375 7.30578 18.087 7.65625 17.6562 7.65625H13.125C12.6942 7.65625 12.3437 7.30578 12.3437 6.875V2.34375C12.3437 1.91297 12.6942 1.5625 13.125 1.5625H17.6562C18.087 1.5625 18.4375 1.91297 18.4375 2.34375V6.875Z" fill="currentColor"/>
                            <path d="M6.90594 10.7812H2.31281C1.03754 10.7812 0 11.8188 0 13.0941V17.6872C0 18.9625 1.03754 20 2.31281 20H6.90594C8.18121 20 9.21875 18.9625 9.21875 17.6872V13.0941C9.21875 11.8188 8.18121 10.7812 6.90594 10.7812ZM7.65625 17.6872C7.65625 18.1009 7.31965 18.4375 6.90594 18.4375H2.31281C1.8991 18.4375 1.5625 18.1009 1.5625 17.6872V13.0941C1.5625 12.6804 1.8991 12.3437 2.31281 12.3437H6.90594C7.31965 12.3437 7.65625 12.6804 7.65625 13.0941V17.6872Z" fill="currentColor"/>
                            <path d="M17.6562 10.7812H13.125C11.8327 10.7812 10.7812 11.8327 10.7812 13.125V17.6562C10.7812 18.9486 11.8327 20 13.125 20H17.6562C18.9486 20 20 18.9486 20 17.6562V13.125C20 11.8327 18.9486 10.7812 17.6562 10.7812ZM18.4375 17.6562C18.4375 18.087 18.087 18.4375 17.6562 18.4375H13.125C12.6942 18.4375 12.3437 18.087 12.3437 17.6562V13.125C12.3437 12.6942 12.6942 12.3437 13.125 12.3437H17.6562C18.087 12.3437 18.4375 12.6942 18.4375 13.125V17.6562Z" fill="currentColor"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_7884_21395">
                        <rect width="20" height="20" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>';
                    echo '<span class="tooltip">'.esc_html__('Back To ','vemus') . esc_html($category_name).'</span>';
                echo '</a>';
                echo '</div>';


                if ( $next_product_id ) {
                    $next_product_name = get_the_title($next_product_id);
                    $next_product_link = get_permalink( $next_product_id );
                    echo '<a class="next-product hover-tooltip tooltip-top" href="' . esc_url( $next_product_link ) . '">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.15334 15.2216C5.82389 14.8921 5.82389 14.3579 6.15334 14.0284L11.1818 9L6.15334 3.97164C5.82389 3.64213 5.82389 3.10787 6.15334 2.77835C6.48285 2.4489 7.01712 2.4489 7.34663 2.77835L12.9716 8.40335C13.3011 8.73287 13.3011 9.26713 12.9716 9.59664L7.34663 15.2216C7.01712 15.5511 6.48285 15.5511 6.15334 15.2216Z" fill="currentColor"/>
                            </svg>';
                    echo '<span class="tooltip">'. esc_html($next_product_name).'</span></a>';
                }
                echo '</div>';            
            echo '</div>'; 
        }
        echo ob_get_clean();
    }

}