<?php
$logo_style = themesflat_get_opt('logo_style');


$logo_site = !empty(themesflat_get_opt_elementor('site_logo')['url'])
    ? themesflat_get_opt_elementor('site_logo')['url']
    : themesflat_get_opt('site_logo');

$site_logo_sticky = !empty(themesflat_get_opt_elementor('site_logo_sticky')['url'])
    ? themesflat_get_opt_elementor('site_logo_sticky')['url']
    : themesflat_get_opt('site_logo_sticky');

$site_logo_mobile = !empty(themesflat_get_opt_elementor('site_logo_mobile')['url'])
    ? themesflat_get_opt_elementor('site_logo_mobile')['url']
    : themesflat_get_opt('site_logo_mobile');

$logo_text = themesflat_get_opt('logo_text');


if ( $logo_style == 'image' ) : ?>
    <div id="logo" class="logo-header <?php echo esc_attr(!empty($site_logo_mobile) ? 'has-logo-mobile' : ''); ?>" >    
             
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="logo-site"  title="<?php bloginfo('name'); ?>">
            <?php if  (!empty($logo_site)) { ?>
                <img class="site-logo logo logo-default"  src="<?php echo esc_url($logo_site); ?>" alt="<?php bloginfo('name'); ?>"/>
                <img class="site-logo logo logo-sticky"  src="<?php echo esc_url($site_logo_sticky); ?>" alt="<?php bloginfo('name'); ?>"/>
            <?php } ?>
            <?php if  (!empty($site_logo_mobile)) { ?>
                <img class="site-logo logo-mobile"  src="<?php echo esc_url($site_logo_mobile); ?>" alt="<?php bloginfo('name'); ?>"/>
            <?php } ?>
        </a>
    </div>
<?php else : ?>
    <div id="logo" class="logo-header">
    	<h1 class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php if ($logo_text == '') { bloginfo( 'name' ); } else { echo esc_attr($logo_text) ; } ; ?></a></h1>
    </div><!-- /.site-infomation -->          
<?php endif; ?>