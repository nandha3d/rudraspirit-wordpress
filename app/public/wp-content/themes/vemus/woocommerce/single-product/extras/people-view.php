<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(themesflat_get_opt('fake_view')){
    $random_from = max(1, themesflat_get_opt('fake_view_random_from'));
    $random_to = max(1, themesflat_get_opt('fake_view_random_to'));
    $interval = max(1000, themesflat_get_opt('fake_view_interval'));
    $text = themesflat_get_opt('fake_view_text');
    $view_count = rand($random_from, $random_to);

    wp_localize_script(
        'themesflat-single-product', 'peopleViewData',
        [
            'randomFrom' => $random_from,
            'randomTo' => $random_to,
            'interval' => $interval,
        ]
    );

}else{
    return;
}

?>
<div class="product-info-view">
    <span class="icon-view"></span>
    <span class="text-dark">
        <span class="view-count">
            <?php echo esc_html($view_count); ?>
        </span>
        <?php echo esc_html($text); ?>
    </span>
</div>