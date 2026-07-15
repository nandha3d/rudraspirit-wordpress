<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     10.3.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$layout = themesflat_get_opt( 'shop_style' );
	
if (isset($_GET['layout_style'])){
	$layout = sanitize_text_field($_GET['layout_style']);
}
$column = '';
if (isset($_GET['column'])){
	$column = sanitize_text_field($_GET['column']);
}

$product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
if (isset($_POST['product_style'])) {
	$product_style = sanitize_text_field($_POST['product_style']);
}
$class = '';
if($product_style == 'style-list') {
	$class = ' tf-list-layout ';
} else {
	$class = ' tf-grid-layout ';
}

$wrap_class = ' ';
if ($product_style == 'style-list') {
	$wrap_class = ' listLayout-wrapper ';
} else {
	$wrap_class = ' gridLayout-wrapper ';
}

$number_view_active = themesflat_get_opt('number_view_active');
if (isset($_GET['number_view_active'])) {
	$number_view_active = sanitize_text_field($_GET['number_view_active']);
}
?>
<div class="wrapper-control-shop <?php echo esc_attr($wrap_class);?>">
<div class="wrapper-shop <?php echo esc_attr($class);?> tf-col-<?php echo esc_attr($number_view_active);?> columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) );?> <?php echo esc_attr($column); ?> <?php echo esc_attr($layout); ?>" id="<?php if ($product_style == 'style-list') { echo 'listLayout'; } else { echo 'gridLayout'; }?>">

