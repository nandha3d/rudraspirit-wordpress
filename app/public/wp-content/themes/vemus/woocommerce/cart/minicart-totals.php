<?php
    $total_saved = 0;
    $subtotal ='';
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $regular_price = $cart_item['data']->get_regular_price();
        $sale_price = $cart_item['data']->get_sale_price();

        if ( $sale_price && $sale_price < $regular_price ) {
            $saved_amount = ( $regular_price - $sale_price ) * $cart_item['quantity'];
            $total_saved += $saved_amount;
        }
    }

    if ( $total_saved > 0 ) {
        $saved_amount_formatted = wc_price( $total_saved );
        $subtotal .= ' <span class="tfwc-price-saved">Save:' . $saved_amount_formatted . '</span>';
    }
?>
<div class="tfwc-minicart-totals">
    <div>

        <div class="tf-cart-totals-discounts tf-cart-subtotal">
            <div class="tf-cart-total-text fw-normal text-uppercase"><?php esc_html_e( 'Subtotal', 'vemus' ); ?></div>
            <div class="tf-totals-total-value h6 fw-normal"><?php wc_cart_totals_subtotal_html(); echo wp_kses_post($subtotal); ?></div>
        </div>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <div class="tf-cart-totals-discounts tf-cart-subtotal cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <div class="tf-cart-total-text fw-normal text-uppercase"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
                <div class="tf-totals-total-value h6 fw-normal"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
            </div>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <!-- <div class="tf-cart-totals-discounts shipping text-md "> -->
                <?php //wc_cart_totals_shipping_html(); ?>
            <!-- </div> -->
        <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

            <div class="tf-cart-totals-discounts shipping">
                <div class="tf-cart-total-text fw-normal text-uppercase"><?php esc_html_e( 'Shipping', 'vemus' ); ?></div>
                <div class="tf-totals-total-value h6 fw-normal" data-title="<?php esc_attr_e( 'Shipping', 'vemus' ); ?>"><?php woocommerce_shipping_calculator(); ?></div>
            </div>

        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <div class="d-flex justify-content-between">
                <span class="text-uppercase"><?php echo esc_html( $fee->name ); ?></span>
                <span data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></span>
            </div>
        <?php endforeach; ?>


        <div class="tf-cart-totals-discounts total-price">
            <div class="tf-cart-total-text fw-normal text-uppercase"><?php esc_html_e( 'Total', 'vemus' ); ?></div>
            <div class="tf-totals-total-value h6 fw-normal"><?php wc_cart_totals_order_total_html(); echo wp_kses_post($subtotal); ?></div>
        </div>

    </div>
</div>
