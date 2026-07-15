<?php
/**
 * themesflat functions and definitions
 *
 * @package vemus
 */
// remove_theme_mods();

define( 'THEMESFLAT_DIR', trailingslashit( get_template_directory() )) ;
define( 'THEMESFLAT_LINK', trailingslashit( get_template_directory_uri() ) );
define( 'THEMESFLAT_PROTOCOL' , (is_ssl()) ? 'https' : 'http' );
if ( ! function_exists( 'themesflat_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function themesflat_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on burger, use a find and replace
     * to change 'vemus' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'vemus', THEMESFLAT_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    add_theme_support( "wp-block-styles" );
    add_theme_support( "responsive-embeds" );
    add_theme_support( 'custom-logo', array(
            'flex-height' => true,
            'flex-width'  => true,
        ) );
    add_theme_support( "align-wide" );
    add_theme_support( 'title-tag' );

    // Content width
    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 1200; /* pixels */
    }

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    function wpse_setup_theme() {
        add_theme_support( 'post-thumbnails' ); 
        add_theme_support( 'woocommerce' );
    }
     
    add_action( 'after_setup_theme', 'wpse_setup_theme' );

    if (function_exists('add_image_size')){
        add_image_size( 'themesflat-blog', 1138, 592, true );
        add_image_size( 'themesflat-blog-grid', 729, 592, true );    
        add_image_size( 'themesflat-blog-single', 1632, 592, array('center', 'top') );    
    }

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu (Includes mega menu)', 'vemus' ),
        'mobile' => esc_html__( 'Mobile Menu', 'vemus' ),
        'category-menu' => esc_html__( 'Category Menu', 'vemus' ),        
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'gallery', 'video', 'quote', 'link', 'audio'
    ) );

    // Set up the WordPress core custom background feature.
    $args = array(
        'default-color' => 'ffffff',
        'default-image' => '',
    );

    add_theme_support( 'custom-background', $args );
    add_theme_support( 'custom-header', $args );

    // Custom stylesheet to the TinyMCE visual editor
    function themesflat_add_editor_styles() {
        add_editor_style( 'assets/css/editor-style.css' );
    }
    add_action( 'admin_init', 'themesflat_add_editor_styles' );

    // Enable woocommerce support
    add_theme_support( 'woocommerce' );

}
endif; // themesflat_setup

add_action( 'after_setup_theme', 'themesflat_setup' );

function themesflat_wpfilesystem() {
    include_once (ABSPATH . '/wp-admin/includes/file.php');
    WP_Filesystem();
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function themesflat_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Blog', 'vemus' ),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Blog Sidebar.', 'vemus' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );     

    //Widget footer
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 1', 'vemus' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Footer area 1.', 'vemus' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 2', 'vemus' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Footer area 2.', 'vemus' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 3', 'vemus' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Footer area 3.', 'vemus' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 4', 'vemus' ),
        'id'            => 'footer-4',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Footer area 4.', 'vemus' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    if ( class_exists( 'woocommerce' ) ) {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar Shop', 'vemus' ),
            'id'            => 'shop-sidebar',
            'description'   => esc_html__( 'Add widgets here to appear in your sidebar shop.', 'vemus' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'After Sidebar Shop', 'vemus' ),
            'id'            => 'after-shop-sidebar',
            'description'   => esc_html__( 'Add widgets here to appear in your after sidebar shop.', 'vemus' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar Single Shop', 'vemus' ),
            'id'            => 'shop-single-sidebar',
            'description'   => esc_html__( 'Add widgets here to appear in your sidebar shop single.', 'vemus' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );
    }
}
add_action( 'widgets_init', 'themesflat_widgets_init' );

function themesflat_get_style($style) {
    $style = $style ?? '';
    return str_replace('italic', 'i', $style);
}

function themesflat_fonts_url() {
    $fonts_url = '';
    $typography_logo =  themesflat_get_json('typography_body');

    $typography_announcement =  themesflat_get_json('typography_announcement');
    $typography_body =  themesflat_get_json('typography_body');
    $typography_headings = themesflat_get_json('typography_headings');
    $typography_menu = themesflat_get_json('typography_menu');
    $typography_sub_menu =  themesflat_get_json('typography_sub_menu');
    $typography_topbar =  themesflat_get_json('typography_topbar');
    $typography_blockquote =  themesflat_get_json('typography_blockquote');
    $typography_blog_post_title =  themesflat_get_json('typography_blog_post_title');
    $typography_blog_post_meta = themesflat_get_json('typography_blog_post_meta');
    $typography_blog_post_buttons = themesflat_get_json('typography_blog_post_buttons');
    $typography_blog_single_title = themesflat_get_json('typography_blog_single_title');
    $typography_blog_single_comment_title = themesflat_get_json('typography_blog_single_comment_title');
    $typography_sidebar_widget_title = themesflat_get_json('typography_sidebar_widget_title');
    $typography_footer_widget_title = themesflat_get_json('typography_footer_widget_title');
    $typography_page_title = themesflat_get_json('typography_page_title');
    $typography_breadcrumb = themesflat_get_json('typography_breadcrumb');
    $typography_buttons = themesflat_get_json('typography_buttons');
    $typography_pagination = themesflat_get_json('typography_pagination');
    $typography_bottom_menu = themesflat_get_json('typography_bottom_menu');   
    $typography_footer = themesflat_get_json('typography_footer');
    $typography_bottom_copyright = themesflat_get_json('typography_bottom_copyright');

    $font_families = array(); 
    

    if ( '' != $typography_body ) {
        $font_families[] = $typography_body['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_body['style']);
    } else {
        $font_families[] = 'Poppins:400,400i,700,700i,900';
    }
    if ( '' != $typography_logo ) {
        $font_families[] = $typography_logo['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_logo['style']);
    } 
    if ( '' != $typography_headings ) {
        $font_families[] = $typography_headings['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_headings['style']);
    } 
    if ( '' != $typography_menu ) {
        $font_families[] = $typography_menu['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_menu['style']);
    }
    if ( '' != $typography_sub_menu ) {
        $font_families[] = $typography_sub_menu['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_sub_menu['style']);
    }
    if ( '' != $typography_topbar ) {
        $font_families[] = $typography_topbar['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_topbar['style']);
    }
    if ( '' != $typography_blockquote ) {
        $font_families[] = $typography_blockquote['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blockquote['style']);
    }
    if ( '' != $typography_blog_post_title ) {
        $font_families[] = $typography_blog_post_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_post_title['style']);
    }
    if ( '' != $typography_blog_post_meta ) {
        $font_families[] = $typography_blog_post_meta['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_post_meta['style']);
    }
    if ( '' != $typography_blog_post_buttons ) {
        $font_families[] = $typography_blog_post_buttons['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_post_buttons['style']);
    }
    if ( '' != $typography_blog_single_title ) {
        $font_families[] = $typography_blog_single_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_single_title['style']);
    }
    if ( '' != $typography_blog_single_comment_title ) {
        $font_families[] = $typography_blog_single_comment_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_single_comment_title['style']);
    }
    if ( '' != $typography_sidebar_widget_title ) {
        $font_families[] = $typography_sidebar_widget_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_sidebar_widget_title['style']);
    }
    if ( '' != $typography_footer_widget_title ) {
        $font_families[] = $typography_footer_widget_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_footer_widget_title['style']);
    }
    if ( '' != $typography_page_title ) {
        $font_families[] = $typography_page_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_page_title['style']);
    }
    if ( '' != $typography_breadcrumb ) {
        $font_families[] = $typography_breadcrumb['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_breadcrumb['style']);
    }
    if ( '' != $typography_buttons ) {
        $font_families[] = $typography_buttons['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_buttons['style']);
    }
    if ( '' != $typography_pagination ) {
        $font_families[] = $typography_pagination['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_pagination['style']);
    }
    if ( '' != $typography_bottom_menu ) {
        $font_families[] = $typography_bottom_menu['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_bottom_menu['style']);
    }
    if ( '' != $typography_footer ) {
        $font_families[] = $typography_footer['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_footer['style']);
    }
    if ( '' != $typography_bottom_copyright ) {
        $font_families[] = $typography_bottom_copyright['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_bottom_copyright['style']);
    } 
    if ( '' != $typography_announcement ) {
        $font_families[] = $typography_announcement['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_announcement['style']);
    }   
    
    $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),        
    );

    $fonts_url = add_query_arg( $query_args, THEMESFLAT_PROTOCOL . '://fonts.googleapis.com/css' );

    return esc_url_raw( $fonts_url );
}

function themesflat_scripts_styles() {
    wp_enqueue_style( 'themesflat-theme-slug-fonts', themesflat_fonts_url(), array(), null );
}

add_action( 'wp_enqueue_scripts', 'themesflat_scripts_styles' );

/**
 * Enqueue scripts and styles.
 */

function themesflat_scripts() {    
    // Theme stylesheet.    
    
    wp_enqueue_style( 'icon-vemus', THEMESFLAT_LINK . 'assets/css/3rd/icon-vemus.css' );
    wp_enqueue_style( 'themesflat-animated', THEMESFLAT_LINK . 'assets/css/3rd/animate.css' );
    wp_enqueue_style('themesflat-toast', THEMESFLAT_LINK . 'assets/css/3rd/jquery.toast.min.css');
    wp_enqueue_style( 'themesflat-bootstrap', THEMESFLAT_LINK . 'assets/css/3rd/bootstrap.min.css' );
    wp_enqueue_style( 'themesflat-bootstrap-select', THEMESFLAT_LINK . 'assets/css/3rd/bootstrap-select.min.css' );
    wp_enqueue_style( 'themesflat-main', THEMESFLAT_LINK . 'assets/css/vemus-main.css' );

    wp_register_style( 'nice-select', THEMESFLAT_LINK . 'assets/css/3rd/nice-select.css' );
    
    wp_enqueue_style( 'themesflat-swiper', THEMESFLAT_LINK . 'assets/css/3rd/swiper-bundle.min.css' );    

    if (is_archive() || is_single() || is_tax() || is_home()) {
        wp_enqueue_style( 'tf-blog', THEMESFLAT_LINK . 'assets/css/blog.css' );
    }
 
    if ( class_exists( 'woocommerce' ) ) {
        wp_enqueue_script( 'wc-cart-fragments' );
        if( is_rtl() ){
            wp_style_add_data( 'tf-woo', 'rtl', 'replace' );
        }
    }

    wp_enqueue_style( 'themesflat-shop', THEMESFLAT_LINK . 'assets/css/vemus-shop.min.css' );

    wp_enqueue_style( 'themesflat-inline-css', THEMESFLAT_LINK . 'assets/css/3rd/inline-css.css' );

    if ( themesflat_get_opt('enable_smooth_scroll') == 1 ) {
       wp_enqueue_script( 'smoothscroll', THEMESFLAT_LINK . 'assets/js/smoothscroll.js', array(),'1.2.1',true);
    }
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply', array(),'2.0.4',true );
    }

    wp_register_script('nice-select', THEMESFLAT_LINK . 'assets/js/3rd/nice-select.js', array('jquery'),'',true);
    wp_enqueue_script('themesflat-toast', THEMESFLAT_LINK . 'assets/js/3rd/jquery.toast.min.js', array('jquery'),'',true);
    wp_enqueue_script( 'themesflat-bootstrap', THEMESFLAT_LINK . 'assets/js/3rd/bootstrap.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'themesflat-bootstrap-select', THEMESFLAT_LINK . 'assets/js/3rd/bootstrap-select.min.js', array('themesflat-bootstrap'), null, true );
    wp_enqueue_script( 'themesflat-swiper', THEMESFLAT_LINK . 'assets/js/3rd/swiper-bundle.min.js', array(), null, true );        
    wp_enqueue_script( 'infinityslide', THEMESFLAT_LINK . 'assets/js/3rd/infinityslide.js', array(), null, true );        
    wp_register_script( 'count-down', THEMESFLAT_LINK . 'assets/js/3rd/count-down.js', array(), null, true );

    if ( ! wp_script_is( 'themesflat-lazysize', 'registered' ) ) {
        wp_register_script('themesflat-lazysize', THEMESFLAT_LINK . 'assets/js/3rd/lazysize.min.js', array(),'',true);
    }

    wp_enqueue_script( 'themesflat-main', THEMESFLAT_LINK . 'assets/js/main.js', array('themesflat-bootstrap-select', 'themesflat-lazysize'), '1.0.0', true );

    if( is_rtl() ){
        wp_style_add_data( 'themesflat-main', 'rtl', 'replace' );
        wp_style_add_data( 'themesflat-responsive', 'rtl', 'replace' );
    }
}

add_action( 'wp_enqueue_scripts', 'themesflat_scripts' );


/**
 * Enqueue Bootstrap
 */
function themesflat_enqueue_bootstrap() {
    wp_enqueue_style( 'bootstrap', THEMESFLAT_LINK . 'assets/css/bootstrap.css', array(), true );
}

// Customizer additions.
require THEMESFLAT_DIR . 'inc/customizer.php';

// Helper
require THEMESFLAT_DIR . 'inc/helper.php';

// Struct
require THEMESFLAT_DIR . 'inc/structure.php';

// Breadcrumbs additions.
require THEMESFLAT_DIR . 'inc/breadcrumb.php';

// Custom template tags for this theme.
require THEMESFLAT_DIR . 'inc/template-tags.php';

// Custom Sidebar Dynamic for this theme.
require THEMESFLAT_DIR . 'inc/sidebar_manage.php';

// Style.
require THEMESFLAT_DIR . 'inc/styles.php';

// Required plugins
require_once THEMESFLAT_DIR . 'inc/plugins/class-tgm-plugin-activation.php';

// Plugin Activation
require_once THEMESFLAT_DIR . 'inc/plugins/plugins.php';

require THEMESFLAT_DIR . "inc/options/options-definition.php";
require_once( THEMESFLAT_DIR . 'inc/options/controls/social_icons.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/number.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/dropdown-topbar.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/dropdown-sidebars.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/dropdown-pages.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/box-control.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/typography.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/radio-images.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/check-box.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/color_overlay.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/multi-images.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/styler_slider.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/draganddrop-controls.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/repeater-control.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/repeater-control2.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/icon-box.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/testimonial-control.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/testi-thankyou.php');
require_once( THEMESFLAT_DIR . 'inc/elementor-options/elementor-options.php');
require_once( THEMESFLAT_DIR . 'inc/elementor-options/elementor-functions.php');
require_once( THEMESFLAT_DIR . 'demo/import-demo.php');

// Load Customizer Style
function themesflat_load_customizer_style() {
    wp_enqueue_script( 'wp-plupload' );
    wp_enqueue_style( 'plugin-install' ); 
    wp_enqueue_script('jquery-ui');

    wp_register_style('themesflat-customizer', THEMESFLAT_LINK .'assets/css/admin/customizer.min.css', false, '1.0.0' );
    wp_enqueue_style('themesflat-customizer' ); 
    
    wp_enqueue_style( 'icon-vemus', THEMESFLAT_LINK . 'assets/css/3rd/icon-vemus.css' );

    
    wp_enqueue_style('themesflat-alpha-color-picker', THEMESFLAT_LINK .'assets/css/admin/alpha-color-picker.min.css', false, '1.0.0' );    
    wp_enqueue_script('themesflat-alpha-color-picker', THEMESFLAT_LINK . 'assets/js/admin/alpha-color-picker.js', array('wp-color-picker'),'2.1.2',true);
    wp_enqueue_script('themesflat-multi-image', THEMESFLAT_LINK . 'assets/js/admin/multi-image.js', array('jquery','customize-preview'),'', true );
    wp_enqueue_script('themesflat-sortablejs', THEMESFLAT_LINK . 'assets/js/admin/3rd/Sortable.min.js', array(), '1.15.0', true);
    wp_enqueue_script('themesflat-customizer', THEMESFLAT_LINK .'assets/js/admin/customizer.js', array( 'jquery','customize-preview', 'themesflat-sortablejs' ), '', true );
    wp_enqueue_script('themesflat-rp-topbar', THEMESFLAT_LINK . 'assets/js/admin/customizer-repeater-controls-topbar.js', array('jquery'), null, true );
    wp_enqueue_script('themesflat-rp-1', THEMESFLAT_LINK . 'assets/js/admin/customizer-repeater-controls.js', array('jquery'), null, true );
    wp_enqueue_script('themesflat-rp-2', THEMESFLAT_LINK . 'assets/js/admin/customizer-repeater2-controls.js', array('jquery'), null, true );
    wp_enqueue_script('themesflat-icon-box', THEMESFLAT_LINK . 'assets/js/admin/customizer-iconbox-repeater.js', array('jquery'), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'themesflat_load_customizer_style' );
add_action( 'admin_enqueue_scripts', 'themesflat_load_customizer_style' ); 

// Load Admin Style
function themesflat_load_admin_style() {
    wp_enqueue_style( 'themesflat-admin', THEMESFLAT_LINK .'assets/css/admin/admin.css', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'themesflat_load_admin_style', 999 );


add_action('pre_get_posts', 'tf_blog_post_per_page');
function tf_blog_post_per_page($query) {
    $posts_per_page = themesflat_get_opt('blog_posts_per_page');
    if (isset($_GET['posts_per_page'])){
		$posts_per_page = sanitize_text_field($_GET['posts_per_page']);
	}
    
    if (!is_admin() && $query->is_main_query() && is_home()) {
        $query->set('posts_per_page',$posts_per_page );
    }
}

// Woocommerce
if ( class_exists( 'woocommerce' )) {
    require_once THEMESFLAT_DIR . 'woocommerce/class-woo/class-woo-hook.php';
    new Woo_Hook();
        
    require_once THEMESFLAT_DIR . 'woocommerce/class-woo/class-cart-checkout-hook.php';
    new TFWC_Cart_Checkout();    

    require_once THEMESFLAT_DIR . 'woocommerce/class-woo/class-single-product-hook.php';
    Woo_Single_Product_Hook::instance();

    require_once THEMESFLAT_DIR . 'woocommerce/class-woo/class-setting-product.php';
    new Woo_Product_Setting();
    
    
    // Display products per page
    add_filter( 'loop_shop_per_page', 'tfwc_products_per_page', 20 );
    function tfwc_products_per_page() {
        if ( ! $items = themesflat_get_opt('shop_products_per_page') ) {
            return 9;
        } else {
            return $items;
        }
    }

    add_action('wp',  'tfwc_save_recently_viewed_product');
    function tfwc_save_recently_viewed_product() {
        if (is_singular('product')) {
            $product_id = get_the_ID();
    
            $recently_viewed = isset($_COOKIE['recently_viewed_products']) ? explode(',', $_COOKIE['recently_viewed_products']) : [];
    
            $recently_viewed = array_diff($recently_viewed, [$product_id]);
    
            array_unshift($recently_viewed, $product_id);
    
            $limit = (int) themesflat_get_opt('recently_limit');
            if ($limit <= 0) {
                $limit = 5;
            }
    
            $recently_viewed = array_slice($recently_viewed, 0, $limit);
    
            setcookie('recently_viewed_products', implode(',', $recently_viewed), time() + 30 * DAY_IN_SECONDS, '/');
    
            $_COOKIE['recently_viewed_products'] = implode(',', $recently_viewed);
        }
    }

}

// Search Woocommerce
add_action( 'pre_get_posts', 'tf_search_product' );

function tf_search_product( $query ) {
  if( ! is_admin() && is_search() && $query->is_main_query() ) {
    $query->set( 'post_type', 'product' );
  }
}

// Load More Ajax Security

function tf_enqueue_script_style() {
    // Localize the script with new data
    $script_data_array = array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'security' => wp_create_nonce( 'load_more_posts' ),
    );
    $user_vars = array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'custom-ajax-nonce' ),
      );
    $search_data_array = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( '_flat_nonce' ),
        'ajax_search'          => intval(1),
        "search_content_type" => "product",
      );
    wp_localize_script( 'themesflat-main', 'ajax_object', $user_vars );
    wp_localize_script( 'themesflat-main', 'blog', $script_data_array );
    wp_localize_script( 'themesflat-main', 'the_ajax_script', $search_data_array );

    $filter_var = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'filter_nonce' => wp_create_nonce('filter-nonce'),		
	);
	wp_localize_script('themesflat-main', 'filter_var', $filter_var);
    // Enqueued script with localized data.
    wp_enqueue_script( 'themesflat-main' ); 
}
  add_action( 'wp_enqueue_scripts', 'tf_enqueue_script_style' );

 
  
function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');

	$blog_layout = themesflat_get_opt('blog_archive_layout');
	
	$imgs = array(
		'blog-grid' => 'themesflat-blog-grid',
		'blog-list' => 'themesflat-blog',
		);
	$class_names = array(
		1 => 'blog-one-column',
		2 => 'blog-two-columns',
		3 => 'blog-three-columns',
		4 => 'blog-four-columns',
		);		

	$themesflat_thumbnail = $imgs[$blog_layout];
	$themesflat_thumbnail = apply_filters('themesflat/template/themesflat_thumbnail',$themesflat_thumbnail);
	$class = array('blog-archive');
	$class[] = 'archive-'.get_post_type();
	$class[] = $blog_layout;

	$class = apply_filters('themesflat/template/blog_class',$class);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap-content-area clearfix">
                    <div id="primary" class="content-area" >
                        <main id="main" class="post-wrap" role="main">
                        <?php if ( have_posts() ) : ?>
                        <div class="wrap-blog-article <?php echo esc_attr(implode(" ",$class));?> has-post-content">
                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php
                                    /* Include the Post-Format-specific template for the content.
                                    * If you want to override this in a child theme, then include a file
                                    * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                    */
                                    get_template_part( 'content', get_post_type() );
                                ?>

                            <?php endwhile; ?>		
                        </div>	
                        <?php else : ?>

                            <?php get_template_part( 'content', 'none' ); ?>

                        <?php endif; ?>
                        </main><!-- #main -->
                        <div class="clearfix">
                        <?php	        
                            get_template_part( 'tpl/pagination' );				
                        ?>
                        </div>
                    </div><!-- #primary -->
                    <?php 
                    if ( themesflat_get_opt( 'sidebar_layout' ) == 'sidebar-left' || themesflat_get_opt( 'sidebar_layout' ) == 'sidebar-right' ) :
                        get_sidebar();
                    endif;
                    ?>
                </div><!-- /.wrap-content-area -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div>
    <?php   
    wp_die();
}
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback'); 



themesflat_remove_hook( 'render_block', 'wp_render_layout_support_flag', 10, 2 );
themesflat_remove_hook( 'render_block', 'gutenberg_render_layout_support_flag', 10, 2 );

add_filter('wpcf7_autop_or_not', '__return_false');

// Redirect single product when search template
add_action( 'template_redirect', 'redirect_to_product_if_single_result' );

function redirect_to_product_if_single_result() {
    if ( is_search() && !is_admin() && isset( $_GET['s'] ) ) {
        $query = new WC_Product_Query( array(
            's'              => sanitize_text_field( $_GET['s'] ),
            'limit'          => 2, 
            'status'         => 'publish',
            'return'         => 'ids',
        ) );

        $products = $query->get_products();

        if ( count( $products ) === 1 ) {
            wp_redirect( get_permalink( $products[0] ) );
            exit;
        }
    }
}

function vemus_theme_setup() {
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'vemus_theme_setup' );

/**
 * Custom Shortcodes for Cart, Wishlist, and Account Icons
 * Use these in Elementor Shortcode widget for custom headers
 */

// Cart Icon Shortcode: [vemus_cart_icon]
function vemus_cart_icon_shortcode( $atts ) {
    if ( ! class_exists( 'woocommerce' ) ) {
        return '';
    }
    
    $atts = shortcode_atts( array(
        'icon_class' => 'icon icon-cart',
        'show_count' => 'yes',
    ), $atts, 'vemus_cart_icon' );
    
    $items_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    $cart_url = wc_get_cart_url();
    $is_cart_checkout = ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() );
    
    ob_start();
    ?>
    <ul class="nav-icon vemus-cart-shortcode">
        <li class="nav-cart">
            <a href="<?php echo esc_url( $cart_url ); ?>"
                data-bs-toggle="<?php echo esc_attr( $is_cart_checkout ? '' : 'offcanvas' ); ?>"
                data-bs-target="#shoppingCart"
                class="nav-icon-item"
            >
                <i class="<?php echo esc_attr( $atts['icon_class'] ); ?>"></i>
                <?php if ( $atts['show_count'] === 'yes' ) : ?>
                    <span class="count-box shopping-cart-items-count"><?php echo esc_html( $items_count ); ?></span>
                <?php endif; ?>
            </a>
        </li>
    </ul>
    <?php
    return ob_get_clean();
}
add_shortcode( 'vemus_cart_icon', 'vemus_cart_icon_shortcode' );

// Wishlist Icon Shortcode: [vemus_wishlist_icon]
function vemus_wishlist_icon_shortcode( $atts ) {
    if ( ! class_exists( 'WCBoost\Wishlist\Helper' ) ) {
        return '';
    }
    
    $atts = shortcode_atts( array(
        'icon_class' => 'icon icon-hearth',
        'show_count' => 'yes',
    ), $atts, 'vemus_wishlist_icon' );
    
    $wishlist = \WCBoost\Wishlist\Helper::get_wishlist();
    $wishlist_count = $wishlist ? intval( $wishlist->count_items() ) : 0;
    $wishlist_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'wishlist' ) : '#';
    
    ob_start();
    ?>
    <ul class="nav-icon vemus-wishlist-shortcode">
        <li class="nav-wishlist">
            <a href="<?php echo esc_url( $wishlist_url ); ?>" class="nav-icon-item wishlist-btn-fragment text-black link">
                <i class="<?php echo esc_attr( $atts['icon_class'] ); ?>"></i>
                <?php if ( $atts['show_count'] === 'yes' ) : ?>
                    <span class="count-box whishlist-items-count"><?php echo esc_html( $wishlist_count ); ?></span>
                <?php endif; ?>
            </a>
        </li>
    </ul>
    <?php
    return ob_get_clean();
}
add_shortcode( 'vemus_wishlist_icon', 'vemus_wishlist_icon_shortcode' );

// Account Icon Shortcode: [vemus_account_icon]
// Opens login modal for guests, offcanvas account panel for logged-in users
function vemus_account_icon_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'icon_class' => 'icon icon-user',
    ), $atts, 'vemus_account_icon' );
    
    // Determine toggle type: modal for guests, offcanvas for logged-in users
    $toggle_type = is_user_logged_in() ? 'offcanvas' : 'modal';
    
    ob_start();
    ?>
    <ul class="nav-icon vemus-account-shortcode">
        <li class="nav-account">
            <a href="#log" 
                data-bs-toggle="<?php echo esc_attr( $toggle_type ); ?>" 
                class="nav-icon-item text-black link"
            >
                <i class="<?php echo esc_attr( $atts['icon_class'] ); ?>"></i>
            </a>
        </li>
    </ul>
    <?php
    return ob_get_clean();
}
add_shortcode( 'vemus_account_icon', 'vemus_account_icon_shortcode' );

// Search Icon Shortcode: [vemus_search_icon]
function vemus_search_icon_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'icon_class' => 'icon icon-search',
    ), $atts, 'vemus_search_icon' );
    
    ob_start();
    ?>
    <ul class="nav-icon vemus-search-shortcode">
        <li class="nav-search">
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#tfsearch" class="nav-icon-item text-black link">
                <i class="<?php echo esc_attr( $atts['icon_class'] ); ?>"></i>
            </a>
        </li>
    </ul>
    <?php
    return ob_get_clean();
}
add_shortcode( 'vemus_search_icon', 'vemus_search_icon_shortcode' );

// Currency Switcher Shortcode: [vemus_currency_switcher]
function vemus_currency_switcher_shortcode( $atts ) {
    // Check if WooDashboard currency converter is available
    if ( ! class_exists( 'WooDashboard\Currency_Converter' ) ) {
        return '';
    }
    
    $atts = shortcode_atts( array(
        'currencies' => 'INR,CAD,USD,EUR,GBP,AUD', // Default currencies to show
    ), $atts, 'vemus_currency_switcher' );
    
    $all_currencies = \WooDashboard\Currency_Converter::get_all_currencies();
    $allowed = array_map( 'trim', explode( ',', strtoupper( $atts['currencies'] ) ) );
    $currencies = array_intersect_key( $all_currencies, array_flip( $allowed ) );
    
    // Get current currency from cookie or default
    $current = isset( $_COOKIE['woodashboard_currency'] ) 
        ? strtoupper( sanitize_text_field( $_COOKIE['woodashboard_currency'] ) )
        : 'INR';
    
    $current_data = $currencies[ $current ] ?? [ 'flag' => '🌍', 'symbol' => $current ];
    
    ob_start();
    ?>
    <div class="vemus-currency-switcher nav-icon">
        <div class="currency-dropdown">
            <button type="button" class="currency-toggle">
                <span class="currency-flag"><?php echo esc_html( $current_data['flag'] ); ?></span>
                <span class="currency-code"><?php echo esc_html( $current ); ?></span>
                <i class="icon icon-arrow-down"></i>
            </button>
            <ul class="currency-menu">
                <?php foreach ( $currencies as $code => $data ) : ?>
                    <li>
                        <a href="#" class="currency-option <?php echo $current === $code ? 'active' : ''; ?>" 
                           data-currency="<?php echo esc_attr( $code ); ?>">
                            <span class="currency-flag"><?php echo esc_html( $data['flag'] ); ?></span>
                            <span class="currency-name"><?php echo esc_html( $code . ' - ' . $data['symbol'] ); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <style>
    .vemus-currency-switcher { position: relative; display: inline-flex; align-items: center; }
    .vemus-currency-switcher .currency-toggle {
        display: flex; align-items: center; gap: 6px;
        background: transparent; border: none; cursor: pointer;
        padding: 8px 12px; font-size: 14px; color: inherit;
    }
    .vemus-currency-switcher .currency-flag { font-size: 18px; }
    .vemus-currency-switcher .currency-code { font-weight: 600; }
    .vemus-currency-switcher .currency-menu {
        display: none; position: absolute; top: 100%; right: 0;
        background: #fff; border: 1px solid #eee; border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.12); min-width: 160px;
        padding: 8px 0; z-index: 9999; list-style: none; margin: 0;
    }
    .vemus-currency-switcher:hover .currency-menu,
    .vemus-currency-switcher .currency-toggle:focus + .currency-menu { display: block; }
    .vemus-currency-switcher .currency-option {
        display: flex; align-items: center; gap: 8px;
        padding: 10px 16px; color: #333; text-decoration: none;
        transition: background 0.2s;
    }
    .vemus-currency-switcher .currency-option:hover { background: #f5f5f5; }
    .vemus-currency-switcher .currency-option.active { background: #FF9F43; color: #fff; }
    </style>
    <script>
    (function() {
        document.querySelectorAll('.currency-option').forEach(function(el) {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                var currency = this.dataset.currency;
                document.cookie = 'woodashboard_currency=' + currency + '; path=/; max-age=2592000';
                location.reload();
            });
        });
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode( 'vemus_currency_switcher', 'vemus_currency_switcher_shortcode' );

