<?php
/**
 * Root index.php bridge, Auto-Recovery Engine & Live Database Connector for Hostinger Git deployment.
 */

error_reporting( E_ALL );
ini_set( 'display_errors', '1' );

$app_public = __DIR__ . '/app/public';

// -----------------------------------------------------------------------------
// 1. AUTO-RESTORE WORDPRESS CORE IF MISSING
// -----------------------------------------------------------------------------
if ( ! file_exists( $app_public . '/wp-load.php' ) || ! is_dir( $app_public . '/wp-includes' ) || ! is_dir( $app_public . '/wp-admin' ) ) {
    if ( ! is_dir( $app_public ) ) {
        @mkdir( $app_public, 0755, true );
    }

    $sources = [
        '/home/u362580417/domains/shivarudraksha.in/public_html',
        '/home/u362580417/domains/wildlifeleather.in/public_html',
        '/home/u362580417/domains/animazon.in/public_html/shivarudraksha'
    ];

    foreach ( $sources as $src ) {
        if ( file_exists( $src . '/wp-load.php' ) && is_dir( $src . '/wp-includes' ) ) {
            if ( function_exists( 'shell_exec' ) ) {
                @shell_exec( "cp -r " . escapeshellarg( $src . '/wp-admin' ) . " " . escapeshellarg( $app_public . '/' ) . " 2>&1" );
                @shell_exec( "cp -r " . escapeshellarg( $src . '/wp-includes' ) . " " . escapeshellarg( $app_public . '/' ) . " 2>&1" );
                @shell_exec( "cp " . escapeshellarg( $src ) . "/wp-*.php " . escapeshellarg( $app_public . '/' ) . " 2>&1" );
                @shell_exec( "cp " . escapeshellarg( $src . '/index.php' ) . " " . escapeshellarg( $app_public . '/index.php' ) . " 2>&1" );
            }
            if ( file_exists( $app_public . '/wp-load.php' ) ) {
                break;
            }
        }
    }
}

// -----------------------------------------------------------------------------
// 2. ENFORCE RUDRASPIRIT.COM PRODUCTION DATABASE CREDENTIALS IN WP-CONFIG.PHP
// -----------------------------------------------------------------------------
$wp_config_path = $app_public . '/wp-config.php';
$current_config = file_exists( $wp_config_path ) ? @file_get_contents( $wp_config_path ) : '';

if ( strpos( $current_config, 'u362580417_MOrXI' ) === false ) {
    $prod_wp_config = <<<PHP
<?php
/**
 * Production Hostinger wp-config.php for Rudra Spirit (rudraspirit.com)
 */

define( 'DB_NAME', 'u362580417_MOrXI' );
define( 'DB_USER', 'u362580417_VR4qn' );
define( 'DB_PASSWORD', 'Animazon@Erode11' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

\$table_prefix = 'wp_';

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );
@ini_set( 'display_errors', '1' );

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
// 3. DIAGNOSTIC OUTPUT & LIVE DATABASE VERIFICATION MODE (?vemus_debug=1)
// -----------------------------------------------------------------------------
if ( isset( $_GET['vemus_debug'] ) && $_GET['vemus_debug'] === '1' ) {
    header( 'Content-Type: text/plain' );
    echo "=== Auto-Recovery & Database Status ===\n";
    echo "Target directory: " . $app_public . "\n";
    echo "wp-load.php: " . ( file_exists( $app_public . '/wp-load.php' ) ? "EXISTS" : "MISSING" ) . "\n";
    
    $cfg = file_exists( $wp_config_path ) ? file_get_contents( $wp_config_path ) : '';
    preg_match( '/define\(\s*[\'"]DB_NAME[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $cfg, $mn );
    preg_match( '/define\(\s*[\'"]DB_USER[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $cfg, $mu );
    preg_match( '/define\(\s*[\'"]DB_PASSWORD[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $cfg, $mp );
    
    $db_name = $mn[1] ?? 'unknown';
    $db_user = $mu[1] ?? 'unknown';
    $db_pass = $mp[1] ?? 'unknown';
    echo "Configured DB_NAME: " . $db_name . "\n";
    echo "Configured DB_USER: " . $db_user . "\n\n";

    echo "Testing direct MySQL connection to configured database...\n";
    $conn = @mysqli_connect( 'localhost', $db_user, $db_pass, $db_name );
    if ( ! $conn ) {
        echo "--> MYSQL CONNECTION FAILED: " . mysqli_connect_error() . "\n";
        
        // Try testing connection with shivarudraksha credentials or other known databases just in case
        echo "\nTesting alternative databases on server:\n";
        $alt_dbs = [
            ['u362580417_VR4qn', 'Animazon@Erode11', 'u362580417_MOrXI'],
            ['u362580417_Vaf49', 'password_unknown', 'u362580417_cRhnL'],
            ['u362580417_WT0W0', 'password_unknown', 'u362580417_iik8p'],
            ['u362580417_yUI1B', 'password_unknown', 'u362580417_iVXDS'],
        ];
        foreach ( $alt_dbs as $adb ) {
            $c = @mysqli_connect( 'localhost', $adb[0], $adb[1], $adb[2] );
            echo "   Try DB [" . $adb[2] . "] with user [" . $adb[0] . "]: " . ( $c ? "SUCCESS!" : "FAILED (" . mysqli_connect_error() . ")" ) . "\n";
            if ( $c ) {
                $conn = $c;
                break;
            }
        }
    } else {
        echo "--> MYSQL CONNECTION SUCCESSFUL!\n";
    }

    if ( $conn ) {
        echo "\nQuerying wp_options from connected database:\n";
        $res = mysqli_query( $conn, "SELECT option_name, option_value FROM wp_options WHERE option_name IN ('siteurl', 'home', 'template', 'stylesheet', 'active_plugins') OR option_name LIKE 'template%' LIMIT 10" );
        if ( $res ) {
            while ( $row = mysqli_fetch_assoc( $res ) ) {
                echo "   [" . $row['option_name'] . "] => " . substr( $row['option_value'], 0, 150 ) . "\n";
            }
        } else {
            echo "   Query error: " . mysqli_error( $conn ) . "\n";
            echo "   Checking existing tables:\n";
            $tres = mysqli_query( $conn, "SHOW TABLES" );
            if ( $tres ) {
                while ( $trow = mysqli_fetch_row( $tres ) ) {
                    echo "      Table: " . $trow[0] . "\n";
                }
            }
        }
        mysqli_close( $conn );
    }

    echo "\nTrying to load WordPress environment (wp-load.php) directly:\n";
    try {
        chdir( $app_public );
        require_once $app_public . '/wp-load.php';
        echo "--> wp-load.php loaded successfully without errors!\n";
        echo "--> site_url(): " . ( function_exists( 'site_url' ) ? site_url() : 'N/A' ) . "\n";
        echo "--> home_url(): " . ( function_exists( 'home_url' ) ? home_url() : 'N/A' ) . "\n";
        echo "--> current_theme: " . ( function_exists( 'wp_get_theme' ) ? wp_get_theme()->get( 'Name' ) : 'N/A' ) . "\n";
    } catch ( Throwable $e ) {
        echo "--> EXCEPTION loading WordPress: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine() . "\n";
    }

    echo "=====================================\n";
    exit;
}

// -----------------------------------------------------------------------------
// 4. ROUTE CLEANLY TO WORDPRESS APPLICATION
// -----------------------------------------------------------------------------
if ( file_exists( $app_public . '/index.php' ) && file_exists( $app_public . '/wp-load.php' ) ) {
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
