            <?php 
                $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src(
                    $settings['slider_image']['id'],
                    'image_size',
                    $settings
                );
            ?>	
            <div class="d-flex">
                <div class="box_image--V01 style-2 hover-img widget-image-box">
                    <?php if ( $image_url ) : ?>
                        <div class="image img-style">
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="Image">
                        </div>
                    <?php else: ?>
                        <div class="image img-style">
                            <img src="<?php echo TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg"; ?>" alt="Image">
                        </div>
                    <?php endif; ?>
                    <div class="content wow fadeInUp animated">
                        <?php if ( $settings['title'] ) : ?>
                            <h3 class="title">
                                <?php echo wp_kses_post($settings['title']); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ( $settings['button_text'] ) : ?>
                                <a href="<?php echo esc_attr($settings['link_button']['url']); ?>" class="tf-btn-line gap-10">
                                    <span class="h5"><?php echo wp_kses_post( $settings['button_text'] ); ?></span>
                                    <i class="icon-arrow-top-right"></i>
                                </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>