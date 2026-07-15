<?php
/**
 * My Account Page
 *
 * This template is overridden by Vemus Child Theme to provide a robust Bootstrap grid layout.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="container my-account-container">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
            <div class="account-sidebar-wrapper">
                <?php do_action( 'woocommerce_account_navigation' ); ?>
            </div>
        </div>

        <!-- Main Account Content -->
        <div class="col-lg-9 col-md-8">
            <div class="account-content-wrapper">
                <?php
                    /**
                     * My Account content.
                     * @since 2.6.0
                     */
                    do_action( 'woocommerce_account_content' );
                ?>
            </div>
        </div>
    </div>
</div>
