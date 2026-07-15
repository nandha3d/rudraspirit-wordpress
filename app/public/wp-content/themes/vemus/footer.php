<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package vemus
 */
?>        
        </div><!-- #content -->
    </div><!-- #main-content -->


    <?php
    if (class_exists( 'WooCommerce' ) && (is_shop() || is_product_category())) {
        if (themesflat_get_opt('nav_mobile') == 1) {
            get_template_part( 'tpl/footer/icon-box');
        }
    }
    $class_bt = '';
    if ( class_exists( 'WooCommerce' ) && is_product() ) {
        global $product;
        if( $product->is_type( 'external' ) || $product->is_type( 'grouped' ) || $product->is_type( 'bundle' ) || $product->is_type( 'composite' ) ) {
            $class_bt = '';
        } else
        if ( $product->is_type( 'simple' ) && ! $product->is_in_stock() ) {
            $class_bt = '';
        } else {
            $class_bt = 'footer-pb-2';
        }
        
    }
    ?>

    <?php if (themesflat_get_opt_elementor('enable_shape_footer') == 'yes') : ?>
        <div class="cloud-footer">
            <img src="<?php echo esc_url(themesflat_get_opt_elementor('shape_footer')['url']); ?>" alt="shape">
        </div>
    <?php endif; ?>

        <!-- Footer -->
    <footer id="footer" class="footer_background footer-default <?php if (themesflat_get_opt('show_navigation_bar') == 1) {echo 'xl-pb-70 ' ;} ; echo esc_attr($class_bt) . ' ' ; echo themesflat_get_opt_elementor('extra_classes_footer'); ?> ">
        <div class="overlay-footer"></div>
        <div class="footer-wrap">
            <?php get_template_part( 'tpl/footer/top'); ?>
            <?php get_template_part( 'tpl/footer/footer-widgets'); ?>
            <?php get_template_part( 'tpl/footer/bottom'); ?>
        </div>
    </footer>
    <!-- /.Footer -->

    <?php if ( themesflat_get_opt( 'go_top') == 1 ) : ?>      
        <!-- Scroll Top -->
        <button id="goTop" class="<?php if ( class_exists( 'WooCommerce' ) && is_product() ) { echo 'is-single'; } ?>">
            <span class="border-progress"></span>
            <span class="icon icon-arrow-right-2"></span>
        </button>
    <?php endif; ?> 
</div><!-- /#boxed -->
<?php wp_footer(); ?>
</body>
</html>

