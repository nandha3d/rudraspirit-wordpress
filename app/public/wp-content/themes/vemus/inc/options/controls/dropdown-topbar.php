<?php
/**
 * Select control
 */
if (class_exists('WP_Customize_Control')) {
    class Themesflat_Repeater_Select extends WP_Customize_Control {
        public $type = 'repeater_select';
        public $choices = array();

        public function render_content() {
            // unique container id for this control instance
            $container_id = 'themesflat-repeater-' . $this->id;

            // accept both JSON string or array stored by sanitize callback
            $raw = $this->value();
            if (is_string($raw)) {
                $values = json_decode($raw, true);
            } elseif (is_array($raw)) {
                $values = $raw;
            } else {
                $values = array();
            }
            if (!is_array($values)) {
                $values = array();
            }
            ?>
                <div id="<?php echo esc_attr($container_id); ?>" class="themesflat-repeater-select" data-control="<?php echo esc_attr($this->id); ?>">
                    <label class="customize-control-title"><?php echo esc_html($this->label); ?></label>

                    <div class="repeater-items sortable-list">
                        <?php if (!empty($values)): ?>
                            <?php foreach ($values as $val): ?>
                                <div class="repeater-item">
                                    <span class="dashicons dashicons-move handle"></span>
                                    <select class="repeater-select">
                                        <?php foreach ($this->choices as $key => $label): ?>
                                            <option value="<?php echo esc_attr($key); ?>" <?php selected($val, $key); ?>><?php echo esc_html($label); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="button" class="button remove-item">X</button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <button type="button" class="button add-item"><?php esc_html_e('Add New', 'vemus'); ?></button>
                    <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(json_encode($values)); ?>" class="repeater-hidden" />

                    <script type="text/html" class="tmpl-repeater-item">
                        <div class="repeater-item">
                            <span class="dashicons dashicons-move handle"></span>
                            <select class="repeater-select">
                                <?php foreach ($this->choices as $key => $label): ?>
                                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="button remove-item">X</button>
                        </div>
                    </script>
                </div>



            <?php
        }
    }
}

