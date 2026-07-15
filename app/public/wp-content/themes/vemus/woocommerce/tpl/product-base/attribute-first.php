<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( function_exists( 'themesflat_get_opt' ) ) {
    $atb_name = themesflat_get_opt('attribute_first');
    $attr_type = themesflat_get_opt('attr1_type');
    
}

if ( $atb_name == 'none' ) {
    return;
}

$atb_name = 'pa_' . $atb_name ;


$sizes = $product->get_attribute($atb_name);

$product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
if (isset($_POST['product_style'])) {
	$product_style = sanitize_text_field($_POST['product_style']);
}
$class = '';
if($product_style != 'style-list') {
	$class = ' text-white ';
}

if (!empty($sizes) && ($product->is_type('variable')) ) :
    $sizes_arr = array_slice(explode(',', $sizes), 0, themesflat_get_opt('attr1_count'));
?>

    <?php switch ($attr_type) : 
        case 'label':
            ?>
            <ul class="size-box">
                <?php foreach ($sizes_arr as $size) : ?>
                    <li class="size-item text-xs <?php echo esc_attr($class); ?>"><?php echo esc_html(trim($size)); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php
            break;
        case 'label':
            ?>
            <ul class="list-color-product list-capacity-product justify-content-center">
                <?php foreach ($sizes_arr as $size) : ?>
                    <li class="list-color-item color-swatch <?php echo esc_attr($class); ?>">
                        <span class="text-quantity"><?php echo esc_html(trim($size)); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php
            break;
        default:
            break;
    endswitch; ?>
<?php endif; ?>

