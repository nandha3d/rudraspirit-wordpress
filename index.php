<?php
/**
 * Root index.php bridge & Production wp-config.php Generator for Hostinger Git deployment.
 */

error_reporting( E_ALL );
ini_set( 'display_errors', '1' );

if ( function_exists( 'mysqli_report' ) ) {
    mysqli_report( MYSQLI_REPORT_OFF );
}

$app_public = __DIR__ . '/app/public';

// -----------------------------------------------------------------------------
// 1. AUTO-RESTORE ONLY WORDPRESS CORE ENGINE FILES (EXCLUDING WP-CONFIG)
// -----------------------------------------------------------------------------
if ( ! file_exists( $app_public . '/wp-load.php' ) || ! is_dir( $app_public . '/wp-includes' ) || ! is_dir( $app_public . '/wp-admin' ) ) {
    if ( ! is_dir( $app_public ) ) {
        @mkdir( $app_public, 0755, true );
    }

    $sources = [
        '/home/u362580417/domains/shivarudraksha.in/public_html',
        '/home/u362580417/domains/wildlifeleather.in/public_html'
    ];

    foreach ( $sources as $src ) {
        if ( file_exists( $src . '/wp-load.php' ) && is_dir( $src . '/wp-includes' ) ) {
            if ( function_exists( 'shell_exec' ) ) {
                @shell_exec( "cp -r " . escapeshellarg( $src . '/wp-admin' ) . " " . escapeshellarg( $app_public . '/' ) . " 2>&1" );
                @shell_exec( "cp -r " . escapeshellarg( $src . '/wp-includes' ) . " " . escapeshellarg( $app_public . '/' ) . " 2>&1" );
                foreach ( glob( $src . '/wp-*.php' ) as $f ) {
                    if ( basename( $f ) !== 'wp-config.php' ) {
                        @copy( $f, $app_public . '/' . basename( $f ) );
                    }
                }
                if ( file_exists( $src . '/index.php' ) ) {
                    @copy( $src . '/index.php', $app_public . '/index.php' );
                }
            }
            if ( file_exists( $app_public . '/wp-load.php' ) ) {
                break;
            }
        }
    }
}

// -----------------------------------------------------------------------------
// 2. GENERATE PERMANENT RUDRASPIRIT PRODUCTION WP-CONFIG.PHP
// -----------------------------------------------------------------------------
$wp_config_path = $app_public . '/wp-config.php';
$needs_config = false;

if ( ! file_exists( $wp_config_path ) ) {
    $needs_config = true;
} else {
    $current_cfg = @file_get_contents( $wp_config_path );
    if ( strpos( $current_cfg, 'u362580417_MOrXI' ) === false || strpos( $current_cfg, 'shivarudraksha' ) !== false || strpos( $current_cfg, 'u362580417_cRhnL' ) !== false ) {
        $needs_config = true;
    }
}

if ( $needs_config ) {
    $prod_wp_config = <<<PHP
<?php
/**
 * Production Hostinger wp-config.php for Rudra Spirit (rudraspirit.com)
 * Linked to verified production database u362580417_MOrXI (u362580417_VR4qn).
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
// 3. DIAGNOSTIC OUTPUT MODE (?vemus_debug=1)
// -----------------------------------------------------------------------------
if ( isset( $_GET['vemus_debug'] ) && $_GET['vemus_debug'] === '1' ) {
    header( 'Content-Type: text/plain' );
    echo "=== Rudra Spirit Database Connection Check ===\n";
    echo "Configured DB_NAME: u362580417_MOrXI\n";
    echo "Configured DB_USER: u362580417_VR4qn\n\n";

    $conn = @mysqli_connect( 'localhost', 'u362580417_VR4qn', 'Animazon@Erode11', 'u362580417_MOrXI' );
    if ( $conn ) {
        echo "--> MYSQL CONNECTION TO u362580417_MOrXI SUCCESSFUL!\n";
        $res = @mysqli_query( $conn, "SELECT option_value FROM wp_options WHERE option_name='siteurl' LIMIT 1" );
        if ( $res && ( $row = mysqli_fetch_assoc( $res ) ) ) {
            echo "--> Active siteurl in u362580417_MOrXI: " . $row['option_value'] . "\n";
        }
        @mysqli_close( $conn );
    } else {
        echo "--> MYSQL CONNECTION FAILED: " . mysqli_connect_error() . "\n\n";
        echo "INSTRUCTION:\n";
        echo "Please go to Hostinger hPanel -> Websites -> Databases -> MySQL Databases.\n";
        echo "Click the three vertical dots (⋮) next to u362580417_MOrXI (u362580417_VR4qn).\n";
        echo "Click 'Change Password' and set the password to: Animazon@Erode11\n";
        echo "Once saved, your live site will connect immediately!\n";
    }
    echo "===============================================\n";
    exit;
}

// -----------------------------------------------------------------------------
// 4. ROUTE TO WORDPRESS
// -----------------------------------------------------------------------------
if ( file_exists( $app_public . '/index.php' ) && file_exists( $app_public . '/wp-load.php' ) && file_exists( $app_public . '/wp-config.php' ) ) {
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
