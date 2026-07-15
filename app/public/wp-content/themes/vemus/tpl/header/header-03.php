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

<header id="header" class="tf-header header-absolute-2 type-2  <?php echo themesflat_get_opt_elementor('extra_classes_header'); ?>">

        <div class="container-2">
            <div class="row align-items-center">
                <div class="col-md-4 col-3 d-xl-none">
                    <a href="#mobileMenu" data-bs-toggle="offcanvas" class="btn-mobile-menu">
                        <span></span>
                    </a>
                </div>
                <div class="col-xxl-5 col-xl-6 d-none d-xl-block">
                    <div class="box-navigation">
                        <?php get_template_part( 'tpl/header/navigator'); ?>  
                    </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-md-4 col-6">                
                    <div class="justify-content-center w-100 d-flex">
                        <?php get_template_part( 'tpl/header/brand'); ?>        
                    </div>        
                </div>
                <div class="col-xxl-5 col-xl-4 col-md-4 col-3">
                    <div class="header-right justify-content-end align-items-center">
                        <?php if ( $header_search_box == 1 ) :?>
                            <div class="tf-form-search">
                                <form class="form-search style-radius style-white d-none d-xl-block">
                                    <fieldset>
                                        <input type="text" class="ajax-search-input-header bg-transparent" placeholder="Search product" tabindex="0" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <button type="submit" class="btn-search link"><i class="icon icon-search"></i></button>
                                </form>
                                <div class="search-suggests-results">
                                    <div class="search-suggests-results-inner">
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                        <ul class="nav-icon">
                        <?php if ( $header_search_box == 1 ) :?>
                            <li class="d-inline-flex type-2-search">
                                <a href="#"  data-bs-toggle="offcanvas" data-bs-target="#tfsearch" class="nav-icon-item text-black link">
                                    <i class="icon icon-search"></i>
                                </a>
                            </li>
                        <?php endif;?>
                    <?php if ( $header_login == 1 ) :?>
                        <li class="nav-account d-none d-md-inline-flex">
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

</header>

<?php get_template_part( 'tpl/header/menu-mobile'); ?>
