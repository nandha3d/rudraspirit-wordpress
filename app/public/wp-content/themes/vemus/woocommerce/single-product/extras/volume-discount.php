
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(!themesflat_get_opt('tf_volume_discount')){
    return;
}

if (empty($discount_list)) {
    return;
}

$discount_post_id = '';
foreach( $discount_list as $discount_id => $product_ids){
    if ( in_array($product->get_id(), $product_ids) ) {
        $discount_post_id = $discount_id;
        break;
    }
}

if ( empty($discount_post_id) ) {
    return;
}

$title = get_the_title($discount_post_id);
$volume_discount_data = get_post_meta($discount_post_id, '_volume_discount_data', true);
$volume_discount_type = get_post_meta($discount_post_id, '_volume_discount_style', true);
$discount_items = json_decode($volume_discount_data, true);

?>
<?php if( $volume_discount_type == 'thumbnail') : ?>
    <div class="tf-product-volume-discount-thumbnail">
        <h6 class="title-discount"><?php echo esc_html($title); ?></h6>
        <div class="list-volume-discount-thumbnail flat-check-list">
        <?php foreach ($discount_items as $item) : ?>
            <?php
                $from = max(0, $item['from']);
                $to = max(0, $item['to']);
                $discount = max(0, $item['discount']);
                if( empty($from) || empty($discount) || ($from >= $to && !empty($to) ) ){
                    continue;
                }
                $price = $product->get_price();
                $price_new = $price * ( 100 - $discount) / 100;
                $total = $from * $price;
                $total_new = $from * $price_new;
                $variation_data = [];

                if ($product->is_type('variable')) {
                    $variations = $product->get_available_variations();
                    
                    foreach ($variations as $variation) {
                        $variation_id = $variation['variation_id'];
                        $variation_price = max(0, $variation['display_price'] );
                        $variation_price_new = $variation_price * ( 100 - $discount) / 100;
                        $variation_total = $from * $variation_price;
                        $variation_total_new = $from * $variation_price_new;
                        $variation_data[$variation_id] = array(
                            'total_html' => wc_price($variation_total),
                            'total_new_html' => wc_price($variation_total_new)
                        );
                    }
                }

            ?>
            <div class="check-item volume-discount-item volume-discount-thumbnail-item" data-from="<?php echo esc_attr($from); ?>" data-to="<?php echo esc_attr($to); ?>" data-discount="<?php echo esc_attr($discount); ?>" data-variations="<?php echo esc_attr(json_encode($variation_data)); ?>">
                <div class="image-box">
                    <?php if( !empty($item['volume_discount_image']) ) : ?>
                        <img class=" ls-is-cached lazyload" data-src="<?php echo esc_attr($item['volume_discount_image']); ?>" src="<?php echo esc_attr($item['volume_discount_image']); ?>" alt="img-product">
                    <?php endif; ?>
                </div>
                <div class="content-discount tf-price">
                    <div class="count text-sm"><span class="text-xl fw-medium"><?php echo esc_html($from); ?>x</span> <?php echo esc_html(ucwords($item['unit'])); ?></php></div>
                    <div class="d-flex align-items-center"><span class="text-xl price-new tf-total-new"><?php echo wc_price($total_new); ?></span><span class="tag-sold">-<?php echo esc_html($discount); ?>%</span></div>
                    <div class="price-old text-decoration-line-through tf-total-old"><?php echo wc_price($total); ?></div>
                </div>
                <?php if(!empty($item['tag_enable'])) : ?>
                    <div class="tag-sale" style="background:<?php echo esc_attr($item['tag_color']); ?>;" >
                        <?php if(!empty($item['tag_icon'])) : ?>
                            <i class="icon <?php echo esc_attr($item['tag_icon']); ?>"></i>
                        <?php endif; ?>
                        <?php echo esc_attr($item['tag_label']); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="tf-product-volume-discount">
        <h6 class="title-discount"><?php echo esc_html($title); ?></h6>
        <div class="flat-check-list list-volume-discount">
            <?php foreach ($discount_items as $item) : ?>
                <?php
                    $from = max(0, $item['from']);
                    $to = max(0, $item['to']);
                    $discount = max(0, $item['discount']);
                    if( empty($from) || empty($discount) || ($from >= $to && !empty($to) ) ){
                        continue;
                    }
                    $price = $product->get_price();
                    $price_new = $price * ( 100 - $discount) / 100;
                    $total = $from * $price;
                    $total_new = $from * $price_new;
                    $variation_data = [];

                    if ($product->is_type('variable')) {
                        $variations = $product->get_available_variations();
                        
                        foreach ($variations as $variation) {
                            $variation_id = $variation['variation_id'];
                            $variation_price = max(0, $variation['display_price'] );
                            $variation_price_new = $variation_price * ( 100 - $discount) / 100;
                            $variation_total = $from * $variation_price;
                            $variation_total_new = $from * $variation_price_new;
                            $variation_data[$variation_id] = array(
                                'save_volume_html' => wc_price($variation_total - $variation_total_new),
                                'total_html' => wc_price($variation_total),
                                'total_new_html' => wc_price($variation_total_new),
                                'total_new' => $variation_total_new,
                            );
                        }
                    }

                ?>
                <div class="check-item volume-discount-item volume-discount-list-item" data-from="<?php echo esc_attr($from); ?>" data-to="<?php echo esc_attr($to); ?>" data-discount="<?php echo esc_attr($discount); ?>" data-variations="<?php echo esc_attr(json_encode($variation_data)); ?>" >
                    <div class="check"><span></span></div>
                    <div class="content-discount">
                        <div class="info-discount">
                            <p class="name text-md">
                                Buy from <span class="text-xl fw-medium"><?php echo esc_html($from); ?></span> <?php echo empty($to) ? '+' : 'to <span class="text-xl fw-medium">'.esc_html($to).'</span>'; ?> items for <span class="text-xl fw-medium"><?php echo esc_html($discount); ?>%</span> OFF
                            </p>
                            <p class="text text-xs">You save <span class="tf-save-volume"><?php echo wc_price($total - $total_new); ?></span></p>
                        </div>
                        <?php
                            if( WC()->cart ){
                                $cart = WC()->cart;
                                if ( $cart ) {
                                    $packages = $cart->get_shipping_packages();
                                    $package  = reset( $packages );
                                    $zone     = wc_get_shipping_zone( $package );
                                    foreach ( $zone->get_shipping_methods( true ) as $key => $method ) {
                                        if ( 'free_shipping' === $method->id ) {
                                            $instance = isset( $method->instance_settings ) ? $method->instance_settings : null;
                                            $amount   = isset( $instance['min_amount'] ) ? $instance['min_amount'] : 0;
                                            $requires = isset( $instance['requires'] ) ? $instance['requires'] : '';
                                            
                                            $cart_total    = $cart->get_displayed_subtotal();
                                            
                                            if ($product->is_type('variable')){
                                            ?>
                                                <span class="tag-shipping text-xs tf-free-shipping-tag" data-free-shipping="<?php echo esc_attr($amount); ?>"><?php echo esc_html__( 'FREE SHIPPING' , 'vemus'); ?></span>
                                            <?php
                                            }elseif( $total_new >= $amount){
                                            ?>
                                                <span class="tag-shipping text-xs tf-free-shipping-tag"><?php echo esc_html__( 'FREE SHIPPING' , 'vemus'); ?></span>
                                            <?php
                                            }
                                            break;
                                        }
                                    }
                                }
                            }
                        ?>
                        <div class="discount-price tf-price">
                            <span class="price-new text-md fw-medium tf-total-new"><?php echo wc_price($total_new); ?></span>
                            <span class="price-old fw-medium tf-total-old"><?php echo wc_price($total); ?></span>
                        </div>
                        <?php if(!empty($item['tag_enable'])) : ?>
                            <div class="tag-sale" style="background:<?php echo esc_attr($item['tag_color']); ?>;" >
                                <?php if(!empty($item['tag_icon'])) : ?>
                                    <i class="icon <?php echo esc_attr($item['tag_icon']); ?>"></i>
                                <?php endif; ?>
                                <?php echo esc_attr($item['tag_label']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button data-bs-target="#shoppingCart" data-bs-toggle="offcanvas"
            class="d-none tf-btn btn-primary w-100 animate-btn"><?php echo esc_html__( 'Grab this deal' , 'vemus'); ?></button>
    </div>
<?php endif; ?>