<div class="tf-mini-cart-tool-openable coupon">
    <div class="overplay tf-mini-cart-tool-close"></div>
    <form action="#" class="tf-mini-cart-tool-content" method="POST">
        <div class="tf-mini-cart-tool-text text-sm fw-medium"><?php _e('Add coupon','vemus')?></div>
        <div class="tf-mini-cart-tool-text1 text-dark-1"><?php _e('* Discount will be calculated and applied at checkout','vemus')?></div>
        <input type="text" name="tfwc_coupon_code"  class="input-text">
        <div class="tf-cart-tool-btns">
            <button class="subscribe-button tf-btn animate-btn d-inline-flex bg-dark-2 w-100" type="submit"><?php _e('Apply Coupon','vemus')?></button>
            <div class="tf-btn btn-outline-dark2 w-100 tf-mini-cart-tool-close"><?php _e('Cancel','vemus')?></div>
        </div>
        <p class="notice-coupon"></p>
    </form>
</div>