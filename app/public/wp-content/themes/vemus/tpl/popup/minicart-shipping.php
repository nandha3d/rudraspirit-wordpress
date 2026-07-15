<div class="tf-mini-cart-tool-openable estimate-shipping">
    <div class="overlay tf-mini-cart-tool-close"></div>  
    <div id="shipping-form" class="tf-mini-cart-tool-content style-border">
        <div class="tf-mini-cart-tool-text h5 fw-normal text-uppercase">
            <?php _e('Shipping estimates', 'vemus' ); ?>
        </div>
        <?php woocommerce_shipping_calculator(); ?>
        <div class="tf-cart-tool-btns">
            <button class="tf-btn w-100 btn-fill animate-btn shipping-est-btn" type="submit"><?php _e('Estimate','vemus')?></button>
            <div class="tf-mini-cart-tool-primary tf-btn style-2 w-100 tf-mini-cart-tool-close">
                <?php _e('Close','vemus')?>
            </div>  
        </div>
        <p class="notice-shipping"></p>
    </div>
</div>