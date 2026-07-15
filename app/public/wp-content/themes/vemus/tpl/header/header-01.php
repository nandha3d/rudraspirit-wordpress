<?php 
$header_search_box = themesflat_get_opt('header_search_box');
if (themesflat_get_opt_elementor('header_search_box') != '') {
    $header_search_box = themesflat_get_opt_elementor('header_search_box');
}

$header_cart_icon = themesflat_get_opt('header_cart_icon');
if (themesflat_get_opt_elementor('header_cart_icon') != '') {
    $header_cart_icon = themesflat_get_opt_elementor('header_cart_icon');
}

$header_wishlist_icon = themesflat_get_opt('header_wishlist_icon');
if (themesflat_get_opt_elementor('header_wishlist_icon') != '') {
    $header_wishlist_icon = themesflat_get_opt_elementor('header_wishlist_icon');
}

$header_login = themesflat_get_opt('header_login');
if (themesflat_get_opt_elementor('header_login') != '') {
    $header_login = themesflat_get_opt_elementor('header_login');
}

$language_header = themesflat_get_opt('language_header');
if (themesflat_get_opt_elementor('language_header') != '') {
    $language_header = themesflat_get_opt_elementor('language_header');
}


$currency_header = themesflat_get_opt('currency_header');
if (themesflat_get_opt_elementor('currency_header') != '') {
    $currency_header = themesflat_get_opt_elementor('currency_header');
}

?>
<?php get_template_part( 'tpl/topbar'); ?>

<header id="header" class="tf-header style-2 header-absolute header-01 <?php echo themesflat_get_opt_elementor('extra_classes_header'); ?>">
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 col-3 d-xl-none">
                    <a href="#mobileMenu" class="btn-mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                        <span></span>
                    </a>
                </div>
                <div class="col-xl-3 d-none d-xl-block">
                    <div class="header-right">

                    <?php if ( $currency_header == 1 ): ?>
                        <?php 
                        if ( class_exists('woocs') ) {
                            global $WOOCS;

                            if ( ! isset( $WOOCS ) ) {
                                return;
                            }
                            $currencies = $WOOCS->get_currencies();
                            ?>

                            <div class="tf-currencies">
                                <select id="custom-currency-switcher" class="tf-dropdown-select style-default type-currencies setting-curreny-language">
                                    <?php foreach ( $currencies as $code => $currency ): ?>
                                        <?php
                                            $flag_url = $currency['flag'];
                                        ?>
                                        <option 
                                            value="<?php echo esc_attr($code); ?>" 
                                            data-thumbnail="<?php echo esc_url($flag_url); ?>" 
                                            <?php echo esc_attr(($WOOCS->current_currency === $code) ? 'selected' : ''); ?>
                                        >
                                            <?php echo esc_html($currency['description']) . ' (' . esc_html($code) . ' ' . esc_html($currency['symbol']) . ')'; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php } else { ?>
                            <div class="tf-currencies ">
                                <select class="tf-dropdown-select style-default type-currencies setting-curreny-language">
                                    <option value="USD" selected>United States (USD $)
                                    </option>
                                    <option value="EUR">France (EUR €)</option>
                                    <option value="EUR">Germany (EUR €)</option>
                                    <option value="VND">Vietnam (VND ₫)</option>
                                </select>
                            </div>
                    <?php } endif; ?> 

                        <?php if ( $language_header == 1 ): ?>                       
                            <?php
                            if ( class_exists('woocommerce_wpml') ) {
                                $languages = apply_filters( 'wpml_active_languages', NULL, array(
                                    'skip_missing' => 0,
                                    'link_empty_to' => '',
                                    'orderby' => 'code',
                                    'order' => 'asc',
                                ) );
                                ?>

                                <div class="tf-languages ">
                                    <select class="tf-dropdown-select style-default type-languages setting-curreny-language" id="custom-language-switcher">
                                        <?php if ( ! empty( $languages ) ) : ?>
                                            <?php foreach ( $languages as $lang ): ?>
                                                <option 
                                                    value="<?php echo esc_url( $lang['url'] ); ?>" 
                                                    data-thumbnail="<?php echo esc_url( $lang['country_flag_url'] ); ?>"
                                                    <?php echo esc_attr($lang['active'] ? 'selected' : ''); ?>
                                                >
                                                    <?php echo esc_html( $lang['translated_name'] ); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <div class="tf-languages ">
                                    <select class="tf-dropdown-select style-default type-languages setting-curreny-language">
                                        <option>English</option>
                                        <option>العربية</option>
                                        <option>简体中文</option>
                                        <option>اردو</option>
                                    </select>
                                </div>
                        <?php } endif; ?>               

                    </div> 
                </div>
                <div class="col-xl-6 col-md-4 col-6">
                    <div class="justify-content-center w-100 d-flex">
                        <?php get_template_part( 'tpl/header/brand'); ?>        
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-3">
                    <ul class="nav-icon">
                        <?php if ( $header_search_box == 1 ) :?>
                            <li class="nav-search">
                                <a href="#"  data-bs-toggle="offcanvas" data-bs-target="#tfsearch" class="nav-icon-item text-black link">
                                    <i class="icon icon-search"></i>
                                </a>
                            </li>
                            <li class="br-line d-xl-flex"></li>
                        <?php endif;?>
                        
                    <?php if ( $header_login == 1 ) :?>
                        <li class="nav-account d-md-inline-flex">
                            <a href="#log" 
                            data-bs-toggle="<?php echo is_user_logged_in() ? 'offcanvas' : 'modal'; ?>" 
                            class="nav-icon-item text-black link">
                                <i class="icon icon-user"></i>
                            </a>
                        </li>
                    <?php endif; ?>

                        <?php if ( $header_wishlist_icon == 1 ) :?>
                            <?php get_template_part( 'tpl/header/header-wishlist'); ?>
                        <?php endif;?>

                        <?php if ( $header_cart_icon == 1 ) :?>
                            <?php get_template_part( 'tpl/header/header-cart'); ?>
                        <?php endif;?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom d-none d-xl-block">
         <div class="container">
            <div class="box-navigation">
                <?php get_template_part( 'tpl/header/navigator'); ?>  
            </div>
         </div>                   
    </div>                       

</header>

<?php get_template_part( 'tpl/header/menu-mobile'); ?>
