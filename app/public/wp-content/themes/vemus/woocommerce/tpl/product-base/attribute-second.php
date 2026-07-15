<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
if (isset($_POST['product_style'])) {
    $product_style = sanitize_text_field($_POST['product_style']);
}
$class = '';
if( $product_style == 'style-list') {
    $class = ' tooltip-top ';
} else {
    $class = ' tooltip-bot ';
}

if ( function_exists( 'themesflat_get_opt' ) ) {
    $atb_name = themesflat_get_opt('attribute_second');
    $attr_type = themesflat_get_opt('attr2_type');
}

if ( $atb_name == 'none' ) {
    return;
}

$atb_name = 'pa_' . $atb_name ;


$variation_data = [];
if ($product->is_type('variable')) {
    $variations = $product->get_available_variations();
    foreach ($variations as $variation) {
        $color_value = $variation['attributes']['attribute_'.$atb_name] ?? '';
        if ($color_value) {
            $variation_data[$color_value] = [
                'price' => wc_price($variation['display_price']),
                'image' => $variation['image']['src'] ?? '',
            ];
        }
    }
}

$color_terms = wc_get_product_terms($product->get_id(), $atb_name, ['fields' => 'all']);
$color_options = [];
$bg_options = [];
if (!empty($color_terms)) {
    foreach ($color_terms as $term) {
        $color_options[$term->slug] = $term->name;
        
    }
}

$color_terms = array_slice($color_terms, 0, themesflat_get_opt('attr2_count'));

if ($product->is_type('variable') && !empty($color_options)) :
    $key = 0 ;
    
?>
    <?php switch ($attr_type) :     
        case 'label':
            ?>
            <ul class="size-box">
                <?php foreach ($color_terms as $term) : ?>
                    <li class="size-item text-xs <?php echo esc_attr($class); ?>"><?php echo esc_html($term->name); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php
            break;
        case 'button':
            ?>
            <ul class="list-color-product list-capacity-product ">
                <?php foreach ($color_terms as $term) : ?>
                    <li class="list-color-item color-swatch <?php echo esc_attr($class); ?>">
                        <span class="text-quantity"><?php echo esc_html($term->name); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php
            break;
        case 'color':
            ?>
            <ul class="list-color-product">
                <?php foreach ($color_terms as $term) : 
                    $key ++;
                    $data_price = $variation_data[$term->slug]['price'] ?? '';
                    $data_image = $variation_data[$term->slug]['image'] ?? '';
                    
                    if ( class_exists( '\WCBoost\VariationSwatches\Admin\Term_Meta' ) ) {
                        $color = \WCBoost\VariationSwatches\Admin\Term_Meta::instance()->get_meta( $term->term_id,'color' );
                    } else {
                        $color = get_term_meta($term->term_id, 'color', true);
                    }
            
                    $bg_color = $color ? esc_attr($color) : esc_attr(strtolower($term->slug));

                    $class_white = '';

                    if ( strtolower($bg_color) === '#ffffff' || strtolower($bg_color) === '#fff'  || strtolower($bg_color) === 'white' ) {
                        $class_white = 'line';
                    }

                ?>
                    <li class="list-color-item color-swatch hover-tooltip <?php echo esc_attr($class);?> <?php echo esc_attr($class_white);?>" 
                        data-price="<?php echo esc_attr($data_price); ?>" 
                        data-image="<?php echo esc_url($data_image); ?>">
                        <span class="tooltip color-filter"><?php echo esc_html($term->name); ?></span>
                        <span class="swatch-value" style="background-color: <?php echo esc_attr($bg_color); ?>;"></span>
                        <img class="lazyload" data-src="<?php echo esc_url($data_image); ?>" alt="image-product">
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php
            break;
        default:
            break;
    endswitch; ?>
    
<?php endif; ?>
<?php
?>
