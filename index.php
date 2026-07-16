<?php
/**
 * Root index.php bridge, Auto-Recovery Engine for Hostinger Git deployment.
 * Restores WordPress core, production wp-config.php, AND plugins from server backup.
 */

error_reporting( E_ALL );
ini_set( 'display_errors', '1' );

if ( function_exists( 'mysqli_report' ) ) {
    mysqli_report( MYSQLI_REPORT_OFF );
}

$app_public = __DIR__ . '/app/public';
$wp_content = $app_public . '/wp-content';

// -----------------------------------------------------------------------------
// 1. AUTO-RESTORE WORDPRESS CORE ENGINE FILES IF MISSING
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
// 2. AUTO-RESTORE PLUGINS FROM wp-content.tar.gz BACKUP IF MISSING
// -----------------------------------------------------------------------------
$woo_check = $wp_content . '/plugins/woocommerce/woocommerce.php';
$elementor_check = $wp_content . '/plugins/elementor/elementor.php';

if ( ! file_exists( $woo_check ) || ! file_exists( $elementor_check ) ) {
    // Find latest wp-content.tar.gz backup
    $backup_dirs = glob( '/home/u362580417/deploy-backups/*', GLOB_ONLYDIR );
    if ( $backup_dirs ) {
        // Sort to get latest backup
        rsort( $backup_dirs );
        $tar_path = false;
        foreach ( $backup_dirs as $bd ) {
            $candidate = $bd . '/wp-content.tar.gz';
            if ( file_exists( $candidate ) && filesize( $candidate ) > 1000 ) {
                $tar_path = $candidate;
                break;
            }
        }

        if ( $tar_path && function_exists( 'shell_exec' ) ) {
            // Create a temp extraction directory
            $tmp_extract = '/home/u362580417/deploy-backups/_tmp_restore_' . time();
            @mkdir( $tmp_extract, 0755, true );

            // Extract the tar.gz (contains wp-content/ structure)
            @shell_exec( "cd " . escapeshellarg( $tmp_extract ) . " && tar xzf " . escapeshellarg( $tar_path ) . " 2>&1" );

            // Determine where wp-content extracted to
            $extracted_wpcontent = $tmp_extract . '/wp-content';
            if ( ! is_dir( $extracted_wpcontent ) ) {
                // Maybe it extracted directly without wp-content/ prefix
                $extracted_wpcontent = $tmp_extract;
            }

            // --- Restore plugins (skip vemus-addon since Git has our latest version) ---
            $extracted_plugins = $extracted_wpcontent . '/plugins';
            if ( is_dir( $extracted_plugins ) ) {
                $plugin_dirs = glob( $extracted_plugins . '/*', GLOB_ONLYDIR );
                foreach ( $plugin_dirs as $pdir ) {
                    $pname = basename( $pdir );
                    $target = $wp_content . '/plugins/' . $pname;
                    // Skip vemus-addon (Git version is newer) and already-existing plugins
                    if ( $pname === 'vemus-addon' ) {
                        continue;
                    }
                    if ( ! is_dir( $target ) ) {
                        @shell_exec( "cp -r " . escapeshellarg( $pdir ) . " " . escapeshellarg( $target ) . " 2>&1" );
                    }
                }
                // Also restore plugins index.php if missing
                if ( ! file_exists( $wp_content . '/plugins/index.php' ) && file_exists( $extracted_plugins . '/index.php' ) ) {
                    @copy( $extracted_plugins . '/index.php', $wp_content . '/plugins/index.php' );
                }
            }

            // --- Restore uploads directory if missing ---
            $extracted_uploads = $extracted_wpcontent . '/uploads';
            if ( is_dir( $extracted_uploads ) && ! is_dir( $wp_content . '/uploads' ) ) {
                @shell_exec( "cp -r " . escapeshellarg( $extracted_uploads ) . " " . escapeshellarg( $wp_content . '/uploads' ) . " 2>&1" );
            }

            // --- Restore themes (skip vemus-child since Git has our latest version) ---
            $extracted_themes = $extracted_wpcontent . '/themes';
            if ( is_dir( $extracted_themes ) ) {
                $theme_dirs = glob( $extracted_themes . '/*', GLOB_ONLYDIR );
                foreach ( $theme_dirs as $tdir ) {
                    $tname = basename( $tdir );
                    $target = $wp_content . '/themes/' . $tname;
                    // Skip vemus-child (Git version is newer), keep vemus parent theme
                    if ( $tname === 'vemus-child' ) {
                        continue;
                    }
                    if ( ! is_dir( $target ) ) {
                        @shell_exec( "cp -r " . escapeshellarg( $tdir ) . " " . escapeshellarg( $target ) . " 2>&1" );
                    }
                }
            }

            // Clean up temp extraction
            @shell_exec( "rm -rf " . escapeshellarg( $tmp_extract ) . " 2>&1" );
        }
    }
}

// -----------------------------------------------------------------------------
// 3. ENFORCE PRODUCTION DATABASE CREDENTIALS IN WP-CONFIG.PHP
// -----------------------------------------------------------------------------
$wp_config_path = $app_public . '/wp-config.php';
$needs_config = false;

if ( ! file_exists( $wp_config_path ) ) {
    $needs_config = true;
} else {
    $current_cfg = @file_get_contents( $wp_config_path );
    if ( strpos( $current_cfg, 'u362580417_MOrXI' ) === false ) {
        $needs_config = true;
    }
}

if ( $needs_config ) {
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

define( 'WP_DEBUG', false );
define( 'WP_ENVIRONMENT_TYPE', 'production' );

define( 'AUTH_KEY',         'xf!@#RudraSpiritProduction2026' );
define( 'SECURE_AUTH_KEY',  'ys!@#RudraSpiritSecureAuth2026' );
define( 'LOGGED_IN_KEY',    'zl!@#RudraSpiritLoggedIn2026' );
define( 'NONCE_KEY',        'wn!@#RudraSpiritNonce2026' );
define( 'AUTH_SALT',        'xa!@#RudraSpiritAuthSalt2026' );
define( 'SECURE_AUTH_SALT', 'yb!@#RudraSpiritSecAuthSalt2026' );
define( 'LOGGED_IN_SALT',   'zc!@#RudraSpiritLogInSalt2026' );
define( 'NONCE_SALT',       'wd!@#RudraSpiritNonceSalt2026' );

/* That's all, stop editing! Happy publishing. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';
PHP;

    @file_put_contents( $wp_config_path, $prod_wp_config );
}

// -----------------------------------------------------------------------------
// 4. DIAGNOSTIC OUTPUT MODE (?vemus_debug=1)
// -----------------------------------------------------------------------------
if ( isset( $_GET['vemus_debug'] ) && $_GET['vemus_debug'] === '1' ) {
    header( 'Content-Type: text/plain' );
    echo "=== Rudra Spirit Full Recovery Status ===\n\n";

    echo "1. WordPress Core:\n";
    echo "   wp-load.php: " . ( file_exists( $app_public . '/wp-load.php' ) ? "OK" : "MISSING" ) . "\n";
    echo "   wp-admin/: " . ( is_dir( $app_public . '/wp-admin' ) ? "OK" : "MISSING" ) . "\n";
    echo "   wp-includes/: " . ( is_dir( $app_public . '/wp-includes' ) ? "OK" : "MISSING" ) . "\n";

    echo "\n2. Critical Plugins:\n";
    $critical_plugins = [
        'woocommerce/woocommerce.php',
        'elementor/elementor.php',
        'vemus-addon/vemus-addon.php',
        'wcboost-wishlist/wcboost-wishlist.php',
        'wcboost-variation-swatches/wcboost-variation-swatches.php',
        'contact-form-7/wp-contact-form-7.php',
        'litespeed-cache/litespeed-cache.php',
    ];
    foreach ( $critical_plugins as $cp ) {
        $ppath = $wp_content . '/plugins/' . $cp;
        $pname = dirname( $cp );
        echo "   " . str_pad( $pname, 30 ) . " -> " . ( file_exists( $ppath ) ? "OK" : "MISSING!" ) . "\n";
    }

    // Count total plugins
    $all_plugins = glob( $wp_content . '/plugins/*', GLOB_ONLYDIR );
    echo "   Total plugin directories: " . count( (array) $all_plugins ) . "\n";

    echo "\n3. Themes:\n";
    $themes = glob( $wp_content . '/themes/*', GLOB_ONLYDIR );
    foreach ( (array) $themes as $t ) {
        echo "   " . basename( $t ) . "/\n";
    }

    echo "\n4. Uploads directory: " . ( is_dir( $wp_content . '/uploads' ) ? "OK (" . count( (array) glob( $wp_content . '/uploads/*' ) ) . " items)" : "MISSING!" ) . "\n";

    echo "\n5. wp-config.php:\n";
    if ( file_exists( $wp_config_path ) ) {
        $cfg = file_get_contents( $wp_config_path );
        preg_match( '/define\(\s*[\'"]DB_NAME[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $cfg, $mn );
        echo "   DB_NAME: " . ( $mn[1] ?? 'unknown' ) . "\n";
    }

    echo "\n6. Database connection:\n";
    $conn = @mysqli_connect( 'localhost', 'u362580417_VR4qn', 'Animazon@Erode11', 'u362580417_MOrXI' );
    if ( $conn ) {
        echo "   -> CONNECTED!\n";
        $res = @mysqli_query( $conn, "SELECT option_value FROM wp_options WHERE option_name='siteurl' LIMIT 1" );
        if ( $res && ( $row = mysqli_fetch_assoc( $res ) ) ) {
            echo "   -> siteurl: " . $row['option_value'] . "\n";
        }
        // Check active plugins in database
        $res2 = @mysqli_query( $conn, "SELECT option_value FROM wp_options WHERE option_name='active_plugins' LIMIT 1" );
        if ( $res2 && ( $row2 = mysqli_fetch_assoc( $res2 ) ) ) {
            $active = @unserialize( $row2['option_value'] );
            if ( is_array( $active ) ) {
                echo "   -> Active plugins in DB (" . count( $active ) . "):\n";
                foreach ( $active as $ap ) {
                    $pfile = $wp_content . '/plugins/' . $ap;
                    $status = file_exists( $pfile ) ? 'OK' : 'FILE MISSING!';
                    echo "      " . str_pad( $ap, 55 ) . " [" . $status . "]\n";
                }
            }
        }
        @mysqli_close( $conn );
    } else {
        echo "   -> FAILED: " . mysqli_connect_error() . "\n";
    }

    echo "\n7. Backup tar.gz files:\n";
    $bdirs = glob( '/home/u362580417/deploy-backups/*', GLOB_ONLYDIR );
    if ( $bdirs ) {
        rsort( $bdirs );
        foreach ( array_slice( $bdirs, 0, 3 ) as $bd ) {
            $tgz = $bd . '/wp-content.tar.gz';
            echo "   " . basename( $bd ) . "/wp-content.tar.gz -> " . ( file_exists( $tgz ) ? filesize( $tgz ) . " bytes" : "NOT FOUND" ) . "\n";
        }
    }

    echo "==========================================\n";
    exit;
}

// -----------------------------------------------------------------------------
// 5. ROUTE TO WORDPRESS
// -----------------------------------------------------------------------------
if ( file_exists( $app_public . '/index.php' ) && file_exists( $app_public . '/wp-load.php' ) && file_exists( $wp_config_path ) ) {
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
