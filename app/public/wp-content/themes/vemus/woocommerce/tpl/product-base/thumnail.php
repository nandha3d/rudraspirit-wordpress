<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?> 


<a href="<?php echo esc_url($product->get_permalink()); ?>" class="product-img">	
	<?php
		$main_image    = $product->get_image_id() ? wp_get_attachment_image_url($product->get_image_id(), 'themesflat-product') : wc_placeholder_img_src();
		$gallery_images = $product->get_gallery_image_ids();
		$second_image  = (!empty($gallery_images)) ? wp_get_attachment_image_url($gallery_images[0], 'themesflat-product') : '';

		echo '<img class="img-product lazyload" src="' . esc_url($main_image) . '" alt="' . esc_attr($product->get_name()) . '">';
		
		/*
		if ($second_image) {
			echo '<img class="img-hover lazyload" src="' . esc_url($second_image) . '" alt="' . esc_attr($product->get_name()) . '">';
		} else {
			echo '<img class="img-hover lazyload" src="' . esc_url($main_image) . '" alt="' . esc_attr($product->get_name()) . '">';
		}
		*/
	?>
</a>

