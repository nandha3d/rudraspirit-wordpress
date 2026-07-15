<?php 
$topbar_label_text = themesflat_get_opt('topbar_label_text');
if (themesflat_get_opt_elementor('topbar_label_text') != '') {
    $topbar_label_text = themesflat_get_opt_elementor('topbar_label_text');
}
?>

<div class="countdown-V01 text-xs">
    <?php if (!empty($topbar_label_text)) { ?>
        <span><?php echo esc_html($topbar_label_text); ?></span>
    <?php } ?>
    <div class="count-down">
        <div class="js-countdown" data-timer="<?php echo esc_attr( vemus_get_countdown_seconds() ); ?>" data-labels="d : ,h : ,m : , s">
        </div>
    </div>
</div>