<?php

$language_bottom = themesflat_get_opt('language_bottom');
if (themesflat_get_opt_elementor('language_bottom') != '') {
    $language_bottom = themesflat_get_opt_elementor('language_bottom');
}

$currency_bottom = themesflat_get_opt('currency_bottom');
if (themesflat_get_opt_elementor('currency_bottom') != '') {
    $currency_bottom = themesflat_get_opt_elementor('currency_bottom');
}

if (themesflat_get_opt('show_bottom') == 1): ?> 
    
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-wrap">     
                    <div class="footer-bar-language">
                    <?php if ( $currency_bottom == 1 ): ?>
                        <?php 
                        if ( class_exists('woocs') ) {
                            global $WOOCS;

                            if ( ! isset( $WOOCS ) ) {
                                return;
                            }
                            $currencies = $WOOCS->get_currencies();
                            ?>

                            <div class="tf-currencies">
                                <select id="custom-currency-switcher" class="tf-dropdown-select style-default type-currencies setting-curreny-language">
                                    <?php foreach ( $currencies as $code => $currency ): ?>
                                        <?php
                                            $flag_url = $currency['flag'];
                                        ?>
                                        <option 
                                            value="<?php echo esc_attr($code); ?>" 
                                            data-thumbnail="<?php echo esc_url($flag_url); ?>" 
                                            <?php echo esc_attr(($WOOCS->current_currency === $code) ? 'selected' : ''); ?>
                                        >
                                            <?php echo esc_html($currency['description']) . ' (' . esc_html($code) . ' ' . esc_html($currency['symbol']) . ')'; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php } else { ?>
                            <div class="tf-currencies ">
                                <select class="tf-dropdown-select style-default type-currencies setting-curreny-language">
                                    <option value="USD" selected>United States (USD $)
                                    </option>
                                    <option value="EUR">France (EUR €)</option>
                                    <option value="EUR">Germany (EUR €)</option>
                                    <option value="VND">Vietnam (VND ₫)</option>
                                </select>
                            </div>
                    <?php } endif; ?> 

                        <?php if ( $language_bottom == 1 ): ?>                       
                            <?php
                            if ( class_exists('woocommerce_wpml') ) {
                                $languages = apply_filters( 'wpml_active_languages', NULL, array(
                                    'skip_missing' => 0,
                                    'link_empty_to' => '',
                                    'orderby' => 'code',
                                    'order' => 'asc',
                                ) );
                                ?>

                                <div class="tf-languages ">
                                    <select class="tf-dropdown-select style-default type-languages setting-curreny-language" id="custom-language-switcher">
                                        <?php if ( ! empty( $languages ) ) : ?>
                                            <?php foreach ( $languages as $lang ): ?>
                                                <option 
                                                    value="<?php echo esc_url( $lang['url'] ); ?>" 
                                                    data-thumbnail="<?php echo esc_url( $lang['country_flag_url'] ); ?>"
                                                    <?php echo esc_attr($lang['active'] ? 'selected' : ''); ?>
                                                >
                                                    <?php echo esc_html( $lang['translated_name'] ); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <div class="tf-languages ">
                                    <select class="tf-dropdown-select style-default type-languages setting-curreny-language">
                                        <option>English</option>
                                        <option>العربية</option>
                                        <option>简体中文</option>
                                        <option>اردو</option>
                                    </select>
                                </div>
                        <?php } endif; ?>
                    </div>                                  
                            <p class="text-nocopy"><?php echo wp_kses(themesflat_get_opt( 'footer_copyright'), themesflat_kses_allowed_html()); ?></p>
                        
                            <ul class="paymend-method-list">
                                <?php
                                $img_payment = explode(',', themesflat_get_opt('img_payment')); 
                                if (!empty($img_payment[0])) {
                                    foreach ($img_payment as $image) {
                                        echo '<li><img src="'.esc_attr($image).'" alt="'.esc_html__("payment",'vemus').'"></</li>';
                                    }
                                }                                
                                ?>
                            </ul>
                </div>
            </div>
        </div>


<?php endif; ?>