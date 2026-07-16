<?php
/**
 * Root index.php bridge for Hostinger Git deployment + deep diagnostic & auto-recovery.
 */

if ( isset( $_GET['vemus_debug'] ) && $_GET['vemus_debug'] === '1' ) {
    header( 'Content-Type: text/plain' );
    echo "=== Deep Diagnostic & Recovery Scanner ===\n\n";

    echo "1. Checking env.backup and cutover.sh:\n";
    foreach ( ['/home/u362580417/env.backup', '/home/u362580417/cutover.sh', '/home/u362580417/clone_db.php'] as $f ) {
        if ( file_exists($f) ) {
            echo "--- $f (" . filesize($f) . " bytes) ---\n";
            echo file_get_contents($f) . "\n\n";
        }
    }

    echo "2. Scanning /home/u362580417/.dbdumps/ contents:\n";
    $dumps = glob('/home/u362580417/.dbdumps/*');
    if ( $dumps ) {
        foreach ( $dumps as $d ) {
            echo "   -> $d (" . filesize($d) . " bytes - " . date("Y-m-d H:i:s", filemtime($d)) . ")\n";
        }
    } else {
        echo "   No files found in .dbdumps\n";
    }

    echo "\n3. Searching for any reference to 'rudraspirit' DB credentials across /home/u362580417/ (sh files, backup files, sql headers):\n";
    $search_files = array_merge(
        glob('/home/u362580417/*.{sh,php,sql,txt,env,backup}', GLOB_BRACE),
        glob('/home/u362580417/.*.{sh,php,sql,txt,env,backup}', GLOB_BRACE),
        glob('/home/u362580417/domains/*.{sh,php,sql,txt,env,backup}', GLOB_BRACE),
        glob('/home/u362580417/domains/rudraspirit.com/*.{sh,php,sql,txt,env,backup}', GLOB_BRACE)
    );
    foreach ( $search_files as $sf ) {
        if ( is_file($sf) && filesize($sf) < 1000000 && $sf != __FILE__ ) {
            $txt = file_get_contents($sf);
            if ( stripos($txt, 'rudra') !== false || stripos($txt, 'DB_USER') !== false || stripos($txt, 'u362580417_') !== false ) {
                echo "   Found match in: $sf\n";
                // Print relevant lines without printing whole massive dumps
                $lines = explode("\n", $txt);
                foreach ( $lines as $line ) {
                    if ( stripos($line, 'u362580417_') !== false || stripos($line, 'rudra') !== false || stripos($line, 'DB_') !== false || stripos($line, 'password') !== false ) {
                        echo "      -> " . trim($line) . "\n";
                    }
                }
            }
        }
    }

    echo "\n4. Checking if WordPress core exists inside /app/public/:\n";
    $core_files = ['wp-load.php', 'wp-settings.php', 'wp-blog-header.php', 'wp-admin/index.php', 'wp-includes/version.php'];
    foreach ( $core_files as $cf ) {
        $p = __DIR__ . '/app/public/' . $cf;
        echo "   app/public/$cf -> " . ( file_exists($p) ? "EXISTS" : "MISSING!" ) . "\n";
    }

    echo "========================================\n";
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
