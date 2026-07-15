<?php 
$information_address = themesflat_get_opt('information_address');
if (!empty($information_address)): ?>
<ul class="box-action">
    <li>
        <i class="icon-location"></i>
        <span href="#register" class="text-caption"><?php echo esc_html($information_address);?></span>
    </li>
</ul>
<?php endif; ?> 