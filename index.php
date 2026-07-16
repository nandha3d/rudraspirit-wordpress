<?php
/**
 * Root index.php bridge for Hostinger Git deployment.
 * Automatically routes requests to app/public/index.php where WordPress is located.
 */
if ( file_exists( __DIR__ . '/app/public/index.php' ) ) {
    require __DIR__ . '/app/public/index.php';
} else {
    define( 'WP_USE_THEMES', true );
    if ( file_exists( __DIR__ . '/wp-blog-header.php' ) ) {
        require __DIR__ . '/wp-blog-header.php';
    }
}
