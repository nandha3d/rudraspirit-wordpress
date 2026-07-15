<?php 

$topbar = themesflat_get_opt('topbar_show');
if (themesflat_get_opt_elementor('topbar_show') != '') {
    $topbar = themesflat_get_opt_elementor('topbar_show');
}

$show_announcement = themesflat_get_opt('show_announcement');
if (themesflat_get_opt_elementor('show_announcement') != '') {
    $show_announcement = themesflat_get_opt_elementor('show_announcement');
}

$announcement_topbar_style = themesflat_get_opt('announcement_topbar_style');
if (themesflat_get_opt_elementor('announcement_topbar_style') != '') {
    $announcement_topbar_style = themesflat_get_opt_elementor('announcement_topbar_style');
}

$show_topbar_mobile = themesflat_get_opt('show_topbar_mobile');
$show_topbar_mobile_social = themesflat_get_opt('show_topbar_mobile_social');
$show_topbar_mobile_language = themesflat_get_opt('show_topbar_mobile_language');
$show_topbar_mobile_currency = themesflat_get_opt('show_topbar_mobile_currency');
$show_topbar_mobile_marquee = themesflat_get_opt('show_topbar_mobile_marquee');
$topbar_swiper_fields = themesflat_get_opt('topbar_swiper_fields');
$topbar_swiper_json = json_decode($topbar_swiper_fields, true);
$topbar_marquee_arr = themesflat_get_opt('topbar_marquee_arr');
$topbar_marquee_json = json_decode($topbar_marquee_arr, true);
$class_mb = $class_mb_social =  $class_mb_language =  $class_mb_currency = $class_mb_marquee =  '';
if ( $show_topbar_mobile != 1) {
    $class_mb = 'd-none';
}

if ( $show_topbar_mobile_social != 1 ) {
    $class_mb_social = 'd-none';
}

if (  $show_topbar_mobile_language != 1 ) {
    $class_mb_language = 'd-none';
}

if (  $show_topbar_mobile_currency != 1) {
    $class_mb_currency = 'd-none';
}

if (  $show_topbar_mobile_marquee != 1) {
    $class_mb_marquee = 'd-none';
}

$information_heading = themesflat_get_opt('information_heading');
$information_phone = themesflat_get_opt('information_phone');
$information_address = themesflat_get_opt('information_address');
$information_email = themesflat_get_opt('information_email');

$topbar_button_text = themesflat_get_opt('topbar_button_text');
if (themesflat_get_opt_elementor('topbar_button_text') != '') {
    $topbar_button_text = themesflat_get_opt_elementor('topbar_button_text');
}

$topbar_button_url = themesflat_get_opt('topbar_button_url');
if (themesflat_get_opt_elementor('topbar_button_url') != '') {
    $topbar_button_url = themesflat_get_opt_elementor('topbar_button_url');
}


$topbar_items_left = themesflat_get_opt('topbar_items_left');
$topbar_items_left_json = json_decode($topbar_items_left, true);
if (themesflat_get_opt_elementor('topbar_items_left') != '') {
    $topbar_items_left = themesflat_get_opt_elementor('topbar_items_left');
    $topbar_items_left_json = $topbar_items_left;
}

$topbar_items_center = themesflat_get_opt('topbar_items_center');
$topbar_items_center_json = json_decode($topbar_items_center, true);
if (themesflat_get_opt_elementor('topbar_items_center') != '') {
    $topbar_items_center = themesflat_get_opt_elementor('topbar_items_center');
    $topbar_items_center_json = $topbar_items_center;
}

$topbar_items_right = themesflat_get_opt('topbar_items_right');
$topbar_items_right_json = json_decode($topbar_items_right, true);
if (themesflat_get_opt_elementor('topbar_items_right') != '') {
    $topbar_items_right = themesflat_get_opt_elementor('topbar_items_right');
    $topbar_items_right_json = $topbar_items_right;
}

$topbar_fullwidth = themesflat_get_opt('topbar_fullwidth');
if (themesflat_get_opt_elementor('topbar_fullwidth') != '') {
    $topbar_fullwidth = themesflat_get_opt_elementor('topbar_fullwidth');
}

?>
<?php if ( $show_announcement == 1 ) { ?>

<?php if ( $announcement_topbar_style == 'style-marquee' ) { ?>
<div class="tf-topbar bg-main px-0 tf-announcement">
    <div class="new-marquee topbar-inner type-sp-2">
        <?php if ( ! empty( $topbar_marquee_json ) ) : ?>
            <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                <div class="box-item">
                    <?php foreach ( $topbar_marquee_json as $value ) : ?>
                        <div class="infiniteItem">
                            <p class="text-white text-caption-3 text-uppercase fw-medium">
                                <?php echo esc_html( $value['text'] ); ?>
                            </p>
                        </div>
                        <span class="br-line w-24 bg-white"></span>
                    <?php endforeach; ?>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
</div>
<?php } ?>
<?php if ( $announcement_topbar_style == 'style-slider' ) { ?>
    <div class="tf-topbar tf-announcement bg-dark-5 topbar-bg bg-olive-brown <?php echo esc_attr($class_mb); ?> <?php echo themesflat_get_opt_elementor('extra_classes_topbar'); ?>">
            <div class="container">
                <div class="topbar-inner">
                    <div dir="ltr" class="swiper vemus-swiper tf-swiper" data-loop="true" data-auto="true" data-delay="3000" data-speed="1000" data-space="10" data-direction="vertical">
                        <div class="swiper-wrapper">
                            <?php
                                if (!empty($topbar_swiper_json)) {
                                foreach ($topbar_swiper_json as $field) {
                            ?>
                                <!-- item 1 -->
                                <div class="swiper-slide">
                                    <div class="has-btn">
                                        <p class="text-caption-3 fw-medium text-white text-anu-slider">
                                        <?php echo esc_html( empty($field['text']) ? '' : $field['text'] ); ?>
                                        </p>
                                            <span class="br-line border-anu-slider"></span>
                                            <a href="<?php echo esc_attr( empty($field['link']) ? '' : $field['link'] ); ?>" class="text-caption-3 fw-medium decor-bottom text-white text-uppercase lh-19 button-anu-slider">
                                                <?php echo esc_html( empty($field['btn_text']) ? '' : $field['btn_text'] ); ?>
                                                <i class="icon-arrow-top-right-2 fs-10"></i>
                                            </a>
                                    </div>
                                </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php } ?>

<?php } ?>

<?php if ( $topbar == 1 ): ?>

    <?php if (!empty($topbar_items_left_json) || !empty($topbar_items_center_json) || !empty($topbar_items_right_json)): ?>
    <!-- Top Bar-->
        <div class="tf-topbar p-0 style-2 tf-main-topbar">
            <div class="topbar-botom">
                <div class="<?php echo esc_attr($topbar_fullwidth == 1 ? 'container-2' : 'container'); ?>">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div class="tf-wrap-topbar-left">
                                <?php 
                                    if (!empty($topbar_items_left_json) && is_array($topbar_items_left_json)) {
                                        foreach ($topbar_items_left_json as $item) {
                                            switch ($item) {
                                                case 'currency':
                                                    get_template_part('tpl/topbar/currency');
                                                    break;
                                                case 'language':
                                                    get_template_part('tpl/topbar/language');
                                                    break;
                                                case 'address':
                                                    get_template_part('tpl/topbar/address');
                                                    break;
                                                case 'button':
                                                    get_template_part('tpl/topbar/button');
                                                    break;
                                                case 'phone':
                                                    get_template_part('tpl/topbar/phone');
                                                    break;
                                                case 'email':
                                                    get_template_part('tpl/topbar/email');
                                                    break;
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="tf-wrap-topbar-center">
                                <?php 
                                    if (!empty($topbar_items_center_json) && is_array($topbar_items_center_json)) {
                                        foreach ($topbar_items_center_json as $item) {
                                            switch ($item) {
                                                case 'address':
                                                    get_template_part('tpl/topbar/address');
                                                    break;
                                                case 'button':
                                                    get_template_part('tpl/topbar/button');
                                                    break;
                                                case 'phone':
                                                    get_template_part('tpl/topbar/phone');
                                                    break;
                                                case 'text-countdown':
                                                    get_template_part('tpl/topbar/text-countdown');
                                                    break;
                                                case 'text-support':
                                                    get_template_part('tpl/topbar/text-support');
                                                    break;
                                                case 'email':
                                                    get_template_part('tpl/topbar/email');
                                                    break;
                                            }
                                        }
                                    }
                                ?>
                            </div>


                        </div>
                        <div class="col-3">

                            <div class="tf-wrap-topbar-right">
                                <?php 
                                    if (!empty($topbar_items_right_json) && is_array($topbar_items_right_json)) {
                                        foreach ($topbar_items_right_json as $item) {
                                            switch ($item) {
                                                case 'currency':
                                                    get_template_part('tpl/topbar/currency');
                                                    break;
                                                case 'language':
                                                    get_template_part('tpl/topbar/language');
                                                    break;
                                                case 'address':
                                                    get_template_part('tpl/topbar/address');
                                                    break;
                                                case 'button':
                                                    get_template_part('tpl/topbar/button');
                                                    break;
                                                case 'phone':
                                                    get_template_part('tpl/topbar/phone');
                                                    break;
                                                case 'email':
                                                    get_template_part('tpl/topbar/email');
                                                    break;
                                            }
                                        }
                                    }
                                ?> 
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /Top Bar -->

<?php endif; ?>
<?php endif; ?>