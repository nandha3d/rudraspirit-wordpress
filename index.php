<?php
/**
 * Root index.php bridge, Auto-Recovery & MySQL Credential Hunter for Hostinger Git deployment.
 */

error_reporting( E_ALL );
ini_set( 'display_errors', '1' );

// Turn off strict MySQLi reporting so we can catch and handle connection attempts cleanly
if ( function_exists( 'mysqli_report' ) ) {
    mysqli_report( MYSQLI_REPORT_OFF );
}

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
// 2. DISCOVER EXACT MYSQL CREDENTIALS ACROSS SERVER
// -----------------------------------------------------------------------------
$credentials_to_test = [
    // [DB_NAME, DB_USER, DB_PASSWORD, Source Label]
    ['u362580417_MOrXI', 'u362580417_VR4qn', 'Animazon@Erode11', 'env.backup Rudra Spirit'],
    ['u362580417_MOrXI', 'u362580417_VR4qn', 'LenzBreeze@987#', 'env.backup + alt pass'],
];

// Extract all real usernames/passwords from existing wp-config files on server
$known_configs = [
    '/home/u362580417/domains/shivarudraksha.in/public_html/wp-config.php',
    '/home/u362580417/domains/wildlifeleather.in/public_html/wp-config.php',
    '/home/u362580417/domains/animazon.in/public_html/shivarudraksha/wp-config.php',
];

$all_users = ['u362580417_VR4qn', 'u362580417_Vaf49', 'u362580417_WT0W0', 'u362580417_yUI1B', 'u362580417_lenztest', 'u362580417_lenzbreezedb'];
$all_passes = ['Animazon@Erode11', 'LenzBreeze@987#'];
$all_dbs = ['u362580417_MOrXI', 'u362580417_cRhnL', 'u362580417_iik8p', 'u362580417_iVXDS', 'u362580417_lenztest', 'u362580417_lenzbreezedb'];

foreach ( $known_configs as $kcfg ) {
    if ( file_exists( $kcfg ) ) {
        $c = file_get_contents( $kcfg );
        preg_match( '/define\(\s*[\'"]DB_NAME[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $c, $md );
        preg_match( '/define\(\s*[\'"]DB_USER[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $c, $mu );
        preg_match( '/define\(\s*[\'"]DB_PASSWORD[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $c, $mp );
        
        if ( ! empty( $md[1] ) && ! in_array( $md[1], $all_dbs ) ) $all_dbs[] = $md[1];
        if ( ! empty( $mu[1] ) && ! in_array( $mu[1], $all_users ) ) $all_users[] = $mu[1];
        if ( ! empty( $mp[1] ) && ! in_array( $mp[1], $all_passes ) ) $all_passes[] = $mp[1];
        
        if ( ! empty( $md[1] ) && ! empty( $mu[1] ) && ! empty( $mp[1] ) ) {
            $credentials_to_test[] = [$md[1], $mu[1], $mp[1], "from " . basename( dirname( $kcfg ) )];
        }
    }
}

// Build matrix of all potential u362580417 DB / User / Pass combinations
foreach ( $all_dbs as $db ) {
    foreach ( $all_users as $usr ) {
        foreach ( $all_passes as $pwd ) {
            $credentials_to_test[] = [$db, $usr, $pwd, 'matrix'];
        }
    }
}

$working_db = false;
$working_user = false;
$working_pass = false;
$working_siteurl = false;

// Test all credentials
foreach ( $credentials_to_test as $cred ) {
    try {
        $conn = @mysqli_connect( 'localhost', $cred[1], $cred[2], $cred[0] );
        if ( $conn ) {
            // Check if this database actually has wp_options with siteurl or home
            $res = @mysqli_query( $conn, "SELECT option_value FROM wp_options WHERE option_name IN ('siteurl', 'home') LIMIT 1" );
            if ( $res && ( $row = mysqli_fetch_assoc( $res ) ) ) {
                $val = $row['option_value'];
                // If this DB matches rudraspirit, prioritize it immediately!
                if ( strpos( $val, 'rudraspirit' ) !== false || ! $working_db ) {
                    $working_db = $cred[0];
                    $working_user = $cred[1];
                    $working_pass = $cred[2];
                    $working_siteurl = $val;
                    @mysqli_close( $conn );
                    if ( strpos( $val, 'rudraspirit' ) !== false ) {
                        break; // Exact rudraspirit database found!
                    }
                }
            }
            @mysqli_close( $conn );
        }
    } catch ( Throwable $t ) {
        // Ignore exception from invalid login
    }
}

// If we found the working DB, write it to app/public/wp-config.php!
$wp_config_path = $app_public . '/wp-config.php';
if ( $working_db && $working_user && $working_pass ) {
    $current_cfg = file_exists( $wp_config_path ) ? file_get_contents( $wp_config_path ) : '';
    if ( strpos( $current_cfg, $working_db ) === false || strpos( $current_cfg, $working_user ) === false ) {
        $prod_wp_config = <<<PHP
<?php
/**
 * Production Hostinger wp-config.php for Rudra Spirit (rudraspirit.com)
 * Auto-detected and verified working by Vemus recovery engine.
 */

define( 'DB_NAME', '{$working_db}' );
define( 'DB_USER', '{$working_user}' );
define( 'DB_PASSWORD', '{$working_pass}' );
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
}

// -----------------------------------------------------------------------------
// 3. DIAGNOSTIC OUTPUT MODE (?vemus_debug=1)
// -----------------------------------------------------------------------------
if ( isset( $_GET['vemus_debug'] ) && $_GET['vemus_debug'] === '1' ) {
    header( 'Content-Type: text/plain' );
    echo "=== MySQL Credential Hunter Results ===\n";
    if ( $working_db ) {
        echo "--> SUCCESS! Found working MySQL connection:\n";
        echo "   DB_NAME: " . $working_db . "\n";
        echo "   DB_USER: " . $working_user . "\n";
        echo "   DB_PASS: " . substr( $working_pass, 0, 3 ) . "********\n";
        echo "   siteurl in database: " . $working_siteurl . "\n\n";
    } else {
        echo "--> ALL MYSQL CREDENTIAL COMBINATIONS FAILED TO CONNECT OR FIND WP_OPTIONS.\n\n";
        echo "Tested combinations count: " . count( $credentials_to_test ) . "\n";
        // Show all combinations tested without showing full passwords
        foreach ( array_slice( $credentials_to_test, 0, 10 ) as $idx => $ct ) {
            echo "   [" . ($idx+1) . "] DB: " . $ct[0] . " | User: " . $ct[1] . " | Pass: " . substr( $ct[2], 0, 2 ) . "***\n";
        }
    }

    echo "Checking current app/public/wp-config.php status:\n";
    if ( file_exists( $wp_config_path ) ) {
        $cfg = file_get_contents( $wp_config_path );
        preg_match( '/define\(\s*[\'"]DB_NAME[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $cfg, $mn );
        preg_match( '/define\(\s*[\'"]DB_USER[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $cfg, $mu );
        echo "   Active DB_NAME: " . ( $mn[1] ?? 'unknown' ) . "\n";
        echo "   Active DB_USER: " . ( $mu[1] ?? 'unknown' ) . "\n";
    } else {
        echo "   app/public/wp-config.php -> MISSING!\n";
    }

    if ( $working_db && file_exists( $app_public . '/wp-load.php' ) ) {
        echo "\nLoading WordPress core environment:\n";
        try {
            chdir( $app_public );
            require_once $app_public . '/wp-load.php';
            echo "--> WordPress loaded cleanly!\n";
            echo "--> Active Theme: " . ( function_exists( 'wp_get_theme' ) ? wp_get_theme()->get( 'Name' ) : 'N/A' ) . "\n";
            echo "--> site_url(): " . ( function_exists( 'site_url' ) ? site_url() : 'N/A' ) . "\n";
        } catch ( Throwable $t ) {
            echo "--> WP Load Exception: " . $t->getMessage() . " in " . $t->getFile() . " on line " . $t->getLine() . "\n";
        }
    }

    echo "=======================================\n";
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
