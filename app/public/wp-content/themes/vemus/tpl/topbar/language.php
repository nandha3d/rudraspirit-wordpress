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
                                <?php }; ?>  