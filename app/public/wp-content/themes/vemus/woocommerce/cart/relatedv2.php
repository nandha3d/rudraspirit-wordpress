<div class="also-like-product">
	<div class="also-like-product-wrap">
		
		<?php
		 $limit = themesflat_get_opt('related_minicart_limit');
		 $args = array(
			 'post_type' => 'product',
			 'posts_per_page' => $limit, 
			 'post_status' => 'publish',
			 'orderby' => 'date',
			 'order' => 'DESC',
		 );
		
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
		
				global $product;
				$product_id = get_the_ID();
				$product_link = get_permalink( $product_id );
				$product_title = get_the_title();
				$product_price = $product->get_price_html(); 
				$regular_price = $product->get_regular_price(); 
				$sale_price = $product->get_sale_price(); 
				$product_image_url = get_the_post_thumbnail_url( $product_id, 'full' );
				if ( !$product_image_url ) {
					$product_image_url = wc_placeholder_img_src();
				}
		
				$discount = '';
				if ( $sale_price ) {
					$discount_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
					$discount = '<div class="on-sale-wrap text-xxs"><span class="on-sale-item">-' . $discount_percent . '%</span></div>';
				}
		
				?>
				<div class="tf-mini-cart-item">
					<div class="tf-mini-cart-image">
						<a href="<?php echo esc_url( $product_link ); ?>">
							<img class="ls-is-cached lazyloaded" data-src="<?php echo esc_url( $product_image_url ); ?>" src="<?php echo esc_url( $product_image_url ); ?>" alt="img-product">
						</a>
						<?php echo wp_kses_post($discount); ?>
					</div>
					<div class="tf-mini-cart-info">
						<a class="title link text-md fw-medium" href="<?php echo esc_url( $product_link ); ?>"><?php echo esc_html( $product_title ); ?></a>
						<p class="price-wrap text-md fw-medium">
							<?php echo wp_kses_post( $product_price ); ?>
						</p>
						<a href="#quickView" data-bs-toggle="modal" class="tf-btn animate-btn bg-dark-2 justify-content-center btn-quickview tf_quickview_btn" data-product_id="<?php echo esc_attr($product_id) ;?>">
							<?php _e('Quick View','vemus');?>
						</a>
					</div>
				</div>
				<?php
			endwhile;
			wp_reset_postdata(); 
		else :
			echo 'No recent products found.';
		endif;
		?>
	</div>
</div>