<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

$per_page     = wc_get_loop_prop( 'per_page' );
$total_products        = wc_get_loop_prop( 'total' );

$end = min( $current * $per_page, $total_products );

$style = '';

if ( $total <= 1 ) {
	$style .= 'display:none;';
	// return;
}

$shop_pagination = themesflat_get_opt('shop_pagination');
$shop_loadmore_text = themesflat_get_opt('shop_loadmore_text');


if (isset($_GET['pagination'])) {
	$shop_pagination = sanitize_text_field($_GET['pagination']);
}

$pagination_ajax = themesflat_get_opt('pagination_ajax');
if (isset($_GET['pagination_ajax'])) {
	$pagination_ajax = sanitize_text_field($_GET['pagination_ajax']);
}

$pagination_ajax_class = '';
if ($pagination_ajax == 1) {
	$pagination_ajax_class = 'ajax-pagination';
}

?>

<?php if($shop_pagination == 'number') { ?>
<nav class="woocommerce-pagination wg-pagination vemus-shop-pagination <?php echo esc_attr($pagination_ajax_class);?> ">
	<div class="pagition-list d-flex flex-column justify-content-center align-items-center">
		<p>Showing <?php echo esc_html($end); ?> of <?php echo esc_html($total_products); ?> products</p>
		<?php
			echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
				'base'         => $base,
				'format'       => $format, 
				'add_args'     => false,
				'current'      => max( 1, $current ),
				'total'        => $total,
				'prev_text'    => '<span class="tf-btn-line style-line-2">PREV</span>',
				'next_text'    => '<span class="tf-btn-line style-line-2">NEXT</span>',
				'type'         => 'list',
				'end_size'     => 1,
				'mid_size'     => 1,
			) ) );
		?>
	</div>
</nav>
<?php } ?>

<?php if($shop_pagination == 'loadmore') { ?>
	<nav class="woocommerce-pagination loadmore wg-show-more vemus-load-more wd-load justify-content-center" style="<?php echo esc_attr($style); ?>" role="navigation">
		<p>Showing <?php echo esc_html($end); ?> of <?php echo esc_html($total_products); ?> products</p>
		<button id="load-more-btn" class="tf-btn btn-outline-dark2 tf-loading-2 loadmore" data-page="2">
			<span class="text"><?php echo esc_html($shop_loadmore_text)?></span>
			<div class="spinner-circle" style="<?php echo esc_attr('display:none;'); ?>">
				<span class="spinner-circle1 spinner-child"></span>
				<span class="spinner-circle2 spinner-child"></span>
				<span class="spinner-circle3 spinner-child"></span>
				<span class="spinner-circle4 spinner-child"></span>
				<span class="spinner-circle5 spinner-child"></span>
				<span class="spinner-circle6 spinner-child"></span>
				<span class="spinner-circle7 spinner-child"></span>
				<span class="spinner-circle8 spinner-child"></span>
				<span class="spinner-circle9 spinner-child"></span>
			</div>
		</button>
    </nav>
	
<?php } ?>

<?php if($shop_pagination == 'autoload') { ?>
	<nav class="woocommerce-pagination autoload wd-load justify-content-center wg-show-more" style="<?php echo esc_attr($style); ?>" role="navigation">
		<button id="autoload-btn" class="tf-btn btn-dark2 tf-loading animate-btn animate-dark" data-page="2">
			<div class="spinner-circle">
				<span class="spinner-circle1 spinner-child"></span>
				<span class="spinner-circle2 spinner-child"></span>
				<span class="spinner-circle3 spinner-child"></span>
				<span class="spinner-circle4 spinner-child"></span>
				<span class="spinner-circle5 spinner-child"></span>
				<span class="spinner-circle6 spinner-child"></span>
				<span class="spinner-circle7 spinner-child"></span>
				<span class="spinner-circle8 spinner-child"></span>
				<span class="spinner-circle9 spinner-child"></span>
			</div>
		</button>
	</nav>
<?php } ?>