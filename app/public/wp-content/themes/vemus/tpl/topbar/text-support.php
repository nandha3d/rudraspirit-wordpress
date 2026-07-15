<?php 
$information_heading = themesflat_get_opt('information_heading');
$information_phone = themesflat_get_opt('information_phone');
?>

<div class="box-suport">
    <?php if (!empty($information_heading)) { ?>
        <p class="text-caption fw-medium">
            <i class="icon-headphone-2"></i>
                <span><?php echo esc_html($information_heading);?></span>
                <span>-</span>
        </p>
    <?php } ?>
    <?php if (!empty($information_phone)) { ?>
        <a href="tel:<?php echo esc_attr($information_phone);?>" class="text-caption fw-medium link"><?php echo esc_html($information_phone);?></a>
    <?php } ?>
</div>