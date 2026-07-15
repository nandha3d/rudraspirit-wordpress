<?php
$header_login = themesflat_get_opt('header_mb_login');
if (themesflat_get_opt_elementor('header_mb_login') != '') {
    $header_login = themesflat_get_opt_elementor('header_mb_login');
}

$header_wishlist_icon = themesflat_get_opt('header_mb_wishlist');
if (themesflat_get_opt_elementor('header_mb_wishlist') != '') {
    $header_wishlist_icon = themesflat_get_opt_elementor('header_mb_wishlist');
}

$header_mb_language = themesflat_get_opt('header_mb_language');
$header_mb_currency = themesflat_get_opt('header_mb_currency');

$show_topbar_mobile_language = 1;
$show_topbar_mobile_currency = 1;

 $class_mb_language =  $class_mb_currency =  '';

if (  $show_topbar_mobile_language != 1 ) {
    $class_mb_language = 'd-none';
}

if (  $show_topbar_mobile_currency != 1) {
    $class_mb_currency = 'd-none';
}


?>
<div class="offcanvas offcanvas-start canvas-mb <?php if ( is_user_logged_in() && is_admin_bar_showing() ) { echo 'is-admin';} ?>" id="mobileMenu">
        <span class="icon-close-popup" data-bs-dismiss="offcanvas">
            <i class="icon-close"></i>
        </span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <div class="mb-content-top">
                    <nav class="nav-ul-mb" id="wrapper-menu-navigation" class="" role="navigation">
                        <?php
                            wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'nav-ul-mb' , 'fallback_cb' => 'themesflat_menu_fallback', 'container' => false ) );
                        ?>
                    </nav>                                    
                </div>
                <div class="mb-other-content">
                    <div class="group-icon">
                        <?php
                        if ( $header_wishlist_icon == 1 ) :
                        if ( class_exists( 'WCBoost\Wishlist\Helper' ) ) { ;
                            ?>

                            <a href="<?php echo esc_url( wc_get_page_permalink( 'wishlist' ) ); ?>" class="site-nav-icon">
                            <i class="icon icon-heart"></i>
                            <?php echo esc_html__('Wishlist','vemus');?>
                        </a>
                        
                        <?php  } endif; ?>
                        
                        <?php if ( $header_login == 1 ) :
                                if (is_user_logged_in()) {
                                    $modal_type = 'offcanvas';
                                } else {
                                    $modal_type = 'modal';
                                }
                            ?>
                            <a href="#log" data-bs-toggle="<?php echo esc_attr($modal_type); ?>" class="site-nav-icon mobile-off-<?php echo esc_attr($modal_type); ?>">
                                <i class="icon icon-user"></i>
                                <?php echo esc_html__('Login','vemus');?>                            
                            </a>
                        <?php endif; ?>
                        
                    </div>
                    <div class="mb-notice">
                        <a href="#" class="text-need"><?php echo esc_html(themesflat_get_opt('header_mb_heading'));?> </a>
                    </div>
                    <div class="mb-contact">
                        <p><?php echo esc_html(themesflat_get_opt('header_address_label')) . esc_html(themesflat_get_opt('header_address'));?></p>
                    </div>
                    <ul class="mb-info">
                        <li>
                            <?php echo esc_html(themesflat_get_opt('header_email_label'));?>
                            <b class="fw-medium"><?php echo esc_html(themesflat_get_opt('header_email'));?></b>
                        </li>
                        <li>
                            <?php echo esc_html(themesflat_get_opt('header_phone_label'));?>
                            <b class="fw-medium"><?php echo esc_html(themesflat_get_opt('header_phone'));?></b>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if ( $header_mb_language == 1 || $header_mb_currency == 1 ) :?>
            <div class="mb-bottom">
                <div class="bottom-bar-language">
                    <?php if ( $header_mb_currency == 1 ): ?>
                        <?php 
                        if ( class_exists('woocs') ) {
                            global $WOOCS;

                            if ( ! isset( $WOOCS ) ) {
                                return;
                            }
                            $currencies = $WOOCS->get_currencies();
                            ?>

                            <div class="tf-currencies <?php echo esc_attr($class_mb_currency); ?>">
                                <select id="custom-currency-switcher" class="dropdown bootstrap-select tf-dropdown-select style-default type-currencies setting-curreny-language dropup">
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
                            <div class="tf-currencies <?php echo esc_attr($class_mb_currency); ?>">
                                <select class="dropdown bootstrap-select tf-dropdown-select style-default type-currencies setting-curreny-language dropup">
                                    <option value="USD" selected>United States (USD $)
                                    </option>
                                    <option value="EUR">France (EUR €)</option>
                                    <option value="EUR">Germany (EUR €)</option>
                                    <option value="VND">Vietnam (VND ₫)</option>
                                </select>
                            </div>
                    <?php } endif; ?> 
                    <?php if ( $header_mb_language == 1 ): ?>                       
                        <?php
                        if ( class_exists('woocommerce_wpml') ) {
                            $languages = apply_filters( 'wpml_active_languages', NULL, array(
                                'skip_missing' => 0,
                                'link_empty_to' => '',
                                'orderby' => 'code',
                                'order' => 'asc',
                            ) );
                            ?>

                            <div class="tf-languages <?php echo esc_attr($class_mb_language); ?>">
                                <select class="dropdown bootstrap-select tf-dropdown-select setting-curreny-language style-default type-languages dropup" id="custom-language-switcher">
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
                            <div class="tf-languages <?php echo esc_attr($class_mb_language); ?>">
                                <select class="dropdown bootstrap-select tf-dropdown-select setting-curreny-language style-default type-languages dropup">
                                    <option>English</option>
                                    <option>العربية</option>
                                    <option>简体中文</option>
                                    <option>اردو</option>
                                </select>
                            </div>
                    <?php } endif; ?> 
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>