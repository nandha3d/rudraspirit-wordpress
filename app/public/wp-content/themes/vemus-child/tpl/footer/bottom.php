<?php
/**
 * Child Theme Override: Bottom Footer Bar
 * Completely removes currency and language switchers as requested by user.
 */

$language_bottom = themesflat_get_opt('language_bottom');
if (themesflat_get_opt_elementor('language_bottom') != '') {
    $language_bottom = themesflat_get_opt_elementor('language_bottom');
}

if (themesflat_get_opt('show_bottom') == 1): ?> 
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-wrap">     
                    <div class="footer-bar-language">
                        <?php if ( $language_bottom == 1 && class_exists('woocommerce_wpml') ): ?>                       
                            <?php
                            $languages = icl_get_languages('skip_missing=0');
                            if(!empty($languages)){ ?>
                                <div class="tf-languages">
                                    <select class="tf-dropdown-select style-default type-languages">
                                        <?php foreach ( $languages as $language ) : ?>
                                            <option <?php echo esc_attr(($language['active'] == 1) ? 'selected' : ''); ?>>
                                                <?php echo esc_html($language['native_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php } ?>
                        <?php endif; ?>
                    </div>
                    <?php if ( themesflat_get_opt('copyright') != '' ): ?>
                        <p class="text-nocopy text-white">
                            <?php echo wp_kses_post( themesflat_get_opt('copyright') ); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<?php endif; ?>
