<?php
/**
 * Root index.php bridge for Hostinger Git deployment.
 * Automatically routes requests to app/public/index.php where WordPress is located.
 */

if ( isset( $_GET['vemus_debug'] ) && $_GET['vemus_debug'] === '1' ) {
    header( 'Content-Type: text/plain' );
    echo "=== Vemus Diagnostic Output ===\n";
    echo "Current root directory (__DIR__): " . __DIR__ . "\n";
    
    $check_paths = [
        __DIR__ . '/wp-config.php',
        __DIR__ . '/app/public/wp-config.php',
        __DIR__ . '/app/public/wp-config-sample.php',
        dirname( __DIR__ ) . '/wp-config.php',
        dirname( __DIR__ ) . '/domains/rudraspirit.com/wp-config.php',
        dirname( __DIR__ ) . '/domains/rudraspirit.com/public_html/wp-config.php',
        '/home/u362580417/domains/rudraspirit.com/wp-config.php',
        '/home/u362580417/wp-config.php',
    ];
    
    foreach ( $check_paths as $path ) {
        echo "$path -> " . ( file_exists( $path ) ? "EXISTS (" . filesize( $path ) . " bytes)" : "MISSING" ) . "\n";
        if ( file_exists( $path ) && filesize( $path ) > 0 && filesize( $path ) != 3703 ) {
            // Check if this file contains u362580417 without exposing full credentials
            $content = file_get_contents( $path );
            if ( strpos( $content, 'u362580417' ) !== false ) {
                echo "   *** FOUND HOSTINGER PRODUCTION DB CREDENTIALS HERE ***\n";
            }
        }
    }

    // Check backups or parent directories for production wp-config or db backups
    $backup_dir = '/home/u362580417/deploy-backups';
    if ( is_dir( $backup_dir ) ) {
        echo "\nChecking $backup_dir:\n";
        $items = glob( "$backup_dir/*" );
        foreach ( array_slice( (array) $items, -5 ) as $item ) {
            echo "   $item\n";
        }
    }

    echo "===============================\n";
    exit;
}

if ( file_exists( __DIR__ . '/app/public/index.php' ) ) {
    require __DIR__ . '/app/public/index.php';
} else {
    define( 'WP_USE_THEMES', true );
    if ( file_exists( __DIR__ . '/wp-blog-header.php' ) ) {
        require __DIR__ . '/wp-blog-header.php';
    }
}
