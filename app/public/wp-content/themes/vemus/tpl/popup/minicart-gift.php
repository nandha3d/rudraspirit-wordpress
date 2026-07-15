<?php 
$gift_applied = WC()->session->get('tfwc_gift') ? true : false; 
$currency   = get_woocommerce_currency_symbol();
$gift_fee = themesflat_get_opt('gift_fee');
?>
<div class="tf-mini-cart-tool-openable add-gift">
	<div class="overlay tf-mini-cart-tool-close"></div>
    <form action="#" class="tf-mini-cart-tool-content">
        <div class="tf-mini-cart-tool-text h5 fw-normal text-uppercase"><?php _e('Add gift wrap','vemus')?></div>
        <div class="tf-mini-cart-tool-text1">
            <?php _e('The product will be wrapped carefully. Fee is  only ','vemus');?>
            <span class="text text-main">
                <?php echo esc_html($currency) . (float) $gift_fee ; ?>
            </span>
            <?php _e(' . Do you want a gift wrap?','vemus');?>
        </div>
        <div class="tf-cart-tool-btns">
            <button class="subscribe-button tf-btn w-100 btn-fill animate-btn" type="submit" data-action="add">
            <?php
            if ($gift_applied) {
                _e('Remove', 'vemus');
            } else {
                _e('Add a Gift Wrap', 'vemus');
            }
            ?>
        </button>
            <div class="tf-btn style-2 w-100 tf-mini-cart-tool-close">
                <?php _e('Cancel','vemus');?>
            </div>
        </div>
        <p class="notice-gift" style="<?php echo esc_attr('display: none;'); ?>"></p>
    </form>
</div>