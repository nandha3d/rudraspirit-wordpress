<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!class_exists('Woo_Hook')) {
	class Woo_Hook
	{
		public function __construct() {
			if( is_admin() ) {				
				add_action('init', array($this, 'actions'), 10);
			} else {				
				add_action('wp', array($this, 'actions'), 10 );				
			}

		}
		public function actions(){			
	
			
			add_action( 'wp_enqueue_scripts', array( $this, 'tfwc_enqueue_woo_scripts' ), 20 );

			// Disable WooCommerce styles
			add_filter( 'woocommerce_enqueue_styles', '__return_false' );

			// Remove breadcrumb (we're using the WooFramework default breadcrumb)
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

			// Removes the "shop" title on the main shop page
			add_filter( 'woocommerce_show_page_title', '__return_false' );

			// Add metafield Large Description
			add_action('product_cat_edit_form_fields', array( $this, 'tfwc_edit_large_description_category'), 10, 2);
			add_action('product_cat_add_form_fields', array( $this, 'tfwc_add_large_description_category'), 10, 2);
			add_action('edited_product_cat', array( $this,'tfwc_save_large_description_category'), 10, 2);
			add_action('create_product_cat', array( $this,'tfwc_save_large_description_category'), 10, 2);

			// Ajax search product
			add_action('wp_ajax_tfwc_search_products', array( $this,'tfwc_search_products'));
			add_action('wp_ajax_nopriv_tfwc_search_products', array( $this,'tfwc_search_products'));

			add_action('wp_ajax_tfwc_search_products_header', array( $this,'tfwc_search_products_header'));
			add_action('wp_ajax_nopriv_tfwc_search_products_header', array( $this,'tfwc_search_products_header'));

			// Free Shipping bar
			add_filter('woocommerce_add_to_cart_fragments', array( $this,'update_free_shipping_bar_fragments'));

			// Minicart bottom popup

			add_filter( 'woocommerce_checkout_get_value', array( $this,'tfwc_checkout_order_notes'), 10, 2 );

			add_action('woocommerce_checkout_update_order_meta', array( $this,'tfwc_save_order_note_to_order'));
			add_action('wp_ajax_save_order_note', array( $this,'tfwc_save_order_note_to_session'));
			add_action('wp_ajax_nopriv_save_order_note', array( $this,'tfwc_save_order_note_to_session'));

			add_action('wp_ajax_apply_coupon', array( $this,'tfwc_apply_coupon'));
			add_action('wp_ajax_nopriv_apply_coupon', array( $this,'tfwc_apply_coupon'));

			add_action( 'wp_ajax_nopriv_tfwc_remove_coupon',  array( $this,'tfwc_remove_coupon' ));
			add_action( 'wp_ajax_tfwc_remove_coupon',  array( $this,'tfwc_remove_coupon' ));

			add_action('wp_ajax_tfwc_save_shipping', array( $this, 'tfwc_save_shipping'));
			add_action('wp_ajax_nopriv_tfwc_save_shipping',array( $this, 'tfwc_save_shipping'));

			add_action('wp_ajax_tfwc_apply_gift', array( $this,'tfwc_apply_gift'));
			add_action('wp_ajax_nopriv_tfwc_apply_gift', array( $this,'tfwc_apply_gift'));
	
			add_action('woocommerce_cart_calculate_fees', array( $this,'tfwc_apply_gift_fee'));
			add_action('wp_ajax_tfwc_remove_gift', array( $this,'tfwc_remove_gift'));
			add_action('wp_ajax_nopriv_tfwc_remove_gift', array( $this,'tfwc_remove_gift'));

			add_action('wp_ajax_remove_cart_item', array( $this,'tfwc_remove_cart_item'));
			add_action('wp_ajax_nopriv_remove_cart_item', array( $this,'tfwc_remove_cart_item'));

			add_action( 'wp_ajax_tfwc_clear_cart', array($this, 'tfwc_clear_cart' ));
			add_action( 'wp_ajax_nopriv_tfwc_clear_cart', array( $this, 'tfwc_clear_cart'));

			add_action('wp_footer', array( $this,'tf_footer_shop'));


			// Live Notifications
			wc_get_template('tpl/live-notification/live-notification.php' );


			// Archive Shop
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ); 
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title' );
			remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price' );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			


			

			// Compare
			if( class_exists('\WCBoost\ProductsCompare\Frontend') ) {
				$compare = \WCBoost\ProductsCompare\Frontend::instance();
				remove_action( 'woocommerce_after_add_to_cart_form', array( $compare, 'single_add_to_compare_button' ) );
				remove_action( 'woocommerce_after_shop_loop_item', array( $compare, 'loop_add_to_compare_button' ), 15 );
				tfwc_get_template_part( '/product-base/compare.php' );
			}

			if( class_exists('\WCBoost\Wishlist\Frontend') ) {			
				tfwc_get_template_part( '/product-base/wishlish.php' );
			}
		
			tfwc_get_template_part( '/product-base/add-to-cart.php' );

			tfwc_get_template_part( '/product-base/quickview.php' );

			tfwc_get_template_part( '/product-base/unavailable.php' );

			tfwc_get_template_part( '/product-base/helpers.php' );		


			$product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
			if (isset($_POST['product_style'])) {
				$product_style = sanitize_text_field($_POST['product_style']);
			}


			if ( function_exists( 'wcboost_wishlist' ) ) {
				$wishlist_page_id = get_option( 'wcboost_wishlist_page_id' );
				if(is_page( $wishlist_page_id )) {
					$product_style = 'style-wishlist';
				} 
			}
			
			switch ($product_style) {
				case 'style-list':	
					tfwc_get_template_part( '/product-style/style-list.php' );
					break;
				case 'style-1': 
					tfwc_get_template_part( '/product-style/style-1.php' );
					break;
				case 'style-2':	
					tfwc_get_template_part( '/product-style/style-2.php' );
					break;
				case 'style-3':	
					tfwc_get_template_part( '/product-style/style-3.php' );
					break;
				case 'style-4':	
					tfwc_get_template_part( '/product-style/style-4.php' );
					break;
				case 'style-wishlist':	
					tfwc_get_template_part( '/product-style/style-wishlist.php' );
					break;
				default :
					tfwc_get_template_part( '/product-style/style-1.php' );
					break;
			}


			// Ajax filter 
			add_action('wp_ajax_filter_products', array( $this, 'tfwc_handle_ajax_filter_products' ));
			add_action('wp_ajax_nopriv_filter_products',array( $this, 'tfwc_handle_ajax_filter_products' ) );

			add_action( 'wp_ajax_tfwc_shop_pagination', array($this,'tfwc_shop_pagination') );
			add_action( 'wp_ajax_nopriv_tfwc_shop_pagination', array($this,'tfwc_shop_pagination')  );
		}

		public function tfwc_enqueue_woo_scripts()
		{	
			if ( ! wp_script_is( 'themesflat-countdown', 'enqueued' ) ) {
				wp_enqueue_script('themesflat-countdown', THEMESFLAT_LINK . 'assets/js/3rd/count-down.js', array('jquery'), null, true);
			}
			wp_enqueue_script('themesflat-shop', THEMESFLAT_LINK . 'assets/js/shop.js', array('jquery' , 'themesflat-toast', 'themesflat-countdown'), null, true);
			$filter_sidebar_button = '';

			if( themesflat_get_opt('filter_sidebar_button') || !empty($_GET['filter_sidebar_button']) ){
				$filter_sidebar_button = true;
			}

			wp_localize_script('themesflat-shop', 'tfwc_woo_params', array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('tfwc_nonce'),
				'live_timeout' => themesflat_get_opt('live_timeout'),
				'live_interval' => themesflat_get_opt('live_interval'),
				'live_notification' => themesflat_get_opt('live_notification'),
				'cart_url' => wc_get_cart_url(),
                'checkout_url' => wc_get_checkout_url(),
				'swatches_image_hover' => !empty(themesflat_get_opt('swatches_image_hover')) ,
				'buy_now' => themesflat_get_opt('tf_buy_now') && !empty(themesflat_get_opt('tf_buy_now_query_arg')) ? themesflat_get_opt('tf_buy_now_query_arg') : '',
				'filter_sidebar_button' => $filter_sidebar_button
			));
		}
	
		public function tfwc_handle_ajax_filter_products() {
			check_ajax_referer('tfwc_nonce', 'nonce');

			$shop_loadmore_text = themesflat_get_opt('shop_loadmore_text');
			if (isset($_POST['pagination_type']) && !empty($_POST['pagination_type'])) {
				$shop_pagination = sanitize_text_field($_POST['pagination_type']);
			} else {
				$shop_pagination = themesflat_get_opt('shop_pagination');
			}

			$availability = isset($_POST['availability']) ? $_POST['availability'] : [];
			$brand = isset($_POST['brand']) ? $_POST['brand'] : [];
			$category = isset($_POST['categories']) ? $_POST['categories'] : [];
		
			$price_min = isset($_POST['min_price']) && is_numeric($_POST['min_price']) ? intval($_POST['min_price']) : 0;
			$price_max = isset($_POST['max_price']) && is_numeric($_POST['max_price']) ? intval($_POST['max_price']) : 1000000;
			$price = isset($_POST['price']) ? intval($_POST['price']) : 0;
			$operator = isset($_POST['operator']) ? ($_POST['operator']) : '';

			$posts_per_page = isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : themesflat_get_opt('shop_products_per_page');
			$page = isset($_POST['page']) ? $_POST['page'] : 1; 

			$search_query = isset($_POST['s']) ? $_POST['s'] : '';

			$operator_allowed = ['=', '>', '<', '>=', '<='];

			$args = [
				'post_type'      => 'product',
				'posts_per_page' => $posts_per_page,
				'paged' => $page,
				'post_status' => 'publish',
				's' => $search_query,
				// 'meta_query'     => ['relation' => 'AND'],
				// 'tax_query'      => ['relation' => 'AND']
			];


			$sort_by = isset($_POST['sortValue']) ? sanitize_text_field($_POST['sortValue']) : '';

			switch ($sort_by) {
				case 'best-selling':
					$args['meta_key'] = 'total_sales';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'DESC';
					break;
				case 'a-z':
					$args['orderby'] = 'title';
					$args['order'] = 'ASC';
					break;
				case 'z-a':
					$args['orderby'] = 'title';
					$args['order'] = 'DESC';
					break;
				case 'price-low-high':
					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = '_price';
					$args['order'] = 'ASC';
					break;
				case 'price-high-low':
					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = '_price';
					$args['order'] = 'DESC';
					break;
				default:
					$args['orderby'] = 'title'; 
					$args['order'] = 'ASC';
					break;
			}

			$args['tax_query'][] = [
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'exclude-from-catalog',
				'operator' => 'NOT IN',
			];

			if (!empty($_POST['attributes']) && is_array($_POST['attributes'])) {
				foreach ($_POST['attributes'] as $attr_name => $values) {
					if (!empty($values)) {
						$args['tax_query'][] = array(
							'taxonomy' => $attr_name,  
							'field'    => 'id',  
							'terms'    => array_map('sanitize_title', $values), 
							'operator' => 'IN',  
						);
					}
				}
			}
		
			$args['meta_query'][] = [
				'relation' => 'AND',
				[
					'key'     => '_price',
					'value'   => array((float)$price_min, (float)$price_max),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN'
				]
			];

			if ( $price_min > 0 || $price_max < 1000000 ) {
				$args['tax_query'][] = [
					'taxonomy' => 'product_type',
					'field'    => 'slug',
					'terms'    => ['grouped'],
					'operator' => 'NOT IN',
				];
			}

			if( $price >= 0 && in_array($operator, $operator_allowed) ) {
				$args['meta_query'][] = [
					'relation' => 'AND',
					[
						'key'     => '_price',
						'value'   => (float)$price,
						'type'    => 'NUMERIC',
						'compare' => $operator
					]
				];
			}
			
			// Taxonomy

			if (!empty($category)) {
				$args['tax_query'][] = [
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $category,
					'operator' => 'IN',
				];
			}
				
			if (!empty($brand)) {
				$args['tax_query'][] = [
					'taxonomy' => 'pa_brand', 
					'field'    => 'slug',
					'terms'    => $brand,
					'operator' => 'IN'
				];
			}
		
			if (!empty($availability)) {
		
				if (in_array('On Sale', $availability)) {
					$product_ids_on_sale = wc_get_product_ids_on_sale();
					if (!empty($product_ids_on_sale)) {
						$args['post__in'] = $product_ids_on_sale;
					}
					
				}
			
				if (in_array('featured', $availability)) {

					$args['tax_query'][] = [
						// 'relation' => 'OR',
						[
							'taxonomy' => 'product_visibility',
							'field'    => 'name',
							'terms'    => 'featured',
							'operator' => 'IN',
						]
					];
					
				}
				if (in_array('In Stock', $availability)) {
					$availability_query[] = [
						'key'     => '_stock_status',
						'value'   => 'instock'
					];
				}
				if (in_array('Out Stock', $availability)) {
					$availability_query[] = [
						'relation' => 'OR',  
						[
							'key'   => '_stock_status',
							'value' => 'outofstock',
							'compare' => '='
						],
						[
							'key'     => '_stock_quantity',
							'value'   => 0,
							'compare' => '='
						]
					];
				}
		
				$args['meta_query'][] = $availability_query;
			}
		
			$query = new WP_Query($args);

			$product_count = $query->found_posts;

			if ($query->have_posts()) {
				$products = [];
				$count = 0;
				while ($query->have_posts()) {
					$count++;
					$query->the_post();
					ob_start();
					if (isset($_POST['product_style']) && !empty($_POST['product_style'])) {
						$product_style = sanitize_text_field($_POST['product_style']);
					}
					if ( $page == 1 && themesflat_get_opt('image_box_product') ) {
						if ( $count == max(themesflat_get_opt('image_box_product_pos'), 0) ) {
							wc_get_template( 'tpl/shop-control/image-box.php' );
						}else{
							// wc_get_template_part( 'content', 'product' );
						}
					}else{
						// wc_get_template_part( 'content', 'product' );
					}
					wc_get_template_part( 'content', 'product' );
					$products[] = ob_get_clean();
				}

				if ( $page == 1 && themesflat_get_opt('image_box_product2') ) {
					ob_start();
					wc_get_template( 'tpl/shop-control/image-box-2.php' );
					$products[] = ob_get_clean();
				}
				wp_reset_postdata();

				$next_page = (($page < $query->max_num_pages) ? true : false ) || ( $shop_pagination == 'number' && $query->max_num_pages != 1);

				if ($shop_pagination == 'number') {
					$pagination = '';
					ob_start();
					?>
					<div class="pagition-list d-flex flex-column justify-content-center align-items-center">
						<p><?php _e('Showing', 'vemus'); ?> <?php echo esc_html($query->post_count + ($posts_per_page * max($page - 1, 0) ) ); ?> of <?php echo esc_html($query->found_posts); ?> <?php _e('products', 'vemus'); ?></p>
					<?php
						echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(					
							'current'      => max( 1, $page ),
							'total'        => $query->max_num_pages,
							// 'format' => '?page/%#%',
							'prev_text'    => '<span class="tf-btn-line style-line-2"><span class="text-body">PREV</span></span>',
							'next_text'    => '<span class="tf-btn-line style-line-2"><span class="text-body">NEXT</span></span>',
							'type'         => 'list',
							'end_size'     => 1,
							'mid_size'     => 1,
						) ) );
					?>
					</div>
					<?php
					$pagination .= ob_get_clean(); 
				} else if ($shop_pagination == 'loadmore') {
					$pagination = '';
					$shop_loadmore_text = 'Load More';
					if ($page < $query->max_num_pages) {
						$pagination .= '
						<p>Showing '. esc_html($query->post_count + ($posts_per_page * max($page - 1, 0) ) ) .' of '. esc_html($query->found_posts) .' products</p>
						<button id="load-more-btn" class="tf-btn btn-outline-dark2 tf-loading-2 loadmore" data-page="' . ($page + 1) . '">
							<span class="text">' . esc_html($shop_loadmore_text) . '</span>
							<div class="spinner-circle">
								<span class="spinner-circle1 spinner-child"></span>
								<span class="spinner-circle2 spinner-child"></span>
								<span class="spinner-circle3 spinner-child"></span>
								<span class="spinner-circle4 spinner-child"></span>
								<span class="spinner-circle5 spinner-child"></span>
								<span class="spinner-circle6 spinner-child"></span>
								<span class="spinner-circle7 spinner-child"></span>
								<span class="spinner-circle8 spinner-child"></span>
								<span class="spinner-circle9 spinner-child"></span>
							</div>
						</button>';
					}
				} else if ($shop_pagination == 'autoload') {
					$pagination = '';
					if ($next_page) {
						$pagination = '
						<button id="autoload-btn" class="tf-btn btn-dark2 tf-loading animate-btn animate-dark" data-page="' . ($page + 1) . '">
							<div class="spinner-circle">
								<span class="spinner-circle1 spinner-child"></span>
								<span class="spinner-circle2 spinner-child"></span>
								<span class="spinner-circle3 spinner-child"></span>
								<span class="spinner-circle4 spinner-child"></span>
								<span class="spinner-circle5 spinner-child"></span>
								<span class="spinner-circle6 spinner-child"></span>
								<span class="spinner-circle7 spinner-child"></span>
								<span class="spinner-circle8 spinner-child"></span>
								<span class="spinner-circle9 spinner-child"></span>
							</div>
						</button>';
					}	
				}
				
				wp_send_json_success([
					'products'     => $products,
					'product_count' => $product_count,
					'pagination' => $pagination,
					'next_page' => $next_page,
				]);
			} else {
				wp_reset_postdata();
				wp_send_json_success([
					'products'     => '<p class="tf-no-results">No products were found matching your selection.</p>',
					'product_count' => 0,
					'next_page' => false
				]);
			}
			wp_die();
		}
	
		public function tfwc_edit_large_description_category($term) {
			$large_description = get_term_meta($term->term_id, '_large_description', true);
			?>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="large_description"><?php _e('Large Description', 'vemus'); ?></label>
				</th>
				<td>
					<?php
					wp_editor( $large_description, 'large_description', array(
						'textarea_name' => 'large_description',
						'textarea_rows' => 10,
						'editor_class' => 'large-description-editor'
					));
					?>
					<p class="description"><?php _e('Enter a detailed description for this category using the WYSIWYG editor.', 'vemus'); ?></p>
				</td>
			</tr>
			<?php
		}
		
		public function tfwc_add_large_description_category($taxonomy) {
			?>
				<div class="form-field">
					<label for="large_description"><?php _e('Large Description', 'vemus'); ?></label>
					<?php
					wp_editor( '', 'large_description', array(
						'textarea_name' => 'large_description',
						'textarea_rows' => 10,
						'editor_class' => 'large-description-editor'
					));
					?>
					<p class="description"><?php _e('Enter a detailed description for this category using the WYSIWYG editor.', 'vemus'); ?></p>
				</div>
			<?php
		}

		public function tfwc_save_large_description_category($term_id) {
			if (isset($_POST['large_description'])) {
				update_term_meta($term_id, '_large_description', wp_kses_post($_POST['large_description']));
			}
		}
		
		public function tfwc_search_products() {
			check_ajax_referer('tfwc_nonce', 'nonce');
			$query = sanitize_text_field($_POST['query']);
			$search_product_limit = themesflat_get_opt('search_product_limit');
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $search_product_limit,
				's'              => $query
			);
		
			$args['tax_query'][] = [
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'exclude-from-catalog',
				'operator' => 'NOT IN',
			];

			$results = [];
			$results_product = '';
			$results_categories = '';
			$results_suggestions = '';
			$results_view_all = '';
			$total_found = 0;
			$show_view_all = false;
		
			$search_query = new WP_Query($args);

			$total_found = $search_query->found_posts;
		
			if ($search_query->have_posts()) {
				$results_product = '';
				while ($search_query->have_posts()) {
					$search_query->the_post();

					$product =  wc_get_product( get_the_ID() );

					if ( ! $product || ! is_a( $product, 'WC_Product' ) || $product->get_catalog_visibility() !== 'visible' ) {
						continue;
					}

					ob_start();
					global $product;
					echo '<div class="swiper-slide">';
					wc_get_template_part('content', 'product');
					echo '</div>';
					$results_product .= ob_get_clean();
				}
				
			} else {
				// wp_send_json_success('<p class="tf-no-results">No products found.</p>');
			}

			$product_cats = get_terms([
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
				'name__like' => $query,
			]);
		
			if (!empty($product_cats) && !is_wp_error($product_cats)) {
				foreach ($product_cats as $cat) {
					$cat_link = get_term_link($cat);

					$highlighted_name = preg_replace(
						'/((' . preg_quote($query, '/') . '))/i',
						'<span class="tfwc-highlight">$1</span>',
						$cat->name
					);
					
					$results_categories .= '<div class="tfwc-category-item">
						<a href="' . esc_url($cat_link) . '">' . $highlighted_name . '</a>
					</div>';
				}
			}

			global $wpdb;

			if ($total_found > $search_product_limit) {
				$show_view_all = true;
			}

			if ($show_view_all) {
				$shop_page_url = get_permalink(wc_get_page_id('shop'));
				$search_url = add_query_arg('s', urlencode($query), $shop_page_url);
			
				$results_view_all = sprintf(
					'<a href="%s">%s</a>',
					esc_url($search_url),
					esc_html(sprintf(
						_n('View all %d product', 'View all %d products', $total_found, 'vemus'),
						$total_found
					))
				);
			}

			$results['products'] = $results_product;
			$results['categories'] = $results_categories;
			$results['suggestions'] = $results_suggestions;
			$results['total'] = $total_found;
			$results['show_view_all'] = $show_view_all;
			$results['view_all_html'] = $results_view_all;

			wp_send_json_success($results);
		
			wp_die();
		}
		
		public function tfwc_search_products_header() {
			check_ajax_referer('tfwc_nonce', 'nonce');
			$query = sanitize_text_field($_POST['query']);
			$category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
		
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => -1,
				's'              => $query
			);
		
			$args['tax_query'][] = [
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'exclude-from-catalog',
				'operator' => 'NOT IN',
			];

			if ( ! empty( $category ) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $category,
				);
			}
		
			$search_query = new WP_Query($args);
		
			if ($search_query->have_posts()) {
				$results = '';
				while ($search_query->have_posts()) {
					$search_query->the_post();
					global $product;
					ob_start();
					?>
					<li>
						<a class="search-result-item" href="<?php echo esc_url(get_permalink()); ?>">
							<div class="img-box">
								<img 
									class="lazyload" 
									data-src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')); ?>" 
									src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')); ?>" 
									alt="<?php echo esc_attr(get_the_title()); ?>"
								/>
							</div>
							<div class="box-content">
								<p class="title link"><?php echo esc_html(get_the_title()); ?></p>
								<div class="price">
									<?php if ( $product->is_on_sale() ) : ?>
										<span class="new-price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
									<?php else : ?>
										<span class="regular-price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
									<?php endif; ?>
								</div>
							</div>
						</a>
					</li>
					<?php
					$results .= ob_get_clean();
				}
				
				wp_send_json_success($results);
			} else {
				wp_send_json_success('<p class="tf-no-results">No products found.</p>');
			}
		
			wp_die();
		}

		public function update_free_shipping_bar_fragments($fragments) {
			if (themesflat_get_opt('free_shipping_bar') == 1) {
				$amount   = 0;
				$requires = '';
				$discount = false;
				$cart     = WC()->cart;
			
				if ($cart) {
					$packages = $cart->get_shipping_packages();
					$package  = reset($packages);
					$zone     = wc_get_shipping_zone($package);
			
					$free_shipping_method = null;
					foreach ($zone->get_shipping_methods(true) as $method) {
						if ('free_shipping' === $method->id) {
							$free_shipping_method = $method;
							break;
						}
					}
			
					if ($free_shipping_method) {
						$instance = $free_shipping_method->instance_settings;
						$amount   = isset($instance['min_amount']) ? $instance['min_amount'] : 0;
						$requires = isset($instance['requires']) ? $instance['requires'] : '';
						$discount = isset($instance['ignore_discounts']) && 'yes' === $instance['ignore_discounts'];
					}
			
					$cart_total   = $cart->get_displayed_subtotal();
					$currency     = get_woocommerce_currency_symbol();
					$remaining    = $amount - $cart_total;
					$percent      = ($amount > 0) ? min(100, 100 - ($remaining / $amount) * 100) : 0;
			
					$progress_cart_text = themesflat_get_opt('progress_cart_text');
					$success_cart_text  = themesflat_get_opt('success_cart_text');
			
					$progress_text = str_replace(
						['{currency}', '{total}'],
						[$currency, $remaining],
						$progress_cart_text
					);
			
					$shipping_bar = '';
					if ($amount > 0) {
						ob_start();

						?>
							<h6 class="text fw-normal text-uppercase">
								<?php echo wp_kses_post( ($cart_total < $amount) ? $progress_text : $success_cart_text); ?>
							</h6>
							<div class="tf-progress-bar tf-progress-ship">
								<div class="value" style="width:0%;" data-progress="<?php echo esc_attr($percent); ?>">
									<i class="icon icon-delivery"></i>
								</div>
							</div>
						<?php
						$shipping_contents = ob_get_clean();
					}
				}
			}
			$item_count = WC()->cart->get_cart_contents_count();
			ob_start();
			?>
				<div class="tf-mini-cart-threshold">
					<?php if( ! WC()->cart->is_empty() && !empty(WC()->cart) ) : ?>
						<?php echo wp_kses_post( $shipping_contents ?? ''); ?>
						<div class="tf-number-count">
							<p class="text-uppercase"><span class="prd-count"><?php echo esc_html($item_count) ; ?></span><?php echo _n( ' product', ' products', $item_count, 'vemus' ); ?></p>
							<a href="javascript:void(0)" class="tf-btn-line style-line-2 clear-file-delete tf-clear-cart-btn">
								<span class="text-body">
									<?php _e('Empty cart', 'vemus'); ?>
								</span>
							</a>
						</div>
					<?php endif; ?>
                </div>
			<?php
			$html = ob_get_clean();
			$fragments['.tf-mini-cart-threshold'] = $html;

			ob_start();
			?>
				<div class="box-delivery">
					<?php echo wp_kses_post( $shipping_contents ?? ''); ?>
				</div>
			<?php
			$box_shipping = ob_get_clean();

			$fragments['.box-delivery'] = $box_shipping;
		
			return $fragments;
		}
		
		public function tfwc_save_order_note_to_session() {
			check_ajax_referer('tfwc_nonce', 'nonce');
			if (isset($_POST['order_comments'])) {
				WC()->session->set('tfwc_order_note', sanitize_text_field($_POST['order_comments']));
				wp_send_json_success(['message' => 'Order note saved successfully']);
			}
			wp_die();
		}

		public function tfwc_save_order_note_to_order($order_id) {
			$note = WC()->session->get('tfwc_order_note');
			if (!empty($note)) {
				update_post_meta($order_id, '_customer_order_note', sanitize_text_field($note));
				WC()->session->__unset('tfwc_order_note'); 
			}
		}

		public	function tfwc_checkout_order_notes( $value, $input ) {
			if ( 'order_comments' === $input ) {
				$notes = WC()->session->get( 'tfwc_order_note','' );
				if ( ! empty( $notes ) ) {
					return $notes;
				}
			}
			return $value;
		}
		
		public function tfwc_apply_coupon() {
			check_ajax_referer('tfwc_nonce', 'nonce');
			if (isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])) {
				$coupon_code = sanitize_text_field($_POST['coupon_code']);
				
				if (WC()->cart->has_discount($coupon_code)) {
					wp_send_json_error(array(
						'message' => 'This coupon is already applied.'
					));
				}
		
				if (WC()->cart->add_discount( wc_format_coupon_code( wp_unslash( $coupon_code ) ) )) {
					WC()->cart->calculate_totals();					

					ob_start();
					wc_get_template( 'cart/minicart-totals.php' );
					$minicart_totals = ob_get_clean();

					wp_send_json_success(array(
						'message' => 'Coupon applied successfully! Please view card or checkout to check',
						'minicart_totals' => $minicart_totals
					));
				} else {
					wp_send_json_error(array(
						'message' => 'Invalid coupon code.'
					));
				}
				
			} else {
				wp_send_json_error(array(
					'message' => 'Coupon code is required.'
				));
			}

			wp_die();
		}

		public function tfwc_remove_coupon(){		
			check_ajax_referer('tfwc_nonce', 'nonce');
			if (isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])) {
				$coupon_code = sanitize_text_field($_POST['coupon_code']);
				WC()->cart->remove_coupon( $coupon_code );
				WC()->cart->calculate_totals();	

				ob_start();
				wc_get_template( 'cart/minicart-totals.php' );
				$minicart_totals = ob_get_clean();

				wp_send_json_success(array(
					'minicart_totals' => $minicart_totals
				));
				
				
			} else {
				wp_send_json_error(array(
					'message' => 'Coupon code is required.'
				));
			}

			wp_die();		   
			
		}
		
		public function tfwc_save_shipping() {
			check_ajax_referer('tfwc_nonce', 'nonce');
			$country   = sanitize_text_field($_POST['country']);
			$state     = sanitize_text_field($_POST['state']);
			$city      = sanitize_text_field($_POST['city']);
			$postcode  = sanitize_text_field($_POST['postcode']);
			
			$customer = WC()->customer;
		
			$country  = sanitize_text_field($_POST['country']);
			$state    = sanitize_text_field($_POST['state']);
			$city     = sanitize_text_field($_POST['city']);
			$postcode = sanitize_text_field($_POST['postcode']);
		
			$customer->set_shipping_country($country);
			$customer->set_shipping_state($state);
			$customer->set_shipping_city($city);
			$customer->set_shipping_postcode($postcode);
			
			$customer->save();
		
			WC()->cart->calculate_totals();
			WC()->session->set('shipping_country', $country);
			WC()->session->set('shipping_state', $state);
			WC()->session->set('shipping_city', $city);
			WC()->session->set('shipping_postcode', $postcode);
			
			wp_send_json_success('Shipping address updated!');
		}

		public function tfwc_apply_gift_fee() {
			
			if (WC()->session->get('tfwc_gift')) {
				foreach (WC()->cart->get_fees() as $fee) {
					if ($fee->name === 'Gift') {
						return;
					}
				}
		
				$tfwc_gift_fee = themesflat_get_opt('gift_fee'); 
				WC()->cart->add_fee(__('Gift', 'vemus'), (float) $tfwc_gift_fee);
			}
		}

		public function tfwc_apply_gift() {
			check_ajax_referer('tfwc_nonce', 'nonce');
			if (!WC()->cart) {
				wp_die();
			}

			if(WC()->session->get('tfwc_gift')){
				WC()->session->__unset('tfwc_gift');
			}else{
				WC()->session->set('tfwc_gift', true);
			}

			WC()->cart->calculate_totals();
		
			wp_die();
		}
		
		public function tfwc_remove_gift() {
			check_ajax_referer('tfwc_nonce', 'nonce');
			if (!WC()->cart) {
				wp_die();
			}

			WC()->session->__unset('tfwc_gift');
			WC()->cart->calculate_totals();

			echo json_encode(['success' => true, 'message' => 'Gift removed successfully']);
			wp_die();
		}

		public function tfwc_remove_cart_item() {
			check_ajax_referer('tfwc_nonce', 'nonce');		
			if ( isset( $_POST['cart_item_key'] ) ) {
				$cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );
		
				WC()->cart->remove_cart_item( $cart_item_key );
		
				WC_AJAX::get_refreshed_fragments();
				
				wp_send_json_success();
			} else {
				wp_send_json_error( array( 'message' => 'Cart item key is missing.' ) );
			}
		}

		public function tfwc_clear_cart() {
			if ( WC()->cart ) {
				WC()->cart->empty_cart();
				wp_send_json_success( 'Cart cleared' );
			} else {
				wp_send_json_error( 'Cart not available' );
			}
		}


		public function tf_footer_shop() {
			echo  get_template_part( 'woocommerce/mobile/footer-shop' );
		}
		
	}
}