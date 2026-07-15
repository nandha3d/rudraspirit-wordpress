        <!-- Banner Testimonial -->
        <section class="flat-spacing-3 widget-testimonial">
            <div class="tf-sw-thumbs tes_thumb-V02 wow fadeInUp">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-md-6">
                            <div dir="ltr" class="swiper sw-thumb mb-md-0">
                                <div class="swiper-wrapper">

                                	<?php foreach ($settings['carousel_list'] as $carousel): 
                                        $product = wc_get_product($carousel['product_id']); 
                                    ?>

                                    <div class="swiper-slide">
                                        <div class="card_product--V03 style_2 hover-img">
                                            <div class="card_product-wrapper img-style">
                                                 <img src="<?php echo esc_attr($carousel['product_image']['url']) ?>" alt="thumbnail">
                                            </div>
                                            <?php if($product): ?>
                                                <div class="card_product-info">
                                                    <div class="infor">
                                                        <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="img-prd">
                                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id())); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                                        </a>
                                                        <div class="info-product">
                                                            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="product-name name h5 fw-normal link text-line-clamp-2">
                                                                <?php echo esc_html($product->get_name()); ?>
                                                            </a>
                                                            <div class="price-wrap">
                                                                <span class="price-new h5 price-product"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="tf-btn btn-def text-main link">
                                                        <i class="icon_2 icon-arrow-right-2"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php endforeach;?>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-md-6 align-items-center d-flex">
                            <div dir="ltr" class="swiper sw-main-thumb">
                                <div class="swiper-wrapper">
                                	<?php foreach ($settings['carousel_list'] as $carousel): ?>
                                        <div class="swiper-slide">
                                            <div class="box_testimonial--V03">
                                                <div class="icon">
                                                    <svg width="63" height="64" viewBox="0 0 63 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M46.9854 39.4871H62.5V10.4199H33.9026V39.7565L51.7302 54.9673V51.0175L46.5347 40.2037L46.1905 39.4871H46.9854Z"
                                                            stroke="#1C1C1C" />
                                                        <path
                                                            d="M11.168 39.4873H23.6611V16.0918H0.648682V39.7566L14.9243 51.9358V48.9588L10.7173 40.2039L10.373 39.4873H11.168Z"
                                                            stroke="#1C1C1C" />
                                                    </svg>
                                                </div>
                                                <?php if ( $carousel['title'] ) : ?>
                                                    <h2 class="title"><?php echo wp_kses_post( $carousel['title'] ); ?></h2>
                                                <?php endif; ?>
                                                <?php if ( $carousel['description'] ) : ?>
                                                    <p class="text h4 description">
                                                        <?php echo wp_kses_post( $carousel['description'] ); ?>
                                                    </p>
                                                <?php endif; ?>
                                                <span class="br-line"></span>
                                                <div class="tes-author">
                                                    <?php if ( $carousel['avatar']['url'] ) : ?>
                                                        <div class="avatar">
                                                            <img src="<?php echo esc_attr($carousel['avatar']['url']) ?>" alt="avatar">
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="fw-medium text-uppercase name-author">patrick john</div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                          
                                </div>

                                <?php if ( $settings['bullet_enable'] == 'yes' ) : ?>
                                    <div class="sw-dot-default sw-pg-thumb"></div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Banner Testimonial -->