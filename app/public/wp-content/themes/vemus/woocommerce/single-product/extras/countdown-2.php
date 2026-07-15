<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(themesflat_get_opt('tf_countdown')){
    $text = themesflat_get_opt('tf_countdown_text');
    $sub_text = themesflat_get_opt('tf_countdown_subtext');
    $classes = '';
    if($product->is_type('variable')){
        $seconds_remaining = 0;
        $classes .= ' hidden';
    }else{
        $sale_start_date = $product->get_date_on_sale_from();
        $sale_end_date = $product->get_date_on_sale_to();

        if ( ! ($product->is_on_sale() && $sale_start_date && $sale_end_date) ) {
            return;
        }
        $current = new DateTime();
        $interval = $current->diff($sale_end_date);
        $seconds_remaining = $interval->days * 86400 + $interval->h * 3600 + $interval->i * 60 + $interval->s;

        if( new DateTime($sale_start_date) > $current || !$seconds_remaining > 0 ){
            return;
        }
    }
}else{
    return;
}
?>

<div class="product-info-countdown type-1 <?php echo esc_attr($classes); ?>">
    <div class="countdown-title justify-content-center mb-0">
        <svg class="tf-ani-tada" width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8347 6.45288L16.1005 6.15088C16.3545 5.86248 16.3105 5.40368 15.9927 5.11508C15.6751 4.82568 15.2087 4.81948 14.9549 5.10788L14.6895 5.41008L15.8347 6.45288Z" fill="#808080"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.248 3.48071H12.3622V4.47671H11.248V3.48071Z" fill="#CCCCCC"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8315 2.46069H12.7767C13.0033 2.46069 13.1863 2.64369 13.1863 2.87169V3.34169C13.1863 3.56969 13.0033 3.75269 12.7767 3.75269H10.8315C10.6047 3.75269 10.4219 3.56969 10.4219 3.34169V2.87169C10.4219 2.64369 10.6047 2.46069 10.8315 2.46069Z" fill="#808080"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.804 4.40698C14.8684 4.40698 17.3526 6.89538 17.3526 9.96478C17.3526 13.0346 14.8684 15.5232 11.804 15.5232C10.2908 15.5232 9.28864 15.0216 7.23484 14.3232L7.80664 13.7474C8.06344 13.4882 7.81164 13.016 7.43244 13.1624C5.70784 13.8258 4.70264 13.1174 4.21244 11.5172C4.95424 11.9886 5.97864 11.6636 6.29964 11.3418C6.79704 10.844 6.60284 10.2682 5.48324 10.6382C4.04744 11.1116 2.53384 10.283 1.80664 8.23358C4.00344 9.33718 4.16524 7.06598 6.48564 7.67118C6.28824 6.87498 5.75304 6.61238 4.52724 6.64378C5.74284 5.11178 7.51084 5.90498 9.37544 4.96758C10.1088 4.60858 10.9324 4.40698 11.804 4.40698Z" fill="#FD6B65"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.7838 9.96456C15.7838 12.1658 14.003 13.95 11.805 13.95C10.7496 13.95 9.73757 13.5306 8.99137 12.7826C8.24537 12.0354 7.82617 11.0216 7.82617 9.96456C7.82617 8.90696 8.24517 7.89436 8.99137 7.14596C9.73757 6.39876 10.7496 5.97876 11.805 5.97876C14.003 5.97876 15.7838 7.76376 15.7838 9.96456Z" fill="#F2F2F2"></path>
            <path d="M11.7429 6.54007C11.6281 6.54187 11.5359 6.63727 11.5371 6.75227V7.05327C11.5371 7.33127 11.9551 7.33127 11.9551 7.05327V6.75227C11.9571 6.63407 11.8611 6.53807 11.7429 6.54007Z" fill="#808080"></path>
            <path d="M11.7429 12.6656C11.6281 12.6666 11.5359 12.7616 11.5371 12.8778V13.1778C11.5371 13.4568 11.9551 13.4568 11.9551 13.1778V12.8778C11.9571 12.7598 11.8611 12.6634 11.7429 12.6656Z" fill="#808080"></path>
            <path d="M14.6538 9.75586C14.3758 9.75586 14.3758 10.1741 14.6538 10.1741H14.9538C15.2316 10.1741 15.2316 9.75586 14.9538 9.75586H14.6538Z" fill="#808080"></path>
            <path d="M8.53843 9.75586C8.26063 9.75586 8.26063 10.1741 8.53843 10.1741H8.83943C9.11743 10.1741 9.11743 9.75586 8.83943 9.75586H8.53843Z" fill="#808080"></path>
            <path d="M13.8011 11.8135C13.6131 11.8135 13.5211 12.0415 13.6557 12.1719L13.8669 12.3843C13.9475 12.4713 14.0841 12.4729 14.1679 12.3897C14.2513 12.3059 14.2485 12.1701 14.1615 12.0897L13.9503 11.8775C13.9109 11.8367 13.8577 11.8135 13.8011 11.8135Z" fill="#808080"></path>
            <path d="M9.47626 7.48267C9.28886 7.48267 9.19726 7.71067 9.33106 7.84127L9.54326 8.05247C9.62346 8.13907 9.76046 8.14247 9.84426 8.05847C9.92766 7.97507 9.92446 7.83807 9.83786 7.75747L9.62666 7.54647C9.58706 7.50567 9.53286 7.48267 9.47626 7.48267Z" fill="#808080"></path>
            <path d="M14.0103 7.48279C13.9561 7.48399 13.9035 7.50699 13.8661 7.54659L13.6549 7.75759C13.5683 7.83819 13.5651 7.97519 13.6485 8.05859C13.7321 8.14239 13.8693 8.13919 13.9495 8.05259L14.1607 7.84139C14.2977 7.70859 14.2005 7.47659 14.0103 7.48279Z" fill="#808080"></path>
            <path d="M9.68663 11.8136C9.63243 11.8158 9.57983 11.8376 9.54243 11.8776L9.33023 12.0898C9.24343 12.1702 9.24143 12.306 9.32483 12.3898C9.40843 12.4732 9.54523 12.4714 9.62583 12.3844L9.83703 12.172C9.97403 12.0396 9.87703 11.8086 9.68663 11.8136Z" fill="#808080"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8026 9.65238C11.9772 9.65238 12.1152 9.78958 12.1152 9.96498C12.1152 10.1408 11.9774 10.2776 11.8026 10.2776C11.6282 10.2776 11.49 10.1408 11.49 9.96498C11.49 9.78938 11.6282 9.65238 11.8026 9.65238ZM13.2124 8.27838C13.1592 8.27938 13.107 8.30138 13.0692 8.33998L12.1068 9.30478C12.0136 9.26098 11.9112 9.23478 11.8026 9.23478C11.4024 9.23478 11.0742 9.56498 11.0742 9.96498C11.0742 10.3652 11.4024 10.6958 11.8026 10.6958C12.2028 10.6958 12.5312 10.3652 12.5312 9.96498C12.5312 9.82398 12.4892 9.69358 12.4194 9.58158L13.364 8.63478C13.4978 8.50198 13.4016 8.27398 13.2124 8.27838Z" fill="#808080"></path>
        </svg>
        <p class="text-xs fw-medium">
            <?php echo esc_html($text); ?>
            <?php echo esc_html($sub_text); ?>
        </p>
    </div>
    <div class="js-countdown countdown-box tf-countdown-box" data-timer="<?php echo esc_attr($seconds_remaining); ?>" data-labels="Days,Hours,Mins,Secs"><div aria-hidden="true" class="countdown__timer"><span class="countdown__item"><span class="countdown__value countdown__value--0 js-countdown__value--0">11</span><span class="countdown__label">Days</span></span><span class="countdown__item"><span class="countdown__value countdown__value--1 js-countdown__value--1">15</span><span class="countdown__label">Hours</span></span><span class="countdown__item"><span class="countdown__value countdown__value--2 js-countdown__value--2">8</span><span class="countdown__label">Mins</span></span><span class="countdown__item"><span class="countdown__value countdown__value--3 js-countdown__value--3">41</span><span class="countdown__label">Secs</span></span></div></div>
</div>