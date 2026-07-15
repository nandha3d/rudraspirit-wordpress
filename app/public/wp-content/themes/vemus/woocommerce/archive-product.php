<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 10.3.4
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} 

$layout =themesflat_get_opt( 'shop_layout' );
if (isset($_GET['sidebar'])){
	$layout = sanitize_text_field($_GET['sidebar']);
}

?>

<?php get_header();?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area">

			<main id="main" class="post-wrap" role="main">

				<div class="content-woocommerce flat-spacing pt-0">
					<?php if ( have_posts() ) : ?>								
						<div class="meta-wrap clearfix">
						<?php
						?>
							<?php if(themesflat_get_opt('catalog_toolbar') == 1) {
								if ( $layout == 'sidebar-left' || $layout == 'sidebar-right' ) {
									wc_get_template( 'tpl/shop-control/control-sidebar.php' );
								}else if ($layout == 'filter-top') {
									wc_get_template( 'tpl/shop-control/control-top.php' );
								}else{
									wc_get_template( 'tpl/shop-control/control.php' );
								}
								?>
							<?php } ?>
							<div class="tf-sticky-filter-btn d-md-none">
								<a href="#">
									<span class="icon icon-sidebar"></span>
								</a>
							</div>
						</div>
						<div class="row">
							<?php 
								if ( $layout == 'sidebar-left' || $layout == 'sidebar-right' ) :
									$class_sidebar ='';
									if ($layout == 'sidebar-left') {
										$class_sidebar = 'left ';
									}

									if ($layout == 'sidebar-right') {
										$class_sidebar = 'right ';
									}
								?>
								<div class="filters-content col-xl-3">
									<div class="canvas-sidebar sidebar-filter canvas-filter <?php echo esc_attr($class_sidebar)?>">
										<div class="canvas-wrapper">
											<div class="canvas-header d-flex d-xl-none">
												<span class="title"><?php echo esc_html__('Filter','vemus');?></span>
												<span class="icon-close icon-close-popup close-filter"></span>
											</div>
											<div class="canvas-body">
												<div class="apply-filter-wrap">
													<p class="title h6 fw-normal text-uppercase d-xl-none"><?php _e('Applied Filters', 'vemus'); ?></p>
													<div id="product-count-grid" class="count-text text-main-4 d-xl-none" style="<?php echo esc_attr('display: none;'); ?>">
														<?php _e('No Filter Selected', 'vemus'); ?>
													</div>
													<div class="meta-filter-shop">
														<div id="product-count-grid" class="count-text"></div>
														<div id="applied-filters" class="check-yes selected-filters">
														</div>
													</div>
												</div>
												<?php
													// wc_get_template( 'tpl/shop-control/filter-sidebar.php' );
													dynamic_sidebar('shop-sidebar');
													if ($layout !== 'filter-top') {
														dynamic_sidebar('after-shop-sidebar');
													}
												?>
											</div>
											<?php if( themesflat_get_opt('filter_sidebar_button') || !empty($_GET['filter_sidebar_button']) ) : ?>
												<div class="canvas-bottom d-xl-none">
													<button id="tf-reset-filter" class="tf-btn btn-reset tf-clear-filters-btn">
														<span class="fw-medium"><?php _e('CLEAR ALL', 'vemus'); ?></span>
													</button>
													<button type="button" class="tf-btn btn-fill animate-btn tf-apply-filters-btn">
														<span class="fw-medium">
															<?php _e('APPLY', 'vemus'); ?>
															<span class="apply-filter-count">[<?php echo esc_html($count); ?> ]</span>
														</span>
													</button>
												</div>
											<?php endif; ?>
										</div>
									</div>
									<div class="overlay-filter" id="overlay-filter"></div>
								</div>
							<?php endif; ?>
							<div class="products-content col-xl-9 flex-grow-1">
								<?php
									$count = 0;
									woocommerce_product_loop_start();
								?>
								<?php woocommerce_product_subcategories(); ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<?php
										$count++;
										if ( is_shop() && themesflat_get_opt('image_box_product') ) {
											if ( $count == max(themesflat_get_opt('image_box_product_pos'), 0) ) {
												wc_get_template( 'tpl/shop-control/image-box.php' );
											}else{
												// wc_get_template_part( 'content', 'product' );
											}
										}else{
											// wc_get_template_part( 'content', 'product' );
										}
										wc_get_template_part( 'content', 'product' );
									?>
								<?php endwhile; // end of the loop. ?>
								<?php
									if ( is_shop() && themesflat_get_opt('image_box_product2') ) {
										wc_get_template( 'tpl/shop-control/image-box-2.php' );
									}
								?>
								<?php woocommerce_product_loop_end(); ?>

								<!-- woocommerce_after_main_content hook. -->
								<?php do_action( 'woocommerce_after_shop_loop' ); ?>
							</div>
						</div>
					<?php else : ?>
						<p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'vemus' ); ?></p>
					<?php endif; ?>
					<?php
					if ( class_exists( 'WooCommerce' ) ) {
						if ( is_product_category() ) {
							$term_id = get_queried_object()->term_id;

							$large_description = get_term_meta($term_id, '_large_description', true);
							
							if (!empty($large_description)) {
								echo '<div class="flat-spacing pb-0" id="large_des">
										<div class="container">';
										echo wp_kses_post($large_description);
								echo '</div>
								</div>';
							}
						}
					}
					?>
				</div>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>