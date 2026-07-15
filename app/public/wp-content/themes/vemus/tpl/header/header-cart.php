<?php
// Cart Icon
if ( class_exists( 'woocommerce' ) ) { ?>
    <li class="nav-cart">
        <a href="<?php echo esc_url( wc_get_page_permalink( 'cart' ) ); ?>"
            data-bs-toggle="<?php echo esc_attr( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) ? '' : 'offcanvas'); ?>"
            data-bs-target="#shoppingCart"
            class="nav-icon-item"
        >
            <i class="icon icon-cart"></i>
            <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                <span class="count-box shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
            <?php else: ?>
                <span class="count-box shopping-cart-items-count">0</span>
            <?php endif ?>
        </a>
    </li>

<?php  } ?>

