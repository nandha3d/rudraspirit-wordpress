<?php
if (class_exists('WP_Customize_Control')) {

    class IconBox_Repeater_Control extends WP_Customize_Control {
        public $type = 'repeater';

        public function render_content() {
            $json = json_decode($this->value(), true);
            $control_id = 'repeater-' . esc_attr($this->id);
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <div id="<?php echo esc_attr($control_id); ?>" class="repeater-container" data-type="iconbox1">
                    <ul class="repeater-list">
                        <?php if (!empty($json)) :
                            foreach ($json as $index => $item) : ?>
                                <li class="repeater-item tf-icon-box">
                                    <div class="box-title"><?php echo esc_html__('Icon Box ', 'vemus') . ($index + 1); ?></div>

                                    <fieldset>
                                        <label><?php esc_html_e('Icon', 'vemus'); ?></label>
                                        <textarea rows="3" placeholder="<?php esc_attr_e('Enter icon or svg', 'vemus'); ?>" class="tf-icon-field"><?php echo esc_textarea($item['icon']); ?></textarea>
                                    </fieldset>

                                    <fieldset>
                                        <label><?php esc_html_e('Title', 'vemus'); ?></label>
                                        <textarea rows="3" placeholder="<?php esc_attr_e('Title', 'vemus'); ?>" class="title-field"><?php echo esc_textarea($item['title']); ?></textarea>
                                    </fieldset>

                                    <button type="button" class="button-secondary remove-item"><?php esc_html_e('Remove Icon Box', 'vemus'); ?></button>
                                </li>
                            <?php endforeach;
                        endif; ?>
                    </ul>
                    <button type="button" class="button button-primary add-item"><?php esc_html_e('Add Icon Box', 'vemus'); ?></button>
                    <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" class="repeater-value" />

                    <script type="text/html" class="tmpl-repeater-item">
                        <li class="repeater-item tf-icon-box">
                            <div class="box-title"><?php esc_html_e('Icon Box', 'vemus'); ?></div>
                            <fieldset>
                                <label><?php esc_html_e('Icon', 'vemus'); ?></label>
                                <textarea rows="3" placeholder="<?php esc_attr_e('Enter icon or svg', 'vemus'); ?>" class="tf-icon-field"></textarea>
                            </fieldset>
                            <fieldset>
                                <label><?php esc_html_e('Title', 'vemus'); ?></label>
                                <textarea rows="3" placeholder="<?php esc_attr_e('Title', 'vemus'); ?>" class="title-field"></textarea>
                            </fieldset>
                            <button type="button" class="button-secondary remove-item"><?php esc_html_e('Remove Icon Box', 'vemus'); ?></button>
                        </li>
                    </script>
                </div>
            </label>
            <?php
        }
    }

    class IconBox2_Repeater_Control extends WP_Customize_Control {
        public $type = 'repeater';

        public function render_content() {
            $json = json_decode($this->value(), true);
            $control_id = 'repeater-' . esc_attr($this->id);
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <div id="<?php echo esc_attr($control_id); ?>" class="repeater-container" data-type="iconbox2">
                    <ul class="repeater-list">
                        <?php if (!empty($json)) :
                            foreach ($json as $index => $item) : ?>
                                <li class="repeater-item tf-icon-box">
                                    <div class="box-title"><?php echo esc_html__('Icon Box ', 'vemus') . ($index + 1); ?></div>

                                    <fieldset>
                                        <label><?php esc_html_e('Icon', 'vemus'); ?></label>
                                        <textarea rows="5" placeholder="<?php esc_attr_e('Enter icon or svg', 'vemus'); ?>" class="tf-icon-field"><?php echo esc_textarea($item['icon']); ?></textarea>
                                    </fieldset>

                                    <fieldset>
                                        <label><?php esc_html_e('Title', 'vemus'); ?></label>
                                        <textarea rows="3" placeholder="<?php esc_attr_e('Title', 'vemus'); ?>" class="title-field"><?php echo esc_textarea($item['title']); ?></textarea>
                                    </fieldset>

                                    <fieldset>
                                        <label><?php esc_html_e('Description', 'vemus'); ?></label>
                                        <textarea rows="5" placeholder="<?php esc_attr_e('Description', 'vemus'); ?>" class="description-field"><?php echo esc_textarea($item['description']); ?></textarea>
                                    </fieldset>

                                    <button type="button" class="button-secondary remove-item"><?php esc_html_e('Remove Icon Box', 'vemus'); ?></button>
                                </li>
                            <?php endforeach;
                        endif; ?>
                    </ul>
                    <button type="button" class="button button-primary add-item"><?php esc_html_e('Add Icon Box', 'vemus'); ?></button>
                    <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" class="repeater-value" />

                    <script type="text/html" class="tmpl-repeater-item">
                        <li class="repeater-item tf-icon-box">
                            <div class="box-title"><?php esc_html_e('Icon Box', 'vemus'); ?></div>
                            <fieldset>
                                <label><?php esc_html_e('Icon', 'vemus'); ?></label>
                                <textarea rows="5" placeholder="<?php esc_attr_e('Enter icon or svg', 'vemus'); ?>" class="tf-icon-field"></textarea>
                            </fieldset>
                            <fieldset>
                                <label><?php esc_html_e('Title', 'vemus'); ?></label>
                                <textarea rows="3" placeholder="<?php esc_attr_e('Title', 'vemus'); ?>" class="title-field"></textarea>
                            </fieldset>
                            <fieldset>
                                <label><?php esc_html_e('Description', 'vemus'); ?></label>
                                <textarea rows="5" placeholder="<?php esc_attr_e('Description', 'vemus'); ?>" class="description-field"></textarea>
                            </fieldset>
                            <button type="button" class="button-secondary remove-item"><?php esc_html_e('Remove Icon Box', 'vemus'); ?></button>
                        </li>
                    </script>
                </div>
            </label>
            <?php
        }
    }
}
