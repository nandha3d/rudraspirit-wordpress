<?php
/**
 * Vemus Child Theme functions and definitions
 */

function vemus_child_enqueue_styles() {
    // Parent Styles
    wp_enqueue_style( 'vemus-style', get_template_directory_uri() . '/style.css' );
    
    // Child Styles
    wp_enqueue_style( 'vemus-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'vemus-style' ),
        wp_get_theme()->get('Version')
    );

    // Enqueue Alpine Wishlist Logic
    wp_enqueue_script( 'vemus-child-wishlist', get_stylesheet_directory_uri() . '/assets/js/wishlist.js', array( 'jquery' ), '1.0.0', true );
    
    // Localize script for AJAX
    wp_localize_script( 'vemus-child-wishlist', 'vemus_child_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}
add_action( 'wp_enqueue_scripts', 'vemus_child_enqueue_styles' );

/**
 * Enqueue Alpine.js for Hybrid Optimization
 */
function vemus_child_enqueue_alpine() {
    // Defer Alpine.js loading
    wp_enqueue_script( 'alpine-js', 'https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js', array(), '3.13.5', true );
    
    // Add 'defer' attribute to Alpine.js
    add_filter( 'script_loader_tag', function( $tag, $handle ) {
        if ( 'alpine-js' !== $handle ) {
            return $tag;
        }
        return str_replace( ' src', ' defer src', $tag );
    }, 10, 2 );
}
add_action( 'wp_enqueue_scripts', 'vemus_child_enqueue_alpine' );

/**
 * Render Alpine.js Wishlist Button
 */
/**
 * Render Alpine.js Wishlist Button
 */
function vemus_child_render_wishlist_button() {
    global $product;
    if ( ! $product ) return;

    $product_id = $product->get_id();
    
    // HTML structure matching Vemus theme's 'style-1' (sidebar icons)
    // We use 'box-icon' class to get the white square style.
    // Text is moved to a 'tooltip' span.
    echo sprintf(
        '<a href="#" 
           x-data="wishlistButton(%d)"
           @click.prevent="toggle()" 
           class="box-icon hover-tooltip" 
           :class="{ \'active\': inWishlist() }"
           aria-label="Add to wishlist">
            <span class="wcboost-wishlist-button__icon" x-html="getIcon()"></span>
            <span class="tooltip" x-text="getText()"></span>
        </a>',
        esc_attr($product_id)
    );
}
// Note: We do NOT add global hooks here anymore. 
// We will hook this function specifically in the overridden style template.

/**
 * Antigravity Fix:
 * The Vemus theme's template loader has a bug that prevents child theme overrides
 * for files called with extensions (like style-1.php).
 * Because of this, our child theme 'style-1.php' is ignored.
 * 
 * Since we deactivated the plugin, the parent theme skips adding the wishlist hooks.
 * We manually add them here to ensure the button appears.
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'tfwc_class_wishlist_open', 30 );
add_action( 'woocommerce_before_shop_loop_item_title', 'vemus_child_render_wishlist_button', 31 );
add_action( 'woocommerce_before_shop_loop_item_title', 'tfwc_class_wishlist_close', 32 );


/**
 * Wishlist Page Implementation
 */
// 1. Shortcode
add_shortcode( 'antigravity_wishlist', 'vemus_child_wishlist_shortcode' );
function vemus_child_wishlist_shortcode() {
    ob_start();
    ?>
    <div id="antigravity-wishlist-container" x-data="wishlistPage" x-init="init()" class="woocommerce">
        <!-- Loading State -->
        <div x-show="loading" class="text-center" style="padding: 20px;">
            <i class="fa fa-spinner fa-spin"></i> Loading wishlist...
        </div>
        
        <!-- Empty State -->
        <div x-show="!loading && products.length === 0" class="text-center" style="display: none; padding: 40px;">
            <p class="woocommerce-info">Your wishlist is currently empty.</p>
            <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="button btn primary">Return to Shop</a>
        </div>

        <!-- Product Grid -->
        <div class="products row" x-show="!loading && products.length > 0" style="display: none; display: flex; flex-wrap: wrap;">
            <template x-for="product in products" :key="product.id">
                 <div class="col-6 col-md-3 col-lg-3 product type-product">
                    <div class="product-wrapper">
                        <!-- Image -->
                        <div class="product-image">
                            <a :href="product.permalink">
                                <img :src="product.image" :alt="product.name" style="width: 100%; height: auto;">
                            </a>
                            <!-- Remove Button -->
                             <a href="#" @click.prevent="remove(product.id)" class="remove-wishlist" style="position:absolute; top:10px; right:10px; background:white; border-radius:50%; width:24px; height:24px; text-align:center; line-height:24px; z-index: 10; font-weight: bold; color: #333;">&times;</a>
                        </div>
                        <!-- Content -->
                        <div class="product-content" style="text-align: center; padding: 10px;">
                            <h3 class="product-title woocommerce-loop-product__title">
                                <a :href="product.permalink" x-text="product.name"></a>
                            </h3>
                            <span class="price" x-html="product.price_html" style="display: block; margin-bottom: 10px;"></span>
                            <!-- Add to Cart -->
                            <a :href="'?add-to-cart=' + product.id" class="button add_to_cart_button" x-text="product.stock_status === 'instock' ? 'Add to Cart' : 'Read More'"></a>
                        </div>
                    </div>
                 </div>
            </template>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// 2. AJAX Endpoint
add_action( 'wp_ajax_vemus_get_wishlist_products', 'vemus_child_get_wishlist_products' );
add_action( 'wp_ajax_nopriv_vemus_get_wishlist_products', 'vemus_child_get_wishlist_products' );

function vemus_child_get_wishlist_products() {
    $ids = isset($_POST['ids']) ? $_POST['ids'] : [];
    
    // Ensure IDs is an array (Handlebars/JS sometimes sends null/empty differently)
    if ( !is_array($ids) ) $ids = [];

    $products_data = [];
    foreach ( $ids as $id ) {
        $product = wc_get_product( $id );
        if ( $product ) {
            $products_data[] = [
                'id' => $product->get_id(),
                'name' => $product->get_name(),
                'permalink' => $product->get_permalink(),
                'image' => ( $img = wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_thumbnail' ) ) ? $img : wc_placeholder_img_src( 'woocommerce_thumbnail' ),
                'price_html' => $product->get_price_html(),
                'stock_status' => $product->get_stock_status(),
            ];
        }
    }
    wp_send_json_success($products_data);
}


// 3. Header Icon Shortcode (For Royal Addons)
add_shortcode( 'antigravity_wishlist_icon', 'vemus_child_wishlist_icon_shortcode' );
function vemus_child_wishlist_icon_shortcode() {
    ob_start();
    ?>
    <a href="<?php echo esc_url( home_url( '/my-wishlist' ) ); ?>" class="wishlist-btn-fragment" x-data style="position: relative; display: inline-block; color: inherit; text-decoration: none;">
        <!-- Use an SVG Heart to ensure it shows up regardless of theme fonts -->
        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;">
             <path d="M21.4064 5.34377C20.3874 4.32738 19.0075 3.75582 17.5683 3.75406C16.1291 3.7523 14.7478 4.3205 13.7264 5.33439L12.5001 6.47345L11.2729 5.33064C10.2518 4.31233 8.8679 3.74139 7.42577 3.74341C5.98365 3.74544 4.60139 4.32026 3.58308 5.34142C2.56478 6.36259 1.99383 7.74645 1.99585 9.18858C1.99788 10.6307 2.5727 12.013 3.59386 13.0313L11.9704 21.5306C12.0402 21.6015 12.1234 21.6578 12.2151 21.6962C12.3069 21.7346 12.4053 21.7544 12.5048 21.7544C12.6043 21.7544 12.7027 21.7346 12.7945 21.6962C12.8862 21.6578 12.9694 21.6015 13.0392 21.5306L21.4064 13.0313C22.4254 12.0116 22.9978 10.6291 22.9978 9.18752C22.9978 7.74596 22.4254 6.3634 21.4064 5.34377ZM20.3423 11.9775L12.5001 19.9313L4.65324 11.97C3.91478 11.2316 3.49991 10.23 3.49991 9.18564C3.49991 8.1413 3.91478 7.13973 4.65324 6.40127C5.3917 5.6628 6.39327 5.24794 7.43761 5.24794C8.48196 5.24794 9.48353 5.6628 10.222 6.40127L10.2407 6.42002L11.9892 8.04658C12.128 8.17574 12.3105 8.24754 12.5001 8.24754C12.6897 8.24754 12.8723 8.17574 13.0111 8.04658L14.7595 6.42002L14.7782 6.40127C15.5172 5.6633 16.519 5.24911 17.5634 5.24982C18.6077 5.25052 19.609 5.66606 20.347 6.40502C21.085 7.14398 21.4991 8.14582 21.4984 9.19017C21.4977 10.2345 21.0822 11.2358 20.3432 11.9738L20.3423 11.9775Z" fill="currentColor"/>
        </svg>
        <span class="count-box whishlist-items-count" 
              x-text="$store.wishlist.items.length" 
              x-show="$store.wishlist.items.length > 0"
              style="display: none; position: absolute; top: -8px; right: -8px; background: #e5775f; color: white; border-radius: 50%; font-size: 10px; width: 16px; height: 16px; line-height: 16px; text-align: center;" 
              x-show.important="$store.wishlist.items.length > 0">
            0
        </span>
    </a>
    <?php
    return ob_get_clean();
}

/**
 * Single Product Page Fixes
 * 1. Unhook the broken 'extra-wcboost-button.php' handler.
 * 2. Add Alpine Wishlist button with Single Product styling.
 */
add_action( 'woocommerce_before_single_product', 'vemus_child_fix_single_product_wishlist', 20 );
function vemus_child_fix_single_product_wishlist() {
    if ( class_exists( 'Woo_Single_Product_Hook' ) ) {
        remove_action( 'woocommerce_after_add_to_cart_button', [ Woo_Single_Product_Hook::instance(), 'woocommerce_template_extra_wcboost_button' ], 11 );
    }
}

add_action( 'woocommerce_after_add_to_cart_button', 'vemus_child_render_single_wishlist_button', 11 );

function vemus_child_render_single_wishlist_button() {
    global $product;
    if ( ! $product ) return;

    $product_id = $product->get_id();
    
    // Styling matching the Single Product "button" look
    // Using classes: product-extra-icon, tf-wishlist-btn, tf-btn-icon, hover-tooltip
    echo sprintf(
        '<a href="#" 
           x-data="wishlistButton(%d)"
           @click.prevent="toggle()" 
           class="product-extra-icon tf-wishlist-btn tf-btn-icon hover-tooltip wcboost-wishlist-button" 
           :class="{ \'active\': inWishlist(), \'added\': inWishlist() }"
           style="margin-left: 10px;"
           aria-label="Add to wishlist">
            <span class="icon" x-html="getIcon()"></span>
            <span class="tooltip" x-text="getText()"></span>
        </a>',
        esc_attr($product_id)
    );
}

/**
 * ====================================================================
 * Rudraksha Mukhi Interactive Showcase & Top Product Card System
 * ====================================================================
 */
require_once get_stylesheet_directory() . '/includes/class-vemus-rudraksha-data.php';
require_once get_stylesheet_directory() . '/includes/shortcode-rudraksha-mukhi.php';

add_filter( 'the_content', 'vemus_child_rudraksha_content_override', 20 );
function vemus_child_rudraksha_content_override( $content ) {
    if ( is_admin() || ( function_exists( 'is_product' ) && is_product() ) ) {
        return $content;
    }

    // Check if the current page or URL is one of our Rudraksha Mukhi sacred info pages
    if ( class_exists( 'Vemus_Rudraksha_Data' ) ) {
        $page_id = function_exists( 'get_the_ID' ) ? get_the_ID() : 0;
        $mukhi   = Vemus_Rudraksha_Data::get_mukhi_by_page_id( $page_id );
        if ( $mukhi > 0 ) {
            // Render the interactive showcase and top product card instead of static text
            return vemus_rudraksha_mukhi_shortcode( array( 'mukhi' => $mukhi ) );
        }
    }

    return $content;
}

/**
 * Automatically sort Rudraksha products numerically by Mukhi (1 Mukhi, 2 Mukhi, ..., 21 Mukhi, Gauri Shankar, Trijuti)
 */
add_filter( 'the_posts', 'vemus_child_sort_rudraksha_products_by_mukhi', 20, 2 );
function vemus_child_sort_rudraksha_products_by_mukhi( $posts, $query ) {
    if ( is_admin() && ! wp_doing_ajax() ) {
        return $posts;
    }
    // Only sort queries returning products
    if ( empty( $posts ) || ! is_array( $posts ) ) {
        return $posts;
    }
    
    // Check if at least one post is a product
    $has_product = false;
    foreach ( $posts as $p ) {
        if ( isset( $p->post_type ) && 'product' === $p->post_type ) {
            $has_product = true;
            break;
        }
    }
    if ( ! $has_product || ! class_exists( 'Vemus_Rudraksha_Data' ) ) {
        return $posts;
    }

    usort( $posts, function( $a, $b ) {
        $mukhi_a = Vemus_Rudraksha_Data::get_mukhi_by_page_id( $a->ID );
        $mukhi_b = Vemus_Rudraksha_Data::get_mukhi_by_page_id( $b->ID );

        // If both are recognized Rudrakshas (1 to 23)
        if ( $mukhi_a > 0 && $mukhi_b > 0 ) {
            return $mukhi_a - $mukhi_b;
        }
        // If only A is a Rudraksha, put it first
        if ( $mukhi_a > 0 && $mukhi_b === 0 ) {
            return -1;
        }
        // If only B is a Rudraksha, put it first
        if ( $mukhi_a === 0 && $mukhi_b > 0 ) {
            return 1;
        }
        // Otherwise maintain natural menu order / ID
        return $a->menu_order - $b->menu_order;
    });

    return $posts;
}

/**
 * Force-clean product delivery & guarantee trust badges (Remove "Free 30-day returns" and "$200 shipping")
 */
add_filter( 'theme_mod_tf_delivery_text2', '__return_empty_string' );
add_filter( 'theme_mod_tf_delivery_icon2', '__return_empty_string' );

add_filter( 'theme_mod_tf_delivery_text', function( $val ) {
    if ( empty( $val ) || strpos( $val, '$200' ) !== false || strpos( $val, '30-day' ) !== false ) {
        return 'Free Insured Express Shipping Across India';
    }
    return $val;
});

