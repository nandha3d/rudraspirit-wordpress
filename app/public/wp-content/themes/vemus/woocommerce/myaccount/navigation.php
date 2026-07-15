<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<div class="btn-sidebar-mb d-lg-none">
	<button data-bs-toggle="offcanvas" data-bs-target="#mbAccount">
		<i class="icon icon-sidebar"></i>
	</button>
</div>
<div class="offcanvas offcanvas-start canvas-filter canvas-sidebar canvas-sidebar-account" id="mbAccount" aria-modal="true" role="dialog">
	<div class="canvas-wrapper">
		<div class="canvas-header">
			<span class="title"><?php _e('SIDEBAR ACCOUNT','vemus')?></span>
			<button class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="canvas-body">
			<nav class="sidebar-account-wrap woocommerce-MyAccount-navigation sidebar-mobile-append " aria-label="<?php esc_attr_e( 'Account pages', 'vemus' ); ?>">
				<ul class="my-account-nav">
					<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
						<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
							<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" <?php echo wc_is_current_account_menu_item( $endpoint ) ? 'aria-current="page"' : ''; ?> class="text-sm link fw-medium my-account-nav-item ">
								<?php echo esc_html( $label ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</div>
	</div>
</div>
<nav class="sidebar-account-wrap sidebar-content-wrap sticky-top d-lg-block d-none woocommerce-MyAccount-navigation" aria-label="<?php esc_attr_e( 'Account pages', 'vemus' ); ?>">
	<ul class="my-account-nav">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" <?php echo wc_is_current_account_menu_item( $endpoint ) ? 'aria-current="page"' : ''; ?> class="text-sm link fw-medium my-account-nav-item ">
					<?php echo esc_html( $label ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
