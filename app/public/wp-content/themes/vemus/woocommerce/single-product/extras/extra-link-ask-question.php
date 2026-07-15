<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(themesflat_get_opt('tf_product_ask_question_tab')){

    $tabs_position = empty ($_GET['product_tabs_pos']) ? themesflat_get_opt('tf_product_tabs_position') : $_GET['product_tabs_pos'];

    $ask_question_title = themesflat_get_opt('tf_product_ask_question_title');
    $ask_question_content = themesflat_get_opt('tf_product_ask_question_content');
}else{
    return;
}

?>

<?php if( $tabs_position == "default" ): ?>
    <div>
        <span class="h6">
            <?php echo do_shortcode($ask_question_content); ?>
        </span>
    </div>
<?php else : ?>

    <div class="offcanvas offcanvas-end canvas-sidebar canvas-ask-question" id="vemus-ask-question" aria-modal="true" role="dialog">
        <div class="canvas-header align-items-start">
            <h3 class="title fw-normal text-uppercase">
                <?php echo esc_html($ask_question_title); ?>
            </h3>
            <span class="icon-close link icon-close-popup p-0" data-bs-dismiss="offcanvas"></span>
        </div>
        <div class="canvas-body">
            <?php echo do_shortcode($ask_question_content); ?>
        </div>
    </div>

<?php endif; ?>