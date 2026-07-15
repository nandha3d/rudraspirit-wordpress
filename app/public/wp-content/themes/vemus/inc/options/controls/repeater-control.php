<?php
if (class_exists('WP_Customize_Control')) {
    class Themesflat_Repeater_Controls extends WP_Customize_Control {
        public $type = 'repeater-controls';

        public function render_content() {
            $id = 'themesflat-options-control-' . $this->id;
            $class = 'themesflat-options-control themesflat-options-control-' . $this->type;

            if ($this->value()) {
                $this->class = 'active';
            }

            if (!empty($this->class)) {
                $class .= " {$this->class}";
            }

            if (empty($this->label)) {
                $class .= ' no-label';
            }

            $json = json_decode($this->value(), true);
            ?>
            <li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
                <h6 class="themesflat-options-control-title themesflat-title-option">
                    <?php echo esc_html($this->label); ?>
                </h6>

                <div class="repeater-items-<?php echo esc_attr($this->id); ?>">
                    <ul class="repeater-list">
                        <?php if (!empty($json)) :
                            foreach ($json as $index => $item) :
                                $text = isset($item['text']) ? $item['text'] : '';
                                $link = isset($item['link']) ? $item['link'] : '';
                                ?>
                                <li class="repeater-item">
                                    <label><?php echo esc_html__('Item ', 'vemus') . ($index + 1); ?></label>
                                    <textarea class="repeater-textarea" placeholder="<?php esc_attr_e('Enter text...', 'vemus'); ?>"><?php echo esc_textarea($text); ?></textarea>
                                    <input type="text" class="repeater-link" value="<?php echo esc_attr($link); ?>" placeholder="<?php esc_attr_e('Enter link...', 'vemus'); ?>" />
                                    <button type="button" class="button-secondary remove-repeater-item"><?php esc_html_e('Remove', 'vemus'); ?></button>
                                </li>
                            <?php endforeach;
                        endif; ?>
                    </ul>

                    <button type="button" class="button-secondary add-repeater-field"><?php esc_html_e('Add New Item', 'vemus'); ?></button>
                    <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" class="repeater-hidden-field" />

                    <script type="text/html" class="tmpl-repeater-item">
                        <li class="repeater-item">
                            <label><?php esc_html_e('Item', 'vemus'); ?></label>
                            <textarea class="repeater-textarea" placeholder="<?php esc_attr_e('Enter text...', 'vemus'); ?>"></textarea>
                            <input type="text" class="repeater-link" placeholder="<?php esc_attr_e('Enter link...', 'vemus'); ?>" />
                            <button type="button" class="button-secondary remove-repeater-item"><?php esc_html_e('Remove', 'vemus'); ?></button>
                        </li>
                    </script>
                </div>
            </li>
            <?php
        }
    }
}
