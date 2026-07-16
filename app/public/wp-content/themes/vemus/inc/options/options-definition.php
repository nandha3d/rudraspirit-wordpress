<?php
/**
 * Return the default options of the theme
 * 
 * @return  void
 */

function themesflat_customize_default($key) {
	$default = array(
		'social_links'	=> array ("facebook" => '#', "instagram" => '#' ,"twitter" => '#', "snapchat" => '#' ),
		'show_social_share' => 1,		
		'social_footer' => 0,
		'go_top' => 1,
		'topbar_fullwidth' => 0,
		'topbar_background_color'	=> '',
		'topbar_textcolor'	=> '',
		'topbar_link_color' => '',
		'topbar_link_color_hover' => '',
		'countdown_end_date' => '2025-12-14',
		'topbar_label_text' => 'FREE STANDARD DELIVERY FOR ALL ORDERS OVER $200',
		'topbar_show' => 0,
		'topbar_swiper_fields' => json_encode([
			['text' => 'FREE STANDARD DELIVERY FOR ALL ORDERS OVER $200', 'btn_text' => 'Shop Now', 'link' => '#'],
			['text' => 'COMPLIMENTARY SHIPPING ON ORDERS ABOVE $200', 'btn_text' => 'Shop Now', 'link' => '#'],
		]),
		'topbar_marquee_arr' => json_encode([
			['text' => 'Return extended to 60 days', 'link' => '#'],
			['text' => 'Life-time Guarantee', 'link' => '#'],
			['text' => 'Fast delivery worldwide', 'link' => '#'],
		]),

		'show_announcement' => 0,
		'show_announcement_mobile' => 0,
		'announcement_topbar_style' => 'style-marquee',

		'language_header' => 1,
		'currency_header' => 1,

		'topbar_button_text' => 'SHOP NOW',
		'topbar_button_url' => '#',

		'ship_header' => 1,

		'typography_topbar' => array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '',
			'line_height'=>'',
			'letter_spacing' => '',
		),
		'typography_announcement' => array(
			'family' => 'Jost',
			'style'  => '500',
			'size'   => '',
			'line_height'=>'',
			'letter_spacing' => '',
		),
		'announcement_background_color' => '',
		'announcement_textcolor' => '',
		'announcement_link_color' => '',
		'announcement_link_color_hover' => '',

		'topbar_controls' => array(''),
		'topbar_height' => array(
			'desktop' => '',
			'tablet'  => '',
			'mobile'  => '',
		),
		
		'information_phone' => '(61) 8533 2453',
		'information_address' => 'Our Store',
		'information_heading' => 'Support 24/7',
		'information_email' => 'infor@gmail.com',


		'logo_controls' => array('padding-top' => '','padding-bottom' => ''),
		'style_header'	=> 'header-default',	
		'header_backgroundcolor'=>'',
		'header_sticky' => 1,
		
		'header_content_right' => '',
		'header_absolute'	=> 0,		
		
		'header_mb_heading' => 'Need Help?',
		'header_phone_label' => 'Phone:',
		'header_phone' => '1.888.838.3022',
		'header_email_label' => 'Email:',
		'header_email' => 'clientcare@ecom.com',
		'header_address_label' => 'Address:',
		'header_address' => 'Our Store',

		'header_dk_help_label' => 'Need Help?',
		'header_dk_help' => '#',
		'header_dk_phone_label' => 'Support 24/7',
		'header_dk_phone' => '(61) 8533 2453',
		'header_category' => 'browse categories',

		'header_mb_language' => 1,
		'header_mb_currency' => 1,
		'header_mb_login' => 1,
		'header_mb_wishlist' => 1,

		'header_search_box' => 0,
		
		'header_search_box_menu'	=> 'QUICK LINK',
		'header_search_box_product'	=> 'SUGGESTION FOR YOU',
		// 'category_search_list' => array(
		// 	array(
		// 		'text' => 'Featured',
		// 		'link' => '#'
		// 	),
		// 	array(
		// 		'text' => 'Trendy',
		// 		'link' => '#'
		// 	),
		// 	array(
		// 		'text' => 'New',
		// 		'link' => '#'
		// 	),
		// 	array(
		// 		'text' => 'Sale',
		// 		'link' => '#'
		// 	),
		// ),	
		
		'category_search_list' => json_encode([
			['text' => 'Featured', 'link' => '#'],
			['text' => 'Trendy', 'link' => '#'],
			['text' => 'New', 'link' => '#'],
			['text' => 'Sale', 'link' => '#'],
		]),

		'search_product_type_title'	=> 'Featured product',
		'search_product_type'	=> 'featured',
		'search_product_style'	=> 'style-3',
		'search_product_limit'	=> 5,
		'header_cart_icon' => 1,
		'header_wishlist_icon' => 1,
		'header_login' => 0,
		'show_post_navigator' => 0,
		'show_entry_footer_content'	=> 0,
		'logo_style' => 'image',
		'logo_text' => '',
		'button_action_header_color' => '',
		'button_action_header_color_hover' => '',
		'typography_logo' => array(
			'family' => 'Playfair Display',
			'style'  => '500',
			'size'   => '36',
			'line_height'=>'44px',
			'letter_spacing' => '0px',
		),		
		'logo_width' => 128,
		'menu_location_primary' => 'primary',
		'site_logo'	=> THEMESFLAT_LINK . 'images/logo.svg',
		'site_logo_fixed'	=> THEMESFLAT_LINK . 'images/logo.svg',
		'site_logo_mobile'	=> THEMESFLAT_LINK . 'images/logo.svg',	
		'site_logo_sticky'	=> THEMESFLAT_LINK . 'images/logo.svg',	
		'show_bottom' => 1,		
		'header_backgroundcolor_sticky'=>'#fff',		
		'primary_color'=>'',
		'typography_body' => array(
			'family' => 'Jost',
			'style'  => 'regular',
			'size'   => '16',
			'line_height'=>'24px',
			'letter_spacing' => '0px',
		),
		'body_text_color'=>'#1F1F1F',
		'body_background_color' => '',
		'page_sidebar_layout' => 'fullwidth',
		'content_controls' => array('padding-top' => 52,'padding-bottom' => 0),
		'typography_menu' => array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '16',
			'line_height'=>'',
			'letter_spacing' => '0px',
		), 
		'mainnav_color'		=> '',
		'mainnav_hover_color'=>'',
		'mainnav_active_color'=> '',
		'menu_distance_between' => 20,
		'typography_sub_menu' => array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '14',
			'line_height'=>'21px',
			'letter_spacing' => '0px',
		),
		'sub_nav_color'		=>'',		
		'sub_nav_color_hover'	=>	'',
		'sub_nav_background'=>'',
		'typography_headings'	=> array(
			'family' => 'Jost',
			'style'  => '',
			'line_height'=>'',
			'letter_spacing' => ''		
		),
		'h1_size' => '',
		'h2_size' => '',
		'h3_size' => '',
		'h4_size' => '',
		'h5_size' => '',
		'h6_size' => '',
		'typography_blockquote' => array(
			'family' => 'Jost',
			'style'  => '',
			'size'   => '',
			'line_height'=>'',
			'letter_spacing' => '',
		),	
		'typography_blog_post_title' => array(
			'family' => 'Jost',
			'style'  => '',
			'size'   => '',
			'line_height'=>'',
			'letter_spacing' => '',
		),
		'typography_blog_post_meta' => array(
			'family' => 'Jost',
			'style'  => '',
			'size'   => '',
			'line_height'=>'',
			'letter_spacing' => '',
		),
		'typography_blog_post_buttons' => array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '14',
			'line_height'=>'20px',
			'letter_spacing' => '',
		),
		'typography_blog_single_title' => array(
			'family' => 'Jost',
			'style'  => '',
			'size'   => '',
			'line_height'=>'',
			'letter_spacing' => '',
		),
		'typography_blog_single_comment_title' => array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '36',
			'line_height'=>'1.2222222222222223em',
			'letter_spacing' => '0px',
		),
		'typography_sidebar_widget_title' => array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '20',
			'line_height'=>'30px',
			'letter_spacing' => '0px',
		),	
		'typography_footer_widget_title' => array(
			'family' => 'Playfair Display',
			'style'  => '400',
			'size'   => '20',
			'line_height'=>'32px',
			'letter_spacing' => '0px',
		),	
		'typography_page_title'	=> array(
			'family' => 'Jost',
			'style'  => '',
			'size'   => '',
			'line_height'=>'',
			'letter_spacing' => '',
		),
		'page_title_count' => 1,
		'page_title_description' => 0,
		'page_title_description_content' => 'Discover the stories behind our exquisite pieces—timeless craftsmanship, meaningful designs,
                        <br class="d-none d-xxl-block">
                        and the moments that make them unforgettable.',
		'page_title_description_content_woo' => 'Discover the stories behind our exquisite pieces—timeless craftsmanship, meaningful designs,
                        <br class="d-none d-xxl-block">
                        and the moments that make them unforgettable.',
		'page_title_alignment' => 'left',
		'page_title_background_color2' => '',
		'page_title_text_color' => '#1F1F1F',		
		'page_title_controls' => array('padding-top' => 60, 'padding-bottom' =>0),
		'page_title_background_image' => '',
		'page_title_image_size' => 'cover',
		'page_title_heading_enabled' => 1,
		'typography_breadcrumb'	=> array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '16',
			'line_height'=>'24px',
			'letter_spacing' => '0px',
		),
		'bread_crumb_prefix' => '',
		'breadcrumb_separator' =>  wp_kses( '<span class="br-line w-12 bg-main"></span>', themesflat_kses_allowed_html() ),
		'breadcrumb_color' => '',
		'typography_buttons' => array(
			'family' => 'Jost',
			'style'  => '',
			'size'   => '',
			'line_height'=>'',
			'letter_spacing' => '',
		),
		'typography_pagination'	=> array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '16',
			'line_height'=>'24px',
			'letter_spacing' => '0px',
		),		
		'typography_bottom_menu' => array(
			'family' => 'Jost',
			'style'  => '',
			'size'   => '',
			'line_height'=>'',
			'letter_spacing' => '',
		),
		'breadcrumb_enabled' => 1,
		'show_post_paginator' => 1,
		'post_content_elements' => 'meta,title,excerpt_content,readmore',
		'meta_elements' => 'date',
		'blog_archive_exclude' => '',
		'blog_featured_title' => '',
		'post_layout_single' => 'fullwidth',		
		'blog_archive_layout' => 'blog-list',
		'blog_grid_style' => 'style-1',
		'related_post_style'	=> 'blog-grid',
		'grid_columns_post_related' => 3,
		'number_related_post' => 3,
		'related_post_columns'  => array(
			'desktop' => 3,
			'tablet'  => 2,
			'mobile'  => 2,
		),
		'blog_sidebar_list'		  => 'blog-sidebar',	
		'blog_archive_readmore' => 0,
		'blog_archive_post_excepts_length' => 30,
		'blog_archive_readmore_text' => 'READ MORE',
		'blog_archive_pagination_style' => 'pager-numeric',
		'blog_posts_per_page'	=> 5,
		'blog_order_by'	=> 'date',
		'blog_order_direction' => 'DESC',
		'page_sidebar_list'	=> 'blog-sidebar',		
		
		'show_featured_single'	=> 0,
		'blog_category'	=> 0,
		'blog_category_number' => 6,
		'blog_category_columns'  => array(
			'desktop' => 5,
			'tablet'  => 3,
			'mobile'  => 2,
		),

		'show_entry_title_single' => 0,

		'show_related_products'	=> 0,
		'number_related_product_desk' => 4,
		'number_related_product_tab' => 2,
		'number_related_product_mob' => 2,
		'number_related_product_mob2' => 1,
		

		
		
		'typography_footer' => array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '16',
			'line_height'=>'25.6px',
			'letter_spacing' => '',
		),
		'footer_top'	=> 1,
		'footer_top_category_arr' => json_encode([
			['text' => 'New Collection', 'link' => '#'],
			['text' => 'All Jewelry', 'link' => '#'],
			['text' => 'Charms', 'link' => '#'],
			['text' => 'Bracelets', 'link' => '#'],
			['text' => 'Rings', 'link' => '#'],
			['text' => 'Earrings', 'link' => '#'],
			['text' => 'Gifts', 'link' => '#'],
			['text' => 'Collections', 'link' => '#'],
		]),
		'footer_background_color'	=> '',
		'footer_title_widget_color' => '',
		'footer_text_color'			=> '',
		'footer_text_color_hover'   => '',
		'footer_widget_areas' => 3,
		'footer_controls' => array(),
		'footer1' => 'footer-1',
		'footer2' => 'footer-2',
		'footer3' => 'footer-3',
		'footer4' => 'footer-4',
		'typography_bottom_copyright' => array(
			'family' => 'Jost',
			'style'  => '400',
			'size'   => '16',
			'line_height'=>'24px',
			'letter_spacing' => '-0.01em',
		),
		'show_bottom_currency' => 1,
		'img_payment' => THEMESFLAT_LINK . 'images/payment/payment1.png,' . THEMESFLAT_LINK . 'images/payment/payment2.png,' . THEMESFLAT_LINK . 'images/payment/payment3.png,' . THEMESFLAT_LINK . 'images/payment/payment4.png,' . THEMESFLAT_LINK . 'images/payment/payment5.png,' . THEMESFLAT_LINK . 'images/payment/payment6.png,' . THEMESFLAT_LINK . 'images/payment/payment7.png,' . THEMESFLAT_LINK . 'images/payment/payment8.png,' . THEMESFLAT_LINK . 'images/payment/payment9.png,'. THEMESFLAT_LINK . 'images/payment/payment10.png',
		'bottom_background_color'	=> '',
		'bottom_text_color'			=> '',
		'bottom_link_color'         => '',
		'bottom_text_color_hover'   => '',		
		'language_bottom'   => 1,		
		'currency_bottom'   => 1,		
		'layout_version'			=> 'wide',		
		'footer_copyright'			=> 'Copyright © 2025 by <span class="fw-medium">vemus</span>. All Rights Reserved. ',
		'enable_smooth_scroll'	=> 0,
		'enable_preload' => 1,
		'preload' => 'preload-1',
		
		
		'img_404' => THEMESFLAT_LINK . 'images/404.png',

		// Cookies
		'tf_cookies' => 0,
		'tf_cookies_content' => 'The cookie settings on this website are set to "allow all cookies" to give you the very best experience. Please click Accept Cookies to continue to use the site.',
		'tf_cookies_btn' => 'Privacy Policy',
		'tf_cookies_btn_url' => '#',
		'tf_cookies_btn_active' => 'Accept Cookies',
		
		// Mobile
		'show_topbar_mobile' => 1,
		'show_topbar_mobile_marquee' => 1,
		'show_topbar_mobile_social' => 0,
		'show_topbar_mobile_language' => 0,
		'show_topbar_mobile_currency' => 0,


		'btn_search_mobile' => 1,
		'btn_login_mobile' => 0,
		'btn_wishlist_mobile' => 0,
		'btn_cart_mobile' => 1,

		'btn_pc_cart' => 1,
		'btn_pc_wishlist' => 0,
		'btn_pc_compare' => 0,
		'btn_pc_quickview' => 1,
		'pc_badges' => 0,


		'show_navigation_bar' => 1,
		'navbar_element' => 'home,account,shop,wishlist,cart',

        //Woo
		'page_title_woo' => 1,
		'page_title_heading_woo' => 1,
		'breadcrumb_woo' => 1,		
		'page_title_styles_woo' => 'parallax',
		'pagetitle_des' => 1,
		'pagetitle_btn' => 1,
		'page_title_text_btn' => 'Read More',
		'page_title_background_color_woo' => '',
		'page_title_background_color2_woo' => '',
		'page_title_background_color_opacity_woo' => '100',	
		'page_title_alignment_woo' => 'center',
		'page_title_controls_woo' => array('padding-top' => 52, 'padding-bottom' =>0),

		// pagetitle single
		'page_title_heading_woo_single' => 0,
		'breadcrumb_woo_single' => 1,
		'pagetitle_des_single' => 0,		
		'page_title_description_content_woo_single' => '',		

		'page_title_custom_single' => 1,
		'single_navigation' => 1,

		'show_top_category' => 1,
		'category_all'	=> THEMESFLAT_LINK . 'images/logo.svg',
		'top_category_style' => 'style-1',
		'category_order' => 'name',		
		'category_number' => 6,
		'category_dek' => 4,
		'category_tab' => 3,
		'category_mob' => 2,
		'category_mob2' => 2,
		'category_columns'  => array(
			'desktop' => 5,
			'tablet'  => 4,
			'mobile_sm'  => 3,
			'mobile'  => 2,
		),

		// catalog
		'catalog_toolbar' => 1,
		'catalog_view' => 1,
		'catalog_btn_change' => 1,
		'catalog_sort_by' => 1,
		'number_view'  => 4,
		'number_view_active'  => 4,

		'pagination_ajax' => 0,
		'shop_pagination' => 'loadmore',
		'shop_loadmore_text' => 'Load More',

		'image_box_product' => 1,
		'image_box_product_pos' => 5,
		'image_box_product_text' =>'<span class="fst-italic">Diamond</span> For All',
		'image_box_product_btn_text' =>'DISCOVER NOW',
		'image_box_product_btn_url' =>'#',
		'image_box_product_url' => THEMESFLAT_LINK . 'images/shop-control/image-box.png',

		'image_box_product2' => 1,
		'image_box_product_subtext2' =>'<p class="fw-medium text-white text-uppercase">BE LOVE</p>',
		'image_box_product_text2' =>'Be <span class="fst-italic">Unmissable.</span>',
		'image_box_product_btn_text2' =>'DISCOVER NOW',
		'image_box_product_btn_url2' =>'#',
		'image_box_product_url2' => THEMESFLAT_LINK . 'images/shop-control/image-box-2.jpg',

		'shop_builder' => 0,
		'404_builder' => 0,
		'cart_builder' => 0,
		'checkout_builder' => 0,
		
        'shop_products_per_page' => 13,
        'shop_columns' => 4,
        'shop_layout' => 'fullwidth',
		'shop_style' => 'grid',
        'shop_layout_single' => 'fullwidth',
        'related_products' => 1,
        'related_products_columns' => 5,
        'product_featured_title' => '',
		'show_thumb' => 1,
		'show_cowndown' => 0,
		'show_progress' => 1,
		'show_configuration' => 1,
		'show_delivery' => 1,

		// product card
		'attribute_first' => 'size',
		'attr1_count' => 5,		
		'attr1_type' => 'label',		
		'attribute_second' => 'color',
		'attr2_count' => 3,	
		'attr2_type' => 'color',
		'swatches_image_hover' => 1,
		'product_style' => 'style-1',				
		'show_out_stock' => 1,
		'show_rating' => 0,
		'show_category' => 0,
		'show_description' => 0,
		'show_progressbar' => 0,
		'show_countdown' => 1,
		'show_in_out_stock' => 0,
		'show_out_stock_btn' => 1,
		'out_stock_btn_text' => 'Notify Me When Available',
		'out_stock_form' => '',

		
		'show_badges' => 0,

		// badges
		'badges_stock' => 0,
		'badges_stock_color' => '',
		'badges_stock_background_color' => '',		
		'badges_trending' => 0,
		'badges_trending_color' => '',
		'badges_trending_background_color' => '',	
		'badges_custom' => 0,
		'badges_custom_color' => '',
		'badges_custom_background_color' => '',	
		'badges_sale' => 0,
		'badges_sale_color' => '',
		'badges_sale_background_color' => '',	
		'badges_new' => 0,
		'badges_new_color' => '',
		'badges_new_background_color' => '',	
		'badges_order' => 0,
		'badges_order_color' => '',
		'badges_order_background_color' => '',
		
		'nav_mobile' => 1,

		'shop_iconbox' => 1,

		'icon_boxes_shop' => json_encode([			
			[
                'icon' => '<i class="icon-box text-primary"></i>',
                'title' => 'Free Shipping',
                'description' => 'Enjoy free shipping on all orders',
            ],
			[
                'icon' => '<i class="icon-credit-card text-primary"></i>',
                'title' => 'Flexible Payment',
                'description' => 'Pay with Multiple Credit Cards',
            ],
			[
                'icon' => '<i class="icon-return text-primary"></i>',
                'title' => '14 - Days Return',
                'description' => 'Free return/exchange within 30 days',
            ],
			[
                'icon' => '<i class="icon-headphone text-primary"></i>',
                'title' => 'Premium Support',
                'description' => 'Enjoy our premium support',
            ],
		]),

		// cart
		'free_shipping_bar' => 1,
		'progress_cart_text' => '<p class="h6 text fw-normal text-uppercase">Spend <span class="fw-medium">{currency}{total}</span> more to get <span class="fw-medium">Free Shipping</span></p>',
		'success_cart_text' => 'Congrats! You have got Free Shipping.',

		'related_minicart' => 0,
		'related_minicart_limit' => 5,
		'related_minicart_style' => 'style1',
		'related_heading' => 'You may also like',
		
		'cart_form_extra' => 1,
		'cart_form_extra_heading' => 'We accept',
		'cart_form_extra_img' => THEMESFLAT_LINK . 'images/payment/payment10.png,' . THEMESFLAT_LINK . 'images/payment/payment3.png,' . THEMESFLAT_LINK . 'images/payment/payment7.png,' . THEMESFLAT_LINK . 'images/payment/stripe.svg,' . THEMESFLAT_LINK . 'images/payment/paypal.svg,' . THEMESFLAT_LINK . 'images/payment/payment5.png,' . THEMESFLAT_LINK . 'images/payment/payment2.png',
		

		'cart_iconbox' => 1,

		'icon_boxes' => json_encode([
			['icon' => '<i class="icon icon-shipping"></i>', 'title' => 'Free Shipping'],
			['icon' => '<i class="icon icon-gift"></i>', 'title' => 'Gift Package'],
			['icon' => '<i class="icon icon-return"></i>', 'title' => 'Ease Returns'],
			['icon' => '<i class="icon icon-support"></i>', 'title' => 'ONE YEAR WARRANTY']
		]),
		
		'cart_testi' => 1,

		'testimonial_boxes' => json_encode([
            [
                'quote' => '<i class="icon icon-quote-3 text-primary"></i>',
                'review' => 'I was blown away by the craftsmanship and detail of my necklace. It’s even more stunning in person! Vemus truly delivers timeless elegance.',
                'name' => 'Vemus P.',
                'image' => THEMESFLAT_LINK . 'images/testimonial/avt-5.jpg',
                'stars' => 5, 
            ],
            [
                'quote' => '<i class="icon icon-quote-3 text-primary"></i>',
                'review' => 'These minimalist hoops add the perfect touch of elegance to any outfit. Designed for everyday wear with a sleek, modern finish — your new go-to accessory for effortless sophistication',
                'name' => 'Mas S.',
                'image' => THEMESFLAT_LINK . 'images/testimonial/avt-4.jpg',
                'stars' => 4, 
			],
        ]),

		'checkout_testi' => 1,
		'testimonial_checkout' => json_encode([
            [
                'quote' => '<i class="icon-quote-4"></i>',
                'title' => 'HAPPY CUSTOMERS',				
                'review' => '"I’ve never felt more confident in my wardrobe! Every piece I’ve bought from here is high-quality, trendy, and fits perfectly. The entire shopping experience has been seamless from start to finish. Thank you for making fashion so easy!"',
                'name' => 'vemus P',
            ],
            [
                'quote' => '<i class="icon-quote-4"></i>',
                'title' => 'HAPPY CUSTOMERS',				
                'review' => '"I’ve never felt more confident in my wardrobe! Every piece I’ve bought from here is high-quality, trendy, and fits perfectly. The entire shopping experience has been seamless from start to finish. Thank you for making fashion so easy!"',
                'name' => 'Themesflat',
            ], 
			[
                'quote' => '<i class="icon-quote-4"></i>',
                'title' => 'HAPPY CUSTOMERS',				
                'review' => '"I’ve never felt more confident in my wardrobe! Every piece I’ve bought from here is high-quality, trendy, and fits perfectly. The entire shopping experience has been seamless from start to finish. Thank you for making fashion so easy!"',
                'name' => 'Henry P',
            ]
        ]),

		// Minicart
		'minicart_gift' => 1,
		'gift_fee' => 10.00,		
		'minicart_note' => 1,
		'minicart_shipping' => 1,
		'minicart_coupon' => 1,

		// Live Notification
		'live_notification' => 0,		
		'product_from' => 'order',
		'live_timeout' => 6000,
		'live_interval' => 8000,

		'live_status' => array('wc-completed'),
		'live_number' => 5,

		'product_type' => 'sale',

		'live_category' => '',

		// related
		'related_display' => 1,
		'related_limit' => 5,
		'related_product_style' => 'style-1',
		'related_heading' => 'YOU MAY ALSO LIKE',
		'related_des' => 4,
		'related_tab' => 3,
		'related_mob' => 2,
		'related_product_columns'  => array(
			'desktop' => 4,
			'tablet'  => 3,
			'mobile'  => 2,
		),

		
		// recently
		'recently_display' => 1,
		'recently_limit' => 5,
		'recently_heading' => 'Recently Viewed',
		'recently_product_style' => 'style-1',
		'recently_des' => 4,
		'recently_tab' => 3,
		'recently_mob' => 2,
		'recently_product_columns'  => array(
			'desktop' => 4,
			'tablet'  => 3,
			'mobile'  => 2,
		),

		// cross sell
		'cross_sell_display' => 1,
		'cross_sell_limit' => 5,
		'cross_sell_product_style' => 'style-1',
		'cross_sell_heading' => 'Cross Sell Product',
		'cross_sell_des' => 4,
		'cross_sell_tab' => 3,
		'cross_sell_mob' => 2,
		'cross_sell_product_columns'  => array(
			'desktop' => 4,
			'tablet'  => 3,
			'mobile'  => 2,
		),
		
		// upsell
		'upsell_display' => 1,
		'upsell_limit' => 5,
		'upsell_product_style' => 'style-1',
		'upsell_heading' => 'Upsell Product',
		'upsell_des' => 4,
		'upsell_tab' => 3,
		'upsell_mob' => 2,
		'upsell_product_columns'  => array(
			'desktop' => 4,
			'tablet'  => 3,
			'mobile'  => 2,
		),

		

		// single product
		'fake_sold' => 1,
		'fake_sold_random_from' => 15,
		'fake_sold_random_to' => 30,
		'fake_sold_increment_max' => 5,
		'fake_sold_interval' => 15,
		'fake_sold_text' => 'sold in last 24 hours',

		'fake_view' => 1,
		'fake_view_random_from' => 5,
		'fake_view_random_to' => 60,
		'fake_view_interval' => 6000,
		'fake_view_text' => 'People are viewing this right now',

		'progress_sale' => 1,
		'progress_sale_text' => '',
		'progress_sale_subtext' => 'Only {count} items left',
		'progress_sale_low_stock' => 2,

		'tf_countdown' => 1,
		'tf_countdown_text' => 'HURRY UP!',
		'tf_countdown_subtext' => ' Sale ends in:',

		'tf_wishlist' => 1,

		'tf_size_guide' => 0,
		'tf_size_guide_display' => 'button',
		

		'short_description' => 0,

		'tf_product_tabs_position' => 'default',
		'tf_product_tabs_style' => 'accordion',
		'tf_product_tabs_style_bellow_cart' => 'accordion',

		'tf_product_description_tab' => 1,
		'tf_product_additional_info_tab' => 1,
		'tf_product_reviews_tab' => 1,
		'tf_product_shipping_tab' => 0,
		'tf_product_ask_question_tab' => 0,

		'tf_product_description_icon' => 'icon icon-description fs-14',
		'tf_product_additional_info_icon' => '',
		'tf_product_reviews_icon' => '',
		'tf_product_shipping_icon' => 'icon icon-delivery-2 fs-20',
		'tf_product_ask_question_icon' => 'icon icon-ask fs-18',

		'tf_product_shipping_text' => 'Shipping',
		'tf_product_ask_question_text' => 'Ask a question',

		'tf_product_shipping_title' => 'Delivery & Shipping',
		'tf_product_ask_question_title' => 'Ask a question',

		'tf_product_shipping_content' => '
			<ul class="delivery-list">
                <li>
                    <h5 class="title h5 fw-normal text-uppercase">Free US Standard Delivery</h5>
                    <p class="text-main-4">When you spend over $175, or $3.95 otherwise.</p>
                </li>
                <li>
                    <h5 class="title h5 fw-normal text-uppercase">Next Day Delivery Services</h5>
                    <p class="text-main-4">For $10.95, receive your order the next working day if ordered before 14:00 GMT.</p>
                </li>
                <li>
                    <h5 class="title h5 fw-normal text-uppercase">Nominated Day Delivery Services</h5>
                    <p class="text-main-4">Know when you\'re going to be in? Place your order before 14:00 GMT and opt for a Nominated Day Delivery
                        from just $10.95. Our courier will make sure your order arrives on your chosen day.</p>
                </li>
            </ul>
		',
		'tf_product_ask_question_content' => '',

		'extra_link' => 1,
		'extra_link_description' => 0,
		'extra_link_shipping' => 1,
		'extra_link_ask_question' => 1,

		'extra_link_description_btn_text' => 'Description',
		'extra_link_description_title' => 'Description',

		'extra_link_shipping_btn_text' => 'Shipping',
		'extra_link_shipping_title' => 'Delivery & Shipping',
		'extra_link_shipping_content' => '
			<ul class="delivery-list">
                <li>
                    <h5 class="title h5 fw-normal text-uppercase">Free US Standard Delivery</h5>
                    <p class="text-main-4">When you spend over $175, or $3.95 otherwise.</p>
                </li>
                <li>
                    <h5 class="title h5 fw-normal text-uppercase">Next Day Delivery Services</h5>
                    <p class="text-main-4">For $10.95, receive your order the next working day if ordered before 14:00 GMT.</p>
                </li>
                <li>
                    <h5 class="title h5 fw-normal text-uppercase">Nominated Day Delivery Services</h5>
                    <p class="text-main-4">Know when you\'re going to be in? Place your order before 14:00 GMT and opt for a Nominated Day Delivery
                        from just $10.95. Our courier will make sure your order arrives on your chosen day.</p>
                </li>
            </ul>
		',

		'extra_link_ask_question_btn_text' => 'Ask a question',
		'extra_link_ask_question_title' => 'Ask a question',
		'extra_link_ask_question_content' => '',

		'tf_trust_seal' => 1,
		'tf_trust_seal_text' => 'Guarantee Safe Checkout',
		'tf_trust_seal_items' => '',

		'tf_delivery_info' => 1,
		'tf_delivery_text' => 'Free Insured Express Shipping Across India',
		'tf_delivery_icon' => 'icon icon-box',

		'tf_delivery_text2' => '',
		'tf_delivery_icon2' => '',

		'tf_delivery_text3' => 'Secure All-India & Global Payment Gateways',
		'tf_delivery_icon3' => 'icon icon-credit-card',

		'tf_delivery_text4' => 'Sacred Altar Gift Packaging Included',
		'tf_delivery_icon4' => 'icon icon-gift',

		'tf_product_share' => 1,
		'tf_product_share_facebook' =>  1,
		'tf_product_share_instagram' =>  1,
		'tf_product_share_x' =>  1,
		'tf_product_share_snapchat' =>  1,
		'tf_product_share_linkin' =>  0,

		'tf_buy_now' => 1,
		'tf_buy_now_query_arg' => 'buy-it-now',

		'tf_buy_together' => 1,
		'tf_buy_together_style' => 'list',
		'tf_buy_together_position' => 'right',
		'tf_buy_together_check_all' => 0,

		'tf_buyx_gety' => 1,
		'tf_buyx_gety_main_icon' => 'icon icon-gift',
		'tf_buyx_gety_free_icon' => 'icon icon-plus',
		'tf_buyx_gety_discount_icon' => 'icon icon-tag',
		'tf_buyx_gety_main_text' => 'Part of a promo bundle (main item)',
		'tf_buyx_gety_free_text' => 'Free gift in bundle',
		'tf_buyx_gety_discount_text' => 'Discounted item in bundle ({discount}% off)',

		'tf_volume_discount' => 0,
		'tf_volume_discount_position' => 'after',

		// 'tf_product_gallery' => 1,
		'tf_product_gallery_layout' => 'left_thumb',
		'tf_product_gallery_zoom' => 'external',
		'tf_product_gallery_lightbox' => 1,

		'tf_question_form' => 0,
		'tf_question_form_shortcode' => '',

		'tf_variation_gallery' =>0,
		'tf_product_video' => 0,
		'tf_product_3d' => 0,

		'tf_out_of_stock_notification' => 0,
		'tf_out_of_stock_notification' => '',

		'product_tabs_style' => 'default',
		
		'single_brand' => 0,
		'single_category' => 0,
		'single_sku' => 0,
		'single_add_to_cart_text' => __( 'Add to bag', 'vemus' ),
		'single_sold_out_text' => __( 'Sold out', 'vemus' ),
		'single_pre_order_text' => __( 'Pre-order', 'vemus' ),
		

		// recently wishlist
		'recently_wl_display' => 1,
		'recently_wl_limit' => 5,
		'recently_wl_style' => 'style-2',
		'recently_wl_heading' => 'Recently Viewed',
		'recently_wl_product_columns'  => array(
			'desktop' => 4,
			'tablet'  => 3,
			'mobile'  => 2,
		),
		
		// login google
		'signin_text'	=> 'Or sign in with:',
		'enable_login_gg' => 0,
		'google_login_client_id' => '',
		'google_login_client_secret' => '',
		// login facebook
		'enable_login_fb' => 0,
		'facebook_login_client_id' => '',
		'facebook_login_client_secret' => '',

		'text_privacy_policy' => 'Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.',

		// 404
		'page_404_heading'	=> '<span class="text-primary">Opps! </span>Page not found!',
		'page_404_desc'	=> 'The page you are looking is not available or has been removed. Try going to HomePage by using the button below.',
		'text_button_404' => 'RETURN TO HOMEPAGE',
		'banner_404'	=> THEMESFLAT_LINK . 'images/404/404.jpg',
	);
	return empty($default[$key]) ? '' : $default[$key];
}