<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
if( $product->is_type( 'external' ) || $product->is_type( 'grouped' ) || $product->is_type( 'bundle' ) || $product->is_type( 'composite' ) ) {
    return;
}
if ( $product->is_type( 'simple' ) && ! $product->is_in_stock() ) {
    return;
}

if(!themesflat_get_opt('tf_buy_together')){
    return;
}

$style = $product->get_meta('_tf_product_together_style');

if( empty($style)){
    $style = themesflat_get_opt('tf_buy_together_style');
}

$checked = $product->get_meta('_tf_product_together_check_all');

if( empty($checked) ){
    $checked = themesflat_get_opt('tf_product_together_check_all') ? 'yes' : 'no';
}

$checked_classes = $checked == 'yes' ? 'check' : '';
$checked = $checked == 'yes' ? 'checked' : '';

$product_together_ids = $product->get_meta( '_tf_product_together_ids' ) ?? [];
if( empty($product_together_ids) ){
    return;
}
array_unshift($product_together_ids, $product->get_id());
$product_together_ids = array_unique($product_together_ids);


themesflat_remove_hook('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
add_filter('woocommerce_loop_add_to_cart_link', [ Woo_Single_Product_Hook::instance(), 'select_option_button'] , 21, 3 );

if( $style == 'grid') : ?>
    <div class="tf-product-fbt-wrap">
        <form class="tf-product-form-fbt tf-product-together-form">
            <h6 class="title text-center"><?php esc_html_e('Frequently Bought Together', 'vemus'); ?></h6>
            <div class="content-fbt">
                <div class="list-fbt pb-1">
                    <?php foreach ($product_together_ids as $product_together_id): 
                        $product_together = wc_get_product($product_together_id);
                        if( $product_together->is_type('variation') ){
                            $atributes =  $product_together->get_attributes();
                            foreach( $atributes as $atribute_key => $value){
                                if( empty($value) ){
                                    continue 2;
                                }
                            }
                        }
                        if(!$product_together || !$product_together->is_in_stock() || $product_together->is_type('external') || $product_together->is_type('grouped') || $product_together->is_type('bundle') || $product_together->is_type('composite')) continue;
                        ?>
                        <div class="fbt-image item-has-checkbox  <?php echo esc_attr($checked_classes); ?>">
                            <a href="<?php echo esc_url($product_together_id == $product->get_id() ? '#' : $product_together->get_permalink()); ?>">
                                <?php echo wp_kses_post($product_together->get_image('full')); ?>
                            </a>
                        </div>
                        <?php if (end($product_together_ids) !== $product_together_id): ?>
                            <span class="fbt-plus"><span class="icon icon-plus2"></span></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="fbt-swatches">
                    <?php foreach ($product_together_ids as $product_together_id):
                        $product_together = wc_get_product($product_together_id);
                        if( $product_together->is_type('variation') ){
                            $atributes =  $product_together->get_attributes();
                            foreach( $atributes as $atribute_key => $value){
                                if( empty($value) ){
                                    continue 2;
                                }
                            }
                        }
                        if(!$product_together || !$product_together->is_in_stock() || $product_together->is_type('external') || $product_together->is_type('grouped') || $product_together->is_type('bundle') || $product_together->is_type('composite')) continue;
                        $disabled = ($product_together_id == get_the_ID()) ? 'disabled readonly' : '';
                        ?>
                        <div class="fbt-info tf-fbt-item item-has-checkbox <?php echo esc_attr($checked_classes); ?> <?php echo esc_attr($product_together_id == $product->get_id() ? 'main-item' : ''); ?>" data-product_id="<?php echo absint($product_together_id); ?>" <?php echo esc_attr($checked); ?>>
                            <div class="bundle-check">
                                <input type="checkbox" class="tf-check" <?php echo esc_attr($disabled); ?> <?php echo esc_attr($checked); ?>>
                            </div>
                            <div class="bundle-title text-md fw-medium">
                                <a href="<?php echo esc_url($product_together_id == $product->get_id() ? '#' : $product_together->get_permalink()); ?>">
                                    <?php echo esc_html($product_together->get_name()); ?>
                                </a>
                            </div>
                            <?php if ($product_together->is_type('variable')): ?>
                                <?php
                                    $default_attrs = $product_together->get_default_attributes();
                                    $normalized_default_attrs = [];
                                    foreach ( $default_attrs as $key => $val ) {
                                        $normalized_default_attrs[ 'attribute_' . $key ] = $val;
                                    }
                                    $variations = $product_together->get_available_variations();
                                    $all_attrs = $product_together->get_variation_attributes();
                                ?>
                                <?php if(count( $all_attrs ) < 6 ) : ?>
                                    <div class="bundle-variant tf-select">
                                        <select>
                                        <?php
                                            foreach ( $variations as $variation ) {
                                                $variation_obj = wc_get_product( $variation['variation_id'] );
                                                if ( ! $variation_obj || ! $variation_obj->exists() ) continue;
                                                if (!$variation_obj->is_purchasable() || !$variation_obj->is_in_stock()) {
                                                    continue;
                                                }
                                            
                                                $price = $variation_obj->get_price();
                                                $image_url = wp_get_attachment_image_url( $variation_obj->get_image_id(), 'full' );
                                                $price_html = $variation_obj->get_price_html();
                                            
                                                $attribute_sets = [[]];

                                                foreach ( $variation['attributes'] as $attr => $value ) {
                                                    $taxonomy = str_replace( 'attribute_', '', $attr );
                                            
                                                    if ( empty( $value ) ) {
                                                        $options_string = $product_together->get_attribute( $taxonomy );
                                                        $options = array_map( 'trim', preg_split( '/[,|]/', $options_string ) );
                                            
                                                        $new_sets = [];
                                                        foreach ( $attribute_sets as $set ) {
                                                            foreach ( $options as $option ) {
                                                                if ( ! empty( $option ) ) {
                                                                    $option_slug = sanitize_title( $option );
                                                                    $new_set = $set;
                                                                    $new_set[$attr] = $option_slug;
                                            
                                                                    $term = get_term_by( 'slug', $option_slug, $taxonomy );
                                                                    $new_set['_label'][$taxonomy] = $term ? $term->name : ucfirst( $option );
                                            
                                                                    $new_sets[] = $new_set;
                                                                }
                                                            }
                                                        }
                                                        $attribute_sets = $new_sets;
                                                    } else {
                                                        foreach ( $attribute_sets as &$set ) {
                                                            $set[$attr] = $value;
                                            
                                                            $term = get_term_by( 'slug', $value, $taxonomy );
                                                            $set['_label'][$taxonomy] = $term ? $term->name : ucfirst( $value );
                                                        }
                                                    }
                                                }
                                            
                                                foreach ( $attribute_sets as $set ) {
                                                    if( empty($set) ) continue;
                                                    $label = implode( ' / ', $set['_label'] );
                                            
                                                    $data_attributes = array_filter($set, fn($k) => strpos($k, '_label') === false, ARRAY_FILTER_USE_KEY);
                                            
                                                    echo '<option 
                                                        value="' . esc_attr( $variation['variation_id'] ) . '" 
                                                        data-image="' . esc_url( $image_url ) . '" 
                                                        data-attributes="' . esc_attr( json_encode( $data_attributes ) ) . '" 
                                                        data-price="' . esc_attr( $price ) . '" 
                                                        data-price-html="' . esc_attr( $price_html ) . '" 
                                                        ' . selected( empty(array_diff_assoc($variation['attributes'], $normalized_default_attrs)), true, false ) . '>'
                                                        . $label . 
                                                        '</option>';
                                                }
                                            }                                    
                                        ?>
                                        </select>
                                    </div>
                                <?php else: ?>
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                    <input type="hidden" class="fbt_variation_id" value="" data-atrributes="" />
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="bundle-price text-md fw-medium">
                                <span class="tf-price" data-price="<?php echo esc_attr( $product_together->is_type('variable') ? '0' : $product_together->get_price() ); ?>"><?php echo wp_kses_post($product_together->get_price_html()); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="fbt-total-price text-xl fw-medium">
                <span>
                    <?php esc_html_e('Total Price:', 'vemus'); ?>
                    <span class="total-price"></span>
                </span>
                <div class="d-flex align-items-center">
                    <span class="price-new"></span>
                    <span class="price-old"></span>
                </div>
            </div>

            <button data-bs-target="#shoppingCart" type="button" data-bs-toggle="" class="tf-fbt-btn tf-btn btn-primary animate-btn">
            <?php echo esc_html__('Add selected to cart' , 'vemus'); ?>
                <span class="tf-add-to-cart-loading d-none position-relative">
                    <span class="spinner"></span>
                </span>
            </button>
        </form>
    </div>
<?php else : ?>
    <div class="tf-product-fbt mt-3">
        <div class="h4 title fw-normal text-uppercase"><?php esc_html_e('Frequently Bought Together', 'vemus'); ?></div>
        <form class="tf-product-form-bundle tf-product-together-form">
            <div class="tf-bundle-products">
                <?php
                    foreach($product_together_ids as $product_together_id){
                        $product_together = wc_get_product($product_together_id);
                        if( $product_together->is_type('variation') ){
                            $atributes =  $product_together->get_attributes();
                            foreach( $atributes as $atribute_key => $value){
                                if( empty($value) ){
                                    continue 2;
                                }
                            }
                        }
                        if($product_together && $product_together->is_in_stock() && !$product_together->is_type('external') && !$product_together->is_type('grouped') && !$product_together->is_type('bundle') && !$product_together->is_type('composite')){
                            ?>
                            <div class="tf-bundle-product-item item-has-checkbox tf-fbt-item <?php echo esc_attr($checked_classes); ?> <?php echo esc_attr($product_together_id == $product->get_id() ? 'main-item' : ''); ?>"" data-product_id="<?php echo absint($product_together_id); ?>">
                                <div class="bundle-check">
                                    <input type="checkbox" class="tf-check" <?php echo esc_attr($checked); ?>>
                                </div>
                                <a href="<?php echo esc_url($product_together_id == $product->get_id() ? '#' : $product_together->get_permalink()); ?>" class="bundle-image">
                                    <?php echo wp_kses_post($product_together->get_image('full')); ?>
                                </a>
                                <div class="bundle-info">
                                    <div class="name link h5 fw-normal">
                                        <a href="<?php echo esc_url($product_together_id == $product->get_id() ? '#' : $product_together->get_permalink()); ?>">
                                            <?php echo esc_html($product_together->get_name()); ?>
                                        </a>
                                    </div>
                                    <div class="bundle-price price-wrap">
                                        <span class="tf-price" data-price="<?php echo esc_attr( $product_together->is_type('variable') ? '0' : $product_together->get_price() ); ?>"><?php echo wp_kses_post($product_together->get_price_html()); ?></span>
                                    </div>
                                    <?php if ($product_together->is_type('variable')): ?>
                                        <?php
                                            $default_attrs = $product_together->get_default_attributes();
                                            $normalized_default_attrs = [];
                                            foreach ( $default_attrs as $key => $val ) {
                                                $normalized_default_attrs[ 'attribute_' . $key ] = $val;
                                            }
                                            $variations = $product_together->get_available_variations();
                                            $all_attrs = $product_together->get_variation_attributes();
                                        ?>
                                        <?php if(count( $all_attrs ) < 6 ) : ?>
                                            <div class="bundle-variant tf-select">
                                                <select>
                                                <?php
                                                    foreach ( $variations as $variation ) {
                                                        $variation_obj = wc_get_product( $variation['variation_id'] );
                                                        if ( ! $variation_obj || ! $variation_obj->exists() ) continue;
                                                        if (!$variation_obj->is_purchasable() || !$variation_obj->is_in_stock()) {
                                                            continue;
                                                        }
                                                    
                                                        $price = $variation_obj->get_price();
                                                        $image_url = wp_get_attachment_image_url( $variation_obj->get_image_id(), 'full' );
                                                        $price_html = $variation_obj->get_price_html();
                                                    
                                                        $attribute_sets = [[]];

                                                        foreach ( $variation['attributes'] as $attr => $value ) {
                                                            $taxonomy = str_replace( 'attribute_', '', $attr );
                                                    
                                                            if ( empty( $value ) ) {
                                                                $options_string = $product_together->get_attribute( $taxonomy );
                                                                $options = array_map( 'trim', preg_split( '/[,|]/', $options_string ) );
                                                    
                                                                $new_sets = [];
                                                                foreach ( $attribute_sets as $set ) {
                                                                    foreach ( $options as $option ) {
                                                                        if ( ! empty( $option ) ) {
                                                                            $option_slug = sanitize_title( $option );
                                                                            $new_set = $set;
                                                                            $new_set[$attr] = $option_slug;
                                                    
                                                                            $term = get_term_by( 'slug', $option_slug, $taxonomy );
                                                                            $new_set['_label'][$taxonomy] = $term ? $term->name : ucfirst( $option );
                                                    
                                                                            $new_sets[] = $new_set;
                                                                        }
                                                                    }
                                                                }
                                                                $attribute_sets = $new_sets;
                                                            } else {
                                                                foreach ( $attribute_sets as &$set ) {
                                                                    $set[$attr] = $value;
                                                    
                                                                    $term = get_term_by( 'slug', $value, $taxonomy );
                                                                    $set['_label'][$taxonomy] = $term ? $term->name : ucfirst( $value );
                                                                }
                                                            }
                                                        }
                                                    
                                                        foreach ( $attribute_sets as $set ) {
                                                            if( empty($set) ) continue;
                                                            $label = implode( ' / ', $set['_label'] );
                                                    
                                                            $data_attributes = array_filter($set, fn($k) => strpos($k, '_label') === false, ARRAY_FILTER_USE_KEY);
                                                    
                                                            echo '<option 
                                                                value="' . esc_attr( $variation['variation_id'] ) . '" 
                                                                data-image="' . esc_url( $image_url ) . '" 
                                                                data-attributes="' . esc_attr( json_encode( $data_attributes ) ) . '" 
                                                                data-price="' . esc_attr( $price ) . '" 
                                                                data-price-html="' . esc_attr( $price_html ) . '" 
                                                                ' . selected( empty(array_diff_assoc($variation['attributes'], $normalized_default_attrs)), true, false ) . '>'
                                                                . $label . 
                                                                '</option>';
                                                        }
                                                    }                                    
                                                ?>
                                                </select>
                                            </div>
                                        <?php else: ?>
                                            <?php woocommerce_template_loop_add_to_cart(); ?>
                                            <input type="hidden" class="fbt_variation_id" value="" data-atrributes="" />
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
            <button data-bs-target="#shoppingCart" type="button" data-bs-toggle="" class="tf-btn tf-fbt-btn btn-fill text-uppercase fw-medium w-100 animate-btn">
                <?php echo esc_html__('Add to bag' , 'vemus'); ?>
                <i class="icon-minus"></i> 
                <span class="total-price"></span>
                <span class="tf-add-to-cart-loading d-none position-relative">
                    <span class="spinner"></span>
                </span>
            </button>
        </form>
    </div>
<?php endif; ?>

<?php
add_filter('woocommerce_loop_add_to_cart_link', 'tfwc_add_to_cart', 20, 3 );
themesflat_remove_hook('woocommerce_loop_add_to_cart_link', [ Woo_Single_Product_Hook::instance(), 'select_option_button'], 21, 3 );
?>