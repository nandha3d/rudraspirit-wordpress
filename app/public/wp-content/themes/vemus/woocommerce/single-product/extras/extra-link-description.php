<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(themesflat_get_opt('extra_link_description')){
    $description_title = themesflat_get_opt('extra_link_description_title');
}else{
    return;
}
?>

<div class="offcanvas offcanvas-end canvas-sidebar canvas-description" id="vemus-description" aria-modal="true" role="dialog">
    <div class="canvas-header align-items-start">
        <h3 class="title fw-normal text-uppercase">
            <?php echo esc_html($description_title); ?>
        </h3>
        <span class="icon-close link icon-close-popup p-0" data-bs-dismiss="offcanvas"></span>
    </div>
    <div class="canvas-body">
        <?php the_content(); ?>
    </div>       
</div>