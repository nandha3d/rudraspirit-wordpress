<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package vemus
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="<?php echo THEMESFLAT_PROTOCOL ?>://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="themesflat-boxed">	
	<?php
        get_template_part( 'tpl/site-header');  

        get_template_part( 'tpl/header/header-fixed');        		
	?>
	
	<!-- Page Title -->
	<?php get_template_part( 'tpl/page-title'); ?>
	<?php 

		$top_category_style = themesflat_get_opt('top_category_style');
		if (isset($_GET['top_category_style'])){
			$top_category_style = sanitize_text_field($_GET['top_category_style']);
		}
		$builder = themesflat_get_opt( 'shop_builder' );
		if ( class_exists( 'WooCommerce' ) &&  ( $builder != 1 ) ) {
			if ( is_shop()|| is_tax('product_cat') ) {
				if( $top_category_style === 'style-1') {
					get_template_part('woocommerce/tpl/product-category/style-1'); 
				} else if( $top_category_style === 'style-2') {
					get_template_part('woocommerce/tpl/product-category/style-2'); 
				}		
				
			}
		}
		
		$class_is_full_width = '';

		$gallery_layout = empty($_GET['gallery_layout']) ? themesflat_get_opt('tf_product_gallery_layout') : $_GET['gallery_layout'];

		if( function_exists('is_product') && is_product() && ( $gallery_layout == 'no_thumb' || $gallery_layout == 'middle_gallery') ){
			$class_is_full_width = 'page-single-no-thumb';
		}

	?>	
	<div id="main-content" class="site-main clearfix">
		<div id="themesflat-content" class="page-wrap <?php echo esc_attr( themesflat_blog_layout() ); ?> <?php echo esc_attr( $class_is_full_width ); ?>">