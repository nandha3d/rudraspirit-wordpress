<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 10.3.4
 */

defined( 'ABSPATH' ) || exit; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="wrap-content-area">
			    <div id="primary" class="content-area">
			        <main id="main" class="post-wrap" role="main">
			        	<div class="content-woocommerce">
							<?php
								// woocommerce_before_single_product hook.
								do_action( 'woocommerce_before_single_product' );

								if ( post_password_required() ) {
								 	echo get_the_password_form();
								 	return;
								}

								$class_title_single_products = 'no-title-single-product';
								if (themesflat_get_opt('product_featured_title') != '') {
								 	$class_title_single_products = 'has-title-single-product';
								}
							?>
							<?php
							global $product;
							global $post;
							$product_id = $product->get_id();
							$featured_image_url = get_the_post_thumbnail_url($product_id); 
							
							$i = 0; 
							$banner_img = get_post_meta( get_the_id(), 'tf_post_banner_img', true );
							$banner_img = explode( ',', $banner_img );
							$image_size = 'full';
							$count = count($banner_img);
							$count = $count - 1;
							?>
							

							<div id="product-<?php the_ID(); ?>" <?php post_class( 'woo-single-post-class '. $class_title_single_products ); ?>>
								<div class="product-wrap clearfix">
								    <?php if (isset($banner_img) && $count != 0 ) { ?>
									<div class="content-product-360-image" id="product-360-image">
										<div class="overlay-360-image"></div>
										<div class="product-360-image" data-image="<?php echo esc_attr($count); ?>" >
											<div class="button-close-360-image"><i class="vemus-icon-close"></i></div>
											<div class="images-display show">
												<?php
												if($count != 0 ) {
												?>
													<?php
														
														?>
														<ul class="images-list">
															<?php
															foreach ( $banner_img as $values ) {
																if ($i === 0) {
																	if ( $image_attributes = wp_get_attachment_image_src( $values, $image_size ) ) {
																		echo '<li class="images-display image-'. $i. ' active"><img src="'. $image_attributes[0]. ' " class="image-360" alt="image"></li>';
																	} $i = $i + 1;
																}
																else {
																	if ( $image_attributes = wp_get_attachment_image_src( $values, $image_size ) ) {
																		echo '<li class="images-display image-'. $i. '"><img src="'. $image_attributes[0]. ' " class="image-360" alt="image"></li>';
																	}
																	$i = $i + 1 ; 
																}
															}
														?>	
													</ul>
													<?php	} ?>
											</div>
											<div class="navigation-bar-wrapper">
												<div class="navigation-bar">
													<div class="navigation-bar-previous"></div>
													<div class="navigation-bar-play"></div>
													<div class="navigation-bar-next"></div>
													<div class="navigation-bar-resize"></div>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>
									<div class="sticky-sidebar">
										<?php
											// woocommerce_before_single_product_summary hook.
											do_action( 'woocommerce_before_single_product_summary' );
										?>
										<?php if (isset($banner_img) && $count != 0) { ?>
										<div class="button-360-image"><?php echo themesflat_svg('360deg') . esc_attr__( 'View', 'vemus' ) ?></div>
										<?php } ?>
									</div>

										<div class="summary entry-summary">
											<?php
												// woocommerce_single_product_summary hook.
												do_action( 'woocommerce_single_product_summary' );
											?>
										</div><!-- .summary -->
									</div><!-- .product-wrap -->

									<?php
										// woocommerce_after_single_product_summary hook.
										do_action( 'woocommerce_after_single_product_summary' );
									?>
							</div><!-- /#product-<?php the_ID(); ?> -->

							<?php do_action( 'woocommerce_after_single_product' ); ?>
						</div>
				    </main><!-- #main -->
					<?php //the_content(); ?>
				</div><!-- #primary -->
				<?php 
				if ( themesflat_get_opt( 'shop_layout' ) == 'sidebar-left' || themesflat_get_opt( 'shop_layout' ) == 'sidebar-right' ) :
					get_sidebar();
				endif;
				?>
			</div>
		</div><!-- /.col-md-12 -->
	</div><!-- /.row -->
</div><!-- /.container -->