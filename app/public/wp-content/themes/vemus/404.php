<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package vemus
 */

get_header(); ?>

<div class="wg-404 tf-grid-layout sm-col-2 gap-0 vh-100">	
    <div class="image">
        <?php 
        $banner_404 = themesflat_get_opt('banner_404');
        if ( !empty($banner_404) ) : ?>
            <img src="<?php echo esc_url($banner_404); ?>" alt="404">
        <?php endif; ?>
    </div>

    <div class="content">
        <?php 
        $heading_404 = themesflat_get_opt('page_404_heading');
        if ( !empty($heading_404) ) : ?>
            <h1 class="heading"><?php echo wp_kses_post($heading_404); ?></h1>
        <?php endif; ?>

        <?php 
        $desc_404 = themesflat_get_opt('page_404_desc');
        if ( !empty($desc_404) ) : ?>
            <p class="sub-head"><?php echo wp_kses_post($desc_404); ?></p>
        <?php endif; ?>

        <?php 
        $btn_text_404 = themesflat_get_opt('text_button_404');
        if ( !empty($btn_text_404) ) : ?>
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="tf-btn btn-fill fw-medium animate-btn">
                <?php echo wp_kses_post($btn_text_404); ?>
            </a>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>