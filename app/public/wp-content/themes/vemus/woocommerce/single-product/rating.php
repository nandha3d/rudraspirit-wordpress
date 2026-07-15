<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.3.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$full_stars = floor($average);
$percent = ($average - $full_stars) * 100;  

if ( $rating_count > 0 ) : ?>
	<div class="single-product-info-rate">
		<div class="product-info-rate rate-wrap">
			<?php for($i= 0; $i < $full_stars; $i++) : ?>
				<i class="icon icon-star full"></i>
			<?php endfor; ?>
			<?php if ( $full_stars != $average ) : ?>
				<i class="icon icon-star empty">
					<span class="icon icon-star partial" style="width:<?php echo esc_attr($percent); ?>%;"></span>
				</i>
			<?php endif; ?>
			<?php for($i= 0; $i < 5 - ceil($average) ; $i++) : ?>
				<i class="icon icon-star empty"></i>
			<?php endfor; ?>
		</div>
		<!-- <a href="#tab-reviews" class="count-review" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'vemus' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)</a> -->
	</div>
<?php //else: ?>
	<!-- <span class="count-review">(No review)</span> -->
<?php endif; ?>