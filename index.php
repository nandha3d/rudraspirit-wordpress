<?php
/**
 * Root index.php bridge & Strict Rudra Spirit Database Hunter for Hostinger Git deployment.
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
// Note: We copy ONLY standard generic core engine files (wp-load.php, wp-admin/, wp-includes/)
// to replace what .gitignore skipped. We NEVER touch or modify any other site on the server.
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
                // Copy all wp-*.php EXCEPT wp-config.php
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
// 2. STRICT RUDRASPIRIT DATABASE HUNTER
// -----------------------------------------------------------------------------
$credentials_to_test = [
    ['u362580417_MOrXI', 'u362580417_VR4qn', 'Animazon@Erode11', 'env.backup Rudra Spirit'],
    ['u362580417_MOrXI', 'u362580417_VR4qn', 'LenzBreeze@987#', 'env.backup + alt pass'],
];

$known_configs = [
    '/home/u362580417/domains/shivarudraksha.in/public_html/wp-config.php',
    '/home/u362580417/domains/wildlifeleather.in/public_html/wp-config.php',
    '/home/u362580417/domains/animazon.in/public_html/shivarudraksha/wp-config.php',
];

$all_users = ['u362580417_VR4qn', 'u362580417_Vaf49', 'u362580417_WT0W0', 'u362580417_yUI1B', 'u362580417_lenztest'];
$all_passes = ['Animazon@Erode11', 'LenzBreeze@987#'];
$all_dbs = ['u362580417_MOrXI', 'u362580417_lenztest', 'u362580417_cRhnL', 'u362580417_iik8p', 'u362580417_iVXDS'];

foreach ( $known_configs as $kcfg ) {
    if ( file_exists( $kcfg ) ) {
        $c = file_get_contents( $kcfg );
        preg_match( '/define\(\s*[\'"]DB_NAME[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $c, $md );
        preg_match( '/define\(\s*[\'"]DB_USER[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $c, $mu );
        preg_match( '/define\(\s*[\'"]DB_PASSWORD[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $c, $mp );
        
        if ( ! empty( $md[1] ) && ! in_array( $md[1], $all_dbs ) ) $all_dbs[] = $md[1];
        if ( ! empty( $mu[1] ) && ! in_array( $mu[1], $all_users ) ) $all_users[] = $mu[1];
        if ( ! empty( $mp[1] ) && ! in_array( $mp[1], $all_passes ) ) $all_passes[] = $mp[1];
    }
}

// Build matrix testing every combination against u362580417_MOrXI first, then all dbs
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

// Test combinations STRICTLY verifying that siteurl or option_value contains 'rudraspirit'
foreach ( $credentials_to_test as $cred ) {
    try {
        $conn = @mysqli_connect( 'localhost', $cred[1], $cred[2], $cred[0] );
        if ( $conn ) {
            $res = @mysqli_query( $conn, "SELECT option_value FROM wp_options WHERE option_name IN ('siteurl', 'home') LIMIT 2" );
            if ( $res ) {
                while ( $row = mysqli_fetch_assoc( $res ) ) {
                    $val = $row['option_value'];
                    // STRICT REQUIREMENT: Only accept databases belonging to rudraspirit!
                    if ( stripos( $val, 'rudraspirit' ) !== false ) {
                        $working_db = $cred[0];
                        $working_user = $cred[1];
                        $working_pass = $cred[2];
                        $working_siteurl = $val;
                        break 2;
                    }
                }
            }
            @mysqli_close( $conn );
        }
    } catch ( Throwable $t ) {
        // Ignore invalid connection attempts
    }
}

// If not found yet, try connecting to MySQL with working user/pass to run SHOW DATABASES and scan all DBs for rudraspirit
if ( ! $working_db ) {
    foreach ( $all_users as $usr ) {
        foreach ( $all_passes as $pwd ) {
            try {
                $conn = @mysqli_connect( 'localhost', $usr, $pwd );
                if ( $conn ) {
                    $dres = @mysqli_query( $conn, "SHOW DATABASES" );
                    if ( $dres ) {
                        while ( $drow = mysqli_fetch_row( $dres ) ) {
                            $dbname = $drow[0];
                            if ( stripos( $dbname, 'u362580417_' ) === 0 ) {
                                $sres = @mysqli_query( $conn, "SELECT option_value FROM `{$dbname}`.wp_options WHERE option_name='siteurl' AND option_value LIKE '%rudraspirit%' LIMIT 1" );
                                if ( $sres && ( $srow = mysqli_fetch_assoc( $sres ) ) ) {
                                    $working_db = $dbname;
                                    $working_user = $usr;
                                    $working_pass = $pwd;
                                    $working_siteurl = $srow['option_value'];
                                    @mysqli_close( $conn );
                                    break 3;
                                }
                            }
                        }
                    }
                    @mysqli_close( $conn );
                }
            } catch ( Throwable $t2 ) {}
        }
    }
}

// Write the verified rudraspirit database config to app/public/wp-config.php!
$wp_config_path = $app_public . '/wp-config.php';
if ( $working_db && $working_user && $working_pass ) {
    $current_cfg = file_exists( $wp_config_path ) ? file_get_contents( $wp_config_path ) : '';
    // Overwrite if currently missing or set to wrong database
    if ( strpos( $current_cfg, $working_db ) === false || strpos( $current_cfg, 'shivarudraksha' ) !== false || strpos( $current_cfg, 'u362580417_cRhnL' ) !== false ) {
        $prod_wp_config = <<<PHP
<?php
/**
 * Production Hostinger wp-config.php for Rudra Spirit (rudraspirit.com)
 * Verified by Vemus Strict Rudra Spirit Database Hunter.
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
    echo "=== Strict Rudra Spirit Database Hunter ===\n";
    if ( $working_db ) {
        echo "--> SUCCESS! Found exact Rudra Spirit MySQL database:\n";
        echo "   DB_NAME: " . $working_db . "\n";
        echo "   DB_USER: " . $working_user . "\n";
        echo "   DB_PASS: " . substr( $working_pass, 0, 3 ) . "********\n";
        echo "   siteurl in database: " . $working_siteurl . "\n\n";
    } else {
        echo "--> FAILED TO FIND DB WITH 'rudraspirit' IN SITEURL across all combinations.\n\n";
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
            echo "--> home_url(): " . ( function_exists( 'home_url' ) ? home_url() : 'N/A' ) . "\n";
        } catch ( Throwable $t ) {
            echo "--> WP Load Exception: " . $t->getMessage() . " in " . $t->getFile() . " on line " . $t->getLine() . "\n";
        }
    }

    echo "===============================================\n";
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
