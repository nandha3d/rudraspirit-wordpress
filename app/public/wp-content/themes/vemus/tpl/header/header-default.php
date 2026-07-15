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

$header_login = themesflat_get_opt('header_login');
if (themesflat_get_opt_elementor('header_login') != '') {
    $header_login = themesflat_get_opt_elementor('header_login');
}

?>
<?php get_template_part( 'tpl/topbar'); ?>

<header id="header" class="header-default tf-header <?php echo themesflat_get_opt_elementor('extra_classes_header'); ?>">
    <div class="container">
        <div class="row wrapper-header align-items-center">
            <div class="col-md-4 col-3 d-xl-none">
                <a href="#mobileMenu" class="btn-mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                    <span></span>
                </a>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <?php get_template_part( 'tpl/header/brand'); ?>                
            </div>
            <div class="col-xl-8 d-none d-xl-block">
                <?php get_template_part( 'tpl/header/navigator'); ?>
            </div>
            <div class="col-xl-2 col-md-4 col-3">
                <ul class="nav-icon">
                    <?php if ( $header_search_box == 1 ) :?>
                        <li class="nav-search d-inline-flex">
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
</header>

<?php get_template_part( 'tpl/header/menu-mobile'); ?>


