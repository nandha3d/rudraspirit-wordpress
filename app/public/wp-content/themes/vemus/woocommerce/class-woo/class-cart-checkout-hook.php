<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!class_exists('TFWC_Cart_Checkout')) {
	class TFWC_Cart_Checkout
	{
		public function __construct() {
			if( is_admin() ) {				
				add_action('init', array($this, 'actions'), 10);
				add_filter( 'woocommerce_update_cart_action_cart_updated', array( $this, 'tf_save_extra_cart_fields') );
			} else {				
				add_action('wp', array($this, 'actions'), 10 );
				add_filter( 'woocommerce_update_cart_action_cart_updated', array( $this, 'tf_save_extra_cart_fields') );			
			}

		}
	
		public function actions(){	
			// Page Cart
			add_action( 'woocommerce_before_cart_totals', array($this, 'tfwc_start_form_total' ) );
			add_action( 'woocommerce_after_cart_totals', array($this, 'tfwc_cart_total_extra' ) );
			add_action( 'woocommerce_after_cart_totals', array($this, 'tfwc_end_form_total' ) );
			add_action( 'tf_after_cart_collaterals', array($this, 'tfwc_testimonial' ),10 );


			// add_action( 'woocommerce_after_cart_table', array( $this, 'tfwc_note_form' ) );
			// add_action( 'woocommerce_after_cart_table', array( $this, 'tfwc_icon_box' ),10 );
			add_action( 'woocommerce_after_cart', array( $this, 'tfwc_get_related' ),10 );

			// Page Checkout
			if ( is_checkout() ) {
				// add_filter('woocommerce_checkout_fields', array( $this,'tfwc_checkout_fields'));
				add_filter('woocommerce_form_field', array( $this,'tfwc_checkout_fieldset'), 10, 4);

				add_filter('woocommerce_thankyou_order_received_text', function($text, $order){
					return __('THANK YOU FOR YOUR ORDER!', 'vemus');
				},10, 2);

				add_action('woocommerce_after_thankyou_order_received_text', function(){
					?>
						<p class="sub-title">
							<?php _e('You are awesome, Vemus! Thank you so much for your purchase.', 'vemus' ); ?>
						</p>
					<?php
				});
			}

			add_action('tf_after_order_details' , array($this, 'give_feedback') );
	
		}

		public function tfwc_get_related(){
			if(themesflat_get_opt('related_display') == 1) {
				global $product;
				if( empty($product) ){
					$cart = WC()->cart->get_cart();
					if (!empty($cart)) {
						$cart_item = reset($cart);
						$product_id = $cart_item['product_id'];
						$product = wc_get_product($product_id);
					} else {
						return;
					}
				}
				wc_get_template( 'tpl/product-single/related.php' );
			}
		}

		public function tfwc_enqueue_woo_scripts()
		{	
			
		}

		public function tf_save_extra_cart_fields($cart_updated){
			if ( ! isset( $_POST['woocommerce-cart-nonce'] ) || ! wp_verify_nonce( $_POST['woocommerce-cart-nonce'], 'woocommerce-cart' ) || empty( $_POST['update_cart'] ) ) {
				return $cart_updated;
			}
		
			if ( isset( $_POST['order_comments'] ) ) {
				WC()->session->set( 'tfwc_order_note', sanitize_text_field( $_POST['order_comments'] ) );
			}

			if ( isset( $_POST['add_gift'] ) ) {
				WC()->session->set('tfwc_gift', true);
			} else {
				WC()->session->__unset('tfwc_gift'); 
			}

			return $cart_updated;
		}

		public function give_feedback(){
			?>
			<div class="feedback-sidebar s-wrap">
				<h4 class="checkout-title"><?php _e('GIVE US A FEEDBACK', 'vemus' ); ?></h4>
				<p class="checkout-subtitle">
				<?php _e('Let us know what you think about the shopping experience, and get a gift coupon for the next shopping.', 'vemus' ); ?>
				</p>
				<form class="form-feedback style-border">
					<div class="form-content-2 mb_32">
						<fieldset class="tf-field-2">
							<input class="tf-input" type="text" id="name" required="">
							<label class="tf-lable"><?php _e('Name*', 'vemus' ); ?></label>
						</fieldset>
						<fieldset class="tf-field-2">
							<input class="tf-input" type="email" id="email" required="">
							<label class="tf-lable"><?php _e('Email*', 'vemus' ); ?></label>
						</fieldset>
						<div class="check-wrapper">
							<p class="text-main-6"><?php _e('How was your experience?', 'vemus' ); ?></p>
							<div class="check-wrap-list">
								<div class="checkbox-wrap type-2">
									<input type="radio" id="exp-1y" class="tf-check-rounded" name="checkshipping" checked="">
									<label for="exp-1y">1</label>
								</div>
								<div class="checkbox-wrap type-2">
									<input type="radio" id="exp-2y" class="tf-check-rounded" name="checkshipping">
									<label for="exp-2y">2</label>
								</div>
								<div class="checkbox-wrap type-2">
									<input type="radio" id="exp-3y" class="tf-check-rounded" name="checkshipping">
									<label for="exp-3y">3</label>
								</div>
								<div class="checkbox-wrap type-2">
									<input type="radio" id="exp-4y" class="tf-check-rounded" name="checkshipping">
									<label for="exp-4y">4</label>
								</div>
								<div class="checkbox-wrap type-2">
									<input type="radio" id="exp-5y" class="tf-check-rounded" name="checkshipping">
									<label for="exp-5y">5</label>
								</div>
							</div>
						</div>
						<fieldset class="tf-field-2">
							<textarea class="tf-input d-flex" id="desc" style="<?php echo esc_attr('height: 139px;'); ?>"></textarea>
							<label class="tf-lable type-2"><?php _e('Share your exprience...', 'vemus' ); ?></label>
						</fieldset>
					</div>
					<button class="tf-btn btn-fill fw-medium animate-btn w-100">
					<?php _e('SEND', 'vemus' ); ?>
					</button>
				</form>
				<h4 class="checkout-title"><?php _e('SHARE THE LOVE', 'vemus' ); ?></h4>
				<ul class="tf-social-icon style-large">
					<li>
						<a href="https://www.facebook.com/" target="_blank" class="social-facebook">
							<span class="icon"><i class="icon-facebook"></i></span>
						</a>
					</li>
					<li>
						<a href="https://www.instagram.com/" target="_blank" class="social-instagram">
							<span class="icon"><i class="icon-instagram"></i></span>
						</a>
					</li>
					<li>
						<a href="https://x.com/" target="_blank" class="social-x">
							<span class="icon"><i class="icon-x"></i></span>
						</a>
					</li>
					<li>
						<a href="https://www.snapchat.com/" target="_blank" class="social-snapchat">
							<span class="icon"><i class="icon-snapchat"></i></span>
						</a>
					</li>
				</ul>
			</div>
			<?php
		}

		public function tfwc_cart_total_extra() {
			if (themesflat_get_opt('cart_form_extra') == 1):     
				?> 
				<div class="cart-imgtrust">
					<p class="text-caption text-center text-we-accept"><?php echo themesflat_get_opt('cart_form_extra_heading')?></p>
					<div class="paymend-method-list justify-content-center">
						<?php
						$cart_form_extra = explode(',', themesflat_get_opt('cart_form_extra_img')); 
						if (!empty($cart_form_extra[0])) {
							foreach ($cart_form_extra as $image) {
								echo '<div class="payment-card"><img src="'.esc_attr($image).'" alt="'.esc_html__("payment",'vemus').'"></div>';
							}
						}                                
						?>
					</div>
				</div>
				
			<?php endif; 
		}
		
		public function tfwc_note_form() {
			$tfwc_order_note = WC()->session->get('tfwc_order_note', '');
			?>
			<div class="cart-note">
				<label for="note" class="text-md fw-medium"><?php echo esc_html__( 'Special instructions for seller', 'vemus' )?></label>
				<textarea id="note" name="order_comments" class="input-text" rows="4" cols="5"><?php echo esc_html($tfwc_order_note); ?></textarea>
			</div>
			<?php
		}

		public function tfwc_start_form_total() { ?>
			<div class="cart-box checkout-cart-box">
		<?php
		}
		public function tfwc_end_form_total() { ?>
			</div>
		<?php
		}

		public function tfwc_icon_box() { ?>
		<?php if(themesflat_get_opt('cart_iconbox') == 1) {?>
			<div class="fl-iconbox wow fadeInUp">
				<div dir="" class="swiper tf-swiper tfwc-slider sw-auto" data-swiper='{
					"slidesPerView": 1,
					"spaceBetween": 12,
					"speed": 800,
					"observer": true,
					"observeParents": true,
					"slidesPerGroup": 1,
					"pagination": { "el": ".sw-pagination-iconbox", "clickable": true },
					"breakpoints": {
						"575": { "slidesPerView": 2, "spaceBetween": 12, "slidesPerGroup": 2}, 
						"768": { "slidesPerView": 3, "spaceBetween": 24, "slidesPerGroup": 3},
						"1200": { "slidesPerView": "auto", "spaceBetween": 24}
					}
				}'>
					<div class="swiper-wrapper">
						

						<?php
							$icon_boxes = json_decode(themesflat_get_opt('icon_boxes'), true);

							if (!empty($icon_boxes)) :
								foreach ($icon_boxes as $box) : ?>
								<div class="swiper-slide">
									<div class="tf-icon-box justify-content-center justify-content-sm-start style-3">
										<div class="box-icon">
											<?php echo wp_kses_post($box['icon']); ?>
										</div>
										<div class="content">
											<div class="title text-uppercase"><?php echo esc_html($box['title']); ?></div>
										</div>
									</div>
								</div>
								<?php endforeach;
							endif;
							?>							
					</div>

				</div>
				<div
					class="d-flex d-xl-none sw-dot-default sw-pagination-iconbox justify-content-center">
				</div>
			</div>
			<?php
			}
		}

		public function tfwc_testimonial() { ?>
			<?php if(themesflat_get_opt('cart_testi') == 1) {?> 
				<div class="cart-box testimonial-cart-box">
					<div dir="" class="swiper tf-swiper tfwc-slider" data-swiper='{
						"slidesPerView": 1,
						"spaceBetween": 12,
						"speed": 800,
						"pagination": { "el": ".sw-pagination-iconbox", "clickable": true },
						"navigation": {
							"clickable": true,
							"nextEl": ".nav-next-tes",
							"prevEl": ".nav-prev-tes"
						}
						}'>
						<div class="swiper-wrapper">
						<?php
						$testimonials = themesflat_get_opt('testimonial_boxes');
						$testimonials = json_decode($testimonials, true);

						if (!empty($testimonials)) {
							foreach ($testimonials as $testimonial) {
								?>
								<div class="swiper-slide">
									<div class="box-testimonial-main">
										<?php echo wp_kses_post($testimonial['quote']); ?>
										<div class="content">
											<div class="list-star-default">
												<?php
												for ($i = 1; $i <= 5; $i++) {
													if ($i <= $testimonial['stars']) {
														echo '<i class="icon-star"></i>';
													} else {
														echo '<i class="icon-star" style="color:#ccc;"></i>'; 
													}
												}
												?>
											</div>

											<p class="text-review text-md text-main"><?php echo esc_html($testimonial['review']); ?></p>
											<div class="box-author">
												<div class="img">
													<img src="<?php echo esc_url($testimonial['image']); ?>" alt="author">
												</div>
												<span class="name text-sm fw-medium"><?php echo esc_html($testimonial['name']); ?></span>
											</div>
										</div>
									</div>
								</div>	
								<?php
								}	
							}	
						?>			
						</div>
						<div class="box-nav-swiper">
							<div class="swiper-button-prev nav-swiper nav-prev-tes"></div>
							<div class="swiper-button-next nav-swiper nav-next-tes"></div>
						</div>
					</div>
				</div>
			<?php
			}
		}

		public function vemus_testimonial() { ?>
			<?php if(themesflat_get_opt('cart_testi') == 1) {?>

				<div class="tes-slider tf-btn-swiper-item">
					<div dir="ltr" class="swiper tf-swiper vemus-swiper" data-space-lg="30" data-space-md="20" data-space="15">
						<div class="swiper-wrapper">

						<?php
						$testimonials = themesflat_get_opt('testimonial_boxes');
						$testimonials = json_decode($testimonials, true);

						if (!empty($testimonials)) {
							foreach ($testimonials as $testimonial) : ?>
							<div class="swiper-slide">
								<div class="box_testimonial--V04">
									<div class="tes-top">
										<?php echo wp_kses_post($testimonial['quote']); ?>
										<ul class="rate-wrap">
											<?php
												for ($i = 1; $i <= 5; $i++) {
													if ($i <= $testimonial['stars']) {
														echo '<i class="icon-star full"></i>';
													} else {
														echo '<i class="icon-star" style="color:#ccc;"></i>'; 
													}
												}
											?>
										</ul>
									</div>
									<p class="tes-text">
										<?php echo esc_html($testimonial['review']); ?>
									</p>
									<div class="tes-author">
										<div class="author-avt">
											<img src="<?php echo esc_url($testimonial['image']); ?>" alt="">
										</div>
										<span class="author-name fw-medium"><?php echo esc_html($testimonial['name']); ?></span>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						<?php } ?>
						</div>
						<div class="group-btn-slider">
							<i class="tf-sw-nav icon-arrow-left nav-prev-swiper"></i>
							<i class="tf-sw-nav icon-arrow-right nav-next-swiper"></i>
						</div>
					</div>
				</div>
			<?php
			}
		}

		public function tfwc_checkout_fields($fields) {
			$fields['billing']['billing_first_name'] = array(
				'label'         => 'First name',
				'placeholder'   => ' ',
				'required'      => true,
				'class'         => array('tf-field style-2 style-3 mb_16'),
				'input_class'   => array('tf-field-input tf-input'),
				'id'            => 'firstname',
			);
		
			$fields['billing']['billing_last_name'] = array(
				'label'         => 'Last name',
				'placeholder'   => ' ',
				'required'      => true,
				'class'         => array('tf-field style-2 style-3 mb_16'),
				'input_class'   => array('tf-field-input tf-input'),
				'id'            => 'lastname',
			);
		
			$fields['billing']['billing_country'] = array(
				'label'         => 'Country',
				'placeholder'   => ' ',
				'required'      => true,
				'class'         => array('tf-field style-2 style-3 mb_16'),
				'input_class'   => array('tf-field-input tf-input'),
				'id'            => 'country',
			);
		
			$fields['billing']['billing_address_1'] = array(
				'label'         => 'Address',
				'placeholder'   => ' ',
				'required'      => true,
				'class'         => array('tf-field style-2 style-3 mb_16'),
				'input_class'   => array('tf-field-input tf-input'),
				'id'            => 'address',
			);
		
			$fields['billing']['billing_address_2'] = array(
				'label'         => '',
				'placeholder'   => 'Apartment, suite, etc (optional)',
				'required'      => false,
				'class'         => array('mb_16'),
				'input_class'   => array('style-2'),
				'id'            => 'apartment',
			);
		
			$fields['billing']['billing_city'] = array(
				'label'         => 'City',
				'placeholder'   => ' ',
				'required'      => true,
				'class'         => array('tf-field style-2 style-3'),
				'input_class'   => array('tf-field-input tf-input'),
				'id'            => 'city',
			);

			$fields['billing']['billing_state'] = array(
				'type'     => 'state', 
				'label'    => 'State',
				'required' => true,
				'class'    => array('tf-select select-square mb_16'),
				'id'       => 'state',
			);
		
			$fields['billing']['billing_postcode'] = array(
				'label'         => 'Zipcode/Postal',
				'placeholder'   => ' ',
				'required'      => true,
				'class'         => array('tf-field style-2 style-3 mb_16'),
				'input_class'   => array('tf-field-input tf-input'),
				'id'            => 'code',
			);
		
			$fields['billing']['billing_phone'] = array(
				'label'         => 'Phone',
				'placeholder'   => ' ',
				'required'      => true,
				'class'         => array('tf-field style-2 style-3 mb_16'),
				'input_class'   => array('tf-field-input tf-input'),
				'id'            => 'phone',
			);
		
			return $fields;
		}
		
		public function tfwc_checkout_fieldset($field, $key, $args, $value) {
			if (!empty($args['label'])) {
				$field = str_replace('<label', '<label class="tf-field-label"', $field);
			}

			if (in_array($args['type'], ['text', 'email', 'tel', 'password'])) {
				$required      = $args['required'] ? 'aria-required="true"' : '';
				$placeholder   = isset($args['placeholder']) ? $args['placeholder'] : '';
				$id            = esc_attr($key);
				$label         = !empty($args['label']) ? '<label class="tf-field-label tf-lable" for="' . $id . '">' . esc_html($args['label']) . '</label>' : '';
		
				$field = sprintf(
					'<fieldset class="tf-field-2">
						<input class="tf-field-input tf-input" id="%s" type="%s" name="%s" placeholder="%s" value="%s" %s>
						%s
					</fieldset>',
					$id,
					esc_attr($args['type']),
					esc_attr($key),
					esc_attr($placeholder),
					esc_attr($value),
					$required,
					$label
				);
			}
		
			if ($args['type'] === 'select') {
				$options_html = '';
				foreach ($args['options'] as $option_value => $option_label) {
					$selected = selected($value, $option_value, false);
					$options_html .= sprintf('<option value="%s" %s>%s</option>', esc_attr($option_value), $selected, esc_html($option_label));
				}
		
				$field = sprintf(
					'<div class="tf-select select-square mb_16">
						<select name="%s" id="%s">%s</select>
					</div>',
					esc_attr($key),
					esc_attr($key),
					$options_html
				);
			}
			return $field;
		}

	}		
}