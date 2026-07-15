<?php
if (class_exists('WP_Customize_Control')) {
    class Testimonial_Repeater_Control extends WP_Customize_Control {
        public $type = 'repeater';

        public function render_content() {
            $json = json_decode($this->value(), true);
            $control_id = 'repeater-' . esc_attr($this->id);
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <div id="<?php echo esc_attr($control_id); ?>" class="repeater-container">
                    <ul class="repeater-list testimonial-list">
                        <?php if (!empty($json)) :
                            foreach ($json as $index => $item) : ?>
                                <li class="repeater-item testimonial-box">
                                    <div class="box-title"> <?php echo esc_html__('Testimonial ','vemus') . ($index + 1); ?></div>
                                    <textarea rows="2" placeholder="Enter icon or svg quote" class="quote-field"><?php echo esc_textarea($item['quote']); ?></textarea>
                                    <textarea rows="5" placeholder="Review" class="review-field"><?php echo esc_textarea($item['review']); ?></textarea>
                                    <input type="text" placeholder="Name" class="name-field" value="<?php echo esc_attr($item['name']); ?>" />
                                    <input type="number" placeholder="Stars (ex: 1)" class="stars-field" value="<?php echo esc_attr($item['stars']); ?>" />
                                    
                                    <!-- Image Upload -->
                                    <div class="image-upload-container">
                                        <div class="image-preview">
                                            <?php if (!empty($item['image'])): ?>
                                                <img src="<?php echo esc_url($item['image']); ?>" alt="image" class="image-preview-src">
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="image-url" value="<?php echo esc_url($item['image']); ?>" />
                                        <button class="upload-image button"><?php _e('Upload Image', 'vemus'); ?></button>
                                        <button class="remove-image button" style="display: <?php echo !empty($item['image']) ? 'inline-block' : 'none'; ?>;"><?php _e('Remove Image', 'vemus'); ?></button>
                                    </div>

                                    <button class="remove-item"><?php _e('Remove Testimonial','vemus'); ?></button>
                                </li>
                            <?php endforeach;
                        endif; ?>
                    </ul>
                    <button class="add-item button button-primary"><?php _e('Add Testimonial', 'vemus'); ?></button>
                    <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" class="repeater-value testimonial-value" />
                </div>
            </label>

            <script>
                (function($) {
                    $(document).ready(function() {
                        var container = $('#<?php echo esc_attr($control_id); ?>');

                        function updateBoxTitles() {
                            container.find('.testimonial-list .testimonial-box').each(function(index) {
                                $(this).find('.box-title').text('Testimonial ' + (index + 1));
                            });
                        }

                        // Upload Image
                        container.on('click', '.upload-image', function(e) {
                            e.preventDefault();
                            var button = $(this);
                            var imageField = button.siblings('.image-url');
                            var preview = button.siblings('.image-preview');
                            var removeButton = button.siblings('.remove-image');

                            var mediaUploader = wp.media({
                                title: '<?php _e("Choose Image", "vemus"); ?>',
                                button: { text: '<?php _e("Use this Image", "vemus"); ?>' },
                                multiple: false
                            }).on('select', function() {
                                var attachment = mediaUploader.state().get('selection').first().toJSON();
                                imageField.val(attachment.url);
                                preview.html('<img src="'+attachment.url+'" style="max-width:100px; height:auto;">');
                                removeButton.show();
                                updateRepeaterValue();
                            }).open();
                        });

                        // Remove Image
                        container.on('click', '.remove-image', function(e) {
                            e.preventDefault();
                            var button = $(this);
                            var preview = button.siblings('.image-preview');
                            var imageField = button.siblings('.image-url');

                            preview.html('');
                            imageField.val('');
                            button.hide();
                            updateRepeaterValue();
                        });

                        // Add New Item
                        container.on('click', '.add-item', function(e) {
                            e.preventDefault();
                            var newItem = $('<li class="repeater-item testimonial-box">' +
                                '<div class="box-title"></div>' +
                                '<textarea placeholder="Enter icon or svg quote" class="quote-field"></textarea>' +
                                '<textarea placeholder="Review" class="review-field"></textarea>' +
                                '<input type="text" placeholder="Name" class="name-field" />' +
                                '<input type="number" placeholder="Stars (ex: 1)" class="stars-field" />' +
                                '<div class="image-upload-container">' +
                                    '<div class="image-preview"></div>' +
                                    '<input type="hidden" class="image-url" />' +
                                    '<button class="upload-image button"><?php _e("Upload Image", "vemus"); ?></button>' +
                                    '<button class="remove-image button" style="display: none;"><?php _e("Remove Image", "vemus"); ?></button>' +
                                '</div>' +
                                '<button class="remove-item"><?php _e("Remove Testimonial","vemus"); ?></button>' +
                                '</li>');
                            container.find('.testimonial-list').append(newItem);
                            updateBoxTitles();
                            updateRepeaterValue();
                        });
                        

                        // Remove Item
                        container.on('click', '.remove-item', function(e) {
                            e.preventDefault();
                            $(this).parent().remove();
                            updateBoxTitles();
                            updateRepeaterValue();
                        });

                        container.on('input', 'textarea, input', function() {
                            updateRepeaterValue();
                        });

                        // Update JSON Value
                        function updateRepeaterValue() {
                            var items = [];
                            container.find('.testimonial-list .testimonial-box').each(function() {
                                var quote = $(this).find('.quote-field').val();
                                var review = $(this).find('.review-field').val();
                                var name = $(this).find('.name-field').val();
                                var stars = $(this).find('.stars-field').val();
                                var image = $(this).find('.image-url').val();

                                items.push({ quote: quote, review: review, name: name,  image: image , stars: stars});
                                
                            });
                            container.find('.testimonial-value').val(JSON.stringify(items)).trigger('change');
                        }

                        updateBoxTitles();
                    });
                })(jQuery);
            </script>

            <?php
        }
    }
}

