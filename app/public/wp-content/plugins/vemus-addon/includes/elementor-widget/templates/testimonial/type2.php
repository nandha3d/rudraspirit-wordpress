        <!-- Testimonial -->
        <div class="flat-spacing-5 bg-linear widget-testimonial">
            <div class="container">
                <div class="tf-sw-thumbs tes_thumb">
                    <div class="swiper sw-thumb sw-tes-thumb">
                        <div class="swiper-wrapper">

                            <?php foreach ($settings['carousel_list2'] as $carousel): 
                                    $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src(
                                        $carousel['thumbnail_type2']['id'],
                                        'image_size',
                                        $settings
                                    );
                                ?>

                                <div class="swiper-slide">
                                    <div class="image">
                                        <?php if ( $image_url ) : ?>
                                            <img src="<?php echo esc_url( $image_url ); ?>" alt="Image">
                                        <?php else: ?>
                                            <img src="<?php echo TF_PLUGIN_URL."includes/elementor-widget/assets/images/slider-1.jpg"; ?>" alt="Image">
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php endforeach;?>
                       
                        </div>
                    </div>
                    <div class="swiper sw-main-thumb sw-tes">
                        <div class="swiper-wrapper">
                       
                            <?php foreach ($settings['carousel_list2'] as $carousel): ?>
                                <div class="swiper-slide">
                                    <?php if ( $carousel['description2'] ) : ?>
                                        <h3 class="tes-text description"><?php echo wp_kses_post( $carousel['description2'] ); ?></h3>
                                    <?php endif; ?>
                                    <div class="tes-author">
                                        <?php if ( $carousel['name2'] ) : ?>
                                            <h5 class="name"><?php echo wp_kses_post( $carousel['name2'] ); ?></h5>
                                        <?php endif; ?>
                                        <?php if ( $carousel['position2'] ) : ?>
                                            <p class="duty"><?php echo wp_kses_post( $carousel['position2'] ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach;?>
                           

                        </div>
                        <?php if ( $settings['arrow_enable'] == 'yes' ) : ?>
                            <div class="sw-group-pagination">
                                <div class="pagination-tes prev-thumb">
                                    <i class="icon-arrow-left"></i>
                                </div>
                                <div class="pagination-tes next-thumb">
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Testimonial -->