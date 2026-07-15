<?php
/**
 * Template for displaying the table of compared products.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/compare/compare-table.php.
 *
 * @author  WCBoost
 * @package WCBoost\ProductsCompare\Templates
 * @version 10.3.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! isset( $compare_items ) ) {
	return;
}
?>

<?php
global $is_compare_table;
$is_compare_table = true;
themesflat_remove_hook('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
add_filter('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart_compare', 20, 3 );

function tfwc_add_to_cart_compare( $html, $product, $args ) {	
   
    if ($product->is_type( 'variable' )) {
        $args['attributes']['data-bs-toggle'] = 'modal';
		$args['attributes']['data-bs-target'] = '#quickshop';
    }

        echo sprintf(
            '<a href="%1s" data-quantity="%2s" class="tf_add_to_cart tf-btn animate-btn w-100 %3s"  %4s> 
				<span class="text-md fw-medium">%4s</span>
			</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() ),
        );
        
}
?>


<?php do_action( 'wcboost_products_compare_before_compare_table', $compare_items );

?>

<div class="tf-table-compare">
	<table>
		<thead>
			<tr class="compare-row">
				<th class="compare-col "></th>
				<?php foreach ( $compare_items as $_product ) : ?>
				<th class="compare-col compare-head">
					<div class="compare-item">
						<div class="item_image">
							<a href="<?php echo esc_url( $_product->get_permalink() ); ?>">
								<img data-src="<?php echo esc_url( wp_get_attachment_url( $_product->get_image_id() ) ); ?>" alt="" class="lazyload">
							</a>
							<a href="<?php echo esc_url( \WCBoost\ProductsCompare\Helper::get_remove_url( $_product ) ); ?>" >
								<span class="remove icon-close"></span>
							</a>
						</div>
						<a href="<?php echo esc_url( $_product->get_permalink() ); ?>" class="item_name link">
							<?php echo esc_html( $_product->get_name() ); ?>
						</a>
						<div class="item_price price-wrap tf-price mb-3">
							<?php echo wp_kses_post($_product->get_price_html()); ?>
						</div>
						<?php if ( !$_product->is_purchasable() && !$_product->is_in_stock() ) { 
							?>
							<a href="#shoppingCart" data-bs-toggle="offcanvas" class="item_btn tf-btn btn-unavailable animate-btn text-line-clamp-1 text-center text-nowrap">
								<?php _e('Out of Stock', 'vemus'); ?>
							</a>
							<?php
						} else { 
							$GLOBALS['product'] = $_product; 
							woocommerce_template_loop_add_to_cart();
							wc_setup_product_data( null ); 
						} ?>
					</div>
				</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<tr class="compare-row">
				<td class="compare-col compare-title"><?php _e('Availability', 'vemus'); ?></td>
				<?php foreach ( $compare_items as $_product ) : ?>
					<?php
						$availability = $_product->get_availability();
						if ( $_product->is_in_stock() ) { 
							$class_stock =  '';
						} else { 
							$class_stock = 'out-stock';
						}
					?>
					<td class="compare-col">
						<div class="compare_stock <?php echo esc_attr($class_stock); ?>">
							<span class="icon">
								<?php if( $_product->is_in_stock() ) : ?>
									<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.5 14C11.366 14 14.5 10.866 14.5 7C14.5 3.13401 11.366 0 7.5 0C3.63401 0 0.5 3.13401 0.5 7C0.5 10.866 3.63401 14 7.5 14Z" fill="#91C283"></path>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M5.80046 8.96467L10.7341 4.0311C10.8794 3.8857 11.1181 3.88719 11.262 4.0311L11.7383 4.50743C11.8822 4.65135 11.8822 4.89149 11.7383 5.03535L6.80476 9.96897C6.66085 10.1129 6.42219 10.1144 6.27679 9.96897L5.80046 9.49264C5.65506 9.34724 5.65506 9.11007 5.80046 8.96467Z" fill="white"></path>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M4.26111 5.95764L7.26643 8.96296C7.41178 9.10836 7.41007 9.3473 7.26643 9.49093L6.7901 9.96726C6.64646 10.1108 6.40576 10.1108 6.26212 9.96726L3.25681 6.96195C3.11317 6.81831 3.11146 6.57937 3.25681 6.43397L3.73314 5.95764C3.87854 5.8123 4.11571 5.8123 4.26111 5.95764Z" fill="white"></path>
									</svg>
								<?php else : ?>
									<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.5 13.9955C11.366 13.9955 14.5 10.8635 14.5 7.00004C14.5 3.13659 11.366 0.00463867 7.5 0.00463867C3.63401 0.00463867 0.5 3.13659 0.5 7.00004C0.5 10.8635 3.63401 13.9955 7.5 13.9955Z" fill="#E46565"></path>
										<path d="M5.27789 3.69648L4.19531 4.77905L9.71866 10.3024L10.8012 9.21982L5.27789 3.69648Z" fill="white"></path>
										<path d="M9.71866 3.69602L4.19531 9.21936L5.27789 10.3019L10.8012 4.77859L9.71866 3.69602Z" fill="white"></path>
									</svg>
								<?php endif; ?>
							</span>
							<?php echo esc_html( $availability['availability'] ? $availability['availability'] : __( 'In stock', 'vemus' ) ) ?>
						</div>
					</td>
				<?php endforeach; ?>
			</tr>
			<tr class="compare-row">
				<td class="compare-col compare-title"><?php _e('Vendor', 'vemus'); ?></td>
				<?php foreach ( $compare_items as $_product ) : ?>
					<td class="compare-col compare-value">
						<span>
						<?php $brand = get_the_terms( $_product->get_id(), 'product_brand' );
						if ( $brand && ! is_wp_error( $brand ) ) {
							$brand_names = wp_list_pluck( $brand, 'name' );
							echo esc_html( implode( ', ', $brand_names ) );
						} else {
							esc_html_e( 'N/A', 'vemus' );
						} ?>
						</span>
					</td>
				<?php endforeach; ?>
			</tr>

			<tr>
				<td class="compare-col compare-title"><?php _e('Rating', 'vemus'); ?></td>
				<?php foreach ( $compare_items as $_product ) : ?>
					<td class="compare-col compare-value">
					<?php						
					if ( $_product->get_rating_count() ) {
						$average_rating = $_product->get_average_rating();
						
						$full_stars = floor($average_rating);  
						$percent = ($average_rating - $full_stars) * 100;  
						
						echo '<div class="tf-rating">';
						for ($i = 0; $i < $full_stars; $i++) {
							echo '<span class="icon icon-star full"></span>';  
						}
						if ($percent > 0) {
							echo '<span class="icon icon-star empty"><span class="icon icon-star partial" style="width:' . esc_attr($percent) . '%;"></span></span>'; 
						}

						$empty_stars = 5 - $full_stars - ($percent > 0 ? 1 : 0);
						for ($i = 0; $i < $empty_stars; $i++) {
							echo '<span class="icon icon-star empty"></span>';
						}

						echo '</div>';
					} else {
						echo  __( 'N/A', 'vemus' );
					}
					?>
					</td>
				<?php endforeach; ?>
			</tr>
			<tr class="compare-row">
				<td class="compare-col compare-title"><?php _e('SKU', 'vemus'); ?></td>
				<?php foreach ( $compare_items as $_product ) : ?>
					<?php $sku = $_product->get_sku(); ?>
					<td class="compare-col compare-value">
						<span>
							<?php echo empty($sku) ? __( 'N/A', 'vemus' ) : esc_html( $sku ); ?>
						</span>
					</td>
				<?php endforeach; ?>
			</tr>
			<tr class="compare-row">
				<td class="compare-col compare-title"><?php _e('Dimensions', 'vemus'); ?></td>
				<?php foreach ( $compare_items as $_product ) : ?>
					<?php $sku = $_product->get_sku(); ?>
					<td class="compare-col compare-value">
						<span>
							<?php echo !empty($_product->has_dimensions()) ? wc_format_dimensions( $_product->get_dimensions( false ) ) : __( 'N/A', 'vemus' ); ?>
						</span>
					</td>
				<?php endforeach; ?>
			</tr>
			<tr class="compare-row">
				<td class="compare-col compare-title"><?php _e('Weight', 'vemus'); ?></td>
				<?php foreach ( $compare_items as $_product ) : ?>
					<?php $sku = $_product->get_sku(); ?>
					<td class="compare-col compare-value">
						<span>
							<?php $_product->has_weight() ? wc_format_weight( $_product->get_weight() ) : __( 'N/A', 'vemus' ); ?>
						</span>
					</td>
				<?php endforeach; ?>
			</tr>
			<tr class="compare-row">
				<td class="compare-col compare-title"><?php _e('Material', 'vemus'); ?></td>
				<?php foreach ( $compare_items as $_product ) : ?>
					<td class="compare-col compare-value">
						<span>
						<?php $material = get_the_terms( $_product->get_id(), 'pa_material' );
						if ( $material && ! is_wp_error( $material ) ) {
							$material_names = wp_list_pluck( $material, 'name' );
							echo esc_html( implode( ', ', $material_names ) );
						} else {
							echo esc_html__( '----', 'vemus' );
						} ?>
						</span>
					</td>
				<?php endforeach; ?>
			</tr>
			<tr class="compare-row">
				<td class="compare-col compare-title"><?php _e('Stone Color', 'vemus'); ?></td>
				<?php foreach ( $compare_items as $_product ) : ?>
					<td class="compare-col compare-value">
						<span>
						<?php $material = get_the_terms( $_product->get_id(), 'stone_color' );
						if ( $material && ! is_wp_error( $material ) ) {
							$material_names = wp_list_pluck( $material, 'name' );
							echo esc_html( implode( ', ', $material_names ) );
						} else {
							echo esc_html__( '----', 'vemus' );
						} ?>
						</span>
					</td>
				<?php endforeach; ?>
			</tr>
			<tr class="compare-row">
				<td class="compare-col compare-title"><?php _e('Size', 'vemus' ); ?></td>
				<?php foreach ( $compare_items as $_product ) : ?>
					<td class="compare-col compare-value">
						<span>
						<?php $material = get_the_terms( $_product->get_id(), 'size_number' );
						if ( $material && ! is_wp_error( $material ) ) {
							$material_names = wp_list_pluck( $material, 'name' );
							echo esc_html( implode( ', ', $material_names ) );
						} else {
							echo esc_html__( '----', 'vemus' );
						} ?>
						</span>
					</td>
				<?php endforeach; ?>
			</tr>
		</tbody>
	</table>
</div>

<?php 
add_filter('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
themesflat_remove_hook('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart_compare', 20, 3 );
$is_compare_table = false;
do_action( 'wcboost_products_compare_after_compare_table', $compare_items ); ?>

