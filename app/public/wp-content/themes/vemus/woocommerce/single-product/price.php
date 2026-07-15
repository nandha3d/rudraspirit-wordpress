<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
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
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="product-info-price">
	<div class="price-wrap">
		<?php echo wp_kses_post( $product->get_price_html() ); ?>
		<?php if ($product->is_on_sale()) : ?>
			<?php
				$regular_price = (float) $product->get_regular_price();
				$sale_price = (float) $product->get_sale_price();

				if ($regular_price > 0 && $sale_price > 0) {
					$discount = round((($regular_price - $sale_price) / $regular_price) * 100);
					$discount_text = $discount . '% Off';
				} else {
					$discount = 0;
					$discount_text = esc_html__('Sale!', 'vemus');
				}
			?>
			<p class="badges-on-sale">
				<i class="icon-tag"></i>
				<span class="number-sale" data-person-sale="<?php echo esc_attr($discount); ?>">
					<?php echo esc_html($discount_text); ?>
				</span>
			</p>
		<?php endif; ?>
	</div>
</div>
