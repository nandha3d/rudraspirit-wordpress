<?php
/**
 * Root index.php bridge and Auto-Recovery Engine for Hostinger Git deployment.
 * Auto-restores WordPress core files and production database credentials if Hostinger Git wiped them.
 */

$app_public = __DIR__ . '/app/public';

// -----------------------------------------------------------------------------
// 1. AUTO-RESTORE WORDPRESS CORE IF MISSING (wp-load.php, wp-admin, wp-includes)
// -----------------------------------------------------------------------------
if ( ! file_exists( $app_public . '/wp-load.php' ) || ! is_dir( $app_public . '/wp-includes' ) || ! is_dir( $app_public . '/wp-admin' ) ) {
    if ( ! is_dir( $app_public ) ) {
        @mkdir( $app_public, 0755, true );
    }

    // Try restoring from shivarudraksha.in or wildlifeleather.in
    $sources = [
        '/home/u362580417/domains/shivarudraksha.in/public_html',
        '/home/u362580417/domains/wildlifeleather.in/public_html',
        '/home/u362580417/domains/animazon.in/public_html/shivarudraksha'
    ];

    $restored_source = false;
    foreach ( $sources as $src ) {
        if ( file_exists( $src . '/wp-load.php' ) && is_dir( $src . '/wp-includes' ) ) {
            // Use fast shell_exec copy first
            if ( function_exists( 'shell_exec' ) ) {
                @shell_exec( "cp -r " . escapeshellarg( $src . '/wp-admin' ) . " " . escapeshellarg( $app_public . '/' ) . " 2>&1" );
                @shell_exec( "cp -r " . escapeshellarg( $src . '/wp-includes' ) . " " . escapeshellarg( $app_public . '/' ) . " 2>&1" );
                @shell_exec( "cp " . escapeshellarg( $src ) . "/wp-*.php " . escapeshellarg( $app_public . '/' ) . " 2>&1" );
                @shell_exec( "cp " . escapeshellarg( $src . '/index.php' ) . " " . escapeshellarg( $app_public . '/index.php' ) . " 2>&1" );
                @shell_exec( "cp " . escapeshellarg( $src . '/xmlrpc.php' ) . " " . escapeshellarg( $app_public . '/xmlrpc.php' ) . " 2>&1" );
            }

            // PHP fallback recursive copy if shell_exec failed or was incomplete
            if ( ! file_exists( $app_public . '/wp-load.php' ) ) {
                if ( ! function_exists( 'vemus_copy_recursive' ) ) {
                    function vemus_copy_recursive( $src_dir, $dst_dir ) {
                        $dir = opendir( $src_dir );
                        @mkdir( $dst_dir, 0755, true );
                        while ( false !== ( $file = readdir( $dir ) ) ) {
                            if ( ( $file != '.' ) && ( $file != '..' ) ) {
                                if ( is_dir( $src_dir . '/' . $file ) ) {
                                    vemus_copy_recursive( $src_dir . '/' . $file, $dst_dir . '/' . $file );
                                } else {
                                    copy( $src_dir . '/' . $file, $dst_dir . '/' . $file );
                                }
                            }
                        }
                        closedir( $dir );
                    }
                }
                vemus_copy_recursive( $src . '/wp-admin', $app_public . '/wp-admin' );
                vemus_copy_recursive( $src . '/wp-includes', $app_public . '/wp-includes' );
                foreach ( glob( $src . '/wp-*.php' ) as $f ) {
                    if ( basename( $f ) !== 'wp-config.php' ) {
                        copy( $f, $app_public . '/' . basename( $f ) );
                    }
                }
                if ( file_exists( $src . '/index.php' ) ) {
                    copy( $src . '/index.php', $app_public . '/index.php' );
                }
            }

            if ( file_exists( $app_public . '/wp-load.php' ) ) {
                $restored_source = $src;
                break;
            }
        }
    }
}

// -----------------------------------------------------------------------------
// 2. AUTO-CONFIGURE PRODUCTION DATABASE CREDENTIALS FOR RUDRASPIRIT.COM
// -----------------------------------------------------------------------------
$wp_config_path = $app_public . '/wp-config.php';
$needs_db_fix = false;

if ( ! file_exists( $wp_config_path ) ) {
    $needs_db_fix = true;
} else {
    $current_config = @file_get_contents( $wp_config_path );
    if ( strpos( $current_config, "'local'" ) !== false || strpos( $current_config, '"local"' ) !== false || strpos( $current_config, "'root'" ) !== false ) {
        $needs_db_fix = true;
    }
}

if ( $needs_db_fix && ( file_exists( '/home/u362580417/env.backup' ) || strpos( __DIR__, 'u362580417' ) !== false ) ) {
    $prod_wp_config = <<<PHP
<?php
/**
 * Production Hostinger wp-config.php for Rudra Spirit (rudraspirit.com)
 * Automatically restored by deployment bridge.
 */

define( 'DB_NAME', 'u362580417_MOrXI' );
define( 'DB_USER', 'u362580417_VR4qn' );
define( 'DB_PASSWORD', 'Animazon@Erode11' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

\$table_prefix = 'wp_';

define( 'WP_DEBUG', false );
define( 'WP_ENVIRONMENT_TYPE', 'production' );

/* That's all, stop editing! Happy publishing. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';
PHP;

    @file_put_contents( $wp_config_path, $prod_wp_config );
}

// -----------------------------------------------------------------------------
// 3. DIAGNOSTIC OUTPUT MODE (if requested via ?vemus_debug=1)
// -----------------------------------------------------------------------------
if ( isset( $_GET['vemus_debug'] ) && $_GET['vemus_debug'] === '1' ) {
    header( 'Content-Type: text/plain' );
    echo "=== Auto-Recovery Status ===\n";
    echo "Target directory: " . $app_public . "\n";
    echo "wp-load.php: " . ( file_exists( $app_public . '/wp-load.php' ) ? "EXISTS (" . filesize( $app_public . '/wp-load.php' ) . " bytes)" : "STILL MISSING!" ) . "\n";
    echo "wp-admin/: " . ( is_dir( $app_public . '/wp-admin' ) ? "EXISTS (" . count( (array) glob( $app_public . '/wp-admin/*' ) ) . " items)" : "STILL MISSING!" ) . "\n";
    echo "wp-includes/: " . ( is_dir( $app_public . '/wp-includes' ) ? "EXISTS (" . count( (array) glob( $app_public . '/wp-includes/*' ) ) . " items)" : "STILL MISSING!" ) . "\n";
    
    if ( file_exists( $wp_config_path ) ) {
        $cfg = file_get_contents( $wp_config_path );
        preg_match( '/define\(\s*[\'"]DB_NAME[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $cfg, $mn );
        preg_match( '/define\(\s*[\'"]DB_USER[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $cfg, $mu );
        echo "wp-config.php DB_NAME: " . ( $mn[1] ?? 'unknown' ) . "\n";
        echo "wp-config.php DB_USER: " . ( $mu[1] ?? 'unknown' ) . "\n";
    } else {
        echo "wp-config.php: MISSING!\n";
    }
    echo "============================\n";
    exit;
}

// -----------------------------------------------------------------------------
// 4. ROUTE CLEANLY TO WORDPRESS APPLICATION
// -----------------------------------------------------------------------------
if ( file_exists( $app_public . '/index.php' ) && file_exists( $app_public . '/wp-load.php' ) ) {
    // Ensure current working directory is app/public when loading WordPress
    chdir( $app_public );
    require $app_public . '/index.php';
} else {
    define( 'WP_USE_THEMES', true );
    if ( file_exists( __DIR__ . '/wp-blog-header.php' ) ) {
        require __DIR__ . '/wp-blog-header.php';
    } else {
        header( 'HTTP/1.1 503 Service Unavailable' );
        echo '<h1>WordPress Auto-Recovery in Progress...</h1><p>Please refresh this page in 3 seconds.</p>';
    }
}
