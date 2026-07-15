<?php 
if ( is_page() && is_page_template( 'tpl/front-page.php' ) ) {
    return;
}

$titles = themesflat_get_page_titles();
ob_start();
if ( $titles['title'] ) { printf( '%s', wp_kses_post($titles['title']) ); }
$title = ob_get_clean();


?>
<!-- Page title -->
<?php
$page_title_heading = themesflat_get_opt('page_title_heading_enabled');
$breadcrumb = themesflat_get_opt('breadcrumb_enabled');

$page_title_alignment = themesflat_get_opt('page_title_alignment');

$page_title_count = themesflat_get_opt('page_title_count');

$page_title_description = themesflat_get_opt('page_title_description');
if (themesflat_get_opt_elementor('page_title_description') != '') {
    $page_title_description = themesflat_get_opt_elementor('page_title_description');
}

$page_title_description_content = themesflat_get_opt('page_title_description_content');
if (themesflat_get_opt_elementor('page_title_description_content') != '') {
    $page_title_description_content = themesflat_get_opt_elementor('page_title_description_content');
}

$page_title_alignment = themesflat_get_opt('page_title_alignment');
if (themesflat_get_opt_elementor('page_title_alignment') != '') {
    $page_title_alignment = themesflat_get_opt_elementor('page_title_alignment');
}

$single_navigation = themesflat_get_opt('single_navigation');
$page_title_class = '';

$is_single = false;

if ( class_exists( 'WooCommerce' ) ) {

    if ( is_product() ) {
        $is_single = true;

        $page_title_heading = themesflat_get_opt('page_title_heading_woo_single');
        $breadcrumb = themesflat_get_opt('breadcrumb_woo_single');
        $page_title_description = themesflat_get_opt('pagetitle_des_single');
        $page_title_description_content = themesflat_get_opt('page_title_description_content_woo_single'); 
        $page_title_class = 'tfwc-page-title';
    }
    elseif ( is_shop() || is_product_category() ) {
        $is_single = false;

        $page_title_heading = themesflat_get_opt('page_title_heading_woo');
        $breadcrumb = themesflat_get_opt('breadcrumb_woo');
        $page_title_text_btn = themesflat_get_opt('page_title_text_btn');
        $page_title_description = themesflat_get_opt('pagetitle_des');
        $page_title_description_content = themesflat_get_opt('page_title_description_content_woo'); 
        $page_title_alignment = themesflat_get_opt('page_title_alignment_woo');

        $page_title_class = 'tfwc-page-title';
    }
}

$gallery_layout = empty($_GET['gallery_layout']) ? themesflat_get_opt('tf_product_gallery_layout') : $_GET['gallery_layout'];

if( function_exists('is_product') && is_product() && ( $gallery_layout == 'no_thumb' || $gallery_layout == 'middle_gallery') ){
    return;
}

?>

<section class="tf-page-title <?php echo themesflat_get_opt_elementor('extra_classes_pagetitle'); ?>  <?php echo esc_attr($page_title_class); ?> ">
    <div class="container">
        <div class="page-title <?php echo esc_attr($page_title_alignment); ?>">

            <div class="breadcrumbs <?php echo esc_attr($page_title_description != 1 ? 'no-desc' : ''); ?>">
                <?php 
                    if ( $breadcrumb  == 1 ):                 
                        themesflat_breadcrumb(); 
                    endif; 
                ?>

                <?php
                    global $wp_query;
                    $count_post = (!is_single() && $wp_query->found_posts > 1) ? $wp_query->found_posts : '';
                ?>

                <?php if ($page_title_heading == 1): ?>

                    <?php if ($page_title_count == 1 && !is_single()): ?>
                        <h1 class="heading fw-normal text-uppercase"><?php echo wp_kses_post($title); ?> <span class="number-count"><?php echo wp_kses_post($count_post); ?></span></h1>
                    <?php else: ?>
                        <h1 class="heading fw-normal text-uppercase"><?php echo wp_kses_post($title); ?></h1>
                    <?php endif; ?>
                    
                <?php endif; ?>
                
 
            </div>

            <?php
                if( function_exists('is_product') && is_product() && class_exists('Woo_Single_Product_Hook') ){
                    Woo_Single_Product_Hook::instance()->tfwc_prev_next_product();
                }
            ?>

            <?php if ( function_exists( 'is_cart' ) && is_cart() ) : ?>

                <?php
                    if (themesflat_get_opt('free_shipping_bar') == 1) {
                        $amount   = 0;
                        $requires = '';
                        $discount = false;
                        $cart     = WC()->cart;
                    
                        if ($cart && !$cart->is_empty()) {
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
                                // ob_start();
        
                                ?>
                                    <div class="box-delivery">
                                        <h6 class="text fw-normal text-uppercase">
                                            <?php echo wp_kses_post( ($cart_total < $amount) ? $progress_text : $success_cart_text); ?>
                                        </h6>
                                        <div class="tf-progress-bar tf-progress-ship">
                                            <div class="value" style="width:0%;" data-progress="<?php echo esc_attr($percent); ?>">
                                                <i class="icon icon-delivery"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    }
                ?>

            <?php elseif ( function_exists( 'is_checkout' ) && is_checkout() ) : ?>
                <!-- Empty -->
            <?php elseif($page_title_description == 1 && !empty($page_title_description)): ?>
                <div class="box-text">
                    <p class="text-main-4">
                        <?php echo wp_kses_post($page_title_description_content); ?>
                    </p>
                </div>
            <?php endif; ?>
  
        </div>
    </div>
</section>
