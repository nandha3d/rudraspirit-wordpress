<!-- shoppingCart -->
<?php
$class = '';
if( themesflat_get_opt('related_minicart') == 1) {
    if( themesflat_get_opt('related_minicart_style') == 'style2') {
        $class = 'style-2';
    }
}

if ( function_exists( 'WC' ) && WC()->cart && ! WC()->cart->is_empty() ) : ?>
	<?php
	if(themesflat_get_opt('free_shipping_bar') == 1) {
		$amount   = 0;
		$requires = '';
		$discount = false;
		$cart     = WC()->cart;

		if ($cart) {
			$packages = $cart->get_shipping_packages();
			$package  = reset($packages);
			$zone     = wc_get_shipping_zone($package);

			if ($zone && !empty($zone->get_shipping_methods(true))) {
				foreach ($zone->get_shipping_methods(true) as $method) {
					if ('free_shipping' === $method->id) {
						$instance = isset($method->instance_settings) ? $method->instance_settings : null;
						$amount   = isset($instance['min_amount']) ? $instance['min_amount'] : 0;
						$requires = isset($instance['requires']) ? $instance['requires'] : '';
						$discount = isset($instance['ignore_discounts']) && 'yes' === $instance['ignore_discounts'] ? true : false;
						break;
					}
				}
			}

			$cart_total = $cart->get_displayed_subtotal();
			$currency   = get_woocommerce_currency_symbol();
			$remaining  = max(0, $amount - $cart_total); 

			$percent = 0;
			if ($amount > 0) {
				$percent = min(100, (100 - ($remaining / $amount) * 100));
			}

			$progress_cart_text = themesflat_get_opt('progress_cart_text');
			$success_cart_text  = themesflat_get_opt('success_cart_text');

			$progress_text = str_replace(
				['{currency}', '{total}'],
				[$currency, $remaining],
				$progress_cart_text
			);

			$success_text = $success_cart_text;

			if ($amount > 0) {
                ob_start();

                ?>
                    <h6 class="text fw-normal text-uppercase">
                        <?php echo wp_kses_post(($cart_total < $amount) ? $progress_text : $success_text); ?>
                    </h6>
                    <div class="tf-progress-bar tf-progress-ship">
                        <div class="value" data-progress="<?php echo esc_attr($percent); ?>">
                            <i class="icon icon-delivery"></i>
                        </div>
                    </div>
                <?php
                $shipping_contents = ob_get_clean();
			}
		}
	}
endif;
?>
<?php if (themesflat_get_opt( 'header_cart_icon') == 1  && class_exists( 'woocommerce' ) && !is_cart() && !is_checkout() ) { ?>
    <div class="offcanvas offcanvas-end modal-style-1 popup-shopping-cart <?php echo esc_attr($class);?> <?php if ( is_user_logged_in() && is_admin_bar_showing() ) { echo 'is-admin';} ?>" id="shoppingCart">
        <div class="canvas-wrapper">
            <div class="canvas-header">
                <h3 class="title fw-normal text-uppercase"><?php echo esc_html__( 'Shopping Cart ', 'vemus' ); ?></h3>
                <span class="icon-close link icon-close-popup" data-bs-dismiss="offcanvas"></span>
            </div>
            <div class="wrap list-file-delete">
                <div class="tf-mini-cart-threshold">
                    <?php if ( ! WC()->cart->is_empty() && !empty(WC()->cart)   ) : ?>
                        <?php echo wp_kses_post( $shipping_contents ?? '') ?>;
                        <div class="tf-number-count">
                            <p class="text-uppercase"><span class="prd-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span> <?php _e(' products', 'vemus') ?></p>

                            <a href="javascript:void(0)" class="tf-btn-line style-line-2 clear-file-delete tf-clear-cart-btn">
                                <span class="text-body">
                                    <?php _e('Empty cart', 'vemus'); ?>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="widget_shopping_cart_content wrap">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
            <div class="modal-content">
                <?php
                if( themesflat_get_opt('related_minicart') == 1) {
                    if( themesflat_get_opt('related_minicart_style') == 'style2') {
                        // wc_get_template('cart/relatedv2.php');?>
                    <div class="modal-shopping-cart-main">
                    <?php
                    }
                }
                ?>
                
                    <?php
                if( themesflat_get_opt('related_minicart') == 1) {
                    if( themesflat_get_opt('related_minicart_style') == 'style2') { ?>
                    </div>
                    <?php
                    }
                }
                ?>
                
            </div>
            <div class="canvas-footer">
                <div class="overlay-close" data-bs-dismiss="offcanvas"></div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- /shoppingCart --> 