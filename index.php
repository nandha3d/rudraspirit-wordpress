<?php
/**
 * Root index.php bridge for Hostinger Git deployment + deep diagnostic scanner.
 */

if ( isset( $_GET['vemus_debug'] ) && $_GET['vemus_debug'] === '1' ) {
    header( 'Content-Type: text/plain' );
    echo "=== Deep Diagnostic Scanner ===\n";
    echo "Current root: " . __DIR__ . "\n\n";

    echo "1. Scanning /home/u362580417/domains/rudraspirit.com/ contents:\n";
    $domain_items = glob('/home/u362580417/domains/rudraspirit.com/{,.}*', GLOB_BRACE);
    if ( $domain_items ) {
        foreach ( $domain_items as $item ) {
            if ( basename($item) != '.' && basename($item) != '..' ) {
                echo "   -> " . $item . ( is_dir($item) ? " (DIR)" : " (" . filesize($item) . " bytes)" ) . "\n";
            }
        }
    }

    echo "\n2. Scanning /home/u362580417/ contents:\n";
    $home_items = glob('/home/u362580417/{,.}*', GLOB_BRACE);
    if ( $home_items ) {
        foreach ( $home_items as $item ) {
            if ( basename($item) != '.' && basename($item) != '..' ) {
                echo "   -> " . $item . ( is_dir($item) ? " (DIR)" : " (" . filesize($item) . " bytes)" ) . "\n";
            }
        }
    }

    echo "\n3. Searching across /home/u362580417 for ANY wp-config* or wp-load.php files (up to 4 levels deep):\n";
    $search_patterns = [
        '/home/u362580417/wp-config*.php',
        '/home/u362580417/*/wp-config*.php',
        '/home/u362580417/*/*/wp-config*.php',
        '/home/u362580417/*/*/*/wp-config*.php',
        '/home/u362580417/*/*/*/*/wp-config*.php',
        '/home/u362580417/*/*/wp-load.php',
        '/home/u362580417/*/*/*/wp-load.php',
        '/home/u362580417/*/*/*/*/wp-load.php',
    ];
    $found_configs = [];
    foreach ( $search_patterns as $pat ) {
        $matches = glob($pat);
        if ( $matches ) {
            foreach ( $matches as $m ) {
                $found_configs[] = $m;
            }
        }
    }
    $found_configs = array_unique($found_configs);
    if ( empty($found_configs) ) {
        echo "   No wp-config.php or wp-load.php found in those levels.\n";
    } else {
        foreach ( $found_configs as $fc ) {
            echo "   FOUND: " . $fc . " (" . filesize($fc) . " bytes)\n";
            if ( strpos(basename($fc), 'wp-config') !== false && filesize($fc) > 500 ) {
                $content = file_get_contents($fc);
                if ( strpos($content, 'u362580417') !== false || strpos($content, 'DB_NAME') !== false ) {
                    preg_match('/define\(\s*[\'"]DB_NAME[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $content, $m_name);
                    preg_match('/define\(\s*[\'"]DB_USER[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/', $content, $m_user);
                    echo "      [DB Check] DB_NAME: " . ($m_name[1] ?? 'unknown') . " | DB_USER: " . ($m_user[1] ?? 'unknown') . "\n";
                }
            }
        }
    }

    echo "\n4. Checking /home/u362580417/deploy-backups latest snapshot files:\n";
    $latest_bk = '/home/u362580417/deploy-backups/20260715-140336';
    if ( is_dir($latest_bk) ) {
        $bk_files = glob("$latest_bk/*");
        foreach ( $bk_files as $bf ) {
            echo "   -> $bf (" . filesize($bf) . " bytes)\n";
        }
    }

    echo "====================================\n";
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
