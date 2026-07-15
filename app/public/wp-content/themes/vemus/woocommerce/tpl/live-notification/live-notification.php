<?php
if( themesflat_get_opt('live_notification') == 1) {

    function tfwc_orders() {
        check_ajax_referer('tfwc_nonce', 'nonce');
        $limit = themesflat_get_opt('live_number');
        $product_from = themesflat_get_opt('product_from');
        switch ($product_from) {
            case 'order':
                $status = themesflat_get_opt('live_status');
            
                $args = array(
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => -1,
                );

                $item_count = 0;  
                $orders = wc_get_orders($args);

                if (is_wp_error($orders) || empty($orders)) {
                    wp_send_json_error('No orders found.');
                    return;
                }
                

                shuffle($orders); 
                $products = []; 
            
                foreach ($orders as $order) {
                    $order_data = $order->get_data();
                    $order_id = $order_data['id'];
            
                    $order = wc_get_order($order_id); 
                    foreach ($order->get_items() as $item) {
                        if ($item_count >= $limit) {
                            break;  
                        }

                        $product = $item->get_product();
            
                        if (!is_object($product)) {
                            continue;
                        }
            
                        $product_name = $product->get_name();
                        $product_link = get_permalink($product->get_id());
                        $product_thumb = get_the_post_thumbnail($product->get_id(), 'tf-live-sale');
                        $first_name = $order->get_billing_first_name(); 
                        
                        $completed_date = $order->get_date_completed();
                        if ($completed_date) {
                            $completed_timestamp = strtotime($completed_date);
            
                            $time_passed = human_time_diff($completed_timestamp, current_time('timestamp'));
                        } else {
                            $time_passed = rand( 2, 20 ) . __(' days', 'vemus');
                        }
            
                        $products[] = [
                            'product_html'  => '<div class="live-notification animated">
                                                    <a class="live-notification-featured" href="' . esc_url($product_link) . '">
                                                        ' . $product_thumb . '
                                                    </a>
                                                    <div class="live-notification-content">
                                                        <div class="user">' . $first_name . ' ' . esc_html__('purchased', 'vemus') . '</div>
                                                        <h6 class="live-notification-name">
                                                            <a href="' . esc_url($product_link) . '">' . $product_name . '</a>
                                                        </h6>                                                       
                                                        <div class="live-notification-time">' . $time_passed . ' ' . esc_html__('ago', 'vemus') . '</div>
                                                    </div>
                                                     <span class="icon icon-close icon-close-notification"></span>
                                                </div>',
                        ];

                        $item_count++;
                    }
                }

                break;
            case 'type':
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'posts_per_page' => $limit,
                );
        
                switch( themesflat_get_opt('product_type')) {
                    case 'recent':
                        $orders = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
                        break;
        
                    case 'featured':
                        $orders = wc_get_featured_product_ids();
                        break;
        
                    case 'best_selling':
                        $args = array_merge( array(
                            'meta_key' => 'total_sales',
                            'order'    => 'DESC',
                            'orderby'  => 'meta_value_num',
                        ), $args );
        
                        $query = new \WP_Query( $args );
        
                        while ( $query->have_posts() ) { $query->the_post();
                            $orders[] = get_the_ID();
                        }
        
                        break;
        
                    case 'top_rated':
                        $args = array_merge( array(
                            'meta_key' => '_wc_average_rating',
                            'order'    => 'DESC',
                            'orderby'  => 'meta_value_num',
                        ), $args );
        
                        $query = new \WP_Query( $args );
        
                        while ( $query->have_posts() ) { $query->the_post();
                            $orders[] = get_the_ID();
                        }
        
                        break;
        
                    case 'sale':
                        $orders = wc_get_product_ids_on_sale();
                        break;
                }
        
                wp_reset_query();
        
                if( empty( $orders ) ) {
                    return;
                }

                $orders = array_map( 'wc_get_product', $orders );

                foreach ($orders as $product) {
                    if (!is_object($product)) {
                        continue;
                    }
            
                    $product_name = $product->get_name();
                    $product_link = get_permalink($product->get_id());
                    $product_thumb = get_the_post_thumbnail($product->get_id(), 'tf-live-sale');
                    $first_name = 'Somebody'; 
            
                    $time_passed = rand( 2, 20 ) . __(' days', 'vemus');
            
                    $products[] = [
                        'product_html'  => '<div class="live-notification animated">
                                            <a class="live-notification-featured" href="' . esc_url($product_link) . '">
                                                ' . $product_thumb . '
                                            </a>
                                            <div class="live-notification-content">
                                                <div class="user">' . $first_name . ' ' . esc_html__('purchased', 'vemus') . '</div>
                                                <h6 class="live-notification-name">
                                                    <a href="' . esc_url($product_link) . '">' . $product_name . '</a>
                                                </h6>
                                                
                                                <div class="live-notification-time">' . $time_passed . ' ' . esc_html__('ago', 'vemus') . '</div>
                                            </div>
                                            <span class="icon icon-close icon-close-notification"></span>
                                        </div>',
                    ];
                }

                break;
            case 'category':
                $category = themesflat_get_opt('live_category');
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => $limit,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'id',
                            'terms'    => (array) $category,
                            'operator' => 'IN',
                        ),
                    ),
                    
                );
                $query = new \WP_Query( $args );
        
                while ( $query->have_posts() ) { $query->the_post();
                    $orders[] = get_the_ID();
                }
                if( empty( $orders ) ) {
                    return;
                }

                $orders = array_map( 'wc_get_product', $orders );

                foreach ($orders as $product) {
                    if (!is_object($product)) {
                        continue;
                    }
            
                    $product_name = $product->get_name();
                    $product_link = get_permalink($product->get_id());
                    $product_thumb = get_the_post_thumbnail($product->get_id(), 'tf-live-sale');
                    $first_name = 'Somebody'; 
            
                    $time_passed = rand( 2, 20 ) . __(' days', 'vemus');
            
                    $products[] = [
                        'product_html'  => '<div class="live-notification animated">
                                                <a class="live-notification-featured" href="' . esc_url($product_link) . '">
                                                    ' . $product_thumb . '
                                                </a>
                                                <div class="live-notification-content">
                                                    <div class="user">' . $first_name . ' ' . esc_html__('purchased', 'vemus') . '</div>
                                                    <h6 class="live-notification-name">
                                                        <a href="' . esc_url($product_link) . '">' . $product_name . '</a>
                                                    </h6>
                                                    
                                                    <div class="live-notification-time">' . $time_passed . ' ' . esc_html__('ago', 'vemus') . '</div>                                                   
                                                </div>
                                                 <span class="icon icon-close icon-close-notification"></span>
                                        </div>',
                    ];
                }
                break;
        }


        if (empty($products)) {
            wp_send_json_error('No products found.');
        } else {
            wp_send_json_success($products); 
        }
    }
    add_action( 'wp_ajax_tfwc_live_notification', 'tfwc_orders' );
    add_action( 'wp_ajax_nopriv_tfwc_live_notification', 'tfwc_orders' );

    function tfwc_live_container() {
        echo '<div id="live-sales-container"></div>';
    }


    add_action('wp_footer', 'tfwc_live_container');
} 


?>