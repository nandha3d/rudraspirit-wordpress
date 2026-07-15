<?php if(themesflat_get_opt('shop_iconbox') == 1) { ?>
<div class="flat-spacing-8 bg-main">
    <div class="container">
        <div class="tf-swiper swiper sw-iconbox vemus-swiper" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="1" data-space-lg="80"
            data-space-md="30" data-space="15" data-pagination="1" data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">
            <div class="swiper-wrapper">
                <?php $icon_boxes = json_decode(themesflat_get_opt('icon_boxes_shop'), true);
                if (!empty($icon_boxes)) :
                    foreach ($icon_boxes as $box) : ?>
                    <div class="swiper-slide">
                        <div class="box_icon--V01 style-white">
                            <span class="icon">
                            <?php echo empty($box['icon']) ? '' : $box['icon'] ; ?>
                            </span>
                            <div class="content">
                                <h4 class="title"><?php echo esc_html($box['title']); ?></h4>
                                <p class="text"><?php echo esc_html($box['description']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;
                endif;
                ?>
            </div>
            <div class="sw-dot-default style-white tf-sw-pagination"></div>
        </div>
    </div>
</div>
<?php } ?>
