<?php 
$information_phone = themesflat_get_opt('information_phone');
if (!empty($information_phone)) { ?>
<ul class="box-action">
    <li>
        <i class="icon-phone"></i>
        <a href="tel:<?php echo esc_attr($information_phone);?>" class="text-caption"><?php echo esc_html($information_phone);?></a>
    </li>
</ul>
<?php } ?>