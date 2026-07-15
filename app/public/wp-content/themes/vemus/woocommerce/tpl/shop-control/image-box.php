<?php
    if( !themesflat_get_opt('image_box_product')){
        return;
    }
    $text = themesflat_get_opt('image_box_product_text');
    $btn_text = themesflat_get_opt('image_box_product_btn_text');
    $btn_url = themesflat_get_opt('image_box_product_btn_url');
    $image = themesflat_get_opt('image_box_product_url');
?>

<div class="loadItem tempo box_image--V02 hover-img">
    <a href="<?php echo esc_attr($btn_url); ?>" class="box_image-image img-style">
        <img src="<?php echo esc_url($image); ?>" data-src="<?php echo esc_url($image); ?>" alt="" class="ls-is-cache lazyload">
    </a>
    <div class="box_image-content align-items-center text-center">
        <a href="#" class="title h3 fw-normal font-2 text-white link-secondary">
            <?php echo empty($text) ? '' : $text ?>
        </a>
        <a href="<?php echo esc_attr($btn_url); ?>" class="tf-btn style-3 btn-fill-white animate-btn animate-dark">
            <span class="fw-medium text-uppercase">
                <?php echo esc_html($btn_text); ?>
            </span>
        </a>
    </div>
</div>