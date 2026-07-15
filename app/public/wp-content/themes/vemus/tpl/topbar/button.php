<?php 
$topbar_button_text = themesflat_get_opt('topbar_button_text');
if (themesflat_get_opt_elementor('topbar_button_text') != '') {
    $topbar_button_text = themesflat_get_opt_elementor('topbar_button_text');
}

$topbar_button_url = themesflat_get_opt('topbar_button_url');
if (themesflat_get_opt_elementor('topbar_button_url') != '') {
    $topbar_button_url = themesflat_get_opt_elementor('topbar_button_url');
}
?>
<div class="countdown-V01 text-xs">
    <a href="<?php echo esc_attr($topbar_button_url);?>" class="tf-btn-line lh-20"><span class="text-xs"><?php echo esc_html($topbar_button_text);?></span></a>
</div>