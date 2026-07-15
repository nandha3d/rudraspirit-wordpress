<?php
    if( !themesflat_get_opt('image_box_product2')){
        return;
    }
    $text = themesflat_get_opt('image_box_product_text2');
    $sub_text = themesflat_get_opt('image_box_product_subtext2');
    $btn_text = themesflat_get_opt('image_box_product_btn_text2');
    $btn_url = themesflat_get_opt('image_box_product_btn_url2');
    $image = themesflat_get_opt('image_box_product_url2');
?>

<div class="loadItem tempo wd-2-cols vemus-box-image-end box_image--V02 style-2 hover-img">
    <a href="<?php echo esc_attr($btn_url); ?>" class="box_image-image img-style">
        <img src="<?php echo esc_url($image); ?>" data-src="<?php echo esc_url($image); ?>" alt="" class="lazyload">
    </a>
    <div class="box_image-content type-left">
        <div class="heading">
            <p class="fw-medium text-white text-uppercase">
                <?php echo empty($sub_text) ? '' : $sub_text ?>
            </p>
            <a href="<?php echo esc_attr($btn_url); ?>" class="title h2 fw-normal font-2 text-white link link-secondary">
                <?php echo empty($text) ? '' : $text ?>
            </a>
        </div>
        <a href="<?php echo esc_attr($btn_url); ?>" class="tf-btn style-3 btn-fill-white animate-btn animate-dark">
            <span class="fw-medium text-uppercase">
                <?php echo esc_html($btn_text); ?>
            </span>
        </a>
    </div>
</div>