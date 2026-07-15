<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(themesflat_get_opt('progress_sale')){
    $text = themesflat_get_opt('progress_sale_text');
    $sub_text = themesflat_get_opt('progress_sale_subtext');
    $low_stock = themesflat_get_opt('progress_sale_low_stock');
}else{
    return;
}

$stock_quantity = $product->get_stock_quantity();
$total_sales =  $product->get_total_sales();
$low_stock_threshold = $product->get_low_stock_amount();
if ( empty($low_stock_threshold) ) {
    $low_stock_threshold = $low_stock;
}
$status_class = "";

if ($stock_quantity > 0 && $total_sales > 0) {
    $percent_left = ($stock_quantity / ($total_sales + $stock_quantity) ) * 100;
} else {
    return;
}

if ($stock_quantity <= $low_stock_threshold){
    $status_class .= "bg-danger";
}

?>

<div class="product-info-progress-sale">
    <div class="title-hurry-up">
        <span class="text-primary fw-medium"><?php echo esc_html($text); ?></span>  
        <span class="text-hurry-up fw-normal h6">
            <?php
            
            echo wp_kses(
                str_replace('{count}', "<span class='count'>{$stock_quantity}</span>", $sub_text),
                [
                    'span' =>[
                        'class' => true
                    ]
                ]
            ); 
            ?>
        </span>
    </div>
    <div class="progress-cart">
        <div class="value <?php echo esc_attr($status_class); ?>" style="width: 0%;" data-progress="<?php echo esc_attr($percent_left); ?>"></div>
    </div>
</div>