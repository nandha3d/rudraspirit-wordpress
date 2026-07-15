<?php 
$information_email = themesflat_get_opt('information_email');
if (!empty($information_email)) { ?>
<ul class="box-action">
    <li>
        <i class="icon-comment"></i>
        <a href="mailto:<?php echo esc_attr($information_email);?>" class="text-caption"><?php echo esc_html($information_email);?></a>
    </li>
</ul>
<?php } ?>