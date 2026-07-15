<div class="cookie-banner" id="cookie-banner">
    <div class="content">        
        <p class="text-md"><?php echo esc_html(themesflat_get_opt('tf_cookies_content')); ?></p>
        <div class="button-group">
            <?php if(themesflat_get_opt('tf_cookies_btn') != '') { ?>
                <a class="btn-out-line-white btn-submit-total tf-btn" href="<?php echo get_permalink(themesflat_get_opt('tf_cookies_btn_url')); ?>"><?php echo esc_html(themesflat_get_opt('tf_cookies_btn')); ?></a>
            <?php } ?>
            <?php if(themesflat_get_opt('tf_cookies_btn_active') != '') { ?>
                <button id="accept-cookie" class="accept-button btn-out-line-white btn-submit-total tf-btn"><?php echo esc_html(themesflat_get_opt('tf_cookies_btn_active')); ?></button>
            <?php } ?>
        </div>
    </div>
</div>