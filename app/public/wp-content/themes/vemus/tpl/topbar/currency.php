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
                                <?php }; ?> 