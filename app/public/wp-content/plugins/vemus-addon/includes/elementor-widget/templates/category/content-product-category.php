<?php
    if( empty($category['name']) ){
        return;
    }
    $image_style="aspect-ratio: $aspect_ratio !important;";
    $icon = !empty($button_icon['value']) ? $button_icon['value'] : "";
    if( !empty( $has_carousel ) ){
        $box_classes.=' swiper-slide';
    }
    $item_text = $category['count'] == 1 ? 'item' : 'items';
    
    if(empty($style)){
        $style = 'style-01';
    }
    
?>
<div class="<?php echo $box_classes; ?>">
    <a href="<?php echo esc_url($category['url']); ?>" class="hover-img image-box">
        <div class="image img-style" style="<?php echo esc_html($image_style); ?>">
            <img data-src="<?php echo esc_url($category['image']); ?>" alt="<?php echo esc_html($category['name']); ?>" class="lazyload">
        </div>
        <h5 class="name-cls link">
            <?php echo esc_html($category['name']); ?>
            <?php if(!empty($number_count)) : ?>
                <span class="count text-caption">
                    <?php echo esc_html($category['count']); ?>
                </span>
            <?php endif; ?>
        </h5>
        <a href="<?php echo esc_url($category['url']); ?>" class="cat-link link btn-cls text-xs">
            <span>
                <?php esc_html_e( 'style-02' == $style ? $category['name'] : ($button_text) ); ?>
            </span>
            <?php if (!empty($icon['url'])) : ?>
                <img src="<?php echo esc_attr($icon['url']); ?>" alt="Icon" class="icon" />
            <?php elseif(!empty($icon)) : ?>
                <i class="icon <?php echo esc_attr($icon); ?>"></i>
            <?php endif; ?>
        </a>
    </a>
</div>
