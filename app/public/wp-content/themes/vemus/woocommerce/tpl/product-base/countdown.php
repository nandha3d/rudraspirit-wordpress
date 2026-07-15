<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wp_enqueue_script('themesflat-countdown');
global $product;
$end_time = $product->get_date_on_sale_to();
if( !empty($end_time) ){
    $current_time = new DateTime();
    $interval = $current_time->diff($end_time);
    $seconds_remaining = $interval->days * 86400 + $interval->h * 3600 + $interval->i * 60 + $interval->s;
    if( $seconds_remaining > 0 ){
    ?>
        <div class="count-down">
            <div class="countdown-V02">
                <div class="js-countdown" data-timer="<?php echo esc_attr($seconds_remaining); ?>" data-labels="d : ,h : ,m : , s"></div>
            </div>
        </div>
    <?php
    }
}

?>