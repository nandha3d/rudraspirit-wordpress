<?php 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;


class themesflat_options_elementor {
	public function __construct(){	
        add_action('elementor/documents/register_controls', [$this, 'themesflat_elementor_register_options'], 10);
        add_action('elementor/editor/before_enqueue_scripts', function() { wp_enqueue_script( 'elementor-preview-load', THEMESFLAT_LINK . 'assets/js/elementor/elementor-preview-load.js', array( 'jquery' ), null, true );
        }, 10, 3);
    }

    public function themesflat_elementor_register_options($element){
        $post_id = $element->get_id();
        $post_type = get_post_type($post_id);

        if ( ($post_type !== 'post') && ($post_type !== 'portfolios') && ($post_type !== 'services') && ($post_type !== 'team') ) {
        	$this->themesflat_options_page_header($element);
            $this->themesflat_options_page_footer($element);                      
        }

        $this->themesflat_options_page($element);
        $this->themesflat_options_page_pagetitle($element);

        


    }

    public function themesflat_options_page_header($element) {
        // TF Header
        $element->start_controls_section(
            'themesflat_header_options',
            [
                'label' => esc_html__('TF Header', 'vemus'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'hide_header',
            [
                'label'     => esc_html__( 'Hide Header', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => esc_html__( 'Yes', 'vemus'),
                    'block'      => esc_html__( 'No', 'vemus'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tf-topbar' => 'display: {{VALUE}};',
                    '{{WRAPPER}} #header' => 'display: {{VALUE}};', 
                    '{{WRAPPER}} #mobileMenu' => 'display: {{VALUE}};' 
                ],
            ]
        );

        $element->add_control(
            'style_header',
            [
                'label'     => esc_html__( 'Header Style', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                	'' => esc_html__( 'Theme Setting', 'vemus'),
                    'header-default' => esc_html__( 'Header Default', 'vemus'),
                    'header-01' => esc_html__( 'Header 01', 'vemus' ),
                    'header-02' => esc_html__( 'Header 02', 'vemus' ),
                    'header-03' => esc_html__( 'Header 03', 'vemus' ),
                ],
            ]
        );
        $element->add_control(
            'h_options_topbar',
            [
                'label' => esc_html__( 'Topbar', 'vemus' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $element->add_control(
            'topbar_show',
            [
                'label'     => esc_html__( 'Top Bar', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'Hide', 'vemus'),
                    1       => esc_html__( 'Show', 'vemus'),                    
                ],
                
            ]
        ); 

        $element->add_control(
            'topbar_fullwidth',
            [
                'label'     => esc_html__( 'Top Bar Fullwidth', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'Hide', 'vemus'),
                    1       => esc_html__( 'Show', 'vemus'),                    
                ],
                
            ]
        ); 

        $element->add_control(
			'topbar_items_left',
			[
				'label' => esc_html__( 'Topbar Items Left', 'vemus' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
                'options'     => [
                    'phone'   => __('Phone', 'vemus'),
                    'address' => __('Address', 'vemus'),
                    'email' => __('Email', 'vemus'),
                    'currency'    => __('Currency', 'vemus'),
                    'language'    => __('Language', 'vemus'),
                ],
			]
		);

        $element->add_control(
			'topbar_items_center',
			[
				'label' => esc_html__( 'Topbar Items Center', 'vemus' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
                'options'     => [
                    'text-countdown'    => __('Text & CountDown', 'vemus'),
                    'text-support'    => __('Text Support & Phone', 'vemus'),
                    'phone'   => __('Phone', 'vemus'),
                    'address' => __('Address', 'vemus'),
                    'email' => __('Email', 'vemus'),
                    'button'    => __('Button', 'vemus'),
                ],
			]
		);

        $element->add_control(
			'topbar_items_right',
			[
				'label' => esc_html__( 'Topbar Items Right', 'vemus' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
                'options'     => [
                    'phone'   => __('Phone', 'vemus'),
                    'address' => __('Address', 'vemus'),
                    'email' => __('Email', 'vemus'),
                    'currency'    => __('Currency', 'vemus'),
                    'language'    => __('Language', 'vemus'),
                ],
			]
		);

        $element->add_control(
            'topbar_background_color',
            [
                'label' => esc_html__( 'Background', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf-main-topbar' => 'background: {{VALUE}} !important;',   
                ],
                
            ]
        );

        $element->add_control(
            'topbar_textcolor',
            [
                'label' => esc_html__( 'Color', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf-main-topbar .text-white,{{WRAPPER}} .tf-main-topbar .box-action a, {{WRAPPER}} .tf-main-topbar .link-secondary, {{WRAPPER}} .tf-main-topbar .tf-btn-line, .tf-main-topbar .tf-btn-line::after,.tf-main-topbar .br-line, .tf-main-topbar .tf-btn-line.style-white-2::after, .tf-main-topbar, .tf-main-topbar .tf-dropdown-select > .dropdown-toggle, .tf-main-topbar .tf-dropdown-select > .dropdown-toggle::after' => 'color: {{VALUE}} !important;', 
                    '{{WRAPPER}} .tf-main-topbar .tf-btn-line::after' => 'background: {{VALUE}} !important;', 
                ],
                
            ]
        );

        $element->add_control(
            'show_announcement',
            [
                'label'     => esc_html__( 'Announcement Bar', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'Hide', 'vemus'),
                    1       => esc_html__( 'Show', 'vemus'),                    
                ],
                
            ]
        );

        $element->add_control(
            'announcement_topbar_style',
            [
                'label'     => esc_html__( 'Announcement Bar Style', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                	'' => esc_html__( 'Theme Setting', 'vemus'),
                    'style-marquee' => esc_html__( 'Marquee', 'vemus' ),
                    'style-slider' => esc_html__( 'Slider', 'vemus' ),
                ],
            ]
        );

        $element->add_control(
            'announcement_background_color',
            [
                'label' => esc_html__( 'Background Announcement', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf-announcement' => 'background: {{VALUE}} !important;',   
                ],
            ]
        );

        //Extra Classes Header
        $element->add_control(
            'extra_classes_topbar',
            [
                'label'   => esc_html__( 'Extra Classes', 'vemus' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $element->add_control(
            'h_options_header',
            [
                'label' => esc_html__( 'Header', 'vemus' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Logo
        $element->add_control(
            'site_logo',
            [
                'label'   => esc_html__( 'Custom Logo', 'vemus' ),
                'type'    => Controls_Manager::MEDIA,
            ]
        );

        $element->add_control(
            'site_logo_mobile',
            [
                'label'   => esc_html__( 'Custom Logo Mobile', 'vemus' ),
                'type'    => Controls_Manager::MEDIA,
            ]
        );

        $element->add_control(
            'site_logo_sticky',
            [
                'label'   => esc_html__( 'Custom Logo Header Sticky', 'vemus' ),
                'type'    => Controls_Manager::MEDIA,
            ]
        );

        $element->add_responsive_control(
            'logo_width',
            [
                'label'      => esc_html__( 'Logo Width', 'vemus' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 30,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} #header #logo a img, {{WRAPPER}} .modal-menu__panel-footer .logo-panel a img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

       
        $element->add_control(
            'header_absolute',
            [
                'label'     => esc_html__( 'Header Absolute', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'No', 'vemus'),
                    1       => esc_html__( 'Yes', 'vemus'),                    
                ],
            ]
        );
        $element->add_control(
            'header_sticky',
            [
                'label'     => esc_html__( 'Header Sticky', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'No', 'vemus'),
                    1       => esc_html__( 'Yes', 'vemus'),                    
                ],
                
            ]
        );
        $element->add_control(
            'header_search_box',
            [
                'label'     => esc_html__( 'Search Box', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'Hide', 'vemus'),
                    1       => esc_html__( 'Show', 'vemus'),                    
                ],
                
            ]
        );        
        $element->add_control(
            'header_cart_icon',
            [
                'label'     => esc_html__( 'Header Cart', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'Hide', 'vemus'),
                    1       => esc_html__( 'Show', 'vemus'),                    
                ],
                
            ]
        );
        $element->add_control(
            'header_wishlist_icon',
            [
                'label'     => esc_html__( 'Header Wishlist', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'Hide', 'vemus'),
                    1       => esc_html__( 'Show', 'vemus'),                    
                ],
                
            ]
        ); 

        $element->add_control(
            'header_login',
            [
                'label'     => esc_html__( 'Header Login', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'Hide', 'vemus'),
                    1       => esc_html__( 'Show', 'vemus'),                    
                ],
                
            ]
        ); 

        $element->add_responsive_control(
            'header_background',
            [
                'label' => esc_html__( 'Background', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #header,{{WRAPPER}} .header-absolute #header' => 'background: {{VALUE}} !important;',                  
                ],
                
            ]
        );

        $element->add_control(
            'header_background_bottom',
            [
                'label' => esc_html__( 'Header Bottom Background', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-01 .header-bottom' => 'background: {{VALUE}} !important;',                  
                ],
                'condition' => [
	                'style_header'	=> 'header-01',
	            ],
            ]
        );

        $element->add_control(
            'header_background_stk',
            [
                'label' => esc_html__( 'Background Sticky', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-absolute #header.header-bg,{{WRAPPER}} #header.header-bg' => 'background: {{VALUE}} !important;',                  
                ],
                
            ]
        );

        $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'header_border',
				'label' => esc_html__( 'Header Border', 'vemus' ),
				'selector' => '{{WRAPPER}} #header',
			]
		);

        $element->add_responsive_control(
            'header_menucolor',
            [
                'label' => esc_html__( 'Color Menu', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #mainnav > ul > li > a, {{WRAPPER}} #mainnav > ul > li > a i,{{WRAPPER}} .header-default .mobile-menu' => 'color: {{VALUE}} !important;',                  
                    '{{WRAPPER}} .btn-mobile-menu::after, {{WRAPPER}} .btn-mobile-menu::before, {{WRAPPER}} .btn-mobile-menu span' => 'background-color: {{VALUE}} !important;',                  
                ],
                
            ]
        );

        $element->add_control(
            'header_menucolor_sticky',
            [
                'label' => esc_html__( 'Color Menu Sticky', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-sticky #mainnav > ul > li > a, {{WRAPPER}} .header-sticky .menu-item .item-link .icon ,{{WRAPPER}} .header-sticky #mainnav > ul > li > a i, {{WRAPPER}} .header-sticky .header-default .mobile-menu' => 'color: {{VALUE}} !important;', 
                    '{{WRAPPER}} .header-sticky .btn-mobile-menu::after, {{WRAPPER}} .header-sticky .btn-mobile-menu::before, {{WRAPPER}} .header-sticky .btn-mobile-menu span' => 'background-color: {{VALUE}} !important;',                  
                ],
                
            ]
        );

        $element->add_control(
            'header_menucolor_hover',
            [
                'label' => esc_html__( 'Color Menu Hover', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #mainnav > ul > li.current-menu-item > a,{{WRAPPER}} #mainnav > ul > li.current-menu-ancestor > a,{{WRAPPER}} #mainnav > ul > li.current-menu-parent > a,{{WRAPPER}} #mainnav > ul > li > a:hover' => 'color: {{VALUE}};',                  
                ],
                
            ]
        );

        $element->add_responsive_control(
            'header_btncolor',
            [
                'label' => esc_html__( 'Color Wrap Btn', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf-header .nav-icon a, {{WRAPPER}} .tf-header .form-search input, {{WRAPPER}} .tf-header .form-search input::placeholder, {{WRAPPER}} .tf-header .form-search button' => 'color: {{VALUE}} !important;',                  
                    '{{WRAPPER}} .tf-header:not(.header-02) .nav-icon .br-line' => 'background-color: {{VALUE}} !important;',                  
                    '{{WRAPPER}} .tf-header .form-search input' => 'border-color: {{VALUE}} !important;',                  
                ],
                
            ]
        );

        $element->add_control(
            'header_btncolorstk',
            [
                'label' => esc_html__( 'Color Wrap Btn Sticky', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-sticky .nav-icon a, {{WRAPPER}} .header-sticky .form-search input::placeholder, {{WRAPPER}} .header-sticky .form-search input, {{WRAPPER}} .header-sticky .form-search button' => 'color: {{VALUE}} !important;',                  
                    '{{WRAPPER}} .header-sticky .nav-icon .br-line' => 'background-color: {{VALUE}} !important;',                  
                    '{{WRAPPER}} .header-sticky .form-search input' => 'border-color: {{VALUE}} !important;',               
                ],
                
            ]
        );
        

        $element->add_responsive_control(
            'header_menu_mb_color',
            [
                'label' => esc_html__( 'Color Menu Toogle Mobile', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf-header .btn-mobile-menu span, {{WRAPPER}} .tf-header .btn-mobile-menu:before, {{WRAPPER}} .tf-header .btn-mobile-menu:after' => 'background-color: {{VALUE}};',                  
                ],
                
            ]
        );

        $element->add_control(
            'header_menu_mb_color_active',
            [
                'label' => esc_html__( 'Color Menu Toogle Mobile Sticky', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-sticky .btn-mobile-menu span, {{WRAPPER}} .header-sticky .btn-mobile-menu:before, {{WRAPPER}} .header-sticky .btn-mobile-menu:after' => 'background-color: {{VALUE}};',                  
                ],
                
            ]
        );

        //Extra Classes Header
        $element->add_control(
            'extra_classes_header',
            [
                'label'   => esc_html__( 'Extra Classes', 'vemus' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $element->end_controls_section();
    }

    public function themesflat_options_page_pagetitle($element) {
        // TF Page Title
        $element->start_controls_section(
            'themesflat_pagetitle_options',
            [
                'label' => esc_html__('TF Page Title', 'vemus'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );       

        $element->add_control(
            'hide_pagetitle',
            [
                'label'     => esc_html__( 'Hide Page Title', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => esc_html__( 'Yes', 'vemus'),
                    'block'      => esc_html__( 'No', 'vemus'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tf-page-title' => 'display: {{VALUE}};',
                ],
            ]
        ); 

        
        $element->add_control(
            'page_title_alignment',
            [
                'label'     => esc_html__( 'Page Title Alignment', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'left' => esc_html__( 'Left', 'vemus'),
                    'center'       => esc_html__( 'Center', 'vemus'),
                    'right'       => esc_html__( 'Right', 'vemus'),                    
                ],
                
            ]
        ); 

        $element->add_control(
            'page_title_description',
            [ 
                'label'        => esc_html__( 'Enable Page Title Description', 'vemus' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'vemus' ),
                'label_off'    => esc_html__( 'Off', 'vemus' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $element->add_control(
            'page_title_description_content',
            [
                'label'   => esc_html__( 'Page Title Description Content', 'vemus' ),
                'type'    => Controls_Manager::TEXTAREA,
            ]
        );

        $element->add_responsive_control(
            'pagetitle_padding',
            [
                'label' => esc_html__( 'Padding', 'vemus' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [
                    '{{WRAPPER}} .tf-page-title' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
                'condition' => [ 'hide_pagetitle' => 'block' ]
            ]
        ); 

        $element->add_responsive_control(
            'pagetitle_margin',
            [
                'label' => esc_html__( 'Margin', 'vemus' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [
                    '{{WRAPPER}} .tf-page-title' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
                'condition' => [ 'hide_pagetitle' => 'block' ]
            ]
        );              

        //Extra Classes Page Title
        $element->add_control(
            'extra_classes_pagetitle',
            [
                'label'   => esc_html__( 'Extra Classes', 'vemus' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $element->end_controls_section();
    }

    public function themesflat_options_page_footer($element) {
        // TF Footer
        $element->start_controls_section(
            'themesflat_footer_options',
            [
                'label' => esc_html__('TF Footer', 'vemus'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'footer_heading',
            [
                'label'     => esc_html__( 'Footer', 'vemus'),
                'type'      => Controls_Manager::HEADING,
            ]
        );       

        $element->add_control(
            'hide_footer',
            [
                'label'     => esc_html__( 'Hide Footer', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => esc_html__( 'Yes', 'vemus'),
                    'block'      => esc_html__( 'No', 'vemus'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} #footer' => 'display: {{VALUE}};',
                    '{{WRAPPER}} .info-footer' => 'display: {{VALUE}};' 
                ],
            ]
        );

        $element->add_responsive_control(
            'footer_padding',
            [
                'label' => esc_html__( 'Padding', 'vemus' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [
                    '{{WRAPPER}} #footer' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
                'condition' => [ 'hide_footer' => 'block' ]
            ]
        );

        $element->add_control(
            'footer_top',
            [
                'label'     => esc_html__( 'Footer Top', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'Theme Setting', 'vemus'),
                    0       => esc_html__( 'Off', 'vemus'),
                    1       => esc_html__( 'On', 'vemus'),                    
                ],
                
            ]
        ); 
        
        $element->add_control(
            'footer_color',
            [
                'label' => esc_html__( 'Color', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #footer' => 'color: {{VALUE}}',
                    '{{WRAPPER}} #footer h1, {{WRAPPER}} #footer h2, {{WRAPPER}} #footer h3, {{WRAPPER}} #footer h4, {{WRAPPER}} #footer h5, {{WRAPPER}} #footer h6' => 'color: {{VALUE}}',
                    '{{WRAPPER}} #footer, #footer input, #footer select, {{WRAPPER}} #footer textarea, {{WRAPPER}} #footer a, {{WRAPPER}} footer .widget.widget-recent-news li .text .post-date, {{WRAPPER}} footer .widget.widget_latest_news li .text .post-date, {{WRAPPER}} #footer .footer-widgets .widget.widget_themesflat_socials ul li a, {{WRAPPER}} .footer-newsletter p.mb-20, {{WRAPPER}} .footer-info .item' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tf-btn.btn-line-dark::after,   {{WRAPPER}}  footer .footer-inner-wrap .widget_nav_menu .widget-title::before ,  {{WRAPPER}}  footer .footer-inner-wrap .widget_nav_menu .widget-title::after, {{WRAPPER}} .footer-heading-mobile::after,  {{WRAPPER}}   .footer-heading-mobile::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [ 'hide_footer' => 'block' ]
            ]
        );       

        $element->add_control(
            'footer_color_hover',
            [
                'label' => esc_html__( 'Color Hover Link', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-body a:hover, {{WRAPPER}} .footer-bottom a:hover ' => 'color: {{VALUE}} !important',
                ],
                'condition' => [ 'hide_footer' => 'block' ]
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'footer_bg',
                'label' => esc_html__( 'Background', 'vemus' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .footer_background .overlay-footer',
                'condition' => [ 'hide_footer' => 'block' ]
            ]
        );

        $element->add_control(
            'footer_bg_overlay',
            [
                'label' => esc_html__( 'Background Overlay', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer_background' => 'background-color: {{VALUE}}',
                ],
                'condition' => [ 'hide_footer' => 'block' ]
            ]
        );

        $element->add_control(
            'footer_border_color',
            [
                'label' => esc_html__( 'Border Color', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf-social-icon.style-large .social-item, {{WRAPPER}} .footer-default .footer-body, {{WRAPPER}}  .footer-default .footer-bottom, {{WRAPPER}} .footer-body .row-footer .s1, {{WRAPPER}} .footer-body .row-footer .s2 ' => 'border-color: {{VALUE}}',
                ],
                'condition' => [ 'hide_footer' => 'block' ]
            ]
        );

        $element->add_control(
            'enable_shape_footer',
            [ 
                'label'        => esc_html__( 'Enable Shape Footer', 'vemus' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'vemus' ),
                'label_off'    => esc_html__( 'Off', 'vemus' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

		$element->add_control(
			'shape_footer',
			[
				'label' => esc_html__( 'Shape Image', 'vemus' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'enable_shape_footer' => 'yes'
				]
			]
		);

        // Bottom
        $element->add_control(
            'bottom_heading',
            [
                'label'     => esc_html__( 'Bottom', 'vemus'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $element->add_control(
            'hide_bottom',
            [
                'label'     => esc_html__( 'Hide?', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => esc_html__( 'Yes', 'vemus'),
                    'block'      => esc_html__( 'No', 'vemus'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} #bottom' => 'display: {{VALUE}};' 
                ],
            ]
        );

        $element->add_control(
            'bottom_color',
            [
                'label' => esc_html__( 'Color', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bottom *' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .bottom, {{WRAPPER}} .bottom a' => 'color: {{VALUE}}',
                ],
                'condition' => [ 'hide_bottom' => 'block' ]
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bottom_bg',
                'label' => esc_html__( 'Background', 'vemus' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #bottom',
                'condition' => [ 'hide_bottom' => 'block']
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'bottom_border',
                'label' => esc_html__( 'Border', 'vemus' ),
                'selector' => '{{WRAPPER}} #bottom .container-inside',
                'condition' => [ 'hide_bottom' => 'block']
            ]
        );

        $element->add_responsive_control(
            'bottom_padding',
            [
                'label' => esc_html__( 'Padding', 'vemus' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [
                    '{{WRAPPER}} #bottom .container-inside' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
                'condition' => [ 'hide_bottom' => 'block']
            ]
        );

        //Extra Classes Footer
        $element->add_control(
            'extra_classes_footer',
            [
                'label'   => esc_html__( 'Extra Classes', 'vemus' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $element->end_controls_section();
    }

    public function themesflat_options_page($element) {
        // TF Page
        $element->start_controls_section(
            'themesflat_page_options',
            [
                'label' => esc_html__('TF Page', 'vemus'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );
        
        $element->add_control(
            'background_body',
            [
                'label' => esc_html__( 'Backround Body', 'vemus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .themesflat-boxed' => 'background: {{VALUE}};',                  
                ],
                
            ]
        );

        $element->add_control(
            'page_sidebar_layout',
            [
                'label'     => esc_html__( 'Sidebar Position', 'vemus'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    '' => esc_html__( 'No Sidebar', 'vemus'),
                    'sidebar-right'     => esc_html__( 'Sidebar Right','vemus' ),
                    'sidebar-left'      =>  esc_html__( 'Sidebar Left','vemus' ),
                    'fullwidth'         =>   esc_html__( 'Full Width','vemus' ),
                    'fullwidth-small'   =>   esc_html__( 'Full Width Small','vemus' ),
                    'fullwidth-center'  =>   esc_html__( 'Full Width Center','vemus' ),
                ],
            ]
        );

        $element->add_control(
            'main_content_heading',
            [
                'label'     => esc_html__( 'Main Content', 'vemus'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $element->add_responsive_control(
            'main_content_padding',
            [
                'label' => esc_html__( 'Padding', 'vemus' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [
                    '{{WRAPPER}} #themesflat-content' => 'padding-top: {{TOP}}{{UNIT}} !important; padding-bottom: {{BOTTOM}}{{UNIT}} !important;',
                ],
            ]
        ); 

        $element->add_responsive_control(
            'main_content_margin',
            [
                'label' => esc_html__( 'Margin', 'vemus' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [
                    '{{WRAPPER}} #themesflat-content' => 'margin-top: {{TOP}}{{UNIT}} !important; margin-bottom: {{BOTTOM}}{{UNIT}} !important;',
                ],
            ]
        );

        $element->end_controls_section();
    }

}

new themesflat_options_elementor();